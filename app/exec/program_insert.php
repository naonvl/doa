<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_program();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Simpan Jenis Program sukses</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Simpan Jenis Program Error</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_program($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Jenis Program sukses</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Update Jenis Program Error</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_program($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Hapus Jenis Program sukses</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Hapus Jenis Program Error</strong>
		</div>
<?php		

	}
}
?>
