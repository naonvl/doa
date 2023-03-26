<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getitemsi":
		$si_ref		 = $_POST["si_ref"];	
		
		$sql=$select->get_si_detail($si_ref);
		$jmldata = $sql->rowCount();
		
?>		
		
		 <table class="table table-flush">
			<thead>
				<tr> 
					<th>Nama Barang</th> 
					<th>Satuan</th> 
					<th>Qty</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Pilih</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				
					$no = 0;
					while($row_sales_return_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
					
					$qty = number_format($row_sales_return_detail->qty, 0, '.', ',');
					$unit_cost = number_format($row_sales_return_detail->unit_price, 0, '.', ',');
					$amount = number_format($row_sales_return_detail->amount, 0, '.', ',');
					
				?>
					<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
					
					<input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_sales_return_detail->item_code; ?>" >
					<input type="hidden" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" value="<?php echo $row_sales_return_detail->uom_code; ?>" >
					<input type="hidden" id="line_item_si_<?php echo $no ?>" name="line_item_si_<?php echo $no ?>" value="<?php echo $row_sales_return_detail->line_si; ?>" >
										
					<tr style="background-color:ffffff;"> 
						<td>							
							<?php 
								echo $row_sales_return_detail->code . " / " . $row_sales_return_detail->item_name;
							?>	

						</td>
						<td>
							<select id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="form-control" style="height: 35px; width: auto;">
								<option value=""></option>
								<?php 
									select_uom($row_sales_return_detail->uom_code) 
								?>
							</select>	
						</td>
						<td align="center">
							<input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right; width: 70px" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" value="<?php echo $qty ?>" >
						</td>
						<td align="center">
							<input type="text" id="unit_price_<?php echo $no; ?>" name="unit_price_<?php echo $no; ?>" style="text-align: right; width: 110px" class="form-control" onkeyup="formatangka('unit_price_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" value="<?php echo $unit_cost ?>" >
						</td>
						<td align="center" id="amount<?php echo $no; ?>">
							<input type="text" id="amount_<?php echo $no; ?>" name="amount_<?php echo $no; ?>" style="text-align: right; width: 140px" class="form-control" onkeyup="formatangka('amount_<?php echo $no; ?>')" readonly value="<?php echo $amount ?>" >
						</td>
						<td align="center">
							<input type="checkbox" id="select_<?php echo $no; ?>" name="select_<?php echo $no; ?>" class="form-check-input" value="1" >
						</td>
						
					</tr>
					<?php 
						
						$no++; 
					} 
					
					?>
		
<?php
		break;
		
	default:
}
?>