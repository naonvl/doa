<html>
    <head>
    </head>
    <body>
        <?php
            session_start();

            if (($_SESSION["logged"] == 0)) {
            	echo 'Access denied';
            	exit;
            }
        ?>
        <?php
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Sales_Report.xls");

            include_once ("include/queryfunctions.php");
            include_once ("include/functions.php");
            include_once ("include/function_excel.php");

            include 'class/class.select.php';

            $select = new select;

            $from_date              =    $_REQUEST['from_date'];
            $to_date                =    $_REQUEST['to_date'];
            $shift                  =    $_REQUEST['shift'];
            $cashier                =    $_REQUEST['cashier'];
            $employee_id            =    $_REQUEST["employee_id"];
            $client_code            =    $_REQUEST["client_code"];
            $client_type            =    $_REQUEST["client_type"];
            $channel_id             =    $_REQUEST["channel_id"];
            $all                    =    $_REQUEST['all'];
        ?>

        <table border="1">
            <tr>
                <th colspan="15" style="font-weight:bold; text-align: center;">LAPORAN PENJUALAN</th>
            </tr>
            <tr>
                <th class="center" style="font-weight:bold ">No.</th>
                <th><?php if($lng==1) { echo 'Ref No'; } else { echo 'No. Nota'; } ?></th>
                <th><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>
                <th><?php if($lng==1) { echo 'Time'; } else { echo 'Jam'; } ?></th>
                <th><?php if($lng==1) { echo 'Client'; } else { echo 'Customer'; } ?></th>
                <th><?php if($lng==1) { echo 'Client Type'; } else { echo 'Jenis Customer'; } ?></th>
                <th><?php if($lng==1) { echo 'Channel Type'; } else { echo 'Jenis Channel'; } ?></th>
                <th><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Artikel'; } ?></th>
                <th><?php if($lng==1) { echo 'Cashier'; } else { echo 'Kasir'; } ?></th>
                <th><?php if($lng==1) { echo 'Gross Sales'; } else { echo 'Gross Sales'; } ?></th>
                <th><?php if($lng==1) { echo 'Discount'; } else { echo 'Discount'; } ?></th>
                <th><?php if($lng==1) { echo 'Net Sales'; } else { echo 'Net Sales'; } ?></th>
                <th><?php if($lng==1) { echo 'COGS'; } else { echo 'COGS'; } ?></th>
                <th><?php if($lng==1) { echo 'Gross Profit'; } else { echo 'Gross Profit'; } ?></th>
                <th><?php if($lng==1) { echo 'Kontan'; } else { echo 'Kontan'; } ?></th>
                <th><?php if($lng==1) { echo 'Debit'; } else { echo 'Debit'; } ?></th>
            </tr>

            <?php
                $no = 0;
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

                $sql=$select->list_pos('', $all, $from_date, $to_date, $shift, $cashier, $employee_id, "", $client_code, $client_type, $channel_id);
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

                    $no++;
            ?>
            <tr <?php echo $void_color ?> >
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
                <td>
                    <table border="1">
                        <tr>
                            <td>Nama Artikel</td>
                            <td>Satuan</td>
                            <td>Qty</td>
                            <td>Harga</td>
                            <td>Discount</td>
                            <td>Total</td>
                        </tr>

                        <?php 
                            $sqldet = $select->list_pos_detail($row_pos->ref);
                            while($data_det = $sqldet->fetch(PDO::FETCH_OBJ)) {
                        ?>
                                 <tr style="border: 1px solid #green;">
                                    <td><?= $data_det->item_name ?></td>
                                    <td><?= $data_det->uom_code ?></td>
                                    <td><?= number_format($data_det->qty,0,'.',',') ?></td>
                                    <td align="right"><?= number_format($data_det->unit_price,0,'.',',') ?></td>
                                    <td align="right"><?= number_format($data_det->discount,0,'.',',') ?></td>
                                    <td align="right"><?= number_format($data_det->amount,0,'.',',') ?></td>
                                </tr>
                        <?php
                            }
                        ?>
                    </table>
                </td>
                <td><?php echo $row_pos->employee_name ?></td>
                <td align="right"><?php echo $row_pos->total ?></td>
                <td align="right"><?php echo $row_pos->discount ?></td>
                <td align="right"><?php echo $row_pos->total-$row_pos->discount ?></td>
                <td align="right"><?php echo $data_det->amount_cost ?></td>
                <td align="right"><?php echo $row_pos->total-$row_pos->discount-$data_det->amount_cost ?></td>
                <td align="right"><?php echo ($row_pos->total-$row_pos->bank_amount->$discount)/$rows ?></td>
                <td align="right"><?php echo $row_pos->bank_amount ?></td>            
            </tr>
            
        <?php
            }
        ?>
        </table>
    </body>
</html>
