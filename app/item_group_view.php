<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('item_group_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<div class="content-body">
    <div class="container-fluid">                       
        <div class="row">
            <div class="col-xl-12">
                    
                <?php
                    $delete = $segmen3; //$_REQUEST['mxKz'];
                    if ($delete == "xm8r389xemx23xb2378e23") {
                        include 'class/class.delete.php';
                        $delete2=new delete;
                        $delete2->delete_item_group($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('item_group_view'); ?>" />
                        
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
                                        <th>Kelompok Barang</th>
                                        <th>Aktif</th>
                                        <th>Diupdate Oleh</th>
                                        <th>Tanggal Terakhir Update</th>
                                        <th>Edit|Delete</th>                                            
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $sql=$select->list_item_group();
                                        while($row_item_group=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                        $i++;
                                            
                                    ?>
                                                
                                            <tr>
                                                <td align="center"><?php echo $i ?></td>
                                                <td><?php echo $row_item_group->code ?></td>
                                                <td><?php echo $row_item_group->name ?></td>
                                                <td align="center">
                                                    <?php if ($row_item_group->active == 1) { ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $row_item_group->uid ?></td>
                                                <td><?php echo $row_item_group->dlu ?></td>     
                                                <td align="center">
                                                
                                                    <?php if (allowupd('frmitem_group')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('item_group') ?>/<?php echo $row_item_group->id ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmitem_group')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_item_group->id ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
