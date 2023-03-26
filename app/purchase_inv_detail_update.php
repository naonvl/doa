<div class="card-header" style="display: flex;flex-direction: column;align-items: flex-start;">
    <h5 class="mb-3">Nama Barang</h5>
    <div style="width: 300px;max-width: 100%;">
        <select class="destroy-selector" id="item_code1" name="item_code1" onchange="loadHTMLPost3('../app/purchase_inv_detail_ajax.php','item_ajax','getdata2','item_code1','location_id')" >
            <option value=""></option>
            <?php select_item("") ?>
        </select>
    </div>
</div>

<!-- Card body -->
<div class="card-body">
    <div class="table-responsive py-4">
        <table id="example3" class="display">
            <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th style="width: 7%">Unit</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Discount</th>
                <th style="width: 7%">Discount (%)</th>
                <th>Total</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            <tr id="item_ajax">
                
            </tr>

            <?php 
                $sql=$select->list_purchase_inv_detail($ref);
                $jmldata = $sql->rowCount();
           
                $totalx = 0;
                $total2 = 0;
                $no = 0;
                while($row_purchase_inv_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
                
                    $size = $row_purchase_inv_detail->size;
                    $qty = number_format($row_purchase_inv_detail->qty, 2, '.', ',');
                    $unit_cost = number_format($row_purchase_inv_detail->unit_cost, 2, '.', ',');
                    $discount_det = number_format($row_purchase_inv_detail->discount, 2, '.', ',');
                    $discount3_1_det = number_format($row_purchase_inv_detail->discount1, 2, '.', ',');
                    $discount3_2_det = number_format($row_purchase_inv_detail->discount2, 2, '.', ',');
                    $discount3_3_det = number_format($row_purchase_inv_detail->discount3, 2, '.', ',');
                    $amount = number_format($row_purchase_inv_detail->amount, 2, '.', ',');
                    
                    $totalx = $totalx + $row_purchase_inv_detail->amount;
                    $total2 = number_format($totalx, 2, '.', ',');
                    
            ?>                              
                <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
            
                <input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_purchase_inv_detail->item_code; ?>" >
                <input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_purchase_inv_detail->uom_code; ?>" >
                <input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_purchase_inv_detail->line; ?>" >
            
                <input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_purchase_inv_detail->item_code; ?>" >   

                <tr style="background-color:ffffff;" id="item_ajax2_<?php echo $no; ?>" > 
                    <td>                
                        <input type="text" id="item_code2_<?php echo $no ?>" name="item_code2_<?php echo $no ?>" class="form-control" readonly="" style="width: <?php echo $width_item ?>; font-size: <?php echo $font_size ?>; color: #000000; font-weight: bold;" value="<?php echo $row_purchase_inv_detail->item_code2; ?>" >          
                        
                    </td>
                    <td>                
                        <input type="text" id="item_name_<?php echo $no ?>" name="item_name_<?php echo $no ?>" class="form-control" readonly="" style="min-width: <?php echo $width_item_name ?>; font-size: <?php echo $font_size ?>; color: #000000; font-weight: bold;" value="<?php echo $row_purchase_inv_detail->item_name; ?>" >          
                        
                    </td>
                    <td>
                        <select class="destroy-selector" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>">
                            <?php 
                                select_uom($row_purchase_inv_detail->uom_code) 
                            ?>
                        </select>   
                    </td>
                    <td align="center">
                        <input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right; width: 70px; color: #000000; " class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" value="<?php echo $qty ?>" >
                    </td>
                    <td align="center">
                        <input type="text" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right; width: 100px; color: #000000;" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" value="<?php echo $unit_cost ?>" >
                    </td>
                    
                    <td align="center" id="discount_det_id<?php echo $no; ?>">
                        <input type="text" id="discount_<?php echo $no; ?>" name="discount_<?php echo $no; ?>" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka('discount_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'nominal')" value="<?php echo $discount_det ?>" >
                    </td>
                    <td align="center" id="discount3_det_id<?php echo $no; ?>">
                        <input type="text" id="discount3_<?php echo $no; ?>" name="discount3_<?php echo $no; ?>" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka('discount3_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $discount3_det ?>" >
                    </td>
                    
                    <td align="center" id="amount<?php echo $no; ?>">
                        <input type="text" id="amount_<?php echo $no; ?>" name="amount_<?php echo $no; ?>" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka('amount_<?php echo $no; ?>')" readonly value="<?php echo $amount ?>" >
                    </td>
                    <td align="center">
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