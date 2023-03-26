<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($date, 'frmmeasuring_size_sewing', '', '', ''); //---get no ref
		
	$hs=$insert->insert_measuring_size_sewing($ref);
	
	if($hs){
	
		notran($date, 'frmmeasuring_size_sewing', 1, '', '') ; //----eksekusi ref	
?>
		<div class="alert alert-success">
			<strong>Save Measuring Size Sewing successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('measuring_size_sewing') ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Measuring Size Sewing Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_measuring_size_sewing($_POST['ref']);
	if($hs){			
	
?>
		<div class="alert alert-success">
			<strong>Update Measuring Size Sewing successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Measuring Size Sewing Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_measuring_size_sewing($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Measuring Size Sewing successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Measuring Size Sewing Error Delete</strong>
		</div>
<?php		

	}
}
?>
