<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save Detail" ){
	
	$ref	= $_POST['old_ref'];
	if($ref == "") {
		$ref	= random(25);
	}
	
	$hs=$insert->insert_outbound_detail($ref);
	
	if($hs){
		
?>
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('outbound') ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Pemindahan Barang Detail Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Save" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	$ref_detail	=	$_POST['xndf'];
	
	$ref=notran($date, 'frmoutbound', '', '', ''); //---get no ref
		
	$hs=$insert->insert_outbound($ref, $ref_detail);
	
	notran($date, 'frmoutbound', 1, '', '') ; //----eksekusi ref
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Save Pemindahan Barang successfully</strong>
			
			<script>
				window.location = '<?php echo $__folder ?><?php echo obraxabrix('outbound') ?>/<?php echo $ref ?>';		
			</script>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Pemindahan Barang Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_outbound($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Pemindahan Barang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Pemindahan Barang Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_outbound($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Pemindahan Barang successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Pemindahan Barang Error Delete</strong>
		</div>
<?php		

	}
}
?>
