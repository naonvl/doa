<script src="<?php echo $__folder ?>assets/js/appcustom.js"></script>
<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>

<link rel="stylesheet" href="<?php echo $__folder ?>lightbox/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo $__folder ?>lightbox/lightbox.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
	  	
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='ref') {
			alert('Ref. cannot empty!');
		  }
		  
		  if (document.getElementById(arrf[i]).name=='date') {
			alert('Date cannot empty!');				
		  }

		  if (document.getElementById(arrf[i]).name=='vendor_code') {
			alert('Vendor cannot empty!');				
		  }
		  		  		  
		  return false
		} 
										
	  }		
	  
	  
	  //cek kelengkapan MS
	  var ms_ref = document.getElementById('ms_ref').value;
	  var ms_ref1 = document.getElementById('ms_ref1').value;
	  var ms_ref2 = document.getElementById('ms_ref2').value;

	  //---------1--------
	  var label = document.getElementById('label').checked;
	  var plat = document.getElementById('plat').checked;	  	
	  var button = document.getElementById('button').checked;
	  var pocket = document.getElementById('pocket').checked;
	  var resleting = document.getElementById('resleting').checked;

	  var label_ms = document.getElementById('label_ms').value;
	  var plat_ms = document.getElementById('plat_ms').value;	  	
	  var button_ms = document.getElementById('button_ms').value;
	  var pocket_ms = document.getElementById('pocket_ms').value;
	  var resleting_ms = document.getElementById('resleting_ms').value;

	  if(label_ms == 1) {
	  	if(label == false) {
	  		alert('Label MS : ' + ms_ref + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(plat_ms == 1) {
	  	if(plat == false) {
	  		alert('Plat MS : ' + ms_ref + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(button_ms == 1) {
	  	if(button == false) {
	  		alert('Button MS : ' + ms_ref + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(pocket_ms == 1) {
	  	if(pocket == false) {
	  		alert('Detail Pocket MS : ' + ms_ref + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(resleting == 1) {
	  	if(pocket == false) {
	  		alert('Resleting MS : ' + ms_ref + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  //---------2--------
	  var label1 = document.getElementById('label1').checked;
	  var plat1 = document.getElementById('plat1').checked;	  	
	  var button1 = document.getElementById('button1').checked;
	  var pocket1 = document.getElementById('pocket1').checked;
	  var resleting1 = document.getElementById('resleting1').checked;

	  var label_ms1 = document.getElementById('label_ms1').value;
	  var plat_ms1 = document.getElementById('plat_ms1').value;	  	
	  var button_ms1 = document.getElementById('button_ms1').value;
	  var pocket_ms1 = document.getElementById('pocket_ms1').value;
	  var resleting_ms1 = document.getElementById('resleting_ms1').value;

	  if(label_ms1 == 1) {
	  	if(label1 == false) {
	  		alert('Label MS : ' + ms_ref1 + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(plat_ms1 == 1) {
	  	if(plat1 == false) {
	  		alert('Plat MS : ' + ms_ref1 + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(button_ms1 == 1) {
	  	if(button1 == false) {
	  		alert('Button MS : ' + ms_ref1 + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(pocket_ms1 == 1) {
	  	if(pocket1 == false) {
	  		alert('Detail Pocket MS : ' + ms_ref1 + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(resleting1 == 1) {
	  	if(pocket1 == false) {
	  		alert('Resleting MS : ' + ms_ref1 + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  //---------3--------
	  var label2 = document.getElementById('label2').checked;
	  var plat2 = document.getElementById('plat2').checked;	  	
	  var button2 = document.getElementById('button2').checked;
	  var pocket2 = document.getElementById('pocket2').checked;
	  var resleting2 = document.getElementById('resleting2').checked;

	  var label_ms2 = document.getElementById('label_ms2').value;
	  var plat_ms2 = document.getElementById('plat_ms2').value;	  	
	  var button_ms2 = document.getElementById('button_ms2').value;
	  var pocket_ms2 = document.getElementById('pocket_ms2').value;
	  var resleting_ms2 = document.getElementById('resleting_ms2').value;

	  if(label_ms2 == 1) {
	  	if(label2 == false) {
	  		alert('Label MS : ' + ms_ref2 + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(plat_ms2 == 1) {
	  	if(plat2 == false) {
	  		alert('Plat MS : ' + ms_ref2 + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(button_ms2 == 1) {
	  	if(button2 == false) {
	  		alert('Button MS : ' + ms_ref2 + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(pocket_ms2 == 1) {
	  	if(pocket2 == false) {
	  		alert('Detail Pocket MS : ' + ms_ref2 + ' belum dipilih !!!');
	  		return false;
	  	}
	  }

	  if(resleting2 == 1) {
	  	if(pocket2 == false) {
	  		alert('Resleting MS : ' + ms_ref2 + ' belum dipilih !!!');
	  		return false;
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


<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost4(URL, destination, button, getId, getId2, getId3){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		
		var str = str + '&button=' + button + '|' + getId2 + '|' + getId3;
		alert(str);
		
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
	
	function loadHTMLPost5(URL, destination, button, getId, getId2, getId3){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		
		var str = str + '&button=' + button + '|' + getId2 + '|' + getId3;
		
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
	
	function loadHTMLPost6(URL, destination, button, getId, getId2, getId3, getId4, getId5, getId6){
		
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		str4 = '&' + getId4 + '=' + document.getElementById(getId4).value;
		str5 = '&' + getId5 + '=' + document.getElementById(getId5).value;
		str6 = '&' + getId6 + '=' + document.getElementById(getId6).value;
		
		var str = str + str4 + str5 + str6 + '&button=' + button + '|' + getId2 + '|' + getId3;
		
		//var str = str + str2 + str3 + '&button=' + button;
		
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
	function detailvalue(i, jmldata){
        
        var total_qty = document.getElementById('qty_'+i).value.replace(/[^\d.]/g,"");
		if(total_qty=='') { total_qty=0 }
			
        var unit_cost = 0;
		unit_cost=document.getElementById('unit_cost_'+i).value; 
		unit_cost = unit_cost.replace(/[^\d-.]/g,"");
		if(unit_cost == "") {unit_cost = 0};
		
		var amount = 0;
		amount = parseFloat(total_qty) * parseFloat(unit_cost);
		amount = number_format(amount,0,".",",");
		
		$('#amount_cost'+i).html('<input type="text" id="amount_cost_'+i+'" name="amount_cost_'+i+'" style="text-align: right;" readonly class="form-control" value="'+amount+'" >');
		
        sub_total(jmldata);
		
		return false	
		
	 }	 
	 
	 function sub_total(jmldata){ 
	 	var i=0;
		var jumlah='0';
		var total_qty_defect='0';
		var total_amount='0';
		var change_amount='0';
		var total_qty='0';
		
		for(i=0; i<jmldata; i++){
			
			var total_qty = document.getElementById('qty_'+i).value.replace(/[^\d.]/g,"");
			if(total_qty=='') { total_qty=0 }
			jumlah 	=  parseInt(jumlah) + parseInt(total_qty);

			var qty_damaged = document.getElementById('qty_damaged_'+i).value.replace(/[^\d.]/g,"");
			if(qty_damaged=='') { qty_damaged=0 }
			total_qty_defect 	=  parseInt(total_qty_defect) + parseInt(qty_damaged);

			var amount_cost = document.getElementById('amount_cost_'+i).value.replace(/[^\d.]/g,"");
			if(amount_cost=='') { amount_cost=0 }
			total_amount 	=  parseInt(total_amount) + parseInt(amount_cost);

		}

		subtotal2(jumlah, total_qty_defect, total_amount);
		
		return false;
	}
	
	function subtotal2(jumlah, total_qty_defect, total_amount) {
		
		jumlah = number_format(jumlah,0,".",",");	
		$('#total1_id').html('<input type="text" id="total1" name="total1" readonly style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" value="'+ jumlah +'"" >');

		total_qty_defect = number_format(total_qty_defect,0,".",",");	
		$('#total_qty_damaged_id').html('<input type="text" id="total_qty_damaged" name="total_qty_damaged" readonly style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" value="'+ total_qty_defect +'"" >');

		total_amount = number_format(total_amount,0,".",",");
		$('#total_id').html('<input type="text" id="total_amount" name="total_amount" readonly style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" onkeyup="formatangka('+total_amount+')" value="'+ total_amount +'"" >');
		
		return false;
	}
	
	
	function sub_total_member(total, jmldata){ 
		var i=0;
		var discmember='0';
		var discmember2='0';
		var memberlimit='0';
		var memberlimit2='0';
		var amount_member='0';
		var totalcek='0';
		var non_discount='0';
		
		amount_member = document.getElementById('amount_member').value;
		totalcek = parseInt(total) + parseInt(amount_member);
		
		for(i=0; i<=jmldata; i++){
			
			memberlimit = document.getElementById('memberlimit'+i).value.replace(/[^\d.]/g,"");
			if(memberlimit=='') { memberlimit=0 }
			memberlimit 	=  parseInt(memberlimit);
			
			discmember = document.getElementById('discmember'+i).value.replace(/[^\d.]/g,"");
			if(discmember=='') { discmember=0 }
			discmember 	=  parseInt(discmember);
			
			if(	memberlimit <= totalcek ) {
				discmember2 = discmember;
			}
			
			//alert(memberlimit);
			
		}
		
		
		
		memberlimit = (total * discmember2)/100;
		memberlimit2 = number_format(memberlimit,0,".",",");
		
		$('#total_discount_id').html('<input type="text" id="discount" name="discount" style="text-align: right; font-size: 16px" class="form-control" value="'+ memberlimit2 +'"" >');
		
	}
	
</script>

<script>
	
	function detailvalue2(ketik){		
		var qty = 0;	
		qty=document.getElementById('qty').value; 
		//qty = number_format(qty,0,".",",");
		qty = qty.replace(/[^\d-.]/g,"");
		if(qty == "") {qty = 0};
				
		var unit_price = 0;
		unit_price=document.getElementById('unit_price').value; 
		//unit_price = number_format(unit_price,0,".",",");
		unit_price = unit_price.replace(/[^\d-.]/g,"");
		if(unit_price == "") {unit_price = 0};
		
		var discount = 0;
		discount=document.getElementById('discount_det').value; 
		discount = discount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount == "") {discount = 0};
        
        //discoutn persen
        var discount3 = 0;
		discount3=document.getElementById('discount3_det').value; 
		discount3 = discount3.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
		if(discount3 == "") {discount3 = 0};
        
        
        //alert(discount3);
        if( ketik == 'persen' ) {
            discount3 = (unit_price * discount3) / 100;
            if(discount3 == "") {discount3 = 0};
            
            discount = discount3;   
        } 
             
        //---------------/\
		unit_price = parseFloat(unit_price) - parseFloat(discount);
		
		var amount = 0;
		amount = parseFloat(qty) * parseFloat(unit_price); // - parseFloat(discount); //document.getElementById('amount_'+id).value; 
		amount = number_format(amount,0,".",",");	
		
        discount_value     = number_format(discount,0,".",",");
        
        
        if( ketik == 'persen' ) {
            $('#discount_det_id').html('<input type="text" onkeyup="formatangka(\'discount_det\'), detailvalue2(\'nominal\')" id="discount_det" name="discount_det" value="'+discount_value+'" style="text-align:right; font-size: 11px; width: 100px" class="form-control" >');
        }
        
        //-------disc nominal
        if( ketik == 'nominal' ) {
            var unit_price_tmp = 0;
    		unit_price_tmp=document.getElementById('unit_price').value; 
    		unit_price_tmp = unit_price_tmp.replace(/[^\d-.]/g,"");
    		if(unit_price_tmp == "") {unit_price_tmp = 0};
            
            discount3 = ( discount / unit_price_tmp) * 100; 
        }   
        
        discount3_value    = number_format(discount3,2,".",",");
        if( ketik == 'nominal' ) {
            $('#discount3_det_id').html('<input type="text" onkeyup="formatangka(\'discount3_det\'), detailvalue2(\'persen\')" id="discount3_det" name="discount3_det" value="'+discount3_value+'" style="text-align:right; font-size: 11px; width: 100px" class="form-control" >');
        }
        //-------------------------
		
		$('#amount_det').html('<input type="text" onkeyup="formatangka(\'amount\')" id="amount" name="amount" value="'+amount+'" readonly style="text-align:right; font-size: 11px; width: 100px" class="form-control" >');
		
		
		return false	
		
	 }	 
</script>

<script language="javascript">

	function hapus(id,line) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('press') ?>/xm8r389xemx23xb2378e23/"+id+"/"+line+" ";
		}
	}
	
	function print() {
		var ref = document.getElementById('ref').value;
		
		window.open('<?= $__folder ?>app/do_good_receipt_qc_print.php?ref='+ref, 'QC SJ Vendor Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}

	function submitForm(tipe)
    {
    	
    	if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#press").attr('action', 'app/press_print.php')
			   .attr('target', '_BLANK');
			$("#press").submit();
			
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
		var client_code = document.getElementById('client_code').value;
		
		window.open('app/press_item_history.php?client_code='+client_code, 'Item History','825','950','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function chequehistory() {
		var client_code = document.getElementById('client_code').value;
		
		window.open('app/press_cheque_history.php?client_code='+client_code, 'Cheque History','825','2000','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
</script>


<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <form class="form-horizontal" role="form" action="" method="post" name="do_good_receipt_qc" id="do_good_receipt_qc" enctype="multipart/form-data" onSubmit="return cekinput('ref,date,vendor_code');" >

            <div class="col-12">
                    <div class="card">
                        <div class="card-body row">
                            <?php 
				
								$ref = $segmen3;
				          							
								//jika saat add data, maka data setelah save kosong
								if ($_POST['submit'] == 'Save') { $ref = ''; }
								//-----------------------------------------------/\
									
								$ref2 = notran(date('Y-m-d'), 'frmdo_good_receipt_qc', '', '', ''); 
									
								include("app/exec/do_good_receipt_qc_insert.php"); 
												
								$admin = $_SESSION["adm"];
				                
				                $status = "R";
								$insert = "1";
								$disable = "";
								
								$date = date("d F, Y");
								
				                if(substr($ref, 0, 3) == "GOR") {
				                	
				                	$sql=$select->list_good_receipt($ref);
									$row_do_good_receipt_qc=$sql->fetch(PDO::FETCH_OBJ);	
									
									$vendor_code1  = $row_do_good_receipt_qc->vendor_code;	
									$client_name  = $row_do_good_receipt_qc->vendor_name;	
									$so_ref  = $row_do_good_receipt_qc->ref;

									//-------check detail order
									/*$sqlms = $select->get_sales_order_ms($so_ref);
									$data_ms = $sqlms->fetch(PDO::FETCH_OBJ);
									$ms_ref 	= $data_ms->ms_ref;
									$ms_ref1 	= $data_ms->ms_ref1;
									$ms_ref2   	= $data_ms->ms_ref2;

									$label_ms				= 	"";
									$plat_ms				= 	"";
									$button_ms				= 	"";
									$pocket_ms				= 	"";
									$resleting_ms			= 	"";
									$data_label 			=	$data_ms->label;
									$data_plat 				=	$data_ms->plat;
									$data_button 			=	$data_ms->button;
									$data_pocket 			=	$data_ms->pocket;
									$data_resleting			=	$data_ms->resleting;
									if($data_ms->label == 1) {
										$label_ms = "checked";
									}
									if($data_ms->plat == 1) {
										$plat_ms = "checked";
									}
									if($data_ms->button == 1) {
										$button_ms = "checked";
									}
									if($data_ms->pocket == 1) {
										$pocket_ms = "checked";
									}
									if($data_ms->resleting == 1) {
										$resleting_ms = "checked";
									}

									$label_ms1				= 	"";
									$plat_ms1				= 	"";
									$button_ms1				= 	"";
									$pocket_ms1				= 	"";
									$resleting_ms1			= 	"";
									$data_label1 			=	$data_ms->label1;
									$data_plat1 			=	$data_ms->plat1;
									$data_button1 			=	$data_ms->button1;
									$data_pocket1 			=	$data_ms->pocket1;
									$data_resleting1		=	$data_ms->resleting1;
									if($data_ms->label1 == 1) {
										$label_ms1 = "checked";
									}
									if($data_ms->plat1 == 1) {
										$plat_ms1 = "checked";
									}
									if($data_ms->button1 == 1) {
										$button_ms1 = "checked";
									}
									if($data_ms->pocket1 == 1) {
										$pocket_ms1 = "checked";
									}
									if($data_ms->resleting1 == 1) {
										$resleting_ms1 = "checked";
									}

									$label_ms2				= 	"";
									$plat_ms2				= 	"";
									$button_ms2				= 	"";
									$pocket_ms2				= 	"";
									$resleting_ms2			= 	"";
									$data_label2 			=	$data_ms->label2;
									$data_plat2 			=	$data_ms->plat2;
									$data_button2 			=	$data_ms->button2;
									$data_pocket2 			=	$data_ms->pocket2;
									$data_resleting2		=	$data_ms->resleting2;
									if($data_ms->label2 == 1) {
										$label_ms2 = "checked";
									}
									if($data_ms->plat2 == 1) {
										$plat_ms2 = "checked";
									}
									if($data_ms->button2 == 1) {
										$button_ms2 = "checked";
									}
									if($data_ms->pocket2 == 1) {
										$pocket_ms2 = "checked";
									}
									if($data_ms->resleting2 == 1) {
										$resleting_ms2 = "checked";
									}*/
									
									$ref = "";
								}
				                
								if ($ref != "") {
									$sql=$select->list_do_good_receipt_qc($ref);
									$row_do_good_receipt_qc=$sql->fetch(PDO::FETCH_OBJ);	
									
									$ref2 = $row_do_good_receipt_qc->ref;	
									$ref22 = $row_do_good_receipt_qc->ref2;
									$date = date("d F, Y", strtotime($row_do_good_receipt_qc->date));
									$date_time	=	date("H:i", strtotime($row_do_good_receipt_qc->date_time));
									$so_ref  = $row_do_good_receipt_qc->so_ref;
									
									$vendor_code  = $row_do_good_receipt_qc->vendor_code;	
									$vendor_name  = $row_do_good_receipt_qc->vendor_name;	
									$memo  		  = $row_do_good_receipt_qc->memo;

									$disabled = "disabled";
				                    if($admin == 1) {
				                        $disabled = "";
				                    }
									
									$status = $row_do_good_receipt_qc->status;					
									$insert = "0";
									$disable = "disabled";

									//------------QC----------------
									$ms_ref 	= $row_do_good_receipt_qc->ms_ref;
									$ms_ref1 	= $row_do_good_receipt_qc->ms_ref1;
									$ms_ref2   	= $row_do_good_receipt_qc->ms_ref2;

									$label				= 	"";
									$plat				= 	"";
									$button				= 	"";
									$pocket				= 	"";
									$resleting			= 	"";
									if($row_do_good_receipt_qc->label == 1) {
										$label = "checked";
									}
									if($row_do_good_receipt_qc->plat == 1) {
										$plat = "checked";
									}
									if($row_do_good_receipt_qc->button == 1) {
										$button = "checked";
									}
									if($row_do_good_receipt_qc->pocket == 1) {
										$pocket = "checked";
									}
									if($row_do_good_receipt_qc->resleting == 1) {
										$resleting = "checked";
									}

									$label1				= 	"";
									$plat1				= 	"";
									$button1				= 	"";
									$pocket1				= 	"";
									$resleting1			= 	"";
									if($row_do_good_receipt_qc->label1 == 1) {
										$label1 = "checked";
									}
									if($row_do_good_receipt_qc->plat1 == 1) {
										$plat1 = "checked";
									}
									if($row_do_good_receipt_qc->button1 == 1) {
										$button1 = "checked";
									}
									if($row_do_good_receipt_qc->pocket1 == 1) {
										$pocket1 = "checked";
									}
									if($row_do_good_receipt_qc->resleting1 == 1) {
										$resleting1 = "checked";
									}

									$label2				= 	"";
									$plat2				= 	"";
									$button2				= 	"";
									$pocket2				= 	"";
									$resleting2			= 	"";
									if($row_do_good_receipt_qc->label2 == 1) {
										$label2 = "checked";
									}
									if($row_do_good_receipt_qc->plat2 == 1) {
										$plat2 = "checked";
									}
									if($row_do_good_receipt_qc->button2 == 1) {
										$button2 = "checked";
									}
									if($row_do_good_receipt_qc->pocket2 == 1) {
										$pocket2 = "checked";
									}
									if($row_do_good_receipt_qc->resleting2 == 1) {
										$resleting2 = "checked";
									}

									//-----------from MS-------------
									$label_ms				= 	"";
									$plat_ms				= 	"";
									$button_ms				= 	"";
									$pocket_ms				= 	"";
									$resleting_ms			= 	"";
									$data_label 			=	$row_do_good_receipt_qc->label_ms;
									$data_plat 				=	$row_do_good_receipt_qc->plat_ms;
									$data_button 			=	$row_do_good_receipt_qc->button_ms;
									$data_pocket 			=	$row_do_good_receipt_qc->pocket_ms;
									$data_resleting			=	$row_do_good_receipt_qc->resleting_ms;
									if($row_do_good_receipt_qc->label_ms == 1) {
										$label_ms = "checked";
									}
									if($row_do_good_receipt_qc->plat_ms == 1) {
										$plat_ms = "checked";
									}
									if($row_do_good_receipt_qc->button_ms == 1) {
										$button_ms = "checked";
									}
									if($row_do_good_receipt_qc->pocket_ms == 1) {
										$pocket_ms = "checked";
									}
									if($row_do_good_receipt_qc->resleting_ms == 1) {
										$resleting_ms = "checked";
									}

									$label_ms1				= 	"";
									$plat_ms1				= 	"";
									$button_ms1				= 	"";
									$pocket_ms1				= 	"";
									$resleting_ms1			= 	"";
									$data_label1 			=	$row_do_good_receipt_qc->label_ms1;
									$data_plat1 			=	$row_do_good_receipt_qc->plat_ms1;
									$data_button1 			=	$row_do_good_receipt_qc->button_ms1;
									$data_pocket1 			=	$row_do_good_receipt_qc->pocket_ms1;
									$data_resleting1		=	$row_do_good_receipt_qc->resleting_ms1;
									if($row_do_good_receipt_qc->label_ms1 == 1) {
										$label_ms1 = "checked";
									}
									if($row_do_good_receipt_qc->plat_ms1 == 1) {
										$plat_ms1 = "checked";
									}
									if($row_do_good_receipt_qc->button_ms1 == 1) {
										$button_ms1 = "checked";
									}
									if($row_do_good_receipt_qc->pocket_ms1 == 1) {
										$pocket_ms1 = "checked";
									}
									if($row_do_good_receipt_qc->resleting_ms1 == 1) {
										$resleting_ms1 = "checked";
									}

									$label_ms2				= 	"";
									$plat_ms2				= 	"";
									$button_ms2				= 	"";
									$pocket_ms2				= 	"";
									$resleting_ms2			= 	"";
									$data_label2 			=	$row_do_good_receipt_qc->label_ms2;
									$data_plat2 			=	$row_do_good_receipt_qc->plat_ms2;
									$data_button2 			=	$row_do_good_receipt_qc->button_ms2;
									$data_pocket2 			=	$row_do_good_receipt_qc->pocket_ms2;
									$data_resleting2		=	$row_do_good_receipt_qc->resleting_ms2;
									if($row_do_good_receipt_qc->label_ms2 == 1) {
										$label_ms2 = "checked";
									}
									if($row_do_good_receipt_qc->plat_ms2 == 1) {
										$plat_ms2 = "checked";
									}
									if($row_do_good_receipt_qc->button_ms2 == 1) {
										$button_ms2 = "checked";
									}
									if($row_do_good_receipt_qc->pocket_ms2 == 1) {
										$pocket_ms2 = "checked";
									}
									if($row_do_good_receipt_qc->resleting_ms2 == 1) {
										$resleting_ms2 = "checked";
									}
				                    
								}	
								
							?>

                            <input type="hidden" id="vendor_code2" name="vendor_code2" value="<?php echo $row_do_good_receipt_qc->vendor_code ; ?>" >
            				<input type="hidden" id="old_ref" name="old_ref" value="<?php echo $row_do_good_receipt_qc->ref ; ?>" >
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Good Receipt No.'; } else { echo 'No. Penerimaan'; } ?> *)</label>
								<div class="col-sm-3">
									<input type="hidden" id="so_ref" name="so_ref" readonly="" class="form-control" value="<?php echo $so_ref ?>"> 
									<a style="font-size: 18px; font-weight: bold;" href="javascript:void(0);" name="Find" title="Detail Penerimaan" onClick=window.open("<?php echo $__folder ?>app/sales_order_view_detail.php?ref=<?php echo $so_ref ?>","Find","width=1200,height=600,left=50,top=20,toolbar=0,status=0,scroll=1,scrollbars=no"); >
										<?php echo $so_ref ?>
									</a>
								</div>
							</div>


                            <!-- FORM KIRI -->
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Vendor</label>
                                    <div class="col-6">
                                        <?php if($ref == "") { ?>
				                    		 <input type="hidden" id="vendor_code" name="vendor_code" value="<?php echo $vendor_code1 ; ?>" >
					                    	 <select id="vendor_code2" name="vendor_code2" disabled="" class="chosen-select form-control" >
					                          	<option value=""></option>
					                            <?php 
					                                select_vendor($vendor_code1) 
					                            ?>	
					                                                      
					                          </select>
					                    <?php } else { ?>
					                    	
					                    	  <input type="hidden" id="vendor_code" name="vendor_code" value="<?php echo $vendor_code ; ?>" >
					                    	  <select id="vendor_code2" name="vendor_code2" disabled="" class="chosen-select form-control" >
					                          	<option value=""></option>
					                            <?php 
					                                select_vendor($vendor_code) 
					                            ?>	
					                                                      
					                          </select>
					                    
					                    <?php } ?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">No. QC</label>
                                    <div class="col-6">
                                        <input type="text" id="ref" name="ref" readonly="" class="form-control" value="<?php echo $ref2 ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Tanggal<span class="required">*</span></label>
                                    <div class="col-6">
                                        <input class="datepicker-default form-control" type=" text" value="<?php echo $date ?>" id="date" name="date">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Status</label>
                                    <div class="col-5">
                                        <select class="destroy-selector" id="status" name="status">
                                            <option value=""></option>
                                            <?php 
                                                select_status($row_do_good_receipt_qc->status) 
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Memo<span class="required"></span></label>
                                    <div class="col-5">
                                        <textarea class="form-control" id="memo" name="memo" rows="3"><?php echo $memo ?></textarea>
                                    </div>
                                </div> 
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Upload Form QC Vendor<span class="required"></span></label>
                                    <div class="col-5">
                                        <?php if(allowlvl('frmdo_good_receipt_qc')==1 || $_SESSION['adm']==1) { ?>
											<input type="file" id="file_qc" name="file_qc" />
					                        <br />
					        				<?php if (!empty($row_do_good_receipt_qc->file_qc)) { ?>
					        					<a href="<?php echo $__folder ?>app/file_do_good_qc/<?php echo $row_do_good_receipt_qc->file_qc ?>" rel="lightbox" style="text-decoration:none;" title="Photo View">
													<label>
							        					<img src="<?php echo $__folder ?>app/file_do_good_qc/<?php echo $row_do_good_receipt_qc->file_qc; ?>" width="250" height="150" />
							        				</label>
							        			</a>
					        				<?php } ?>
					                        <input size="25" type="hidden" id="file_qc2" name="file_qc2" value="<?php echo $row_do_good_receipt_qc->file_qc; ?>">  
										<?php } else { ?>
											<input size="25" type="hidden" id="file_qc2" name="file_qc2" value="<?php echo $row_do_good_receipt_qc->file_qc; ?>">  
										<?php } ?>
                                    </div>
                                </div>  

                        	</div>
                    	</div>


                <!-- </div> -->
                <div class="col-12">
                    <div class="card">
                        <?php if ($ref == '') { ?>
                            <?php 
                                include('do_good_receipt_qc_detail.php');
                            ?>
                        <?php } else { ?>
                            <?php include('do_good_receipt_qc_detail_update.php') ?>
                        <?php } ?>


                        <div class="card-footer">
                            <div class="row" style="justify-content: flex-end;">

                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="submit" id="submit" class="btn btn-success me-6" style="margin: auto;width: 100%;color: white;" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('do_good_receipt_qc_view') ?>'" />
                                </div>
                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="button" class="btn btn-success" value="Print" onclick="print()" >
                                </div>


                                
                                <?php if (allowadd('frmdo_good_receipt_qc') == 1) { ?>
                                    <?php if ($ref == '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Save" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmdo_good_receipt_qc') == 1) { ?>
                                    <?php if ($ref != '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"> <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Update" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmdo_good_receipt_qc') == 1) { ?>
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
		
