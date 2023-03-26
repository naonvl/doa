<?php
include_once ("app/include/queryfunctions.php");
include_once ("app/include/functions.php");

include 'app/class/class.insert.php';
include 'app/class/class.update.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
//$delete=new delete;

$post = $_POST[submit];

if ($post == "Save Detail" ){
	
	$ref	= $_POST['old_ref'];
	if($ref == "") {
		$ref	= random(20);
	}
	
	$hs=$insert->insert_sewing_detail($ref);
	
	if($hs){
		
?>
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(cashier) ?>&xndf=<?php echo $ref ?>'	
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(sewing) ?>/<?php echo $ref ?>';		
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Jahit Detail Error Save</strong>
		</div>
<?php		
	}	
}


if ($post == "Save" ){
	
	$ref_tmp = $_POST['old_ref'];
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	$xndf	=	$_POST['xndf'];
	
	$ref=notran($date, 'frmsewing', '', '', ''); //---get no ref
		
	$hs=$insert->insert_sewing($ref, $xndf, $ref_tmp);
	
	if($hs){
		
		notran($date, 'frmsewing', 1, '', '') ; //----eksekusi ref
		/*
		$dataref = $hs->fetch(PDO::FETCH_OBJ);
		$ref = $dataref->ref;*/
?>
		<div class="alert alert-success">
			<strong>Save Jahit successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(sewing) ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Jahit Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_sewing($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Jahit successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jahit Error Update</strong>
		</div>
<?php		

	}
}
 
 
if ($post == "Delete" ){
	
	include 'app/class/class.delete.php'; 
	$delete=new delete;
	
	$hs=$delete->delete_sewing($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Jahit successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jahit Error Delete</strong>
		</div>
<?php		

	}
}



if ($post == "Verification" ){
	$hs=$update->update_sewing_verification($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Verification Jahit successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jahit Error Verification</strong>
		</div>
<?php		

	}
}


if ($post == "Reprinting" ){
	$hs=$update->update_reprinting($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Reprinting successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Error Reprinting</strong>
		</div>
<?php		

	}
}


if ($post == "Jahit Reorder" ){
	
	$ref	= $_POST['ref'];
	$hs=$insert->insert_sales_reorder($ref);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Jahit Reorder successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(sales_reorder) ?>/<?php echo $ref ?>';
		</script>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Error Jahit Reorder</strong>
		</div>
<?php		

	}
}


if ($post == "Update Jahit Reorder" ){
	$hs=$update->update_sales_reorder($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Jahit Reorder successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jahit Reorder Error Update</strong>
		</div>
<?php		

	}
}


 
if ($post == "Delete Jahit Reorder" ){
	
	include 'app/class/class.delete.php'; 
	$delete=new delete;
	
	$hs=$delete->delete_sales_reorder($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Jahit Reorder successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Jahit Reorder Error Delete</strong>
		</div>
<?php		

	}
}


if ($post == "Upload" ){
	
	$ref	=	$_POST["ref"];
	$hs=$update->update_sewing_upload($ref);
	
	if($hs){
		
?>
		<div class="alert alert-success">
			<strong>Upload successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(sewing_list) ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Upload Error</strong>
		</div>
<?php		
	}	
}

if ($post == "Pesan" ){
	
	/*$date	=	date('Y-m-d', strtotime($_POST["date"]));
	$ref=notran($date, 'frmsewing', '', '', ''); //---get no ref*/
		
	$hs=$insert->insert_sewing();
	
	if($hs){
		
		//notran($date, 'frmsewing', 1, '', '') ; //----eksekusi ref
		
?>
		<div class="alert alert-success">
			<strong>Save Order successfully</strong>
		</div>
		
		<script>
			//window.location = '<?php echo $__folder ?><?php echo obraxabrix(sewing) ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Order Error Save</strong>
		</div>
<?php		
	}	
}


if ($post == "Edit" ){
	
	$hs=$update->update_sewing_cutting();
	
	if($hs){
		
?>
		<div class="alert alert-success">
			<strong>Edit successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(capster_order_list) ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Edit Error</strong>
		</div>
<?php		
	}	
}


?>
