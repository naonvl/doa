<?php
include 'app/class/class.insert.php';

$insert=new insert;

$post = $_POST['submit'];

if ($post == "Execute Query" ){
	
	$hs=$insert->insert_query_string();
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Execute Query successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Execute Query Error</strong>
		</div>
<?php		
	}	
}


if ($post == "Execute Select" ){
?>
	<div class="alert alert-success">
		<strong>Hasil Query : <font style="font-size: 11px; color: #ff0000"><?php echo $query__ ?></font></strong>
	</div>
<?php	
	$hs=$insert->insert_query_select();
	$no = 1;
	while ($row = $hs->fetch(PDO::FETCH_NUM)) {
		$data = "";
		for($x=0; $x<count($row); $x++) {
			if($data == "") {
				$data = $no. '. ' . $row[$x];
			} else {
				$data = $data . " | " . $row[$x];
			}
		}
		$data = $data . "<br>";
		//$data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "<br>";
        print $data;
        
        $no++;
    } 
	
	/*$result = $hs->fetch(PDO::FETCH_LAZY);
	print_r($result);
	print("\n");*/

	/*$result = $hs->fetchAll();
	print_r($result);
	print("\n");*/
	
	/*$result = $hs->fetch(PDO::FETCH_ASSOC);
	print_r($result);
	print("\n");*/

	/*$result = $hs->fetch(PDO::FETCH_BOTH);
	print_r($result);
	print("\n");*/

	/*$result = $hs->fetchAll(PDO::FETCH_COLUMN);
	var_dump($result);*/

	/*while($data = $hs->fetch(PDO::FETCH_OBJ)) {
		echo $data->code
	}*/
	
	if($hs){
?>
		<div class="alert alert-success">
			<strong>Execute Select successfully</strong>
		</div>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Execute Select Error</strong>
		</div>
<?php		
	}	
}


if ($post == "Upload File" ){
	
	$hs=$insert->insert_upload_file();
	
?>
	<div class="alert alert-success">
		<strong>Upload successfully</strong>
	</div>
<?php		
	
}

?>
