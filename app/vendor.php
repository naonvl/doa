<script language="javascript">
<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='code') {
            alert('Supplier Code cannot empty!');               
          }
          
          if (document.getElementById(arrf[i]).name=='name') {
            alert('Supplier Name cannot empty!');               
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
            
            //jika saat add data, maka data setelah save kosong
            if ($_POST['submit'] == 'Save') { $ref = ''; }
            //-----------------------------------------------/\
                
            $ref2 = notran(date('Y-m-d'), 'frmvendor', '', '', ''); 
                        
            include("app/exec/vendor_insert.php"); 

            $active = "checked";
            if ($ref != "") {
                $sql=$select->list_vendor($ref);
                $row_vendor=$sql->fetch(PDO::FETCH_OBJ);    
                
                $ref2       =   $row_vendor->code;      
                $active     =   "";
                if($row_vendor->active == 1) {
                    $active = "checked";
                }
            }           
        ?>

        <form class="row" role="form" action="" method="post" name="vendor" id="vendor" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('code,name');" >

            <input type="hidden" id="syscode" name="syscode" value="<?php echo $ref ?>" >

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tambah Vendor</h5>
                        </div>
                        <div class="card-body">
                            <!-- FORM KIRI -->
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Kode</label>
                                <div class="col-10">
                                    <input type="text" id="code" name="code" readonly="" class="form-control" value="<?php echo $ref2 ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Nama<span class="required">*</span></label>
                                <div class="col-10">
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $row_vendor->name ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Tipe Vendor</label>
                                <div class="col-8">
                                    <select class="destroy-selector" id="vendor_type" name="vendor_type">
                                        <option value=""></option>
                                        <?php
                                            combo_select_active("vendor_type","id","name","active","1",$row_vendor->vendor_type)
                                        ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button style="height: 35px;padding: 0.5rem 1rem;" class="btn btn-primary me-2" id="js-programmatic-enable">+</button>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Alamat Lengkap<span class="required">*</span></label>
                                <div class="col-10">
                                    <textarea class="form-control" placeholder="Alamat Lengkap" id="address" name="address"><?php echo $row_vendor->address ?></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Telepon<span class="required">*</span></label>
                                <div class="col-10">
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="+62" value="<?php echo $row_vendor->phone ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Active</label>
                                <div class="col-10">
                                    <input id="active" name="active" type="checkbox" class="form-check-input" value="1" <?php echo $active ?> >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Updated by</label>
                                <div class="col-10">
                                    <input type="text" id="uid" name="uid" readonly class="form-control" placeholder="+62" value="<?php echo $row_vendor->uid ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Last Update</label>
                                <div class="col-10">
                                    <input type="text" id="dlu" name="dlu" readonly class="form-control" placeholder="+62" value="<?php echo $row_vendor->dlu ?>">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row" style="justify-content: flex-end;">
                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="submit" id="submit" class="btn btn-success me-6" style="margin: auto;width: 100%;color: white;" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('vendor_view') ?>'" />
                                </div>
                                <?php if (allowadd('frmvendor') == 1) { ?>
                                    <?php if ($ref == '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Save" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmvendor') == 1) { ?>
                                    <?php if ($ref != '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"> <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Update" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmvendor') == 1) { ?>
                                    <?php if ($ref != '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"> <input type="submit" name="submit" class="btn btn-danger me-6" style="margin: auto;width: 100%;color: white;" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')"></div>
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