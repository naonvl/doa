<script src="<?php echo $__folder ?>assets/js/appcustom.js"></script>
<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='date') {
			alert('Tanggal tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='warehouse_id_from') {
			alert('Dari Lokasi tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='warehouse_id_to') {
			alert('Ke Lokasi tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='type') {
			alert('Outbound Type cannot empty!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='employee_id') {
			alert('Yang Mengeluarkan tidak boleh kosong!');				
		  }
		  
		  		   
		  return false
		} 
										
	  }		
	  
	   var status_r = document.getElementById('status').value;
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
			jumlah 	=  parseInt(jumlah) + parseInt(qty);
			
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
	
		var line 		= document.getElementById('old_line_'+no).value;
		var qty 		= document.getElementById('qty_'+no).value;
		
		document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('outbound') ?>&mxKz=upd&xndf="+id+"&line="+line+"&qty="+qty+" ";
		
	}
	
	function print() {
		var ref = document.getElementById('ref').value;
		window.open('<?php echo $__folder ?>app/outbound_printout.php?ref=' + ref, 'Pemindahan Barang Print', '825', '450', 'resizable=1,scrollbars=1,status=0,toolbar=0')

		//var uid = document.getElementById('uid').value;
		
		//window.location = "app/outbound_print_create.php?ref="+ref+"&uid="+uid; //localhost only
		//window.location = "app/outbound_print_create_ol.php?ref="+ref+"&uid="+uid; //internet only
		
		//window.open('app/outbound_print.php?ref='+ref, 'Invoice Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}

	function submitForm(tipe)
    {
    	
    	if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
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
        <?php 
      		$ref = $segmen3; //$_GET['search'];
      		$xndf = $segmen3; //$_GET['xndf'];
			
			if($segmen4 != "") {
				$xndf = $segmen4;
			}
			
			//jika saat add data, maka data setelah save kosong
			if ($_POST['submit'] == 'Save') { $ref = ''; }
			//-----------------------------------------------/\
				
			$ref2 = notran(date('y-m-d'), 'frmoutbound', '', '', ''); 
				
			include("app/exec/outbound_insert.php"); 
			
			
			$date = date("d F, Y");
			$warehouse_id_from 	= $_SESSION["location_id2"];
            
            if( substr($xndf, 0, 3) != "OTB" ) {                       
				if($xndf != "") {
					$ref = "";
					
					$delete = $segmen3; //$_REQUEST['mxKz'];
					if ($delete == "xm8r389xemx23xb2378e23" && $post != "Save Detail") {
						//include 'class/class.delete.php';
						$delete2=new delete;
						$delete2->delete_outbound_detail($xndf, $segmen5);
					}
					if ($delete == "upd" && $post != "Save Detail") {
						$update2=new update;
						$update2->update_outbound_detail($_REQUEST['xndf'], $_REQUEST['line'], $_REQUEST['qty'], $_REQUEST['unit_cost'], $_REQUEST['amount']);
					}
					
					$sqla=$select->list_outbound_get_detail_last($xndf);
					$row_outbounda=$sqla->fetch(PDO::FETCH_OBJ);
					
					$warehouse_id_from	=	$row_outbounda->warehouse_id_from;
					$warehouse_id_to	=	$row_outbounda->warehouse_id_to;
					$employee_id		=	$row_outbounda->employee_id;
					$employee_id2		=	$row_outbounda->employee_id2;
				}
			}
			
			$status = "R";							
			if ($ref != "") {
				$sql=$select->list_outbound($ref);
				$row_outbound=$sql->fetch(PDO::FETCH_OBJ);	
				
				$ref2 = $row_outbound->ref;	
				$ref22 = $row_outbound->ref2;
				$date = date("d F, Y", strtotime($row_outbound->date));
				$employee_id  = $row_outbound->employee_id;	
				$employee_id2  = $row_outbound->employee_id2;	
				$warehouse_id_from  = $row_outbound->warehouse_id_from;	
				$warehouse_id_to = $row_outbound->warehouse_id_to;
				$status = $row_outbound->status;
				
				$disabled = "disabled";
                if($admin == 1) {
                    $disabled = "";
                }
				
				if($row_outbound->taxable == 1) {
					$taxable = "checked";
				}
				
                
			}	
			
				
		?>

        <form class="row" action="" method="post" name="outbound" id="outbound" enctype="multipart/form-data" onSubmit="return cekinput('ref,date,warehouse_id_from,warehouse_id_to,type,employee_id');" >
            	
            	<input type="hidden" id="old_warehouse_id_from" name="old_warehouse_id_from" value="<?php echo $row_outbound->warehouse_id_from ; ?>" >
				<input type="hidden" id="old_warehouse_id_to" name="old_warehouse_id_to" value="<?php echo $row_outbound->warehouse_id_to ; ?>" >
				<input type="hidden" id="old_ref" name="old_ref" value="<?php echo $xndf; //$row_outbound->ref ; ?>" >
				<input type="hidden" id="xndf" name="xndf" value="<?php echo $xndf ; ?>" >
				<input type="hidden" id="type" name="type" value="T"/>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">

                            <div class="col-lg-8 order-lg-1">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="col-6 col-form-label">Ref. No.</label>
                                        <input type="text" id="ref" name="ref" readonly class="form-control" value="<?php echo $ref2 ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="col-6 col-form-label">Tanggal</label>
                                        <input type="text" id="date" name="date" class="datepicker-default form-control" value="<?php echo $date ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 order-lg-1">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="col-6 col-form-label">Dari Lokasi(Gudang)<span class="required"></span></label>
                                        <select class="destroy-selector" id="warehouse_id_from" name="warehouse_id_from">
                                            <option value=""></option>
                                        	<?php select_location($warehouse_id_from) ?>
                                        </select>
                                    </div>      
                                    <div class="col-md-6 mb-3">
                                        <label class="col-6 col-form-label">Status</label>
                                        <select class="destroy-selector" id="status" name="status">
                                            <option value=""></option>
                                            <?php 
                                                select_status_outbound($status) 
                                            ?>  
                                        </select>
                                    </div>                              
                                </div>
                            </div>

                            <div class="col-lg-8 order-lg-1">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="col-6 col-form-label">Ke Lokasi(Gudang)</label>
                                        <select class="destroy-selector" id="warehouse_id_to" name="warehouse_id_to">
                                            <option value=""></option>
                                            <?php 
                                                select_location($warehouse_id_to)
                                            ?>  
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="col-6 col-form-label">Catatan</label>
                                        <textarea id="reason" name="reason" class="form-control"><?php echo $row_outbound->reason ?></textarea>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-8 order-lg-1">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="col-6 col-form-label">Yang Mengeluarkan</label>
                                        <select class="destroy-selector" id="employee_id" name="employee_id">
                                            <option value=""></option>
                                            <?php 
                                                select_employee($employee_id)
                                            ?>  
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="col-6 col-form-label">Nama Penerima</label>
                                        <select class="destroy-selector" id="employee_id2" name="employee_id2">
                                            <option value=""></option>
                                            <?php 
                                                select_employee($employee_id2)
                                            ?>  
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 order-lg-1">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="col-6 col-form-label">Updated By</label>
                                        <input type="text" id="uid" name="uid" readonly class="form-control" value="<?php echo $row_outbound->uid ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="col-6 col-form-label">Last Update</label>
                                        <input type="text" id="dlu" name="dlu" readonly class="form-control" value="<?php echo $row_outbound->dlu ?>" >
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <?php 
                        	if($ref == '') {
                        		include('outbound_detail.php');
                        	} else {
                        		include('outbound_detail_update.php');
                        	}                            
                        ?>
                    </div>
                </div>

                <div class="space-4"></div>
                <div class="col-12">
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <?php if (allowadd('frmoutbound')==1) { ?>
                                <?php if($ref=='') { ?>
                                    <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Save" />
                                <?php } ?>
                            <?php } ?>

                            <?php if (allowupd('frmoutbound')==1) { ?>
                                <?php if($ref!='') { ?>
                                    <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Update" />
                                <?php } ?>
                            <?php } ?>

                            <?php if (allowdel('frmoutbound')==1) { ?>
                                <?php if($ref!='') { ?>
                                    <input type="submit" name="submit" class="btn btn-danger me-6" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
                                <?php } ?>
                            <?php } ?>
                            &nbsp;
                            <input type="button" name="button" class="btn btn-success" value="Print" onclick="print()" >
                            &nbsp;
                            <input type="button" name="submit" id="submit" class="btn btn-secondary ms-6" value="List Data" onclick="self.location='<?php echo $nama_folder ?>/<?php echo  obraxabrix('outbound_view') ?>'" />
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>