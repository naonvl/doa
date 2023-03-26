<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('stock_opname_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<?php

$from_date              =    $_REQUEST['from_date'];
$to_date                =    $_REQUEST['to_date'];
$vendor_code            =    $_REQUEST['vendor_code'];
$location_id            =    $_POST['location_id'];
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
                    $delete = $segmen3;     //$_REQUEST['mxKz'];
                    if ($delete == "xm8r389xemx23xb2378e23") {
                        include 'class/class.delete.php';
                        $delete2=new delete;
                        $delete2->delete_stock_opname($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('stock_opname_view'); ?>" />
                <?php
                        
                        
                    }
                ?>
                   
                            
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form class="form-horizontal" role="form" action="" method="post" name="stock_opname_view" id="stock_opname_view" class="form-horizontal" enctype="multipart/form-data" >

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
                                                <p class="mb-1">Gudang</p>
                                                <select id="location_id" name="location_id" class="chosen-select form-control" >
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("warehouse","id","name","active","1",$location_id)
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
                                        <th><?php if($lng==1) { echo 'Ref'; } else { echo 'Ref. No.'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Location'; } else { echo 'Gudang/Toko'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Updated By'; } else { echo 'Petugas'; } ?></th>                                           <th><?php if($lng==1) { echo 'Date Last Update'; } else { echo 'Terakhir Update'; } ?></th>
                                        <th>Edit|Delete</th>
                                            
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $sql=$select->list_stock_opname("", $from_date, $to_date, $all, $location_id);
                                        while($row_stock_opname=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                                
                                        $i++;
                                    ?>
                                                
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row_stock_opname->ref ?></td>
                                                <td><?php echo $row_stock_opname->date ?></td>
                                                <td><?php echo $row_stock_opname->location_name ?></td>
                                                <td><?php echo $row_stock_opname->uid ?></td>
                                                <td><?php echo $row_stock_opname->dlu ?></td>
                                                
                                                <td align="center">
                                                
                                                    <?php if (allowupd('frmstock_opname')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('stock_opname') ?>/<?php echo $row_stock_opname->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmstock_opname')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_stock_opname->ref ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
