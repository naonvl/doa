<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_peserta();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Simpan Peserta sukses</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Simpan Peserta Error</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_peserta($_POST['syscode']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Peserta sukses</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Update Peserta Error</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_peserta($_POST['syscode']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Hapus Peserta sukses</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Hapus Peserta Error</strong>
		</div>
<?php		

	}
}
?>
