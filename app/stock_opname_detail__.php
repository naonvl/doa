<div class="card-header" style="display: flex;flex-direction: column;align-items: flex-start;">
    <h5 class="mb-3">Nama Barang</h5>
    <div style="width: 300px;max-width: 100%;">
        <select class="destroy-selector" id="item_code2" name="item_code2" onchange="loadHTMLPost2('app/stock_opname_ajax.php','item_ajax','getdata','item_code2')" >
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
                </tr>
            </thead>
            <tbody>
                <tr id="item_ajax">
                    <input type="hidden" id="item_code" name="item_code" style="font-size: 12px; width: 90px" class="form-control" value="<?php echo $item_code ?>" />          
                    <input type="hidden" id="non_discount" name="non_discount" value="<?php echo $non_discount; ?>" />

                    <td align="left">
                        <input type="text" id="item_code2" name="item_code2" style="font-size: 12px; min-width: 150px" class="form-control" readonly value="<?php echo $item_code2 ?>" >
                    </td>
                    
                    <td align="left">
                        <input type="text" id="item_name" name="item_name" readonly="" style="font-size: 12px; min-width: 200px" class="form-control" value="<?php echo $item_name ?>" >
                    </td>
                    
                    <td>
                        <select class="destroy-selector" id="uom_code" name="uom_code" style="height: 35px; width: auto; font-size: 12px">
                            <?php 
                                select_uom($uom_code) 
                            ?>
                        </select>   
                    </td>
                    <td align="center">
                        <input type="text" id="qty" name="qty" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('qty'), detailvalue2()" autocomplete="off" value="1" >
                    </td>
                    <td align="center">
                        <input type="text" id="unit_cost" name="unit_cost" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('unit_cost'), detailvalue2()" autocomplete="off" value="<?php echo $unit_cost ?>" >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>