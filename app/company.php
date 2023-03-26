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


<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <?php 
            $ref = $segmen3; //$_GET['search'];
                
            include("app/exec/insert_company.php"); 
            
            $active = "checked";
            
            if ($ref != "") {
                $sql=$select->list_company($ref);
                $row_company=$sql->fetch(PDO::FETCH_OBJ);   
                
                $active = $row_company->active;
                if($active == 1) {
                    $active = "checked";
                } else {
                    $active = "";
                }
            }       


            ##-------test api
            /*$curl = curl_init();

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

            $response = curl_exec($curl);*/

            //curl_close($curl);
            //echo $response;

            //var_dump(json_decode($response, true));
            //$data1 = json_decode($response, true);
            /*$data1 = $response;
            $data = json_decode($response, true);*/
            //echo(json_encode($data));


            /*$data1 = '{"employees":
                    [
                    {
                    "empName": "Swati Nanda",
                    "designation": "Project Manager",
                    "comtbpany": "InfoSys",
                    "mob": "9092353322"
                    },
                    {
                    "empName": "Pravat Mishra",
                    "designation": "English Trainer",
                    "company": "FM College",
                    "mob": "7847324432"
                    },
                    {
                    "empName": "Divya Singh",
                    "designation": "Sr. Content Writer",
                    "company": "Wipro",
                    "mob": "9625477893"
                    },
                    {
                    "empName": "Baby Roy",
                    "designation": "Graphic Engineer",
                    "company": "Tech Mahindra",
                    "mob": "9096266548"
                    },
                    {
                    "empName": "Satyabrata Panda",
                    "designation": "Sr. Software Engineer",
                    "company": "Capgemini",
                    "mob": "5567748833"
                    }
                    ]
                    }';
            $data = json_decode($data1, true);

            $temp = "<table>";

            $temp .= "<tr><th>Employee Name</th>";
            $temp .= "<th>Designation</th>";
            $temp .= "<th>Company</th>";
            $temp .= "<th>Mobile Number</th></tr>";

            for($i = 0; $i < sizeof($data["employees"]); $i++)
            {
            $temp .= "<tr>";
            $temp .= "<td>" . $data["employees"][$i]["empName"] . "</td>";
            $temp .= "<td>" . $data["employees"][$i]["designation"] . "</td>";
            $temp .= "<td>" . $data["employees"][$i]["company"] . "</td>";
            $temp .= "<td>" . $data["employees"][$i]["mob"] . "</td>";
            $temp .= "</tr>";
            }

            $temp .= "</table>";
            echo $temp;*/




            ?>
            <!-- <table border="1" width="100%" id="example" class="display"> -->

            <?php
            /*$temp .= "<tr><th>Id</th>";
            $temp .= "<th>Email</th>";
            $temp .= "<th>accepts_marketing</th>";
            $temp .= "<th>created_at</th></th>";
            $temp .= "<th>addresses</th></tr>";

            for($i = 0; $i < sizeof($data["customers"]); $i++)
            {
                $temp .= "<tr>";
                $temp .= "<td>" . $data["customers"][$i]["id"] . "</td>";
                $temp .= "<td>" . $data["customers"][$i]["email"] . "</td>";
                $temp .= "<td>" . $data["customers"][$i]["accepts_marketing"] . "</td>";
                $temp .= "<td>" . $data["customers"][$i]["created_at"] . "</td>";
                $temp .= "<td>";
                $adr = $data["customers"][$i]["addresses"];
                foreach($adr as $row) {
                    $temp .= $row['address1']."<br>";
                }
                $temp .= "<td>";*/
                //$data2 = json_decode($response, true);
                /*for($x=0; $x<count($data["customers"][$i]["addresses"]); $x++) {
                    echo $data["customers"][$i]["addresses"][$x].'<br>';
                }*/

                //print_r($data["customers"][$i]["addresses"]);

               /* $temp .= "</tr>";

            }
            $temp .= "</table>";



            echo $temp;*/

            /*$json=file_get_contents("http://west.basketball.nl/db/json/stand.pl?szn_Naam=2014-2015&cmp_ID=373");
            $data =  json_decode($json);

            if (count($data->stand)) {
                // Open the table
                echo "<table>";

                // Cycle through the array
                foreach ($data->stand as $idx => $stand) {

                    // Output a row
                    echo "<tr>";
                    echo "<td>$stand->afko</td>";
                    echo "<td>$stand->positie</td>";
                    echo "</tr>";
                }

                // Close the table
                echo "</table>";
            }*/
            
        ?>

        <form class="row" role="form" action="" method="post" name="company" id="company" class="form-horizontal" onSubmit="return cekinput('name');">

            <input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">
                            <!-- FORM KIRI -->
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Company Name</label>
                                    <div class="col-10">
                                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $row_company->name ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Businiss Type</label>
                                    <div class="col-10">
                                        <input type="text" id="businiss_type" name="businiss_type" class="form-control" value="<?php echo $row_company->businiss_type ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">NPWP</label>
                                    <div class="col-10">
                                        <input type="text" id="npwp" name="npwp" class="form-control" value="<?php echo $row_company->npwp ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Address-1</label>
                                    <div class="col-10">
                                        <input type="text" id="address1" name="address1" class="form-control" value="<?php echo $row_company->address1 ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Address-2</label>
                                    <div class="col-10">
                                        <input type="text" id="address2" name="address2" class="form-control" value="<?php echo $row_company->address2 ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Phone-1<span class="required"></span></label>
                                    <div class="col-10">
                                        <input type="text" id="phone1" name="phone1" class="form-control" value="<?php echo $row_company->phone1 ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- FORM KIRI -->
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Phone-2</label>
                                    <div class="col-10">
                                        <input type="text" id="phone2" name="phone2" class="form-control" value="<?php echo $row_company->phone2 ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Fax.</label>
                                    <div class="col-10">
                                        <input type="text" id="fax" name="fax" class="form-control" value="<?php echo $row_company->fax ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">City</label>
                                    <div class="col-10">
                                        <input type="text" id="city" name="city" class="form-control" value="<?php echo $row_company->city ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Country</label>
                                    <div class="col-10">
                                        <input type="text" id="country" name="country" class="form-control" value="<?php echo $row_company->country ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Website</label>
                                    <div class="col-10">
                                        <input type="text" id="web" name="web" class="form-control" value="<?php echo $row_company->web ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Bank Name</label>
                                    <div class="col-10">
                                        <input type="text" id="bank_name" name="bank_name" class="form-control" value="<?php echo $row_company->bank_name ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Bank Account No</label>
                                    <div class="col-10">
                                        <input type="text" id="bank_account" name="bank_account" class="form-control" value="<?php echo $row_company->bank_account ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Bank Account Name</label>
                                    <div class="col-10">
                                        <input type="text" id="bank_account_name" name="bank_account_name" class="form-control" value="<?php echo $row_company->bank_account_name ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">Active</label>
                                    <div class="col-10">
                                        <input id="active" name="active" type="checkbox" class="form-check-input" value="1" <?php echo $active ?> >
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3 row">
                                    <label class="col-2 col-form-label">E-mail</label>
                                    <div class="col-10">
                                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $row_company->email ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="col-md-offset-3 col-md-9" style="text-align: right;">
                                <input type="button" name="submit" id="submit" class="btn btn-success me-6" value="List Data" onclick="self.location='<?php echo $nama_folder . '/'.obraxabrix('company_view') ?>'" />
                                <?php if (allowadd('frmcompany')==1) { ?>
                                    <?php if($ref=='') { ?>
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Save" />
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowupd('frmcompany')==1) { ?>
                                    <?php if($ref!='') { ?>
                                        <input type="submit" name="submit" id="submit" class='btn btn-primary me-6' value="Update" />
                                    <?php } ?>
                                <?php } ?>

                                <?php if (allowdel('frmcompany')==1) { ?>
                                    <?php if($ref!='') { ?>
                                        <input type="submit" name="submit" class="btn btn-danger me-6" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div>