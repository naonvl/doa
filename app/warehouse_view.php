<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('warehouse_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<script>
    function print_barcode(ref) {
        window.open('<?php echo $__folder ?>app/warehouse_qrcode.php?ref='+ref, 'QR Code Print','450','450','resizable=1,scrollbars=1,status=0,toolbar=0')
    }
</script>

<?php

$id                   =    $_REQUEST['id'];
$all                  =    $_REQUEST['all'];

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
                        $delete2->delete_warehouse($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('warehouse_view'); ?>" />
                <?php
                        
                        
                    }
                ?>
                            
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="row" role="form" action="" method="post" name="client_view" id="client_view" class="form-horizontal" enctype="multipart/form-data" >

                                    <div class="col-6 mb-3">
                                        <div class="mb-3 row">
                                            <label class="col-2 col-form-label">Nama Gudang</label>
                                            <div class="col-8">
                                                <select class="destroy-selector" id="id" name="id">
                                                    <option value=""></option>
                                                    <?php
                                                        populate_select("warehouse","id","name",$id)
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check custom-checkbox mb-3">
                                            <input id="all" name="all" type="checkbox" class="form-check-input" value="1" <?php echo $all2 ?> >
                                            <label class="form-check-label" for="preview-semua">Semua</label>
                                        </div>
                                    </div>
                                    <div class="col-2 offset-5 ">
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
                                    </div>
                                    
                                </form>
                            </div>
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
                                        <th>ID</th>
                                        <th>Kode</th>
                                        <th>Nama Gudang</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Active</th>
                                        <th>Edit|Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $sql=$select->list_warehouse($id, $all);
                                        while($row_warehouse=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                            $i++;
                                            
                                    ?>
                                                
                                            <tr>
                                                <td align="center"><?php echo $i ?></td>
                                                <td><?php echo $row_warehouse->id ?></td>
                                                <td><?php echo $row_warehouse->code ?></td>
                                                <td><?php echo $row_warehouse->name ?></td>
                                                <td><?php echo $row_warehouse->address ?></td>
                                                <td><?php echo $row_warehouse->email ?></td>
                                                <td><?php echo $row_warehouse->phone ?></td>
                                                <td>
                                                    <?php if ($row_warehouse->active == 1) { ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php } ?>
                                                </td>
                                                <td align="center">
                                                
                                                    <?php if (allowupd('frmwarehouse')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('warehouse') ?>/<?php echo $row_warehouse->id ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmwarehouse')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_warehouse->id ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
