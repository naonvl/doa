<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('vendor_type_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<div class="content-body">
    <div class="container-fluid">                       
        <div class="row">
            <div class="col-xl-12">
                    
                <?php
                    $delete = $segmen3;
                    //$segmen4 = $_REQUEST['id'];
                    if ($delete == "xm8r389xemx23xb2378e23") {
                        include 'class/class.delete.php';
                        $delete2=new delete;
                        $delete2->delete_vendor_type($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('vendor_type_view'); ?>" />
                <?php
                        
                        
                    }
                ?>
                         
                <!-- PAGE CONTENT BEGINS -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        
                            <table id="example" class="display">
                                <thead>
                                    <tr>
                                        <th class="center" style="font-weight:bold ">No.</th>
                                        <th>ID</th>
                                        <th>Supplier Type</th>
                                        <!--<th>Unit</th>-->
                                        <th>Active</th>
                                        <th>Updated by</th>
                                        <th>Date Last Update</th>
                                        <th>Edit|Delete</th>                                            
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $i = 0;
                                        $sql=$select->list_vendor_type();
                                        while($row_vendor_type=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                        $i++;
                                            
                                    ?>
                                                
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row_vendor_type->id ?></td>
                                                <td><?php echo $row_vendor_type->name ?></td>
                                                <!--<td><?php echo $row_vendor_type->w_name ?></td>-->
                                                <td>
                                                    <?php if ($row_vendor_type->active == 1) { ?>
                                                        <button class="btn btn-xs btn-success">
                                                            <i class="ace-icon fa fa-check bigger-120"></i>
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $row_vendor_type->uid ?></td>
                                                <td><?php echo $row_vendor_type->dlu ?></td>
                                                <td align="center">
                                                
                                                    <?php if (allowupd('frmvendor_type')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('vendor_type') ?>/<?php echo $row_vendor_type->id ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmvendor_type')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_vendor_type->id ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
