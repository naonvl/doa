<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('purchase_inv_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }

    function excel_export() {
        var from_date   =   document.getElementById('from_date').value;
        var to_date     =   document.getElementById('to_date').value;
        var vendor_code =   document.getElementById('vendor_code').value;
        var purchase_type =   document.getElementById('purchase_type').value;
        var all         =   document.getElementById('all').checked;
        if(all == true) { all = 1 }
        if(all == false) { all = 0 }
        document.location.href = "app/purchase_inv_xls.php?from_date="+from_date+"&to_date="+to_date+"&vendor_code="+vendor_code+"&all="+all+"&purchase_type="+purchase_type+"";   
    }
</script>

<?php

$from_date              =    $_REQUEST['from_date'];
$to_date                =    $_REQUEST['to_date'];
$vendor_code            =    $_REQUEST['vendor_code'];
$purchase_type          =    $_POST["purchase_type"];
$all                    =    $_REQUEST['all'];

if($from_date == "") {
    $from_date = date("d-m-Y");
}

if($to_date == "") {
    $to_date = date("d-m-Y");
}

if($all == 1 || $all == true) {
    $all2 = "checked";
}
        
?>

<div class="content-body">
    <div class="container-fluid">                       
        <div class="row">
            <div class="col-xl-12">
                    
                <?php
                    $delete = $segmen3; //$_REQUEST['mxKz'];
                    //$segmen4 = $_REQUEST['id'];
                    if ($delete == "xm8r389xemx23xb2378e23") {
                        include 'class/class.delete.php';
                        $delete2=new delete;
                        $delete2->delete_purchase_inv($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('purchase_inv_view'); ?>" />
                <?php
                        
                        
                    }
                ?>
                            
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form class="form-horizontal" role="form" action="" method="post" name="purchase_view" id="purchase_view" class="form-horizontal" enctype="multipart/form-data" >

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">Dari Tanggal</p>
                                                <input type="text" name="from_date" class="datepicker-default form-control" id="from_date" autocomplete="off" value="<?php echo $from_date ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">s/d Tanggal</p>
                                                <input type="text" name="to_date" class="datepicker-default form-control" id="to_date" autocomplete="off" value="<?php echo $to_date ?>">
                                            </div>
                                        </div>                                
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">Supplier</p>
                                                <select id="vendor_code" name="vendor_code" class="destroy-selector">
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("vendor","syscode","name","active","1",$vendor_code);
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">Jenis Order</p>
                                                <select id="purchase_type" name="purchase_type" class="destroy-selector">
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("purchase_type","id","name","active","1",$purchase_type);
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">All</p>
                                                <input id="all" name="all" type="checkbox" class="form-check-input" value="1" <?php echo $all2 ?> >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
                                                &nbsp;&nbsp;<a href="JavaScript:excel_export()">
                                                    <img src="images/excel.jpg" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                
                    
                <!-- PAGE CONTENT BEGINS -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        
                            <table id="example" class="display">
                                <thead>
                                    <tr>
                                        <th class="center" style="font-weight:bold ">No.</th>
                                        <th><?php if($lng==1) { echo 'Ref No'; } else { echo 'No. Nota'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Vendor'; } else { echo 'Supplier'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Purchase Type'; } else { echo 'Jenis Order'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Payment Type'; } else { echo 'Jenis Bayar'; } ?></th>
                                        <!-- <th><php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Barang'; } ?></th> -->
                                        <th><?php if($lng==1) { echo 'Amount'; } else { echo 'Jumlah'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Tax Amount'; } else { echo 'Jumlah Pajak'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Total'; } else { echo 'Total'; } ?></th>
                                        <th>Edit|Delete</th>
                                            
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $sql=$select->list_purchase_inv($kode, $from_date, $to_date, $vendor_code, $all, $purchase_type);
                                        while($row_purchase_inv=$sql->fetch(PDO::FETCH_OBJ)){
                                                                                        
                                            $tax_amount = ($row_purchase_inv->tax_rate * $row_purchase_inv->amount)/100;
                                            $tax_amount = number_format($tax_amount,2,".",",");
                                            $sub_total = $row_purchase_inv->amount;
                                            $total = $sub_total + numberreplace($tax_amount);
                                            
                                            if($row_purchase_inv->payment_type == "Transfer") {
                                                $payment_type = "Transfer";
                                            }
                                            if($row_purchase_inv->payment_type == "Midtrans") {
                                                $payment_type = "Midtrans";
                                            }
                                            if($row_purchase_inv->payment_type == "Kredit") {
                                                $payment_type = "Kredit";
                                            }

                                                
                                        $i++;
                                    ?>
                                                
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row_purchase_inv->ref ?></td>
                                                <td><?php echo $row_purchase_inv->date ?></td>
                                                <td><?php echo $row_purchase_inv->vendor_name ?></td>
                                                <td><?php echo $row_purchase_inv->order_name ?></td>
                                                <td align="right"><?php echo $payment_type ?></td>
                                                <td align="right"><?php echo number_format($sub_total,"2",".",",") ?></td>
                                                <td align="right"><?php echo $tax_amount ?></td>
                                                <td align="right"><?php echo number_format($total,"2",".",",") ?></td>
                                                <td align="center">

                                                    <?php if (allowupd('frmpurchase_inv')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('purchase_inv') ?>/<?php echo $row_purchase_inv->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmpurchase_inv')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_purchase_inv->ref ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                </td>
                                                            
                                            </tr>
                                        
                                        <?php
                                            }
                                        ?>
                                        
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div><!-- /.page-content -->
