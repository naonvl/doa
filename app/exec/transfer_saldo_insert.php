<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_transfer_saldo();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Transfer Saldo successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Transfer Saldo Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_transfer_saldo($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Transfer Saldo successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Transfer Saldo Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_transfer_saldo($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Transfer Saldo successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Transfer Saldo Error Delete</strong>
		</div>
<?php		

	}
}
?>
