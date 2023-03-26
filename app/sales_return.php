<script src="assets/js/appcustom.js"></script>
<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='date') {
            alert('Date cannot empty!');                
          }
          
          if (document.getElementById(arrf[i]).name=='client_code') {
            alert('Customer cannot empty!');                
          }
          
          if (document.getElementById(arrf[i]).name=='si_ref') {
            alert('Sales Invoice No cannot empty!');                
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
    function detailvalue(id, jmldata){      
        var qty = 0;    
        qty=document.getElementById('qty_'+id).value; 
        //qty = number_format(qty,0,".",",");
        qty = qty.replace(/[^\d-.]/g,"");
        if(qty == "") {qty = 0};
                
        var unit_price = 0;
        unit_price=document.getElementById('unit_price_'+id).value; 
        //unit_price = number_format(unit_price,0,".",",");
        unit_price = unit_price.replace(/[^\d-.]/g,"");
        if(unit_price == "") {unit_price = 0};
        
        var amount = 0;
        amount = parseFloat(qty) * parseFloat(unit_price); //document.getElementById('amount_'+id).value; 
        amount = number_format(amount,2,".",",");   
        
        
        $('#amount'+id).html('<input type="text" onkeyup="formatangka(\'amount_'+id+'\')" id="amount_'+id+'" name="amount_'+id+'" value="'+amount+'" readonly style="text-align:right; width: 140px" class="form-control" >');  
        
     }   
</script>


<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <form class="row" action="" method="post" name="sales_return" id="sales_return" enctype="multipart/form-data" onSubmit="return cekinput('ref,date,client_code,si_ref');" >
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">
                            <?php 
                                $ref = $segmen3;
                                        
                                //jika saat add data, maka data setelah save kosong
                                if ($_POST['submit'] == 'Save') { $ref = ''; }
                                //-----------------------------------------------/\
                                    
                                $ref2 = notran(date('y-m-d'), 'frmsales_return', '', '', ''); 
                                    
                                include("app/exec/sales_return_insert.php"); 
                                
                                
                                $date = date("d-m-Y");
                                $date_need = date("d-m-Y");
                                
                                if ($ref != "") {
                                    $sql=$select->list_sales_return($ref);
                                    $row_sales_return=$sql->fetch(PDO::FETCH_OBJ);  
                                    
                                    $ref2 = $row_sales_return->ref; 
                                    $date = date("d-m-Y", strtotime($row_sales_return->date));
                                    $tax_rate = number_format($row_sales_return->tax_rate, 2, '.', ',');
                                }   
                            ?>


                            <!-- FORM KIRI -->
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">No. Nota</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" readonly value="<?php echo $ref2 ?>" id="ref" name="ref">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Tanggal<span class="required">*</span></label>
                                    <div class="col-10">
                                        <input class="datepicker-default form-control" type=" text" value="<?php echo $date ?>" id="date" name="date">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Status</label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="status2" name="status2">
                                            <?php select_status($row_sales_return->status)  ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Customer<span class="required">*</span></label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="client_code" name="client_code" onChange="loadHTMLPost2('app/sales_return_ajax.php','salesno','getsi','client_code')">
                                            <option value=""></option>
                                            <?php select_client($row_sales_return->client_code) ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Alasan Return <span class="required">*</span></label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="reason" name="reason" required value="<?php echo $row_sales_return->reason ?>" >
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Memo<span class="required"></span></label>
                                    <div class="col-10">
                                        <textarea class="form-control" id="memo" name="memo" rows="3"><?php echo $row_sales_return->memo ?></textarea>
                                    </div>
                                </div>                                
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Nota Penjualan<span class="required">*</span></label>

                                    <?php if($ref == "") { ?>
                                        <div class="col-10" id="salesno">
                                            <select class="destroy-selector" id="si_ref" name="si_ref" onChange="loadHTMLPost2('app/sales_return_ajax2.php','itemdetail','getitemsi','si_ref')" >
                                                <option value=""></option>
                                                <?php select_si_return($row_sales_return->si_ref, $row_sales_return->client_code) ?>
                                            </select>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-10">
                                            <select class="destroy-selector" id="si_ref2" name="si_ref2" disabled >
                                                <option value=""></option>
                                                <?php select_si_return($row_sales_return->si_ref, $row_sales_return->client_code, "edit") ?>
                                            </select>

                                            <input type="hidden" name="si_ref" id="si_ref" value="<?= $row_sales_return->si_ref ?>">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <?php if ($ref == '') { ?>
                            <div id="itemdetail"></div>
                        <?php } else { ?>
                            <?php include('sales_return_detail_update.php') ?>
                        <?php } ?>

                        <div class="card-footer">
                            <div class="row" style="justify-content: flex-end;">
                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="submit" id="submit" class="btn btn-success me-6" style="margin: auto;width: 100%;color: white;" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('sales_return_view') ?>'" />
                                </div>
                                <?php if (allowadd('frmsales_return') == 1) { ?>
                                    <?php if ($ref == '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Save" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmsales_return') == 1) { ?>
                                    <?php if ($ref != '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"> <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Update" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmsales_return') == 1) { ?>
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