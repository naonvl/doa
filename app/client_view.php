<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('client_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<?php
    $client_type    = $_POST['client_type'];
    $client_id      = $_POST['client_id'];
    $kabupaten      = $_POST['kabupaten'];
    $all            = $_POST['all'];
    
    $all2 = "";
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
                        $delete2->delete_client($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('client_view'); ?>" />
                <?php
                        
                        
                    }
                ?>
                            
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="row" role="form" action="" method="post" name="client_view" id="client_view" class="form-horizontal" enctype="multipart/form-data" >

                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label class="col-2 col-form-label">Tipe Customer</label>
                                            <div class="col-10">
                                                <select class="destroy-selector" id="client_type" name="client_type">
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("client_type","id","name","active","1",$client_type) 
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">

                                        <div class="mb-3 row">
                                            <label class="col-2 col-form-label">Kota</label>
                                            <div class="col-10">
                                                <select class="destroy-selector" id="kabupaten" name="kabupaten">
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("kota","syscode","nama","aktif","1",$kabupaten) 
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
                                        <th>No.</th>
                                        <th>Titel</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Active</th>
                                        <th>Edit|Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $i = 0;
                                        $sql=$select->list_client($client_id, $all, '', $client_type, $kabupaten);
                                        while($row_client=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                        $i++;
                                            
                                    ?>
                                                
                                            <tr>
                                                <td><?php echo $i ?></td> 
                                                <td><?php echo $row_client->title ?></td>
                                                <td><?php echo $row_client->name ?></td>
                                                <td><?php echo $row_client->email ?></td>
                                                <td><?php echo $row_client->phone ?></td>
                                                <td align="center">
                                                    <?php if ($row_client->active == 1) { ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php } ?>
                                                </td>
                                                <td align="center">
                                                
                                                    <?php if (allowupd('frmclient')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('client') ?>/<?php echo $row_client->syscode ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmclient')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_client->syscode ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
