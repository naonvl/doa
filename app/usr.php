<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='usrid') {
            alert('User ID tidak boleh kosong!');               
          }
          
          /*if (document.getElementById(arrf[i]).name=='employee_id') {
            alert('Employee tidak boleh kosong!');              
          }*/
          
          return false
        } 
                                        
      }      
    }
        
</script>

<script>
    function showPwd(id, el) {
      let x = document.getElementById(id);
      if (x.type === "password") {
        x.type = "text";
        //el.className = 'fa fa-eye-slash showpwd';
        el.className = 'fa fa-fw fa-eye-slash field-icon toggle-password bigger-160'; //tutup
      } else {
        x.type = "password";
        el.className = 'fa fa-fw fa-eye field-icon toggle-password bigger-160'; //terbuka
      }
    }
</script>


<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <form class="row" role="form" action="" method="post" name="usr" id="usr" enctype="multipart/form-data" onSubmit="return cekinput('usrid');" >
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">
                            
                            <?php 
                                $ref = $segmen3; //$_GET['search'];
                                
                                $admx = "";
                                $act = "checked";
                                    
                                include("app/exec/insert_usr.php"); 
                                
                                if ($ref != "") {
                                    $sql=$select->list_usr($ref);
                                    $row_usr=$sql->fetch(PDO::FETCH_OBJ);
                                    
                                    $admx = $row_usr->adm;  
                                    if($admx == 1) {
                                        $admx = "checked";
                                    }
                                    
                                    $act = $row_usr->act;   
                                    if($act == 1) {
                                        $act = "checked";
                                    }

                                    $photo = $row_usr->photo;
                                }   
                                
                            ?>


                            <input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >
                            <input type="hidden" id="old_usrid" name="old_usrid" value="<?php echo $row_usr->usrid ?>" >


                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">User ID<span class="required">*</span></label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="<?php echo $row_usr->usrid ?>" id="usrid" name="usrid">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Karyawan<span class="required">*</span></label>
                                        <div class="col-10">
                                            <select class="destroy-selector" id="employee_id" name="employee_id">
                                                <option value=""></option>
                                                <?php select_employee($row_usr->employee_id)  ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Photo<span class="required">*</span></label>
                                        <div class="col-10">
                                            <input type="file" id="photo" name="photo" />
                                            <?php if (!empty($photo)) { ?>
                                                <a href="<?php echo $__folder ?>app/photo_usr/<?php echo $photo ?>" rel="lightbox" style="text-decoration:none;" title="Photo View">
                                                    <label>
                                                        <img src="<?php echo $__folder ?>/app/photo_usr/<?php echo $photo; ?>" width="150" height="150" />
                                                    </label>
                                                </a>
                                            <?php } ?>
                                            <input type="hidden" id="photo2" name="photo2" value="<?php echo $photo; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Password<span class="required">*</span></label>
                                        <div class="col-8">
                                            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" value="<?php echo $row_usr->pwdori ?>" >
                                        </div>
                                        <div class="col-2">
                                            <span style="padding-top: 7px" onClick="showPwd('pwd', this)" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Updated by</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" readonly value="<?php echo $row_usr->uid ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label" style="margin-right: 10px;">Administrator</label>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input id="adm" name="adm" type="checkbox" class="form-check-input" value="1" <?php echo $admx ?> >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Date Last Update</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" readonly value="<?php echo $row_usr->dlu ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label" style="margin-right: 10px;">Active</label>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input id="act" name="act" type="checkbox" class="form-check-input" value="1" <?php echo $act ?> >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <?php if ($ref == '') { ?>
                            <?php include('usr_detail.php') ?>
                        <?php } else { ?>
                            <?php include('usr_detail_update.php') ?>
                        <?php } ?>

                        <div class="card-footer">
                            <div class="row" style="justify-content: flex-end;">
                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="submit" id="submit" class="btn btn-success me-6" style="margin: auto;width: 100%;color: white;" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('usr_view') ?>'" />
                                </div>
                                <?php if (allowadd('frmusr') == 1) { ?>
                                    <?php if ($ref == '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Save" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmusr') == 1) { ?>
                                    <?php if ($ref != '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"> <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Update" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmusr') == 1) { ?>
                                    <?php if ($ref != '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"> <input type="submit" name="submit" class="btn btn-danger me-6" style="margin: auto;width: 100%;color: white;" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')"></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>

                </div>
                </div>


                <!-- </div> -->

        </form>

    </div>
</div>