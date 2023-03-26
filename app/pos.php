<script src="<?php echo $__folder ?>js/appcustom.js"></script>
<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>

<script language="javascript">
    function cekinput(fid) {
        var arrf = fid.split(',');
        for (i = 0; i < arrf.length; i++) {

            if (document.getElementById(arrf[i]).value == '') {

                if (document.getElementById(arrf[i]).name == 'ref') {
                    alert('Ref. cannot empty!');
                }

                if (document.getElementById(arrf[i]).name == 'date') {
                    alert('Date cannot empty!');
                }

                if (document.getElementById(arrf[i]).name == 'location_id') {
                    alert('Location cannot empty!');
                }

                if (document.getElementById(arrf[i]).name == 'client_code') {
                    alert('Customer cannot empty!');
                }

                if (document.getElementById(arrf[i]).name=='channel_id') {
                  alert('Jenis Channel cannot empty!');               
                }

                if (document.getElementById(arrf[i]).name == 'employee_id') {
                    alert('Admin/Kasir cannot empty!');
                }

                return false
            }

        }

        var client_code = document.getElementById('client_code').value;
        var newclient = document.getElementById('newclient').checked;
        if (newclient == false) {
            if (client_code == "") {
                alert('Customer cannot empty!');
                return false;
            }
        }

        var item_code = document.getElementById('item_code2').value;

        if (item_code == "") {
            var change_amount = document.getElementById('change_amount').value;
            change_amount = change_amount.replace(/[^\d-.]/g, "");
            change_amount = change_amount.replace(",", "");

            if (change_amount < 0) {
                alert('Kembalian harus lebih besar sama dengan nol !!!');
                return false
            }
        }

    }
</script>


<script type="text/javascript">
    var request;
    var dest;

    function loadHTMLPost2(URL, destination, button, getId) {
        dest = destination;
        str = getId + '=' + document.getElementById(getId).value;
        //str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
        var str = str + '&button=' + button;

        if (window.XMLHttpRequest) {
            request = new XMLHttpRequest();
            request.onreadystatechange = processStateChange;
            request.open("POST", URL, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
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

    function loadHTMLPost3(URL, destination, button, getId, getId2) {
        dest = destination;
        str = getId + '=' + document.getElementById(getId).value;
        str2 = getId2 + '=' + document.getElementById(getId2).value;

        var str = str + '&button=' + button; // + button + '|' + getId2;
        str = str + '&' + str2;

        if (window.XMLHttpRequest) {
            request = new XMLHttpRequest();
            request.onreadystatechange = processStateChange;
            request.open("POST", URL, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
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

        if (window.XMLHttpRequest) {
            request = new XMLHttpRequest();
            request.onreadystatechange = processStateChange;
            request.open("POST", URL, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
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
    
    function loadHTMLPost5(URL, destination, button, getId, getId2, getId3, getId4){
        
        dest = destination; 
        str = getId + '=' + document.getElementById(getId).value;
        str4 = getId4 + '=' + document.getElementById(getId4).value;       
        
        var str = str + '&' + str4 + '&button=' + button + '|' + getId2 + '|' + getId3;

        if (window.XMLHttpRequest) {
            request = new XMLHttpRequest();
            request.onreadystatechange = processStateChange;
            request.open("POST", URL, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
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
        b = a.replace(/[^\d-.]/g, ""); //b = a.replace(/[^\d]/g,"");
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--) {
            j = j + 1;
            if (((j % 3) == 1) && (j != 1)) {
                c = b.substr(i - 1, 1) + "," + c;
            } else {
                c = b.substr(i - 1, 1) + c;
            }
        }
        //rci.amt.value = c;
        c = c.replace(",.", ".");
        c = c.replace(".,", ".");
        document.getElementById(field).value = c;

    }


    //-----------change nilai
    function detailvalue(id, jmldata, ketik) { 

        var qty = 0;
        qty = document.getElementById('qty_' + id).value;
        //qty = number_format(qty,0,".",",");
        qty = qty.replace(/[^\d-.]/g, "");
        if (qty == "") {
            qty = 0
        };

        var unit_price = 0;
        unit_price = document.getElementById('unit_price_' + id).value;
        //unit_price = number_format(unit_price,0,".",",");
        unit_price = unit_price.replace(/[^\d-.]/g, "");
        if (unit_price == "") {
            unit_price = 0
        };

        var discount = 0;
        discount = document.getElementById('discount_det_' + id).value;
        discount = discount.replace(/[^\d.]/g, ""); //discount.replace(/[^\d-.]/g,"");
        if (discount == "") {
            discount = 0
        };
        
        //discoutn persen
        var discount3 = 0;
        discount3 = document.getElementById('discount3_det_' + id).value;
        discount3 = discount3.replace(/[^\d.]/g, ""); //discount.replace(/[^\d-.]/g,"");
        if (discount3 == "") {
            discount3 = 0
        };

        //alert(discount3);
        if (ketik == 'persen') {
            discount3 = (unit_price * discount3) / 100;
            if (discount3 == "") {
                discount3 = 0
            };

            discount = discount3;
        }
        unit_price = parseFloat(unit_price) - parseFloat(discount);

        discount_value = number_format(discount, 0, ".", ",");

        if (ketik == 'persen') {
            $('#discount_det_id' + id).html('<input type="text" id="discount_det_' + id + '" name="discount_det_' + id + '" style="text-align: right; font-size:12px" class="form-control" onkeyup="formatangka(\'discount_det_' + id + '\'), detailvalue(\'' + id + '\', ' + jmldata + ', \'nominal\')" autocomplete="off" value="' + discount_value + '" >');
        }


        //-------disc nominal
        if (ketik == 'nominal') {

            var unit_price_tmp = 0;
            unit_price_tmp = document.getElementById('unit_price_' + id).value;
            unit_price_tmp = unit_price_tmp.replace(/[^\d-.]/g, "");
            if (unit_price_tmp == "") {
                unit_price_tmp = 0
            };

            discount3 = (discount / unit_price_tmp) * 100;

        }

        discount3_value = number_format(discount3, 2, ".", ",");
        if (ketik == 'nominal') {
            $('#discount3_det_id' + id).html('<input type="text" id="discount3_det_' + id + '" name="discount3_det_' + id + '" style="text-align: right; font-size:12px" class="form-control" onkeyup="formatangka(\'discount3_det_' + id + '\'), detailvalue(\'' + id + '\', ' + jmldata + ', \'persen\')" autocomplete="off" value="' + discount3_value + '" >');

        }
        //-------------------------

        var amount = 0;
        amount = parseFloat(qty) * parseFloat(unit_price); // - parseFloat(discount); //document.getElementById('amount_'+id).value; 
        amount = number_format(amount, 0, ".", ",");

        $('#amount_det' + id).html('<input type="text" onkeyup="formatangka(\'amount_' + id + '\')" id="amount_' + id + '" name="amount_' + id + '" value="' + amount + '" readonly style="text-align:right; font-size: 12px; color: #000000; font-weight: bold; width: 100px" class="form-control" >');

        sub_total(jmldata);

        return false

    }

    function sub_total(jmldata) {
        var i = 0;
        var jumlah = '0';
        var qty = '0';
        var total_qty = '0';
        var change_amount = '0';
        var amount = '0';

        for (i = 0; i <= jmldata; i++) {

            amount = document.getElementById('amount_' + i).value.replace(/[^\d.]/g, "");
            if (amount == '') {
                amount = 0
            }
            jumlah = parseFloat(jumlah) + parseFloat(amount);

            qty = document.getElementById('qty_' + i).value.replace(/[^\d.]/g, "");
            if (qty == '') {
                qty = 0
            }
            total_qty = parseFloat(total_qty) + parseFloat(qty);

            $('#qty_id').html('<input type="text" id="total_qty" name="total_qty" readonly style="text-align: right; font-weight: bold; color: #000000; font-weight: bold;" class="form-control" value="' + total_qty + '"" >');

            subtotal2(jumlah);
        }

        return false;
    }

    function subtotal2(jumlah) {
        /*var discount = 0;
        discount = document.getElementById('discount').value;
        discount = discount.replace(/[^\d.]/g, ""); //discount.replace(/[^\d-.]/g,"");
        if (discount == "") {
            discount = 0
        };

        jumlah = parseFloat(jumlah) - parseFloat(discount);

        var pos_amount = 0;
        pos_amount = document.getElementById('cash_amount').value;
        pos_amount = pos_amount.replace(/[^\d.]/g, ""); //discount.replace(/[^\d-.]/g,"");
        if (pos_amount == "") {
            pos_amount = 0
        };

        var bank_amount = 0;
        bank_amount = document.getElementById('bank_amount').value;
        bank_amount = bank_amount.replace(/[^\d.]/g, ""); //discount.replace(/[^\d-.]/g,"");
        if (bank_amount == "") {
            bank_amount = 0
        };

        var card_amount = 0;
        card_amount = document.getElementById('card_amount').value;
        card_amount = card_amount.replace(/[^\d.]/g, ""); //discount.replace(/[^\d-.]/g,"");
        if (card_amount == "") {
            card_amount = 0
        };

        change_amount = parseFloat(jumlah) - parseFloat(pos_amount) - parseFloat(bank_amount) - parseFloat(card_amount);
        change_amount = change_amount * -1;*/

        var freight_cost = document.getElementById('freight_cost').value;
        freight_cost = freight_cost.replace(/[^\d.]/g, ""); //discount.replace(/[^\d-.]/g,"");
        if (freight_cost == "") {
            freight_cost = 0
        };

        var sutotal = number_format(jumlah, 0, ".", ",");
        $('#subtotal_id').html('<input type="text" id="subtotal" name="subtotal" readonly style="text-align: right; font-weight: bold; color: #000000; font-weight: bold;" class="form-control" value="' + sutotal + '"" >');

        jumlah = number_format(parseFloat(jumlah) + parseFloat(freight_cost), 0, ".", ",");
        $('#total_id').html('<input type="text" id="total" name="total" readonly style="text-align: right; font-weight: bold; color: #000000; font-weight: bold;" class="form-control" onkeyup="formatangka(' + total + ')" value="' + jumlah + '"" >');

        freight_cost = number_format(freight_cost, 0, ".", ",");
        $('#freight_cost_id').html('<input type="text" id="freight_cost1" name="freight_cost1" readonly style="text-align: right; font-weight: bold; color: #000000; font-weight: bold;" class="form-control" value="' + freight_cost + '"" >');
        

        /*change_amount = number_format(change_amount, 0, ".", ",");
        $('#change_amount_id').html('<input type="text" id="change_amount" name="change_amount" readonly="" style="text-align: right; font-size: 16px; font-weight: bold; color: #000000; font-weight: bold;" class="form-control" value="' + change_amount + '"" >');*/

        return false;
    }


    function sub_total_member(total, jmldata) {
        var i = 0;
        var discmember = '0';
        var discmember2 = '0';
        var memberlimit = '0';
        var memberlimit2 = '0';
        var amount_member = '0';
        var totalcek = '0';
        var non_discount = '0';

        amount_member = document.getElementById('amount_member').value;
        totalcek = parseInt(total) + parseInt(amount_member);

        for (i = 0; i <= jmldata; i++) {

            memberlimit = document.getElementById('memberlimit' + i).value.replace(/[^\d.]/g, "");
            if (memberlimit == '') {
                memberlimit = 0
            }
            memberlimit = parseInt(memberlimit);

            discmember = document.getElementById('discmember' + i).value.replace(/[^\d.]/g, "");
            if (discmember == '') {
                discmember = 0
            }
            discmember = parseInt(discmember);

            if (memberlimit <= totalcek) {
                discmember2 = discmember;
            }

            //alert(memberlimit);

        }



        memberlimit = (total * discmember2) / 100;
        memberlimit2 = number_format(memberlimit, 0, ".", ",");

        $('#total_discount_id').html('<input type="text" id="discount" name="discount" style="text-align: right; font-size: 16px" class="form-control" value="' + memberlimit2 + '"" >');

    }
</script>

<script>
    function detailvalue2(ketik) {
        var qty = 0;
        qty = document.getElementById('qty').value;
        //qty = number_format(qty,0,".",",");
        qty = qty.replace(/[^\d-.]/g, "");
        if (qty == "") {
            qty = 0
        };

        var unit_price = 0;
        unit_price = document.getElementById('unit_price').value;
        //unit_price = number_format(unit_price,0,".",",");
        unit_price = unit_price.replace(/[^\d-.]/g, "");
        if (unit_price == "") {
            unit_price = 0
        };

        var discount = 0;
        discount = document.getElementById('discount_det').value;
        discount = discount.replace(/[^\d.]/g, ""); //discount.replace(/[^\d-.]/g,"");
        if (discount == "") {
            discount = 0
        };

        //discoutn persen
        var discount3 = 0;
        discount3 = document.getElementById('discount3_det').value;
        discount3 = discount3.replace(/[^\d.]/g, ""); //discount.replace(/[^\d-.]/g,"");
        if (discount3 == "") {
            discount3 = 0
        };


        //alert(discount3);
        if (ketik == 'persen') {
            discount3 = (unit_price * discount3) / 100;
            if (discount3 == "") {
                discount3 = 0
            };

            discount = discount3;
        }

        //---------------/\
        unit_price = parseFloat(unit_price) - parseFloat(discount);

        var amount = 0;
        amount = parseFloat(qty) * parseFloat(unit_price); // - parseFloat(discount); //document.getElementById('amount_'+id).value; 
        amount = number_format(amount, 0, ".", ",");

        discount_value = number_format(discount, 0, ".", ",");


        if (ketik == 'persen') {
            $('#discount_det_id').html('<input type="text" onkeyup="formatangka(\'discount_det\'), detailvalue2(\'nominal\')" id="discount_det" name="discount_det" value="' + discount_value + '" style="text-align:right; font-size: 11px; width: 100px" class="form-control" >');
        }

        //-------disc nominal
        if (ketik == 'nominal') {
            var unit_price_tmp = 0;
            unit_price_tmp = document.getElementById('unit_price').value;
            unit_price_tmp = unit_price_tmp.replace(/[^\d-.]/g, "");
            if (unit_price_tmp == "") {
                unit_price_tmp = 0
            };

            discount3 = (discount / unit_price_tmp) * 100;
        }

        discount3_value = number_format(discount3, 2, ".", ",");
        if (ketik == 'nominal') {
            $('#discount3_det_id').html('<input type="text" onkeyup="formatangka(\'discount3_det\'), detailvalue2(\'persen\')" id="discount3_det" name="discount3_det" value="' + discount3_value + '" style="text-align:right; font-size: 11px; width: 100px" class="form-control" >');
        }
        //-------------------------

        $('#amount_det').html('<input type="text" onkeyup="formatangka(\'amount\')" id="amount" name="amount" value="' + amount + '" readonly style="text-align:right; font-size: 11px; width: 100px" class="form-control" >');


        return false

    }
</script>

<script language="javascript">
    function hapus(id, line) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            /*document.location.href = "main.php?menu=app&act=<php echo obraxabrix('pos') ?>&mxKz=xm8r389xemx23xb2378e23&xndf="+id+"&line="+line+" ";*/

            document.location.href = '<?php echo $__folder ?><?php echo obraxabrix('pos') ?>/' + id + '/xm8r389xemx23xb2378e23/' + line;
        }
    }


    function simpan() {

        //document.forms['submit_save'];

        $("#pos").attr('action', 'app/pos.php')
            .attr('target', '_SELF');
        $("#pos").submit();

        //document.getElementById("submit_save").submit();
        //document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('pos') ?>";

    }

    function print() {
        var ref = document.getElementById('ref').value;

        //window.open('app/pos_print_create.php?ref='+ref, 'Invoice Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
        window.open('<?php echo $__folder ?>app/pos_print_pdf.php?ref=' + ref, 'Invoice Print', '825', '450', 'resizable=1,scrollbars=1,status=0,toolbar=0')

    }

    function submitForm(tipe) {

        if (tipe == 'print') {
            //document.getElementById("delord_view").action = "app/delord_print.php";
            $("#pos").attr('action', 'app/pos_print.php')
                .attr('target', '_BLANK');
            $("#pos").submit();

        }

        return false;

    }


    function focusNext(elemName, evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode :
            ((evt.which) ? evt.which : evt.keyCode);
        if (charCode == 13) {
            document.getElementById(elemName).focus();
            return false;
        }
        return true;
    }

    function focusNext2(elemName, evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode :
            ((evt.which) ? evt.which : evt.keyCode);
        if (charCode == 13) {
            document.getElementById(elemName).focus();
            return false;
        }
        return true;
    }


    function testprint() {
        var ref = document.getElementById('ref').value;

        window.open('app/test_print4.php', 'Invoice Print', '825', '450', 'resizable=1,scrollbars=1,status=0,toolbar=0')
    }

    function itemhistory() {
        var client_code = document.getElementById('client_code').value;

        window.open('app/pos_item_history.php?client_code=' + client_code, 'Item History', '825', '950', 'resizable=1,scrollbars=1,status=0,toolbar=0')
    }

    function chequehistory() {
        var client_code = document.getElementById('client_code').value;

        window.open('app/pos_cheque_history.php?client_code=' + client_code, 'Cheque History', '825', '2000', 'resizable=1,scrollbars=1,status=0,toolbar=0')
    }

    function client_input(ref) {
        window.open("<?php echo $__folder ?>app/client_pos.php","Find","width=1100,height=700,left=100,top=10,toolbar=0,status=0,scroll=1,scrollbars=no");

    }
</script>

<!--//shortcut-->
<script>
    document.onkeydown = function(e) {
        switch (e.keyCode) {
            //F2
            case 114:
                document.getElementById('cash_amount').focus();
                e.preventDefault();
                break;

                //F3
            case 113:
                document.getElementById('item_code2').focus();
                e.preventDefault();
                break;

                //F4
            case 115:
                document.getElementById('client_member_code2').focus();
                e.preventDefault();
                break;

                //F1
            case 112:
                window.location = 'main.php?menu=app&act=<?php echo obraxabrix('pos') ?>';
                e.preventDefault();
                break;

                //Enter
                /*case 13:
                    simpan();
                    e.preventDefault();
                    break;*/

        }
        //menghilangkan fungsi default tombol
        /*e.preventDefault();*/

    };
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
                            $xndf = $segmen3; //$_GET['xndf'];
                            if($segmen4 != "") {
                                $xndf = $segmen4;
                            }

                            //jika saat add data, maka data setelah save kosong
                            if ($_POST['submit'] == 'Save') {
                                $ref = '';
                            }
                            //-----------------------------------------------/\

                            $location_id = $_SESSION['location_id2'];
                            $location_id2 = $_SESSION['location_id2'];

                            $ref2 = notran(date('y-m-d'), 'frmpos', '', '', $location_id);

                            include("app/exec/pos_insert.php");


                            $date = date("d F, Y");
                            $date_need = date("d F, Y");
                            $due_date = date("d F, Y");
                            $currency_code = "IDR";

                            $cash = "checked";
                            $cash1 = "";

                            $admin = $_SESSION["adm"];

                            $shift = $_SESSION["shift"];
                            $uid = $_SESSION["loginname"];
                            $location_id = $_SESSION["location_id2"];
                            $employee_id = $_SESSION["employee_id"];
                            $status = "Unpaid";

                            $detail_cso = "";
                            if( substr($xndf, 0, 3) == "CSO" ) {
                                $client_code = substr($xndf, 3, 50);
                                $detail_cso = $xndf;

                                $ref = "";
                                $xndf = "";
                            }

                            if ($ref != "") {
                                $sql = $select->list_pos($ref);
                                $row_pos = $sql->fetch(PDO::FETCH_OBJ);

                                $ref2 = $row_pos->ref;
                                $ref22 = $row_pos->ref2;

                                if (!empty($row_pos->shift)) {
                                    $shift = $row_pos->shift;
                                } else {
                                    $shift = $_SESSION["shift"];
                                }

                                $uid = $row_pos->uid;
                                $date = date("d F, Y", strtotime($row_pos->date));
                                $tax_rate = number_format($row_pos->tax_rate, 0, '.', ',');
                                //$freight_cost = number_format($row_pos->freight_cost, 0, '.', ',');

                                $client_code  = $row_pos->client_code;
                                $client_name  = $row_pos->client_name;
                                $phone          =   $row_pos->phone;
                                $ship_to        =   $row_pos->ship_to;
                                $bill_to        =   $row_pos->bill_to;
                                $currency_code  =   $row_pos->currency_code;

                                $total = number_format($row_pos->total, 0, '.', ',');
                                $cash_amount = number_format($row_pos->cash_amount, 0, ".", ",");
                                $bank_amount = number_format($row_pos->bank_amount, 0, ".", ",");
                                $card_amount = number_format($row_pos->card_amount, 0, ".", ",");
                                $discount2 = number_format($row_pos->discount, 0, ".", ",");

                                $due_date = date("d F, Y", strtotime($row_pos->due_date));
                                if ($row_pos->pos == 1) {
                                    $pos = " checked ";
                                    $pos2 = "1";
                                } else {
                                    $pos = "";
                                }

                                $deposit = number_format($row_pos->deposit, 0, '.', ',');

                                $disabled = "disabled";
                                if ($admin == 1) {
                                    $disabled = "";
                                }

                                if ($row_pos->taxable == 1) {
                                    $taxable = "checked";
                                }

                                $location_id    =   $row_pos->location_id;
                                $employee_id    =   $row_pos->employee_id;
                                $freight_cost   =   $row_pos->freight_cost;
                                //$status         =   $row_pos->status;

                                $status = "";
                                if($row_pos->paid == 1) { $status = "Paid"; }
                                if($row_pos->print == 1) { $status = "Print"; }
                                if($row_pos->process_whs == 1) { $status = "Process_Whs"; }
                                if($row_pos->onshipped == 1) { $status = "Onshipped"; }
                                if($row_pos->shipped == 1) { $status = "Shipped"; }
                                /*$receipt_type = "";
                                $receipt_type1 = "";
                                $receipt_type2 = "";
                                if ($row_pos->receipt_type == "Transfer") {
                                    $receipt_type = "checked";
                                    $receipt_type1 = "";
                                    $receipt_type2 = "";
                                }
                                if ($row_pos->receipt_type == "Midtrans") {
                                    $receipt_type = "";
                                    $receipt_type1 = "checked";
                                    $receipt_type2 = "";
                                }
                                if ($row_pos->receipt_type == "Kredit") {
                                    $receipt_type = "";
                                    $receipt_type1 = "";
                                    $receipt_type2 = "checked";
                                }*/
                            }

                            ?>



                            <input type="hidden" id="old_location_id" name="old_location_id" value="<?php echo $row_pos->location_id; ?>">
                            <input type="hidden" id="client_code2" name="client_code2" value="<?php echo $row_pos->client_code; ?>">
                            <input type="hidden" id="old_ref" name="old_ref" value="<?php echo $row_pos->ref; ?>">

                            <input type="hidden" id="xndf" name="xndf" value="">

                            <!--<input type="hidden" id="client_code" name="client_code" value="580499817">-->

                            <!--<input type="hidden" id="cash" name="cash" value="1">-->
                            <input type="hidden" id="uid" name="uid" readonly="" style="font-size: 14px; color: #000000;" class="form-control" value="<?php echo $uid ?>">

                            <input type="hidden" id="location_id" name="location_id" value="1">
                            <input type="hidden" id="location_id2" name="location_id2" value="<?php echo $location_id2 ?>">


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
                                    <label class="col-2 col-form-label">Customer<span class="required">*</span></label>
                                    <?php if($ref=='') { ?>
                                        <div class="col-8">
                                            <select class="destroy-selector" id="client_code" name="client_code" onchange="loadHTMLPost2('app/pos_ajax.php', 'address_id', 'getclient', 'client_code')">
                                                <option value=""></option>
                                                <?php select_client($client_code) ?>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <button style="height: 35px;padding: 0.5rem 1rem;" class="btn btn-primary me-2" id="js-programmatic-enable" onClick="client_input(<?php echo $row_pos->client_code ?>)">+</button>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-10">
                                            <select class="destroy-selector" id="client_code" name="client_code">
                                                <option value=""></option>
                                                <?php select_client($client_code) ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Alamat</label>
                                    <div class="col-10" id="address_id">
                                        <input class="form-control" type="text" value="<?php echo $row_pos->address ?>" id="address" name="address">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Jenis Pembayaran</label>
                                    <div class="col-8">
                                        <select class="destroy-selector" id="receipt_type" name="receipt_type">
                                            <option value=""></option>
                                            <?php 
                                                combo_select_active('payment_method', 'id', 'name', 'active', '1', $row_pos->receipt_type) 
                                            ?>
                                        </select>
                                    </div>

                                    <?php /*
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="receipt_type" id="receipt_type" value="Transfer" <?= $receipt_type ?>>
                                            <label class="form-check-label">
                                                Transfer Manual
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="receipt_type" id="receipt_type1" value="Midtrans" <?= $receipt_type1 ?>>
                                            <label class="form-check-label">
                                                Midtrans
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="receipt_type" id="receipt_type2" value="Kredit" <?= $receipt_type2 ?>>
                                            <label class="form-check-label">
                                                Kredit
                                            </label>
                                        </div>
                                    </div>*/ ?>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Penerima</label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="bank_id" name="bank_id">
                                            <option value=""></option>
                                            <?php select_bank($row_pos->bank_id) ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Admin<span class="required">*</span></label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="employee_id" name="employee_id">
                                            <option value=""></option>
                                            <?php select_employee($employee_id) ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Ekspedisi<span class="required">*</span></label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="expedition_id" name="expedition_id">
                                            <option value=""></option>
                                            <?php combo_select_active('expedition', 'id', 'name', 'active', '1', $row_pos->expedition_id) ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Resi</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="expedition_bill" name="expedition_bill" placeholder="No. Resi (Optional)" value="<?= $row_pos->expedition_bill ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="currency_code" id="currency_code" value="<?= $currency_code ?>">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Jenis Channel *)</label>
                                    <div class="col-10">
                                        <select class="destroy-selector" id="channel_id" name="channel_id">
                                            <option value=""></option>
                                            <?php combo_select_active('channel', 'id', 'name', 'active', '1', $row_pos->channel_id) ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Nomor Rekening</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="No. Rekening (Optional)" value="<?= $row_pos->bank_account ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Note Nominal Transfer<span class="required"></span></label>
                                    <div class="col-10">
                                        <textarea class="form-control" id="note_transfer" name="note_transfer" rows="3"><?php echo $row_pos->note_transfer ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">No Pesanan E-Commerce<span class="required"></span></label>
                                    <div class="col-10">
                                        <textarea class="form-control" id="note_ecommerce" name="note_ecommerce" rows="3"><?php echo $row_pos->note_ecommerce ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Total Ongkos Kirim<span class="required"></span></label>
                                    <div class="col-5">
                                        <input type="text" class="form-control" id="freight_cost" name="freight_cost" onkeyup="formatangka('freight_cost'), sub_total(50)" autocomplete="off" style="text-align: right;" value="<?= number_format($row_pos->freight_cost,0,'.',',') ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Status<span class="required"></span></label>
                                    <div class="col-5">
                                        <select class="destroy-selector" id="status" name="status">
                                            <option value=""></option>
                                            <?php select_status_paid($status) ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <?php if ($ref == '') { ?>
                            <?php 
                                if( !empty($detail_cso) ) {
                                    include('pos_detail_cso.php');
                                } else {
                                    include('pos_detail.php');
                                }
                            ?>
                        <?php } else { ?>
                            <?php include('pos_detail_update.php') ?>
                        <?php } ?>

                        <div class="card-footer">
                            <div class="row" style="justify-content: flex-end;">

                                <div class="col-lg-2 col-md-3 col-4">
                                    <a href="<?php echo $__folder ?>app/pos_format.php" target="_blank" class="btn btn-danger me-6">
                                        <i class="ace-icon fa fa-cloud-download"></i>
                                        Download
                                    </a>    
                                </div>
                                <div class="col-lg-2 col-md-3 col-4">
                                    <a href="javascript:void(0);" name="Find" title="Upload Sales" class="btn btn-danger me-6" onClick=window.open("<?php echo $__folder ?>app/pos_import.php","Find","width=900,height=500,left=200,top=20,toolbar=0,status=0,scroll=1,scrollbars=no"); />
                                        Upload Sales
                                    </a>
                                </div>

                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="submit" id="submit" class="btn btn-success me-6" style="margin: auto;width: 100%;color: white;" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('pos_view') ?>'" />
                                </div>
                                <div class="col-lg-2 col-md-3 col-4">
                                    <input type="button" name="button" class="btn btn-success" value="Print" onclick="print()" >
                                </div>
                                <?php if (allowadd('frmpos') == 1) { ?>
                                    <?php if ($ref == '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"><input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Save" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmpos') == 1) { ?>
                                    <?php if ($ref != '') { ?>
                                        <div class="col-lg-2 col-md-3 col-4"> <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' style="margin: auto;width: 100%;color: white;" value="Update" /></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmpos') == 1) { ?>
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