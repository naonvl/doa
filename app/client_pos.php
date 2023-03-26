<script type="text/javascript" src="../<?php echo $__folder ?>js/buttonajax.js"></script>

<?php
    @session_start();

    if (($_SESSION["logged"] == 0)) {
        echo 'Access denied';
        exit;
    }

    include_once ("include/queryfunctions.php");
    include_once ("include/functions.php");
    include_once ("include/inword.php");

    include 'class/class.select.php';

    $select = new select;

?>

<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='code') {
            alert('Client Code cannot empty!');             
          }
          
          if (document.getElementById(arrf[i]).name=='name') {
            alert('Client Name cannot empty!');             
          }
          
          
          return false
        } 
                                        
      }      
    }
        
</script>

<script type="text/javascript">
    var request;
    var dest;
    
    function loadHTMLPost2(URL, destination, button, getId){
        dest = destination; 
        str = getId + '=' + document.getElementById(getId).value;       
        //str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
        var str = str + '&button=' + button;
        
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
     
</script>

<script>
    function closeWin() {
        self.close();   // Closes the new window
    }
</script>

<link href="../<?php echo $__folder ?>vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
<link href="../<?php echo $__folder ?>vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="../<?php echo $__folder ?>vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="../<?php echo $__folder ?>vendor/pickadate/themes/default.css">
<link rel="stylesheet" href="../<?php echo $__folder ?>vendor/pickadate/themes/default.date.css">
<!-- Style css -->
<link href="../<?php echo $__folder ?>vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="../<?php echo $__folder ?>vendor/select2/css/select2.min.css">
<link href="../<?php echo $__folder ?>vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
<link href="../<?php echo $__folder ?>css/style.css" rel="stylesheet">

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <?php 
            $ref = $segmen3; //$_GET['search'];
            
            //jika saat add data, maka data setelah save kosong
            if ($_POST['submit'] == 'Save') { $ref = ''; }
            //-----------------------------------------------/\
                
            $ref2 = notran(date('Y-m-d'), 'frmclient', '', '', ''); 
                
            include("../app/exec/client_pos_insert.php"); 
            
            $active = "checked";
            if ($ref != "") {
                $sql=$select->list_client($ref);
                $row_client=$sql->fetch(PDO::FETCH_OBJ);    
                
                $ref2   =   $row_client->code;      

                $active = "";
                if($row_client->active == 1) {
                    $active = "checked";
                }
            }       
        ?>

        <form class="row" role="form" action="" method="post" name="client" id="client" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('code,name');" >

            <input type="hidden" name="syscode" id="syscode" value="<?= $ref ?>">

            <div class="row">
                <div class="col-12">
                    <div class="card" style="height: 300px">
                        <div class="card-header">
                            <h5>Personal Details</h5>
                        </div>
                        <div class="card-body row">
                            <!-- FORM KIRI -->
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Kode</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="code" name="code" value="<?php echo $ref2 ?>"" readonly>

                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Titel</label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="title" name="title">
                                            <option value=""></option>
                                            <?php select_title($row_client->title) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="name" name="name" value="<?php echo $row_client->name ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Email</label>
                                    <div class="col-10">
                                        <input class="form-control" type="email" placeholder="Email" value="<?php echo $row_client->email ?>" id="email" name="email">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Phone</label>
                                    <div class="col-10">
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+62" value="<?php echo $row_client->phone ?>" >
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Tipe Customer<span class="required">*</span></label>
                                    <div class="col-8">
                                        <select class="destroy-selector" id="client_type" name="client_type">
                                            <option value=""></option>
                                            <?php 
                                                combo_select_active("client_type","id","name","active","1",$row_client->client_type) 
                                            ?>    
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card" style="height: 450px">
                        <div class="card-header">
                            <h5>Address</h5>
                        </div>
                        <div class="card-body row">
                            <!-- FORM KIRI -->
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Negara</label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="country_id" name="country_id">
                                            <option value=""></option>
                                            <?php combo_select_active("country","id","name","active","1",$row_client->country_id) ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Kota</label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="kabupaten" name="kabupaten">
                                            <option value=""></option>
                                            <?php 
                                                combo_select_active("kota","syscode","nama","aktif","1",$row_client->kabupaten) 
                                            ?>  
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Alamat Lengkap</label>
                                    <div class="col-10">
                                        <textarea class="form-control" id="address" name="address" rows="3"><?php echo $row_client->address ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Provisi</label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="state_id" name="state_id">
                                            <option value=""></option>
                                            <?php 
                                                combo_select_active("provinsi","syscode","nama","aktif","1",$row_client->state_id) 
                                            ?>   
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Kecamatan</label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="kecamatan" name="kecamatan">
                                            <option value=""></option>
                                            <?php 
                                                combo_select_active("kecamatan","syscode","nama","aktif","1",$row_client->kecamatan) 
                                            ?>  
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Kode Pos</label>
                                    <div class="col-10">
                                        <input class="form-control" type="tel" placeholder="Kode Pos" value="<?php echo $row_client->zip_code ?>" id="zip_code" name="zip_code">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Active</label>
                                    <div class="col-10">
                                        <input id="active" name="active" type="checkbox" class="form-check-input" value="1" <?php echo $active ?> >
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="col-md-offset-3 col-md-9" style="text-align: right;">
                                <?php if (allowadd('frmclient')==1) { ?>
                                    <?php if($ref=='') { ?>
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Save" />
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

<!-- Required vendors -->
<script src="../<?php echo $__folder ?>vendor/global/global.min.js"></script>

<script src="../<?php echo $__folder ?>vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

<!-- Apex Chart -->

<script src="../<?php echo $__folder ?>vendor/apexchart/apexchart.js"></script>


<!-- Chart piety plugin files -->

<script src="../<?php echo $__folder ?>vendor/pickadate/picker.js"></script>
<script src="../<?php echo $__folder ?>vendor/pickadate/picker.time.js"></script>
<script src="../<?php echo $__folder ?>vendor/pickadate/picker.date.js"></script>
<script src="../<?php echo $__folder ?>vendor/owl-carousel/owl.carousel.js"></script>
<script src="../<?php echo $__folder ?>vendor/bootstrap-datetimepicker/js/moment.js"></script>
<script src="../<?php echo $__folder ?>vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="../<?php echo $__folder ?>js/plugins-init/pickadate-init.js"></script>
<script src="../<?php echo $__folder ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../<?php echo $__folder ?>js/plugins-init/datatables.init.js"></script>
<script src="../<?php echo $__folder ?>vendor/select2/js/select2.full.min.js"></script>
<script src="../<?php echo $__folder ?>js/plugins-init/select2-init.js"></script>
<script src="../<?php echo $__folder ?>js/custom.min.js"></script>
<script src="../<?php echo $__folder ?>js/dlabnav-init.js"></script>
<script src="../<?php echo $__folder ?>js/demo.js"></script>
<script src="../<?php echo $__folder ?>js/styleSwitcher.js"></script>