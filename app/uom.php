<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='code') {
            alert('UoM Code cannot empty!');                
          }
          
          if (document.getElementById(arrf[i]).name=='name') {
            alert('UoM Name cannot empty!');                
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
            $ref = $segmen3;
                        
            include("app/exec/uom_insert.php"); 
            
            $active = "checked";
            if ($ref != "") {
                $sql=$select->list_uom($ref);
                $row_uom=$sql->fetch(PDO::FETCH_OBJ);        

                $active = "";
                if($row_uom->active == 1) {
                    $active = "checked";
                }                
            }       
        ?>

        <form class="form-horizontal" action="" method="post" name="uom" id="uom" enctype="multipart/form-data" onSubmit="return cekinput('code,name');" >

            <input type="hidden" id="old_code" name="old_code" value="<?php echo $ref ?>" >

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <!-- FORM KIRI -->
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Kode Satuan</label>
                                <div class="col-10">
                                    <input type="text" id="code" name="code" class="form-control" value="<?php echo $row_uom->code ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Nama Satuan</label>
                                <div class="col-10">
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $row_uom->name ?>">
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
                                    <input type="text" class="form-control" placeholder="Admin" readonly value="<?= $row_uom->uid ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Last Update</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" value="2018-11-23" readonly value="<?= $row_uom->dlu ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-offset-3 col-md-9" style="text-align: right;">
                                <input type="button" name="submit" id="submit" class="btn btn-success me-6" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'.obraxabrix('uom_view') ?>'" />
                                <?php if (allowadd('frmuom')==1) { ?>
                                    <?php if($ref=='') { ?>
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Save" />
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmuom')==1) { ?>
                                    <?php if($ref!='') { ?>
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Update" />
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmuom')==1) { ?>
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