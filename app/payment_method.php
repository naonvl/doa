<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
         if (document.getElementById(arrf[i]).name=='name') {
            alert('Payment Method cannot empty!');             
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
                
            include("app/exec/payment_method_insert.php"); 

            $active = 'checked';
            if ($ref != "") {
                $sql=$select->list_payment_method($ref);
                $row_payment_method=$sql->fetch(PDO::FETCH_OBJ);     

                $active = '';     
                if($row_payment_method->active == 1) {
                    $active = 'checked';
                } 
            }       
        ?>

        <form class="row" role="form" action="" method="post" name="payment_method" id="payment_method" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('name');" >

            <input type="hidden" name="id" id="id" value="<?= $ref ?>">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">

                            <div class="col-lg-8 order-lg-1">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="col-5 col-form-label">Jenis Pembayaran</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row_payment_method->name ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="col-4 col-form-label">Active</label>
                                        <input id="active" name="active" type="checkbox" class="form-check-input" value="1" <?php echo $active ?> >
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
                            <?php if (allowadd('frmpayment_method')==1) { ?>
                                <?php if($ref=='') { ?>
                                    <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Save" />
                                <?php } ?>
                            <?php } ?>

                            <?php if (allowupd('frmpayment_method')==1) { ?>
                                <?php if($ref!='') { ?>
                                    <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Update" />
                                <?php } ?>
                            <?php } ?>

                            <?php if (allowdel('frmpayment_method')==1) { ?>
                                <?php if($ref!='') { ?>
                                    <input type="submit" name="submit" class="btn btn-danger me-6" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
                                <?php } ?>
                            <?php } ?>
                            <input type="button" name="submit" id="submit" class="btn btn-success me-6" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('payment_method_view') ?>'" />
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>