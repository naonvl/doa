<?php
    $sql=$select->list_sales_invoice_rs_detail($xndf);
    $jmldata = $sql->rowCount();    
?>

<!-- Card body -->
<div class="card-body">
    <div class="table-responsive py-4">
        <table id="example3" class="display">
            <thead>
            <tr>
                <th><?php if($lng==1) { echo 'Item Code'; } else { echo 'Kode'; } ?></th>
                <th width="40%"><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Artikel'; } ?></th> 
                <th>Satuan</th>                                      
                <th><?php if($lng==1) { echo 'Qty'; } else { echo 'Jml Barang'; } ?></th>   
                <th><?php if($lng==1) { echo 'Select'; } else { echo 'Pilih'; } ?></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $totalx = 0;
                $total2 = 0;
                $no = 0;
                
                //get group item-----------------
                $sqlgroup = $selectview->list_outbound_detail_itemgroup($xndf);
                while($row_outbound_group=$sqlgroup->fetch(PDO::FETCH_OBJ)) {
                    
            ?>              

                <tr>
                    <td colspan="6" style="color: #d50000; font-weight: bold;">
                        
                    <?php echo "KELOMPOK : " . $row_outbound_group->item_group; ?>
                    
                    </td>
                </tr>   

                <?php 
        
                    $sql=$select->list_sales_invoice_rs_detail($xndf, $row_outbound_group->item_group_id);
                    while($row_outbound_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
                        
                        $qty = number_format($row_outbound_detail->qty, 0, '.', ',');
                        
                        $totalx = $totalx + $row_outbound_detail->qty;
                        $total2 = number_format($totalx, 0, '.', ',');
                            
                ?>  

                        <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
                    
                        <input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_outbound_detail->item_code; ?>" >
                        <input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_outbound_detail->uom_code; ?>" >
                        
                        <input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_outbound_detail->item_code; ?>" >
                        
                        <input type="hidden" id="so_ref_<?php echo $no ?>" name="so_ref_<?php echo $no ?>" value="<?php echo $row_outbound_detail->ref; ?>" >   
                        
                        <input type="hidden" id="so_line_<?php echo $no ?>" name="so_line_<?php echo $no ?>" value="<?php echo $row_outbound_detail->line; ?>" >
                        <input type="hidden" id="unit_price_<?php echo $no; ?>" name="unit_price_<?php echo $no; ?>" style="text-align: right; width: 70px" class="form-control" value="<?php echo $row_outbound_detail->unit_price ?>" >
                        <input type="hidden" id="discount_<?php echo $no; ?>" name="discount_<?php echo $no; ?>" style="text-align: right; width: 70px" class="form-control" value="<?php echo $row_outbound_detail->discount ?>" >
                        <input type="hidden" id="old_qty_<?php echo $no; ?>" name="old_qty_<?php echo $no; ?>" style="text-align: right; width: 70px" class="form-control" value="<?php echo $qty ?>" >

                        <tr <?php echo $stypo ?> > 
                            <td>                
                                <?php echo $row_outbound_detail->code; ?>
                            </td>
                            <td>                
                                <?php echo $row_outbound_detail->item_name; ?>
                            </td>
                            <td align="center">
                                <input type="hidden" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="form-control" readonly="" style="width: 50px" value="<?php echo $row_outbound_detail->uom_code; ?>" >
                                <?php echo $row_outbound_detail->uom_code; ?>       
                            </td>
                            <td align="center">
                                <input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right; width:100px " class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $qty ?>" >
                            </td>
                            
                            <td align="center">
                                <input type="checkbox" id="select_<?php echo $no; ?>" name="select_<?php echo $no; ?>" class="ace" value="1" ><span class="lbl"></span>
                            </td>
                            
                            
                        </tr>
                        
                    <?php 
                                            
                        $no++; 
                    } 
                    
                        $grand_total    =   $total2;
                    
                        $uom_code = "pcs";
                    ?>
                    
                    
                <?php
                    }
                ?>

            </tbody>
        </table>
    </div>
</div>