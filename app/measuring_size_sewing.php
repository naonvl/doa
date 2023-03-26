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
		  
		  if (document.getElementById(arrf[i]).name=='client_code') {
			alert('Customer cannot empty!');				
		  }
		  		  
		  return false
		} 
										
	  }		
	  
	  var item_code = document.getElementById('item_code2').value;
	  
	  if(item_code == "") {
		  var change_amount = document.getElementById('change_amount').value;
		  change_amount = change_amount.replace(/[^\d-.]/g,"");
		  change_amount = change_amount.replace(",","");
		  
		  if(change_amount < 0) {
		  	alert('Kembalian harus lebih besar sama dengan nol !!!');
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


<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost4(URL, destination, button, getId, getId2, getId3){
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
		var change_amount='0';
		var total_qty='0';
		
		for(i=0; i<=jmldata; i++){
			
			total_qty = document.getElementById('qty_'+i).value.replace(/[^\d.]/g,"");
			
			if(total_qty=='') { total_qty=0 }
			jumlah 	=  parseInt(jumlah) + parseInt(total_qty);
			
			subtotal2(jumlah);
		}
		
		return false;
	}
	
	function subtotal2(jumlah) {
		
		jumlah = number_format(jumlah,0,".",",");	
		$('#total_id').html('<input type="text" id="total" name="total" readonly style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" onkeyup="formatangka('+total+')" value="'+ jumlah +'"" >');
		
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
			document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('measuring_size_sewing') ?>/xm8r389xemx23xb2378e23/"+id+"/"+line+" ";
		}
	}
	
	function print() {
		var so_ref = "";
		var rows_so = document.getElementById('rows_so').value;
		if(rows_so > 0) {
			var valid = false;
			for(i=0; i<rows_so; i++) {
				var sor_ref1 = document.getElementById('sor_ref1_'+i).checked;
				
				if(sor_ref1 == true) {
					so_ref = document.getElementById('so_ref_'+i).value;

					valid = true;
				}
			}

			if(valid == false) {
				alert('No PO harus dipilih salah satu !');
				return false;
			}
		}
		
		var ref = document.getElementById('ref').value;
		window.open('<?php echo $__folder ?>app/measuring_size_sewing_print.php?ref='+ref+'&so_ref='+so_ref, 'Invoice Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')

	}


	function submitForm(tipe)
    {
    	
    	if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#measuring_size_sewing").attr('action', 'app/measuring_size_sewing_print.php')
			   .attr('target', '_BLANK');
			$("#measuring_size_sewing").submit();
			
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
		
		window.open('app/measuring_size_sewing_item_history.php?client_code='+client_code, 'Item History','825','950','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function chequehistory() {
		var client_code = document.getElementById('client_code').value;
		
		window.open('app/measuring_size_sewing_cheque_history.php?client_code='+client_code, 'Cheque History','825','2000','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
</script>


<script>
	function validasiFile(){
	    var inputFile = document.getElementById('photo');
	    var pathFile = inputFile.value;
	    var ekstensiOk = /(\.jpeg|jpg)$/i;
	    if(!ekstensiOk.exec(pathFile)){
	        alert('Silakan upload file yang memiliki ekstensi .jpg|jpeg');
	        inputFile.value = '';
	        return false;
	    }else{
	        //Pratinjau gambar
	        if (inputFile.files && inputFile.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                document.getElementById('photo').innerHTML = '<img src="'+e.target.result+'"/>';
	            };
	            reader.readAsDataURL(inputFile.files[0]);
	        }
	    }
	}

	function validasiFile1(){
	    var inputFile = document.getElementById('photo1');
	    var pathFile = inputFile.value;
	    var ekstensiOk = /(\.jpeg|jpg)$/i;
	    if(!ekstensiOk.exec(pathFile)){
	        alert('Silakan upload file yang memiliki ekstensi .jpg|jpeg');
	        inputFile.value = '';
	        return false;
	    }else{
	        //Pratinjau gambar
	        if (inputFile.files && inputFile.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                document.getElementById('photo1').innerHTML = '<img src="'+e.target.result+'"/>';
	            };
	            reader.readAsDataURL(inputFile.files[0]);
	        }
	    }
	}


	function validasiFile2(){
	    var inputFile = document.getElementById('photo2');
	    var pathFile = inputFile.value;
	    var ekstensiOk = /(\.jpeg|jpg)$/i;
	    if(!ekstensiOk.exec(pathFile)){
	        alert('Silakan upload file yang memiliki ekstensi .jpg|jpeg');
	        inputFile.value = '';
	        return false;
	    }else{
	        //Pratinjau gambar
	        if (inputFile.files && inputFile.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                document.getElementById('photo2').innerHTML = '<img src="'+e.target.result+'"/>';
	            };
	            reader.readAsDataURL(inputFile.files[0]);
	        }
	    }
	}


	function validasiFile3(){
	    var inputFile = document.getElementById('photo3');
	    var pathFile = inputFile.value;
	    var ekstensiOk = /(\.jpeg|jpg)$/i;
	    if(!ekstensiOk.exec(pathFile)){
	        alert('Silakan upload file yang memiliki ekstensi .jpg|jpeg');
	        inputFile.value = '';
	        return false;
	    }else{
	        //Pratinjau gambar
	        if (inputFile.files && inputFile.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                document.getElementById('photo3').innerHTML = '<img src="'+e.target.result+'"/>';
	            };
	            reader.readAsDataURL(inputFile.files[0]);
	        }
	    }
	}

	function validasiFile4(){
	    var inputFile = document.getElementById('photo4');
	    var pathFile = inputFile.value;
	    var ekstensiOk = /(\.jpeg|jpg)$/i;
	    if(!ekstensiOk.exec(pathFile)){
	        alert('Silakan upload file yang memiliki ekstensi .jpg|jpeg');
	        inputFile.value = '';
	        return false;
	    }else{
	        //Pratinjau gambar
	        if (inputFile.files && inputFile.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                document.getElementById('photo4').innerHTML = '<img src="'+e.target.result+'"/>';
	            };
	            reader.readAsDataURL(inputFile.files[0]);
	        }
	    }
	}


	function validasiFile5(){
	    var inputFile = document.getElementById('photo5');
	    var pathFile = inputFile.value;
	    var ekstensiOk = /(\.jpeg|jpg)$/i;
	    if(!ekstensiOk.exec(pathFile)){
	        alert('Silakan upload file yang memiliki ekstensi .jpg|jpeg');
	        inputFile.value = '';
	        return false;
	    }else{
	        //Pratinjau gambar
	        if (inputFile.files && inputFile.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                document.getElementById('photo5').innerHTML = '<img src="'+e.target.result+'"/>';
	            };
	            reader.readAsDataURL(inputFile.files[0]);
	        }
	    }
	}


	function validasiFile6(){
	    var inputFile = document.getElementById('photo6');
	    var pathFile = inputFile.value;
	    var ekstensiOk = /(\.jpeg|jpg)$/i;
	    if(!ekstensiOk.exec(pathFile)){
	        alert('Silakan upload file yang memiliki ekstensi .jpg|jpeg');
	        inputFile.value = '';
	        return false;
	    }else{
	        //Pratinjau gambar
	        if (inputFile.files && inputFile.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                document.getElementById('photo6').innerHTML = '<img src="'+e.target.result+'"/>';
	            };
	            reader.readAsDataURL(inputFile.files[0]);
	        }
	    }
	}


	function validasiFile7(){
	    var inputFile = document.getElementById('photo7');
	    var pathFile = inputFile.value;
	    var ekstensiOk = /(\.jpeg|jpg)$/i;
	    if(!ekstensiOk.exec(pathFile)){
	        alert('Silakan upload file yang memiliki ekstensi .jpg|jpeg');
	        inputFile.value = '';
	        return false;
	    }else{
	        //Pratinjau gambar
	        if (inputFile.files && inputFile.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                document.getElementById('photo7').innerHTML = '<img src="'+e.target.result+'"/>';
	            };
	            reader.readAsDataURL(inputFile.files[0]);
	        }
	    }
	}

</script>


<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <form class="row" role="form" action="" method="post" name="pos" id="pos" enctype="multipart/form-data" onSubmit="return cekinput('ref,date,client_code,employee_id,channel_id');">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">
                            <?php 
				          		$ref = $segmen3; //$_GET['search'];
				          										
								//jika saat add data, maka data setelah save kosong
								if ($_POST['submit'] == 'Save') { $ref = ''; }
								//-----------------------------------------------/\
									
								$ref2 = notran(date('y-m-d'), 'frmmeasuring_size_sewing', '', '', ''); 
									
								include("app/exec/measuring_size_sewing_insert.php"); 
												
								$cash = "checked";
								$cash2 = "0";
				                
				                $admin = $_SESSION["adm"];
				                
				                $status = "R";
								$insert = "1";
								$disable = "";
								
								$date = date("d F, Y");
								$transfer_date = date("d F, Y");
								$due_date = date("d F, Y");
								$acc_date_client = date("d F, Y");
								$label  = "";
								$label1 = "checked";
				                
				                /*if(substr($ref, 0, 3) == "CNT") {
				                	
				                	$sql=$select->get_counting_ms($ref);
									$row_measuring_size_sewing=$sql->fetch(PDO::FETCH_OBJ);	
									
									$client_code1  = $row_measuring_size_sewing->client_code;	
									$client_name  = $row_measuring_size_sewing->client_name;	
									$so_ref = $row_measuring_size_sewing->so_ref;
									$counting_ref = $row_measuring_size_sewing->ref;
									//get memo Counting
									// $sql_counting = $select->get_data_counting($ref);
									// $row_counting=$sql_counting->fetch(PDO::FETCH_OBJ);
									// $memo_counting = $row_counting->memo;
									//--------/\---------
									
									$ref = "";
								}

								if(substr($ref, 0, 3) == "BK-" || substr($ref, 0, 3) == "SPL") {
				                	
				                	$sql=$select->get_counting_ms_so($ref);
									$row_measuring_size_sewing=$sql->fetch(PDO::FETCH_OBJ);	
									
									$client_code1  = $row_measuring_size_sewing->client_code;	
									$client_name  = $row_measuring_size_sewing->client_name;	
									$so_ref = $row_measuring_size_sewing->so_ref;
									$counting_ref = $row_measuring_size_sewing->ref;
									
									$ref = "";
								}*/
				                
								if ($ref != "") {
									$sql=$select->list_measuring_size_sewing($ref);
									$row_measuring_size_sewing=$sql->fetch(PDO::FETCH_OBJ);	
									
									$ref2 = $row_measuring_size_sewing->ref;	
									$ref22 = $row_measuring_size_sewing->ref2;
									$date = date("d F, Y", strtotime($row_measuring_size_sewing->date));
									$so_ref = $row_measuring_size_sewing->so_ref;
									
									$counting_ref = $row_measuring_size_sewing->counting_ref;
									$client_code  = $row_measuring_size_sewing->client_code;	
									$client_name  = $row_measuring_size_sewing->client_name;	
									$memo  		  = $row_measuring_size_sewing->memo;
									$acc_date_client = date("d F, Y", strtotime($row_measuring_size_sewing->acc_date_client));
									if($acc_date_client == "01-01-1970") {
										$acc_date_client = "";
									}

									/*$label = "";
									if($row_measuring_size_sewing->label == 1) {
										$label = "checked";
									}

									$label1 = "";
									if($row_measuring_size_sewing->label == 0) {
										$label1 = "checked";
									}*/

									$label				= 	"";
									$plat				= 	"";
									$button				= 	"";
									$pocket				= 	"";
									$resleting			= 	"";
									if($row_measuring_size_sewing->label == 1) {
										$label = "checked";
									}
									if($row_measuring_size_sewing->plat == 1) {
										$plat = "checked";
									}
									if($row_measuring_size_sewing->button == 1) {
										$button = "checked";
									}
									if($row_measuring_size_sewing->pocket == 1) {
										$pocket = "checked";
									}
									if($row_measuring_size_sewing->resleting == 1) {
										$resleting = "checked";
									}
								}
									
							?>

                            <input type="hidden" id="old_location_id" name="old_location_id" value="<?php echo $row_measuring_size_sewing->location_id ; ?>" >
			            	<input type="hidden" id="location_id" name="location_id" value="<?php echo $location_id ; ?>" >
			            	<input type="hidden" id="client_code2" name="client_code2" value="<?php echo $row_measuring_size_sewing->client_code ; ?>" >
			            	<input type="hidden" id="old_ref" name="old_ref" value="<?php echo $row_measuring_size_sewing->ref ; ?>" >
							
							<input type="hidden" id="xndf" name="xndf" value="<?php echo $xndf ; ?>" >


                            <!-- FORM KIRI -->
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">No. MS</label>
                                    <div class="col-6">
                                        <input class="form-control" type="text" readonly value="<?php echo $ref2 ?>" id="ref" name="ref">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Tanggal<span class="required">*</span></label>
                                    <div class="col-6">
                                        <input class="datepicker-default form-control" type=" text" value="<?php echo $date ?>" id="date" name="date">
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Series</label>
                                    <div class="col-6">
                                        <input class="form-control" type="text" value="<?php echo $row_measuring_size_sewing->series ?>" id="series" name="series">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">BR</label>
                                    <div class="col-6">
                                        <input class="form-control" type="text" value="<?php echo $row_measuring_size_sewing->br ?>" id="br" name="br">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Sampling</label>
                                    <div class="col-5">
                                        <select class="destroy-selector" id="sampling" name="sampling">
                                            <option value=""></option>
                                            <?php 
                                                select_sampling_ms($row_measuring_size_sewing->sampling) 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Memo<span class="required"></span></label>
                                    <div class="col-5">
                                        <textarea class="form-control" id="memo" name="memo" rows="3"><?php echo $row_measuring_size_sewing->memo ?></textarea>
                                    </div>
                                </div>  
                            	
                            	<div class="mb-3 row">
                                    <label class="col-3 col-form-label">Qty<span class="required"></span></label>
                                    <div class="col-5">
                                        <input type="text" class="form-control" id="qty" name="qty" onkeyup="formatangka('qty')" autocomplete="off" style="text-align: right;" value="<?= number_format($row_measuring_size_sewing->qty,0,'.',',') ?>">
                                    </div>
                                </div>

	                            <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Press Speed<span class="required"></span></label>
                                    <div class="col-5">
                                        <input type="text" class="form-control" id="mcn_press_speed" name="mcn_press_speed" onkeyup="formatangka('mcn_press_speed')" autocomplete="off" value="<?= number_format($row_measuring_size_sewing->mcn_press_speed,0,'.',',') ?>">
                                    </div>
                                </div>

	                            <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Press Temp.<span class="required"></span></label>
                                    <div class="col-5">
                                        <input type="text" class="form-control" id="mcn_press_temperature" name="mcn_press_temperature" onkeyup="formatangka('mcn_press_temperature')" autocomplete="off" value="<?= number_format($row_measuring_size_sewing->mcn_press_temperature,0,'.',',') ?>">
                                    </div>
                                </div>

                        	</div>
                    </div>
                <!-- </div> -->
                <div class="col-12">
                    <div class="card">
                        <?php if ($ref == '') { ?>
                            <?php 
                                include('measuring_size_sewing_detail.php');
                            ?>
                        <?php } else { ?>
                            <?php include('measuring_size_sewing_detail_update.php') ?>
                        <?php } ?>

                        <div class="card-body">
    						<div class="table-responsive py-4">
		                        <table class="table table-bordered table-condensed table-hover table-striped">
									<tbody>
										<tr>
											<td width="10%">Photo-1 :</td>
											<td width="40%">
												<input type="file" id="photo" name="photo" accept="image/*" onchange="return validasiFile()" />
						                        <br />
						        				<?php if (!empty($row_measuring_size_sewing->photo)) { ?>
						        					<img src="../app/photo_ms/<?php echo $row_measuring_size_sewing->photo; ?>" width="160" height="150" />
						        				<?php } ?>
						                        <input type="hidden" id="photo2x" name="photo2x" value="<?php echo $row_measuring_size_sewing->photo; ?>">
											</td>
											<td width="10%">Photo-2 :</td>
											<td width="40%">
												<input type="file" id="photo1" name="photo1" accept="image/*" onchange="return validasiFile1()" />
						                        <br />
						        				<?php if (!empty($row_measuring_size_sewing->photo1)) { ?>
						        					<img src="../app/photo_ms/<?php echo $row_measuring_size_sewing->photo1; ?>" width="160" height="150" />
						        				<?php } ?>
						                        <input type="hidden" id="photo12" name="photo12" value="<?php echo $row_measuring_size_sewing->photo1; ?>">
											</td>
										</tr>
										<tr>
											<td>Photo-3 :</td>
											<td>
												<input type="file" id="photo2" name="photo2" accept="image/*" onchange="return validasiFile2()" />
						                        <br />
						        				<?php if (!empty($row_measuring_size_sewing->photo2)) { ?>
						        					<img src="../app/photo_ms/<?php echo $row_measuring_size_sewing->photo2; ?>" width="160" height="150" />
						        				<?php } ?>
						                        <input type="hidden" id="photo22" name="photo22" value="<?php echo $row_measuring_size_sewing->photo2; ?>">
											</td>
											<td>Photo-4 :</td>
											<td>
												<input type="file" id="photo3" name="photo3" accept="image/*" onchange="return validasiFile3()" />
						                        <br />
						        				<?php if (!empty($row_measuring_size_sewing->photo3)) { ?>
						        					<img src="../app/photo_ms/<?php echo $row_measuring_size_sewing->photo3; ?>" width="160" height="150" />
						        				<?php } ?>
						                        <input type="hidden" id="photo32" name="photo32" value="<?php echo $row_measuring_size_sewing->photo3; ?>">
											</td>
										</tr>
										<tr>
											<td width="10%">Photo-5 :</td>
											<td width="40%">
												<input type="file" id="photo4" name="photo4" accept="image/*" onchange="return validasiFile4()" />
						                        <br />
						        				<?php if (!empty($row_measuring_size_sewing->photo4)) { ?>
						        					<img src="../app/photo_ms/<?php echo $row_measuring_size_sewing->photo4; ?>" width="160" height="150" />
						        				<?php } ?>
						                        <input type="hidden" id="photo42" name="photo42" value="<?php echo $row_measuring_size_sewing->photo4; ?>">
											</td>
											<td width="10%">Photo-6 :</td>
											<td width="40%">
												<input type="file" id="photo5" name="photo5" accept="image/*" onchange="return validasiFile5()" />
						                        <br />
						        				<?php if (!empty($row_measuring_size_sewing->photo5)) { ?>
						        					<img src="../app/photo_ms/<?php echo $row_measuring_size_sewing->photo5; ?>" width="160" height="150" />
						        				<?php } ?>
						                        <input type="hidden" id="photo52" name="photo52" value="<?php echo $row_measuring_size_sewing->photo5; ?>">
											</td>
										</tr>
										<tr>
											<td width="10%">Photo-7 :</td>
											<td width="40%">
												<input type="file" id="photo6" name="photo6" accept="image/*" onchange="return validasiFile6()" />
						                        <br />
						        				<?php if (!empty($row_measuring_size_sewing->photo6)) { ?>
						        					<img src="../app/photo_ms/<?php echo $row_measuring_size_sewing->photo6; ?>" width="160" height="150" />
						        				<?php } ?>
						                        <input type="hidden" id="photo62" name="photo62" value="<?php echo $row_measuring_size_sewing->photo6; ?>">
											</td>
											<td width="10%">Photo-8 :</td>
											<td width="40%">
												<input type="file" id="photo7" name="photo7" accept="image/*" onchange="return validasiFile7()" />
						                        <br />
						        				<?php if (!empty($row_measuring_size_sewing->photo7)) { ?>
						        					<img src="../app/photo_ms/<?php echo $row_measuring_size_sewing->photo7; ?>" width="160" height="150" />
						        				<?php } ?>
						                        <input type="hidden" id="photo72" name="photo72" value="<?php echo $row_measuring_size_sewing->photo7; ?>">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

                        <div class="card-footer">
                            <div class="row" style="justify-content: flex-end;">

                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="submit" id="submit" class="btn btn-success me-6" style="margin: auto;width: 100%;color: white;" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('measuring_size_sewing_view') ?>'" />
                                </div>
                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="button" class="btn btn-success" value="Print" onclick="print()" >
                                </div>
                                <?php if (allowadd('frmmeasuring_size_sewing') == 1) { ?>
                                    <?php if ($ref == '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Save" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmmeasuring_size_sewing') == 1) { ?>
                                    <?php if ($ref != '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"> <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Update" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmmeasuring_size_sewing') == 1) { ?>
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
		
