<?php
include 'app/class/class.insert.php';
//include 'app/class/class.insert.journal.php';
include 'app/class/class.update.php';
//include 'app/class/class.update.journal.php';
//include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
//$delete=new delete;
//$insert_journal	=	new insert_journal;
//$update_journal	=	new update_journal;

$post = $_POST['submit'];

if ($post == "Save Detail" ){
	
	$ref	= $_POST['old_ref'];
	if($ref == "") {
		$ref	= random(15);
	}
	
	$hs=$insert->insert_pos_detail($ref);
	
	$dbpdo = DB::create();
	$item_code2		= $_POST['item_code2'];
	$sqlstr 		= "select syscode, uom_code_sales uom_code from item where (code='$item_code2' or old_code='$item_code2') limit 1";
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ); 
	$rows = $sql->rowCount();
	
	if($rows == 0) {
?>
		<script>
			function xklik() {
				var klik = confirm("Barang tidak ditemukan");
				if (klik==true){
					xklik();
				}
			}
			
			xklik();
			
		</script>
<?php		
	}
	
	if($hs){
		
?>
		<script>
			//window.location = 'main.php?menu=app&act=<?php echo obraxabrix(pos) ?>&xndf=<?php echo $ref ?>'		
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('pos') ?>/<?php echo $ref ?>';	
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Penjualan Detail Error Save</strong>
		</div>
<?php		
	}	
}


if ($post == "Save" ){
	
	$ref_tmp = $_POST['old_ref'];
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	$xndf	=	$_POST['xndf'];
	
	$location_id2 = $_SESSION['location_id2'];
	$id_user = $_SESSION["id_user"];
	
	$ref=notran($date, 'frmpos', '', '', $id_user); //---get no ref
		
	$hs=$insert->insert_pos($ref);
	
	
	if($hs){
		
		notran($date, 'frmpos', 1, '', $id_user) ; //----eksekusi ref
		
		//$insert_journal->journal_pos($ref); //-------journal
		
		$uid	=	$_SESSION["loginname"];
		
?>
		<div class="alert alert-success">
			<strong>Save Penjualan successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('pos') ?>/<?php echo $ref ?>';
			
		</script>
	
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Penjualan Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_pos($_POST['ref']);
	if($hs){			
	
		//$update_journal->journal_pos($_POST['ref']); //-------journal
?>
		<div class="alert alert-success">
			<strong>Update Penjualan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Penjualan Error Update</strong>
		</div>
		
<?php		

	}
}


if ($post == "update_status" ){
	
	$hs=$update->update_pos_update_status();
	if($hs){			
	
?>
		<div class="alert alert-success">
			<strong>Update Status Penjualan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Penjualan Error Update Status</strong>
		</div>
		
<?php		

	}
}

 
if ($post == "Delete" ){
	
	include 'app/class/class.delete.php'; 
	$delete=new delete;
	
	$hs=$delete->delete_pos($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Penjualan successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Penjualan Error Delete</strong>
		</div>
<?php		

	}
}

if ($post == "Save Sales" ){
	
	$ref_tmp = $_POST['old_ref'];
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	$xndf	=	$_POST['xndf'];
	
	$location_id2 = $_SESSION['location_id2'];
	$id_user = $_SESSION["id_user"];
	
	$ref=notran($date, 'frmpos_direct', '', '', ''); //---get no ref
		
	$hs=$insert->insert_pos_direct($ref, $xndf, $ref_tmp);
	
	
	if($hs){
		
		notran($date, 'frmpos_direct', 1, '', '') ; //----eksekusi ref
		
		//$insert_journal->journal_pos($ref); //-------journal
		
		$uid	=	$_SESSION["loginname"];
		
?>
		<div class="alert alert-success">
			<strong>Save Penjualan successfully</strong>
			
			<!--<input type="hidden" id="ref" name="ref" value="<?php echo $ref ?>"/>
			<input type="hidden" id="uidx" name="uidx" value="<?php echo $uid ?>"/>-->
		</div>
		
		<script>
			/*var ref = document.getElementById('ref').value;
			var uid = document.getElementById('uidx').value;*/
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(pos) ?>/<?php echo $ref ?>';
			
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Penjualan Error Save</strong>
		</div>
<?php		
	}	
}

?>
