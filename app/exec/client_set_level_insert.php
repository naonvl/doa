<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_client_set_level();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Member Setup Level successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Member Setup Level Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_client_set_level($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Member Setup Level successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Member Setup Level Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_client_set_level($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Member Setup Level successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Member Setup Level Error Delete</strong>
		</div>
<?php		

	}
}
?>
