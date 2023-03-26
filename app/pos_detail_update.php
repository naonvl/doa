
<!-- Card body -->
<div class="card-body">
    <div class="table-responsive py-4">
        <table id="example3" class="display">
            <thead>
                <tr>
                    <!-- <th>Kode Barang</th> -->
                    <th colspan="2">Nama Barang</th>
                    <th style="width: 7%">Unit</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Discount</th>
                    <th style="width: 7%">Discount (%)</th>
                    <th>Total</th>
                    <th>Hapus</th>
                    <th>No Retur</th>
                </tr>
            </thead>
            <tbody>
            <!-- <tr id="item_ajax">
                
            </tr> -->

            <?php 
                $sql=$select->list_pos_detail($ref);
                $jmldata = $sql->rowCount();
           
                $total_cogs = 0;
                $totalx = 0;
                $total2 = 0;
                $total_qty = 0;
                $no = 0;
                while($row_pos_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
                    
                    $decimal = $selectview->item_decimal($row_pos_detail->item_code);
                    $qty = number_format($row_pos_detail->qty, $decimal, '.', ',');
                    $total_qty = $total_qty + $row_pos_detail->qty;
                    
                    $unit_price = number_format($row_pos_detail->unit_price, 0, '.', ',');
                    $discount_det = number_format($row_pos_detail->discount, 0, '.', ',');
                    $discount3_det = number_format($row_pos_detail->discount3, 2, '.', ',');
                    $amount = number_format($row_pos_detail->amount, 0, '.', ',');
                    
                    $totalx = $totalx + $row_pos_detail->amount;
                    $total2 = number_format($totalx + $freight_cost, 0, '.', ',');
                    
                    $total_cogs = $total_cogs + $row_pos_detail->amount_cost;

                    //return check
                    $sqlrtn=$selectview->list_sales_return_detail($ref, $row_pos_detail->item_code);
                    $rowsrtn=$sqlrtn->rowCount();
                    $font_color="#000000";
                    if($rowsrtn > 0) {
                        $font_color = "red";
                    }
            ?>                              
                <!-- <input type="hidden" id="jmldata" name="jmldata" value="<php echo $jmldata; ?>" > -->
                
                <input type="hidden" id="old_item_code_<?php echo $no ?>" name="old_item_code_<?php echo $no ?>" value="<?php echo $row_pos_detail->item_code; ?>" >
                <input type="hidden" id="old_uom_code_<?php echo $no ?>" name="old_uom_code_<?php echo $no ?>" value="<?php echo $row_pos_detail->uom_code; ?>" >
                <input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_pos_detail->line; ?>" >
                <input type="hidden" id="so_ref_<?php echo $no ?>" name="so_ref_<?php echo $no ?>" value="<?php echo $row_pos_detail->so_ref; ?>" >
            
                <input type="hidden" id="item_code_<?php echo $no ?>" name="item_code_<?php echo $no ?>" value="<?php echo $row_pos_detail->item_code; ?>" >    
                
                <input type="hidden" id="old_qty_<?php echo $no; ?>" name="old_qty_<?php echo $no; ?>" style="text-align: right; width: 70px" class="form-control" value="<?php echo $qty ?>" >

                <tr style="background-color:ffffff;" > 
                    <?php /*
                    <td>                
                        <input type="text" id="item_code2_<?php echo $no ?>" name="item_code2_<?php echo $no ?>" class="form-control" readonly="" style="width: <?php echo $width_item ?>; font-size: <?php echo $font_size ?>; color: #000000; font-weight: bold;" value="<?php echo $row_pos_detail->code; ?>" >          
                        
                    </td>*/ ?>
                    <td colspan="2">                
                        <input type="text" id="item_name_<?php echo $no ?>" name="item_name_<?php echo $no ?>" class="form-control" readonly="" style="min-width: <?php echo $width_item_name ?>; font-size: <?php echo $font_size ?>; color: <?= $font_color; ?>; font-weight: bold;" value="<?php echo $row_pos_detail->item_name; ?>" >
                    </td>
                    <td>
                        <select class="destroy-selector" id="uom_code_<?php echo $no ?>" name="uom_code_<?php echo $no ?>">
                            <?php 
                                select_uom($row_pos_detail->uom_code) 
                            ?>
                        </select>   
                    </td>
                    <td align="center">
                        <input type="text" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" style="text-align: right; width: 70px; color: #000000; " class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" value="<?php echo $qty ?>" >
                    </td>
                    <td align="center">
                        <input type="text" id="unit_price_<?php echo $no; ?>" name="unit_price_<?php echo $no; ?>" style="text-align: right; width: 100px; color: #000000;" class="form-control" onkeyup="formatangka('unit_price_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>')" value="<?php echo $unit_price ?>" >
                    </td>
                    
                    <td align="center" id="discount_det_id<?php echo $no; ?>">
                        <input type="text" id="discount_det_<?php echo $no; ?>" name="discount_det_<?php echo $no; ?>" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka('discount_det_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'nominal')" value="<?php echo $discount_det ?>" >
                    </td>
                    <td align="center" id="discount3_det_id<?php echo $no; ?>">
                        <input type="text" id="discount3_det_<?php echo $no; ?>" name="discount3_det_<?php echo $no; ?>" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka('discount3_det_<?php echo $no; ?>'), detailvalue('<?php echo $no ?>', '<?php echo $jmldata ?>', 'persen')" value="<?php echo $discount3_det ?>" >
                    </td>
                    
                    <td align="center" id="amount_det<?php echo $no; ?>">
                        <input type="text" id="amount_<?php echo $no; ?>" name="amount_<?php echo $no; ?>" style="text-align: right; width: 100px" class="form-control" onkeyup="formatangka('amount_<?php echo $no; ?>')" readonly value="<?php echo $amount ?>" >
                    </td>
                    <td align="center">
                        <input type="checkbox" class="form-check-input" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" value="1">
                    </td>
                    <td>
                        <select class="destroy-selector" id="return_ref_<?= $no ?>" name="return_ref_<?= $no ?>">
                            <option value=""></option>
                            <?php 
                                select_sales_return_si($row_pos_detail->return_ref, $ref); 
                            ?>
                        </select> 
                    </td>
                </tr>
                <?php 
                                            
                    $no++; 

                } 
                    $no__ = $no;
                ?>
                

                <?php for($no=$no__; $no<($no__+5); $no++) { 
                    
                ?>
                    <tr id="item_ajax_<?= $no ?>">
                        <input type="hidden" id="no_<?= $no ?>" name="no_<?= $no ?>" style="font-size: 12px; width: 90px" class="form-control" value="<?= $no ?>" />  
                        

                        <input type="hidden" id="non_discount_<?= $no ?>" name="non_discount_<?= $no ?>" value="<?php echo $non_discount; ?>" />

                        <td align="left" colspan="2">
                            <div style="width: 300px;max-width: 100%;">
                                <select name="item_code_<?= $no ?>" id="item_code_<?= $no ?>" class="destroy-selector" onchange="loadHTMLPost5('../app/pos_detail_ajax2.php','item_ajax_<?php echo $no; ?>','getdata4','item_code_<?= $no ?>',<?php echo $no; ?>,'<?php echo $no; ?>','ref')" >
                                    <option value=""></option>
                                    <?php select_item("") ?>
                                </select>
                            </div>
                        </td>
                        
                        <!-- <td align="left">
                            <input type="text" id="item_name" name="item_name" readonly="" style="font-size: 12px; min-width: 200px" class="form-control" value="<php echo $item_name ?>" >
                        </td> -->
                        
                        <td>
                            <select class="destroy-selector" id="uom_code_<?= $no ?>" name="uom_code_<?= $no ?>" style="height: 35px; width: auto; font-size: 12px">
                                <option value=""></option>
                                <?php 
                                    select_uom($uom_code) 
                                ?>
                            </select>   
                        </td>
                        <td align="center">
                            <input type="text" id="qty_<?= $no ?>" name="qty_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('qty_<?= $no ?>'), detailvalue()" autocomplete="off" value="" >
                        </td>
                        <td align="center">
                            <input type="text" id="unit_price_<?= $no ?>" name="unit_price_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('unit_price_<?= $no ?>'), detailvalue()" autocomplete="off" value="<?php echo $current_price ?>" >
                        </td>
                        
                        <td align="center" id="discount_det_id<?= $no ?>">
                            <input type="text" id="discount_det_<?= $no ?>" name="discount_det_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('discount_det_<?= $no ?>'), detailvalue('nominal')" autocomplete="off" value="" >
                        </td>
                        
                        <td align="center" id="discount3_det_id<?= $no ?>">
                            <input type="text" id="discount3_det_<?= $no ?>" name="discount3_det_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('discount3_det_<?= $no ?>'), detailvalue('persen')" autocomplete="off" value="" >
                        </td>
                        
                        <td align="center" id="amount_det<?= $no ?>">
                            <input type="text" id="amount_<?= $no ?>" name="amount_<?= $no ?>" readonly="" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('amount_<?= $no ?>')" value="" >
                        </td>
                        <td></td>
                        <td>
                            <select class="destroy-selector" id="return_ref_<?= $no ?>" name="return_ref_<?= $no ?>" style="width: 300px; font-size: 12px">
                                <option value=""></option>
                                <?php 
                                    select_sales_return_si('', $ref); 
                                ?>
                            </select>   
                        </td>
                    </tr>
                <?php } ?>

            </tbody>

            <input type="hidden" name="jmldata" id="jmldata" value="<?= $no ?>">

            <tr style="text-align: right; font-weight: bold">
                <td colspan="5">
                    Total Qty
                </td>
                <td id="qty_id">
                    <?= number_format($total_qty, 0, '.', ','); ?>
                </td>
                <td>
                    Sub Total
                </td>
                <td id="subtotal_id">
                    <?= number_format($totalx, 0, '.', ','); ?>
                </td>
            </tr>
            <tr style="text-align: right; font-weight: bold">
                <td colspan="7">
                    Ongkos Kirim
                </td>
                <td id="freight_cost_id">
                    <?= number_format($freight_cost,0,'.',',') ?>
                </td>
            </tr>
            <tr style="text-align: right; font-weight: bold">
                <td colspan="7">
                    Total
                </td>
                <td id="total_id">
                    <input type="text" id="total" name="total" readonly style="text-align: right; font-weight: bold; color: #000000; font-weight: bold;" class="form-control" value="<?= $total2 ?>" >
                </td>
            </tr>
        </table>
    </div>
</div>