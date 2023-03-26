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

<script type="text/javascript">	
		/*if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('purchase_return_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}*/
</script>

<?php

if ($post == "Save" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($date, 'frmpurchase_return', '', '', ''); //---get no ref
		
	$hs=$insert->insert_purchase_return($ref);
	
	if($hs){
		
		notran($date, 'frmpurchase_return', 1, '', '') ; //----eksekusi ref
		//$insert_journal->journal_purchase_return($ref); //-------journal
		
?>
		<div class="alert alert-success">
			<strong>Save Retur Pembelian successfully</strong>
		</div>
		
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(purchase_return) ?>&search=<?php echo $ref ?>';				
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(purchase_return) ?>/<?php echo $ref ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Retur Pembelian Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" || trim($post) == trim("Add Detail") ){
	
	$hs=$update->update_purchase_return($_POST['ref']);
	if($hs){			
	
		//$update_journal->journal_purchase_return($_POST['ref']); //-------journal
?>
		<div class="alert alert-success">
			<strong>Update Retur Pembelian successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Retur Pembelian Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_purchase_return($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Retur Pembelian successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Retur Pembelian Error Delete</strong>
		</div>
<?php		

	}
}
?>
