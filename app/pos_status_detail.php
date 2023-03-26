<?php
	@session_start();

	if (($_SESSION["logged"] == 0)) {
		echo 'Access denied';
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="../images/favicon.png" />
	<link href="../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="../vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>
	<?php
		$ref 	=	$_GET['ref'];

		//include_once ("include/queryfunctions.php");
		include_once ("include/sambung.php");
		include_once ("include/functions.php");
		//include_once ("include/inword.php");

		include 'class/class.select.php';
		include 'class/class.selectview.php';
		$select = new select;
		$selectview = new selectview;

		$sql = $selectview->list_cash_invoice($ref);
		$row_cash_invoice=$sql->fetch(PDO::FETCH_OBJ);

		$client_name	=	$row_cash_invoice->client_name;
		$date			=	date('d-m-Y', strtotime($row_cash_invoice->date));
		$address		=	$row_cash_invoice->address;
		$phone			=	$row_cash_invoice->phone;
        $note_ecommerce =   $row_cash_invoice->note_ecommerce;
        $note_transfer  =   $row_cash_invoice->note_transfer;

        $status = "";
        if($row_cash_invoice->paid == 1) { $status = "Paid"; }
        if($row_cash_invoice->print == 1) { $status = "Print"; }
        if($row_cash_invoice->process_whs == 1) { $status = "Process Warehouse"; }
        if($row_cash_invoice->onshipped == 1) { $status = "On Shipped"; }
        if($row_cash_invoice->shipped == 1) { $status = "Terkirim"; }
	?>
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
		
		
        <!--**********************************
            Content body start
        ***********************************-->
        
            <div class="container-fluid">
				<div class="row">
                    <div class="col-lg-12">

                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <h6>No Invoice:</h6>
                                        <div> <strong><?= $ref ?></strong> </div>
                                        <div><?= $client_name ?></div>
                                        <div><?= $address ?></div>
                                        <div>Phone: <?= $phone ?></div>
                                        <h6>Note Nominal Transfer:</h6>
                                        <div><?= $note_transfer ?></div>
                                    </div>
                                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <h6>Tanggal:</h6>
                                        <div> <strong><?= $date ?></strong> </div>
                                        <h6>Status: <?= $status ?></h6>
                                        <h6>Ekspedisi: <?= $row_cash_invoice->expedition_name ?></h6>
                                        <h6>No Pesanan E-Commerce:</h6>
                                        <div><?= $note_ecommerce ?></div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th class="center">Qty</th>
                                                <th class="right">Harga</th>
                                                <th class="right">Discount</th>
                                                <th class="right">Total</th>
                                                <th class="right">Qty Kirim</th>
                                                <th>No Retur</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        		$no = 0;
                                        		$sql2 = $selectview->list_cash_invoice_detail($ref);
												while($row_cash_invoice_detail=$sql2->fetch(PDO::FETCH_OBJ)) {
													
													$no++;

													if($row_cash_invoice_detail->dummy == 1) {
														$sub_total = $sub_total + $row_cash_invoice_detail->amount2;	
														$unit_price = $row_cash_invoice_detail->unit_price2;
														$amount = $row_cash_invoice_detail->amount2;
														$total2 = $total2 + $row_cash_invoice_detail->amount2;
													} else {
														$sub_total = $sub_total + $row_cash_invoice_detail->amount;
														$unit_price = $row_cash_invoice_detail->unit_price;
														$amount = $row_cash_invoice_detail->amount;
														$total2 = $total2 + $row_cash_invoice_detail->amount;
													}
													
													$qty		=	number_format($row_cash_invoice_detail->qty,"0",".",",");
													$qty_shp 	=	number_format($row_cash_invoice_detail->qty_shp,0,'.',',');
													
													$item_code	=	$row_cash_invoice_detail->code;
													$uom_code	=	$row_cash_invoice_detail->uom_code;
													$item_name	=	$row_cash_invoice_detail->item_name;
													$unit_price	=	number_format($unit_price,"0",".",",");
													$discount	=	number_format($row_cash_invoice_detail->discount,"0",".",",");
													$amount		=	number_format($amount,"0",".",",");
                                                    $return_ref =   $row_cash_invoice_detail->return_ref;
                                        	?>
	                                            <tr>
	                                                <td class="center"><?= $no ?></td>
	                                                <td class="left strong"><?= $item_code ?></td>
	                                                <td class="left"><?= $item_name ?></td>
	                                                <td class="left"><?= $uom_code ?></td>
	                                                <td class="center"><?= $qty ?></td>
	                                                <td class="right"><?= $unit_price ?></td>
	                                                <td class="right"><?= $discount ?></td>
	                                                <td class="right"><?= $amount ?></td>
	                                                <td class="center"><?= $qty_shp ?></td>
                                                    <td class="left"><?= $return_ref ?></td>
	                                            </tr>

                                            <?php
                                            	}
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-lg-4 col-sm-5"> </div>
                                    <div class="col-lg-4 col-sm-5 ms-auto">
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left"><strong>Subtotal</strong></td>
                                                    <td class="right">$8.497,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Discount (20%)</strong></td>
                                                    <td class="right">$1,699,40</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>VAT (10%)</strong></td>
                                                    <td class="right">$679,76</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Total</strong></td>
                                                    <td class="right"><strong>$7.477,36</strong><br>
                                                        <strong>0.15050000 BTC</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <!--**********************************
            Content body end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
	<script src="../vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="../js/custom.min.js"></script>
	<script src="../js/dlabnav-init.js"></script>
	<script src="../js/demo.js"></script>
    <script src="../js/styleSwitcher.js"></script>
</body>

<!-- Mirrored from travl.dexignlab.com/xhtml/ecom-invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Dec 2021 15:45:41 GMT -->
</html>