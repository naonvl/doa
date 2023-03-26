<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_weekly_assignment_work();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Setup Weekly Assignment Work successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Setup Weekly Assignment Work Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_weekly_assignment_work($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Setup Weekly Assignment Work successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Setup Weekly Assignment Work Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_weekly_assignment_work($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Setup Weekly Assignment Work successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Setup Weekly Assignment Work Error Delete</strong>
		</div>
<?php		

	}
}
?>
