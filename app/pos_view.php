<?php

$from_date              =    $_REQUEST['from_date'];
$to_date                =    $_REQUEST['to_date'];
$shift                  =    $_REQUEST['shift'];
$cashier                =    $_REQUEST['cashier'];
$employee_id            =    $_POST["employee_id"];
$client_code            =    $_POST["client_code"];
$client_type            =    $_POST["client_type"];
$channel_id             =    $_POST["channel_id"];
$receipt_type           =    $_POST["receipt_type"];
$all                    =    $_REQUEST['all'];

/*if($shift == "") {
    $shift = $_SESSION["shift"];
}*/

if($from_date == "") {
    $from_date = date("d F, Y");
}

if($to_date == "") {
    $to_date = date("d F, Y");
}

if($all == 1 || $all == true) {
    $all2 = "checked";
}
        
?>

<script type="text/javascript">
    function hapus(id) {
        if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
            document.location.href = "<?php echo obraxabrix('pos_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
        }
    }
</script>

<script>
    function print() {
        var from_date   =    document.getElementById('from_date').value;
        var to_date     =     document.getElementById('to_date').value;
        var shift       =     document.getElementById('shift').value;
        var cashier     =     document.getElementById('cashier').value;
        var all         =     0; //document.getElementById('all').value;
        
        window.location = "app/pos_view_print_create.php?from_date="+from_date+"&to_date="+to_date+"&shift="+shift+"&cashier="+cashier+"&all="+all; //localhost only
        //window.location = "app/pos_view_print_create_ol.php?from_date="+from_date+"&to_date="+to_date+"&shift="+shift+"&cashier="+cashier; //internet only
    }

    function excel_export() {
        var from_date           =    document.getElementById('from_date').value;
        var to_date             =    document.getElementById('to_date').value;
        var all                 =    document.getElementById('all').checked;
        var shift               =    0; //document.getElementById('shift').value;
        var cashier                =    ''; //document.getElementById('cashier').value;
        var employee_id            =    document.getElementById('employee_id').value;
        var client_code            =    document.getElementById('client_code').value;
        var client_type            =    document.getElementById('client_type').value;
        var channel_id             =    document.getElementById('channel_id').value;

        if(all == true) { all = 1; }
        if(all == false) { all = 0; }

        document.location.href = "app/pos_view_xls.php?from_date="+from_date+"&to_date="+to_date+"&shift="+shift+"&all="+all+"&cashier="+cashier+"&employee_id="+employee_id+"&client_code="+client_code+"&client_type="+client_type+"&channel_id="+channel_id+"";   

        //document.location.href = "app/export_excel.php";   


    }
</script>

<div class="content-body">
    <div class="container-fluid">                       
        <div class="row">
            <div class="col-xl-12">
                    
                <?php
                    $delete = $segmen3; //$_REQUEST['mxKz'];
                    //$segmen4 = $_REQUEST['id'];
                    if ($delete == "xm8r389xemx23xb2378e23") {
                        include 'class/class.delete.php';
                        $delete2=new delete;
                        $delete2->delete_pos($segmen4);
                ?>
                        <div class="alert alert-success">
                            <strong>Delete Data successfully</strong>
                        </div>
                        
                        <!-- <meta http-equiv="Refresh" content="0;url=<php echo $nama_folder . '/' . obraxabrix('pos_view'); ?>" /> -->
                        <script type="text/javascript">
                            window.location = '<?php echo $__folder ?><?php echo obraxabrix('pos_view') ?>';  
                        </script>
                <?php
                        
                        
                    }
                ?>
                            
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form class="form-horizontal" role="form" action="" method="post" name="purchase_view" id="purchase_view" class="form-horizontal" enctype="multipart/form-data" >

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">Dari Tanggal</p>
                                                <input type="text" name="from_date" class="datepicker-default form-control" id="from_date" autocomplete="off" value="<?php echo $from_date ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">s/d Tanggal</p>
                                                <input type="text" name="to_date" class="datepicker-default form-control" id="to_date" autocomplete="off" value="<?php echo $to_date ?>">
                                            </div>
                                        </div>                                
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">Customer</p>
                                                <select id="client_code" name="client_code" class="destroy-selector" >
                                                    <option value=""></option>
                                                    <?php 
                                                        select_client($client_code);
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">Jenis Customer</p>
                                                <select id="client_type" name="client_type" class="destroy-selector" >
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("client_type","id","name","active","1",$client_type) 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">Jenis Channel</p>
                                                <select id="channel_id" name="channel_id" class="destroy-selector" >
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("channel","id","name","active","1",$channel_id);
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">Kasir</p>
                                                <select id="employee_id" name="employee_id" class="destroy-selector" >
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active("employee","id","name","active","1",$employee_id);
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">Jenis Pembayaran</p>
                                                <select class="destroy-selector" id="receipt_type" name="receipt_type">
                                                    <option value=""></option>
                                                    <?php 
                                                        combo_select_active('payment_method', 'id', 'name', 'active', '1', $receipt_type) 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">All</p>
                                                <input id="all" name="all" type="checkbox" class="form-check-input" value="1" <?php echo $all2 ?> >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <p class="mb-1">User ID :</p>
                                                <?php 
                                                    echo $_SESSION['loginname'];
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-4 mb-3">
                                            <div class="example">
                                                <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
                                                &nbsp;&nbsp;<a href="JavaScript:excel_export()">
                                                    <img src="images/excel.jpg" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
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
                                        <th>Edit|Delete</th>
                                        <th class="center" style="font-weight:bold ">No.</th>
                                        <th><?php if($lng==1) { echo 'Ref No'; } else { echo 'No. Nota'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Time'; } else { echo 'Jam'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Client'; } else { echo 'Customer'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Client Type'; } else { echo 'Jenis Customer'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Channel Type'; } else { echo 'Jenis Channel'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Cashier'; } else { echo 'Kasir'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Gross Sales'; } else { echo 'Gross Sales'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Discount'; } else { echo 'Discount'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Net Sales'; } else { echo 'Net Sales'; } ?></th>
                                        <th><?php if($lng==1) { echo 'COGS'; } else { echo 'COGS'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Gross Profit'; } else { echo 'Gross Profit'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Kontan'; } else { echo 'Kontan'; } ?></th>
                                        <th><?php if($lng==1) { echo 'Debit'; } else { echo 'Debit'; } ?></th>
                                        <!--<th><?php if($lng==1) { echo 'Total'; } else { echo 'Total'; } ?></th>-->
                                        
                                            
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php           
                                        $grand_gross_sales = 0;
                                        $grand_net_sales = 0;
                                        $grand_cogs = 0;
                                        $grand_gross_profit = 0;
                                        $grand_total = 0;
                                        $grand_discount = 0;
                                        $grand_cash     = 0;
                                        $grand_bank     = 0;
                                        $grand_total_owner = 0;
                                        $grand_total_capster = 0;       
                                        $i = 0;                                 

                                        $sql=$select->list_pos('', $all, $from_date, $to_date, $shift, $cashier, $employee_id, "", $client_code, $client_type, $channel_id, '', $receipt_type);
                                        while($row_pos=$sql->fetch(PDO::FETCH_OBJ)){
                                        
                                        $i++;
                                        
                                        $status = "";
                                        if ($row_pos->status == "P") {
                                            $status = "Planned";
                                        }
                                        if ($row_pos->status == "R") {
                                            $status = "Released";
                                        }
                                        if ($row_pos->status == "I") {
                                            $status = "Paid in Part";
                                        }
                                        if ($row_pos->status == "F") {
                                            $status = "Paid in Full";
                                        }
                                        if ($row_pos->status == "V") {
                                            $status = "Void";
                                        }
                                        if ($row_pos->status == "S") {
                                            $status = "Shipped in Part";
                                        }
                                        if ($row_pos->status == "E") {
                                            $status = "Shipped in Full";
                                        }
                                        if ($row_pos->status == "C") {
                                            $status = "Closed";
                                        }
                                        
                                        //get discount detail
                                        $discount = 0;
                                        $sqldsc = $select->get_pos_detail_discount($row_pos->ref);
                                        $datadisc = $sqldsc->fetch(PDO::FETCH_OBJ);
                                        $discount_det = $datadisc->discount;
                                        $discount = $discount_det + $row_pos->discount;
                                        
                                        //get employee
                                        $jmlcapster = 0;
                                        $employee = $row_pos->employee_name;
                                        if($employee == "") {                               
                                            $sql3 = $select->list_sales_invoice_employee($row_pos->ref, $employee_id);
                                            while($data3 = $sql3->fetch(PDO::FETCH_OBJ)) {
                                                if($employee == "") {
                                                    $employee = $data3->name;
                                                } else {
                                                    $employee = $employee . "<br>" . $data3->name;
                                                    $jmlcapster = 1;
                                                }
                                            }
                                        }
                                        
                                        $sql2 = $select->list_sales_invoice_employee($row_pos->ref, "");
                                        $rows = $sql2->rowCount();
                                        if($rows == 0 || $jmlcapster == 1) {
                                            $rows = 1;
                                        }
                                        
                                        $grand_total = $grand_total + ( ($row_pos->total-$discount)/$rows);
                                        
                                        //hitung commision
                                        $total  =   ( ($row_pos->total-$discount)/$rows);
                                        $total  =   $total - (( ( ($row_pos->total-$discount)/$rows) * $row_pos->commision_rate)/100);
                                        $commision = ( ( ($row_pos->total-$discount)/$rows) * $row_pos->commision_rate)/100;
                                        
                                        $grand_total_owner = $grand_total_owner + $total;
                                        $grand_total_capster = $grand_total_capster + $commision;
                                        
                                        //
                                        $grand_cash     = $grand_cash + (($row_pos->total-$row_pos->bank_amount-$discount))/$rows;
                                        $grand_bank     = $grand_bank + $row_pos->bank_amount;
                                        
                                        //get cogs
                                        $sqldet = $select->get_pos_detail($row_pos->ref);
                                        $data_det = $sqldet->fetch(PDO::FETCH_OBJ);
                                        
                                        $grand_discount = $grand_discount + $row_pos->discount + $data_det->discount;
                                        $grand_gross_sales = $grand_gross_sales + $row_pos->total;
                                        $grand_net_sales = $grand_net_sales + ($row_pos->total-$row_pos->discount-$data_det->discount);
                                        $grand_cogs = $grand_cogs + $data_det->amount_cost;
                                        $grand_gross_profit = $grand_gross_profit + ($row_pos->total-$row_pos->discount-$data_det->amount_cost);

                                        //check return
                                        $sqlrtn=$select->list_sales_return('', '', '', '', $row_pos->ref);
                                        $rowsrtn=$sqlrtn->rowCount();

                                        $font_color = 'black';
                                        if($rowsrtn > 0) {
                                            $font_color = "red";
                                        }
                        
                                        $j++;
                                    ?>
                                                
                                            <tr style="color: <?= $font_color ?>">
                                                <td align="center">
                                                
                                                    <?php if (allowupd('frmpos')==1) { ?>
                                                        <a href="<?php echo $__folder ?><?php echo obraxabrix('pos') ?>/<?php echo $row_pos->ref ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php } ?>
                                                    
                                                    <?php if (allowdel('frmpos')==1) { ?>   
                                                        &nbsp;
                                                        <a href="JavaScript:hapus('<?php echo $row_pos->ref ?>')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $i ?></td> 
                                                <td>
                                                    <?php 
                                                        if($row_pos->ref2 == "") {
                                                            echo $row_pos->ref;
                                                        } else {
                                                            echo $row_pos->ref2;
                                                        }
                                                         
                                                    ?>  
                                                </td>
                                                <td><?php echo date("d-m-Y", strtotime($row_pos->date)) ?></td>
                                                <td><?php echo date("H:i", strtotime($row_pos->dlu)) ?></td>
                                                <td><?php echo $row_pos->client_name ?></td>
                                                <td><?php echo $row_pos->client_type_name ?></td>
                                                <td><?php echo $row_pos->channel_name ?></td>
                                                <td><?php echo $row_pos->employee_name ?></td>
                                                <td align="right"><?php echo number_format($row_pos->total,0,".",",") ?></td>
                                                <td align="right"><?php echo number_format($row_pos->discount,0,".",",") ?></td>
                                                <td align="right"><?php echo number_format($row_pos->total-$row_pos->discount,0,".",",") ?></td>
                                                <td align="right"><?php echo number_format($data_det->amount_cost,0,".",",") ?></td>
                                                <td align="right"><?php echo number_format($row_pos->total-$row_pos->discount-$data_det->amount_cost,0,".",",") ?></td>
                                                <td align="right"><?php echo number_format(($row_pos->total-$row_pos->bank_amount->$discount)/$rows,0,".",",") ?></td>
                                                <td align="right"><?php echo number_format($row_pos->bank_amount,0,".",",") ?></td>
                                                <!--<td align="right" style="background-color: #072d04; color: #ffffff"><?php echo number_format($row_pos->total/$rows,0,".",",") ?></td>-->
                                                
                                                
                                                            
                                            </tr>
                                        
                                        <?php
                                            }
                                        ?>
                                        
                                </tbody>

                                <tr style="font-size: 14px; font-weight: bold;">
                                    <td colspan="9" align="right">Total</td> 
                                    <td align="right" style="background-color: #072d04; color: #ffffff"><?php echo number_format($grand_gross_sales,0,".",",") ?></td>
                                    <td align="right"><?php echo number_format($grand_discount,0,".",",") ?></td>
                                    <td align="right"><?php echo number_format($grand_net_sales,0,".",",") ?></td>
                                    <td align="right"><?php echo number_format($grand_cogs,0,".",",") ?></td>
                                    <td align="right"><?php echo number_format($grand_gross_profit,0,".",",") ?></td>
                                    <td align="right"><?php echo number_format($grand_cash,0,".",",") ?></td>
                                    <td align="right"><?php echo number_format($grand_bank,0,".",",") ?></td>
                                    
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div><!-- /.page-content -->
