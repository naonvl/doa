<?php
    @session_start();

    if (($_SESSION["logged"] == 0)) {
        echo 'Access denied';
        exit;
    }

    include_once ("../app/include/sambung.php");
    include_once ("../app/include/functions.php");
    include_once ("../app/include/inword.php");

    include_once ("../app/class/class.select.php");
    include_once ("../app/class/class.selectview.php");
?>

<!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" >
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload File</label>
        <div class="col-sm-3">
            <input type="file" name="file" id="file" accept=".csv">
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-sm-3">
            <input type="submit" name="submit" class='btn btn-primary' value="Upload" >
        </div>
    </div>
</form>

<?php
if($_POST["submit"]) {
    $select     = new select;
    $selectview = new selectview;

    $dbpdo = DB::create();

    $fileName   = $_FILES["file"]["tmp_name"];
    
    /*$sqlukbm   = $selectview->list_ukbm_pertemuan($idtingkat, $idpelajaran, $semester_id);
    $dataukbm    = $sqlukbm->fetch(PDO::FETCH_OBJ); 
    $jumlah_ukbm1= $dataukbm->jumlah_ukbm;*/
    
    if ($_FILES["file"]["size"] > 0) {
                
        //cek delimiter (, or ;)
        $filecek = fopen($fileName, "r");        
        $cekcolumn1 = fgetcsv($filecek, 10000, ";");
        $datacol = $cekcolumn1[0];
        //----------------------
        
        if (preg_match("/,/",$datacol) == 0) {
            $file = fopen($fileName, "r");
            $column = fgetcsv($file, 10000, ";");
        } 
        //echo $datacol;
        if (preg_match("/,/",$datacol) == 1) {
            $file = fopen($fileName, "r");
            $column = fgetcsv($file, 10000, ",");
        }
        
        date_default_timezone_set('Asia/Jakarta');

        $jmlnilai = 0;
        $x = 0;
        $insert = 0;
        $update = 0;
        
        if (preg_match("/,/",$datacol) == 0) {
            while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
                            
                if($x >= 0) {
                    
                    $ref2           =   $column[0];
                    $client_name    =   petikreplace($column[2]);
                    $date           = str_replace("/","-",$column[1]);
                    $date           =   date('Y-m-d', strtotime($date));
                                                            
                    $uid            =   $_SESSION["loginname"];
                    $dlu            =   date("Y-m-d H:i:s");
                    
                    if($ref2 != "" && $client_name != "") {
                        
                        $address        =   trim(petikreplace($column[3])); 
                        $address        = preg_replace("/[^a-zA-Z]/", " ", $address);
                        $phone          =   trim(petikreplace($column[4])); 
                        $receipt_type   =   trim(petikreplace($column[5])); 
                        $bank_account   =   trim(petikreplace($column[6]));
                        $bank_name      =   trim(petikreplace($column[7]));

                        //barang---------
                        $itemcode       =   trim(petikreplace($column[8]));
                        $item_name      =   trim(petikreplace($column[9]));
                        $qty            =   numberreplace(trim($column[10]));
                        $unit_price     =   numberreplace(trim($column[11]));
                        $discount       =   numberreplace(trim($column[12]));
                        $amount         =   numberreplace(trim($column[13]));

                        $channel         =   numberreplace(trim($column[14]));
                        $cashier         =   numberreplace(trim($column[15]));

                        $expedition      =   petikreplace(trim($column[16]));
                        $note_transfer   =   petikreplace(trim($column[17]));
                        $freight_cost    =   numberreplace(trim($column[18]));
                        
                        $client_name = preg_replace("/[^a-zA-Z]/", " ", $client_name);
                        $strclient = "select syscode from client where name='$client_name' and phone='$phone'";
                        $sqlclient=$dbpdo->prepare($strclient);
                        $sqlclient->execute();
                        $rowsclient = $sqlclient->rowcount();
                        $data_client = $sqlclient->fetch(PDO::FETCH_OBJ);
                        $client_code = $data_client->syscode;
                        if($rowsclient == 0) {
                            $code   =   notran($date, 'frmclient', '', '', '');
                            $syscode    =   random(15);
                            $client_type = '13';
                            $sqlstr  =  "insert into client (code, name, contact_person, client_type, ship_to, bill_to, phone, address, active, syscode, location_id, uid, dlu) values ('$code', '$client_name', '$client_name', '$client_type', '$address', '$address', '$phone', '$address', 1, '$syscode', '0', '$uid', '$dlu')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();    
                            notran($date, 'frmclient', 1, '', '') ; //----eksekusi ref

                            $client_code = $syscode;
                        }


                        //-------check channel
                        $strcnl = "select id from channel where name='$channel'";
                        $sqlcnl=$dbpdo->prepare($strcnl);
                        $sqlcnl->execute();
                        $rowscnl = $sqlcnl->rowcount();
                        $data_cnl = $sqlcnl->fetch(PDO::FETCH_OBJ);
                        $channel_id = $data_cnl->id;
                        if($rowscnl == 0) {
                            $sqlstr="insert into channel (name, active, uid, dlu) values('$channel', 1, '$uid', '$dlu')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();

                            //get last ID
                            $sqlstr="select last_insert_id() id";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                            $data   = $sql->fetch(PDO::FETCH_OBJ);
                            $channel_id    = $data->id;
                        }


                        //-------check cashier
                        $strepy = "select id from employee where name='$cashier'";
                        $sqlepy=$dbpdo->prepare($strepy);
                        $sqlepy->execute();
                        $rowsepy = $sqlepy->rowcount();
                        $data_epy = $sqlepy->fetch(PDO::FETCH_OBJ);
                        $employee_id = $data_epy->id;
                        if($rowsepy == 0) {
                            $sqlstr="insert into employee (code, name, nick_name, born, birth_date, marital_status, religion_id, address, zip_code, country_id, state_id, phone, email, photo, position_id, department_id, division_id, location_id, category_id, bank_name, bank_account, bank_account_name, active, uid, dlu) values('', '$cashier', '', '', '00:00:00', '0', '0', '', '', '0', '0', '', '', '', '0', '0', '0', '0', '0', '', '', '', '1', '$uid', '$dlu')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();

                            //get last ID
                            $sqlstr="select last_insert_id() id";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                            $data   = $sql->fetch(PDO::FETCH_OBJ);
                            $employee_id    = $data->id;
                        }

                        //-------check expedition
                        //$string = "Suka*()bumi #$^%&87 Kode ()*(&*^6.";
                        $expedition = preg_replace("/[^a-zA-Z]/", " ", $expedition);

                        $strexp = "select id from expedition where name='$expedition'";
                        $sqlexp=$dbpdo->prepare($strexp);
                        $sqlexp->execute();
                        $rowsexp = $sqlexp->rowcount();
                        $data_exp = $sqlexp->fetch(PDO::FETCH_OBJ);
                        $expedition_id = $data_exp->id;
                        if($rowsexp == 0) {
                            $sqlstr="insert into expedition (name, active) values('$expedition', 1)";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();

                            //get last ID
                            $sqlstr="select last_insert_id() id";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                            $data   = $sql->fetch(PDO::FETCH_OBJ);
                            $expedition_id    = $data->id;
                        }

                        //--------sales
                        $strclient = "select ref from sales_invoice where ref2='$ref2' limit 1 ";
                        $sqlclient=$dbpdo->prepare($strclient);
                        $sqlclient->execute();
                        $rowssales = $sqlclient->rowcount();
                        $datasales = $sqlclient->fetch(PDO::FETCH_OBJ);
                        $ref = $datasales->ref;

                        if($rowssales == 0) {
                            $id_user = $_SESSION["id_user"];
                            $ref=notran($date, 'frmpos', '', '', $id_user); //---get no ref

                            $status = "Paid";
                            $paid = 1;
                            $sqlstr = "insert into sales_invoice (ref, ref2, date, status, client_code, ship_to, receipt_type, bank_account, paid, channel_id, employee_id, expedition_id, note_transfer, freight_cost, uid, dlu) values ('$ref', '$ref2', '$date', '$status', '$client_code', '$address', '$receipt_type', '$bank_account', '$paid', '$channel_id', '$employee_id', '$expedition_id', '$note_transfer', '$freight_cost', '$uid', '$dlu')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                            notran($date, 'frmpos', 1, '', $id_user) ;

                            $insert++;
                        } else {
                            $sqlstr = "update sales_invoice set date='$date', ship_to='$address', bank_account='$bank_account', channel_id='$channel_id', employee_id='$employee_id', expedition_id='$expedition_id', note_transfer='$note_transfer', freight_cost='$freight_cost', uid='$uid', dlu='$dlu' where ref='$ref'";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();

                            $update++;
                        }
                       

                        //----------sales_invoice_detail----------
                        if($item_name != "" && $qty > 0) {
                            $item_name = preg_replace("/[^a-zA-Z]/", " ", $item_name);
                            //echo $item_name.'<br>';
                            $strclient = "select syscode from item where code='$itemcode' limit 1 ";
                            $sqlclient=$dbpdo->prepare($strclient);
                            $sqlclient->execute();
                            $rowsitem = $sqlclient->rowcount();
                            $dataitem = $sqlclient->fetch(PDO::FETCH_OBJ);
                            $item_code = $dataitem->syscode;
                            if($rowsitem == 0) {
                                $code= $itemcode; //notran($date, 'frmitem', '', '', ''); 
                                $syscode        =   random(25);

                                $old_code       =   $code;
                                $name           =   $item_name;
                                $item_group_id  =   0;
                                $item_subgroup_id   =  0;
                                $item_type_code     =  '';
                                $item_category_id   =  0;
                                $brand_id           =  0;
                                $size_id            =  '';
                                $uom_code_stock     =  'pcs';
                                $uom_code_sales     =   'pcs';     
                                $uom_code_purchase  =   $uom_code_sales;
                                $minimum_stock      =   0;
                                $maximum_stock      =   0;          
                                $consigned      =   0;
                                $balance        =   0;
                                $description    =   '';
                                $active         =   1;

                                $sqlstr="insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, balance, description, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$balance', '$description', '$active', '$uid', '$dlu', '$syscode')";
                                $sql=$dbpdo->prepare($sqlstr);
                                $sql->execute();
                                //notran($date, 'frmitem', 1, '', '') ; 

                                $item_code = $syscode;
                            }

                            //----insert sales_invoice_detail
                            $strclient = "select ref from sales_invoice_detail where ref='$ref' and item_code='$item_code' limit 1 ";
                            $sqlclient=$dbpdo->prepare($strclient);
                            $sqlclient->execute();
                            $rowsdet = $sqlclient->rowcount();
                            if($rowsdet == 0) {
                                $so_ref     =   '';
                                $uom_code   =   'pcs';
                                if($discount > 0) {
                                    $discount3  =   ($discount/$unit_price) * 100;  
                                } else {
                                    $discount3 = 0;
                                }
                                $non_discount   = 0;
                                $unit_cost      = 0;
                                $amount_cost    = 0;
                                $so_line        = 0;

                                $line = maxline('sales_invoice_detail', 'line', 'ref', $ref, '');
                    
                                $sqlstr="insert into sales_invoice_detail (ref, so_ref, item_code, uom_code, qty, discount, discount3, unit_price, amount, non_discount, unit_cost, amount_cost, line_item_so, line) values ('$ref', '$so_ref', '$item_code', '$uom_code', '$qty', '$discount', '$discount3', '$unit_price', '$amount', '$non_discount', '$unit_cost', '$amount_cost', '$so_line', '$line')";
                                $sql1=$dbpdo->prepare($sqlstr);
                                $sql1->execute();
                            }
                        }

                        
                        //--update total sales
                        $sqlstr = "select sum(amount) grand_total from sales_invoice_detail where ref='$ref' group by ref";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute(); 
                        $data_detail = $sql->fetch(PDO::FETCH_OBJ);
                        $grand_total = numberreplace($data_detail->grand_total);

                        $sqlstr = "update sales_invoice set total='$grand_total' where ref='$ref'";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute();    
                        
                    }          
                                
                }
                
                $x++;
                
            }
        }
        
        
        /*KOMA*/
        if (preg_match("/,/",$datacol) == 1) {
            while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
                            
                if($x >= 0) {
                    
                    $ref2           =   $column[0];
                    $client_name    =   petikreplace($column[2]);
                    $date           = str_replace("/","-",$column[1]);
                    $date           =   date('Y-m-d', strtotime($date));
                                                            
                    $uid            =   $_SESSION["loginname"];
                    $dlu            =   date("Y-m-d H:i:s");
                    
                    if($ref2 != "" && $client_name != "") {
                        
                        $address        =   trim(petikreplace($column[3])); 
                        $address        = preg_replace("/[^a-zA-Z]/", " ", $address);
                        $phone          =   trim(petikreplace($column[4])); 
                        $receipt_type   =   trim(petikreplace($column[5])); 
                        $bank_account   =   trim(petikreplace($column[6]));
                        $bank_name      =   trim(petikreplace($column[7]));

                        //barang---------
                        $itemcode       =   trim(petikreplace($column[8]));
                        $item_name      =   trim(petikreplace($column[9]));
                        $qty            =   numberreplace(trim($column[10]));
                        $unit_price     =   numberreplace(trim($column[11]));
                        $discount       =   numberreplace(trim($column[12]));
                        $amount         =   numberreplace(trim($column[13]));

                        $channel         =   numberreplace(trim($column[14]));
                        $cashier         =   numberreplace(trim($column[15]));

                        $expedition      =   petikreplace(trim($column[16]));
                        $note_transfer   =   petikreplace(trim($column[17]));
                        $freight_cost    =   numberreplace(trim($column[18]));
                        
                        $client_name = preg_replace("/[^a-zA-Z]/", " ", $client_name);
                        $strclient = "select syscode from client where name='$client_name' and phone='$phone'";
                        $sqlclient=$dbpdo->prepare($strclient);
                        $sqlclient->execute();
                        $rowsclient = $sqlclient->rowcount();
                        $data_client = $sqlclient->fetch(PDO::FETCH_OBJ);
                        $client_code = $data_client->syscode;
                        if($rowsclient == 0) {
                            $code   =   notran($date, 'frmclient', '', '', '');
                            $syscode    =   random(15);
                            $client_type = '13';
                            $sqlstr  =  "insert into client (code, name, contact_person, client_type, ship_to, bill_to, phone, address, active, syscode, location_id, uid, dlu) values ('$code', '$client_name', '$client_name', '$client_type', '$address', '$address', '$phone', '$address', 1, '$syscode', '0', '$uid', '$dlu')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();    
                            notran($date, 'frmclient', 1, '', '') ; //----eksekusi ref

                            $client_code = $syscode;
                        }


                        //-------check channel
                        $strcnl = "select id from channel where name='$channel'";
                        $sqlcnl=$dbpdo->prepare($strcnl);
                        $sqlcnl->execute();
                        $rowscnl = $sqlcnl->rowcount();
                        $data_cnl = $sqlcnl->fetch(PDO::FETCH_OBJ);
                        $channel_id = $data_cnl->id;
                        if($rowscnl == 0) {
                            $sqlstr="insert into channel (name, active, uid, dlu) values('$channel', 1, '$uid', '$dlu')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();

                            //get last ID
                            $sqlstr="select last_insert_id() id";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                            $data   = $sql->fetch(PDO::FETCH_OBJ);
                            $channel_id    = $data->id;
                        }


                        //-------check cashier
                        $strepy = "select id from employee where name='$cashier'";
                        $sqlepy=$dbpdo->prepare($strepy);
                        $sqlepy->execute();
                        $rowsepy = $sqlepy->rowcount();
                        $data_epy = $sqlepy->fetch(PDO::FETCH_OBJ);
                        $employee_id = $data_epy->id;
                        if($rowsepy == 0) {
                            $sqlstr="insert into employee (code, name, nick_name, born, birth_date, marital_status, religion_id, address, zip_code, country_id, state_id, phone, email, photo, position_id, department_id, division_id, location_id, category_id, bank_name, bank_account, bank_account_name, active, uid, dlu) values('', '$cashier', '', '', '00:00:00', '0', '0', '', '', '0', '0', '', '', '', '0', '0', '0', '0', '0', '', '', '', '1', '$uid', '$dlu')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();

                            //get last ID
                            $sqlstr="select last_insert_id() id";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                            $data   = $sql->fetch(PDO::FETCH_OBJ);
                            $employee_id    = $data->id;
                        }

                        //-------check expedition
                        //$string = "Suka*()bumi #$^%&87 Kode ()*(&*^6.";
                        $expedition = preg_replace("/[^a-zA-Z]/", " ", $expedition);

                        $strexp = "select id from expedition where name='$expedition'";
                        $sqlexp=$dbpdo->prepare($strexp);
                        $sqlexp->execute();
                        $rowsexp = $sqlexp->rowcount();
                        $data_exp = $sqlexp->fetch(PDO::FETCH_OBJ);
                        $expedition_id = $data_exp->id;
                        if($rowsexp == 0) {
                            $sqlstr="insert into expedition (name, active) values('$expedition', 1)";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();

                            //get last ID
                            $sqlstr="select last_insert_id() id";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                            $data   = $sql->fetch(PDO::FETCH_OBJ);
                            $expedition_id    = $data->id;
                        }

                        //--------sales
                        $strclient = "select ref from sales_invoice where ref2='$ref2' limit 1 ";
                        $sqlclient=$dbpdo->prepare($strclient);
                        $sqlclient->execute();
                        $rowssales = $sqlclient->rowcount();
                        $datasales = $sqlclient->fetch(PDO::FETCH_OBJ);
                        $ref = $datasales->ref;

                        if($rowssales == 0) {
                            $id_user = $_SESSION["id_user"];
                            $ref=notran($date, 'frmpos', '', '', $id_user); //---get no ref

                            $status = "Paid";
                            $paid = 1;
                            $sqlstr = "insert into sales_invoice (ref, ref2, date, status, client_code, ship_to, receipt_type, bank_account, paid, channel_id, employee_id, expedition_id, note_transfer, freight_cost, uid, dlu) values ('$ref', '$ref2', '$date', '$status', '$client_code', '$address', '$receipt_type', '$bank_account', '$paid', '$channel_id', '$employee_id', '$expedition_id', '$note_transfer', '$freight_cost', '$uid', '$dlu')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                            notran($date, 'frmpos', 1, '', $id_user) ;

                            $insert++;
                        } else {
                            $sqlstr = "update sales_invoice set date='$date', ship_to='$address', bank_account='$bank_account', channel_id='$channel_id', employee_id='$employee_id', expedition_id='$expedition_id', note_transfer='$note_transfer', freight_cost='$freight_cost', uid='$uid', dlu='$dlu' where ref='$ref'";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();

                            $update++;
                        }
                       

                        //----------sales_invoice_detail----------
                        if($item_name != "" && $qty > 0) {
                            $item_name = preg_replace("/[^a-zA-Z]/", " ", $item_name);
                            //echo $item_name.'<br>';
                            $strclient = "select syscode from item where code='$itemcode' limit 1 ";
                            $sqlclient=$dbpdo->prepare($strclient);
                            $sqlclient->execute();
                            $rowsitem = $sqlclient->rowcount();
                            $dataitem = $sqlclient->fetch(PDO::FETCH_OBJ);
                            $item_code = $dataitem->syscode;
                            if($rowsitem == 0) {
                                $code= $itemcode; //notran($date, 'frmitem', '', '', ''); 
                                $syscode        =   random(25);

                                $old_code       =   $code;
                                $name           =   $item_name;
                                $item_group_id  =   0;
                                $item_subgroup_id   =  0;
                                $item_type_code     =  '';
                                $item_category_id   =  0;
                                $brand_id           =  0;
                                $size_id            =  '';
                                $uom_code_stock     =  'pcs';
                                $uom_code_sales     =   'pcs';     
                                $uom_code_purchase  =   $uom_code_sales;
                                $minimum_stock      =   0;
                                $maximum_stock      =   0;          
                                $consigned      =   0;
                                $balance        =   0;
                                $description    =   '';
                                $active         =   1;

                                $sqlstr="insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, balance, description, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$balance', '$description', '$active', '$uid', '$dlu', '$syscode')";
                                $sql=$dbpdo->prepare($sqlstr);
                                $sql->execute();
                                //notran($date, 'frmitem', 1, '', '') ; 

                                $item_code = $syscode;
                            }

                            //----insert sales_invoice_detail
                            $strclient = "select ref from sales_invoice_detail where ref='$ref' and item_code='$item_code' limit 1 ";
                            $sqlclient=$dbpdo->prepare($strclient);
                            $sqlclient->execute();
                            $rowsdet = $sqlclient->rowcount();
                            if($rowsdet == 0) {
                                $so_ref     =   '';
                                $uom_code   =   'pcs';
                                if($discount > 0) {
                                    $discount3  =   ($discount/$unit_price) * 100;  
                                } else {
                                    $discount3 = 0;
                                }
                                $non_discount   = 0;
                                $unit_cost      = 0;
                                $amount_cost    = 0;
                                $so_line        = 0;

                                $line = maxline('sales_invoice_detail', 'line', 'ref', $ref, '');
                    
                                $sqlstr="insert into sales_invoice_detail (ref, so_ref, item_code, uom_code, qty, discount, discount3, unit_price, amount, non_discount, unit_cost, amount_cost, line_item_so, line) values ('$ref', '$so_ref', '$item_code', '$uom_code', '$qty', '$discount', '$discount3', '$unit_price', '$amount', '$non_discount', '$unit_cost', '$amount_cost', '$so_line', '$line')";
                                $sql1=$dbpdo->prepare($sqlstr);
                                $sql1->execute();
                            }
                        }

                        
                        //--update total sales
                        $sqlstr = "select sum(amount) grand_total from sales_invoice_detail where ref='$ref' group by ref";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute(); 
                        $data_detail = $sql->fetch(PDO::FETCH_OBJ);
                        $grand_total = numberreplace($data_detail->grand_total);

                        $sqlstr = "update sales_invoice set total='$grand_total' where ref='$ref'";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute();    
                        
                    }          
                                
                }
                
                $x++;
                
            }
        }
        
        
    }
?>    

<table align="center" style="font-size: 36px; color: #07581c">
    <tr>
        <td><?php echo "Jumlah Tambah Data : " . $insert; ?></td>
    </tr>
    <tr>
        <td><?php echo "Jumlah Update Data : " . $update; ?></td>
    </tr>
</table>

<?php    
}
?>



