 <div class="card-header" style="display: flex;flex-direction: column;align-items: flex-start;">
    <h5 class="mb-3">Nama Barang</h5>
    <div style="width: 300px;max-width: 100%;">
        <select class="destroy-selector" id="item_code2" name="item_code2" onchange="loadHTMLPost2('../app/stock_opname_ajax.php','item_ajax','getdata','item_code2')" >
            <option value=""></option>
            <?php select_item("") ?>
        </select>
    </div>
</div>

<div class="card-body">
    <div class="table-responsive py-4">
        <table class="table table-flush" id="example">
            <thead class="thead-light">
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th style="width: 7%">Unit</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th><?php if($lng==1) { echo 'Delete'; } else { echo 'Hapus'; } ?></th>
                </tr>
            </thead>
            <tbody>
                <tr id="item_ajax">
                
                </tr>

                <?php
                    $sql=$select->list_stock_opname_detail($ref);
                    $jmldata = $sql->rowCount();

                    $totalx = 0;
                    $total2 = 0;
                    $no = 0;
                    while($row_stock_opname_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
                    
                        $qty = number_format($row_stock_opname_detail->qty, 0, '.', ',');
                        
                        $totalx = $totalx + $row_stock_opname_detail->qty;
                        $total2 = number_format($totalx, 0, '.', ',');
                        
                        $unit_cost = number_format($row_stock_opname_detail->unit_cost, 0, '.', ',');
                        
                 ?>
                <tr>
                    <input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->item_code; ?>" >
                    <input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->uom_code; ?>" >
                    <input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->line; ?>" >
                
                    <input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_stock_opname_detail->item_code; ?>" >   
                    
                    
                    <input type="hidden" id="old_qty_<?php echo $no; ?>" name="old_qty_<?php echo $no; ?>" class="form-control" value="<?php echo $qty ?>" >
                    
                    <tr style="background-color:ffffff;" id="item_ajax2_<?php echo $no; ?>" > 
                        <td>                
                            <input type="text" id="item_code2_<?php echo $no ?>" name="item_code2_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $row_stock_opname_detail->item_code2; ?>" >
                        </td>
                        <td>                
                            <input type="text" id="item_name_<?php echo $no ?>" name="item_name_<?php echo $no ?>" class="form-control" readonly="" value="<?php echo $row_stock_opname_detail->item_name; ?>" >
                        </td>
                        <td>
                            <input type="text" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>" class="form-control" style="width: 70px" readonly="" value="<?php echo $row_stock_opname_detail->uom_code; ?>" >       
                        </td>
                        <td align="center">
                            <input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $qty ?>" >
                        </td>
                        
                        <td align="center">
                            <input type="text" id="unit_cost_<?php echo $no; ?>" name="unit_cost_<?php echo $no; ?>" style="text-align: right;" class="form-control" onkeyup="formatangka('unit_cost_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $unit_cost ?>" >
                        </td>
                        
                        <td align="center">
                            <input type="checkbox" class="form-check-input" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" value="1">
                        </td>
                        
                    </tr>
                    <?php 
                                                
                        $no++; 
                    } 
                    
                        $grand_total    =   $total2;
                    
                        $uom_code = "pcs";
                    ?>

                    <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
            </tbody>
        </table>
    </div>
</div>