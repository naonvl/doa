<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$hs=$insert->insert_warehouse();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Gudang successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Gudang Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_warehouse($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Gudang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Gudang Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_warehouse($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Gudang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Gudang Error Delete</strong>
		</div>
<?php		

	}
}
?>
