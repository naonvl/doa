<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
include '../app/class/class.selectview.php';
$select=new select;
$selectview=new selectview;

$dbpdo = DB::create();

$pilih = $_POST["button"];

switch ($pilih){
	
	case "getclient":
		$client_code	= $_POST["client_code"];

		$sql=$select->list_client($client_code);
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$address=$data->address;
?>					
		<input type="text" id="address" name="address" class="form-control" value="<?php echo $address ?>">
<?php
		
		break;
	
	default:
}
?>