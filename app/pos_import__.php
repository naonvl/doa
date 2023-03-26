<?php
    @session_start();

    if (($_SESSION["logged"] == 0)) {
        echo 'Access denied';
        exit;
    }

    include_once ("../import/excel_reader2.php");

    function dateFormat($date)
    {
        $m = preg_replace('/[^0-9]/', '', $date);
        if (preg_match_all('/\d{2}+/', $m, $r)) {
            $r = reset($r);
            if (count($r) == 4) {
                if ($r[2] <= 12 && $r[3] <= 31) return "$r[0]$r[1]-$r[2]-$r[3]"; // Y-m-d
                if ($r[0] <= 31 && $r[1] != 0 && $r[1] <= 12) return "$r[2]$r[3]-$r[1]-$r[0]"; // d-m-Y
                if ($r[0] <= 12 && $r[1] <= 31) return "$r[2]$r[3]-$r[0]-$r[1]"; // m-d-Y
                if ($r[2] <= 31 && $r[3] <= 12) return "$r[0]$r[1]-$r[3]-$r[2]"; //Y-m-d
            }

            $y = $r[2] >= 0 && $r[2] <= date('y') ? date('y') . $r[2] : (date('y') - 1) . $r[2];
            if ($r[0] <= 31 && $r[1] != 0 && $r[1] <= 12) return "$y-$r[1]-$r[0]"; // d-m-y
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <script language="javascript">
        function cekinput(fid) {  
          var arrf = fid.split(',');
          for(i=0; i < arrf.length; i++) {
            if(document.getElementById(arrf[i]).value=='') {       
              
              if (document.getElementById(arrf[i]).name=='userfile') {
                alert('File Excel masih kosong!');              
              }
              
              return false
            } 
                                            
          }     
          
           
        }
            
    </script>
    
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="../images/favicon.png" />
    <link href="../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>
    <?php
        //include_once ("include/queryfunctions.php");
        include_once ("include/sambung.php");
        include_once ("include/functions.php");
        //include_once ("include/inword.php");

    ?>
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        
        
        <!--**********************************
            Content body start
        ***********************************-->
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <form class="form-horizontal" role="form" action="" method="post" name="client_import" id="client_import" enctype="multipart/form-data" onSubmit="return cekinput('userfile');" >
                                            <tbody>
                                                <tr>
                                                    <td class="left">Upload File</td>
                                                    <td class="left"><input type="file" name="userfile" id="userfile" accept=".xls"></td>
                                                </tr>
                                                <tr>
                                                    <td class="left" colspan="2"><input type="submit" name="submit" id="submit" class='btn btn-primary' value="Upload" /></td>
                                                </tr>
                                            </tbody>
                                        </form>

                                        <?php
                                            
                                            if($_POST["submit"] == 'Upload') {

                                                // membaca file excel yang diupload
                                                $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

                                                // membaca jumlah baris dari data excel
                                                $baris = $data->rowcount($sheet_index=0);

                                                // nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
                                                $sukses = 0;
                                                $gagal = 0;

                                                date_default_timezone_set('Asia/Jakarta');
                                            
                                                $dbpdo = DB::create();

                                                        
                                                //$date   =   date('Y-m-d');

                                                $uid    =   'import_'.$_SESSION['loginname'];
                                                $dlu    =   date("Y-m-d H:i:s");

                                                for ($i=2; $i<=$baris; $i++)
                                                {    
                                                            
                                                    //if($x >= 0) {
                                                        
                                                        $ref2           =   trim($data->val($i, 1));
                                                        $date           =   date('Y-m-d', strtotime($data->val($i, 2)));
                                                        $client_name    =   trim(petikreplace($data->val($i, 3)));
                                                        $address        =   trim(petikreplace($data->val($i, 4))); 
                                                        $phone          =   trim(petikreplace($data->val($i, 5))); 
                                                        $receipt_type   =   trim(petikreplace($data->val($i, 6))); 
                                                        $bank_account   =   trim(petikreplace($data->val($i, 7)));
                                                        $bank_name      =   trim(petikreplace($data->val($i, 8)));

                                                        //barang---------
                                                        $item_name      =   trim(petikreplace($data->val($i, 9)));
                                                        $qty            =   numberreplace($data->val($i, 10));
                                                        $unit_price     =   numberreplace($data->val($i, 11));
                                                        $discount       =   numberreplace($data->val($i, 12));
                                                        $amount         =   numberreplace(trim($data->val($i, 13)));
                                                        
                                                        if($ref2 != "" && $client_name != "") {
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

                                                            //--------sales
                                                            $strclient = "select ref from sales_invoice where ref2='$ref2' limit 1 ";
                                                            $sqlclient=$dbpdo->prepare($strclient);
                                                            $sqlclient->execute();
                                                            $rowssales = $sqlclient->rowcount();
                                                            $datasales = $sqlclient->fetch(PDO::FETCH_OBJ);
                                                            $ref = $datasales->ref;

                                                            if($rowssales == 0) {
                                                                //$id_user = $_SESSION["id_user"];
                                                                $ref=notran($date, 'frmpos', '', '', ''); //---get no ref
                                                                $sqlstr = "insert into sales_invoice (ref, ref2, date, status, client_code, ship_to, receipt_type, bank_account, uid, dlu) values ('$ref', '$ref2', '$date', 'R', '$client_code', '$address', '$receipt_type', '$bank_account', '$uid', '$dlu')";
                                                                $sql=$dbpdo->prepare($sqlstr);
                                                                $sql->execute();
                                                                notran($date, 'frmpos', 1, '', '') ;

                                                                $insert++;
                                                            }

                                                            //----------sales_invoice_detail----------
                                                            if($item_name != "" && $qty > 0) {
                                                                $strclient = "select syscode from item where name='$item_name' limit 1 ";
                                                                $sqlclient=$dbpdo->prepare($strclient);
                                                                $sqlclient->execute();
                                                                $rowsitem = $sqlclient->rowcount();
                                                                $dataitem = $sqlclient->fetch(PDO::FETCH_OBJ);
                                                                $item_code = $dataitem->syscode;
                                                                if($rowsitem == 0) {
                                                                    $code=notran($date, 'frmitem', '', '', ''); 
                                                                    $syscode        =   random(25);

                                                                    $old_code       =   '';
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
                                                                    notran($date, 'frmitem', 1, '', '') ; 

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
                                                        }
                                                        
                                                    //}
                                                    
                                                    $x++;
                                                
                                                }

                                            ?>    


                                            <tr>
                                                <td><?php echo "Jumlah Proses Data : " . $insert; ?></td>
                                            </tr>
                                        <?php    
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <!--**********************************
            Content body end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
    <script src="../vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/dlabnav-init.js"></script>
    <script src="../js/demo.js"></script>
    <script src="../js/styleSwitcher.js"></script>
</body>

<!-- Mirrored from travl.dexignlab.com/xhtml/ecom-invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Dec 2021 15:45:41 GMT -->
</html>