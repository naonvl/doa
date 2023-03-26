<div class="card-body">
    <div class="table-responsive py-4">
        <!-- <table class="table table-flush" id="example"> -->
        <table id="example3" class="display">
            <thead class="thead-light">
                <tr>
                    <!-- <th>Kode Barang</th> -->
                    <th>Nama Barang</th>
                    <th style="width: 7%">Unit</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Discount</th>
                    <th style="width: 7%">Discount (%)</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php for($no=0; $no<5; $no++) { ?>
                    <tr id="item_ajax_<?= $no ?>">
                        <input type="hidden" id="no_<?= $no ?>" name="no_<?= $no ?>" style="font-size: 12px; width: 90px" class="form-control" value="<?= $no ?>" />  
                        <input type="hidden" name="jmldata" id="jmldata" value="<?= $no ?>">

                        <input type="hidden" id="non_discount_<?= $no ?>" name="non_discount_<?= $no ?>" value="<?php echo $non_discount; ?>" />

                        <td align="left">
                            <div style="width: 300px;max-width: 100%;">
                                <select name="item_code_<?= $no ?>" id="item_code_<?= $no ?>" class="destroy-selector" onchange="loadHTMLPost4('../app/pos_detail_ajax2.php','item_ajax_<?php echo $no; ?>','getdata3','item_code_<?= $no ?>',<?php echo $no; ?>,'<?php echo $no; ?>')" >
                                    <option value=""></option>
                                    <?php select_item("") ?>
                                </select>
                            </div>
                        </td>
                        
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
                            <input type="text" id="amount_<?= $no ?>" name="amount_<?= $no ?>" readonly="" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('amount_<?= $no ?>')" value="<?php echo $amount ?>" >
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

            <tr style="text-align: right; font-weight: bold">
                <td colspan="4">
                    Total Qty
                </td>
                <td id="qty_id">
                    
                </td>
                <td>
                    Sub Total
                </td>
                <td id="subtotal_id">
                    
                </td>
            </tr>
            <tr style="text-align: right; font-weight: bold">
                <td colspan="6">
                    Ongkos Kirim
                </td>
                <td id="freight_cost_id">
                    <?= number_format($freight_cost,0,'.',',') ?>
                </td>
            </tr>
            <tr style="text-align: right; font-weight: bold">
                <td colspan="6">
                    Total
                </td>
                <td id="total_id">
                    <input type="text" id="total" name="total" readonly style="text-align: right; font-weight: bold; color: #000000; font-weight: bold;" class="form-control" value="<?= $total2 ?>" >
                </td>
            </tr>
        </table>
    </div>
</div>