<div class="card-body">
    <div class="table-responsive py-4">
        <table class="table table-bordered verticle-middle table-responsive-sm">
            <thead class="thead-light">
                <tr>
                    <th><?php if($lng==1) { echo 'Item Code'; } else { echo 'Kode'; } ?></th>
                    <th width="40%"><?php if($lng==1) { echo 'Item Name'; } else { echo 'Nama Artikel'; } ?></th> 
                    <th>No. PO</th>
                    <th>Satuan</th>                        
                    <th><?php if($lng==1) { echo 'Qty'; } else { echo 'Jml PO'; } ?></th>
                    <th><?php if($lng==1) { echo 'Qty Receipt'; } else { echo 'Jml Diterima'; } ?></th>
                    <th><?php if($lng==1) { echo 'Condition'; } else { echo 'Kondisi'; } ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql=$selectview->get_purchase_invoice_detail_outstanding($xndf);
                    $jmldata = $sql->rowCount();
                    
                    $totalx = 0;
                    $total2 = 0;
                    $no = 0;
                    
                    //get group item-----------------
                    $sqlgroup = $selectview->list_purchase_invoice_detail_itemgroup($xndf);
                    while($row_outbound_group=$sqlgroup->fetch(PDO::FETCH_OBJ)) {

                 ?>
                        <tr>
            <td colspan="7" style="color: #d50000; font-weight: bold;">
                
            <?php echo "KELOMPOK : " . $row_outbound_group->item_group; ?>
            
            </td>
        </tr>   
        
        <?php 
            $condition = "Good";
            $sql=$selectview->get_purchase_invoice_detail_outstanding($xndf, $row_outbound_group->item_group_id);
            while($row_outbound_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
                
                $qty_po = number_format($row_outbound_detail->qty_po, 0, '.', ',');
                $qty = number_format($row_outbound_detail->qty, 0, '.', ',');
                
                $totalx = $totalx + $row_outbound_detail->qty;
                $total2 = number_format($totalx, 0, '.', ',');
                    
        ?>                              
                    <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
                    
                    <input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_outbound_detail->item_code; ?>" >
                    <input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_outbound_detail->uom_code; ?>" >
                    
                    <input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_outbound_detail->item_code; ?>" >
                    
                    <input type="hidden" id="pi_line_<?php echo $no ?>" name="pi_line_<?php echo $no ?>" value="<?php echo $row_outbound_detail->line; ?>" >
                    <input type="hidden" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right; width: 70px" class="form-control" value="<?php echo $row_outbound_detail->unit_cost ?>" >
                    <input type="hidden" id="old_qty_<?php echo $no; ?>" name="old_qty_<?php echo $no; ?>" style="text-align: right; width: 70px" class="form-control" value="<?php echo $qty ?>" >
                    
                    
                    
                        <tr> 
                            <td>                
                                <?php echo $row_outbound_detail->code; ?>
                            </td>
                            <td>                
                                <?php echo $row_outbound_detail->item_name; ?>
                            </td>
                            <td>
                                <input type="hidden" id="po_ref_<?php echo $no ?>" name="po_ref_<?php echo $no ?>" value="<?php echo $row_outbound_detail->ref; ?>" >   
                                <?php echo $row_outbound_detail->ref; ?>
                            </td>
                            <td align="center">
                                <input type="hidden" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="form-control" readonly="" style="width: 50px" value="<?php echo $row_outbound_detail->uom_code; ?>" >
                                <?php echo $row_outbound_detail->uom_code; ?>       
                            </td>
                            <td align="center">
                                <input type="text" id="qty_po_<?php echo $no; ?>" name="qty_po_<?php echo $no; ?>" style="text-align: right; width:100px " class="form-control" readonly="" onkeyup="formatangka('qty_po_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $qty_po ?>" >
                            </td>
                            <td align="center">
                                <input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right; width:100px " class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $qty_po ?>" >
                            </td>
                            <td>
                                <select class="destroy-selector" id="status_<?= $no ?>" name="status_<?= $no ?>">
                                    <?php select_condition_goodreceipt($condition) ?>
                                </select>
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