<script type="text/javascript" src="js/buttonajax.js"></script>
<!--<script src="assets/js/appcustom.js"></script>-->

<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='code') {
            alert('Code cannot empty!');                
          }
          
          if (document.getElementById(arrf[i]).name=='name') {
            alert('Item cannot empty!');                
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

<script>

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
      
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + (Math.round(n * k) / k)
            .toFixed(prec);
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '')
        .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
          .join('0');
      }
      return s.join(dec);
    }
    
    function formatangka(field) {
         //a = rci.amt.value;    
         a = document.getElementById(field).value;
         //alert(a);
         b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
         c = "";
         panjang = b.length;
         j = 0;
         for (i = panjang; i > 0; i--)
         {
             j = j + 1;
             if (((j % 3) == 1) && (j != 1))
             {
                c = b.substr(i-1,1) + "," + c;
             } else {
                c = b.substr(i-1,1) + c;
             }
         }
         //rci.amt.value = c;
         c = c.replace(",.",".");
         c = c.replace(".,",".");
         document.getElementById(field).value = c;      
         
    }

    //-----------change nilai
    function formula_value(){
        
        var current_price = 0;  
        current_price = document.getElementById('current_price').value; 
        current_price = current_price.replace(/[^\d-.]/g,"");
        if(current_price == "") {current_price = 0};
        
        var current_price1 = 0; 
        current_price1 = document.getElementById('current_price1').value; 
        current_price1 = current_price1.replace(/[^\d-.]/g,"");
        if(current_price1 == "") {current_price1 = 0};
        
        var registration_rate = 0;  
        registration_rate = document.getElementById('registration_rate').value; 
        registration_rate = registration_rate.replace(/[^\d-.]/g,"");
        if(registration_rate == "") {registration_rate = 0};
        
        //margin capster
        registration_rate2  = (parseFloat(current_price) * parseFloat(registration_rate))/100;
        registration_rate2  = number_format(registration_rate2,0,".",",");
        
        $('#current_price1_id').html('<input type="text" id="current_price1" name="current_price1" class="form-control" onkeyup="formatangka(current_price1)" readonly style="text-align: right;" value="'+ registration_rate2 +'">');
        
        
        return false    
        
     }   
     
</script>

<!--//shortcut-->
<script>
    document.onkeydown = function (e) {
        switch (e.keyCode) {
            //F1 (Kembali ke kolom Kelompok)
            case 112:
                document.getElementById('warehouse_group_id').focus();
                //window.location = 'main.php?menu=app&act=<?php echo obraxabrix(warehouse) ?>';
                e.preventDefault();
                break;
                        
        }
        //menghilangkan fungsi default tombol
        /*e.preventDefault();*/
        
    };
</script>

<script>
    function print_barcode(ref) {
        window.open('<?php echo $__folder ?>app/warehouse_qrcode.php?ref='+ref, 'QR Code Print','450','450','resizable=1,scrollbars=1,status=0,toolbar=0')
    }
</script>


<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <form class="row" action="" method="post" name="warehouse" id="warehouse" enctype="multipart/form-data" onSubmit="return cekinput('code,warehouse_group_id,name,uom_code_sales');" >
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">
                            <?php 
                                $ref = $segmen3; //$_GET['search'];
                                
                                include("app/exec/warehouse_insert.php"); 
                                
                                $active = "checked";
                                if ($ref != "") {
                                    $sql=$select->list_warehouse($ref);
                                    $row_warehouse=$sql->fetch(PDO::FETCH_OBJ);  
                                    
                                    $active = "";
                                    if($row_warehouse->active == 1) {
                                        $active = "checked";
                                    }
                                }           
                            ?>


                            <input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >


                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Kode</label>
                                        <div class="col-10">
                                            <input type="text" id="code" name="code" class="form-control" placeholder="Kode Gudang" value="<?php echo $row_warehouse->code ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Nama Gudang<span class="required">*</span></label>
                                        <div class="col-10">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Nama Gudang" value="<?php echo $row_warehouse->name ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Alamat<span class="required">*</span></label>
                                        <div class="col-10">
                                            <input type="text" id="address" name="address" class="form-control" value="<?php echo $row_warehouse->address ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">E-mail<span class="required">*</span></label>
                                        <div class="col-10">
                                            <input type="text" id="email" name="email" class="form-control" value="<?php echo $row_warehouse->email ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FORM KIRI -->
                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Phone<span class="required">*</span></label>
                                        <div class="col-10">
                                            <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $row_warehouse->phone ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Active</label>
                                        <div class="col-10">
                                            <input id="active" name="active" type="checkbox" class="form-check-input" value="1" <?php echo $active ?> >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">

                        <div class="card-footer">
                            <div class="row" style="justify-content: flex-end;">
                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="submit" id="submit" class="btn btn-success me-6" style="margin: auto;width: 100%;color: white;" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('warehouse_view') ?>'" />
                                </div>
                                <?php if (allowadd('frmwarehouse') == 1) { ?>
                                    <?php if ($ref == '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Save" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmwarehouse') == 1) { ?>
                                    <?php if ($ref != '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"> <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Update" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmwarehouse') == 1) { ?>
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