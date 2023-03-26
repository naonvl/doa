<?php
	$sql=$select->get_good_receipt_detail($segmen3);
	$jmldata = $sql->rowCount();
?>

<!-- Card body -->
<div class="card-body">
    <div class="table-responsive py-4">
        <table id="example3" class="display">
        	<thead>
				<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
					<th width="5%"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></th> 
					<th width="30%"><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Artikel'; } ?></th>
					<th><?php if($lng==1) { echo 'UoM'; } else { echo 'Satuan'; } ?></th>
					<th><?php if($lng==1) { echo 'Qty Receipt'; } else { echo 'Qty Terima'; } ?></th>
					<th><?php if($lng==1) { echo 'Qty Good'; } else { echo 'Qty Good'; } ?></th>
					<th><?php if($lng==1) { echo 'Qty Damaged'; } else { echo 'Qty Cacat'; } ?></th>
					<th><?php if($lng==1) { echo 'Unit Cost'; } else { echo 'Harga Satuan'; } ?></th>
					<th><?php if($lng==1) { echo 'Amount'; } else { echo 'Jumlah Harga'; } ?></th>
				</tr>
			</thead>

			<tbody>
				<?php 
				
					$totalx = 0;
					$total2 = 0;
					$no = 0;
					while($row_printing_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
						
						$qty = $row_printing_detail->qty; //- $row_printing_detail->qty_press;
						$qty = number_format($qty, 0, '.', ',');
						
						$totalx = $totalx + $row_printing_detail->qty;
						$total2 = number_format($totalx, 0, '.', ',');
																		
				?>								
					
					
					<input type="hidden" id="do_line_<?php echo $no ?>" name="do_line_<?php echo $no ?>" value="<?php echo $row_printing_detail->line; ?>" >
				
					<input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_printing_detail->item_code; ?>" >
					<input type="hidden" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" value="<?php echo $row_printing_detail->uom_code; ?>" >	
					
					<input type="hidden" id="do_ref_<?php echo $no; ?>" name="do_ref_<?php echo $no; ?>" style="text-align: right;" class="form-control" value="<?php echo $row_printing_detail->do_ref ?>" >
					<input type="hidden" id="rcp_ref_<?php echo $no; ?>" name="rcp_ref_<?php echo $no; ?>" style="text-align: right;" class="form-control" value="<?php echo $row_printing_detail->ref ?>" >
					<input type="hidden" id="so_ref_<?php echo $no; ?>" name="so_ref_<?php echo $no; ?>" style="text-align: right;" class="form-control" value="<?php echo $row_printing_detail->so_ref ?>" >
					<input type="hidden" id="do_line_<?php echo $no; ?>" name="do_line_<?php echo $no; ?>" style="text-align: right;" class="form-control" value="<?php echo $row_printing_detail->line ?>" >
					
					<tr style="background-color:ffffff;" id="item_ajax2_<?php echo $no; ?>" > 
						
						<td>				
							<?php echo $no + 1; ?>.
						</td>
						
						<td>				
							<?php echo $row_printing_detail->item_name; ?>
						</td>
						
						<td>				
							<?php echo $row_printing_detail->uom_code; ?>
						</td>
						
						<td align="right">
							<input type="text" id="qty_rcp_<?php echo $no; ?>" name="qty_rcp_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('qty_rcp_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" readonly value="<?= number_format($row_printing_detail->qty,0,'.',',') ?>" >
						</td>
						<td align="right">
							<input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" value="" > <?php //echo $qty ?>
						</td>
						<td align="right">
							<input type="text" id="qty_damaged_<?php echo $no; ?>" name="qty_damaged_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('qty_damaged_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" value="" >
						</td>

						<?php if(allowlvl('frmdo_good_receipt_qc')==1 || $_SESSION['adm']==1) { ?>
							<td align="right">
								<input type="text" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right;" class="form-control" readonly onkeyup="formatangka('unit_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" value="" >
								<?php //number_format($row_printing_detail->unit_cost,0,'.',',') ?>
							</td>
							<td align="right" id="amount_cost<?php echo $no ?>">
								<input type="text" id="amount_cost_<?php echo $no; ?>" name="amount_cost_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('amount_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" readonly autocomplete="off" value="<?= number_format($row_printing_detail->amount_cost,0,'.',',') ?>" >
							</td>	
						<?php } else { ?>
							<td align="right">
								<input type="hidden" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" value="<?php echo $unit_cost ?>" >
							</td>
							<td>
								<input type="hidden" id="amount_cost_<?php echo $no; ?>" name="amount_cost_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('amount_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" autocomplete="off" readonly="" value="" >
							</td>
						<?php } ?>
					</tr>
					<?php 
											
						$no++; 
					} 
					
					?>
					
					<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >

					<tr>
						<td colspan="4" align="right" style="font-size: 14px; font-weight: bold;">Total&nbsp;</td>
						<td id="total1_id">
							<input type="text" id="total1" name="total1" readonly="" style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" onkeyup="formatangka('total1')" value="" >
						</td>		
						<td id="total_qty_damaged_id">
							<input type="text" id="total_qty_damaged" name="total_qty_damaged" readonly="" style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" onkeyup="formatangka('total_qty_damaged')" value="" >
						</td>
						<td>
							
						</td>
						
						<?php if(allowlvl('frmdo_good_receipt_qc')==1 || $_SESSION['adm']==1) { ?>
							<td id="total_id">
								<input type="text" id="total_amount" name="total_amount" readonly="" style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" value="" >
							</td>
						<?php } else { ?>
							<td>
								<input type="hidden" id="total_amount" name="total_amount" readonly="" style="text-align: right; font-size: 14px; font-weight: bold;" class="form-control" value="" >
							</td>
						<?php } ?>	
					</tr>
				</tbody>
        </table>
    </div>
</div>
