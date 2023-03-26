<?php
include '../app/class/class.insert.php';
include '../app/class/class.update.php';
include '../app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$date	=	date('Y-m-d');
	$ref=notran($date, 'frmclient', '', '', ''); //---get no ref
	
	$syscode	= 	random(25);
	$hs=$insert->insert_client($ref, 'client_pos', $syscode);
	
	if($hs){
		
		//generate_user_member($ref); //generate user dan password
		
		notran($date, 'frmclient', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Customer successfully</strong>
		</div>
		
		<script>
			window.opener.document.location.href="../<?php echo obraxabrix('pos').'/CSO'.$syscode ?>";
			self.close();
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Customer Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_client($_POST['syscode']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Customer successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Customer Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_client($_POST['syscode']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Customer successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Customer Error Delete</strong>
		</div>
<?php		

	}
}
?>
