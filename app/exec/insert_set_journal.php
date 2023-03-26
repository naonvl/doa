<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_set_journal();
	
	if($hs){
?>
		<h4 class="alert_success">Save Setup Journal successfully</h4>
<?php					
	}else{
?>
		<h4 class="alert_error">Setup Journal Error Save</h4>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_set_journal($_POST['id']);
	
	if($hs){			
?>
		<h4 class="alert_success">Update Setup Journal successfully</h4>
<?php
	}else{
?>
		<h4 class="alert_error">Setup Journal Error Update</h4>
<?php		

	}
}

if ($post == "Delete" ){
	
	$id 	= $_POST['id'];
	
	$hs=$delete->delete_set_journal($id);
	if($hs){			
?>
		<h4 class="alert_success">Delete Setup Journal successfully</h4>
<?php
	}else{
?>
		<h4 class="alert_error">Setup Journal Error Delete</h4>
<?php		

	}
}
?>
