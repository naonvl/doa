<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('usr_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
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
                        $delete2->delete_usr($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('usr_view'); ?>" />
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
                                        <th class="center" style="font-weight:bold ">User ID &nbsp;&nbsp;</th>
                                        <th class="center" style="font-weight:bold ">Administrator &nbsp;&nbsp;</th>
                                        <th class="center" style="font-weight:bold ">Aktif &nbsp;&nbsp;</th>
                                        <th class="center" style="font-weight:bold ">User Update &nbsp;&nbsp;</th>
                                        <th class="center" style="font-weight:bold ">Date Last Update &nbsp;&nbsp;</th>
                                        <th>Edit|Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $sql=$select->list_usr();
                                        while($usr_view=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                            $i++;
                                    ?>
                                                
                                            <tr >
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $usr_view->usrid ?></td>
                                                <td>
                                                    <?php if ($usr_view->adm == 1) { ?>
                                                        <button class="btn btn-xs btn-success">
                                                            <i class="ace-icon fa fa-check bigger-120"></i>
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($usr_view->act == 1) { ?>
                                                        <button class="btn btn-xs btn-success">
                                                            <i class="ace-icon fa fa-check bigger-120"></i>
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $usr_view->uid ?></td>
                                                <td><?php echo $usr_view->dlu ?></td>
                                                <td align="center">
                                                
                                                    <?php if (allowupd('frmusr')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('usr') ?>/<?php echo $usr_view->id ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmusr')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $usr_view->id ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
