<?php
include '../app/class/class.insert.php';
include '../app/class/class.update.php';
include '../app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST[submit];

if ($post == "Save" ){
	
	$date	=	date('Y-m-d');
	$ref=notran($date, 'frmclient_deposit', '', '', ''); //---get no ref
	
	$hs=$insert->insert_client_deposit($ref);
	
	if($hs){
		
		notran($date, 'frmclient_deposit', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">
			<strong>Save Saldo Agen successfully</strong>
		</div>
		
		<script>
			self.close();
		</script>
		<!--<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix(client_deposit); ?>" />-->
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Saldo Agen Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_client_deposit($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Saldo Agen successfully</strong>
		</div>
		
		<script>
			self.close();
		</script>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Saldo Agen Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_client_deposit($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Saldo Agen successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Saldo Agen Error Delete</strong>
		</div>
<?php		

	}
}
?>
