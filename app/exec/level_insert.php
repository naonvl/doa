<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_level();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Komisi Level successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Komisi Level Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_level($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Komisi Level successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Komisi Level Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_level($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Komisi Level successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Komisi Level Error Delete</strong>
		</div>
<?php		

	}
}
?>
