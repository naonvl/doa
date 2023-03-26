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

    $dbpdo = DB::create();
?>

<!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal" role="form" action="" method="post" name="stock_opname" id="stock_opname" enctype="multipart/form-data" >
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload File</label>
        <div class="col-sm-3">
            <input type="file" name="file" id="file" accept=".csv">
        </div>
    </div>
    
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
        $cekcolumn1 = fgetcsv($filecek, 20000, ";");
        $datacol = $cekcolumn1[0];
        //----------------------
        
        if (preg_match("/,/",$datacol) == 0) {
            $file = fopen($fileName, "r");
            $column = fgetcsv($file, 20000, ";");
        } 
        //echo $datacol;
        if (preg_match("/,/",$datacol) == 1) {
            $file = fopen($fileName, "r");
            $column = fgetcsv($file, 20000, ",");
        }
        
        date_default_timezone_set('Asia/Jakarta');

        $jmlnilai = 0;
        $x = 0;
        $insert = 0;
        $update = 0;

        print_r($column);
        
        if (preg_match("/,/",$datacol) == 0) {
            
            $syscode            =   random(25);
            while (($column = fgetcsv($file, 20000, ";")) !== FALSE) {
                
                if($x >= 0) {
                   
                    if($x == 0) {
                        $date           = str_replace("/","-",$column[1]);
                        $date           =   date('Y-m-d', strtotime($date));
                        $location_id=   numberreplace($column[3]);
                    } else if($x > 1) {
                        $item_code      =   petikreplace($column[1]);
                        $uom_code       =   petikreplace($column[3]);
                        $qty            =   numberreplace($column[5]);
                        $unit_cost      =   numberreplace($column[6]);
                    }
                    
                    $uid            =   $_SESSION["loginname"];
                    $dlu            =   date("Y-m-d H:i:s");

                    echo $x.'>>'.$date.'>>'.$item_code.'>>'.$uom_code.'>>'.$qty.'>>'.'<br>';
                    /*if($item_code != "") {
                        $sqlstr = "select syscode from item where code='$item_code'";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute();
                        $data = $sql->fetch(PDO::FETCH_OBJ);
                        $item_code = $data->syscode;
                        
                        $ref = notran($date, 'frmstock_opname', 0, '', '') ; //----eksekusi ref

                        $sqlcek = "select ref, syscode from stock_opname where ref='$ref' and location_id='$location_id' limit 1";
                        $sql=$dbpdo->prepare($sqlcek);
                        $sql->execute();
                        $rows = $sql->rowCount();
                        $data = $sql->fetch(PDO::FETCH_OBJ);
                                
                        if($rows == 0) {
                            $sqlstr="insert into stock_opname (ref, date, location_id, bin, uid, beginning_balance, memo, dlu, syscode) values('$ref', '$date', '$location_id', '1', '$uid', '0', '', '$dlu', '$syscode')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                        } else {
                            $syscode = $data->syscode;
                        }

                        //---------detail-------------------
                        $bin = 1;
                        $expired_date   = "00:00:00";                                    
                        if ( !empty($item_code) && !empty($uom_code) ) {                
                            
                            $line = maxline('stock_opname_detail', 'line', 'ref', $ref, '');
                                                
                            $sqlstr = "select qty, unit_cost from stock_opname_detail where ref='$ref' and location_id='$location_id' and item_code='$item_code' and uom_code='$uom_code' limit 1";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                            $rows = $sql->rowCount();
                            $data = $sql->fetch(PDO::FETCH_OBJ);
                            
                            if($rows == 0 && $qty != '') {
                                if ($qty != '') { 
                                    $sqlstr="insert into stock_opname_detail (ref, date, location_id, bin, uid, item_code, uom_code, line, qty, unit_cost, expired_date, syscode) values ('$ref', '$date', '$location_id', '$bin', '$uid', '$item_code', '$uom_code', $line, '$qty', '$unit_cost', '$expired_date', '$syscode')";
                                    $sql=$dbpdo->prepare($sqlstr);
                                    $sql->execute();
                                }
                                
                                if ($qty > 0) { //jika plus, maka masuk debit
                                    $amount = $unit_cost * $qty;
                                    
                                    $sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '$qty', 0, '$amount', $line, '$uid', '$dlu')";        
                                    $sql=$dbpdo->prepare($sqlstr);
                                    $sql->execute();
                                } else { //jika minus, maka masuk credit
                                    $amount = ($unit_cost * $qty) * -1;
                                    $qty    = $qty * -1;
                                    
                                    $sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '0', '$qty', '$amount', $line, '$uid', '$dlu')";      
                                    $sql=$dbpdo->prepare($sqlstr);
                                    $sql->execute();
                                }

                                $insert++;
                            } else {
                                $sqlstr="update stock_opname_detail set qty=ifnull(qty,0) + $qty, unit_cost='$unit_cost' where ref='$ref' and location_id='$location_id' and bin='$bin' and uid='$uid' and item_code='$item_code' and uom_code='$uom_code'";
                                $sql=$dbpdo->prepare($sqlstr);
                                $sql->execute();
                                
                                ##bincard update
                                $sqlstr = "delete from bincard where invoice_no='$ref' and item_code='$item_code' and uom_code='$uom_code'";
                                $sql=$dbpdo->prepare($sqlstr);
                                $sql->execute();
                                
                                $sqlstr="select sum(ifnull(qty,0)) qty from stock_opname_detail where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' group by ref, item_code, uom_code ";
                                $sql=$dbpdo->prepare($sqlstr);
                                $sql->execute();
                                $data = $sql->fetch(PDO::FETCH_OBJ);
                                $qty = $data->qty;
                                
                                if ($qty > 0) { //jika plus, maka masuk debit
                                    $amount = $unit_cost * $qty;
                                    
                                    $sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '$qty', 0, '$amount', $line, '$uid', '$dlu')";        
                                    $sql=$dbpdo->prepare($sqlstr);
                                    $sql->execute();
                                } else { //jika minus, maka masuk credit
                                    $amount = ($unit_cost * $qty) * -1;
                                    $qty    = $qty * -1;
                                    
                                    $sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '0', '$qty', '$amount', $line, '$uid', '$dlu')";      
                                    $sql=$dbpdo->prepare($sqlstr);
                                    $sql->execute();
                                }

                                $insert++;
                                
                            }
                            
                        }
                    }*/
                           
                }
                
                $x++;
            }

            //notran($date, 'frmstock_opname', 1, '', '') ; //----eksekusi ref

        }
        
        
        
        /*KOMA*/
        $x = 0;
        if (preg_match("/,/",$datacol) == 1) {

            $syscode            =   random(25);
            while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
                            
                if($x >= 0) {
                    
                    if($x == 0) {
                        $date           = str_replace("/","-",$column[1]);
                        $date           =   date('Y-m-d', strtotime($date));
                        $location_id=   numberreplace($column[3]);
                    } else if($x > 1) {
                        $item_code      =   petikreplace($column[1]);
                        $uom_code       =   petikreplace($column[3]);
                        $qty            =   numberreplace($column[5]);
                        $unit_cost      =   numberreplace($column[6]);
                    }
                    
                    $uid            =   $_SESSION["loginname"];
                    $dlu            =   date("Y-m-d H:i:s");

                    if($item_code != "") {
                        $sqlstr = "select syscode from item where code='$item_code'";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute();
                        $data = $sql->fetch(PDO::FETCH_OBJ);
                        $item_code = $data->syscode;
                        //echo $date.'>>'.$item_code.'>>'.$uom_code.'>>'.$qty.'>>'.$data->syscode.'<br>';

                        $ref = notran($date, 'frmstock_opname', 0, '', '') ; //----eksekusi ref

                        $sqlcek = "select ref, syscode from stock_opname where ref='$ref' and location_id='$location_id' limit 1";
                        $sql=$dbpdo->prepare($sqlcek);
                        $sql->execute();
                        $rows = $sql->rowCount();
                        $data = $sql->fetch(PDO::FETCH_OBJ);
                                
                        if($rows == 0) {
                            $sqlstr="insert into stock_opname (ref, date, location_id, bin, uid, beginning_balance, memo, dlu, syscode) values('$ref', '$date', '$location_id', '1', '$uid', '0', '', '$dlu', '$syscode')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                        } else {
                            $syscode = $data->syscode;
                        }

                        //---------detail-------------------
                        $bin = 1;
                        $expired_date   = "00:00:00";                                    
                        if ( !empty($item_code) && !empty($uom_code) ) {                
                            
                            $line = maxline('stock_opname_detail', 'line', 'ref', $ref, '');
                                                
                            $sqlstr = "select qty, unit_cost from stock_opname_detail where ref='$ref' and location_id='$location_id' and item_code='$item_code' and uom_code='$uom_code' limit 1";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();
                            $rows = $sql->rowCount();
                            $data = $sql->fetch(PDO::FETCH_OBJ);
                            
                            if($rows == 0 && $qty != '') {
                                if ($qty != '') { 
                                    $sqlstr="insert into stock_opname_detail (ref, date, location_id, bin, uid, item_code, uom_code, line, qty, unit_cost, expired_date, syscode) values ('$ref', '$date', '$location_id', '$bin', '$uid', '$item_code', '$uom_code', $line, '$qty', '$unit_cost', '$expired_date', '$syscode')";
                                    $sql=$dbpdo->prepare($sqlstr);
                                    $sql->execute();
                                }
                                
                                if ($qty > 0) { //jika plus, maka masuk debit
                                    $amount = $unit_cost * $qty;
                                    
                                    $sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '$qty', 0, '$amount', $line, '$uid', '$dlu')";        
                                    $sql=$dbpdo->prepare($sqlstr);
                                    $sql->execute();
                                } else { //jika minus, maka masuk credit
                                    $amount = ($unit_cost * $qty) * -1;
                                    $qty    = $qty * -1;
                                    
                                    $sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '0', '$qty', '$amount', $line, '$uid', '$dlu')";      
                                    $sql=$dbpdo->prepare($sqlstr);
                                    $sql->execute();
                                }

                                $insert++;
                            } else {
                                $sqlstr="update stock_opname_detail set qty=ifnull(qty,0) + $qty, unit_cost='$unit_cost' where ref='$ref' and location_id='$location_id' and bin='$bin' and uid='$uid' and item_code='$item_code' and uom_code='$uom_code'";
                                $sql=$dbpdo->prepare($sqlstr);
                                $sql->execute();
                                
                                ##bincard update
                                $sqlstr = "delete from bincard where invoice_no='$ref' and item_code='$item_code' and uom_code='$uom_code'";
                                $sql=$dbpdo->prepare($sqlstr);
                                $sql->execute();
                                
                                $sqlstr="select sum(ifnull(qty,0)) qty from stock_opname_detail where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' group by ref, item_code, uom_code ";
                                $sql=$dbpdo->prepare($sqlstr);
                                $sql->execute();
                                $data = $sql->fetch(PDO::FETCH_OBJ);
                                $qty = $data->qty;
                                
                                if ($qty > 0) { //jika plus, maka masuk debit
                                    $amount = $unit_cost * $qty;
                                    
                                    $sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '$qty', 0, '$amount', $line, '$uid', '$dlu')";        
                                    $sql=$dbpdo->prepare($sqlstr);
                                    $sql->execute();
                                } else { //jika minus, maka masuk credit
                                    $amount = ($unit_cost * $qty) * -1;
                                    $qty    = $qty * -1;
                                    
                                    $sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '0', '$qty', '$amount', $line, '$uid', '$dlu')";      
                                    $sql=$dbpdo->prepare($sqlstr);
                                    $sql->execute();
                                }

                                $insert++;
                                
                            }
                            
                        }
                    }
                           
                }
                
                $x++;
            }

            notran($date, 'frmstock_opname', 1, '', '') ; //----eksekusi ref
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



