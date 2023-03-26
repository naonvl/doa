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
                
            include("app/exec/vendor_type_insert.php"); 
            
            $active = "checked";
            if ($ref != "") {
                $sql=$select->list_vendor_type($ref);
                $row_vendor_type=$sql->fetch(PDO::FETCH_OBJ);     

                $active = "";
                if($row_vendor_type->active == 1) {
                    $active = "checked";
                }                      
            }       
        ?>

        <form class="row" role="form" action="" method="post" name="vendor_type" id="vendor_type" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('name');" >

            <input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tipe Vendor</h5>
                        </div>
                        <div class="card-body">
                            <!-- FORM KIRI -->
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Vendor Type</label>
                                <div class="col-10">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="vendor Type" value="<?php echo $row_vendor_type->name ?>">
                                </div>
                            </div>

                            <div class="mb-12 row">
                                <label class="col-2 col-form-label">Active</label>
                                <div class="col-10">
                                    <input id="active" name="active" type="checkbox" class="form-check-input" value="1" <?php echo $active ?> >
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Updated by</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" placeholder="Admin" readonly value="<?= $row_vendor_type->uid ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Last Update</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" value="2018-11-23" readonly value="<?= $row_vendor_type->dlu ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-offset-3 col-md-9" style="text-align: right;">
                                <input type="button" name="submit" id="submit" class="btn btn-success me-6" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'.obraxabrix('vendor_type_view') ?>'" />
                                <?php if (allowadd('frmvendor_type')==1) { ?>
                                    <?php if($ref=='') { ?>
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Save" />
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmvendor_type')==1) { ?>
                                    <?php if($ref!='') { ?>
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Update" />
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmvendor_type')==1) { ?>
                                    <?php if($ref!='') { ?>
                                        <input type="submit" name="submit" class="btn btn-danger me-6" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>