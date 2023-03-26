<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getsi":
		$client_code = $_POST["client_code"];	
		
		
?>		
		<select class="form-control" id="si_ref" name="si_ref" onChange="loadHTMLPost2('app/sales_return_ajax2.php','itemdetail','getitemsi','si_ref')" >
        <option value=""></option>
        <?php select_si_return("", $client_code) ?>
    </select>
		
<?php
		break;
		
	default:
}
?>