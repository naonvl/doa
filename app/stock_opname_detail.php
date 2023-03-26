<div class="card-body">
    <div class="table-responsive py-4">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th style="width: 7%">Satuan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 0;
                    $sql=$select->get_item();
                    while($row_item=$sql->fetch(PDO::FETCH_OBJ)){
                ?>
                    <tr>
                        <input type="hidden" id="item_code_<?= $i ?>" name="item_code_<?= $i ?>" value="<?php echo $row_item->syscode ?>" />          
                        <input type="hidden" id="non_discount_<?= $i ?>" name="non_discount_<?= $i ?>" value="0" />

                        <td align="left">
                            <?php echo ($i+1) ?>
                        </td>
                        <td align="left">
                            <?php echo $row_item->old_code ?>
                        </td>
                        
                        <td align="left">
                            <?php echo $row_item->name ?>
                        </td>
                        
                        <td>
                            <select class="destroy-selector" id="uom_code_<?= $i ?>" name="uom_code_<?= $i ?>" style="height: 35px; width: auto; font-size: 12px">
                                <?php 
                                    select_uom($row_item->uom_code_stock) 
                                ?>
                            </select>   
                        </td>
                        <td align="center">
                            <input type="text" id="qty_<?= $i ?>" name="qty_<?= $i ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('qty_<?= $i ?>'), detailvalue2()" autocomplete="off" value="" >
                        </td>
                        <td align="center">
                            <input type="text" id="unit_cost_<?= $i ?>" name="unit_cost_<?= $i ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('unit_cost_<?= $i ?>'), detailvalue2()" autocomplete="off" value="" >
                        </td>
                    </tr>
                <?php 
                        $i++;
                    }
                ?>

                <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $i ?>" /> 
            </tbody>
        </table>
    </div>
</div>