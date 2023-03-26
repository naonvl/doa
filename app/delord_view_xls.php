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
            header("Content-Disposition: attachment; filename=Pengiriman_Report.xls");

            include_once ("include/queryfunctions.php");
            include_once ("include/functions.php");
            include_once ("include/function_excel.php");

            include 'class/class.select.php';

            $select = new select;

            $from_date              =    $_REQUEST['from_date'];
            $to_date                =    $_REQUEST['to_date'];
            $client_code            =    $_REQUEST['client_code'];
            $expedition_id          =    $_REQUEST["expedition_id"];
            $all                    =    $_REQUEST['all'];
        ?>

        <table border="1">
            <tr>
                <th colspan="8" style="font-weight:bold; text-align: center;">LAPORAN PENGIRIMAN</th>
            </tr>
            <tr>
                <th class="center" style="font-weight:bold ">No.</th>
                <th>No. Ref</th>
                <th>Tanggal</th>
                <th>Dari Gudang/Toko</th>
                <th>Nama Pengirim</th>
                <th>Nama Penerima</th>
                <th><?php if($lng==1) { echo 'Qty'; } else { echo 'qty'; } ?></th>
                <th><?php if($lng==1) { echo 'Amount'; } else { echo 'Jumlah Ongkir'; } ?></th>
            </tr>

            <?php
                $no = 0;
                $sql=$select->list_delivery_order("", $from_date, $to_date, $all, $expedition_id);
                while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
                  
                    $no++;

                    $total_qty = $total_qty + $row_delivery_order->qty;
                    $total_expedition = $total_expedition + $row_delivery_order->freight_cost;
            ?>
            <tr <?php echo $void_color ?> >
                <td><?php echo $no ?></td> 
                <td><?php echo $row_delivery_order->ref ?></td>
                <td><?php echo date("d-m-Y", strtotime($row_delivery_order->date)) ?></td>
                <td><?php echo $row_delivery_order->location_name ?></td>
                <td><?php echo $row_delivery_order->uid ?></td>
                <td><?php echo $row_delivery_order->client_name ?></td>
                <td><?php echo $row_delivery_order->qty ?></td>   
                <td align="right"><?php echo $row_delivery_order->freight_cost ?></td>  
            </tr>
            
        <?php
            }
        ?>
            <tr style="font-size: 14px; font-weight: bold;">
                <td align="right" colspan="6">TOTAL</td>
                <td align="right"><?php echo number_format($total_qty,"0",".",",") ?></td>
                <td align="right"><?php echo number_format($total_expedition,"0",".",",") ?></td>
            </tr>
        </table>
    </body>
</html>