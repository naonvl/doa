<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('good_receipt_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<?php

$from_date              =    $_REQUEST['from_date'];
$to_date                =    $_REQUEST['to_date'];
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
                        $delete2->delete_good_receipt($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('good_receipt_view'); ?>" />
                <?php
                        
                        
                    }
                ?>
                            
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form class="form-horizontal" role="form" action="" method="post" name="good_receipt_view" id="good_receipt_view" class="form-horizontal" enctype="multipart/form-data" >

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
                                        <th><?php if($lng==1) { echo 'Ref No'; } else { echo 'No. Penerimaan'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Warehouse'; } else { echo 'Lokasi'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Vendor'; } else { echo 'Supplier'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Receipt By'; } else { echo 'Nama Penerima'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Qty'; } else { echo 'Jumlah'; } ?></th>
                                        <th>Edit|Delete</th>
                                            
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $sql=$select->list_good_receipt("", $from_date, $to_date, $all);
                                        while($row_good_receipt=$sql->fetch(PDO::FETCH_OBJ)){
                                                                                        
                                            $status = $row_good_receipt->status;
                                            if($status == "P") {
                                                $status = "Planned";
                                            }
                                            if($status == "R") {
                                                $status = "Released";
                                            }
                                            if($status == "C") {
                                                $status = "Receipt";
                                            }
                                                
                                        $i++;
                                    ?>
                                                
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row_good_receipt->ref ?></td>
                                                <td><?php echo $row_good_receipt->date ?></td>
                                                <td><?php echo $row_good_receipt->location_name ?></td>
                                                <td><?php echo $row_good_receipt->uid ?></td>
                                                <td><?php echo $row_good_receipt->vendor_name ?></td>
                                                <td align="right"><?php echo number_format($row_good_receipt->qty,"0",".",",") ?></td>
                                                <td align="center">

                                                    <?php if (allowupd('frmgood_receipt')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('good_receipt') ?>/<?php echo $row_good_receipt->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmgood_receipt')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_good_receipt->ref ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
