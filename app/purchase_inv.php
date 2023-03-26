<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>


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
            alert('Supplier cannot empty!');                
          }
                  
          return false
        } 
                                        
      }     

      
      
      /*var item_code = document.getElementById('item_code2').value;
      
      if(item_code == "") {
          var change_amount = document.getElementById('change_amount').value;
          change_amount = change_amount.replace(/[^\d-.]/g,"");
          change_amount = change_amount.replace(",","");
          
          if(change_amount < 0) {
            alert('Kembalian harus lebih besar sama dengan nol !!!');
            return false
          }
      } */
       
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
        str2 = getId2 + '=' + document.getElementById(getId2).value;
        str3 = getId3 + '=' + document.getElementById(getId3).value;
        
        var str = str + '&button=' + button; // + button + '|' + getId2;
        str = str + '&' + str2;
        str = str + '&' + str3;
        
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
        ;
        var qty = 0;    
        qty=document.getElementById('qty_'+id).value; 
        //qty = number_format(qty,0,".",",");
        qty = qty.replace(/[^\d-.]/g,"");
        if(qty == "") {qty = 0};
                
        var unit_cost = 0;
        unit_cost=document.getElementById('unit_cost_'+id).value; 
        //unit_cost = number_format(unit_cost,0,".",",");
        unit_cost = unit_cost.replace(/[^\d-.]/g,"");
        if(unit_cost == "") {unit_cost = 0};
        
        var discount = 0;
        discount=document.getElementById('discount_'+id).value; 
        discount = discount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(discount == "") {discount = 0};
        
        //discoutn persen-1
        var discount3_1 = 0;
        discount3_1=document.getElementById('discount3_1_'+id).value; 
        discount3_1 = discount3_1.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(discount3_1 == "") {discount3_1 = 0};
        
        if( ketik == 'persen' ) {
            discount3_1 = (unit_cost * discount3_1) / 100;
            if(discount3_1 == "") {discount3_1 = 0};
            
            discount = discount3_1;   
        } 
        
        
        //discoutn persen-2
        var discount3_2 = 0;
        discount3_2=document.getElementById('discount3_2_'+id).value; 
        discount3_2 = discount3_2.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(discount3_2 == "") {discount3_2 = 0};
        
        if( ketik == 'persen' ) {
            unit_cost2 = parseFloat(unit_cost) - parseFloat(discount);
            discount3_2 = (unit_cost2 * discount3_2) / 100;
            if(discount3_2 == "") {discount3_2 = 0};
            
            discount = parseFloat(discount) + parseFloat(discount3_2); 
        } 
        
        //discoutn persen-3
        var discount3_3 = 0;
        discount3_3=document.getElementById('discount3_3_'+id).value; 
        discount3_3 = discount3_3.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(discount3_3 == "") {discount3_3 = 0};
               
        if( ketik == 'persen' ) {
            unit_cost3 = parseFloat(unit_cost) - parseFloat(discount);
            discount3_3 = (unit_cost3 * discount3_3) / 100;
            if(discount3_3 == "") {discount3_3 = 0};
             
            discount = parseFloat(discount) + parseFloat(discount3_3);   
        } 
        
        unit_cost = parseFloat(unit_cost) - parseFloat(discount);
        
        
        discount_value     = number_format(discount,2,".",",");
        
        if( ketik == 'persen' ) {
            $('#discount_det_id'+id).html('<input type="text" id="discount_'+id+'" name="discount_'+id+'" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka(\'discount_'+id+'\'), detailvalue(\''+id+'\', '+jmldata+', \'nominal\')" onKeyPress="return focusNext(\'submit_det\',event)" value="'+discount_value+'" >');
        } 
        
        
        //-------disc nominal
        var discount3 = 0;
        if( ketik == 'nominal' ) {
            
            var unit_cost_tmp = 0;
            unit_cost_tmp=document.getElementById('unit_cost_'+id).value; 
            unit_cost_tmp = unit_cost_tmp.replace(/[^\d-.]/g,"");
            if(unit_cost_tmp == "") {unit_cost_tmp = 0};
            
            discount3 = ( discount / unit_cost_tmp) * 100; 
            
        }   
        
        discount3_value    = number_format(discount3,2,".",",");
        if( ketik == 'nominal' ) {
            
           $('#discount3_det_id'+id).html('<input type="text" id="discount3_1_'+id+'" name="discount3_1_'+id+'" style="text-align: right; width: 60px" class="form-control" onkeyup="formatangka(\'discount3_1_'+id+'\'), detailvalue(\''+id+'\', '+jmldata+', \'persen\')" value="'+discount3_value+'" >');
           
        }
        //-------------------------
        
        
        var amount = 0;
        amount = parseFloat(qty) * parseFloat(unit_cost); // - parseFloat(discount); //document.getElementById('amount_'+id).value; 
        amount = number_format(amount,2,".",",");   
        
        
        $('#amount'+id).html('<input type="text" onkeyup="formatangka(\'amount_'+id+'\')" id="amount_'+id+'" name="amount_'+id+'" value="'+amount+'" readonly style="text-align:right; width: 150px" class="form-control" >');
        
        sub_total(jmldata);
        
        return false    
        
     }   
     
     function sub_total(jmldata){ 
        
        var i=0;
        var jumlah='0';
        var change_amount='0';
        var amount='0';
        
        for(i=0; i<=jmldata; i++){
            
            amount = document.getElementById('amount_'+i).value.replace(/[^\d.]/g,"");
            
            if(amount=='') { amount=0 }
            jumlah  =  parseFloat(jumlah) + parseFloat(amount);
            
            subtotal2(jumlah);
        }
        
        return false;
    }
    
    function subtotal2(jumlah) {
        
        var discount = 0;
        discount=document.getElementById('discount').value; 
        discount = discount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(discount == "") {discount = 0};
        
        jumlah = parseFloat(jumlah) - parseFloat(discount);
        
        var pos_amount = 0;
        pos_amount=document.getElementById('cash_amount').value; 
        pos_amount = pos_amount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(pos_amount == "") {pos_amount = 0};
        
        var bank_amount = 0;
        bank_amount=document.getElementById('bank_amount').value; 
        bank_amount = bank_amount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(bank_amount == "") {bank_amount = 0};
        
        var card_amount = 0;
        card_amount=document.getElementById('card_amount').value; 
        card_amount = card_amount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(card_amount == "") {card_amount = 0};
        
        
        
        //tax
        var jumlah2 = 0;
        var grand_total = 0;
        jumlah2 = jumlah;
        
        var tax_rate = 0;
        tax_rate=document.getElementById('tax_rate').value; 
        tax_rate = tax_rate.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(tax_rate == "") {tax_rate = 0};
        
        total_tax = (tax_rate * jumlah2)/100;
        jumlah2 = parseFloat(jumlah2) + parseFloat(total_tax);
        grand_total = jumlah2;
        
        total_tax = number_format(total_tax,2,".",",");
        jumlah2 = number_format(jumlah2,2,".",",");
        //-----------------/\--------
        
        jumlah = number_format(jumlah,2,".",",");   
        $('#sub_total_id').html('<input type="text" id="sub_totalx" name="sub_totalx" readonly style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('+sub_totalx+')" value="'+ jumlah +'"" >');
        
        $('#total_id').html('<input type="text" id="total" name="total" readonly style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('+total+')" value="'+ jumlah2 +'"" >');
        
        
        $('#total_id_top').html('TOTAL : '+ jumlah2 +'');
                                        
        //$('#total_id').html('<input type="text" id="total" name="total" readonly style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('+total+')" value="'+ jumlah2 +'"" >');
        
        //change
        change_amount = parseFloat(grand_total) - parseFloat(pos_amount) - parseFloat(bank_amount) - parseFloat(card_amount) ;
        change_amount = change_amount * -1;
        
        change_amount = number_format(change_amount,2,".",","); 
        $('#change_amount_id').html('<input type="text" id="change_amount" name="change_amount" readonly="" style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" value="'+ change_amount +'"" >');
                
        
        $('#total_tax_id').html('<input type="text" id="total_atx" name="total_tax" readonly style="text-align: right; font-size: 14px; font-weight: bold; width: 150px" class="form-control" onkeyup="formatangka('+total_tax+')" value="'+ total_tax +'" >');
        //-----------------/\
        
                
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
        totalcek = parseFloat(total) + parseFloat(amount_member);
        
        for(i=0; i<=jmldata; i++){
            
            memberlimit = document.getElementById('memberlimit'+i).value.replace(/[^\d.]/g,"");
            if(memberlimit=='') { memberlimit=0 }
            memberlimit     =  parseFloat(memberlimit);
            
            discmember = document.getElementById('discmember'+i).value.replace(/[^\d.]/g,"");
            if(discmember=='') { discmember=0 }
            discmember  =  parseFloat(discmember);
            
            if( memberlimit <= totalcek ) {
                discmember2 = discmember;
            }
            
            //alert(memberlimit);
            
        }
        
        
        
        memberlimit = (total * discmember2)/100;
        memberlimit2 = number_format(memberlimit,2,".",",");
        
        $('#total_discount_id').html('<input type="text" id="discount" name="discount" style="text-align: right; font-size: 16px" class="form-control" value="'+ memberlimit2 +'"" >');
        
    }
    
</script>

<script>
    
    function detailvalue2(ketik){       
        var qty = 0;    
        qty=document.getElementById('qty').value; 
        //qty = number_format(qty,2,".",",");
        qty = qty.replace(/[^\d-.]/g,"");
        if(qty == "") {qty = 0};
            
        var unit_cost = 0;
        unit_cost=document.getElementById('unit_cost').value; 
        //unit_cost = number_format(unit_cost,0,".",",");
        unit_cost = unit_cost.replace(/[^\d-.]/g,"");
        if(unit_cost == "") {unit_cost = 0};
        
        var discount = 0;
        discount=document.getElementById('discount_det').value; 
        discount = discount.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(discount == "") {discount = 0};
        
        //discoutn persen-1
        var discount3_1 = 0;
        discount3_1=document.getElementById('discount3_1_det').value; 
        discount3_1 = discount3_1.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(discount3_1 == "") {discount3_1 = 0};
            
        if( ketik == 'persen' ) {
            discount3_1 = (unit_cost * discount3_1) / 100;
            if(discount3_1 == "") {discount3_1 = 0};
            
            discount = discount3_1;   
        } 
        
        
        //discoutn persen-2
        var discount3_2 = 0;
        discount3_2=document.getElementById('discount3_2_det').value; 
        discount3_2 = discount3_2.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(discount3_2 == "") {discount3_2 = 0};
        
        
        if( ketik == 'persen' ) {
            unit_cost2 = parseFloat(unit_cost) - parseFloat(discount);
            discount3_2 = (unit_cost2 * discount3_2) / 100;
            if(discount3_2 == "") {discount3_2 = 0};
            
            discount = parseFloat(discount) + parseFloat(discount3_2);   
        } 
        
        //discoutn persen-3
        var discount3_3 = 0;
        discount3_3=document.getElementById('discount3_3_det').value; 
        discount3_3 = discount3_3.replace(/[^\d.]/g,""); //discount.replace(/[^\d-.]/g,"");
        if(discount3_3 == "") {discount3_3 = 0};
        
        
        if( ketik == 'persen' ) {
            unit_cost3 = parseFloat(unit_cost) - parseFloat(discount);
            discount3_3 = (unit_cost3 * discount3_3) / 100;
            if(discount3_3 == "") {discount3_3 = 0};
            
            discount = parseFloat(discount) + parseFloat(discount3_3);   
        } 
             
        //---------------/\
        unit_cost = parseFloat(unit_cost) - parseFloat(discount);
        
        var amount = 0;
        amount = parseFloat(qty) * parseFloat(unit_cost); // - parseFloat(discount); //document.getElementById('amount_'+id).value; 
        amount = number_format(amount,2,".",",");   
        
        discount_value     = number_format(discount,2,".",",");
        
        if( ketik == 'persen' ) {
            $('#discount_det_id').html('<input type="text" onkeyup="formatangka(\'discount_det\'), detailvalue2(\'nominal\')" id="discount_det" name="discount_det" onKeyPress="return focusNext(\'submit_det\',event)" value="'+discount_value+'" style="text-align:right; width: 90px" >');
        }
        
        //-------disc nominal
        var discount3 = 0;
        if( ketik == 'nominal' ) {
            var unit_cost_tmp = 0;
            unit_cost_tmp=document.getElementById('unit_cost').value; 
            unit_cost_tmp = unit_cost_tmp.replace(/[^\d-.]/g,"");
            if(unit_cost_tmp == "") {unit_cost_tmp = 0};
            
            discount3 = ( discount / unit_cost_tmp) * 100; 
        }   
        
        discount3_1_value    = number_format(discount3,2,".",",");
        if( ketik == 'nominal' ) {
            $('#discount3_1_det_id').html('<input type="text" onkeyup="formatangka(\'discount3_1_det\'), detailvalue2(\'persen\')" id="discount3_1_det" name="discount3_1_det" value="'+discount3_1_value+'" style="text-align:right; width: 90px" >');
        }
        //-------------------------
        
        $('#amount_det').html('<input type="text" onkeyup="formatangka(\'amount\')" id="amount" name="amount" value="'+amount+'" readonly style="text-align:right; width: 100px" >');
        
        
        return false    
        
     }   
</script>

<script language="javascript">

    function hapus(id,line) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('purchase_inv') ?>&mxKz=xm8r389xemx23xb2378e23&xndf="+id+"&line="+line+" ";
        }
    }
    
    function update(id, no) {   
    
        var line        = document.getElementById('old_line_'+no).value;
        var qty         = document.getElementById('qty_'+no).value;
        var unit_cost   = document.getElementById('unit_cost_'+no).value;
        var discount3_1 = document.getElementById('discount3_1_'+no).value;
        var discount    = document.getElementById('discount_'+no).value;
        var amount      = document.getElementById('amount_'+no).value;
        
        document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('purchase_inv') ?>&mxKz=upd&xndf="+id+"&line="+line+"&qty="+qty+"&unit_cost="+unit_cost+"&discount_p="+discount3_1+"&discount="+discount+"&amount="+amount+" ";
        
    }
    
    function print() {
        var ref = document.getElementById('ref').value;
        
        window.open('<?php echo $__folder ?>app/purchase_inv_print.php?ref='+ref, 'Invoice Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
    }

    function submitForm(tipe)
    {
        
        if(tipe == 'print') {
            //document.getElementById("delord_view").action = "app/delord_print.php";
            $("#purchase_inv").attr('action', 'app/purchase_inv_print.php')
               .attr('target', '_BLANK');
            $("#purchase_inv").submit();
            
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
        
        window.open('app/purchase_inv_item_history.php?vendor_code='+vendor_code, 'Item History','825','950','resizable=1,scrollbars=1,status=0,toolbar=0')
    }
    
    function chequehistory() {
        var vendor_code = document.getElementById('vendor_code').value;
        
        window.open('app/purchase_inv_cheque_history.php?vendor_code='+vendor_code, 'Cheque History','825','2000','resizable=1,scrollbars=1,status=0,toolbar=0')
    }
</script>

<!--//shortcut-->
<script>
    document.onkeydown = function (e) {
        switch (e.keyCode) {
            //F3 (Bayar)
            case 114:
                document.getElementById('cash_amount').focus();
                e.preventDefault();
                break;
            
            //F2 (Kolom Kode Barang)
            case 113:
                document.getElementById('item_code2').focus();
                e.preventDefault();
                break;
        }
                 
            //F4 (Ke Kolom Member)
            /*case 115:
                document.getElementById('client_member_code2').focus();
                e.preventDefault();
                break;
                
            //F1 (Form Baru)
            case 112:
                window.location = 'main.php?menu=app&act=<?php echo obraxabrix(pos) ?>';
                e.preventDefault();
                break;*/
            
        
    };
</script>
            

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                        <?php 
                            $ref = $segmen3; //$_GET['search'];
                            //$xndf = $segmen3; //$_GET['xndf'];
                            
                            /*if(!preg_match('/POV/i', $ref)) {
                                $ref = "";
                            }*/
                            
                            //jika saat add data, maka data setelah save kosong
                            if ($_POST['submit'] == 'Save') { $ref = ''; }
                            //-----------------------------------------------/\
                                
                            $ref2 = notran(date('y-m-d'), 'frmpurchase_inv', '', '', ''); 
                                
                            include("app/exec/purchase_inv_insert.php"); 
                            
                            
                            $date = date("d F, Y");
                            $date_need = date("d F, Y");
                            $due_date = date("d F, Y");
                            
                            $location_id = $_SESSION['location_id2'];
                            $location_id2 = $_SESSION['location_id2'];
                            
                            $stock_in = " checked ";
                            
                            $admin = $_SESSION["adm"];
                            $payment_type1 = "";
                            $payment_type2 = "checked";
                            $payment_type3 = "";
                                                        
                                                    
                            if ($ref != "") {
                                $sql=$select->list_purchase_inv($ref);
                                $row_purchase_inv=$sql->fetch(PDO::FETCH_OBJ);  
                                
                                $ref2 = $row_purchase_inv->ref; 
                                $ref22 = $row_purchase_inv->ref2;
                                $date = date("d F, Y", strtotime($row_purchase_inv->date));
                                $tax_rate = number_format($row_purchase_inv->tax_rate, 2, '.', ',');
                                $freight_cost = number_format($row_purchase_inv->freight_cost, 2, '.', ',');
                                
                                $vendor_code  = $row_purchase_inv->vendor_code; 
                                $client_name  = $row_purchase_inv->client_name; 
                                $total = number_format($row_purchase_inv->total, 2, '.', ',');
                                $cash_amount = number_format($row_purchase_inv->cash_amount,2,".",",");
                                $bank_amount = number_format($row_purchase_inv->bank_amount,2,".",",");
                                $card_amount = number_format($row_purchase_inv->card_amount,2,".",",");
                                $discount2 = number_format($row_purchase_inv->discount,2,".",",");
                                $grand_total = number_format($row_purchase_inv->total, 2, '.', ',');
                                
                                $due_date = date("d-m-Y", strtotime($row_purchase_inv->due_date));
                                if($row_purchase_inv->pos == 1) {
                                    $pos = " checked ";
                                    $pos2 = "1";
                                } else {
                                    $pos = "";
                                }
                                
                                $deposit = number_format($row_purchase_inv->deposit, 2, '.', ',');
                                
                                $disabled = "disabled";
                                if($admin == 1) {
                                    $disabled = "";
                                }
                                
                                if($row_purchase_inv->taxable == 1) {
                                    $taxable = "checked";
                                }
                                
                                $location_id = $row_purchase_inv->location_id;
                                
                                $stock_in = "";
                                if($row_purchase_inv->stock_in == 1) {
                                    $stock_in = " checked ";
                                }
                                
                                $payment_type = "";
                                $payment_type1 = "";
                                $payment_type2 = "";
                                if($row_purchase_inv->payment_type == "Transfer") {
                                    $payment_type = "checked";
                                    $payment_type1 = "";
                                    $payment_type2 = "";
                                }
                                if($row_purchase_inv->payment_type == "Midtrans") {
                                    $payment_type = "";
                                    $payment_type1 = "checked";
                                    $payment_type2 = "";
                                }
                                if($row_purchase_inv->payment_type == "Kredit") {
                                    $payment_type = "";
                                    $payment_type1 = "";
                                    $payment_type2 = "checked";
                                }
                                
                            }   
                            
                                
                        ?>

                        <form role="form" action="" method="post" name="purchase_inv" id="purchase_inv" enctype="multipart/form-data" onSubmit="return cekinput('ref,date,vendor_code');" >

                <div class="card">
                    <div class="card-body">
                            <input type="hidden" id="old_location_id" name="old_location_id" value="<?php echo $row_purchase_inv->location_id ; ?>" >
                            <input type="hidden" id="location_id" name="location_id" value="<?php echo $row_purchase_inv->location_id ; ?>" >
                            <input type="hidden" id="old_ref" name="old_ref" value="<?php echo $row_purchase_inv->ref ; ?>" >
                            
                            <input type="hidden" id="xndf" name="xndf" value="<?php echo $xndf ; ?>" >

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
                                                    combo_select_active("vendor","syscode","name","active","1",$row_purchase_inv->vendor_code) 
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
                                        <label class="col-2 col-form-label">Jatuh Tempo<span class="required">*</span></label>
                                        <div class="col-10">
                                            <input class="datepicker-default form-control"" type="text" value="<?php echo $due_date ?>" id="due_date" name="due_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Jenis Pembayaran</label>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_type" id="payment_type" value="Transfer" <?= $payment_type ?> >
                                                <label class="form-check-label">
                                                    Transfer Manual
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_type" id="payment_type1" value="Midtrans" <?= $payment_type1 ?> >
                                                <label class="form-check-label">
                                                    Midtrans
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_type" id="payment_type2" value="Kredit" <?= $payment_type2 ?> >
                                                <label class="form-check-label">
                                                    Kredit
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Jenis Order<span class="required">*</span></label>
                                        <div class="col-10">
                                            <select class="destroy-selector" id="purchase_type" name="purchase_type">
                                                <option value=""></option>
                                                <?php 
                                                    combo_select_active("purchase_type","id","name","active","1",$row_purchase_inv->purchase_type) 
                                                ?>  
                                            </select>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <!-- FORM KIRI -->
                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">PPN %</label>
                                        <div class="col-10">
                                            <input type="number" class="form-control" placeholder="%" id="tax_rate" name="tax_rate" value="<?php echo $tax_rate ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Bank Penerima</label>
                                        <div class="col-10">
                                            <select class="destroy-selector" id="bank_id" name="bank_id">
                                            <option value=""></option>
                                            <?php select_bank($row_purchase_inv->bank_id) ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label class="col-2 col-form-label">Nomor Rekening</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="No. Rekening" value="<?= $row_purchase_inv->bank_account ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                   </div>
                </div>
             <!-- </div> -->
            <div class="col-12">
                <div class="card">
                    
                    <?php if($ref=='') { ?>
                        <?php include('purchase_inv_detail.php') ?>
                    <?php } else { ?>
                        <?php include('purchase_inv_detail_update.php') ?>
                    <?php } ?>

                    <div class="card-footer">
                        <div class="row" style="justify-content: flex-end;">
                            <div class="col-lg-2 col-md-3 col-4"><input type="button" name="submit" id="submit" class="btn btn-success" style="margin: auto;width: 100%;color: white;" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'.obraxabrix('purchase_inv_view') ?>'" /></div>
                            <?php if (allowadd('frmpurchase_inv')==1) { ?>
                                <?php if($ref=='') { ?>
                                    <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" id="submit" style="margin: auto;width: 100%;color: white;" class='btn btn-primary me-6' value="Save" /></div>
                                <?php } ?>
                            <?php } ?>

                            <?php if (allowupd('frmpurchase_inv')==1) { ?>
                                <?php if($ref!='') { ?>
                                    <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" id="submit" style="margin: auto;width: 100%;color: white;" class='btn btn-primary me-6' value="Update" /></div>
                                <?php } ?>
                            <?php } ?>
                            
                            <?php if (allowdel('frmpurchase_inv')==1) { ?>
                                <?php if($ref!='') { ?>
                                    <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" class="btn btn-danger" style="margin: auto;width: 100%;color: white;" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" ></div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        <!-- </div> -->
    </div>
</div>
        </form>
