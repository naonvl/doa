<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('purchase_inv_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<?php

$from_date              =    $_REQUEST['from_date'];
$to_date                =    $_REQUEST['to_date'];
$vendor_code            =    $_REQUEST['vendor_code'];
$all                    =    $_REQUEST['all'];

if($from_date == "") {
    $from_date = date("d F, Y");
}

if($to_date == "") {
    $to_date = date("d F, Y");
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
                                        <th><?php if($lng==1) { echo 'Due Date'; } else { echo 'Tgl Jatuh Tempo'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Payment Type'; } else { echo 'Jenis Bayar'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Barang'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Receipt'; } else { echo 'Terima'; } ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $sql=$select->get_purchase_inv_outstanding($kode, $from_date, $to_date, $vendor_code, $all);
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
                                                <td><?php echo date('d-m-Y', strtotime($row_purchase_inv->date)) ?></td>
                                                <td><?php echo $row_purchase_inv->vendor_name ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($row_purchase_inv->due_date)) ?></td>
                                                <td align="right"><?php echo $payment_type ?></td>
                                                <td align="center">
                                                    <table class="table table-bordered verticle-middle table-responsive-sm">
                                                        <tr>
                                                            <td align="center">No.</td>
                                                            <td align="center">Nama Barang</td>
                                                            <td align="center">Qty PO</td>
                                                            <td align="center">Qty Diterima</td>
                                                            <td align="center">Qty Sisa</td>
                                                        </tr>
                                                        <?php 
                                                            $sql2=$select->list_purchase_inv_detail($row_purchase_inv->ref); 
                                                            $rowsno=$sql2->rowCount();
                                                            $qty_receipt = 0;
                                                            while($row_purchase_inv_det=$sql2->fetch(PDO::FETCH_OBJ)) { 
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $rowsno; ?>.</td>
                                                            <td><?php echo $row_purchase_inv_det->item_name ?></td>
                                                            <td align="center"><?php echo number_format($row_purchase_inv_det->qty,0,".",",") ?></td>
                                                            <td align="center"><?php echo number_format($row_purchase_inv_det->qty_good,0,".",",") ?></td>
                                                            <td align="center"><?php echo number_format($row_purchase_inv_det->qty - $row_purchase_inv_det->qty_good,0,".",",") ?></td>
                                                            
                                                        </tr>
                                                        <?php
                                                                $rowsno--;
                                                                
                                                                $qty_receipt = $qty_receipt + ($row_purchase_inv_det->qty - $row_purchase_inv_det->qty_good);
                                                            }
                                                        ?>
                                                    </table>
                                                </td>
                                                <td align="center">

                                                    <?php if (allowadd('frmgood_receipt')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('good_receipt') ?>/<?php echo $row_purchase_inv->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
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
