<style>
    form{
        margin: 20px 0;
    }
    form input, button{
        padding: 5px;
    }
    table{
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
</style>
<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo $__folder ?>js/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
        var no = 0;
        $(".add-row").click(function(){
            var name = $("#name").val();
                        
            var name1 = name.split('|');
            var name2 = name1[1].replaceAll('~', ' ');
            var code = name1[2].replaceAll('~', ' ');
            var uom_code1 = name1[3].replaceAll('~', ' ');
            var unit_price1 = name1[4].replaceAll('~', ' ');
            var amount1 = unit_price1;
            
            no++;
            
            //document.setUserData()
            var markup = "<tr><td style='text-align: center'><input type='checkbox' name='record'></td><td>" + code + "</td><td>" + name2 + "</td><td><select id='uom_code' name='uom_code[]'><option value=''></option><?php select_uom('pcs') ?></select></td><td><input type='number' id='qty_"+no+"' name='qty[]' style='text-align: right; width: 100px' onkeyup='detailvalue("+no+", 20)' autocomplete='off' value='1'></td><td><input type='tel' id='unit_price_"+no+"' name='unit_price[]' style='text-align: right; width: 110px' onkeyup='detailvalue("+no+", 20)' autocomplete='off' value='"+ number_format(name1[4],0,'.',',') +"'></td><td><input type='tel' id='discount_"+no+"' name='discount[]' style='text-align: right; width: 90px' onkeyup="+"formatangka('discount_'"+no+"')"+" autocomplete='off' value=''></td><td><input type='tel' id='discount3"+no+"' name='discount3[]' style='text-align: right; width: 80px' onkeyup='formatangka('discount3"+no+"')' autocomplete='off' value=''></td><td id='amount"+no+"'><input type='tel' id='amount_"+no+"' name='amount[]' readonly style='text-align: right; width: 120px' onkeyup='detailvalue("+no+", 20)' autocomplete='off' value='"+ number_format(amount1,0,'.',',') +"'></td><input type='hidden' id='item_code' name='item_code[]' value='"+ name1[0] +"'><input type='hidden' id='no' name='no' value='"+ no +"'></tr>";
           $("table tbody").append(markup);
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
    });    
</script>

<div class="card-body">
    <div class="table-responsive py-4">
        <table class="table table-bordered table-condensed table-hover table-striped">
            <tr>
                <td colspan="4">
                    <select id="name" name="name" class="destroy-selector" style="width: 250px;" >
                        <option value=""></option>
                        <?php 
                            select_item_order_group("")
                        ?>
                    </select>   
                </td>
                <td align="center">
                    <input type="button" class="add-row" value="Tambah">
                </td>
            </tr>
            
            <tr style="color: #0c3803; font-weight: bold;">
                <td style="text-align: center"><button type="button" class="delete-row">Hapus</button></td>
                <td>Kode</td>
                <td>Nama Barang</td>
                <td>Satuan</td>
                <td>Qty</td>
                <td>Harga</td>
                <td>Discount</td>
                <td style="width: 7%">Discount (%)</td>
                <td>Total</td>
            </tr>
            <tr id="amount_total" style="color: #0c3803; font-weight: bold;">
                
            </tr>
        </table>
    </div>
</div>


<?php /*<div class="card-body">
    <div class="table-responsive py-4">
        <div class="card-header" style="display: flex;flex-direction: column;align-items: flex-start;">
            <h5 class="mb-3">Nama Barang</h5>
            <div style="width: 300px;max-width: 100%;">
                <input type="hidden" name="line_cell" id="line_cell" value="0">
                <select class="destroy-selector" id="item_code1" name="item_code1" onchange="loadHTMLPost4('app/pos_detail_ajax.php','item_ajax_0','getdata2','item_code1','location_id', 'line_cell')" >
                    <option value=""></option>
                    <?php select_item("") ?>
                </select>
            </div>
        </div>
        <table class="table table-flush" id="example">
            <thead class="thead-light">
                <tr>
                    <th>Kode Barang</th>
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
                <div id="item_ajax_0">
                </div>
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
                        <input type="text" id="unit_price" name="unit_price" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('unit_price'), detailvalue2()" autocomplete="off" value="<?php echo $current_price ?>" >
                    </td>
                    
                    <td align="center" id="discount_det_id">
                        <input type="text" id="discount_det" name="discount_det" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('discount_det'), detailvalue2('nominal')" autocomplete="off" value="" >
                    </td>
                    
                    <td align="center" id="discount3_det_id">
                        <input type="text" id="discount3_det" name="discount3_det" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('discount3_det'), detailvalue2('persen')" autocomplete="off" value="" >
                    </td>
                    
                    <td align="center" id="amount_det">
                        <input type="text" id="amount" name="amount" readonly="" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('amount')" value="<?php echo $amount ?>" >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
*/ ?>