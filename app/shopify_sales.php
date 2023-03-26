<?php

?>
<script language="javascript">
    function cekinput(fid) {  
      var arrf = fid.split(',');
      for(i=0; i < arrf.length; i++) {
        if(document.getElementById(arrf[i]).value=='') {       
          
          if (document.getElementById(arrf[i]).name=='name') {
            alert('Company Name cannot empty!');                
          }
          
          return false
        } 
                                        
      }      
    }
        
</script>

<?php

    if($_POST['submit']) {
        ##-------get api
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://doa-official-store.myshopify.com/admin/api/2022-04/orders.json',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'X-Shopify-Access-Token: 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'
          ),
        ));

        $response = curl_exec($curl);

        //curl_close($curl);
        //echo $response;

        //var_dump(json_decode($response, true));
        //$data1 = json_decode($response, true);
        $data1 = $response;
        $data = json_decode($response, true);
        //echo(json_encode($data));

        ?>
        <!-- <table id="example" class="display"> -->

        <?php

        $item_sku           =   "";
        $item_price         =   "";
        $item_barcode       =   "";
        $item_grams         =   "";

        for($i = 0; $i < sizeof($data["orders"]); $i++)
        {
            $ref            =   "DOA".$data["orders"][$i]["order_number"];
            $date           =   substr($data["orders"][$i]["created_at"],0,10); //date("Y-m-d");
            $date           =   date('Y-m-d', strtotime($date));

            $temp .= "<tr valign=top>";
            $temp .= "<td>" . ($i+1) . "</td>";
            $temp .= "<td>" . $data["orders"][$i]["id"] . "</td>";
            $temp .= "<td>" . $data["orders"][$i]["app_id"] . "</td>";
            $temp .= "<td>" . $data["orders"][$i]["name"] ."<br>".$data["orders"][$i]["created_at"]."</td>";
            $temp .= "<td>" . $data["orders"][$i]["contact_email"] . "</td>";
            $temp .= "<td>" . $data["orders"][$i]["currency"] . "</td>";
            $temp .= "<td>" . number_format($data["orders"][$i]["current_subtotal_price"],0,'.',',') . "</td>";
            $temp .= "<td>";
                $adr = $data["orders"][$i]["line_items"];
                foreach($adr as $row) {
                    $temp .= "Item Id: ".$row['id']."<br>";
                    if($row['destination_location'] != "") {
                        $locs = array_unique($row['destination_location']);
                        
                        $no = 0;
                        //foreach($locs as $row_loc) {
                            $no++;
                            //$temp .= print_r($locs)."<br>";
                            /*$temp .= "Dest. Id: ".$row_loc->id."<br>";
                            $temp .= "Dest. Name: ".$locs['name']."<br>";
                            $temp .= "Dest. Adr-1: ".$locs['address1']."<br>";
                            $temp .= "Dest. Adr-2: ".$locs['address2']."<br>";
                            $temp .= "Dest. City: ".$locs['city']."<br>";
                            $temp .= "Dest. Zip: ".$locs['zip']."<br>";
                        }*/
                    } 

                    $quantity = $row['quantity'];

                    $temp .= "<b>Product Id: ".$row['product_id']."<br>";
                    $temp .= "Product Name: ".$row['title']."</b><br>";

                    $syscode_product    =   $row['product_id'];
                    $name_product       =   petikreplace($row['title']);
                    $item_sku           =   $row['sku'];
                    $item_price         =   $row['price'];

                    //---process insert data to table item
                    $strsql         =   "select syscode from item where syscode='$syscode_product'";
                    $sql            =   $dbpdo->query($strsql);
                    $count_item     =   $sql->rowCount();

                    $code           =   $item_sku;
                    if($code == "") {
                        $code = $syscode_product;
                    }
                    $old_code       =   $code; //$item_barcode;
                    $name           =   $name_product;
                    $item_group_id  =   9;
                    $item_subgroup_id   =   0;
                    $item_type_code     =   "";
                    $item_category_id   =   0;
                    $brand_id           =   0;
                    $size_id            =   "";
                    $uom_code_stock     =   "pcs";
                    $uom_code_sales     =   $uom_code_stock; //$_POST["uom_code_sales"];            
                    $uom_code_purchase  =   $uom_code_sales; //$_POST["uom_code_purchase"];
                    $minimum_stock      =   0;
                    $maximum_stock      =   0;
                    
                    $consigned      =   0;
                    $balance        =   0;
                    $description    =   "";
                    
                    $active         =   1;
                    $uid            =   $_SESSION["loginname"];
                    $dlu            =   date("Y-m-d H:i:s");
                    
                    //-----------upload file
                    $photo          =   "";
                    
                    $efective_from  =   $date; //date("Y-m-d");
                    $date_of_record =   date("Y-m-d H:i:s");
                    $location_id    =   0;
                    //----------------

                    if($count_item == 0) {
                        $sqlstr="insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, balance, description, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$balance', '$description', '$active', '$uid', '$dlu', '$syscode_product')";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute();

                        //insert unit price
                        /*$sqlstr = "delete from set_item_price where item_code='$syscode_product' ";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute();

                        $sqlstr = "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$date', '$efective_from', '$syscode_product', '$uom_code_sales', '$item_price', '0', '0', '0', '0', '$date_of_record', '$location_id', '0', '0', '0', '0', '0', '$uid', '$dlu')";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute();*/
                    } 
                }
            $temp .= "<td>";

            $temp .= "<td>";
                $temp .= "Fulfillment_status: ".$row['fulfillment_status']."<br>";
                $fulfillment_status = $row['fulfillment_status'];

                if($data["orders"][$i]["customer"] != "") {
                    $cust = $data["orders"][$i]["customer"];
                    $no = 0;
                    foreach($cust as $row_cust) {
                        $no++;
                        /*$temp .= "<b>No.: ".$no."</b><br>";
                        $temp .= "Cust Id: ".$cust['id']."<br>";
                        $temp .= "F Name: ".$cust['first_name']."<br>";
                        $temp .= "L Name: ".$cust['last_name']."<br>";*/

                        //cek data
                        $cust_id = $cust['id'];
                        $email          =   $cust['email'];
                        $strsql         =   "select syscode from client where syscode='$cust_id' or code='$cust_id'";
                        $sql1            =   $dbpdo->query($strsql);
                        $count_cust     =   $sql1->rowCount();
                        $syscode_cust   =   $cust_id;
                        if($count_cust == 0) {
                            //---process insert data to table client                            
                            $code           =   $cust_id;
                            $title          =   "";
                            $client_name    =   $cust['first_name'];
                            $email          =   $cust['email'];

                            if($client_name != "") {
                                $name           =   petikreplace($client_name);
                                $last_name      =   petikreplace($cust['last_name']);
                            } else {
                                $name           =   petikreplace($client_name);
                                $last_name      =   petikreplace($cust['last_name']);
                            }
                            $contact_person =   petikreplace($client_name);
                            $contact_person1=   "";
                            $contact_person2=   "";
                            $contact_person3=   "";
                            $client_type    =   13; //perorangan

                            //get address customer
                            $adrs = $cust['default_address'];
                            foreach($adrs as $row_adrx) {
                                /*$temp .= "<b>Address-1: </b>".$adrs['address1']."<br>";
                                $temp .= "<b>Address-2: </b>".$adrs['address2']."<br>";*/

                                $address        =   petikreplace($adrs['address1']);
                                $address1       =   petikreplace($adrs['address2']);
                                $province       =   petikreplace($adrs['province']);
                                $zip_code       =   $adrs['zip'];
                                $country_name   =   $adrs['country'];
                                $country_code   =   $adrs['country_code'];
                                $phone          =   $adrs['phone'];
                                $name           =   $adrs['name'];
                            }
                            
                            $ship_to        =   petikreplace($address);
                            $bill_to        =   petikreplace($address);
                            
                            $country_id     =   1;
                            $state_id       =   0;
                            
                            $kabupaten      =   "";
                            $kecamatan      =   "";
                            
                            $phone1         =   "";
                            $fax            =   "";
                            
                            $web            =   "";      
                            $bank_name      =   "";
                            $bank_branch    =   "";
                            $bank_account   =   "";
                            $bank_account_no=   "";
                            $amount         =   0;
                            $location_id    =   0;
                            $active         =   1;
                            $stockist       =   0;
                            $client_syscode =   "";
                            $uid            =   $_SESSION["loginname"];
                            $dlu            =   date("Y-m-d H:i:s");

                            //if($country_code != "JP") {
                                $sqlstr="insert into client (code, title, name, last_name, contact_person, contact_person1, contact_person2, contact_person3, client_type, address, address1, ship_to, bill_to, zip_code, country_id, state_id, kabupaten, kecamatan, province, phone, phone1, fax, email, web, bank_name, bank_branch, bank_account, bank_account_no, amount, location_id, stockist, active, client_syscode, bagi_komisi, uid, dlu, syscode) values ('$code', '$title', '$name', '$last_name', '$contact_person', '$contact_person1', '$contact_person2', '$contact_person3', '$client_type', '$address', '$address1', '$ship_to', '$bill_to', '$zip_code', '$country_id', '$state_id', '$kabupaten', '$kecamatan', '$province', '$phone', '$phone1', '$fax', '$email', '$web', '$bank_name', '$bank_branch', '$bank_account', '$bank_account_no', '$amount', '$location_id', '$stockist', '$active', '$client_syscode', 1, '$uid', '$dlu', '$syscode_cust')";
                                $sql=$dbpdo->prepare($sqlstr);
                                $sql->execute();
                            //} else {
                                /*$name = "JP-".$code;
                                $last_name = $name;email
                                $contact_person = $name;*/
                                /*$sqlstr="insert into client (code, title, name, last_name, contact_person, contact_person1, contact_person2, contact_person3, client_type, address, address1, ship_to, bill_to, zip_code, country_id, state_id, kabupaten, kecamatan, province, phone, phone1, fax, email, web, bank_name, bank_branch, bank_account, bank_account_no, amount, location_id, stockist, active, client_syscode, bagi_komisi, uid, dlu, syscode) values ('$code', '$title', '$name', '$last_name', '$contact_person', '$contact_person1', '$contact_person2', '$contact_person3', '$client_type', '$address', '$address1', '$ship_to', '$bill_to', '$zip_code', '$country_id', '$state_id', '$kabupaten', '$kecamatan', '$province', '$phone', '$phone1', '$fax', '$email', '$web', '$bank_name', '$bank_branch', '$bank_account', '$bank_account_no', '$amount', '$location_id', '$stockist', '$active', '$client_syscode', 1, '$uid', '$dlu', '$syscode_cust')";
                                $sql=$dbpdo->prepare($sqlstr);
                                $sql->execute();
                            }*/
                        } /*else {
                            $temp .= "ADA";
                        }*/
                    }


                    //--------insert sales_invoice--------\/--
                    $client_code    =   $syscode_cust;

                    $sqlstr="select ref from sales_invoice where ref='$ref'";
                    $sql=$dbpdo->prepare($sqlstr);
                    $sql->execute();
                    $rows_si = $sql->rowCount();

                    $shipping_lines = $data["orders"][$i]["shipping_lines"];
                    foreach($shipping_lines as $row_shipping_lines) {
                        $expedition_id      =   0; //$row_shipping_lines['id'];
                        $expedition_name    =   $row_shipping_lines['code'];
                        $freight_cost       =   $row_shipping_lines['price'];
                    }

                    $shipping_address = $data["orders"][$i]["shipping_address"];
                    $no = 0;
                    foreach($shipping_address as $row_shipping_address) {
                        $country_code   =   $shipping_address['country_code'];
                        $province_code  =   $shipping_address['province_code'];
                        $city           =   $shipping_address['city'];
                        $latitude       =   $shipping_address['latitude'];
                        $longitude      =   $shipping_address['longitude'];
                    }

                    $status         =   "R";
                    $due_date       =   date("Y-m-d");
                    $total          =   $item_price; //numberreplace($_POST["total"]); //$sub_total; 
                    $cash_amount    =   0;
                    $cash_voucher   =   0;
                    $change_amount  =   0;
                    $shift          =   1;
                    $note_transfer  =   "";
                    $note_ecommerce =   "";
                    $bank_account   =   "";
                    $expedition_bill=   "";
                    $receipt_type   =   "";
                    $uid            =   $_SESSION["loginname"];
                    
                    $dlu            =   date("Y-m-d H:i:s");

                    $channel_id         =   5;
                    $employee_id        =   0;     
                    $top                =   "C.O.D";
                    $tax_code           =   "";
                    $tax_rate           =   0;
                    $freight_account    =   "";
                    $currency_code      =   "";
                    $rate               =   0;
                    $memo               =   "from Shopify";
                    $discount2          =   0;
                    $deposit            =   0;      
                    $commision_rate     =   0;
                    $total_member       =   0;
                    $taxable            =   0;
                    
                    $photo_file         =   ""; 
                    
                    $bank_id            =   0;
                    $bank_amount        =   0;
                    $credit_card_code   =   0;
                    $card_amount        =   0;
                    $credit_card_no     =   "";
                    $credit_card_holder =   "";
                    $cash               =   1;
                    $process_whs        =   1;
                    $print              =   1;
                    $onshipped          =   1;
                    $shipped            =   1;
                    $paid               =   1;

                    if($rows_si == 0) {
                        $no = 0;
                        
                        
                        //if($fulfillment_status == "fulfilled") {
                            $sqlstr="insert into sales_invoice (ref, ref2, date, status, top, due_date, client_code, channel_id, ship_to, bill_to, expedition_id, expedition_name, tax_code, tax_rate, freight_cost, freight_account, currency_code, rate, employee_id, discount, total, memo, opening_balance, cash, location_id, deposit, taxable, photo_file, cash_amount, cash_voucher, bank_id, bank_amount, credit_card_code, card_amount, credit_card_no, credit_card_holder, change_amount, shift, client_member_code, commision_rate, phone, bank_account, expedition_bill, receipt_type, note_transfer, note_ecommerce, process_whs, print, onshipped, shipped, paid, country_code, province_code, city, latitude, longitude, uid, dlu) values('$ref', '$ref2', '$date', '$status', '$top', '$due_date', '$client_code', '$channel_id', '$ship_to', '$bill_to', '$expedition_id', '$expedition_name', '$tax_code', '$tax_rate', '$freight_cost', '$freight_account', '$currency_code', '$rate', '$employee_id', '$discount2', '$total', '$memo', 0, '$cash', '$location_id', '$deposit', '$taxable', '$photo_file', '$cash_amount', '$cash_voucher', '$bank_id', '$bank_amount', '$credit_card_code', '$card_amount', '$credit_card_no', '$credit_card_holder', '$change_amount', '$shift', '$client_member_code', '$commision_rate', '$phone', '$bank_account', '$expedition_bill', '$receipt_type', '$note_transfer', '$note_ecommerce', '$process_whs', '$print', '$onshipped', '$shipped', '$paid', '$country_code', '$province_code', '$city', '$latitude', '$longitude', '$uid', '$dlu')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();

                        //}

                        //---sales_invoice_detail------
                        $so_ref         = ""; 
                        $so_line        = 0;
                        $item_code      = $syscode_product;
                        $uom_code       = $uom_code_sales;

                        $qty            = $quantity;
                        $unit_price     = $item_price;
                        $discount       = 0;
                        $discount3      = 0;
                        $amount         = $item_price;
                        $non_discount   = 0;
                        
                        //get cogs
                        $sqlprice = "select b.cogs, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
                        $resultprice=$dbpdo->prepare($sqlprice);
                        $resultprice->execute();
                        $dataprice      = $resultprice->fetch(PDO::FETCH_OBJ);
                        $unit_cost      = numberreplace($dataprice->cogs);  
                        $amount_cost    = $qty * $unit_cost;

                        $sqlstr="select ref from sales_invoice_detail where ref='$ref' and item_code='$item_code'";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute();
                        $rows_sidet=$sql->rowCount();

                        if($rows_sidet == 0 ) { //&& $fulfillment_status == "fulfilled"
                            $line = maxline('sales_invoice_detail', 'line', 'ref', $ref, '');                                
                            $sqlstr="insert into sales_invoice_detail (ref, so_ref, item_code, uom_code, qty, discount, discount3, unit_price, amount, non_discount, unit_cost, amount_cost, line_item_so, line) values ('$ref', '$xndf', '$item_code', '$uom_code', '$qty', '$discount', '$discount3', '$unit_price', '$amount', '$non_discount', '$unit_cost', '$amount_cost', '$so_line', '$line')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();    
                        }
                    } else {

                        $sqlstr="update sales_invoice set ref2='$ref2', date='$date', status='$status', top='$top', due_date='$due_date', client_code='$client_code', channel_id='$channel_id', ship_to='$ship_to', bill_to='$bill_to', expedition_id='$expedition_id', expedition_name='$expedition_name', tax_code='$tax_code', tax_rate='$tax_rate', freight_cost='$freight_cost', freight_account='$freight_account', currency_code='$currency_code', rate='$rate', employee_id='$employee_id', discount='$discount2', total='$total', memo='$memo', cash='$cash', location_id='$location_id', deposit='$deposit', taxable='$taxable', cash_amount='$cash_amount', cash_voucher='$cash_voucher', bank_id='$bank_id', bank_amount='$bank_amount', credit_card_code='$credit_card_code', card_amount='$card_amount', credit_card_no='$credit_card_no', credit_card_holder='$credit_card_holder', change_amount='$change_amount', shift='$shift', client_member_code='$client_member_code', commision_rate='$commision_rate', phone='$phone', bank_account='$bank_account', expedition_bill='$expedition_bill', receipt_type='$receipt_type', note_transfer='$note_transfer', note_ecommerce='$note_ecommerce', city='$city', latitude='$latitude', longitude='$longitude' where ref='$ref'";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute();

                        //get cogs
                        $so_ref         = ""; 
                        $so_line        = 0;
                        $item_code      = $syscode_product;
                        $uom_code       = $uom_code_sales;

                        $qty            = $quantity;
                        $unit_price     = $item_price;
                        $discount       = 0;
                        $discount3      = 0;
                        $amount         = $item_price;
                        $non_discount   = 0;

                        $sqlprice = "select b.cogs, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
                        $resultprice=$dbpdo->prepare($sqlprice);
                        $resultprice->execute();
                        $dataprice      = $resultprice->fetch(PDO::FETCH_OBJ);
                        $unit_cost      = numberreplace($dataprice->cogs);  
                        $amount_cost    = $qty * $unit_cost;

                        $sqlstr="select ref from sales_invoice_detail where ref='$ref' and item_code='$item_code'";
                        $sql=$dbpdo->prepare($sqlstr);
                        $sql->execute();
                        $rows_sidet=$sql->rowCount();

                        if($rows_sidet == 0 ) { //&& $fulfillment_status == "fulfilled"
                            $line = maxline('sales_invoice_detail', 'line', 'ref', $ref, '');                                
                            $sqlstr="insert into sales_invoice_detail (ref, so_ref, item_code, uom_code, qty, discount, discount3, unit_price, amount, non_discount, unit_cost, amount_cost, line_item_so, line) values ('$ref', '$xndf', '$item_code', '$uom_code', '$qty', '$discount', '$discount3', '$unit_price', '$amount', '$non_discount', '$unit_cost', '$amount_cost', '$so_line', '$line')";
                            $sql=$dbpdo->prepare($sqlstr);
                            $sql->execute();    
                        }

                    }
                    //--------end sales_invoice-----------/\--
                }

                //end
            $temp .= "<td>";
            $temp .= "</tr>";

        } //>>>>>
        //$temp .= "</tbody></table>";

        //echo $temp;
    }

?>


<div class="content-body">
    <div class="container-fluid">                       
        <div class="row">
            <div class="col-xl-12">
                  
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="row" role="form" action="" method="post" name="client_view" id="client_view" class="form-horizontal" enctype="multipart/form-data" >

                                    
                                    <div class="col-2 offset-5 ">
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Proses"/>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- PAGE CONTENT BEGINS -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="font-size: 11px" >
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Id</th>
                                        <th>App ID</th>
                                        <th>Order Number</th>
                                        <th>Email</th>
                                        <th>Currency</th>
                                        <th>Unit Price</th>
                                        <th>Detail</th>
                                        <th>Customer</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        echo $temp;
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div><!-- /.page-content -->