<?php
		$sql=$select->list_measuring_size_sewing_detail($ref);
		$jmldata = $sql->rowCount();
 ?>

<!-- Card body -->
<div class="card-body">
    <div class="table-responsive py-4">
        <table id="example3" class="display">
        	<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea;"> 
				<th style="text-align: center;" colspan="4">Size Chart</th>
			</tr>
            <tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
				<th width="5%"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></th> 
				<th><?php if($lng==1) { echo 'Description'; } else { echo 'Keterangan'; } ?></th>	
				<th><?php if($lng==1) { echo 'Size'; } else { echo 'Size'; } ?></th>
				<th><?php if($lng==1) { echo 'UoM'; } else { echo 'Satuan'; } ?></th>
				<th><?php if($lng==1) { echo 'Delete'; } else { echo 'Hapus'; } ?></th>
			</tr>
        	<tbody>
            	<?php 
						
					$name_desc = "";
					$total_counting = 0;
					$total_countingx = 0;
					$totalx = 0;
					$total2 = 0;
					$no = 0;
					while($row_sewing_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
					
						$qty = number_format($row_sewing_detail->qty, 0, '.', ',');

						if($name_desc == "") {
							$name_desc = "'".$row_sewing_detail->name."'";
						} else {
							$name_desc = $name_desc.",'".$row_sewing_detail->name."'";
						}
						
				?>								
					
					<input type="hidden" id="old_name_<?php echo $no ?>" name="old_name_<?php echo $no ?>" value="<?php echo $row_sewing_detail->name; ?>" >
					<input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_sewing_detail->uom_code; ?>" >
					<input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_sewing_detail->line; ?>" >
				
					<tr style="background-color:ffffff;" id="item_ajax2_<?php echo $no; ?>" > 
						
						<td>				
							<input type="text" id="no_<?php echo $no ?>" name="no_<?php echo $no ?>" class="form-control" readonly="" style="width: 70px" value="<?php echo $no + 1; ?>" >			
							
						</td>
						
						<td>
							<input type="text" id="name_<?php echo $no ?>" name="name_<?php echo $no ?>" class="form-control" value="<?php echo $row_sewing_detail->name; ?>" >		
						</td>

						<td>
							<input type="text" id="size_<?php echo $no ?>" name="size_<?php echo $no ?>" onKeyup="formatangka('size_<?php echo $no ?>')" class="form-control"  value="<?php echo $row_sewing_detail->size; ?>" >		
						</td>
						
						<td>
							<div style="width: 200px">
								<select id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="chosen-select form-control" style="width: auto">
									<option value="">...</option>
			                      	<?php 
			                            select_uom($row_sewing_detail->uom_code) 
			                        ?>	                                                  
			                    </select>
			                </div>
						</td>
						
						<td align="center">
							<input type="checkbox" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" class="form-check-input" value="1" >
						</td>
										
					</tr>
					<?php 
											
						$no++; 
					} 
					
					?>
					
								
					
					<?php 
						//$sqldet_in = $select->get_ms_template_update($name_desc);
						for($no=$jmldata; $no<($jmldata+3); $no++) {
					?>			
						<tr>
							<td>				
								<input type="text" id="no_<?php echo $no ?>" name="no_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $no + 1; ?>" >			
								
							</td>
							
							<td>
								<input type="text" id="name_<?php echo $no ?>" name="name_<?php echo $no ?>" class="form-control" value="<?php echo $data_det_in->name; ?>" >		
							</td>

							<td>
								<input type="text" id="size_<?php echo $no ?>" name="size_<?php echo $no ?>" onKeyup="formatangka('size_<?php echo $no ?>')" class="form-control" autocomplete="off" value="" >		
							</td>
							
							<td>
								<div style="width: 200px">
									<select id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="chosen-select form-control" style="width: auto">
										<option value="">...</option>
				                      	<?php 
				                            select_uom("") 
				                        ?>	                                                  
				                    </select>
				                </div>
							</td>				
						</tr>
					<?php
						
						}
					?>

					<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >

            </tbody>
        </table>
    </div>
</div>


<!-- -------------detail order----------------------- -->
<div class="card-body">
    <div class="table-responsive py-4">
        <table class="table table-bordered table-condensed table-hover table-striped">
        	<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea;"> 
				<th style="text-align: center;" colspan="4">Detail Order</th>
			</tr>
            <tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
				<th style="text-align: center;" ><?php if($lng==1) { echo 'Description'; } else { echo 'Keterangan'; } ?></th>	
				<th style="text-align: center;"><?php if($lng==1) { echo 'Yes/No'; } else { echo 'Ada/Tidak'; } ?></th>
			</tr>
        	<tbody>
            	<tr style="background-color:ffffff;">
						<td>Label</td>
						<td align="center">
							<input type="checkbox" id="label" name="label" class="form-check-input" value="1" <?= $label ?>>		
						</td>		
					</tr>
					<tr style="background-color:ffffff;">
						<td>Plat</td>
						<td align="center">
							<input type="checkbox" id="plat" name="plat" class="form-check-input" value="1" <?= $plat ?>>		
						</td>		
					</tr>
					<tr style="background-color:ffffff;" >
						<td>Button</td>
						<td align="center">
							<input type="checkbox" id="button" name="button" class="form-check-input" value="1" <?= $button ?>>
						</td>		
					</tr>
					<tr style="background-color:ffffff;">
						<td>Detail Pocket</td>
						<td align="center">
							<input type="checkbox" id="pocket" name="pocket" class="form-check-input" value="1" <?= $pocket ?>>		
						</td>		
					</tr>
					<tr style="background-color:ffffff;" id="item_ajax2_<?php echo $no; ?>" >
						<td>Resleting</td>
						<td align="center">
							<input type="checkbox" id="resleting" name="resleting" class="form-check-input" value="1" <?= $resleting ?>>	
						</td>		
					</tr>
            </tbody>
        </table>
    </div>
</div>
