<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$pilih = $_POST["button"];

$exp = explode("|",$pilih,7);
$pilih = $exp[0];
$kodex = $exp[1];
//$ref   = $exp[2];

switch ($pilih){
	
	case "getdata3":
		$dbpdo = DB::create();
		
		$no 			= $kodex;
		$kode 			= $_POST['item_code_'.$no.''];	
		//$location_id	= $_POST['location_id'];
		
		$sqlstr = "select code, syscode, uom_code_sales uom_code from item where syscode='$kode' limit 1";
		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 	= $sql->fetch(PDO::FETCH_OBJ); 
		
		$item_code 	= $kode; //$data->syscode;
		$item_code2 = $data->code;
		$uom_code	= $data->uom_code;
		
		/*if($location_id != "") {
			$sqlprice = "select b.current_price, a.name, ifnull(non_discount,0) non_discount from item a left join set_item_price b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' and location_id='$location_id' order by b.date_of_record desc limit 1 "; 
			$sql=$dbpdo->prepare($sqlprice);
			$sql->execute();
			$dataprice 	= $sql->fetch(PDO::FETCH_OBJ);
		} else {*/
			$sqlprice = "select b.current_price, a.name, ifnull(non_discount,0) non_discount from item a left join set_item_price b on a.syscode=b.item_code where a.syscode='$item_code' order by b.date_of_record desc limit 1 "; //and location_id='$location_id' and a.uom_code_sales='$uom_code' 
			$sql=$dbpdo->prepare($sqlprice);
			$sql->execute();
			$dataprice 	= $sql->fetch(PDO::FETCH_OBJ);
		//}
		
		$current_price	= number_format($dataprice->current_price,0,".",",");
		$item_name		= $dataprice->name;
		$non_discount	= $dataprice->non_discount;
		
		$amount			= $dataprice->current_price * 1;
		$amount			= number_format($amount,0,".",",");
		
		if($item_name == "") {
			$sqlprice = "select a.name from item a where a.syscode='$item_code' ";
			$sql=$dbpdo->prepare($sqlprice);
			$sql->execute();
			$dataprice 	= $sql->fetch(PDO::FETCH_OBJ);
			
			$item_name		= $dataprice->name;
		}
		
?>		
			<!-- <input type="hidden" id="item_code" name="item_code" style="font-size: 12px; width: 90px" class="form-control" value="<php echo $item_code ?>" /> -->			
			<input type="hidden" id="non_discount_<?= $no ?>" name="non_discount_<?= $no ?>" value="<?php echo $non_discount; ?>" />
						
			<!-- <td align="left">
				<input type="text" id="item_code2" name="item_code2" style="font-size: 12px; min-width: 150px" class="form-control" readonly value="<php echo $item_code2 ?>" >
			</td> -->
			
			<td align="left">
				<select class="destroy-selector" id="item_code_<?= $no ?>" name="item_code_<?= $no ?>" onchange="loadHTMLPost4('app/pos_detail_ajax2.php','item_ajax_<?php echo $no; ?>','getdata3','item_code_<?= $no ?>',<?php echo $no; ?>,'<?php echo $no; ?>')" style="width: 300px;" >
                    <option value=""></option>
                    <?php select_item($kode) ?>
                </select>
			</td>
			
			<td>
				<select id="uom_code_<?= $no ?>" name="uom_code_<?= $no ?>" style="height: 35px; width: auto; font-size: 12px">
					<option value=""></option>
					<?php 
						select_uom($uom_code) 
					?>
				</select>	
			</td>

			<td align="center">
				<input type="text" id="qty_<?= $no ?>" name="qty_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('qty_<?= $no ?>'), detailvalue(<?= $no ?>, 5, '')" autocomplete="off" value="" >
			</td>
			<td align="center">
				<input type="text" id="unit_price_<?= $no ?>" name="unit_price_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('unit_price_<?= $no ?>'), detailvalue(<?= $no ?>, 5, '')" autocomplete="off" value="<?php echo $current_price ?>" >
			</td>
			
			<td align="center" id="discount_det_id<?= $no ?>">
				<input type="text" id="discount_det_<?= $no ?>" name="discount_det_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('discount_det_<?= $no ?>'), detailvalue(<?= $no ?>, 5, 'nominal')" autocomplete="off" value="" >
			</td>
            
            <td align="center" id="discount3_det_id<?= $no ?>">
    			<input type="text" id="discount3_det_<?= $no ?>" name="discount3_det_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('discount3_det_<?= $no ?>'), detailvalue(<?= $no ?>, 5, 'persen')" autocomplete="off" value="" >
    		</td>
    		
			<td align="center" id="amount_det<?= $no ?>">
				<input type="text" id="amount_<?= $no ?>" name="amount_<?= $no ?>" readonly="" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('amount_<?= $no ?>')" value="<?php echo $amount ?>" >
			</td>
<?php
		
		break;

	case "getdata4":
		$dbpdo = DB::create();
		
		$no 			= $kodex;
		$kode 			= $_POST['item_code_'.$no.''];	
		$ref			= $_POST['ref'];
		
		$sqlstr = "select code, syscode, uom_code_sales uom_code from item where syscode='$kode' limit 1";
		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 	= $sql->fetch(PDO::FETCH_OBJ); 
		
		$item_code 	= $kode; //$data->syscode;
		$item_code2 = $data->code;
		$uom_code	= $data->uom_code;
		
		/*if($location_id != "") {
			$sqlprice = "select b.current_price, a.name, ifnull(non_discount,0) non_discount from item a left join set_item_price b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' and location_id='$location_id' order by b.date_of_record desc limit 1 "; 
			$sql=$dbpdo->prepare($sqlprice);
			$sql->execute();
			$dataprice 	= $sql->fetch(PDO::FETCH_OBJ);
		} else {*/
			$sqlprice = "select b.current_price, a.name, ifnull(non_discount,0) non_discount from item a left join set_item_price b on a.syscode=b.item_code where a.syscode='$item_code' order by b.date_of_record desc limit 1 "; //and location_id='$location_id' and a.uom_code_sales='$uom_code' 
			$sql=$dbpdo->prepare($sqlprice);
			$sql->execute();
			$dataprice 	= $sql->fetch(PDO::FETCH_OBJ);
		//}
		
		$current_price	= number_format($dataprice->current_price,0,".",",");
		$item_name		= $dataprice->name;
		$non_discount	= $dataprice->non_discount;
		
		$amount			= $dataprice->current_price * 1;
		$amount			= number_format($amount,0,".",",");
		
		if($item_name == "") {
			$sqlprice = "select a.name from item a where a.syscode='$item_code' ";
			$sql=$dbpdo->prepare($sqlprice);
			$sql->execute();
			$dataprice 	= $sql->fetch(PDO::FETCH_OBJ);
			
			$item_name		= $dataprice->name;
		}
		
?>		
			<!-- <input type="hidden" id="item_code" name="item_code" style="font-size: 12px; width: 90px" class="form-control" value="<php echo $item_code ?>" /> -->			
			<input type="hidden" id="non_discount_<?= $no ?>" name="non_discount_<?= $no ?>" value="<?php echo $non_discount; ?>" />
						
			<!-- <td align="left">
				<input type="text" id="item_code2" name="item_code2" style="font-size: 12px; min-width: 150px" class="form-control" readonly value="<php echo $item_code2 ?>" >
			</td> -->
			
			<td align="left" colspan="2">
				<select class="form-control" id="item_code_<?= $no ?>" name="item_code_<?= $no ?>" onchange="loadHTMLPost4('../app/pos_detail_ajax2.php','item_ajax_<?php echo $no; ?>','getdata4','item_code_<?= $no ?>',<?php echo $no; ?>,'<?php echo $no; ?>')" >
                    <option value=""></option>
                    <?php select_item($kode) ?>
                </select>
			</td>
			
			<td>
				<select id="uom_code_<?= $no ?>" name="uom_code_<?= $no ?>" class="form-control" style="height: 35px; width: auto; font-size: 12px">
					<option value=""></option>
					<?php 
						select_uom($uom_code) 
					?>
				</select>	
			</td>

			<td align="center">
				<input type="text" id="qty_<?= $no ?>" name="qty_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('qty_<?= $no ?>'), detailvalue(<?= $no ?>, 5, '')" autocomplete="off" value="" >
			</td>
			<td align="center">
				<input type="text" id="unit_price_<?= $no ?>" name="unit_price_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('unit_price_<?= $no ?>'), detailvalue(<?= $no ?>, 5, '')" autocomplete="off" value="<?php echo $current_price ?>" >
			</td>
			
			<td align="center" id="discount_det_id<?= $no ?>">
				<input type="text" id="discount_det_<?= $no ?>" name="discount_det_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('discount_det_<?= $no ?>'), detailvalue(<?= $no ?>, 5, 'nominal')" autocomplete="off" value="" >
			</td>
            
            <td align="center" id="discount3_det_id<?= $no ?>">
    			<input type="text" id="discount3_det_<?= $no ?>" name="discount3_det_<?= $no ?>" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('discount3_det_<?= $no ?>'), detailvalue(<?= $no ?>, 5, 'persen')" autocomplete="off" value="" >
    		</td>
    		
			<td align="center" id="amount_det<?= $no ?>">
				<input type="text" id="amount_<?= $no ?>" name="amount_<?= $no ?>" readonly="" style="text-align: right; font-size: 12px;" class="form-control" onkeyup="formatangka('amount_<?= $no ?>')" value="<?php echo $amount ?>" >
			</td>
			<td></td>
			<td>
                <select class="form-control" id="return_ref_<?= $no ?>" name="return_ref_<?= $no ?>" style="width: 200px; font-size: 12px">
                    <option value=""></option>
                    <?php 
                        select_sales_return_si('', $ref); 
                    ?>
                </select>   
            </td>
<?php
		
		break;


		
	
	default:
}
?>