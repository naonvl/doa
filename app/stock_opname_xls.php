<html>
    <head>
        <style> .str{ mso-number-format:\@; } </style>
        <style>
            .hide {
              opacity: 0;
            }
            #hide__ {
              opacity: 0;
            }
        </style>
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
            header("Content-Disposition: attachment; filename=Stock_Opname.xls");

            include_once ("include/queryfunctions.php");
            include_once ("include/functions.php");
            include_once ("include/function_excel.php");

            include 'class/class.select.php';
            include 'class/class.selectview.php';
            $select = new select;
            $selectview = new selectview;

            $date                   =    $_REQUEST['date'];
            $location_id            =    numberreplace($_REQUEST['location_id']);
            if($location_id == 0) {
                $location_id = 1;
            }
            $all                    =    1;

            $sql    = $select->list_warehouse($location_id);
            $data_ws= $sql->fetch(PDO::FETCH_OBJ);
        ?>

        <table border="1">
            <tr>
                <th colspan="7" style="font-weight:bold; text-align: center;">DAFTAR STOCK OPNAME</th>
            </tr>
            <tr>
                <th style="font-weight:bold; text-align: left;">TANGGAL</th>
                <th style="font-weight:bold; text-align: left;"><?= date('d-m-Y', strtotime($date)) ?></th>
                <th style="font-weight:bold; text-align: left;">Gudang : <?= $data_ws->name ?></th>
                <th style="font-weight:bold; text-align: left;"><?= $location_id ?></th>
            </tr>
            <tr>
                <th class="center" style="font-weight:bold ">No.</th>
                <th><?php if($lng==1) { echo 'Item Code'; } else { echo 'Kode Barang'; } ?></th>
                <th><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Barang'; } ?></th>
                <th><?php if($lng==1) { echo 'UoM'; } else { echo 'Satuan'; } ?></th>
                <th><?php if($lng==1) { echo 'Qty System'; } else { echo 'Qty Sistem'; } ?></th>
                <th><?php if($lng==1) { echo 'Qty Stock Opname'; } else { echo 'Qty Stock Opname'; } ?></th>
                <th><?php if($lng==1) { echo 'Unit Cost'; } else { echo 'Harga'; } ?></th>
            </tr>

            <?php
                $i = 0;                                 
                $sql=$select->get_item();
                while($row_pos=$sql->fetch(PDO::FETCH_OBJ)){
                
                    $i++;

                    //---------cek stok
                    $sql3 = $selectview->rpt_bincard_openblc_item__($row_pos->syscode, $row_pos->uom_code_stock, $location_id, $date, $all, '');
                    $data_opnblc = $sql3->fetch(PDO::FETCH_OBJ);
                    $opnblc = $data_opnblc->opnblc;
                    
                    $total_qty = 0;
                    $total_qty = $opnblc; //+ $qty;

                    //get debit credit qty
                    $sqldet = $selectview->rpt_bincard_daily_item($row_pos->syscode, $row_pos->uom_code_stock, $location_id, $date, $date);
                    $data_det = $sqldet->fetch(PDO::FETCH_OBJ);

                    $total_qty = $total_qty + $data_det->debit_qty - $data_det->credit_qty
                    //=======================================
                    
            ?>
                    <tr>
                        <td><?php echo $i ?></td> 
                        <td><?php echo $row_pos->code ?></td>
                        <td><?php echo $row_pos->name ?></td>
                        <td><?php echo $row_pos->uom_code_stock ?></td>
                        <td><?php echo number_format($total_qty,0,'.',',') ?></td>
                        <td></td>
                        <td align="right"></td>        
                    </tr>
                
            <?php
                }
            ?>
        </table>
    </body>
</html>
