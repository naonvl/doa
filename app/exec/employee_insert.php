<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
    $date	=	date('Y-m-d');
    
    $ref=notran($date, 'frmemployee', '', '', ''); //---get no ref
    
	$hs=$insert->insert_employee($ref);
	
	if($hs){
        
        notran($date, 'frmemployee', 1, '', '') ; //----eksekusi ref
        
?>
		<div class="alert alert-success">
			<strong>Save Karyawan successfully</strong>
		</div>
		
		<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix('employee'); ?>" />
		
		<!--<script>
			window.location = 'main.php?menu=app&act=<?php echo obraxabrix(employee) ?>&search=<?php echo $ref ?>';			
		</script>-->
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Karyawan Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_employee($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Karyawan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Karyawan Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_employee($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Karyawan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Karyawan Error Delete</strong>
		</div>
<?php		

	}
}
?>
