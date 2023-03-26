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

if ($post == "Save" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($date, 'frmsalary', '', '', ''); //---get no ref
		
	$hs=$insert->insert_salary($ref);
	
	if($hs){
		
		notran($date, 'frmsalary', 1, '', '') ; //----eksekusi ref
	
?>
		<div class="alert alert-success">
			<strong>Save Salary successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(salary) ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Salary Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_salary($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Salary successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Salary Error Update</strong>
		</div>
<?php		

	}
}
 
 
if ($post == "Delete" ){
	
	include 'app/class/class.delete.php'; 
	$delete=new delete;
	
	$hs=$delete->delete_salary($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Salary successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Salary Error Delete</strong>
		</div>
<?php		

	}
}


