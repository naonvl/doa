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
          CURLOPT_URL => 'https://doa-official-store.myshopify.com/admin/api/2022-04/customers.json',
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
        /*$temp .= "<thead>";
        $temp .= "<tr><th>Id</th>";
        $temp .= "<th>Email</th>";
        $temp .= "<th>accepts_marketing</th>";
        $temp .= "<th>created_at</th></th>";
        $temp .= "<th>addresses</th></tr></thead><tbody>";*/

        $client_name        =   "";
        $client_address1    =   "";
        $client_address2    =   "";
        $client_province    =   "";
        $client_city        =   "";
        $client_zip         =   "";
        $client_country     =   "";
        $client_phone       =   "";

        for($i = 0; $i < sizeof($data["customers"]); $i++)
        {
            $temp .= "<tr>";
            $temp .= "<td>" . ($i+1) . "</td>";
            $temp .= "<td>" . $data["customers"][$i]["id"] . "</td>";
            $temp .= "<td>" . $data["customers"][$i]["email"] . "</td>";
            $temp .= "<td>" . $data["customers"][$i]["first_name"] . "</td>";
            $temp .= "<td>" . $data["customers"][$i]["last_name"] . "</td>";
            $temp .= "<td>";
                $adr = $data["customers"][$i]["addresses"];
                foreach($adr as $row) {
                    $temp .= "Address-1: ".$row['address1']."<br>";
                    $temp .= "Address-2: ".$row['address2']."<br>";
                    $temp .= "City: ".$row['city']."<br>";
                    $temp .= "Provincy: ".$row['province']."<br>";
                    $temp .= "Country: ".$row['country']."<br>";
                    $temp .= "Zip: ".$row['zip']."<br>";
                    $temp .= "Phone: ".$row['phone']."<br>";
                    $temp .= "Name: ".$row['name']."<br>";

                    //get data
                    $client_name        =   $row['name'];
                    $client_address1    =   $row['address1'];
                    $client_address2    =   $row['address2'];
                    $client_province    =   $row['province'];
                    $client_city        =   $row['city'];
                    $client_zip         =   $row['zip'];
                    $client_country     =   $row['country'];
                    $client_phone       =   $row['phone'];
                }
            $temp .= "<td>";
            $temp .= "</tr>";

            //---process insert data to table client
            $syscode        =   $data["customers"][$i]["id"];
            $strsql         =   "select syscode from client where syscode='$syscode'";
            $sql            =   $dbpdo->query($strsql);
            $count_client   =   $sql->rowCount();

            $code           =   $data["customers"][$i]["id"];
            $title          =   "";

            if($client_name != "") {
                $name           =   petikreplace($client_name);
                $last_name      =   petikreplace($data["customers"][$i]["last_name"]);
            } else {
                $name           =   petikreplace($data["customers"][$i]["first_name"]);
                $last_name      =   petikreplace($data["customers"][$i]["last_name"]);
            }
            $contact_person =   petikreplace($client_name);
            $contact_person1=   "";
            $contact_person2=   "";
            $contact_person3=   "";
            $client_type    =   13; //perorangan

            $address        =   petikreplace($client_address1);
            $address1       =   petikreplace($client_address2);
            $ship_to        =   petikreplace($client_address1);
            $bill_to        =   petikreplace($client_address1);
            $zip_code       =   $client_zip;
            $country_name   =   $client_country;
            $country_id     =   1;
            $state_id       =   0;
            $province       =   petikreplace($client_province);
            $kabupaten      =   "";
            $kecamatan      =   "";
            $phone          =   $client_phone;
            $phone1         =   "";
            $fax            =   "";
            $email          =   $data["customers"][$i]["email"];
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
            $uid            =   $_SESSION["loginname"].' shopify';
            $dlu            =   date("Y-m-d H:i:s");
                        
            if($count_client == 0) {
                $sqlstr="insert into client (code, title, name, last_name, contact_person, contact_person1, contact_person2, contact_person3, client_type, address, address1, ship_to, bill_to, zip_code, country_id, state_id, kabupaten, kecamatan, province, phone, phone1, fax, email, web, bank_name, bank_branch, bank_account, bank_account_no, amount, location_id, stockist, active, client_syscode, bagi_komisi, uid, dlu, syscode) values ('$code', '$title', '$name', '$last_name', '$contact_person', '$contact_person1', '$contact_person2', '$contact_person3', '$client_type', '$address', '$address1', '$ship_to', '$bill_to', '$zip_code', '$country_id', '$state_id', '$kabupaten', '$kecamatan', '$province', '$phone', '$phone1', '$fax', '$email', '$web', '$bank_name', '$bank_branch', '$bank_account', '$bank_account_no', '$amount', '$location_id', '$stockist', '$active', '$client_syscode', 1, '$uid', '$dlu', '$syscode')";
                $sql=$dbpdo->prepare($sqlstr);
                $sql->execute();
            } else {
                $sqlstr="update client set code='$code', title='$title', name='$name', last_name='$last_name', contact_person='$contact_person', contact_person1='$contact_person1', contact_person2='$contact_person2', contact_person3='$contact_person3', client_type='$client_type', address='$address', address1='$address1', ship_to='$ship_to', bill_to='$bill_to', zip_code='$zip_code', kabupaten='$kabupaten', kecamatan='$kecamatan', phone='$phone', phone1='$phone1', fax='$fax', email='$email', web='$web', updateby='$uid', updated='$dlu' where syscode='$syscode'";
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
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Address</th>
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