<?php
include 'app/class/class.insert.php';
include 'app/class/class.insert.journal.php';
include 'app/class/class.update.php';
include 'app/class/class.update.journal.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$insert_journal	=	new insert_journal;
$update_journal	=	new update_journal;

$post = $_POST['submit'];

?>

<?php

if ($post == "Save" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($date, 'frmsales_return', '', '', ''); //---get no ref
		
	$hs=$insert->insert_sales_return($ref);
	
	if($hs){
		
		notran($date, 'frmsales_return', 1, '', '') ; //----eksekusi ref
		//$insert_journal->journal_sales_return($ref); //-------journal
		
?>
		<div class="alert alert-success">
			<strong>Save Retur Penjualan successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('sales_return') ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Retur Penjualan Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" || trim($post) == trim("Add Detail") ){
	
	$hs=$update->update_sales_return($_POST['ref']);
	if($hs){			
	
		//$update_journal->journal_sales_return($_POST['ref']); //-------journal
?>
		<div class="alert alert-success">
			<strong>Update Retur Penjualan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Retur Penjualan Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_sales_return($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Retur Penjualan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Retur Penjualan Error Delete</strong>
		</div>
<?php		

	}
}
?>
