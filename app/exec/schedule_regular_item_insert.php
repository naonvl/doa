<?php
include '../app/class/class.insert.php';
include '../app/class/class.update.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$hs=$insert->insert_schedule_regular_item();
	
	if($hs){
		
?>
		<div class="alert alert-success">
			<strong>Save Schedule Regular Item successfully</strong>
		</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(client_bank) ?>&search=<?php echo $ref ?>';		
			window.location = 'schedule_regular_item.php?id=<?php echo $ref ?>';	
			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Schedule Regular Item Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$ref			=	$_POST["ref"];
	$line			=	$_POST["old_line"];
	
	$hs=$update->update_schedule_regular_item($ref, $line);
	if($hs){			
	
?>
		<div class="alert alert-success">
			<strong>Update Schedule Regular Item successfully</strong>
			
			<script>
				window.location = 'schedule_regular_item.php?id=<?php echo $ref ?>&line=<?php echo $line ?>';					
			</script>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Schedule Regular Item Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$ref = $_POST['ref'];
	$hs=$delete->delete_schedule_regular_item($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Schedule Regular Item successfully</strong>
		</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(client_bank) ?>&search=<?php echo $ref ?>';		
			window.location = 'schedule_regular_item.php?id=<?php echo $ref ?>';	
			
		</script>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Schedule Regular Item Error Delete</strong>
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
			window.location = 'schedule_regular_item.php?id=<?php echo $ref ?>';	
			
		</script>
<?php
	}
?>		
		