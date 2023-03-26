<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	$ref	=	notran($date, 'frmstock_opname', '', '', ''); //---get no ref
	
	$hs=$insert->insert_stock_opname($ref);
	
	if($hs){
		
		notran($date, 'frmstock_opname', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Stock Opname successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('stock_opname') ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Stock Opname Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_stock_opname($_POST['old_ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Stock Opname successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Stock Opname Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_stock_opname($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Stock Opname successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Stock Opname Error Delete</strong>
		</div>
<?php		

	}
}
?>
