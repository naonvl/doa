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
			</tr>
        <tbody>
            <?php 						
				$totalx = 0;
				$total2 = 0;
				$no = 0;
				for($no=0; $no<10; $no++) {
																		
			?>	

                <tr style="background-color:ffffff;" > 
                	<td>				
						<input type="text" id="no_<?php echo $no ?>" name="no_<?php echo $no ?>" class="form-control" readonly="" style="width: 70px" value="<?php echo $no + 1; ?>" >
					</td>
					
					<td>
						<input type="text" id="name_<?php echo $no ?>" name="name_<?php echo $no ?>" class="form-control" value="<?php echo $row_counting_detail->name ?>" >		
					</td>

					<td>
						<input type="text" id="size_<?php echo $no ?>" name="size_<?php echo $no ?>" onKeyup="formatangka('size_<?php echo $no ?>')" class="form-control"  value="<?php echo $row_counting_detail->size; ?>" >		
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