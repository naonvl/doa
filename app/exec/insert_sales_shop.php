<?php
@session_start();

include 'app/class/class.insert.php';
include 'app/class/class.update.php';

$insert=new insert;
$update=new update;

$post = $_POST[submit];

if ($post == "Order" ){
	
	$ref		= 	$_SESSION["client_code"];
	
	$hs=$insert->insert_sales_shop_detail($ref);
	
	if($hs){
		
?>
		<meta http-equiv="Refresh" content="0;url=<?php echo obraxabrix(sales_shop_order); ?>" />
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Cashier Detail Error Save</strong>
		</div>
<?php		
	}	
}


if ($post == "Checkout" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	$xndf	=	$_SESSION["client_code"];
	
	$ref=notran($date, 'frmcashier', '', '', ''); //---get no ref
		
	$hs=$insert->insert_sales_shop($ref, $xndf);
	
	notran($date, 'frmcashier', 1, '', '') ; //----eksekusi ref
	
	if($hs){
		
		//$insert_journal->journal_cashier($ref); //-------journal
		
?>
		<!--<div class="alert alert-success">
			<strong>Save Cashier successfully</strong>
		</div>-->
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(sales_shop_order) ?>/<?php echo $ref ?>';		
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Cashier Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_cashier($_POST['ref']);
	if($hs){			
	
		$update_journal->journal_cashier($_POST['ref']); //-------journal
?>
		<div class="alert alert-success">
			<strong>Update Cashier successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Cashier Error Update</strong>
		</div>
<?php		

	}
}
 
if ($post == "Delete" ){
	$hs=$delete->delete_cashier($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Cashier successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Cashier Error Delete</strong>
		</div>
<?php		

	}
}
?>
