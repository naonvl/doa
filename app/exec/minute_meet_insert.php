<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';

$insert=new insert;
$update=new update;

$post = $_POST[submit];

if ( $post == "Save Detail" ){
	$post = "Save";
}

if ( $post == "Update Detail" ){
	$post = "Update";	
}

if ($post == "Save Detail" ){
	
	$date	=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($date, 'frmminute_meet', '', '', ''); //---get no ref
		
	$hs=$insert->insert_minute_meet($ref);
		
	if($hs){
		
		notran($date, 'frmminute_meet', 1, '', '') ; //----eksekusi ref
?>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(minute_meet) ?>/<?php echo $ref ?>';
		</script>
				
<?php					
	}else{
?>
		<div class="alert alert-warning">
			<strong>Minutes of Meeting Error Save</strong>
		</div>
<?php		
	}	
}



if ($post == "Save" ){
	
	$dte		=	date('Y-m-d', strtotime($_POST["date"]));
	
	$ref=notran($dte, 'frmminute_meet', '', '', ''); //---get no ref
	
	$hs=$insert->insert_minute_meet($ref);
	
	if($hs){
		
		notran($dte, 'frmminute_meet', 1, '', '') ; //----eksekusi ref
?>

		<div class="alert alert-success">
			<strong>Save Minutes of Meeting successfully</strong>
		</div>
<?php					
	}else{
?>
		<div class="alert alert-warning">
			<strong>Minutes of Meeting Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$ref = $_POST['ref'];
	$hs=$update->update_minute_meet($_POST['ref']);
	
	//$hs=$update_journal->journal_minute_meet($_POST['minute_meetcde']);
		
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Minutes of Meeting successfully</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix(minute_meet) ?>/<?php echo $ref ?>';
		</script>
<?php
	}else{
?>
		<div class="alert alert-warning">
			<strong>Minutes of Meeting Error Update</strong>
		</div>
<?php		

	}
}

if ($post == "Delete" ){
	
	include 'app/class/class.delete.php';
	$delete=new delete;
	
	$hs=$delete->delete_minute_meet($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Minutes of Meeting successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-warning">
			<strong>Minutes of Meeting Error Delete</strong>
		</div>
<?php		

	}
}
?>
