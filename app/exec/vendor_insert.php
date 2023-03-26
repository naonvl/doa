<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$date	=	date('Y-m-d');
	$ref=notran($date, 'frmvendor', '', '', ''); //---get no ref
	
	$hs=$insert->insert_vendor($ref);
	
	if($hs){
		
		notran($date, 'frmvendor', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Supplier successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('vendor') ?>';			
		</script>
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Supplier Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_vendor($_POST['syscode']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Supplier successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Supplier Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_vendor($_POST['syscode']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Supplier successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Supplier Error Delete</strong>
		</div>
<?php		

	}
}
?>
