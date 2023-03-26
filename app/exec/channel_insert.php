<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$hs=$insert->insert_channel();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Channel successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Channel Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_channel($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Channel successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Channel Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_channel($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Channel successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Channel Error Delete</strong>
		</div>
<?php		

	}
}
?>
