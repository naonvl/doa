<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>

<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='date') {
            alert('Tanggal tidak boleh kosong!');               
          }
          
          if (document.getElementById(arrf[i]).name=='location_id') {
            alert('Lokasi (Gudang) tidak boleh kosong!');                
          }
          
          if (document.getElementById(arrf[i]).name=='vendor_code') {
            alert('Supplier tidak boleh kosong!');              
          }
          
          if (document.getElementById(arrf[i]).name=='ref') {
            alert('Ref No. tidak boleh kosong!');               
          }
           
          return false
        } 
                                        
      }     
      
       var status_r = document.getElementById('status2').value;
       if (status_r == 'C') {           
            if (document.getElementById('employee_id2').value=='') {
                alert('Nama Penerima tidak boleh kosong!'); 
                
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
    var request;
    var dest;
    
    function loadHTMLPost3(URL, destination, button, getId, getId2){
        dest = destination; 
        str = getId + '=' + document.getElementById(getId).value;       
        str2 = getId2 + '=' + document.getElementById(getId2).value;
        
        var str = str + '&button=' + button; // + button + '|' + getId2;
        str = str + '&' + str2;
        
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
    function detailvalue(id, jmldata, ketik){
        
        sub_total(jmldata);
        
        return false    
        
     }   
     
     function sub_total(jmldata){ 
        
        var i=0;
        var jumlah='0';
        var qty='0';
        
        for(i=0; i<=jmldata-1; i++){
            
            qty = document.getElementById('qty_'+i).value.replace(/[^\d.]/g,"");
            
            if(qty=='') { qty=0 }
            jumlah  =  parseInt(jumlah) + parseInt(qty);
            
            //subtotal2(jumlah);
        }
        
        jumlah = number_format(jumlah,0,".",",");   
        $('#total_id').html('<input type="text" id="total" name="total" readonly style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" onkeyup="formatangka('+total+')" value="'+ jumlah +'"" >');
        
        return false;
    }
    
    
</script>

<script>
    
    function detailvalue2(ketik){       
        var qty = 0;    
        qty=document.getElementById('qty').value; 
        //qty = number_format(qty,0,".",",");
        qty = qty.replace(/[^\d-.]/g,"");
        if(qty == "") {qty = 0};
        
        //$('#amount_det').html('<input type="text" onkeyup="formatangka(\'amount\')" id="amount" name="amount" value="'+amount+'" readonly style="text-align:right; font-size: 11px; width: 100px" class="form-control" >');
        
        
        return false    
        
     }   
</script>

<script language="javascript">

    function hapus(id,line) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('outbound') ?>&mxKz=xm8r389xemx23xb2378e23&xndf="+id+"&line="+line+" ";
        }
    }
    
    function update(id, no) {   
    
        var line        = document.getElementById('old_line_'+no).value;
        var qty         = document.getElementById('qty_'+no).value;
        
        document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('outbound') ?>&mxKz=upd&xndf="+id+"&line="+line+"&qty="+qty+" ";
        
    }
    
    function print() {
        var ref = document.getElementById('ref').value;
        
        window.open('../app/good_receipt_print.php?ref='+ref, 'Invoice Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
    }

    function submitForm(tipe)
    {
        
        if(tipe == 'print') {
            //document.getElementById("good_receipt_view").action = "app/good_receipt_print.php";
            $("#outbound").attr('action', 'app/outbound_print.php')
               .attr('target', '_BLANK');
            $("#outbound").submit();
            
        }
        
        return false;
             
    }       
    
    
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
    
    
    function testprint() {
        var ref = document.getElementById('ref').value;
        
        window.open('app/test_print4.php', 'Invoice Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
    }
    
    function itemhistory() {
        var vendor_code = document.getElementById('vendor_code').value;
        
        window.open('app/outbound_item_history.php?vendor_code='+vendor_code, 'Item History','825','950','resizable=1,scrollbars=1,status=0,toolbar=0')
    }
    
    function chequehistory() {
        var vendor_code = document.getElementById('vendor_code').value;
        
        window.open('app/outbound_cheque_history.php?vendor_code='+vendor_code, 'Cheque History','825','2000','resizable=1,scrollbars=1,status=0,toolbar=0')
    }
</script>
            

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $ref = $segmen3; //$_GET['search'];
                            $xndf = $segmen3; //$_GET['xndf'];
                            
                            //jika saat add data, maka data setelah save kosong
                            if ($_POST['submit'] == 'Save') { $ref = ''; }
                            //-----------------------------------------------/\
                                
                            $ref2 = notran(date('y-m-d'), 'frmgood_receipt', '', '', ''); 
                                
                            include("app/exec/good_receipt_insert.php"); 
                            
                            
                            $date = date("d F, Y");
                            $date_arrival = date("d F, Y");
                            $warehouse_id_from  = $_SESSION["location_id2"];
                                                    
                            if( preg_match("/POV/", $xndf, $result) == 1) {
                                $delete = $_REQUEST['mxKz'];
                                if ($delete == "xm8r389xemx23xb2378e23" && $post != "Save Detail") {
                                    //include 'class/class.delete.php';
                                    $delete2=new delete;
                                    $delete2->delete_outbound_detail($_REQUEST['xndf'], $_REQUEST['line']);
                                }
                                if ($delete == "upd" && $post != "Save Detail") {
                                    $update2=new update;
                                    $update2->update_outbound_detail($_REQUEST['xndf'], $_REQUEST['line'], $_REQUEST['qty'], $_REQUEST['unit_cost'], $_REQUEST['amount']);
                                }
                                
                                $sqla=$select->get_purchase_inv_outstanding($xndf);
                                $row_outbounda=$sqla->fetch(PDO::FETCH_OBJ);
                                
                                $vendor_code    =   $row_outbounda->vendor_code;
                                $location_id    =   $row_outbounda->location_id;
                                $receipt_type   =   "Pembelian";
                                
                                $ref = "";
                            }
                            
                                                    
                            if ($ref != "") {
                                $sql=$select->list_good_receipt($ref);
                                $row_outbound=$sql->fetch(PDO::FETCH_OBJ);  
                                
                                $ref2 = $row_outbound->ref; 
                                $ref22 = $row_outbound->ref2;
                                $date = date("d F, Y", strtotime($row_outbound->date));
                                $date_arrival = date("d-m-Y", strtotime($row_outbound->date_arrival));
                                if($date_arrival == '01-01-1970') {
                                    $date_arrival = "";
                                } else {
                                    $date_arrival = date("d F, Y", strtotime($row_outbound->date_arrival));
                                }
                                $location_id    = $row_outbound->location_id;   
                                $vendor_code    = $row_outbound->vendor_code;
                                $receipt_type   = $row_outbound->receipt_type;
                                
                                $disabled = "disabled";
                                if($admin == 1) {
                                    $disabled = "";
                                }
                                                    
                                
                            }   
                                
                        ?>

                        <form class="row" action="" method="post" name="good_receipt" id="good_receipt" enctype="multipart/form-data" onSubmit="return cekinput('ref,date,vendor_code,location_id');" >

                            <input type="hidden" id="old_location_id" name="old_location_id" value="<?= $location_id ?>">
                            <input type="hidden" id="old_ref" name="old_ref" value="<?php echo $xndf; //$row_outbound->ref ; ?>" >
                            <input type="hidden" id="xndf" name="xndf" value="<?php echo $xndf ; ?>" >
                            <input type="hidden" id="receipt_type" name="receipt_type" value="<?php echo $receipt_type ; ?>" >

                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">No. Nota</label>
                                        <div class="col-10">
                                            <input type="text" id="ref" name="ref" readonly class="form-control" value="<?php echo $ref2 ?>"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Vendor<span class="required">*</span></label>
                                        <div class="col-8">
                                            <select class="destroy-selector" id="vendor_code" name="vendor_code">
                                                <option value=""></option>
                                                <?php 
                                                    combo_select_active("vendor","syscode","name","active","1",$vendor_code) 
                                                ?>  
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <button style="height: 35px;padding: 0.5rem 1rem;" class="btn btn-primary me-2" id="js-programmatic-enable">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Tanggal<span class="required">*</span></label>
                                        <div class="col-10">
                                            <input class="datepicker-default form-control"" type="text" value="<?php echo $date ?>" id="date" name="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Status<span class="required">*</span></label>
                                        <div class="col-10">
                                            <select class="destroy-selector" id="status" name="status">
                                                <?php 
                                                    select_status_outbound($row_outbound->status);
                                                ?>  
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Lokasi (Gudang) *)</label>
                                        <div class="col-10">
                                            <select class="destroy-selector" id="location_id" name="location_id">
                                                <option value=""></option>
                                                <?php 
                                                    combo_select_active("warehouse","id","name","active","1",$location_id)
                                                ?>  
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">No Surat Jalan</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="do_ref" name="do_ref" value="<?php echo $row_outbound->do_ref ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FORM KIRI -->
                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Tanggal Datang</label>
                                        <div class="col-10">
                                            <input class="datepicker-default form-control"" type="text" value="<?php echo $date_arrival ?>" id="date_arrival" name="date_arrival">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">No Mobil</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="vehicle" name="vehicle" value="<?php echo $row_outbound->vehicle ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Catatan</label>
                                        <div class="col-10">
                                            <input class="form-control"" type="text" value="<?php echo $row_outbound->memo ?>" id="memo" name="memo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Nama Sopir</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="driver" name="driver" value="<?php echo $row_outbound->driver ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    <!-- </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card"> -->
                    
                    <?php if($ref=='') { ?>
                        <?php include('good_receipt_detail.php') ?>
                    <?php } else { ?>
                        <?php include('good_receipt_detail_update.php') ?>
                    <?php } ?>

                    <div class="card-footer">
                        <div class="col-md-offset-3 col-md-9" style="text-align: right;">
                            <input type="button" name="submit" id="submit" class="btn btn-success me-6" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'.obraxabrix('good_receipt_view') ?>'" />
                            <?php if (allowadd('frmgood_receipt')==1) { ?>
                                <?php if($ref=='') { ?>
                                    <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Save" />
                                <?php } ?>
                            <?php } ?>

                            <?php if (allowupd('frmgood_receipt')==1) { ?>
                                <?php if($ref!='') { ?>
                                    <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Update" />
                                <?php } ?>
                            <?php } ?>
                            
                            <?php if (allowdel('frmgood_receipt')==1) { ?>
                                <?php if($ref!='') { ?>
                                    <input type="submit" name="submit" class="btn btn-danger me-6" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
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