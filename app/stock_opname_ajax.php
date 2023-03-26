<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");
include "../app/class/class.selectview.php";

$selectview	=	new selectview;

$dbpdo = DB::create();

$pilih = $_POST["button"];
switch ($pilih){
	case "getdata":
		$kode 	= $_POST['item_code2'];	
		
		$sqlstr = "select syscode, code, uom_code_stock uom_code, name from item where (code=trim('$kode') or old_code=trim('$kode') or syscode=trim('$kode')) limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 	= $sql->fetch(PDO::FETCH_OBJ); 
		
		$item_code 	= $data->syscode;
		$uom_code	= $data->uom_code;
		
		##get harga beli terakhir
		$unit_cost		= 	$selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
		$unit_cost	=	number_format($unit_cost,0,".",",");
		
?>		

		<td>
				          		
      		<input type="hidden" id="item_code" name="item_code" value="<?php echo $data->syscode ?>">
      		
      		<input type="text" class="form-control" id="item_code3" name="item_code3" value="<?php echo $data->code ?>">
      	</td>
      	
      	<td>
      		<input type="text" id="item_name" name="item_name" class="form-control" readonly="" value="<?php echo $data->name ?>">
      	</td>
      	
      	<td>
			<select class="destroy-selector" id="uom_code" name="uom_code">
				<option value=""></option>
				<?php 
					select_uom($data->uom_code) 
				?>
			</select>	
		</td>
		<td align="left">
			<input type="text" id="qty" name="qty" style="text-align: right;" class="form-control" onkeyup="formatangka('qty')" autocomplete="off" value="" >
		</td>
		
		<td align="left">
			<input type="text" id="unit_cost" name="unit_cost" class="form-control" style="text-align: right" onkeyup="formatangka('unit_cost')" value="<?php echo $unit_cost ?>" >
		</td>
		
		
<?php
		
		break;
		
	
	case "getdata_code": //get enter
		$kode 	= $_POST['item_code3'];	
		
		$sqlstr	= "select syscode, code, uom_code_stock uom_code, name from item where (code=trim('$kode') or old_code=trim('$kode') or syscode=trim('$kode')) limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 	= $sql->fetch(PDO::FETCH_OBJ); 
		
		$item_code 	= $data->syscode;
		$uom_code	= $data->uom_code;
		
		##get harga beli terakhir
		$unit_cost		= 	$selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
		$unit_cost		=	number_format($unit_cost,0,".",",");
		
?>		
		<td style="border-right: 1px solid #cccccc;">
			<input type="hidden" id="item_code" name="item_code" value="<?php echo $data->syscode ?>">
			
			<input type="text" id="item_code3" name="item_code3" onchange="loadHTMLPost2('app/stock_opname_ajax.php','item_ajax','getdata_code','item_code3')" onKeyPress="return focusNext('qty',event)" style="width: 168px" value="<?php echo $data->code ?>">
		</td>
		
		<td style="border-right: 1px solid #cccccc;">	
			<input type="text" id="item_name" name="item_name" readonly="" style="width: 350px" value="<?php echo $data->name ?>">
		</td>
		
		<td style="border-right: 1px solid #cccccc;">
			<select id="uom_code" name="uom_code" style="height: 35px; width: auto;">
				<option value=""></option>
				<?php 
					select_uom($data->uom_code) 
				?>
			</select>
		</td>
		
		<td align="left" style="border-right: 1px solid #cccccc;">
			<input type="text" id="qty" name="qty" style="text-align: right;" class="form-control" onkeyup="formatangka('qty')" autocomplete="off" autofocus="" value="" >
		</td>
		
		<td style="border-right: 1px solid #cccccc;">	
			<input type="text" id="unit_cost" name="unit_cost" style="text-align: right" onkeyup="formatangka('unit_cost')" value="<?php echo $unit_cost ?>" >
		</td>
		
		
<?php
		
		break;	
	
	default:
}
?>