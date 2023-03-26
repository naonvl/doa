<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
         if (document.getElementById(arrf[i]).name=='name') {
            alert('Supplier Type cannot empty!');               
          }
          
          if (document.getElementById(arrf[i]).name=='location_id') {
            alert('Unit cannot empty!');                
          }
          
          return false
        } 
                                        
      }      
    }
        
</script>

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <?php 
            $ref = $segmen3; //$_GET['search'];
                
            include("app/exec/size_insert.php"); 
            
            $active = "checked";
            if ($ref != "") {
                $sql=$select->list_size($ref);
                $row_size=$sql->fetch(PDO::FETCH_OBJ);     

                $active = "";
                if($row_size->active == 1) {
                    $active = "checked";
                }                      
            }       
        ?>

        <form class="row" role="form" action="" method="post" name="size" id="size" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('name');" >

            <input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">

                            <div class="col-lg-8 order-lg-1">
                                <div class="row">                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="col-4 col-form-label">Kode Size</label>
                                        <input type="text" id="code" name="code" class="form-control" value="<?php echo $row_size->code ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="col-4 col-form-label">Nama Size</label>
                                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $row_size->name ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 order-lg-1">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="col-4 col-form-label">Active</label>
                                        <input id="active" name="active" type="checkbox" class="form-check-input" value="1" <?php echo $active ?> >
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="col-4 col-form-label">Updated By</label>
                                        <input type="text" class="form-control" placeholder="Admin" readonly value="<?= $row_size->uid ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 order-lg-1">
                                <div class="row">                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="col-4 col-form-label">Last Update</label>
                                        <input type="text" class="form-control" readonly value="<?= $row_size->dlu ?>" >
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>

                <div class="space-4"></div>
                <div class="col-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="button" name="submit" id="submit" class="btn btn-success me-6" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('size_view') ?>'" />
                            <?php if (allowadd('frmsize')==1) { ?>
                                <?php if($ref=='') { ?>
                                    <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Save" />
                                <?php } ?>
                            <?php } ?>

                            <?php if (allowupd('frmsize')==1) { ?>
                                <?php if($ref!='') { ?>
                                    <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Update" />
                                <?php } ?>
                            <?php } ?>

                            <?php if (allowdel('frmsize')==1) { ?>
                                <?php if($ref!='') { ?>
                                    <input type="submit" name="submit" class="btn btn-danger me-6" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>