<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$hs=$insert->insert_uom();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Master Satuan successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Satuan Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_uom($_POST['old_code']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Master Satuan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Satuan Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_uom($_POST['old_code']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Master Satuan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Master Satuan Error Delete</strong>
		</div>
<?php		

	}
}
?>
