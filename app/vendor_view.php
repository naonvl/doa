<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('vendor_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

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
                        $delete2->delete_vendor($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('vendor_view'); ?>" />
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
                                        <th>Kode</th>
                                        <th>Supplier</th>
                                        <th>Tipe</th>
                                        <th>Telepon/HP</th>
                                        <th>Alamat</th>
                                        <th>Aktif</th>
                                        <th>Edit|Delete</th>                                            
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $i = 0;
                                        $sql=$select->list_vendor();
                                        while($row_vendor=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                        $i++;
                                            
                                    ?>
                                                
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row_vendor->code ?></td>
                                                <td><?php echo $row_vendor->name ?></td>
                                                <td><?php echo $row_vendor->vendor_type_name ?></td>
                                                <td><?php echo $row_vendor->phone ?></td>
                                                <td><?php echo $row_vendor->address ?></td>
                                                <td>
                                                    <?php if ($row_vendor->active == 1) { ?>
                                                        <button class="btn btn-xs btn-success">
                                                            <i class="ace-icon fa fa-check bigger-120"></i>
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                                <td align="center">
                                                
                                                    <?php if (allowupd('frmvendor')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('vendor') ?>/<?php echo $row_vendor->syscode ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmvendor')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_vendor->syscode ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
