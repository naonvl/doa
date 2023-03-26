<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$hs=$insert->insert_brand();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Master Merk successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Merk Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_brand($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Master Merk successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Merk Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_brand($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Master Merk successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Merk Error Delete</strong>
		</div>
<?php		

	}
}
?>
