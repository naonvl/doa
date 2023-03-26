<?php
include '../app/class/class.insert.php';
//include '../app/class/class.insert.journal.php';
include '../app/class/class.update.php';
//include '../app/class/class.update.journal.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$ref	=	$_POST["ref"];
	$hs=$insert->insert_weekly_assignment_work_sch($ref);
	
	if($hs){
		
?>
		<div class="alert alert-success">
			<strong>Save Weekly Assignment Work Schedule successfully</strong>
		</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(client_bank) ?>&search=<?php echo $ref ?>';		
			window.location = 'weekly_assignment_work_sch_setup.php?id=<?php echo $ref ?>';	
			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Weekly Assignment Work Schedule Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$ref			=	$_POST["ref"];
	$line			=	$_POST["old_line"];
	
	$hs=$update->update_weekly_assignment_work_sch($ref, $line);
	if($hs){			
	
?>
		<div class="alert alert-success">
			<strong>Update Weekly Assignment Work Schedule successfully</strong>
			
			<script>
				window.location = 'weekly_assignment_work_sch_setup.php?id=<?php echo $ref ?>&line=<?php echo $line ?>';					
			</script>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Weekly Assignment Work Schedule Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$ref = $_POST['ref'];
	$hs=$delete->delete_chamber_facility($_POST['ref'], $line);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Weekly Assignment Work Schedule successfully</strong>
		</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(client_bank) ?>&search=<?php echo $ref ?>';		
			window.location = 'weekly_assignment_work_sch_setup.php?id=<?php echo $ref ?>';	
			
		</script>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Weekly Assignment Work Schedule Error Delete</strong>
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
			window.location = 'weekly_assignment_work_sch_setup.php?id=<?php echo $ref ?>';	
			
		</script>
<?php
	}
?>		
		