<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>


<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='date') {
            alert('Tanggal cannot empty!');             
          }
          
          if (document.getElementById(arrf[i]).name=='location_id') {
            alert('Location/Gudang cannot empty!');             
          }
          
          if (document.getElementById(arrf[i]).name=='qty') {
            alert('Qty/Kuantiti tidak boleh kosong!');              
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

<script type="text/javascript">
    function excel_export() {
        var date                =    document.getElementById('date').value;
        var location_id         =    document.getElementById('location_id').value;

        document.location.href = "app/stock_opname_xls.php?date="+date+"&location_id="+location_id;   
    }
</script>

<script>
    function focusNext(elemName, evt) 
    {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode :
            ((evt.which) ? evt.which : evt.keyCode);
        if (charCode == 13) 
         {
            document.getElementById(elemName).focus();
          return false;
        }
        return true;
    }
    
    
</script>

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <form class="row" action="" method="post" name="stock_opname" id="stock_opname" enctype="multipart/form-data" onSubmit="return cekinput('date,location_id,qty');" >
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">
                            <?php 
                                $ref = $segmen3; //$_GET['search'];
                                
                                //jika saat add data, maka data setelah save kosong
                                if ($_POST['submit'] == 'Save') { $ref = ''; }
                                //-----------------------------------------------/\
                                
                                $ref2 = notran(date('Y-m-d'), 'frmstock_opname', '', '', ''); 

                                include("app/exec/stock_opname_insert.php"); 
                                
                                
                                $date = date("d F, Y");
                                $date_need = date("d F, Y");
                                $beginning_balance = "";
                                $location_id = $_SESSION["location_id2"];
                                if($location_id == "") {
                                    $location_id = 6; //sparepart
                                }
                                
                                if ($ref != "") {
                                    $sql=$select->list_stock_opname($ref);
                                    $row_stock_opname=$sql->fetch(PDO::FETCH_OBJ);  
                                    
                                    $ref2 = $row_stock_opname->ref; 
                                    $location_id = $row_stock_opname->location_id;
                                    $date = date("d F, Y", strtotime($row_stock_opname->date));
                                    $date_need = date("d F, Y", strtotime($row_stock_opname->date_need));
                                    $qty = number_format($row_stock_opname->qty, 0, '.', ',');
                                    
                                    if($row_stock_opname->beginning_balance == 1) {
                                        $beginning_balance = "checked";
                                    }
                                }   

                                ?>



                            <input type="hidden" id="ref" name="ref" value="<?php echo $row_stock_opname->syscode ; ?>" >
                            <input type="hidden" id="old_ref" name="old_ref" value="<?php echo $row_stock_opname->ref ; ?>" >
                            
                            <input type="hidden" id="old_date" name="old_date" value="<?php echo $row_stock_opname->date ; ?>" >
                            <input type="hidden" id="old_location_id" name="old_location_id" value="<?php echo $row_stock_opname->location_id ; ?>" >
                            <input type="hidden" id="old_bin" name="old_bin" value="<?php echo $row_stock_opname->bin ; ?>" >
                            <input type="hidden" id="old_uid" name="old_uid" value="<?php echo $row_stock_opname->uid ; ?>" >


                            <!-- FORM KIRI -->
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">No. Ref</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" readonly value="<?php echo $ref2 ?>" id="ref" name="ref">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Tanggal<span class="required">*</span></label>
                                    <div class="col-10">
                                        <input class="datepicker-default form-control"" type=" text" value="<?php echo $date ?>" id="date" name="date">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Gudang<span class="required">*</span></label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="location_id" name="location_id">
                                            <option value=""></option>
                                            <?php combo_select_active("warehouse","id","name","active","1",$location_id) ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Nama Rak</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="bin" name="bin" placeholder="Nama Rak" value="<?= $row_stock_opname->bin ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Notes</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="memo" name="memo" value="<?= $row_stock_opname->memo ?>">
                                    </div>
                                </div>

                                <div class="mb-12 row">
                                    <label class="col-2 col-form-label">
                                        <a href="JavaScript:excel_export()">
                                            <img src="<?php echo $__folder ?>images/excel.jpg" />
                                        </a>
                                    </label>
                                    <div class="col-10">
                                        <a href="javascript:void(0);" name="Find" title="Upload SO" class="btn btn-primary me-6" onClick=window.open("<?php echo $__folder ?>app/stock_opname_import.php","Find","width=900,height=500,left=200,top=20,toolbar=0,status=0,scroll=1,scrollbars=no"); />
                                            Upload SO
                                        </a>
                                        &nbsp;
                                        <input type="button" name="submit" id="submit" class="btn btn-success me-6" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('stock_opname_view') ?>'" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <?php if ($ref == '') { ?>
                            <?php include('stock_opname_detail.php') ?>
                        <?php } else { ?>
                            <?php include('stock_opname_detail_update.php') ?>
                        <?php } ?>

                        <div class="card-footer">
                            <div class="row" style="justify-content: flex-end;">
                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="submit" id="submit" class="btn btn-success me-6" style="margin: auto;width: 100%;color: white;" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('stock_opname_view') ?>'" />
                                </div>
                                <?php if (allowadd('frmstock_opname') == 1) { ?>
                                    <?php if ($ref == '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Save" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmstock_opname') == 1) { ?>
                                    <?php if ($ref != '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"> <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Update" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmstock_opname') == 1) { ?>
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