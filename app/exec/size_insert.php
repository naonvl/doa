<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$hs=$insert->insert_size();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Master Size successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Size Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_size($_POST['old_code']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Master Size successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Size Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_size($_POST['old_code']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Master Size successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Size Error Delete</strong>
		</div>
<?php		

	}
}
?>
