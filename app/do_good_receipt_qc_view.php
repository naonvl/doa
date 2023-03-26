<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('do_good_receipt_qc_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>


<?php

$from_date              =    $_POST['from_date'];
$to_date                =    $_POST['to_date'];
$vendor_code            =    $_POST['vendor_code'];
$status                 =    $_POST["status"];
$so_ref                 =    $_POST["so_ref"];
$all                    =    $_POST['all'];

/*if($from_date == "") {
    $from_date = date("d-m-Y");
}

if($to_date == "") {
    $to_date = date("d-m-Y");
}*/

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
                    
                    if ($delete == "xm8r389xemx23xb2378e23") {
                        include 'class/class.delete.php';
                        $delete2=new delete;
                        $delete2->delete_do_good_receipt_qc($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $__folder ?><?php echo obraxabrix('do_good_receipt_qc_view') ?>" />
                <?php
                        
                        
                    }
                ?>
                            
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form class="form-horizontal" role="form" action="" method="post" name="measuring_size_sewing_view" id="measuring_size_sewing_view" enctype="multipart/form-data" >

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
                                                <p class="mb-1">Vendor</p>
                                                <select id="vendor_code" name="vendor_code" class="destroy-selector">
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("vendor","syscode","name","active","1", $vendor_code)
                                                    ?>
                                                </select>
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
                                        <th style="text-align: center">Edit | Delete</th>
                                        <th><?php if($lng==1) { echo 'Ref No'; } else { echo 'No. Penerimaan'; } ?></th>
                                        <th><?php if($lng==1) { echo 'QC DO No'; } else { echo 'No. QC'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
                                        <th>Status</th>
                                        <th><?php if($lng==1) { echo 'Vendor'; } else { echo 'Vendor'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Status Payment'; } else { echo 'Status Payment'; } ?></th>
                                        <th>Artikel</th>
                                        <th><?php if($lng==1) { echo 'Updated By'; } else { echo 'Diupdate Oleh'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Date Last Update'; } else { echo 'Terakhir edit'; } ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $i = 0;
                                        $sql=$select->list_do_good_receipt_qc($kode, $from_date, $to_date, $vendor_code, $so_ref, $all);
                                        while($row_do_good_receipt_qc=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                            $i++;
                                            
                                            $status = "";
                                            if ($row_do_good_receipt_qc->status == "P") {
                                                $status = "Planned";
                                            }
                                            if ($row_do_good_receipt_qc->status == "R") {
                                                $status = "Released";
                                            }
                                            if ($row_do_good_receipt_qc->status == "G") {
                                                $status = "Counting";
                                            }
                                            if ($row_do_good_receipt_qc->status == "V") {
                                                $status = "Verification";
                                            }
                                            if ($row_do_good_receipt_qc->status == "S") {
                                                $status = "Press";
                                            }
                                            if ($row_do_good_receipt_qc->status == "C") {
                                                $status = "Closed";
                                            }
                                            

                                            $bgcolor = "";
                                            $status_pmt = "";
                                            /*$sqlap = $select->do_sjv_status_payment($row_do_good_receipt_qc->ref);
                                            $data_ap = $sqlap->fetch(PDO::FETCH_OBJ);
                                            $invoice_no = $data_ap->invoice_no;
                                            $amount = numberreplace($data_ap->amount);
                                            if($amount <= 0 && $invoice_no != "") {
                                                $status_pmt = "LUNAS";
                                                $bgcolor = 'style="background-color: green; color: #ffffff"';
                                            } else if($amount == 0 && $invoice_no == "") {
                                                $status_pmt = "BELUM ADA HARGA";
                                            } else {
                                                $status_pmt = number_format($amount,0,'.',',');
                                            }*/

                                            //RDO-1122-00093
                            
                                            $j++;
                                    ?>
                                                
                                            <tr>
                                                <td><?php echo $i ?></td> 
                                                <td align="center">
                                                    <?php if (allowupd('frmdo_good_receipt_qc')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('do_good_receipt_qc') ?>/<?php echo $row_do_good_receipt_qc->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmdo_good_receipt_qc')==1 && $status_pmt != "LUNAS") { ?> 
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_do_good_receipt_qc->ref ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                    
                                                </td>
                                                <td><?php echo $row_do_good_receipt_qc->rcp_ref ?></td>
                                                <td><?php echo $row_do_good_receipt_qc->ref ?></td>
                                                <td><?php echo $row_do_good_receipt_qc->date ?></td>
                                                <td><?php echo $status ?></td>
                                                <td><?php echo $row_do_good_receipt_qc->vendor_name ?></td>
                                                <td <?= $bgcolor ?> align="center"><?php echo $status_pmt ?></td>
                                                <td>
                                                    <table width="100%" border="1" style="border: 1px solid #93d145">
                                                        <tr style="background: #d3fe7a">
                                                            <td align="center">No.</td>
                                                            <td align="center"><?php if($lng==1) { echo 'Item Name'; } else { echo 'Artikel'; } ?></td>
                                                            <td align="center"><?php if($lng==1) { echo 'Qty'; } else { echo 'Qty Good'; } ?></td>
                                                            <td align="center"><?php if($lng==1) { echo 'Qty Damaged'; } else { echo 'Qty Cacat'; } ?></td>
                                                        </tr>
                                                        <?php 
                                                            $x = 0;
                                                            $sql2=$select->list_do_good_receipt_qc_detail($row_do_good_receipt_qc->ref); 
                                                            while($row_do_good_receipt_qc_det=$sql2->fetch(PDO::FETCH_OBJ)) {   
                                                            
                                                            $x++;
                                                        ?>
                                                        <tr style="border: 1px solid #93d145">
                                                            <td align="center"><?php echo $x; ?>.</td>
                                                            <td>&nbsp;<?php echo $row_do_good_receipt_qc_det->item_name ?></td>
                                                            <td align="center"><?php echo number_format($row_do_good_receipt_qc_det->qty,0,".",",") ?></td>
                                                            <td align="center"><?php echo number_format($row_do_good_receipt_qc_det->qty_damaged,0,".",",") ?></td>
                                                        </tr>
                                                        <?php
                                                                
                                                            }
                                                        ?>
                                                        
                                                    </table>
                                                </td>
                                                <td><?php echo $row_do_good_receipt_qc->uid ?></td>
                                                <td><?php echo $row_do_good_receipt_qc->dlu ?></td>
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