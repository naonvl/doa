<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_regular_item();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Setup Reguler Item successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Setup Reguler Item Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_regular_item($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Setup Reguler Item successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Setup Reguler Item Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_regular_item($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Setup Reguler Item successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Setup Reguler Item Error Delete</strong>
		</div>
<?php		

	}
}
?>
