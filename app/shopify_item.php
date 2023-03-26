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
          CURLOPT_URL => 'https://doa-official-store.myshopify.com/admin/api/2022-04/products.json',
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

        for($i = 0; $i < sizeof($data["products"]); $i++)
        {
            $temp .= "<tr>";
            $temp .= "<td>" . ($i+1) . "</td>";
            $temp .= "<td>" . $data["products"][$i]["id"] . "</td>";
            $temp .= "<td>" . $data["products"][$i]["title"] . "</td>";
            $temp .= "<td>" . $data["products"][$i]["vendor"] . "</td>";
            $temp .= "<td>" . $data["products"][$i]["updated_at"] . "</td>";
            $temp .= "<td>";
                $adr = $data["products"][$i]["variants"];
                foreach($adr as $row) {
                    $temp .= "Id: ".$row['id']."<br>";
                    $temp .= "Price: ".$row['price']."<br>";
                    $temp .= "SKU: ".$row['sku']."<br>";
                    $temp .= "Barcode: ".$row['barcode']."<br>";
                    $temp .= "Gram: ".$row['grams']."<br>";

                    //get data
                    $item_sku           =   $row['sku'];
                    $item_price         =   numberreplace($row['price']);
                    $item_barcode       =   $row['barcode'];
                    $item_grams         =   numberreplace($row['grams']);
                }
            $temp .= "<td>";
            $temp .= "</tr>";

            //---process insert data to table item
            $syscode        =   $data["products"][$i]["id"];
            $strsql         =   "select syscode from item where syscode='$syscode'";
            $sql            =   $dbpdo->query($strsql);
            $count_item     =   $sql->rowCount();

            $code           =   $item_sku;
            if($code == "") {
                $code = $syscode;
            }
            $old_code       =   $item_barcode;
            $name           =   petikreplace($data["products"][$i]["title"]);
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
            $date           =   date("Y-m-d");
            $efective_from  =   date("Y-m-d");
            $date_of_record =   date("Y-m-d H:i:s");
            $location_id    =   0;
            //----------------

            if($count_item == 0) {
                $sqlstr="insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, balance, description, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$balance', '$description', '$active', '$uid', '$dlu', '$syscode')";
                $sql=$dbpdo->prepare($sqlstr);
                $sql->execute();

                //insert unit price
                $sqlstr = "delete from set_item_price where item_code='$syscode' ";
                $sql=$dbpdo->prepare($sqlstr);
                $sql->execute();

                $sqlstr = "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$date', '$efective_from', '$syscode', '$uom_code_sales', '$item_price', '0', '0', '0', '0', '$date_of_record', '$location_id', '0', '0', '0', '0', '0', '$uid', '$dlu')";
                $sql=$dbpdo->prepare($sqlstr);
                $sql->execute();
            } else {
                $sqlstr="update item set code='$code', old_code='$old_code', name='$name', item_group_id='$item_group_id', item_subgroup_id='$item_subgroup_id', item_type_code='$item_type_code', item_category_id='$item_category_id', brand_id='$brand_id', size_id='$size_id', uom_code_stock='$uom_code_stock', uom_code_sales='$uom_code_sales', uom_code_purchase='$uom_code_purchase', minimum_stock='$minimum_stock', maximum_stock='$maximum_stock', photo='$photo', consigned='$consigned', balance='$balance', description='$description', active='$active', uid='$uid', dlu='$dlu' where syscode='$syscode'";
                $sql=$dbpdo->prepare($sqlstr);
                $sql->execute();

                //insert unit price
                $sqlstr = "delete from set_item_price where item_code='$syscode' ";
                $sql=$dbpdo->prepare($sqlstr);
                $sql->execute();

                $sqlstr = "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$date', '$efective_from', '$syscode', '$uom_code_sales', '$item_price', '0', '0', '0', '0', '$date_of_record', '$location_id', '0', '0', '0', '0', '0', '$uid', '$dlu')";
                $sql=$dbpdo->prepare($sqlstr);
                $sql->execute();
            }

        }
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
                            <table id="example" class="display">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Id</th>
                                        <th>Produk Name</th>
                                        <th>Vendor</th>
                                        <th>Update At</th>
                                        <th>Produk Detail</th>
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