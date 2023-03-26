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
	$ref=notran($date, 'frmitem', '', '', ''); //---get no ref
	
	$hs=$insert->insert_product($ref);
	
	if($hs){
		
		notran($date, 'frmitem', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Product successfully</strong>
		</div>
		
		<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix(product); ?>" />
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Product Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_product($_POST['syscode']);
	
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Product successfully</strong>
		</div>
		
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Product Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_product($_POST['syscode']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Product successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Product Error Delete</strong>
		</div>
<?php		

	}
}
?>
