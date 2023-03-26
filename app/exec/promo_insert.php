<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_promo();
	
	if($hs){
		
?>
		<div class="alert alert-success">
			<strong>Save Setup Promo successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Setup Promo Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_promo($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Setup Promo successfully</strong>
		</div>
		
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Setup Promo Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_promo($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Setup Promo successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Setup Promo Error Delete</strong>
		</div>
<?php		

	}
}
?>
