<?php
include '../app/class/class.insert.php';
include '../app/class/class.update.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_schedule_promo();
	
	if($hs){
		
?>
		<div class="alert alert-success">
			<strong>Save Schedule Promo successfully</strong>
		</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(client_bank) ?>&search=<?php echo $ref ?>';		
			window.location = 'schedule_promo.php?id=<?php echo $ref ?>';	
			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Schedule Promo Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$ref			=	$_POST["ref"];
	$line			=	$_POST["old_line"];
	
	$hs=$update->update_schedule_promo($ref, $line);
	if($hs){			
	
?>
		<div class="alert alert-success">
			<strong>Update Schedule Promo successfully</strong>
			
			<script>
				window.location = 'schedule_promo.php?id=<?php echo $ref ?>&line=<?php echo $line ?>';					
			</script>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Schedule Promo Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$ref = $_POST['ref'];
	$hs=$delete->delete_schedule_promo($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Schedule Promo successfully</strong>
		</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(client_bank) ?>&search=<?php echo $ref ?>';		
			window.location = 'schedule_promo.php?id=<?php echo $ref ?>';	
			
		</script>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Schedule Promo Error Delete</strong>
		</div>
<?php		

	}
}
?>


<?php
	if ($post == "Batal" ){
		$ref	=	$_POST["ref"];
?>
		<script>
			window.location = 'schedule_promo.php?id=<?php echo $ref ?>';	
			
		</script>
<?php
	}
?>		
		