<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$hs=$insert->insert_purchase_type();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Jenis Order successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Order Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_purchase_type($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Jenis Order successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Order Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_purchase_type($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Jenis Order successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Order Error Delete</strong>
		</div>
<?php		

	}
}
?>
