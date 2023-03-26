<?php
    
    $sql=$select->list_set_item_cost_last($location_id, $ref);
    $row_item_cost=$sql->fetch(PDO::FETCH_OBJ);
    
    $location_id_cost   =   $row_item_cost->location_id;
    $date_cost          =   date("d-m-Y", strtotime($row_item_cost->date));
    if($date_cost == "01-01-1970") {
        $date_cost  =   date("d F, Y");
    }
    $efective_from_cost =   date("d-m-Y", strtotime($row_item_cost->efective_from));
    if($efective_from_cost == "01-01-1970") {
        $efective_from_cost =   date("d F, Y");
    }
    $current_cost       =   number_format($row_item_cost->current_cost,0,".",",");
    $point_first_order  =   number_format($row_item_cost->point_first_order,0,".",",");
    $bonus_basic        =   number_format($row_item_cost->bonus_basic,0,".",",");
    $bonus_prestation   =   number_format($row_item_cost->bonus_prestation,0,".",",");
    $bonus_unilevel     =   number_format($row_item_cost->bonus_unilevel,0,".",",");
    $matching_sponsor   =   number_format($row_item_cost->matching_sponsor,0,".",",");
    $reward             =   number_format($row_item_cost->reward,0,".",",");
    $repeat_order       =   number_format($row_item_cost->repeat_order,0,".",",");
    $royalti            =   number_format($row_item_cost->royalti,0,".",",");
    $total_budget       =   number_format($row_item_cost->total_budget,0,".",",");
    
    $fo_point           =   number_format($row_item_cost->fo_point,0,".",",");
    $ro_point           =   number_format($row_item_cost->ro_point,0,".",",");
    $cogs               =   number_format($row_item_cost->cogs,0,".",",");
    $old_date_of_record = date("Y-m-d H:i:s", strtotime($row_item_cost->date_of_record));
    
?>

<!-- Card body -->
<div class="card-body">
    <?php /*<div class="col-12 row">
        <div class="col-md-8">
            <div class="mb-3 row">
                <label class="col-2 col-form-label">Cabang/Lokasi<span class="required"></span></label>
                <div class="col-4">
                    <select class="destroy-selector" id="location_id_cost" name="location_id_cost">
                        <option value=""></option>
                        <?php 
                            combo_select_active("warehouse","id","name","active","1",$location_id_cost) 
                        ?>  
                    </select>
                </div>
            </div>
        </div>
    </div>*/ ?>

    <div class="col-12 row">
        <div class="col-md-8">
            <div class="mb-3 row">
                <label class="col-2 col-form-label">Tanggal Efektif</label>
                <div class="col-4">
                    <input class="datepicker-default form-control" type="text" id="efective_from_cost" name="efective_from_cost" value="<?php echo $efective_from_cost ?>" >
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 row">
        <div class="col-md-8">
            <div class="mb-3 row">
                <label class="col-2 col-form-label">Cost Produk</label>
                <div class="col-4">
                    <input type="text" id="current_cost" name="current_cost" class="form-control" onkeyup="formatangka('current_cost'), formula_value_budget()" style="text-align: right;" value="<?php echo $current_cost ?>">
                </div>
            </div>
        </div>
    </div>
</div>