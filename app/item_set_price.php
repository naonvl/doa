<!-- Card body -->
<div class="card-body">
    <div class="table-responsive py-4">
        <table class="display"> <!-- -->
            <thead>
            <tr>
                <!-- <th>No.</th>
                <th>Cabang</th> -->
                <th>Tanggal Efektif</th>
                <th>Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $efective_from = date("d F, Y"); 
                $no = 0;
                $sql_det=$select->list_warehouse(1);
                $jmldata = $sql_det->rowCount();
                while($row_item_prc=$sql_det->fetch(PDO::FETCH_OBJ)) { 
                    
                    $sqlprc=$select->list_set_item_price_last($row_item_prc->id, $ref);
                    $row_item_price=$sqlprc->fetch(PDO::FETCH_OBJ);
                    
                    $location_id    =   $row_item_prc->id;
                    $date           =   date("d-m-Y", strtotime($row_item_price->date));
                    if($date == "01-01-1970") {
                        $date   =   date("d F, Y");
                    }
                    $efective_from  =   date("d-m-Y", strtotime($row_item_price->efective_from));
                    if($efective_from == "01-01-1970") {
                        $efective_from  =   date("d F, Y");
                    }
                    
                    $current_price  =   number_format($row_item_price->current_price,0,".",",");
                    $current_price1 =   number_format($row_item_price->current_price1,0,".",",");
                    $current_price2 =   number_format($row_item_price->current_price2,0,".",",");
                    $current_price3 =   number_format($row_item_price->current_price3,0,".",",");
                    $tax_rate       =   10;
                    $price_tax      =   number_format($row_item_price->price_tax,0,".",",");
                    $price_member_tax   =   number_format($row_item_price->price_member_tax,0,".",",");
                    $margin_warehouse   =   number_format($row_item_price->margin_warehouse,0,".",",");
                    $margin_mlm         =   number_format($row_item_price->margin_mlm,0,".",",");
                    $registration_rate  =   number_format($row_item_price->registration_rate,0,".",",");
                    $registration_rate_platinum =   number_format($row_item_price->registration_rate_platinum,0,".",",");
                        
                    $old_date_of_record1 = date("Y-m-d H:i:s", strtotime($row_item_price->date_of_record));
                    
            ?>  

                <tr> 
                    <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
                    <input type="hidden" id="location_id_<?php echo $no; ?>" name="location_id_<?php echo $no; ?>" value="<?php echo $location_id; ?>" >
                    <input type="hidden" id="date_<?php echo $no; ?>" name="date_<?php echo $no; ?>" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $date ?>">
                    
                    <?php /*
                    <td align="center"><?php echo $no+1 ?></td>
                    <td>                
                        <?php echo $row_item_prc->name; ?>
                    </td>*/ ?>
                    <td>
                        <input class="datepicker-default form-control" type="text" id="efective_from_<?php echo $no; ?>" name="efective_from_<?php echo $no; ?>" value="<?php echo $efective_from ?>" >
                    </td>
                    <td align="center">
                        <input type="text" id="current_price_<?php echo $no; ?>" name="current_price_<?php echo $no; ?>" style="text-align: right; width:120px " class="form-control" onkeyup="formatangka('current_price_<?php echo $no; ?>')" autocomplete="off" value="<?php echo $current_price ?>" >
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