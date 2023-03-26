 <div class="card-header" style="display: flex;flex-direction: column;align-items: flex-start;">
    <h5 class="mb-3">Nama Barang</h5>
    <div style="width: 300px;max-width: 100%;">
        <select id="item_code" name="item_code" class="destroy-selector" onchange="loadHTMLPost3('<?php echo $__folder ?>app/outbound_detail_ajax.php','item_ajax','getdata2','item_code','warehouse_id_from')" >
			<option value=""></option>
			<?php 
				select_item("")
			?>	

		</select>	
    </div>
</div>

<?php
    $sql=$select->list_outbound_detail($ref);
    $jmldata = $sql->rowCount();    
?>
<div class="card-body">
    <div class="table-responsive py-4">
        <table class="table table-flush" id="example">
            <thead class="thead-light">
                <tr>
                    <th><?php if($lng==1) { echo 'Item Code'; } else { echo 'Kode Barang'; } ?></th>
					<th width="40%"><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Barang'; } ?></th> 
					<th>Satuan</th> 									 
					<th><?php if($lng==1) { echo 'Qty'; } else { echo 'Jml Barang'; } ?></th>
                    <th><?php if($lng==1) { echo 'Delete'; } else { echo 'Hapus'; } ?></th>
                </tr>
            </thead>
            <tbody>
                <tr id="item_ajax">
                    
                </tr>
                <?php
                    $totalx = 0;
                    $total2 = 0;
                    $no = 0;
                    
                    //get group item-----------------
                    while($row_outbound_detail=$sql->fetch(PDO::FETCH_OBJ)) {
                ?>

                        <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
            
                        <input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_outbound_detail->item_code; ?>" >
                        <input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_outbound_detail->uom_code; ?>" >
                        <input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_outbound_detail->line; ?>" >
                    
                        <input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_outbound_detail->item_code; ?>" >   
                        
                        
                        <input type="hidden" id="old_qty_<?php echo $no; ?>" name="old_qty_<?php echo $no; ?>" style="text-align: right; width: 70px" class="form-control" value="<?php echo $row_outbound_detail->qty ?>" >

                        <tr style="background-color:ffffff;" id="item_ajax2_<?php echo $no; ?>" > 
                            <td>                
                                <?php echo $row_outbound_detail->item_code2; ?>
                                <input type="hidden" id="item_code2_<?php echo $no ?>" name="item_code2_<?php echo $no ?>" class="form-control" readonly="" style="width: auto; min-width: 150px" value="<?php echo $row_outbound_detail->item_code2; ?>" >
                            </td>
                            <td>                
                                <?php echo $row_outbound_detail->item_name; ?>
                                <input type="hidden" id="item_name_<?php echo $no ?>" name="item_name_<?php echo $no ?>" class="form-control" readonly="" style="width: auto; min-width: 300px" value="<?php echo $row_outbound_detail->item_name; ?>" >
                            </td>
                            <td>
                                <select class="destroy-selector" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" >
                                    <option value=""></option>
                                    <?php select_uom($row_outbound_detail->uom_code); ?>
                                </select>
                            </td>
                            <td align="center">
                                <input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right; font-size:11px; width: 100px" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" autocomplete="off" value="<?php echo number_format($row_outbound_detail->qty,0,'.',',') ?>" >
                            </td>
                            
                            <td align="center">&nbsp;&nbsp;
                                <input type="checkbox" class="form-check-input" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" value="1">
                                
                            </td>
                        </tr>

                <?php
                        $no++; 
                    }
                ?>

            </tbody>
        </table>
    </div>
</div>
