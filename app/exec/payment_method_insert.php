<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$hs=$insert->insert_payment_method();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Jenis Pembayaran successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Pembayaran Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_payment_method($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Jenis Pembayaran successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Pembayaran Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_payment_method($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Jenis Pembayaran successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jenis Pembayaran Error Delete</strong>
		</div>
<?php		

	}
}
?>
