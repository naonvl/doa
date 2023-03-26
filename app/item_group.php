<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='name') {
            alert('Item Group cannot empty!');              
          }
          
          if (document.getElementById(arrf[i]).name=='code') {
            alert('Code cannot empty!');                
          }
          
          return false
        } 
                                        
      }      
    }
        
</script>
            
<script type="text/javascript">
    <!--
    var request;
    var dest;
    
    function loadHTMLPost3(URL, destination, button, getId, getId2){
        dest = destination; 
        str = getId + '=' + document.getElementById(getId).value;
        str2 = getId2 + '=' + document.getElementById(getId2).value;
        
        var str = str + '&button=' + button;
        var str2 = str2 + '&button=' + button;
        var str = str + '&' + str2;
                
        if (window.XMLHttpRequest){
            request = new XMLHttpRequest();
            request.onreadystatechange = processStateChange;
            request.open("POST", URL, true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
            request.send(str);      
        } else if (window.ActiveXObject) {
            request = new ActiveXObject("Microsoft.XMLHTTP");
            if (request) {
                request.onreadystatechange = processStateChange;
                request.open("POST", URL, true);
                request.send();
            }
        }
    }
            
    //-->    
    
</script> 

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <?php 
            $ref = $segmen3; //$_GET['search'];
                            
            include("app/exec/item_group_insert.php"); 
            
            $active = "checked";
            if ($ref != "") {
                $sql=$select->list_item_group($ref);
                $row_item_group=$sql->fetch(PDO::FETCH_OBJ);    

                $active = "";
                if($row_item_group->active == 1) {
                    $active = "checked";    
                }                    
            }    
        ?>

        <form class="row" action="" method="post" name="item_group" id="item_group" enctype="multipart/form-data" onSubmit="return cekinput('code,name');" >

            <input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >
            <input type="hidden" id="syscode" name="syscode" value="<?php echo $ref ?>" >

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <!-- FORM KIRI -->
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Kode</label>
                                <div class="col-10">
                                    <input type="text" id="code" name="code" class="form-control" value="<?php echo $row_item_group->code ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Kelompok Barang</label>
                                <div class="col-10">
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $row_item_group->name ?>">
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
                                    <input type="text" class="form-control" placeholder="Admin" readonly value="<?= $row_item_group->uid ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Last Update</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" value="2018-11-23" readonly value="<?= $row_item_group->dlu ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-offset-3 col-md-9" style="text-align: right;">
                                <input type="button" name="submit" id="submit" class="btn btn-success me-6" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'.obraxabrix('item_group_view') ?>'" />
                                <?php if (allowadd('frmitem_group')==1) { ?>
                                    <?php if($ref=='') { ?>
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Save" />
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmitem_group')==1) { ?>
                                    <?php if($ref!='') { ?>
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Update" />
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmitem_group')==1) { ?>
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