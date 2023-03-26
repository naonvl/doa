<?php
include_once ("app/include/queryfunctions.php");
include_once ("app/include/functions.php");

include 'app/class/class.insert.php';
include 'app/class/class.update.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
//$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
		
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($date, 'frmdo_good_receipt_qc', '', '', ''); //---get no ref
		
	$hs=$insert->insert_do_good_receipt_qc($ref);
	
	if($hs){
		
		notran($date, 'frmdo_good_receipt_qc', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save QC Penerimaan Barang successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('do_good_receipt_qc') ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>QC Penerimaan Barang Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_do_good_receipt_qc($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update QC Penerimaan Barang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>QC Penerimaan Barang Error Update</strong>
		</div>
<?php		

	}
}
 
 
if ($post == "Delete" ){
	
	include 'app/class/class.delete.php'; 
	$delete=new delete;
	
	$hs=$delete->delete_do_good_receipt_qc($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete QC Penerimaan Barang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>QC Penerimaan Barang Error Delete</strong>
		</div>
<?php		

	}
}


?>
