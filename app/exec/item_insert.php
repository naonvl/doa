<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$date	=	date("Y-m-d");
	$ref=notran($date, 'frmitem', '', '', ''); //---get no ref
	
	$hs=$insert->insert_item($ref);
	
	if($hs){
		
		notran($date, 'frmitem', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Item successfully</strong>
		</div>
		
		<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix('item'); ?>" />
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Item Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_item($_POST['syscode']);
	
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Item successfully</strong>
		</div>
		
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Item Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_item($_POST['syscode']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Item successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Item Error Delete</strong>
		</div>
<?php		

	}
}
?>
