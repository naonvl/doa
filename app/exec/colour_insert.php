<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$hs=$insert->insert_colour();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Warna successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Warna Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_colour($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Warna successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Warna Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_colour($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Warna successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Warna Error Delete</strong>
		</div>
<?php		

	}
}
?>
