<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$date	=	date("Y-m-d");
	$ref=notran($date, 'frmnew_product', '', '', ''); //---get no ref
	
	$hs=$insert->insert_new_product($ref);
	
	if($hs){
		
		notran($date, 'frmnew_product', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Produk Baru successfully</strong>
		</div>
		
		<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix(new_product); ?>" />
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Produk Baru Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_new_product($_POST['syscode']);
	
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Produk Baru successfully</strong>
		</div>
		
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Produk Baru Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_new_product($_POST['syscode']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Produk Baru successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Produk Baru Error Delete</strong>
		</div>
<?php		

	}
}
?>
