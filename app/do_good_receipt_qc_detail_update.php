<?php
	$sql=$select->list_do_good_receipt_qc_detail($ref);
	$jmldata = $sql->rowCount();
?>

<!-- Card body -->
<div class="card-body">
    <div class="table-responsive py-4">
        <table id="example3" class="display">
        	<thead>
				<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
					<th width="5%"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></th> 
					<th><?php if($lng==1) { echo 'DO Receipt No.'; } else { echo 'No. Penerimaan'; } ?></th>
					<th><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Artikel'; } ?></th>
					<th><?php if($lng==1) { echo 'UoM'; } else { echo 'Satuan'; } ?></th>
					<th><?php if($lng==1) { echo 'Qty Good'; } else { echo 'Qty Good'; } ?></th>
					<th><?php if($lng==1) { echo 'Qty Damanged'; } else { echo 'Qty Cacat'; } ?></th>
					<th><?php if($lng==1) { echo 'Unit Cost'; } else { echo 'Harga Satuan'; } ?></th>
					<th><?php if($lng==1) { echo 'Amount'; } else { echo 'Jumlah Harga'; } ?></th>
					<th><?php if($lng==1) { echo 'Delete'; } else { echo 'Hapus'; } ?></th>
				</tr>
			</thead>

			<tbody>
				<?php 
			
					$total_amountx = 0;
					$total_amount = 0;
					$totalx = 0;
					$total2 = 0;
					$total_qty_damaged = 0;
					$no = 0;
					while($row_printing_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
					
						$qty = number_format($row_printing_detail->qty, 0, '.', ',');
						$qty_damaged = number_format($row_printing_detail->qty_damaged, 0, '.', ',');
						$unit_cost = number_format($row_printing_detail->unit_cost,0,'.',',');
						$amount_cost = number_format($row_printing_detail->amount_cost,0,'.',',');
										
						$totalx = $totalx + $row_printing_detail->qty;
						$total2 = number_format($totalx, 0, '.', ',');
						
						$total_qty_damaged = $total_qty_damaged + $row_printing_detail->qty_damaged;
						$total_amountx = $total_amountx + $row_printing_detail->amount_cost;

						$disable_unit_cost = "readonly";
						if($row_do_good_receipt_qc->file_qc != "") {
							$disable_unit_cost = "";
						}
														
				?>								
					
					
					<input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_printing_detail->item_code; ?>" >
					<input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_printing_detail->uom_code; ?>" >
					<input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_printing_detail->line; ?>" >
				
					<input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_printing_detail->item_code; ?>" >	
					<input type="hidden" id="item_name_<?php echo $no ?>" name="item_name_<?php echo $no ?>" value="<?php echo $row_printing_detail->item_name; ?>" >
					<input type="hidden" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" value="<?php echo $row_printing_detail->uom_code; ?>" >
					
					<input type="hidden" id="so_ref_<?php echo $no; ?>" name="so_ref_<?php echo $no; ?>" style="text-align: right;" class="form-control" value="<?php echo $row_printing_detail->so_ref ?>" >
					<input type="hidden" id="rcp_ref_<?php echo $no; ?>" name="rcp_ref_<?php echo $no; ?>" style="text-align: right;" class="form-control" value="<?php echo $row_printing_detail->rcp_ref ?>" >
					<input type="hidden" id="do_line_<?php echo $no; ?>" name="do_line_<?php echo $no; ?>" style="text-align: right;" class="form-control" value="<?php echo $row_printing_detail->do_line ?>" >
					<input type="hidden" id="old_qty_<?php echo $no; ?>" name="old_qty_<?php echo $no; ?>" style="text-align: right;" class="form-control" value="<?php echo $qty ?>" >
					<input type="hidden" id="old_qty_damaged_<?php echo $no; ?>" name="old_qty_damaged_<?php echo $no; ?>" style="text-align: right;" class="form-control" value="<?php echo $qty_damaged ?>" >
					
					<tr style="background-color:ffffff;"> 
						
						<td>				
							<?php echo $no + 1; ?>.			
							
						</td>
						<td>
							<?php if (allowupd('frmdo_good_receipt')==1) { ?>
								<a href="<?php echo $__folder ?><?php echo obraxabrix('do_good_receipt') ?>/<?php echo $row_printing_detail->rcp_ref ?>" target="_blank" class="tooltip-success" data-rel="tooltip" title="Penerimaan SJ Vendor">
									<?php echo $row_printing_detail->rcp_ref; ?>
								</a>
			                <?php } else { ?>
			                	<?php echo $row_printing_detail->rcp_ref; ?>
			                <?php } ?>
						</td>
						<td>				
							<?php echo $row_printing_detail->item_name; ?>
						</td>
						<td>				
							<?php echo $row_printing_detail->uom_code; ?>
						</td>
						
						<td align="right">
							<input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" value="<?php echo $qty ?>" >
						</td>
						<td align="right">
							<input type="text" id="qty_damaged_<?php echo $no; ?>" name="qty_damaged_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('qty_damaged_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" value="<?php echo $qty_damaged ?>" >
						</td>
						<?php if(allowlvl('frmdo_good_receipt_qc')==1 || $_SESSION['adm']==1) { ?>
							<td align="right">
								<input type="text" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" <?= $disable_unit_cost ?> value="<?php echo $unit_cost ?>" >
							</td>
							
							<td id="amount_cost<?php echo $no ?>">
								<input type="tel" id="amount_cost_<?php echo $no; ?>" name="amount_cost_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('amount_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" readonly="" value="<?php echo $amount_cost ?>" >
							</td>
						<?php } else { ?>
							<td align="right">
								<input type="hidden" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" value="<?php echo $unit_cost ?>" >
							</td>
							
							<td>
								<input type="hidden" id="amount_cost_<?php echo $no; ?>" name="amount_cost_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('amount_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" readonly="" value="<?php echo $amount_cost ?>" >
							</td>
						<?php } ?>
						<td align="center">
							<input type="checkbox" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" class="ace" value="1" ><span class="lbl"></span>
							
						</td>

										
					</tr>
					<?php 
											
						$no++; 
					} 

						$total_amountx = number_format($total_amountx,0,'.',',');
					
					?>
					
					<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
					
					<tr>
						<td colspan="4" align="right" style="font-size: 14px; font-weight: bold;">Total&nbsp;</td>
						<td id="total1_id">
							<input type="text" id="total1" name="total1" readonly="" style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" onkeyup="formatangka('total1')" value="<?php echo $total2 ?>" >
						</td>		
						<td id="total_qty_damaged_id">
							<input type="text" id="total_qty_damaged" name="total_qty_damaged" readonly="" style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" onkeyup="formatangka('total_qty_damaged')" value="<?php echo number_format($total_qty_damaged,0,'.',',') ?>" >
						</td>
						<td>
							
						</td>
						
						<?php if(allowlvl('frmdo_good_receipt_qc')==1 || $_SESSION['adm']==1) { ?>
							<td id="total_id">
								<input type="text" id="total_amount" name="total_amount" readonly="" style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" value="<?php echo $total_amountx ?>" >
							</td>
						<?php } else { ?>
							<td>
								<input type="hidden" id="total_amount" name="total_amount" readonly="" style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" value="<?php echo $total_amountx ?>" >
							</td>
						<?php } ?>	
					</tr>
				</tbody>
        </table>
    </div>
</div>
