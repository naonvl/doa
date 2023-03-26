<?php
    $sql=$select->list_sales_return_detail($ref);
    $jmldata = $sql->rowCount();
?>
<!-- Card body -->
<div class="card-body">
    <div class="table-responsive py-4">
        <table id="example3" class="display">
            <thead>
            <tr>
                <th>Nama Barang</th> 
                <th>Satuan</th> 
                <th>Qty</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            <tr id="item_ajax">
                
            </tr>

            <?php 
                $no = 0;
                while($row_sales_return_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
                
                    $qty = number_format($row_sales_return_detail->qty, 0, '.', ',');
                    $unit_price = number_format($row_sales_return_detail->unit_price, 0, '.', ',');
                    $amount = number_format($row_sales_return_detail->amount, 0, '.', ',');
                    
            ?>                              
                    <input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_sales_return_detail->item_code; ?>" >
                    <input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_sales_return_detail->uom_code; ?>" >
                    <input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_sales_return_detail->line; ?>" >
                    <input type="hidden" id="old_qty_<?php echo $no ?>" name="old_qty_<?php echo $no ?>" value="<?php echo $row_sales_return_detail->qty; ?>" >
                
                    <input type="hidden" id="line_item_pi_<?php echo $no ?>" name="line_item_pi_<?php echo $no ?>" value="<?php echo $row_sales_return_detail->line_item_pi; ?>" >
                    <input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_sales_return_detail->item_code; ?>" >
                    <input type="hidden" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" value="<?php echo $row_sales_return_detail->uom_code; ?>" >
                    
                    
                    <tr style="background-color:ffffff;"> 
                        <td>                            
                            <?php 
                                echo $row_sales_return_detail->code . " / " . $row_sales_return_detail->item_name;
                            ?>  

                        </td>
                        <td>
                            <select id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="chosen-select form-control" style="height: 35px; width: auto;">
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
                            <input type="text" id="unit_price_<?php echo $no; ?>" name="unit_price_<?php echo $no; ?>" style="text-align: right; width: 110px" class="form-control" onkeyup="formatangka('unit_price_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" value="<?php echo $unit_price ?>" >
                        </td>
                        <td align="center" id="amount<?php echo $no; ?>">
                            <input type="text" id="amount_<?php echo $no; ?>" name="amount_<?php echo $no; ?>" style="text-align: right; width: 140px" class="form-control" onkeyup="formatangka('amount_<?php echo $no; ?>')" readonly value="<?php echo $amount ?>" >
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