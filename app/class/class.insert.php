<?php

class insert{

	//------insert user
	function insert_usr($ref,$photo){
		$dbpdo = DB::create();
		
		try {
			
			$usrid		=	$_POST["usrid"];
			$old_usrid	=	$_POST["old_usrid"];				
			$pass_ori	=	$_POST["pwd"];
			$pwd		=	obraxabrix($pass_ori, $usrid);
					
			$adm		=	(empty($_POST["adm"])) ? 0 : $_POST["adm"];
			$employee_id=	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			
			//-----------upload file
		  	$photo2				= $_POST["photo2"];
			$uploaddir_photo 	= 'app/photo_usr/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $usrid . '_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			$act		=	(empty($_POST["act"])) ? 0 : $_POST["act"];
			
			$sqlstr="insert into usr(usrid,pwd,adm,employee_id,photo,act,uid,dlu) values('$usrid','$pwd','$adm','$employee_id','$photo','$act','$uid','$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
			//----------insert user detail
			$usr_jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=1; $i<=$usr_jmldata; $i++) {
				$usr_slc = (empty($_POST['usr_slc_'.$i.''])) ? 0 : $_POST['usr_slc_'.$i.''];
				
				if ($usr_slc==1) { 				
					$usr_frmcde = $_POST['usr_frmcde_'.$i.''];
					$usr_add = (empty($_POST['usr_add_'.$i.''])) ? 0 : $_POST['usr_add_'.$i.''];
					$usr_edt = (empty($_POST['usr_edt_'.$i.''])) ? 0 : $_POST['usr_edt_'.$i.''];
					$usr_dlt = (empty($_POST['usr_dlt_'.$i.''])) ? 0 : $_POST['usr_dlt_'.$i.''];
					$usr_lvl = (empty($_POST['usr_lvl_'.$i.''])) ? 0 : $_POST['usr_lvl_'.$i.''];
									
					$sqlstr="insert into usr_dtl
					(usrid, frmcde, madd, medt, mdel, lvl)
						values
						(
							'".$usrid."',
							'".$usr_frmcde."',
							".$usr_add.",
							".$usr_edt.",
							".$usr_dlt.",
							'".$usr_lvl."'
						)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
			}
			
			//--------insert table user backup
			$pwd = $_POST['pwd'];
			$sqlstr="insert into usr_bup(usrid,pwd) values('$usrid','$pwd')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert company
	function insert_company(){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$businiss_type	=	$_POST["businiss_type"];
			$npwp			=	$_POST["npwp"];
			$address1		=	$_POST["address1"];
			$address2		=	$_POST["address2"];
			$phone1			=	$_POST["phone1"];
			$phone2			=	$_POST["phone2"];
			$fax			=	$_POST["fax"];
			$city			=	$_POST["city"];
			$country		=	$_POST["country"];
			$web			=	$_POST["web"];
			$email			=	$_POST["email"];
			$bank_name		=	$_POST['bank_name'];
			$bank_account	=	$_POST['bank_account'];
			$bank_account_name= $_POST['bank_account_name'];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into company(name, businiss_type, npwp, address1, address2, phone1, phone2, fax, city, country, web, email, bank_name, bank_account, bank_account_name, active, uid, dlu) values('$name', '$businiss_type', '$npwp', '$address1', '$address2', '$phone1', '$phone2', '$fax', '$city', '$country', '$web', '$email', '$bank_name', '$bank_account', '$bank_account_name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}

	
	//-----insert peserta
	function insert_peserta(){
		$dbpdo = DB::create();
		
		try {
			
			$no_peserta		=	$_POST["no_peserta"];
			$no_registrasi	=	$_POST["no_registrasi"];
			$nama			=	petikreplace($_POST["nama"]);
			$tanggal_lahir	=	date("Y-m-d", strtotime($_POST["tanggal_lahir"]));
			$alamat			=	petikreplace($_POST["alamat"]);
			$no_hp			=	$_POST["no_hp"];
			$no_ktp			=	$_POST["no_ktp"];
			$aktif			=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$syscode		=	random(25);
			
			$sqlstr="insert into peserta (no_peserta, no_registrasi, nama, tanggal_lahir, alamat, no_hp, no_ktp, aktif, uid, dlu, syscode) values ('$no_peserta', '$no_registrasi', '$nama', '$tanggal_lahir', '$alamat', '$no_hp', '$no_ktp', '$aktif', '$uid', '$dlu', '$syscode')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			//program jaminan
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];			
			for ($i=0; $i<=$jmldata; $i++) {
				$program_id =	$_POST[program_id_.$i];
				$select		=	(empty($_POST[select_.$i])) ? 0 : $_POST[select_.$i];
				
				if ($select == 1) {
					
					$line = maxline('peserta_program', 'line', 'peserta_kode', $syscode, '');
					
					$sqlstr="insert into peserta_program (peserta_kode, program_id, line) values('$syscode', '$program_id', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
			}
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert program
	function insert_program(){
		$dbpdo = DB::create();
		
		try {
			
			$nama			=	petikreplace($_POST["nama"]);
			$aktif			=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into program (nama, aktif, uid, dlu) values ('$nama', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//get last ID
			$sqlstr="select last_insert_id() id";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data 	= $sql->fetch(PDO::FETCH_OBJ);
			$ref 	= $data->id;
			
			
			#insert/update set item price
			$item_code		=	$ref;
			$uom_code		=	"pcs";
			$current_price	=	numberreplace($_POST['current_price']);
			$date			=	date("Y-m-d", strtotime($_POST['date']));
			$efective_from	=	date("Y-m-d", strtotime($_POST['efective_from']));
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id	=	1; 
			$qty1			=	1; 
			$old_date_of_record1		=	date("Y-m-d", strtotime($_POST['old_date_of_record1']));
			
			$sqlstr = "select item_code, current_price from set_item_price where date_of_record='$date_of_record' and item_code='$item_code' and uom_code='$uom_code' and current_price='$current_price'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			//$data = $sql->fetch(PDO::FETCH_OBJ);
			//$last_price = $data->current_price;
			
			$sqlstr = "select current_price from set_item_price where item_code='$item_code' and uom_code='$uom_code' order by date_of_record desc limit 1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$last_price = $data->current_price;
			
			if($rows == 0) {
				$sqlstr = "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, last_price, date_of_record, location_id, qty1, uid, dlu) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$last_price', '$date_of_record', '$location_id', '$qty1', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
			} else {
				$sqlstr = "update set_item_price set efective_from='$efective_from', uom_code='$uom_code', current_price='$current_price', last_price='$last_price', date_of_record='$date_of_record', location_id='$location_id', qty1='$qty1', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code' and date_of_record='$old_date_of_record1'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
			}
					
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert coa
	function insert_coa(){
		$dbpdo = DB::create();
		
		try {
			
			$acc_code			=	$_POST["acc_code"];
			$name				=	$_POST["name"];
			$acc_type			=	(empty($_POST["acc_type"])) ? 0 : $_POST["acc_type"];
			$postable			=	(empty($_POST["postable"])) ? 0 : $_POST["postable"];
			$subacc_code		=	$_POST["subacc_code"];
			$opening_balance	=	(empty($_POST["opening_balance"])) ? 0 : $_POST["opening_balance"];
			$opening_balance_date	= date("Y-m-d", strtotime($_POST["opening_balance_date"]));
			$current_balance	=	$opening_balance; //(empty($_POST["current_balance"])) ? 0 : $_POST["current_balance"];
			
			$currency_code		=	(empty($_POST["currency_code"])) ? 0 : $_POST["currency_code"];
			$currency_rate		=	(empty($_POST["currency_rate"])) ? 0 : $_POST["currency_rate"];
			$currency_exchange_id		=	(empty($_POST["currency_exchange_id"])) ? 0 : $_POST["currency_exchange_id"];
			$level			=	(empty($_POST["level"])) ? 0 : $_POST["level"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$syscode		= 	random(20);
		
			$sqlstr="insert into coa (acc_code, name, acc_type, postable, subacc_code, opening_balance, opening_balance_date, current_balance, currency_code, currency_rate, currency_exchange_id, level, active, uid, dlu, syscode) values('$acc_code', '$name', '$acc_type', '$postable', '$subacc_code', '$opening_balance', '$opening_balance_date', '$current_balance', '$currency_code', '$currency_rate', '$currency_exchange_id', '$level', '$active', '$uid', '$dlu', '$syscode')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert client
	function insert_client($code='', $source='', $syscode1=''){
		$dbpdo = DB::create();
		
		try {
			
			//$code			=	petikreplace($_POST["code"]);
	        $title          =   $_POST["title"];
			$name			=	petikreplace($_POST["name"]);
	        $last_name      =   petikreplace($_POST["last_name"]);
			$contact_person	=	petikreplace($_POST["contact_person"]);
	        $contact_person1=	petikreplace($_POST["contact_person1"]);
	        $contact_person2=	petikreplace($_POST["contact_person2"]);
	        $contact_person3=	petikreplace($_POST["contact_person3"]);
			$client_type	=	(empty($_POST["client_type"])) ? 0 : $_POST["client_type"];
			$address		=	petikreplace($_POST["address"]);
			$ship_to		=	petikreplace($_POST["ship_to"]);
			$bill_to		=	petikreplace($_POST["bill_to"]);
			$zip_code		=	$_POST["zip_code"];
			$country_id		=	(empty($_POST["country_id"])) ? 0 : $_POST["country_id"];
			$state_id		=	(empty($_POST["state_id"])) ? 0 : $_POST["state_id"];
			$kabupaten		=	petikreplace($_POST["kabupaten"]);
			$kecamatan		=	petikreplace($_POST["kecamatan"]);
			$phone			=	$_POST["phone"];
	        $phone1			=	$_POST["phone1"];
			$fax			=	$_POST["fax"];
			$email			=	$_POST["email"];
			$web			=	$_POST["web"];		
			$bank_name    	=	$_POST["bank_name"];
	        $bank_branch    =   $_POST["bank_branch"];
	        $bank_account	=	$_POST["bank_account"];
	        $bank_account_no=   $_POST["bank_account_no"];
	        $amount			=	numberreplace($_POST["amount"]);
			$location_id	=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$stockist		=	(empty($_POST["stockist"])) ? 0 : $_POST["stockist"];
			$client_syscode	=	$_POST["client_syscode"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");

			if($source == 'client_pos') {
				$syscode		= 	$syscode1;
			} else {
				$syscode		= 	random(25);
			}
						
			$sqlstr="insert into client (code, title, name, last_name, contact_person, contact_person1, contact_person2, contact_person3, client_type, address, ship_to, bill_to, zip_code, country_id, state_id, kabupaten, kecamatan, phone, phone1, fax, email, web, bank_name, bank_branch, bank_account, bank_account_no, amount, location_id, stockist, active, client_syscode, bagi_komisi, uid, dlu, syscode) values ('$code', '$title', '$name', '$last_name', '$contact_person', '$contact_person1', '$contact_person2', '$contact_person3', '$client_type', '$address', '$ship_to', '$bill_to', '$zip_code', '$country_id', '$state_id', '$kabupaten', '$kecamatan', '$phone', '$phone1', '$fax', '$email', '$web', '$bank_name', '$bank_branch', '$bank_account', '$bank_account_no', '$amount', '$location_id', '$stockist', '$active', '$client_syscode', 1, '$uid', '$dlu', '$syscode')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
	
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert item
	function insert_item($code){		
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
			$old_code		=	$_POST["old_code"];
			$name			=	petikreplace($_POST["name"]);
			$item_group_id	=	(empty($_POST["item_group_id"])) ? 0 : $_POST["item_group_id"];
			$item_subgroup_id	=	(empty($_POST["item_subgroup_id"])) ? 0 : $_POST["item_subgroup_id"];
			$item_type_code		=	$_POST["item_type_code"];
			$item_category_id	=	(empty($_POST["item_category_id"])) ? 0 : $_POST["item_category_id"];
			$brand_id			=	(empty($_POST["brand_id"])) ? 0 : $_POST["brand_id"];
			$size_id			= 	$_POST["size_id"];  //	(empty($_POST["size_id"])) ? 0 : $_POST["size_id"];
			$uom_code_stock		=	$_POST["uom_code_stock"];
			$uom_code_sales		=	$uom_code_stock; //$_POST["uom_code_sales"];			
			$uom_code_purchase	=	$uom_code_sales; //$_POST["uom_code_purchase"];
			$minimum_stock		=	numberreplace((empty($_POST["minimum_stock"])) ? 0 : $_POST["minimum_stock"]);
			$maximum_stock		=	numberreplace((empty($_POST["maximum_stock"])) ? 0 : $_POST["maximum_stock"]);
			
			$consigned		=	(empty($_POST["consigned"])) ? 0 : $_POST["consigned"];
			$balance		=	numberreplace($_POST["balance"]);
			$description	=	petikreplace($_POST["description"]);
			
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$syscode		= 	random(25);
			
			//-----------upload file
		  	$photo2				= $_POST["photo2"];
			$uploaddir_photo 	= 'app/photo_item/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $syscode . '_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			$sqlstr="insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, balance, description, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$balance', '$description', '$active', '$uid', '$dlu', '$syscode')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*---------insert audit trail (insert)------------*/
			/*$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$active', '$uid', '$dlu', '$syscode', 'insert' )";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();*/
			
			
			##execute otomatis number
			$sqlstr="select a.code from item_group a where a.id='$item_group_id'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			
			notran($date, 'frmitembarcode', 1, '', $data->code);
			
			
			#insert/update set item cost
			$item_code	=	$syscode;
			$uom_code	=	$uom_code_purchase;
			$date_cost			=	date("Y-m-d", strtotime($_POST['date_cost']));
			$efective_from_cost	=	date("Y-m-d", strtotime($_POST['efective_from_cost']));
			
			$point_first_order	=	numberreplace($_POST["point_first_order"]);
			$current_cost		=	numberreplace($_POST['current_cost']);
			$bonus_basic		=	numberreplace($_POST["bonus_basic"]);
			$bonus_prestation	=	numberreplace($_POST["bonus_prestation"]);
			$bonus_unilevel		=	numberreplace($_POST["bonus_unilevel"]);
			$matching_sponsor	=	numberreplace($_POST["matching_sponsor"]);
			$reward				=	numberreplace($_POST["reward"]);
			$repeat_order		=	numberreplace($_POST["repeat_order"]);
			$royalti			=	numberreplace($_POST["royalti"]);
			$total_budget		=	numberreplace($_POST["total_budget"]);
			
			$fo_point			=	numberreplace($_POST["fo_point"]);
			$ro_point			=	numberreplace($_POST["ro_point"]);
			$cogs				=	numberreplace($_POST["cogs"]);
			
			if($date_cost == "1970-01-01") {
				$date_cost = date("Y-m-d");
			}
			
			if($efective_from_cost == "1970-01-01") {
				$efective_from_cost = date("Y-m-d");
			}
			
			
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id_cost	=	0; //$_POST['location_id_cost'];
			$last_cost = 0;
			/*$sqlstr = "select item_code, current_cost from set_item_cost where item_code='$item_code' and uom_code='$uom_code' and current_cost='$current_cost'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			
			
			if($rows == 0) {*/
			
			$sqlstr = "insert into set_item_cost (date, efective_from, item_code, uom_code, current_cost, point_first_order, bonus_basic, bonus_prestation, bonus_unilevel, matching_sponsor, reward, repeat_order, royalti, total_budget, last_cost, fo_point, ro_point, cogs, date_of_record, location_id, uid, dlu) values('$date_cost', '$efective_from_cost', '$item_code', '$uom_code', '$current_cost', '$point_first_order', '$bonus_basic', '$bonus_prestation', '$bonus_unilevel', '$matching_sponsor', '$reward', '$repeat_order', '$royalti', '$total_budget', '$last_cost', '$fo_point', '$ro_point', '$cogs', '$date_of_record', '$location_id_cost', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*} else {
				$sqlstr = "update set_item_cost set efective_from='$efective_from_cost', uom_code='$uom_code', current_cost='$current_cost', last_cost='$last_cost', date_of_record='$date_of_record', location_id='$location_id_cost', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}*/
			
			
			#insert/update set item price
			$jmldata = $_POST["jmldata"];
			for($x=0; $x<$jmldata; $x++) {
				$item_code	=	$syscode;
				$uom_code	=	$uom_code_sales;
				$current_price	=	numberreplace($_POST['current_price_'.$x.'']);
				$current_price1	=	numberreplace($_POST['current_price1']);
				$current_price2	=	numberreplace($_POST['current_price2']);
				$current_price3	=	numberreplace($_POST['current_price3']);
				
				$tax_rate			=	numberreplace($_POST["tax_rate"]);
				$price_tax			=	numberreplace($_POST["price_tax"]);
				$price_member_tax	=	numberreplace($_POST["price_member_tax"]);
				$margin_warehouse	=	numberreplace($_POST["margin_warehouse"]);
				$margin_mlm			=	numberreplace($_POST["margin_mlm"]);
				$registration_rate	=	numberreplace($_POST["registration_rate"]);
				$registration_rate_platinum =	numberreplace($_POST["registration_rate_platinum"]);
				
				$date			=	date("Y-m-d", strtotime($_POST['date']));
				if($date == "1970-01-01") {
					$date = date("Y-m-d");
				}
				$efective_from	=	date("Y-m-d", strtotime($_POST['efective_from_'.$x.'']));
				if($efective_from == "1970-01-01") {
					$efective_from = date("Y-m-d");
				}
				$date_of_record	=	date("Y-m-d H:i:s");
				$location_id	=	$_POST['location_id_'.$x.''];
				$non_discount	=	numberreplace($_POST['non_discount']);
				$qty1			=	numberreplace($_POST['qty1']);
				$qty2			=	numberreplace($_POST['qty2']);
				$qty3			=	numberreplace($_POST['qty3']);
				$qty4			=	numberreplace($_POST['qty4']);
				$last_price 	= 	0;
				/*$sqlstr = "select item_code, current_price from set_item_price where item_code='$item_code' and uom_code='$uom_code' and current_price='$current_price'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows = $sql->rowCount();
				$data = $sql->fetch(PDO::FETCH_OBJ);
				
				
				if($rows == 0) {*/
					$sqlstr = "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, tax_rate, price_tax, price_member_tax, margin_warehouse, margin_mlm, registration_rate, registration_rate_platinum, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$tax_rate', '$price_tax', '$price_member_tax', '$margin_warehouse', '$margin_mlm', '$registration_rate', '$registration_rate_platinum', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//audit trail insert
					/*$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'insert')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();*/
					
				/*} else {
					$sqlstr = "update set_item_price set efective_from='$efective_from', uom_code='$uom_code', current_price='$current_price', current_price1='$current_price1', current_price2='$current_price2', current_price3='$current_price3', last_price='$last_price', date_of_record='$date_of_record', location_id='$location_id', non_discount='$non_discount', qty1='$qty1', qty2='$qty2', qty3='$qty3', qty4='$qty4', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//update audit trail
					$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'update')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}*/
			}
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert item group
	function insert_item_group(){	
		$dbpdo = DB::create();
		
		try {
				
			$code					=	$_POST["code"];
			$name					=	$_POST["name"];
			$costing_type			=	$_POST["costing_type"];
			$nonstock				=	(empty($_POST["nonstock"])) ? 0 : $_POST["nonstock"];
			$location_id 	=	0;
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into item_group (code, name, nonstock, costing_type, inventory_acccode, purchase_discount_acccode, goodintransit_acccode, workinprocess_acccode, cogs_acccode, consignment_acccode, location_id, active, uid, dlu) values('$code', '$name', '$nonstock', '$costing_type', '$inventory_acccode', '$purchase_discount_acccode', '$goodintransit_acccode', '$workinprocess_acccode', '$cogs_acccode', '$consignment_acccode', '$location_id', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//-------get last ID
			$sqlid 		= "select last_insert_id() lastid";
			$resultid=$dbpdo->prepare($sqlid);
			$resultid->execute();
			$dataid		= $resultid->fetch(PDO::FETCH_OBJ);
					
			$lastid		= $dataid->lastid;	
			//-------------------/\
			
			
			/*---------insert audit trail (insert)------------*/
			/*$sqlstr="insert into adt_item_group (id, code, name, nonstock, costing_type, inventory_acccode, purchase_discount_acccode, goodintransit_acccode, workinprocess_acccode, cogs_acccode, consignment_acccode, location_id, active, uid, dlu, adt_status) values('$lastid', '$code', '$name', '$nonstock', '$costing_type', '$inventory_acccode', '$purchase_discount_acccode', '$goodintransit_acccode', '$workinprocess_acccode', '$cogs_acccode', '$consignment_acccode', '$location_id', '$active', '$uid', '$dlu', 'insert')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();*/
			
			
			//----------insert detail
			/*$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$inventory_acccode		=	$_POST[inventory_acccode_.$i];
				$purchase_discount_acccode	=	$_POST[purchase_discount_acccode_.$i];
				$goodintransit_acccode	=	$_POST[goodintransit_acccode_.$i];
				$workinprocess_acccode	=	$_POST[workinprocess_acccode_.$i];
				$cogs_acccode			=	$_POST[cogs_acccode_.$i];
				$consignment_acccode	=	$_POST[consignment_acccode_.$i];
				$location_id	=	(empty($_POST[location_id_.$i])) ? 0 : $_POST[location_id_.$i];
				
				
				if ( !empty($location_id) || ($location_id <> 0) ) {
					
					$syscode2	= 	random(9);
									
					$line = maxline('item_group_detail', 'line', 'id_header', $syscode, '');
					
					$sqlstr="insert into item_group_detail (id_header, inventory_acccode, purchase_discount_acccode, goodintransit_acccode, workinprocess_acccode, cogs_acccode, consignment_acccode, location_id, line) values ('$lastid', '$inventory_acccode', '$purchase_discount_acccode', '$goodintransit_acccode', '$workinprocess_acccode', '$cogs_acccode', '$consignment_acccode', '$location_id', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();							
					
				}
			}*/
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
	
		return $sql;
	}
	
	
	//-----insert client_set_level
	function insert_client_set_level(){	
		$dbpdo = DB::create();
		
		try {
				
			$qualified				=	(empty($_POST["qualified"])) ? 0 : $_POST["qualified"];
			$group_completed		=	(empty($_POST["group_completed"])) ? 0 : $_POST["group_completed"];
			$platinum				=	(empty($_POST["platinum"])) ? 0 : $_POST["platinum"];
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into client_set_level (qualified, group_completed, platinum, uid, dlu) values('$qualified', '$group_completed', '$platinum', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
	
		return $sql;
	}
	
	
	//-----insert level
	function insert_level(){	
		$dbpdo = DB::create();
		
		try {
				
			$level					=	(empty($_POST["level"])) ? 0 : $_POST["level"];
			$indicator_member		=	(empty($_POST["indicator_member"])) ? 0 : $_POST["indicator_member"];
			$indicator				=	numberreplace($_POST["indicator"]);
			$registration			=	numberreplace($_POST["registration"]);
			$starter_kit			=	numberreplace($_POST["starter_kit"]);
			$prestasi				=	numberreplace($_POST["prestasi"]);
			$unilevel				=	numberreplace($_POST["unilevel"]);
			$sponsor				=	numberreplace($_POST["sponsor"]);
			$bonus					=	numberreplace($_POST["bonus"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into level (level, indicator_member, indicator, registration, starter_kit, prestasi, unilevel, sponsor, bonus, uid, dlu) values('$level', '$indicator_member', '$indicator', '$registration', '$starter_kit', '$prestasi', '$unilevel', '$sponsor', '$bonus', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
	
		return $sql;
	}
	
	
	
	//-----insert warehouse
	function insert_warehouse(){
		$dbpdo = DB::create();
		
		try {
					
			$code			=	$_POST["code"];
			$name			=	$_POST["name"];
			$address		=	$_POST["address"];
			$email			=	$_POST["email"];
			$phone			=	$_POST["phone"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into warehouse (code, name, address, email, phone, active, uid, dlu) values('$code', '$name', '$address', '$email', '$phone', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	
	//-----insert product
	function insert_product($code){		
		$dbpdo = DB::create();
		
		try {
			
			//$code			=	$_POST["code"];
			$old_code		=	$_POST["old_code"];
			$name			=	petikreplace($_POST["name"]);
			$item_group_id	=	(empty($_POST["item_group_id"])) ? 0 : $_POST["item_group_id"];
			$item_subgroup_id	=	(empty($_POST["item_subgroup_id"])) ? 0 : $_POST["item_subgroup_id"];
			$item_type_code		=	$_POST["item_type_code"];
			$item_category_id	=	(empty($_POST["item_category_id"])) ? 0 : $_POST["item_category_id"];
			$brand_id			=	(empty($_POST["brand_id"])) ? 0 : $_POST["brand_id"];
			$size_id			= 	$_POST["size_id"];  //	(empty($_POST["size_id"])) ? 0 : $_POST["size_id"];
			$uom_code_sales		=	$_POST["uom_code_sales"];
			$uom_code_stock		=	$uom_code_sales; //$_POST["uom_code_stock"];
			$uom_code_purchase	=	$uom_code_sales; //$_POST["uom_code_purchase"];
			$minimum_stock		=	numberreplace((empty($_POST["minimum_stock"])) ? 0 : $_POST["minimum_stock"]);
			$maximum_stock		=	numberreplace((empty($_POST["maximum_stock"])) ? 0 : $_POST["maximum_stock"]);
			
			$consigned		=	(empty($_POST["consigned"])) ? 0 : $_POST["consigned"];
			$balance		=	numberreplace($_POST["balance"]);
			
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$syscode		= 	random(25);
			
			//-----------upload file
		  	$photo2				= $_POST["photo2"];
			$uploaddir_photo 	= 'app/photo_item/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $syscode . '_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			$sqlstr="insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, balance, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$balance', '$active', '$uid', '$dlu', '$syscode')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*---------insert audit trail (insert)------------*/
			$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$active', '$uid', '$dlu', '$syscode', 'insert' )";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			##execute otomatis number
			$sqlstr="select a.code from item_group a where a.id='$item_group_id'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			
			notran($date, 'frmitembarcode', 1, '', $data->code);
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert client deposit
	function insert_client_deposit($ref){
		$dbpdo = DB::create();
		
		try {
			
			date_default_timezone_set('Asia/Jakarta');
			
			$date          	=   date("Y-m-d", strtotime($_POST["date"]));
			$client_code	=	$_POST["client_code"];
			$current_balance=	numberreplace($_POST["total_balance"]);
			$opening_balance=	numberreplace($_POST["opening_balance"]);
			$receipt_type	=	$_POST["receipt_type"];
			$bank_id    	=	$_POST["bank_id"];
			$receipt_status	=	$_POST["receipt_status"];			
	        $memo		    =   petikreplace($_POST["memo"]);
	        
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into client_deposit (ref, date, client_code, opening_balance, current_balance, receipt_type, bank_id, receipt_status, memo, uid, dlu) values ('$ref', '$date', '$client_code', '$opening_balance', '$current_balance', '$receipt_type', '$bank_id', '$receipt_status', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr="update client set amount='$current_balance', updated='$dlu' where syscode='$client_code'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//update saldo
			/*$sqlstr="select sum(opening_balance) current_balance from client_deposit where client_code='$client_code'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$current_balance = $data->current_balance;
			
			$sqlstr="update client_deposit set current_balance='$current_balance' where client_code='$client_code'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();*/
				
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----------client saldo
	function get_client_saldo($client_code='') {
		$dbpdo = DB::create();
		
		$sqlstr="select current_balance, opening_balance from client_deposit a where a.client_code = '$client_code' order by a.dlu desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----insert transfer saldo
	function insert_transfer_saldo(){
		$dbpdo = DB::create();
		
		try {
					
			$client_code	=	$_POST["client_code"];
			$saldo			=	numberreplace($_POST["saldo"]);
			$transfer		=	numberreplace($_POST["transfer"]);
			$client_code1	=	$_POST["client_code1"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into transfer_saldo (client_code, saldo, transfer, client_code1, uid, dlu) values('$client_code', '$saldo', '$transfer', '$client_code1', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//update deposit
			$date 				= date("Y-m-d");
			$opening_balance	= $transfer;
			$current_balance	= $saldo - $transfer;
			$receipt_type		= "Transfer";
			$bank_id			= 0;
			$memo				= "Transaksi Transfer Saldo";
			
			//berkurang
			$ref = notran($date, 'frmclient_deposit', '', '', ''); //---get no ref
			
			$sqlstr="insert into client_deposit (ref, date, client_code, opening_balance, current_balance, receipt_type, bank_id, receipt_status, memo, uid, dlu) values ('$ref', '$date', '$client_code', '$opening_balance', '$current_balance', '$receipt_type', '$bank_id', '$receipt_status', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr="update client set amount='$current_balance' where syscode='$client_code'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			notran($date, 'frmclient_deposit', 1, '', '') ; //----eksekusi ref
			
			//bertambah
			if($client_code1 != "") {
				$ref = notran($date, 'frmclient_deposit', '', '', ''); //---get no ref
				
				$sql = $this->get_client_saldo($client_code1);
				$data_blc = $sql->fetch(PDO::FETCH_OBJ);
				$opening_balance = $data_blc->opening_balance;
				$current_balance = $data_blc->current_balance + $transfer;
				
				$sqlstr="insert into client_deposit (ref, date, client_code, opening_balance, current_balance, receipt_type, bank_id, receipt_status, memo, uid, dlu) values ('$ref', '$date', '$client_code1', '$opening_balance', '$current_balance', '$receipt_type', '$bank_id', '$receipt_status', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr="update client set amount='$current_balance' where syscode='$client_code1'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				notran($date, 'frmclient_deposit', 1, '', '') ; //----eksekusi ref
			}
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert sales shop detail tmp
	function insert_sales_shop_detail($ref){	
		
		$dbpdo = DB::create();
		
		try {
		
			$location_id	= $_POST['location_id'];		
			$item_code		= $_POST['item_code']; //$segmen3;
			$uom_code 		= $_POST['uom_code'];
			$non_discount 	= (empty($_POST['non_discount'])) ? 0 : $_POST['non_discount'];
	        $client_code	= $_SESSION["client_code"]; //$_POST["client_code"];
	        $qty 		    = numberreplace($_POST['qty']);
	        $unit_price     = numberreplace($_POST['unit_price']);
	        $amount 	    = $qty * $unit_price;
	        
	        $cash			= 0;
	        
	        //----------jika lookup gagal enter
	        $sqlstr 	= "select syscode, uom_code_sales uom_code from item where syscode='$item_code' limit 1";
	        $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data 	= $sql->fetch(PDO::FETCH_OBJ); 
			
			if($item_code == '') {
				$item_code 	= $data->syscode;	
			}
			
			if($uom_code == '') {
				$uom_code	= $data->uom_code;	
			}
				
			if ( !empty($item_code) && !empty($uom_code) ) {		
			
				$total	 	= numberreplace($_POST['total']);
				$uid		= $_SESSION["loginname"];
				
				$line = maxline('sales_invoice_tmp', 'line', 'ref', $ref, '');
				
				$sqlstr="insert into sales_invoice_tmp (ref, client_code, cash, item_code, uom_code, qty, discount, unit_price, amount, discount2, discount3, deposit, total, non_discount, uid, line) values ('$ref', '$client_code', '$cash', '$item_code', '$uom_code', '$qty', '$discount', '$unit_price', '$amount', '$discount2', '$discount3', '$deposit', '$total', '$non_discount', '$uid', $line)";
	            $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();							
			}	
				
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert sales_shop
	function insert_sales_shop($ref, $xndf){	
		
		$dbpdo = DB::create();
		
		try {
		
			$status			= 	"R";
			$date			=	date("Y-m-d");
			$location_id	=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			$bayar			=   $_POST["bayar"];
			if($bayar == "transfer") {
				$cash		=	0;
			}
			if($bayar == "saldo") {
				$cash		=	1;
			}
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			$sub_total = 0;
			for ($i=1; $i<=$jmldata; $i++) {
				$item_code 		= $_POST[item_code.$i];
				$uom_code 		= $_POST[uom_code.$i];
							
				if ( !empty($item_code) && !empty($uom_code) ) {
										
					$qty = numberreplace($_POST[qty.$i]);
					$unit_price = numberreplace($_POST[unit_price.$i]);
					$amount = $qty * $unit_price;
					
					$line = maxline('sales_invoice_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into sales_invoice_detail (ref, item_code, uom_code, qty, discount, discount3, unit_price, amount, non_discount, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$discount3', '$unit_price', '$amount', '$non_discount', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();								
					
					//----------insert bincard (debit qty)
					$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'cashier', '', '$item_code', '$uom_code', '$unit_price', 0, '$qty', '$amount', '$line', '$uid', '$dlu')";				
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();	
					
					$sub_total = $sub_total + $amount;
					
					
				}
			}
			
			
				
			$client_code		=	$_SESSION["client_code"]; //$_POST["client_code"];				
			$employee_id		= 	0;						
			$top				=	"C.O.D";
			$due_date			=	date("Y-m-d");
			$tax_code			=	"";
			$tax_rate			=	0;
			$freight_cost 		= 	0;
			$freight_account	= 	"";
			$currency_code		=	"";
			$rate				=	0;
			$memo				= 	$_POST["memo"];
			$discount2			=	numberreplace($_POST["discount"]);
			$total				=	$sub_total; //numberreplace($_POST["total"]); //$sub_total; 
			$deposit			=	0;		
			$deposit_date		=	date("Y-m-d", strtotime($_POST["deposit_date"]));
			$total_member		=	numberreplace($_POST["total"]);
			
			$photo_file			= 	""; 
			
			$cash_amount		=	numberreplace($_POST["cash_amount"]);
			$bank_id			=	(empty($_POST["bank_id"])) ? 0 : $_POST["bank_id"];
			$bank_amount		=	numberreplace($_POST["bank_amount"]);
			$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
			$card_amount		=	numberreplace($_POST["card_amount"]);
			$credit_card_no		=	$_POST["credit_card_no"];
			$credit_card_holder	=	petikreplace($_POST["credit_card_holder"]);
			$change_amount		=	numberreplace($_POST["change_amount"]);
			
			$sqlstr = "delete from sales_invoice_tmp where ref='$xndf'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
			$sqlstr="insert into sales_invoice (ref, ref2, date, status, top, due_date, client_code, ship_to, bill_to, tax_code, tax_rate, freight_cost, freight_account, currency_code, rate, employee_id, discount, total, memo, opening_balance, cash, location_id, deposit, taxable, photo_file, cash_amount, bank_id, bank_amount, credit_card_code, card_amount, credit_card_no, credit_card_holder, change_amount, uid, dlu) values('$ref', '$ref2', '$date', '$status', '$top', '$due_date', '$client_code', '$ship_to', '$bill_to', '$tax_code', '$tax_rate', '$freight_cost', '$freight_account', '$currency_code', '$rate', '$employee_id', '$discount2', '$total', '$memo', 0, '$cash', '$location_id', '$deposit', '$taxable', '$photo_file', '$cash_amount', '$bank_id', '$bank_amount', '$credit_card_code', '$card_amount', '$credit_card_no', '$credit_card_holder', '$change_amount', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
            ##jika piutang
            if($cash == 0) {
				
				//$total = $total - $deposit;
				//insert AR
				$sqlstr="insert into ar(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'C', '$client_code', '', '$total', 0, 'cashier', 'cashier', '$currency_code', '$rate', '', '', '$top', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
            //-----------
            
			if($bank_amount > 0 || $cash == 0) {
				
				$sqlbnk = "select name, account_code, account_coa from bank where id='$bank_id' ";
				$result=$dbpdo->prepare($sqlbnk);
				$result->execute();
				$data		= $result->fetch(PDO::FETCH_OBJ);
				
				$cheque_no		= $data->account_code;
				$bank_name		= $data->name;
				$receipt_type	= "transfer";
				$cheque_date	= $date;
				$total			= $sub_total; //$bank_amount;
				$account_code	= $data->account_coa;
				
				//insert ARC
				$sqlstr="insert into arc (ref, date, client_code, cheque_no, bank_name, cheque_date, amount, currency_code, rate, account_code, type, memo, uid, dlu) values('$ref', '$date', '$client_code', '$cheque_no', '$bank_name', '$cheque_date', '$total', '$currency_code', '$rate', '$account_code', '$receipt_type', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();									
				
			}
			
			if( $cash == 1) {
				//update deposit
				$opening_balance	= 0;
				$saldo				= numberreplace($_POST["saldo"]);
				$current_balance	= $saldo - $total;
				$receipt_type		= "Transfer";
				$bank_id			= 0;
				$memo				= "Sales Order";
				
				//berkurang
				$sqlstr="insert into client_deposit (ref, date, client_code, opening_balance, current_balance, receipt_type, bank_id, receipt_status, memo, uid, dlu) values ('$ref', '$date', '$client_code', '$opening_balance', '$current_balance', '$receipt_type', '$bank_id', '$receipt_status', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr="update client set amount='$current_balance' where syscode='$client_code'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}	
				
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert sms_laporan_member
	function insert_sms_laporan_member($id, $phone, $upline, $idmember, $nama_member, $basic, $platinum, $qualifikasi, $group_sempurna, $total_member){	
		
		$dbpdo = DB::create();
		
		try {
			
			//delete 
			$sqlstr 	= "delete from sms_laporan_member where idmember='$idmember'";
	        $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr = "select id from sms_laporan_member order by id desc limit 1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$id = $data->id + 1;
			
			//insert
			$upline		= petikreplace($upline);
			$nama_member = petikreplace($nama_member);
			$sqlstr="insert into sms_laporan_member (id, phone, upline, idmember, nama_member, basic, platinum, qualifikasi, group_sempurna, total_member) values ('$id', '$phone', '$upline', '$idmember', '$nama_member', '$basic', '$platinum', '$qualifikasi', '$group_sempurna', '$total_member')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert sms_komisi_agen_platinum
	function insert_sms_komisi_agen_platinum($id, $phone, $upline, $idagen, $nama_agen, $komisi_prestasi, $komisi_pembinaan, $royalti_pembinaan, $total_komisi, $total_ap, $total_jaringan, $date){	
		
		$dbpdo = DB::create();
		
		try {
			
			//delete 
			$sqlstr 	= "delete from sms_komisi_agen_platinum where idagen='$idagen'";
	        $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr = "select id from sms_komisi_agen_platinum order by id desc limit 1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$id = $data->id + 1;
			
			//insert
			$upline		= petikreplace($upline);
			$nama_agen = petikreplace($nama_agen);
			$sqlstr="insert into sms_komisi_agen_platinum (id, date, phone, upline, idagen, nama_agen, komisi_prestasi, komisi_pembinaan, royalti_pembinaan, total_komisi, total_ap, total_jaringan) values ('$id', '$date', '$phone', '$upline', '$idagen', '$nama_agen', '$komisi_prestasi', '$komisi_pembinaan', '$royalti_pembinaan', '$total_komisi', '$total_ap', '$total_jaringan')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert sms_laporan_member_basic
	function insert_sms_laporan_member_basic($id, $phone, $upline, $idmember, $nama_member, $bonus_basic, $total_jaringan, $date){	
		
		$dbpdo = DB::create();
		
		try {
			
			//delete 
			$sqlstr 	= "delete from sms_laporan_member_basic where idmember='$idmember'";
	        $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr = "select id from sms_laporan_member_basic order by id desc limit 1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$id = $data->id + 1;
			
			//insert
			$upline		= petikreplace($upline);
			$nama_member = petikreplace($nama_member);
			$sqlstr="insert into sms_laporan_member_basic (id, date, phone, upline, idmember, nama_member, bonus_basic, total_jaringan) values ('$id', '$date', '$phone', '$upline', '$idmember', '$nama_member', '$bonus_basic', '$total_jaringan')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert sms_komisi_reward
	function insert_sms_komisi_reward($id, $idagen, $nama_agen, $komisi_basic, $komisi_prestasi, $komisi_pembinaan, $royalti_pembinaan, $ro_pribadi, $ro_generasi, $ro_royalti, $total_komisi, $reward, $date){	
		
		$dbpdo = DB::create();
		
		try {
			
			//delete 
			$sqlstr 	= "delete from sms_komisi_reward where idagen='$idagen'";
	        $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr = "select id from sms_komisi_reward order by id desc limit 1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$id = $data->id + 1;
			
			//insert
			$upline		= petikreplace($upline);
			$nama_agen = petikreplace($nama_agen);
			$sqlstr="insert into sms_komisi_reward (id, date, idagen, nama_agen, komisi_basic, komisi_prestasi, komisi_pembinaan, royalti_pembinaan, ro_pribadi, ro_generasi, ro_royalti, total_komisi, reward) values ('$id', '$date', '$idagen', '$nama_agen', '$komisi_basic', '$komisi_prestasi', '$komisi_pembinaan', '$royalti_pembinaan', '$ro_pribadi', '$ro_generasi', '$ro_royalti', '$total_komisi', '$reward')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert stock opname
	function insert_stock_opname($ref){	
		$dbpdo = DB::create();
		
		try {
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));
			$location_id		=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			$bin				= 	$_POST["bin"];
			if($bin == "") {
				$bin = "1";
			}
			$uid				=	$_SESSION["loginname"];
			$beginning_balance	= 	(empty($_POST["beginning_balance"])) ? 0 : $_POST["beginning_balance"];
			$memo				= 	$_POST["memo"];
			$dlu				=	date("Y-m-d H:i:s");
			$syscode			=	random(25);
			
			$sqlcek = "select ref, syscode from stock_opname where ref='$ref' and location_id='$location_id' and bin='$bin' and uid='$uid' limit 1";
			$sql=$dbpdo->prepare($sqlcek);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
					
			if($rows == 0) {
				$sqlstr="insert into stock_opname (ref, date, location_id, bin, uid, beginning_balance, memo, dlu, syscode) values('$ref', '$date', '$location_id', '$bin', '$uid', '$beginning_balance', '$memo', '$dlu', '$syscode')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$syscode = $data->syscode;
			}
			
			//----------insert item  detail
			$jmldata = numberreplace($_POST["jmldata"]);
			for($i=0; $i<$jmldata; $i++) {
				$item_code 		= $_POST["item_code_".$i.""];
				$uom_code 		= $_POST["uom_code_".$i.""];
				$expired_date 	= "00:00:00";
							
				if ( !empty($item_code) && !empty($uom_code) ) {				
					$qty = $_POST["qty_".$i.""];
					$unit_cost = numberreplace($_POST["unit_cost_".$i.""]);
					
					$line = maxline('stock_opname_detail', 'line', 'ref', $ref, '');
										
					//$sqlstr = "select qty, unit_cost from stock_opname_detail where ref='$ref' and location_id='$location_id' and bin='$bin' and uid='$uid' and item_code='$item_code' and uom_code='$uom_code' limit 1";
					$sqlstr = "select qty, unit_cost from stock_opname_detail where ref='$ref' and location_id='$location_id' and item_code='$item_code' and uom_code='$uom_code' limit 1";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rows = $sql->rowCount();
					$data = $sql->fetch(PDO::FETCH_OBJ);
					
					//$ref = $syscode;
					
					if($rows == 0 && $qty != '') {
						if ($qty != '') { 
							$sqlstr="insert into stock_opname_detail (ref, date, location_id, bin, uid, item_code, uom_code, line, qty, unit_cost, expired_date, syscode) values ('$ref', '$date', '$location_id', '$bin', '$uid', '$item_code', '$uom_code', $line, '$qty', '$unit_cost', '$expired_date', '$syscode')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
						
						if ($qty > 0) { //jika plus, maka masuk debit
							$amount = $unit_cost * $qty;
							
							$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '$qty', 0, '$amount', $line, '$uid', '$dlu')";		
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						} else { //jika minus, maka masuk credit
							$amount = ($unit_cost * $qty) * -1;
							$qty	= $qty * -1;
							
							$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '0', '$qty', '$amount', $line, '$uid', '$dlu')";		
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
					} else {
						$sqlstr="update stock_opname_detail set qty=ifnull(qty,0) + $qty, unit_cost='$unit_cost' where ref='$ref' and location_id='$location_id' and bin='$bin' and uid='$uid' and item_code='$item_code' and uom_code='$uom_code'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						##bincard update
						$sqlstr = "delete from bincard where invoice_no='$ref' and item_code='$item_code' and uom_code='$uom_code'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sqlstr="select sum(ifnull(qty,0)) qty from stock_opname_detail where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' group by ref, item_code, uom_code ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$data = $sql->fetch(PDO::FETCH_OBJ);
						$qty = $data->qty;
						
						if ($qty > 0) { //jika plus, maka masuk debit
							$amount = $unit_cost * $qty;
							
							$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '$qty', 0, '$amount', $line, '$uid', '$dlu')";		
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						} else { //jika minus, maka masuk credit
							$amount = ($unit_cost * $qty) * -1;
							$qty	= $qty * -1;
							
							$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '0', '$qty', '$amount', $line, '$uid', '$dlu')";		
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
						
					}
					
				}
			}
		
			//----------insert item packing detail
			/*$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$item_code 		= $_POST[item_code_.$i];
				$uom_code 		= $_POST[uom_code_.$i];
							
				if ( !empty($item_code) && !empty($uom_code) ) {				
					$qty = numberreplace($_POST[qty_.$i]);
					$unit_cost = numberreplace($_POST[unit_cost_.$i]);
					
					$line = maxline('stock_opname_detail', 'line', 'syscode', $syscode, '');
					
					$sqlstr="insert into stock_opname_detail (date, location_id, bin, uid, item_code, uom_code, line, qty, unit_cost, syscode) values ('$date', '$location_id', '$bin', '$uid', '$item_code', '$uom_code', $line, '$qty', '$unit_cost', '$syscode')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
										
				}
			}*/
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert employee
	function insert_employee($code){
		$dbpdo = DB::create();
		
		try {
			
			//$code			=	$_POST["code"];
			$name			=	petikreplace($_POST["name"]);
			$nick_name		=	petikreplace($_POST["nick_name"]);
			$born			=	petikreplace($_POST["born"]);
			$birth_date		=	date("Y-m-d", strtotime($_POST["birth_date"]));
			$marital_status	=	(empty($_POST["marital_status"])) ? 0 : $_POST["marital_status"];
			$religion_id	=	(empty($_POST["religion_id"])) ? 0 : $_POST["religion_id"];
			$address		=	petikreplace($_POST["address"]);
			$zip_code		=	$_POST["zip_code"];
			$country_id		=	(empty($_POST["country_id"])) ? 0 : $_POST["country_id"];
			$state_id		=	(empty($_POST["state_id"])) ? 0 : $_POST["state_id"];
			$phone			=	$_POST["phone"];
			$email			=	$_POST["email"];
			$category_id	=	$_POST["category_id"];
			$bank_name		=	$_POST["bank_name"];
			$bank_account	=	$_POST["bank_account"];
			$bank_account_name = petikreplace($_POST["bank_account_name"]);			
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			//-----------upload file
		  	$photo2				= $_POST["photo2"];
			$uploaddir_photo 	= 'app/photo_employee/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $code . '_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			
			$position_id	=	(empty($_POST["position_id"])) ? 0 : $_POST["position_id"];
			$department_id	=	(empty($_POST["department_id"])) ? 0 : $_POST["department_id"];
			$division_id	=	(empty($_POST["division_id"])) ? 0 : $_POST["division_id"];
			$location_id	=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			
			$sqlstr="insert into employee (code, name, nick_name, born, birth_date, marital_status, religion_id, address, zip_code, country_id, state_id, phone, email, photo, position_id, department_id, division_id, location_id, category_id, bank_name, bank_account, bank_account_name, active, uid, dlu) values('$code', '$name', '$nick_name', '$born', '$birth_date', '$marital_status', '$religion_id', '$address', '$zip_code', '$country_id', '$state_id', '$phone', '$email', '$photo', '$position_id', '$department_id', '$division_id', '$location_id', '$category_id', '$bank_name', '$bank_account', '$bank_account_name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert sales order
	function insert_sales_order($ref){	
		
		$dbpdo = DB::create();
		
		try {
		
			//----------insert item  detail
			/*$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			$sub_total = 0;
			for ($i=0; $i<=$jmldata; $i++) {
				$item_code 		= $_POST[item_code_.$i];
				$uom_code 		= $_POST[uom_code_.$i];
							
				if ( !empty($item_code) && !empty($uom_code) ) {					
					$qty = numberreplace($_POST[qty_.$i]);
					$unit_price = numberreplace($_POST[unit_price_.$i]);
					$discount = numberreplace($_POST[discount_.$i]);
					$amount = numberreplace($_POST[amount_.$i]);
					
					$line = maxline('sales_order_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into sales_order_detail (ref, item_code, uom_code, qty, discount, unit_price, amount, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$unit_price', '$amount', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$sub_total = $sub_total + $amount;
					
				}
			}*/
			
			$item_code 		= $_POST["item_code"];
			$uom_code 		= $_POST["uom_code"];
			$qty 			= numberreplace($_POST["qty"]);
					
			if ( !empty($item_code) && !empty($uom_code) && $qty > 0 ) {					
				
				$unit_price = numberreplace($_POST[unit_price]);
				$discount = numberreplace($_POST[discount]);
				$amount = numberreplace($_POST[amount]);
				
				$line = maxline('sales_order_detail', 'line', 'ref', $ref, '');
				
				$sqlstr="insert into sales_order_detail (ref, item_code, uom_code, qty, discount, unit_price, amount, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$unit_price', '$amount', $line)";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sub_total = $sub_total + $amount;
				
			}
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$status			= 	$_POST["status"];
			$employee_id	= 	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			$newclient		= 	(empty($_POST["newclient"])) ? 0 : $_POST["newclient"];
			$client_code	=	$_POST["client_code"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			##cek client
			if($newclient == 1) {
				$sqlcek 	= 	"select code from client where name='$client_code' ";	
				$resultcek=$dbpdo->prepare($sqlcek);
				$resultcek->execute();
				$numcek		= $resultcek->rowCount();
				
				if($numcek == 0) {
					$syscode	= 	random(15);
					$code		=	substr($client_code,0,3) . $syscode;
					$phone		=	$_POST["phone"];
					$client_type=	(empty($_POST["client_type"])) ? 0 : $_POST["client_type"];
					
					$sqlins 	=	"insert into client (code, name, contact_person, client_type, phone, active, syscode, uid, dlu) values ('$code', '$client_code', '$client_code', '$client_type', '$phone', 1, '$syscode', '$uid', '$dlu')";
					$sql=$dbpdo->prepare($sqlins);
					$sql->execute();
					
					$client_code =	$syscode;			
				} else {
					$sqlcek 	= 	"select syscode from client where name='$client_code' ";
					$resultcek=$dbpdo->prepare($sqlcek);
					$resultcek->execute();
					$datacek		= $resultcek->fetch(PDO::FETCH_OBJ);
					
					$client_code =	$datacek->syscode;
				}
			}
			
			
			$qo_ref				=	$_POST["qo_ref"];
			$top				=	$_POST["top"];
			$tax_code			=	$_POST["tax_code"];
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$freight_cost 		= 	numberreplace($_POST["freight_cost"]);
			$freight_account	= 	$_POST["freight_account"];
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);
			$memo				= 	$_POST["memo"];
			$total				=	$sub_total + $freight_cost; //$sub_total; //numberreplace($_POST["total"]);
			
			
			$sqlstr="insert into sales_order (ref, date, status, top, client_code, qo_ref, tax_code, tax_rate, freight_cost, freight_account, currency_code, rate, employee_id, total, memo, uid, dlu) values('$ref', '$date', '$status', '$top', '$client_code', '$qo_ref', '$tax_code', '$tax_rate', '$freight_cost', '$freight_account', '$currency_code', '$rate', '$employee_id', '$total', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert pos detail
	function insert_pos_detail($ref){	
		
		$dbpdo = DB::create();
		
		try {
		
			$location_id	= $_POST['location_id'];		
			$item_code 		= $_POST['item_code'];
	        $item_code2		= $_POST['item_code2'];
			$uom_code 		= $_POST['uom_code'];
			$non_discount 	= (empty($_POST['non_discount'])) ? 0 : $_POST['non_discount'];
			$employee_id	= $_POST['employee_id'];
	        $phone			= $_POST['phone'];
	        $ship_to		= petikreplace($_POST['ship_to']);
	        $bill_to		= petikreplace($_POST['bill_to']);
	        $qty 		    = numberreplace($_POST['qty']);
	        $unit_price     = numberreplace($_POST['unit_price']);
	        $amount 	    = numberreplace($_POST['amount']);	        
	        $cash			=	(empty($_POST["cash"])) ? 0 : $_POST["cash"];
	        $uid			=	$_SESSION["loginname"];			
			$dlu			=	date("Y-m-d H:i:s");
	        
	        //-------------------cek customer baru----\/
	        $newclient		=	(empty($_POST["newclient"])) ? 0 : $_POST["newclient"];	
			$client_code	=	petikreplace($_POST["client_code"]);
			$client_name	=	petikreplace($_POST["client_name"]);
			$client_type	=	(empty($_POST["client_type"])) ? 0 : $_POST["client_type"];
			
			if($newclient == 1) {
						
				$sqlcek 	= 	"select code from client where name='$client_name' and phone='$phone' ";
				$resultcek=$dbpdo->prepare($sqlcek);
				$resultcek->execute();
				$numcek		= $resultcek->rowCount();
							
				if($numcek == 0) {
					$syscode	= 	random(25);
					$code		=	notran(date('Y-m-d'), 'frmclient', '', '', '');
										
					//-------get client type
					/*$sqlclntype 	= 	"select id from client_type order by id limit 1 ";	
					$resultclntype=$dbpdo->prepare($sqlclntype);
					$resultclntype->execute();
					$dataclntype		= $resultclntype->fetch(PDO::FETCH_OBJ);
									
					$client_type	=	$dataclntype->id;*/
					//------------------/\
				
					$location_id2 = $_SESSION['location_id2'];
					$sqlstr 	=	"insert into client (code, name, contact_person, client_type, address, ship_to, bill_to, phone, active, syscode, location_id, uid, dlu) values ('$code', '$client_name', '$client_name', '$client_type', '$ship_to', '$ship_to', '$bill_to', '$phone', 1, '$syscode', '$location_id2', '$uid', '$dlu')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$client_code =	$syscode;	
					
					notran($date, 'frmclient', 1, '', '') ; //----eksekusi ref		
				} else {
					$sqlcek 	= 	"select syscode from client where name='$client_code' ";
					$resultcek=$dbpdo->prepare($sqlcek);
					$resultcek->execute();
					$datacek		= $resultcek->fetch(PDO::FETCH_OBJ);
					
					$client_code =	$datacek->syscode;
				}
				
			}
			//----------------------/\-end cek customer
					
					
	        //----------jika lookup gagal enter
	        if($item_code2 == "") {
	        	$sqlstr 	= "select syscode, uom_code_sales uom_code from item where code='$item_code2' limit 1";
			} else {
				$sqlstr 	= "select syscode, uom_code_sales uom_code from item where (code='$item_code2' or old_code='$item_code2') limit 1";
			}
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data 	= $sql->fetch(PDO::FETCH_OBJ); 
			
			if($item_code == '' || $item_code != '') {
				$item_code 	= $data->syscode;	
			}
			
			if($uom_code == '') {
				$uom_code	= $data->uom_code;	
			}
			
			if($location_id != "") {
				$sqlprice = "select b.current_price, a.name, ifnull(b.non_discount,0) non_discount from item a left join set_item_price b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' and location_id='$location_id' order by b.date_of_record desc limit 1 ";
				$resultprice=$dbpdo->prepare($sqlprice);
				$resultprice->execute();
				$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
			} else {
				$sqlprice = "select b.current_price, a.name, ifnull(b.non_discount,0) non_discount from item a left join set_item_price b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
				$resultprice=$dbpdo->prepare($sqlprice);
				$resultprice->execute();
				$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);	
			}
			
			
			if($unit_price == '' || $unit_price == 0) {
				$unit_price	= $dataprice->current_price;	
			}
			
			if($qty == '' || $qty == 0) {
				$qty = 1;
			}
			
			if($amount == '' || $amount == 0) {
				$amount			= $dataprice->current_price * 1;	
			}
			
			$non_discount	= $dataprice->non_discount;
			//---------------------------------/\
			
	       
	        if ( empty($item_code) && empty($uom_code) ) {
	            $sqlstr 	    = "select syscode, uom_code_sales uom_code from item where code='$item_code2' limit 1";
	            $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data		= $sql->fetch(PDO::FETCH_OBJ);
				
				$item_code  = $data->syscode;
	            $uom_code   = $data->uom_code; 
	            
	            $sqlprice = "select b.current_price, a.name, ifnull(b.non_discount,0) non_discount from item a left join set_item_price b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
	            //and b.location_id='$location_id' 
	            $resultprice=$dbpdo->prepare($sqlprice);
				$resultprice->execute();
				$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
				
			    $unit_price	    = $dataprice->current_price;
	            $qty            = 1;
	            $amount         = $unit_price * $qty;
	            $non_discount	= $dataprice->non_discount;
	            
	        }
						
			if ( !empty($item_code) && !empty($uom_code) ) {		
			
				$discount 	= numberreplace($_POST['discount_det']);			
				$discount2 	= numberreplace($_POST['discount']);
	            $discount3 	= numberreplace($_POST['discount3_det']);
				$deposit 	= numberreplace($_POST['deposit']);
				$total	 	= numberreplace($_POST['total']);
				
				$uid		= $_SESSION["loginname"];
				
				
				
				$sqlstr="select sum(qty) qty, item_code from sales_invoice_tmp where ref='$ref' and client_code='$client_code' and item_code='$item_code' and	uom_code='$uom_code' group by ref, client_code, item_code, uom_code";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows=$sql->rowCount();
				$data=$sql->fetch(PDO::FETCH_OBJ);
				
				if($rows >0) {
					$qty = $data->qty + 1;
					
					##cek jmlh qty, krn berpengaruh harga jual
					$datenow = date("Y-m-d");
					//$location_id = "0";
					
					if($location_id != "") {
						$sqlprice = "select a.current_price, a.current_price1, a.current_price2, a.current_price3, a.qty1, a.qty2, a.qty3, a.qty4 from set_item_price a  where a.item_code='$item_code' and a.uom_code='$uom_code' and a.efective_from <='$datenow' and a.location_id='$location_id' order by a.date_of_record desc limit 1 ";
						$resultprice=$dbpdo->prepare($sqlprice);
						$resultprice->execute();
						$dataprice	= $resultprice->fetch(PDO::FETCH_OBJ);
					} else {
						$sqlprice = "select a.current_price, a.current_price1, a.current_price2, a.current_price3, a.qty1, a.qty2, a.qty3, a.qty4 from set_item_price a  where a.item_code='$item_code' and a.uom_code='$uom_code' and a.efective_from <='$datenow' order by a.date_of_record desc limit 1 ";
						$resultprice=$dbpdo->prepare($sqlprice);
						$resultprice->execute();
						$dataprice	= $resultprice->fetch(PDO::FETCH_OBJ);
					}
					
					
					$current_price 	= $dataprice->current_price;
					$current_price1 = $dataprice->current_price1;
					$current_price2	= $dataprice->current_price2;
					$current_price3	= $dataprice->current_price3;
					
					$qty1 	= $dataprice->qty1;
					$qty2 	= $dataprice->qty2;
					$qty3	= $dataprice->qty3;
					$qty4	= $dataprice->qty4;
					
					/*if($qty <= $qty1) {*/
						$unit_price = $current_price;
					/*}
					if( ($qty > $qty1) && ($qty <= $qty2) ) {
						$unit_price = $current_price1;
					}
					if($qty > $qty2) {
						$unit_price = $current_price2;
					}*/
					
					
					$amount = $qty * $unit_price;
					$total = $amount;
					##end cek
					
					$sqlstr="update sales_invoice_tmp set phone='$phone', ship_to='$ship_to', bill_to='$bill_to', qty='$qty', unit_price='$unit_price', amount='$amount', total='$total' where ref='$ref' and client_code='$client_code' and item_code='$item_code' and uom_code='$uom_code'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
					$line = maxline('sales_invoice_tmp', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into sales_invoice_tmp (ref, client_code, cash, item_code, uom_code, qty, discount, unit_price, amount, discount2, discount3, deposit, total, non_discount, location_id, employee_id, phone, ship_to, bill_to, uid, line) values ('$ref', '$client_code', '$cash', '$item_code', '$uom_code', '$qty', '$discount', '$unit_price', '$amount', '$discount2', '$discount3', '$deposit', '$total', '$non_discount', '$location_id', '$employee_id', '$phone', '$ship_to', '$bill_to', '$uid', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
											
			}	
				
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert pos
	function insert_pos($ref){	
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			date_default_timezone_set('Asia/Jakarta');
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$status			= 	$_POST["status"];
			$due_date		=	date("Y-m-d");
			$total			=	numberreplace($_POST["total"]); //$sub_total; 
			$cash_amount	=	numberreplace($_POST["cash_amount"]);
			$cash_voucher	=	numberreplace($_POST["cash_voucher"]);
			$change_amount	=	numberreplace($_POST["change_amount"]);
			$phone			=	$_POST["phone"];
			$ship_to		=	petikreplace($_POST["ship_to"]);
			$bill_to		=	petikreplace($_POST["bill_to"]);
			$shift			=	numberreplace($_POST["shift"]);
			$freight_cost 	=	numberreplace($_POST["freight_cost"]);
			$note_transfer 	=	petikreplace($_POST["note_transfer"]);
			$note_ecommerce =	petikreplace($_POST["note_ecommerce"]);
			$bank_account 	=	$_POST["bank_account"];
			$expedition_bill=	$_POST["expedition_bill"];
			$receipt_type 	=	$_POST["receipt_type"];
			$uid			=	$_SESSION["loginname"];
			
			$dlu			=	date("Y-m-d H:i:s");
			
			##cek data untuk menghindari data double
			$sqlstr = "select uid, dlu from sales_invoice where uid='$uid' and dlu='$dlu'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rowsdata=$sql->rowCount();
			if($rowsdata == 0) {
				
				$sqlstr = "select uid, dlu from sales_invoice where uid='$uid' and DATE_ADD( dlu, INTERVAL 1 
SECOND)='$dlu'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rowsdata1=$sql->rowCount();
				if($rowsdata1 == 0) {
				
					/*$sqlstr = "select uid, dlu from sales_invoice where date='$date' and due_date='$due_date' and total='$total' and cash_amount='$cash_amount' and cash_voucher='$cash_voucher' and change_amount='$change_amount' and shift='$shift' and uid='$uid' and uid='$uid' and DATE_ADD( dlu, INTERVAL 25 
SECOND)>'$dlu'";*/
					$sqlstr = "select uid, dlu from sales_invoice where date='$date' and due_date='$due_date' and total='$total' and cash_amount='$cash_amount' and cash_voucher='$cash_voucher' and change_amount='$change_amount' and shift='$shift' and uid='$uid' and uid='$uid' and DATE_ADD( dlu, INTERVAL 17 
SECOND)>'$dlu'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata2=$sql->rowCount();
					if($rowsdata2 == 0) {
						
						//-------start insert-----------------
						$location_id	=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
						
						$client_member_code	=	$_POST["client_member_code"];
						if($client_member_code == "") {
							$client_member_code2	=	$_POST["client_member_code2"];
							$sqlcln = "select syscode from client where rtrim(ltrim(code))='$client_member_code2' ";
							$sql=$dbpdo->prepare($sqlcln);
							$sql->execute();
							$data   = $sql->fetch(PDO::FETCH_OBJ);
							$client_member_code = $data->syscode;
						}
						
						$cash			=	(empty($_POST["cash"])) ? 0 : $_POST["cash"];
						
						
						
						##insert outbount (pengeluaran barang ke toko)
						//$ref_outbound = $this->insert_outbound_pos($date, 'P', 'T', '', '', '', $location_id, 0, $uid, $dlu);
						
						//----------insert item packing detail
						$jmldata = 4; //(empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
						$sub_total = 0;
						for ($i=0; $i<=$jmldata; $i++) {
							$so_ref 		= ""; //$_POST['so_ref'];
							$so_line		= 0; //numberreplace($_POST['so_line']);
							$item_code 		= $_POST['item_code_'.$i.''];
							$uom_code 		= $_POST['uom_code_'.$i.''];
							
							if ( !empty($item_code) && !empty($uom_code) ) {
													
								$qty = numberreplace($_POST['qty_'.$i.'']);
								$unit_price = numberreplace($_POST['unit_price_'.$i.'']);
								$discount = numberreplace($_POST['discount_det_'.$i.'']);
				                $discount3 = numberreplace($_POST['discount3_det_'.$i.'']);
								$amount = numberreplace($_POST['amount_'.$i.'']);
								$non_discount = (empty($_POST['non_discount_'.$i.''])) ? 0 : $_POST['non_discount_'.$i.''];
								
								//get cogs
								$sqlprice = "select b.cogs, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
								$resultprice=$dbpdo->prepare($sqlprice);
								$resultprice->execute();
								$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
								$unit_cost		= numberreplace($dataprice->cogs);	
								$amount_cost	= $qty * $unit_cost;
								
								$line = maxline('sales_invoice_detail', 'line', 'ref', $ref, '');
								
								$sqlstr="insert into sales_invoice_detail (ref, so_ref, item_code, uom_code, qty, discount, discount3, unit_price, amount, non_discount, unit_cost, amount_cost, line_item_so, line) values ('$ref', '$xndf', '$item_code', '$uom_code', '$qty', '$discount', '$discount3', '$unit_price', '$amount', '$non_discount', '$unit_cost', '$amount_cost', '$so_line', '$line')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();								
								
								//----------insert bincard (debit qty)
								/*$expired_date = "00:00:00";
								$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'pos', '', '$item_code', '$uom_code', '$expired_date', '$unit_price', 0, '$qty', '$amount', '$line', '$uid', '$dlu')";	
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();*/
								
								//update sales_order_detail
								/*$sqlstr="update sales_order_detail set qty_sales=ifnull(qty_sales,0) + $qty where ref='$so_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$so_line'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();*/
								
								$sub_total = $sub_total + $amount;
								
								
								##insert outbound detail (pengeluaran barang ke toko)
								/*$ref_pos = $ref;
								$this->insert_outbound_pos_detail($ref_outbound, $item_code, $uom_code, $qty, $ref_pos);*/
								
								
							}
						}
						
						
						//detail employee
						/*$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];
						for ($x=0; $x<=$jmldata2; $x++) {
							$line2 = maxline('sales_invoice_employee', 'line', 'ref', $ref, '');
							
							//detail capster
							$get_epy = $_POST[get_epy_.$x];
							if($get_epy == 1) {
								
								$employee_id = $_POST[employee_id_.$x];
								
								$sqlstr="insert into sales_invoice_employee (ref, employee_id, line) values ('$ref', '$employee_id', $line2)";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						}*/
						
							
							//----get client cash
							/*
							$sqlcek 	= 	"select syscode from client where name='cash' limit 1 ";
							$resultcek	=	mysql_query($sqlcek);
							$datacek	=	mysql_fetch_object($resultcek);			
							$client_code =	$datacek->syscode;
							*/
							
							$newclient		=	(empty($_POST["newclient"])) ? 0 : $_POST["newclient"];	
							$client_code	=	$_POST["client_code"];
							
							/*if($newclient == 1) {
								//-------------------cek customer baru----\/		
								$sqlcek 	= 	"select code from client where name='$client_code' ";	
								$resultcek=$dbpdo->prepare($sqlcek);
								$resultcek->execute();
								$numcek		= $resultcek->rowCount();
								
								if($numcek == 0) {
									$syscode	= 	random(9);
									$code		=	substr($client_code,0,3) . $syscode;
									$phone		=	$_POST['phone'];
									
									//-------get client type
									$sqlclntype 	= 	"select id from client_type order by id limit 1 ";		
									$resultclntype=$dbpdo->prepare($sqlclntype);
									$resultclntype->execute();
									$dataclntype		= $resultclntype->fetch(PDO::FETCH_OBJ);
												
									$client_type	=	$dataclntype->id;
									//------------------/\
								
									$location_id2 = $_SESSION['location_id2'];
									$sqlstr 	=	"insert into client (code, name, contact_person, client_type, ship_to, bill_to, phone, address, active, syscode, location_id, uid, dlu) values ('$code', '$client_code', '$client_code', '$client_type', '$ship_to', '$bill_to', '$phone', '$ship_to', 1, '$syscode', '$location_id2', '$uid', '$dlu')";
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();	
									
									$client_code =	$syscode;			
								} else {
									$sqlcek 	= 	"select syscode from client where name='$client_code' ";
									$resultcek=$dbpdo->prepare($sqlcek);
									$resultcek->execute();
									$datacek		= $resultcek->fetch(PDO::FETCH_OBJ);
									
									$client_code =	$datacek->syscode;
								}
								//----------------------/\-end cek customer
							} */
							
							$channel_id 		=	numberreplace($_POST["channel_id"]);
							$employee_id		= 	numberreplace($_POST["employee_id"]);
							$expedition_id		= 	numberreplace($_POST["expedition_id"]);						
							$top				=	"C.O.D";
							$tax_code			=	"";
							$tax_rate			=	0;
							$freight_account	= 	"";
							$currency_code		=	"";
							$rate				=	0;
							$memo				= 	$_POST["memo"];
							$discount2			=	numberreplace($_POST["discount"]);
							$deposit			=	0;		
							$commision_rate		=	numberreplace($_POST["commision_rate"]);
							$total_member		=	numberreplace($_POST["total"]);
							$taxable			=	0;
							
							$photo_file			= 	""; 
							
							$bank_id			=	(empty($_POST["bank_id"])) ? 0 : $_POST["bank_id"];
							$bank_amount		=	numberreplace($_POST["bank_amount2"]);
							$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
							$card_amount		=	numberreplace($_POST["card_amount"]);
							$credit_card_no		=	$_POST["credit_card_no"];
							$credit_card_holder	=	petikreplace($_POST["credit_card_holder"]);
							
							//update status sales order (Paid)
							/*$sqlstr = "update sales_order set status='D' where ref='$xndf'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();*/
						
							$sqlstr="insert into sales_invoice (ref, ref2, date, status, top, due_date, client_code, channel_id, ship_to, bill_to, expedition_id, tax_code, tax_rate, freight_cost, freight_account, currency_code, rate, employee_id, discount, total, memo, opening_balance, cash, location_id, deposit, taxable, photo_file, cash_amount, cash_voucher, bank_id, bank_amount, credit_card_code, card_amount, credit_card_no, credit_card_holder, change_amount, shift, client_member_code, commision_rate, phone, bank_account, expedition_bill, receipt_type, note_transfer, note_ecommerce, uid, dlu) values('$ref', '$ref2', '$date', '$status', '$top', '$due_date', '$client_code', '$channel_id', '$ship_to', '$bill_to', '$expedition_id', '$tax_code', '$tax_rate', '$freight_cost', '$freight_account', '$currency_code', '$rate', '$employee_id', '$discount2', '$total', '$memo', 0, '$cash', '$location_id', '$deposit', '$taxable', '$photo_file', '$cash_amount', '$cash_voucher', '$bank_id', '$bank_amount', '$credit_card_code', '$card_amount', '$credit_card_no', '$credit_card_holder', '$change_amount', '$shift', '$client_member_code', '$commision_rate', '$phone', '$bank_account', '$expedition_bill', '$receipt_type', '$note_transfer', '$note_ecommerce', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();

							//----update address client
							$address = petikreplace($_POST['address']);
							$sqlstr="update client set address='$address' where syscode='$client_code'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
				            ##jika piutang
				            if($receipt_type == 'Kredit') {
								
								$total = $total - $deposit;
								//insert AR
								$exchange_date = "00:00:00";

								$sqlstr="insert into ar(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'C', '$client_code', '', '$total', 0, 'cashier', 'pos', '$currency_code', '$rate', '', '$exchange_date', '$top', '$memo', '$uid', '$dlu')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
				            //-----------
				            
			            
						}
					}
				} 
				
	            /*//update sales order (paid)
	            $sqlstr="update sales_order set paid=1 where ref='$ref_tmp' ";
			    $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
	            //-------delete invoice detail tmp
				$sqlstr="delete from sales_invoice_tmp where ref='$ref_tmp' and uid='$uid' ";
			    $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();*/
				
				$dbpdo->commit();
	
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert material
	function insert_material($code){		
		$dbpdo = DB::create();
		
		try {
			
			//$code			=	$_POST["code"];
			$old_code		=	$_POST["old_code"];
			$name			=	petikreplace($_POST["name"]);
			$item_group_id	=	(empty($_POST["item_group_id"])) ? 0 : $_POST["item_group_id"];
			$item_subgroup_id	=	(empty($_POST["item_subgroup_id"])) ? 0 : $_POST["item_subgroup_id"];
			$item_type_code		=	$_POST["item_type_code"];
			$item_category_id	=	(empty($_POST["item_category_id"])) ? 0 : $_POST["item_category_id"];
			$brand_id			=	(empty($_POST["brand_id"])) ? 0 : $_POST["brand_id"];
			$size_id			= 	$_POST["size_id"];  //	(empty($_POST["size_id"])) ? 0 : $_POST["size_id"];
			$uom_code_stock		=	$_POST["uom_code_stock"];
			$uom_code_sales		=	$uom_code_stock; //$_POST["uom_code_sales"];
			$uom_code_purchase	=	$uom_code_stock; //$_POST["uom_code_purchase"];
			$minimum_stock		=	numberreplace((empty($_POST["minimum_stock"])) ? 0 : $_POST["minimum_stock"]);
			$maximum_stock		=	numberreplace((empty($_POST["maximum_stock"])) ? 0 : $_POST["maximum_stock"]);
			
			$consigned		=	(empty($_POST["consigned"])) ? 0 : $_POST["consigned"];
			$balance		=	numberreplace($_POST["balance"]);
			$description	=	petikreplace($_POST["description"]);
			
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$syscode		= 	random(25);
			
			//-----------upload file
		  	$photo2				= $_POST["photo2"];
			$uploaddir_photo 	= 'app/photo_item/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $syscode . '_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			$sqlstr="insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, balance, description, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$balance', '$description', '$active', '$uid', '$dlu', '$syscode')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*---------insert audit trail (insert)------------*/
			$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$active', '$uid', '$dlu', '$syscode', 'insert' )";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			##execute otomatis number
			$sqlstr="select a.code from item_group a where a.id='$item_group_id'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			
			notran($date, 'frmitembarcode', 1, '', $data->code);
			
			
			#insert/update set item cost
			$item_code	=	$syscode;
			$uom_code	=	$uom_code_purchase;
			$date_cost			=	date("Y-m-d", strtotime($_POST['date_cost']));
			$efective_from_cost	=	date("Y-m-d", strtotime($_POST['efective_from_cost']));
			
			$point_first_order	=	numberreplace($_POST["point_first_order"]);
			$current_cost		=	numberreplace($_POST['current_cost']);
			$bonus_basic		=	numberreplace($_POST["bonus_basic"]);
			$bonus_prestation	=	numberreplace($_POST["bonus_prestation"]);
			$bonus_unilevel		=	numberreplace($_POST["bonus_unilevel"]);
			$matching_sponsor	=	numberreplace($_POST["matching_sponsor"]);
			$reward				=	numberreplace($_POST["reward"]);
			$repeat_order		=	numberreplace($_POST["repeat_order"]);
			$royalti			=	numberreplace($_POST["royalti"]);
			$total_budget		=	numberreplace($_POST["total_budget"]);
			
			$fo_point			=	numberreplace($_POST["fo_point"]);
			$ro_point			=	numberreplace($_POST["ro_point"]);
			
			if($date_cost == "1970-01-01") {
				$date_cost = date("Y-m-d");
			}
			
			if($efective_from_cost == "1970-01-01") {
				$efective_from_cost = date("Y-m-d");
			}
			
			
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id_cost	=	$_POST['location_id_cost'];
			
			/*$sqlstr = "select item_code, current_cost from set_item_cost where item_code='$item_code' and uom_code='$uom_code' and current_cost='$current_cost'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$last_cost = $data->current_cost;
			
			if($rows == 0) {*/
			
			$sqlstr = "insert into set_item_cost (date, efective_from, item_code, uom_code, current_cost, point_first_order, bonus_basic, bonus_prestation, bonus_unilevel, matching_sponsor, reward, repeat_order, royalti, total_budget, last_cost, fo_point, ro_point, date_of_record, location_id, uid, dlu) values('$date_cost', '$efective_from_cost', '$item_code', '$uom_code', '$current_cost', '$point_first_order', '$bonus_basic', '$bonus_prestation', '$bonus_unilevel', '$matching_sponsor', '$reward', '$repeat_order', '$royalti', '$total_budget', '$last_cost', '$fo_point', '$ro_point', '$date_of_record', '$location_id_cost', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*} else {
				$sqlstr = "update set_item_cost set efective_from='$efective_from_cost', uom_code='$uom_code', current_cost='$current_cost', last_cost='$last_cost', date_of_record='$date_of_record', location_id='$location_id_cost', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}*/
			
			
			#insert/update set item price
			$item_code	=	$syscode;
			$uom_code	=	$uom_code_sales;
			$current_price	=	numberreplace($_POST['current_price']);
			$current_price1	=	numberreplace($_POST['current_price1']);
			$current_price2	=	numberreplace($_POST['current_price2']);
			$current_price3	=	numberreplace($_POST['current_price3']);
			
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$price_tax			=	numberreplace($_POST["price_tax"]);
			$price_member_tax	=	numberreplace($_POST["price_member_tax"]);
			$margin_warehouse	=	numberreplace($_POST["margin_warehouse"]);
			$margin_mlm			=	numberreplace($_POST["margin_mlm"]);
			$registration_rate	=	numberreplace($_POST["registration_rate"]);
			$registration_rate_platinum =	numberreplace($_POST["registration_rate_platinum"]);
			
			$date			=	date("Y-m-d", strtotime($_POST['date']));
			if($date == "1970-01-01") {
				$date = date("Y-m-d");
			}
			$efective_from	=	date("Y-m-d", strtotime($_POST['efective_from']));
			if($efective_from == "1970-01-01") {
				$efective_from = date("Y-m-d");
			}
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id	=	$_POST['location_id'];
			$non_discount	=	$_POST['non_discount'];
			$qty1			=	numberreplace($_POST['qty1']);
			$qty2			=	numberreplace($_POST['qty2']);
			$qty3			=	numberreplace($_POST['qty3']);
			$qty4			=	numberreplace($_POST['qty4']);
			
			/*$sqlstr = "select item_code, current_price from set_item_price where item_code='$item_code' and uom_code='$uom_code' and current_price='$current_price'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$last_price = $data->current_price;
			
			if($rows == 0) {*/
				$sqlstr = "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, tax_rate, price_tax, price_member_tax, margin_warehouse, margin_mlm, registration_rate, registration_rate_platinum, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$tax_rate', '$price_tax', '$price_member_tax', '$margin_warehouse', '$margin_mlm', '$registration_rate', '$registration_rate_platinum', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				//audit trail insert
				$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'insert')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
			/*} else {
				$sqlstr = "update set_item_price set efective_from='$efective_from', uom_code='$uom_code', current_price='$current_price', current_price1='$current_price1', current_price2='$current_price2', current_price3='$current_price3', last_price='$last_price', date_of_record='$date_of_record', location_id='$location_id', non_discount='$non_discount', qty1='$qty1', qty2='$qty2', qty3='$qty3', qty4='$qty4', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				//update audit trail
				$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'update')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}*/
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert purchase_inv detail
	function insert_purchase_inv_detail($ref){	
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$location_id	= $_POST['location_id'];		
			$item_code 		= $_POST['item_code'];
	        $item_code2		= $_POST['item_code2'];
			$uom_code 		= $_POST['uom_code'];
			$size 	    	= numberreplace($_POST['size']);
	        $qty 		    = numberreplace($_POST['qty']);
	        $unit_cost     	= numberreplace($_POST['unit_cost']);
	        $amount 	    = numberreplace($_POST['amount']);
	        $cash			=	(empty($_POST["cash"])) ? 0 : $_POST["cash"];
	        $stock_in		=	(empty($_POST["stock_in"])) ? 0 : $_POST["stock_in"];
	        $vendor_code	=	$_POST["vendor_code"];
			$payment_type	= $_POST["payment_type"];
					
					
	        //----------jika lookup gagal enter
	        $sqlstr 	= "select syscode, uom_code_purchase uom_code from item where (code='$item_code2' or old_code='$item_code2') limit 1";
	        $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data 	= $sql->fetch(PDO::FETCH_OBJ); 
			
			if($item_code == '') {
				$item_code 	= $data->syscode;	
			}
			
			if($uom_code == '') {
				$uom_code	= $data->uom_code;	
			}
			
			
			$sqlprice = "select b.current_cost, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
			$resultprice=$dbpdo->prepare($sqlprice);
			$resultprice->execute();
			$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
			
			if($unit_cost == '' || $unit_cost == 0) {
				$unit_cost	= $dataprice->current_cost;	
			}
			
			if($qty == '' || $qty == 0) {
				$qty = 1;
			}
			
			if($amount == '' || $amount == 0) {
				$amount			= $dataprice->current_cost * 1;	
			}
			//---------------------------------/\
			
	       
	        if ( empty($item_code) && empty($uom_code) ) {
	            $sqlstr 	    = "select syscode, uom_code_purchase uom_code from item where (code='$item_code2' or code='$item_code2') limit 1";
	            $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data		= $sql->fetch(PDO::FETCH_OBJ);
				
				$item_code  = $data->syscode;
				if($uom_code == '') {
	            	$uom_code   = $data->uom_code; 
				}
	            
	            $sqlprice = "select b.current_cost, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_purchase='$uom_code' and b.location_id='$location_id' order by b.date_of_record desc limit 1 ";
	            $resultprice=$dbpdo->prepare($sqlprice);
				$resultprice->execute();
				$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
				
			    $unit_cost	    = $dataprice->current_cost;
	            $qty            = 1;
	            $amount         = $unit_price * $qty;
	            
	        }
						
			if ( !empty($item_code) && !empty($uom_code) ) {		
			
				$discount_det	= numberreplace($_POST['discount_det']);			
				$discount 		= $discount_det; //numberreplace($_POST['discount']);
	            $discount1 		= numberreplace($_POST['discount3_1_det']);
	            $discount2 		= numberreplace($_POST['discount3_2_det']);
	            $discount3 		= numberreplace($_POST['discount3_3_det']);
				$total	 		= numberreplace($_POST['total']);
				
				$uid			= $_SESSION["loginname"];
				
				//----------insert/update set_item_price (ditutup krn harga di seting di set item price aja)
				/*$sqlprice = "select item_code from set_item_price where item_code='$item_code' and uom_code='$uom_code' and current_price='$unit_price' and location_id='$location_id' order by date_of_record desc limit 1 ";
				$resultprice = mysql_query($sqlprice);
				$numprice = mysql_num_rows($resultprice);
				*/
				
				/*if($numprice == 0) {
					$sqlprice2 = "select current_price from set_item_price where item_code='$item_code' and uom_code='$uom_code' and location_id='$location_id' order by date_of_record desc limit 1 ";
					$resultprice2 = mysql_query($sqlprice2);
					$dataprice = mysql_fetch_object($resultprice2);
				
					$last_price			=	$dataprice->current_price;
					$date_of_record		=	date("Y-m-d H:i:s");
					
					$sqlstr="insert into set_item_price (date, efective_from, item_code, uom_code, current_price, last_price, date_of_record, location_id, uid, dlu) values ('$date', '$date', '$item_code', '$uom_code', '$unit_price', '$last_price', '$date_of_record', '$location_id', '$uid', '$dlu')";				
					QueryDbTrans($sql2, $success);
				}	*/
				//------------------------------------/\
				
				$sqlstr="select sum(qty) qty, item_code from purchase_invoice_tmp where ref='$ref' and vendor_code='$vendor_code' and item_code='$item_code' and	uom_code='$uom_code' group by ref, vendor_code, item_code, uom_code";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows=$sql->rowCount();
				$data=$sql->fetch(PDO::FETCH_OBJ);
				
				if($rows >0) {
					$qty = $data->qty + $qty;
					$amount = ($qty * ($unit_cost - $discount));
					//$amount = $qty * $unit_cost;
					$total = $amount;
					
					$sqlstr="update purchase_invoice_tmp set qty='$qty', size='$size', unit_cost='$unit_cost', discount1='$discount1', discount2='$discount2', discount3='$discount3', discount='$discount', amount='$amount', total='$total', payment_type='$payment_type', stock_in='$stock_in' where ref='$ref' and vendor_code='$vendor_code' and item_code='$item_code' and uom_code='$uom_code'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
				
					$line = maxline('purchase_invoice_tmp', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into purchase_invoice_tmp (ref, vendor_code, item_code, uom_code, size, qty, discount1, discount2, discount3, discount, unit_cost, amount, total, location_id, payment_type, stock_in, uid, line) values ('$ref', '$vendor_code', '$item_code', '$uom_code', '$size', '$qty', '$discount1', '$discount2', '$discount3', '$discount_det', '$unit_cost', '$amount', '$total', '$location_id', '$payment_type', '$stock_in', '$uid', $line)";
		            $sql=$dbpdo->prepare($sqlstr);
					$sql->execute();	
				}
										
			}	
				
			$dbpdo->commit();
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert purchase inv
	function insert_purchase_inv($ref){	
				
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));
			$location_id		=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			$stock_in			= 	(empty($_POST["stock_in"])) ? 0 : $_POST["stock_in"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
				
			//----------insert item packing detail
			//$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			$sub_total = 0;
			//for ($i=0; $i<=$jmldata; $i++) {
				//$po_ref 		= $_POST[po_ref_.$i];
				$item_code 		= $_POST['item_code'];
				$uom_code 		= $_POST['uom_code'];
				
				if ( !empty($item_code) && !empty($uom_code) ) {							
					$qty = numberreplace($_POST['qty']);
					$unit_cost = numberreplace($_POST['unit_cost']);
					$size 		= numberreplace($_POST['size']);
					$discount = numberreplace($_POST['discount']);
	                $discount1 = numberreplace($_POST['discount3_1']);
	                $discount2 = numberreplace($_POST['discount3_2']);
	                $discount3 = numberreplace($_POST['discount3_3']);
					$amount = numberreplace($_POST['amount']); //$qty * $unit_cost; //numberreplace($_POST[amount_.$i]);
					$line_item_po = (empty($_POST['line_item_po'])) ? 0 : $_POST['line_item_po'];
					
					$line = maxline('purchase_invoice_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into purchase_invoice_detail (ref, po_ref, item_code, uom_code, size, qty, unit_cost, discount1, discount2, discount3, discount, amount, line_item_po, line) values ('$ref', '', '$item_code', '$uom_code', '$size', '$qty', '$unit_cost', '$discount1', '$discount2', '$discount3', '$discount', '$amount', '0', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//----------insert bincard (debit qty)
					if($stock_in == 1) {
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_inv', '', '$item_code', '$uom_code', '$unit_cost', '$qty', 0, '$amount', '$line', '$uid', '$dlu')";				
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
					$sub_total = $sub_total + $amount;
					
					
					
				}
			//}
			
			
				
			$invoice_no			=	$_POST["invoice_no"];
			$status				= 	"R"; //$_POST["status"];
			$bill_number		= 	$_POST["bill_number"];
			$vendor_code		= 	$_POST["vendor_code"];
			$top				= 	$_POST["top"];
			$tax_code			= 	$_POST["tax_code"];
			$tax_rate			=	numberreplace((empty($_POST["tax_rate"])) ? 0 : $_POST["tax_rate"]);
			$freight_cost		=	numberreplace((empty($_POST["freight_cost"])) ? 0 : $_POST["freight_cost"]);
			$freight_account	= 	petikreplace($_POST["freight_account"]);
			$discount 			= 	numberreplace($_POST["discount_det"]);
			$total				=	numberreplace($_POST["total"]); //$sub_total + $freight_cost;
			$memo				= 	petikreplace($_POST["memo"]);			
			$payment_type		=	$_POST["payment_type"];
			$cash				= 	(empty($_POST["cash"])) ? 0 : $_POST["cash"];
			$cash_amount		= 	numberreplace($_POST["cash_amount"]);
			$change_amount		=	numberreplace($_POST["change_amount"]);
			$due_date			=	date("Y-m-d", strtotime($_POST["due_date"]));
			
			$bank_id			=	(empty($_POST["bank_id"])) ? 0 : $_POST["bank_id"];
			$bank_account		=	petikreplace($_POST["bank_account"]);
			$bank_amount		=	numberreplace($_POST["bank_amount"]);
			$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
			$card_amount		=	numberreplace($_POST["card_amount"]);
			$credit_card_no		=	$_POST["credit_card_no"];
			$credit_card_holder	=	petikreplace($_POST["credit_card_holder"]);
			$purchase_type 		=	numberreplace($_POST["purchase_type"]);
			
			$sqlstr="insert into purchase_invoice (ref, invoice_no, date, status, bill_number, vendor_code, top, due_date, tax_code, tax_rate, freight_cost, freight_account, memo, payment_type, location_id, cash, cash_amount, change_amount, discount, total, bank_id, bank_account, bank_amount, credit_card_code, card_amount, credit_card_no, credit_card_holder, stock_in, purchase_type, uid, dlu) values('$ref', '$invoice_no', '$date', '$status', '$bill_number', '$vendor_code', '$top', '$due_date', '$tax_code', '$tax_rate', '$freight_cost', '$freight_account', '$memo', '$payment_type', '$location_id', '$cash', '$cash_amount', '$change_amount', '$discount', '$total', '$bank_id', '$bank_account', '$bank_amount', '$credit_card_code', '$card_amount', '$credit_card_no', '$credit_card_holder', '$stock_in', '$purchase_type', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
			//insert AP
			if ($payment_type == "Kredit") {
								
				$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'V', '$vendor_code', '', 0, '$total', 'POV', 'POV', '$currency_code', '$rate', '', '', '$top', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			
			}
			
			
			//-------delete invoice detail tmp
			$sqlstr="delete from purchase_invoice_tmp where ref='$ref_tmp' and uid='$uid' ";
		    $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$dbpdo->commit();
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//------general journal
	function insert_general_journal($ref){
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date			=	date('Y-m-d', strtotime($_POST["date"]));
			$status			= 	$_POST["status"];
			$currency_code	= 	$_POST["currency_code"];
			$rate			=	str_replace(",","",(empty($_POST["rate"])) ? 0 : $_POST["rate"]);
			$memo			= 	$_POST["memo"];
			$total_balance	=	str_replace(",","",(empty($_POST["total_balance"])) ? 0 : $_POST["total_balance"]);
			$total_debit	=	str_replace(",","",(empty($_POST["total_debit"])) ? 0 : $_POST["total_debit"]);
			$total_credit	=	str_replace(",","",(empty($_POST["total_credit"])) ? 0 : $_POST["total_credit"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into general_journal(ref, date, status, currency_code, rate, memo, total_balance, total_debit, total_credit, uid, dlu) values('$ref', '$date', '$status', '$currency_code', '$rate', '$memo', '$total_balance', '$total_debit', '$total_credit', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$account_code 	= $_POST[account_code_.$i];
				$memo2 		= $_POST[memo_.$i];
				$debit_amount		= str_replace(",","",(empty($_POST[debit_amount_.$i])) ? 0 : $_POST[debit_amount_.$i]);
				$credit_amount		= str_replace(",","",(empty($_POST[credit_amount_.$i])) ? 0 : $_POST[credit_amount_.$i]);
				
				if ($account_code != '') { 		
					
					$line = maxline('general_journal_detail', 'line', 'ref', $ref, '');
					
					$sqlstr = "insert into general_journal_detail(ref, account_code, memo, debit_amount, credit_amount, line) values('$ref', '$account_code', '$memo2', '$debit_amount', '$credit_amount', '$line') ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
				
			}
			
			$dbpdo->commit();
	
		}		
	
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	//-----insert sales order cs
	function insert_sales_order_cs($ref){	
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			//----------insert item detail
			$item_code = $_POST["item_code"];
			$exp = explode("|", $item_code);
			
			$qty = $_POST["qty"];
			$expqty = explode("|", $qty);
			
			$unit_price = $_POST["unit_price"];
			$expunit_price = explode("|", $unit_price);
			
			$discount_id = $_POST["discount_id"];
			$expdiscount_id = explode("|", $discount_id);
			
			$jmldata = count($exp);  //(empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$item_code= $exp[$i];
				$qty= numberreplace($expqty[$i]);
				$unit_price= numberreplace($expunit_price[$i]);
				$discount_id = $expdiscount_id[$i];
				
				if ($item_code != "") { 	
					$uom_code	=	"pcs";
					//$amount		=	$qty * $unit_price;
					
					//get discount
					$sqlstr="select ifnull(value,0) value from discount where id='$discount_id'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$datadiscount=$sql->fetch(PDO::FETCH_OBJ);
					$discount = $datadiscount->value;
					$discount = ($discount * $unit_price)/100;
					$amount   = ($unit_price - $discount) * $qty;
					//$amount   = $amount - $discount;
					
					$sqlstr="select ref from sales_order_detail where ref='$ref' and item_code='$item_code'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rows=$sql->rowCount();
					
					if($rows == 0) {						
						$line = maxline('sales_order_detail', 'line', 'ref', $ref, '');
						
						//RS = Ready Stock
						$sqlstr="insert into sales_order_detail (ref, item_code, uom_code, qty, discount_id, discount, unit_price, amount, item_status, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$discount_id', '$unit_price', '$amount', 'RS', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
					} else {
						
						//$amount		=	$qty * $unit_price;
						
						//get discount
						$sqlstr="select ifnull(value,0) value from discount where id='$discount_id'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$datadiscount=$sql->fetch(PDO::FETCH_OBJ);
						$discount = $datadiscount->value;
						$discount = ($discount * $unit_price)/100;
						$amount   = ($unit_price - $discount) * $qty;
						//$amount   = $amount - $discount;
					
						$sqlstr="update sales_order_detail set qty='$qty', unit_price='$unit_price', discount_id='$discount_id', discount='$discount', amount='$amount' where ref='$ref' and item_code='$item_code'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
				
				}
			}
			
			
			//----------insert item detail PO
			$item_code_po = $_POST["item_code_po"];
			$exp_po = explode("|", $item_code_po);
			
			$qty_po = $_POST["qty_po"];
			$expqty_po = explode("|", $qty_po);
			
			$unit_price_po = $_POST["unit_price_po"];
			$expunit_price_po = explode("|", $unit_price_po);
			
			$discount_id_po = $_POST["discount_id_po"];
			$expdiscount_id_po = explode("|", $discount_id_po);
			
			$jmldata_po = count($exp_po);  //(empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			$i=0;
			for ($i=0; $i<=$jmldata_po; $i++) {
				
				$item_code= $exp_po[$i];
				$qty= numberreplace($expqty_po[$i]);
				$unit_price= numberreplace($expunit_price_po[$i]);
				$discount_id = $expdiscount_id_po[$i];
				
				if ($item_code != "") { 	
					$uom_code	=	"pcs";
					//$amount		=	$qty * $unit_price;
					
					//get discount
					$sqlstr="select ifnull(value,0) value from discount where id='$discount_id'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$datadiscount=$sql->fetch(PDO::FETCH_OBJ);
					$discount = $datadiscount->value;
					$discount = ($discount * $unit_price)/100;
					$amount   = ($unit_price - $discount) * $qty;
					//$amount   = $amount - $discount;
					
					$sqlstr="select ref from sales_order_detail where ref='$ref' and item_code='$item_code'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rows=$sql->rowCount();
					
					if($rows == 0) {						
						$line = maxline('sales_order_detail', 'line', 'ref', $ref, '');
						
						//RS = Ready Stock
						$sqlstr="insert into sales_order_detail (ref, item_code, uom_code, qty, discount_id, discount, unit_price, amount, item_status, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$discount_id', '$unit_price', '$amount', 'PO', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
					} else {
						
						//$amount		=	$qty * $unit_price;
						
						//get discount
						$sqlstr="select ifnull(value,0) value from discount where id='$discount_id'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$datadiscount=$sql->fetch(PDO::FETCH_OBJ);
						$discount = $datadiscount->value;
						$discount = ($discount * $unit_price)/100;
						$amount   = ($unit_price - $discount) * $qty;
						//$amount   = $amount - $discount;
					
						$sqlstr="update sales_order_detail set qty='$qty', unit_price='$unit_price', discount_id='$discount_id', discount='$discount', amount='$amount' where ref='$ref' and item_code='$item_code'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
				
				}
			}
			
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$transfer_date	=	date("Y-m-d", strtotime($_POST["transfer_date"]));
			$status			= 	$_POST["status"];
			$employee_id	= 	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			$newclient		= 	(empty($_POST["newclient"])) ? 0 : $_POST["newclient"];
			$client_code	=	$_POST["client_code"];
			$client_code_new	=	$_POST["client_code_new"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			##cek client
			if($client_code_new != "") { //$newclient == 1
				$client_code=	$client_code_new;
				$sqlcek 	= 	"select code from client where name='$client_code' ";	
				$resultcek=$dbpdo->prepare($sqlcek);
				$resultcek->execute();
				$numcek		= $resultcek->rowCount();
				
				if($numcek == 0) {
					$ref_client	=	notran($date, 'frmclient', '', '', ''); //---get no ref
	
					$syscode	= 	random(25);
					$code		=	$ref_client; //substr($client_code,0,3) . $syscode;
					$phone		=	$_POST["phone"];
					$address	=	petikreplace($_POST["address"]);
					$state_id	=	$_POST["state_id"];
					$kabupaten	=	petikreplace($_POST["kabupaten"]);
					$kecamatan	=	petikreplace($_POST["kecamatan"]);
					$zip_code	=	$_POST["zip_code"];
					$client_type=	(empty($_POST["client_type"])) ? 0 : $_POST["client_type"];
					
					$sqlstr 	=	"insert into client (code, name, contact_person, client_type, address, state_id, kabupaten, kecamatan, phone, zip_code, active, syscode, uid, dlu) values ('$code', '$client_code', '$client_code', '$client_type', '$address', '$state_id', '$kabupaten', '$kecamatan', '$phone', '$zip_code', 1, '$syscode', '$uid', '$dlu')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					notran($date, 'frmclient', 1, '', '') ; //----eksekusi ref
					
					$client_code =	$syscode;			
				} else {
					$sqlcek 	= 	"select syscode from client where name='$client_code' ";
					$resultcek=$dbpdo->prepare($sqlcek);
					$resultcek->execute();
					$datacek		= $resultcek->fetch(PDO::FETCH_OBJ);
					
					$client_code =	$datacek->syscode;
				}
			}
			
			//get total amount
			$sqlstr="select sum(amount) total_amount from sales_order_detail where ref='$ref' group by ref";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data=$sql->fetch(PDO::FETCH_OBJ);
			$total=$data->total_amount;
			//-------------------
			
			$qo_ref				=	$_POST["qo_ref"];
			$top				=	$_POST["top"];
			$tax_code			=	$_POST["tax_code"];
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$freight_cost 		= 	numberreplace($_POST["freight_cost"]);
			$freight_account	= 	$_POST["freight_account"];
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);
			$memo				= 	$_POST["memo"];
			$total				=	$total + $freight_cost; //$sub_total; //numberreplace($_POST["total"]);
			
			
			$sqlstr="insert into sales_order (ref, date, status, top, client_code, qo_ref, tax_code, tax_rate, freight_cost, freight_account, currency_code, rate, employee_id, total, transfer_date, memo, uid, dlu) values('$ref', '$date', '$status', '$top', '$client_code', '$qo_ref', '$tax_code', '$tax_rate', '$freight_cost', '$freight_account', '$currency_code', '$rate', '$employee_id', '$total', '$transfer_date', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
			$dbpdo->commit();
		
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert delivery order
	function insert_delivery_order($ref){	
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));			
			$location_id		= 	$_POST["location_id"];
			$po_number			= 	$_POST["po_number"];
			$ship_to			= 	$_POST["ship_to"];
			$client_code		=	$_POST["client_code"];
			$status				= 	$_POST["status"];
			$memo				= 	$_POST["memo"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$select 		= $_POST['select_'.$i.''];
				
				$item_code 		= $_POST['item_code_'.$i.''];
				$uom_code 		= $_POST['uom_code_'.$i.''];
							
				if ( !empty($item_code) && !empty($uom_code) && $select > 0 ) {					
					$so_ref 		= $_POST['so_ref_'.$i.''];
					$qty 			= numberreplace($_POST['qty_'.$i.'']);
					$unit_price		= numberreplace($_POST['unit_price_'.$i.'']);
					$discount		= numberreplace($_POST['discount_'.$i.'']);
					$ship_date 		= date("Y-m-d", strtotime($_POST['ship_date_'.$i.'']));
					$line_item_so	= $_POST['so_line_'.$i.''];
					
					$line = maxline('delivery_order_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into delivery_order_detail (ref, so_ref, item_code, uom_code, qty, unit_price, discount, ship_date, line_item_so, line) values ('$ref', '$so_ref', '$item_code', '$uom_code', '$qty', '$unit_price', '$discount', '$ship_date', '$line_item_so', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//insert bincard
					$unit_price = $unit_price - $discount;
					$amount = $unit_price * $qty;
					$expired_date = $date;
					$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'delivery_order', '$memo', '$item_code', '$uom_code', '$expired_date', '$unit_price', '0', '$qty', '$amount', $line, '$uid', '$dlu')";		
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					##--------update qty sales invoice
					$sqlstr="update sales_invoice_detail set qty_shp=ifnull(qty_shp,0) + $qty where ref='$so_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_so' ";	
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();

					$sqlstr="update sales_invoice set process_whs=1 where ref='$so_ref'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$sql2 = "select sum(ifnull(qty,0)) qty, sum(ifnull(qty_shp,0)) qty_shp from sales_invoice_detail group by ref having ref='$so_ref'";
					$result=$dbpdo->prepare($sql2);
					$result->execute();
					$data = $result->fetch(PDO::FETCH_OBJ);
					
					$qty_shp = $data->qty_shp;
					$qty = $data->qty;
					
					if($qty_shp > 0) {
						if($qty_shp < $qty ) {
							$sqlstr="update sales_invoice set status='S' where ref='$so_ref' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
						}
						
						if($qty_shp >= $qty ) {
							$sqlstr="update sales_invoice set status='F' where ref='$so_ref' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
					}
					##*****************************************##
					
				}
			}
			
			$sqlstr="insert into delivery_order (ref, date, status, location_id, ship_to, po_number, client_code, memo, uid, dlu) values('$ref', '$date', '$status', '$location_id', '$ship_to', '$po_number', '$client_code', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
				
			$dbpdo->commit();
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	//-----insert promo
	function insert_promo(){
		$dbpdo = DB::create();
		
		try {
					
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into promo (name, active, uid, dlu) values ('$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert vendor type
	function insert_vendor_type(){		
		$dbpdo = DB::create();
		
		try {
			
			$name				=	$_POST["name"];		
			$location_id 	=	0;
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into vendor_type (name, pch_account, pch_return_account, pch_discount_account, vendor_deposit_account, currency_account, cheque_payable_account, location_id, active, uid, dlu) values('$name', '$pch_account', '$pch_return_account', '$pch_discount_account', '$vendor_deposit_account', '$currency_account', '$cheque_payable_account', '$location_id', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//-------get last ID
			$sqlid 		= "select last_insert_id() lastid";
			$resultid=$dbpdo->prepare($sqlid);
			$resultid->execute();
			$dataid		= $resultid->fetch(PDO::FETCH_OBJ);
			
			$lastid		= $dataid->lastid;	
			//-------------------/\
			
			//----------insert detail
			/*$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$pch_account		=	$_POST[pch_account_.$i];
				$pch_cash_account		=	$_POST[pch_cash_account_.$i];
				$pch_return_account	=	$_POST[pch_return_account_.$i];
				$pch_discount_account	=	$_POST[pch_discount_account_.$i];
				$vendor_deposit_account	=	$_POST[vendor_deposit_account_.$i];
				$currency_account		=	$_POST[currency_account_.$i];
				$cheque_payable_account	=	$_POST[cheque_payable_account_.$i];
				$hutang_belum_faktur	=	$_POST[hutang_belum_faktur_.$i];
				$location_id	=	(empty($_POST[location_id_.$i])) ? 0 : $_POST[location_id_.$i];
				
				if ( $location_id > 0 ) {
								
					$line = maxline('vendor_type_detail', 'line', 'id_header', $lastid, '');
					
					$sqlstr="insert into vendor_type_detail (id_header, pch_account, pch_cash_account, pch_return_account, pch_discount_account, vendor_deposit_account, currency_account, cheque_payable_account, hutang_belum_faktur, location_id, line) values ('$lastid', '$pch_account', '$pch_cash_account', '$pch_return_account', '$pch_discount_account', '$vendor_deposit_account', '$currency_account', '$cheque_payable_account', '$hutang_belum_faktur', '$location_id', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();							
					
				}
			}*/
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert vendor
	function insert_vendor($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$ref; //petikreplace($_POST["code"]);
			$name			=	petikreplace($_POST["name"]);
			$contact_person	=	$_POST["contact_person"];
			$vendor_type	=	(empty($_POST["vendor_type"])) ? 0 : $_POST["vendor_type"];
			$address		=	$_POST["address"];
			$zip_code		=	$_POST["zip_code"];
			$country_id		=	(empty($_POST["country_id"])) ? 0 : $_POST["country_id"];
			$state_id		=	(empty($_POST["state_id"])) ? 0 : $_POST["state_id"];
			$phone			=	$_POST["phone"];
			$fax			=	$_POST["fax"];
			$email			=	$_POST["email"];
			$web			=	$_POST["web"];		
			$bank_account	=	$_POST["bank_account"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$syscode		= 	random(9);
			
			$sqlstr="insert into vendor (code, name, contact_person, vendor_type, address, zip_code, country_id, state_id, phone, fax, email, web, bank_account, active, uid, dlu, syscode) values ('$code', '$name', '$contact_person', '$vendor_type', '$address', '$zip_code', '$country_id', '$state_id', '$phone', '$fax', '$email', '$web', '$bank_account', '$active', '$uid', '$dlu', '$syscode')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert sewing
	function insert_sewing($ref, $ref_tmp){	
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));
			$location_id		=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			$memo				= 	petikreplace($_POST["memo"]);
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			$sub_total = 0;
			for ($i=0; $i<=$jmldata; $i++) {
				
				$item_code 		= $_POST[item_code_.$i];
				$uom_code 		= $_POST[uom_code_.$i];
				
				if ( !empty($item_code) && !empty($uom_code) ) {							
					$qty = numberreplace($_POST[qty_.$i]);
					$unit_cost = numberreplace($_POST[unit_cost_.$i]);
					$size 		= numberreplace($_POST[size_.$i]);
					$discount = numberreplace($_POST[discount_.$i]);
	                $discount1 = numberreplace($_POST[discount3_1_.$i]);
	                $discount2 = numberreplace($_POST[discount3_2_.$i]);
					$amount = numberreplace($_POST[amount_.$i]); //$qty * $unit_cost; //numberreplace($_POST[amount_.$i]);
					$line = maxline('sewing_detail', 'line', 'ref', $ref, '');

					$sqlstr="insert into sewing_detail (ref, item_code, uom_code, size, qty, unit_cost, discount1, discount2, amount, counting_line, qty_good, qty_damaged, remark_damaged, status_damaged, qty_do, line) values ('$ref', '$item_code', '$uom_code', '$size', '$qty', '$unit_cost', '$discount1', '$discount2', '$amount', '0', '$qty_good', '0', '', '$status_damaged', '0', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//----------insert bincard (debit qty)
					$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'sewing', '$memo', '$item_code', '$uom_code', '$unit_cost', '0', '$qty', '$amount', '$line', '$uid', '$dlu')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$sub_total = $sub_total + $amount;
					
					
					
				}
			}
			
			
			$finish_date		=	date("Y-m-d", strtotime($_POST["finish_date"]));
			$due_date			=	$finish_date;
			$status				= 	$_POST["status"];				
			$client_code		=	$_POST["client_code"];
			$vendor_code		= 	$_POST["vendor_code"];
			$payment_type		=	$_POST["payment_type"];
			
			//set employee_id
			$employee_id_multi	= $_POST[operator];
			$employee_id = "";
			for($q=0; $q<count($employee_id_multi); $q++) {
				if(empty($employee_id)) {
					$employee_id = $employee_id_multi[$q];
				} else {
					$employee_id = $employee_id_multi[$q] . ", " . $employee_id;	
				}
			}
			//---------/\--------
		
			$qc_date			=	date("Y-m-d", strtotime($_POST["qc_date"]));
			$total				=	numberreplace($_POST["total"]);
			
			$sqlstr="insert into sewing (ref, date, finish_date, status, client_code, location_id, vendor_code, payment_type, memo, employee_id, qc_date, qc_uid, total_amount, uid, dlu) values('$ref', '$date', '$finish_date', '$status', '$client_code', '$location_id', '$vendor_code', '$payment_type', '$memo', '$employee_id', '$qc_date', '$uid', '$total', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
			//insert AP
			if ($payment_type == "credit") { //|| $payment_type == "consign") {
				$currency_code 	= 1; //IDR
				$rate			= 0;				
				$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'V', '$vendor_code', '', 0, '$total', 'sewing', 'sewing', '$currency_code', '$rate', '', '', '$top', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			
			}
			
			
			//-------delete sewing tmp
			$sqlstr="delete from sewing_tmp where ref='$ref_tmp' and uid='$uid' ";
		    $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
			$dbpdo->commit();
		
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert good receipt
	function insert_good_receipt($ref){	
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));	
			$vendor_code		= 	$_POST["vendor_code"];		
			$location_id		= 	$_POST["location_id"];
			$driver				= 	$_POST["driver"];
			$date_arrival		= 	date("Y-m-d", strtotime($_POST["date_arrival"]));
			$do_ref				= 	$_POST["do_ref"];
			$vehicle			=	$_POST["vehicle"];
			$status				= 	$_POST["status"];
			$memo				= 	petikreplace($_POST["memo"]);
			$receipt_type		=	$_POST["receipt_type"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$select 		= $_POST['select_'.$i.''];
				
				$item_code 		= $_POST['item_code_'.$i.''];
				$uom_code 		= $_POST['uom_code_'.$i.''];
				$size 			= numberreplace($_POST['size_'.$i.'']);
				$qty 			= numberreplace($_POST['qty_'.$i.'']);
				$qty_po			= numberreplace($_POST['qty_po_'.$i.'']);
				$status_det		= $_POST['status_'.$i.''];
							
				if ( !empty($item_code) && !empty($uom_code) && $qty > 0 ) {					
					$po_ref 		= $_POST['po_ref_'.$i.''];
					$unit_cost		= numberreplace($_POST['unit_cost_'.$i.'']);
					$pi_line		= $_POST['pi_line_'.$i.''];
					
					$line = maxline('good_receipt_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into good_receipt_detail (ref, item_code, uom_code, size, po_ref, qty_po, qty, unit_cost, pi_line, status, line) values ('$ref', '$item_code', '$uom_code', '$size', '$po_ref', '$qty_po', '$qty', '$unit_cost', '$pi_line', '$status_det', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//insert bincard
					if($status_det == 'Good') {
						$amount = $unit_cost * $qty;
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'good_receipt', '$memo', '$item_code', '$uom_code', '00:00:00', '$unit_cost', '$qty', '0', '$amount', $line, '$uid', '$dlu')";		
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
					if($receipt_type == "Pembelian") {
						##--------update qty sales order
						$sqlstr="update purchase_invoice_detail set qty_good=ifnull(qty_good,0) + $qty where ref='$po_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$pi_line' ";	
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sql2 = "select sum(ifnull(qty,0)) qty, sum(ifnull(qty_good,0)) qty_good from purchase_invoice_detail group by ref having ref='$po_ref'";
						$result=$dbpdo->prepare($sql2);
						$result->execute();
						$data = $result->fetch(PDO::FETCH_OBJ);
						
						$qty_good = $data->qty_good;
						$qty = $data->qty;
						
						if($qty_good > 0) {
							if($qty_good < $qty ) {
								$sqlstr="update purchase_invoice set status='S' where ref='$po_ref' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							}
							
							if($qty_good >= $qty ) {
								$sqlstr="update purchase_invoice set status='F' where ref='$po_ref' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						}
						
						if($qty_good <= 0) { //Released
							$sqlstr="update purchase_invoice set status='R' where ref='$po_ref' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
						##*****************************************##
					}
					
					
					if($receipt_type == "Jahit") {
						##--------update qty sewing
						$sqlstr="update sewing_detail set qty_good=ifnull(qty_good,0) + $qty where ref='$po_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$pi_line' ";	
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$sql2 = "select sum(ifnull(qty,0)) qty, sum(ifnull(qty_good,0)) qty_good from sewing_detail group by ref having ref='$po_ref'";
						$result=$dbpdo->prepare($sql2);
						$result->execute();
						$data = $result->fetch(PDO::FETCH_OBJ);
						
						$qty_good = $data->qty_good;
						$qty = $data->qty;
						
						if($qty_good > 0) {
							if($qty_good < $qty ) { //Kirim
								$sqlstr="update sewing set status='D' where ref='$po_ref' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							}
							
							if($qty_good >= $qty ) { //Selesai
								$sqlstr="update sewing set status='F' where ref='$po_ref' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						}
						
						if($qty_good <= 0) { //Jahit
							$sqlstr="update sewing set status='S' where ref='$po_ref' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
						##*****************************************##
					}
					
					
					
				}
			}
			
			$sqlstr="insert into good_receipt (ref, date, status, vendor_code, date_arrival, driver, vehicle, location_id, do_ref, memo, receipt_type, uid, dlu) values('$ref', '$date', '$status', '$vendor_code', '$date_arrival', '$driver', '$vehicle', '$location_id', '$do_ref', '$memo', '$receipt_type', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$dbpdo->commit();	
		
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	//-----insert outbound
	function insert_outbound($ref, $ref_detail){	
		$dbpdo = DB::create();
		
		try {
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));	
			$status				= 	$_POST["status"];
			$type				= 	$_POST["type"];
			$reason				= 	$_POST["reason"];
			$form_no			= 	$_POST["form_no"];
			$warehouse_id_from	=	(empty($_POST["warehouse_id_from"])) ? 0 : $_POST["warehouse_id_from"];
			$warehouse_id_to	=	(empty($_POST["warehouse_id_to"])) ? 0 : $_POST["warehouse_id_to"];
			$employee_id		=	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			$employee_id2		=	(empty($_POST["employee_id2"])) ? 0 : $_POST["employee_id2"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into outbound (ref, date, status, type, reason, form_no, warehouse_id_from, warehouse_id_to, employee_id, employee_id2, uid, dlu) values('$ref', '$date', '$status', '$type', '$reason', '$form_no', '$warehouse_id_from', '$warehouse_id_to', '$employee_id', '$employee_id2', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//----------insert item packing detail
			/*$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {*/
				$item_code 		= $_POST['item_code'];
				$uom_code 		= $_POST['uom_code'];
				$expired_date 	= date('Y-m-d');
							
				if ( !empty($item_code) && !empty($uom_code) ) {				
					$qty 			= numberreplace($_POST['qty']);
					
					$line = maxline('outbound_detail', 'line', 'ref', $ref, '');
									
					$sqlstr="insert into outbound_detail (ref, item_code, uom_code, qty, line) values ('$ref', '$item_code', '$uom_code', '$qty', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					
					if($status == 'C') {
						//----------insert bincard (credit qty) ======>FROM
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$warehouse_id_from', '$date', 'outbound', '$reason', '$item_code', '$uom_code', '$expired_date', 0, 0, '$qty', 0, '$line', '$uid', '$dlu')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						//----------insert bincard (debit qty)  ========>TO
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$warehouse_id_to', '$date', 'outbound', '$reason', '$item_code', '$uom_code', '$expired_date', 0, '$qty', 0, 0, '$line', '$uid', '$dlu')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
				}
			//}
			
			##delete tmp data
			$sqlstr="delete from outbound_tmp where ref='$ref_detail' and uid='$uid'";
            $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert outbound detail
	function insert_outbound_detail($ref){	
		
		$dbpdo = DB::create();
		
		try {
		
			$warehouse_id_from	= 	$_POST['warehouse_id_from'];	
			$warehouse_id_to	=	$_POST['warehouse_id_to'];	
			$item_code 		= 	$_POST['item_code'];
	        $item_code2		= 	$_POST['item_code2'];
			$uom_code 		= 	$_POST['uom_code'];			
	        $qty 		    = 	numberreplace($_POST['qty']);
	        $employee_id	=	$_POST["employee_id"];
			$employee_id2	=	$_POST["employee_id2"];
					
					
	        //----------jika lookup gagal enter
	        $sqlstr 	= "select syscode, uom_code_stock uom_code from item where (code='$item_code2' or old_code='$item_code2') limit 1";
	        $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data 	= $sql->fetch(PDO::FETCH_OBJ); 
			
			if($item_code == '') {
				$item_code 	= $data->syscode;	
			}
			
			if($uom_code == '') {
				$uom_code	= $data->uom_code;	
			}
			
			
			if($qty == '' || $qty == 0) {
				$qty = 1;
			}
			
			//---------------------------------/\
			
	       
	        if ( empty($item_code) && empty($uom_code) ) {
	            $sqlstr 	    = "select syscode, uom_code_stock uom_code from item where (code='$item_code2' or old_code='$item_code2') limit 1";
	            $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data		= $sql->fetch(PDO::FETCH_OBJ);
				
				$item_code  = $data->syscode;
	            $uom_code   = $data->uom_code; 
	            
	            $qty        = 1;
	            
	        }
	        
	        if($warehouse_id_to == "") {
				$sqlstr = "select warehouse_id_to from outbound_tmp where ref='$ref' and warehouse_id_to <> 0 limit 1";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data=$sql->fetch(PDO::FETCH_OBJ);
				
				$warehouse_id_to = $data->warehouse_id_to;
			}
	        
						
			if ( !empty($item_code) && !empty($uom_code) ) {		
			
				$sqlstr="select sum(qty) qty, item_code from outbound_tmp where ref='$ref' and item_code='$item_code' and	uom_code='$uom_code' group by ref, item_code, uom_code";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows=$sql->rowCount();
				$data=$sql->fetch(PDO::FETCH_OBJ);
				
				$uid	= 	$_SESSION["loginname"];
					        
				if($rows >0) {
					$qty = $data->qty + $qty; //1;
					
					$sqlstr="update outbound_tmp set qty='$qty' where ref='$ref' and item_code='$item_code' and uom_code='$uom_code'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
				
					$line = maxline('outbound_tmp', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into outbound_tmp (ref, warehouse_id_from, warehouse_id_to, employee_id, employee_id2, item_code, uom_code, qty, uid, line) values ('$ref', '$warehouse_id_from', '$warehouse_id_to', '$employee_id', '$employee_id2', '$item_code', '$uom_code', '$qty', '$uid', $line)";
		            $sql=$dbpdo->prepare($sqlstr);
					$sql->execute();	
				}
										
			}	
				
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert uom
	function insert_uom(){		
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into uom (code, name, active, uid, dlu) values('$code', '$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert division
	function insert_division(){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into division (name, active, uid, dlu) values('$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert position
	function insert_position(){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into position (name, active, uid, dlu) values ('$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert colour
	function insert_colour(){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into colour (name, active, uid, dlu) values('$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert sewing detail
	function insert_sewing_detail($ref){	
		
		$dbpdo = DB::create();
		
		try {
		
			$date			= date("Y-m-d", strtotime($_POST['date']));
			$finish_date	= date("Y-m-d", strtotime($_POST['finish_date']));
			$location_id	= $_POST['location_id'];
			$payment_type	= $_POST["payment_type"];		
			$item_code 		= $_POST['item_code'];
	        $item_code2		= $_POST['item_code2'];
			$uom_code 		= $_POST['uom_code'];
			$size 	    	= numberreplace($_POST['size']);
	        $qty 		    = numberreplace($_POST['qty']);
	        $unit_cost     	= numberreplace($_POST['unit_cost']);
	        $amount 	    = numberreplace($_POST['amount']);
	        $cash			=	(empty($_POST["cash"])) ? 0 : $_POST["cash"];
	        $vendor_code	=	$_POST["vendor_code"];
	        
	        $memo 			= petikreplace($_POST['memo']);
	        
	        //set employee_id
			$employee_id_multi	= $_POST["operator"];
			$employee_id = "";
			for($q=0; $q<count($employee_id_multi); $q++) {
				if(empty($employee_id)) {
					$employee_id = $employee_id_multi[$q];
				} else {
					$employee_id = $employee_id_multi[$q] . ", " . $employee_id;	
				}
			}
			//---------/\--------
					
	        //----------jika lookup gagal enter
	        $sqlstr 	= "select syscode, uom_code_stock uom_code from item where (code='$item_code2' or old_code='$item_code2') limit 1";
	        $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data 	= $sql->fetch(PDO::FETCH_OBJ); 
			
			if($item_code == '') {
				$item_code 	= $data->syscode;	
			}
			
			if($uom_code == '') {
				$uom_code	= $data->uom_code;	
			}
			
			
			/*$sqlprice = "select b.current_cost, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_stock='$uom_code' order by b.date_of_record desc limit 1 ";
			$resultprice=$dbpdo->prepare($sqlprice);
			$resultprice->execute();
			$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);*/
			
			if($unit_cost == '' || $unit_cost == 0) {
				$unit_cost	= 0; //$dataprice->current_cost;	
			}
			
			if($qty == '' || $qty == 0) {
				$qty = 1;
			}
			
			if($amount == '' || $amount == 0) {
				$amount			= 0; //$dataprice->current_cost * 1;	
			}
			//---------------------------------/\
			
	       
	        if ( empty($item_code) && empty($uom_code) ) {
	            $sqlstr 	    = "select syscode, uom_code_stock uom_code from item where (code='$item_code2' or code='$item_code2') limit 1";
	            $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data		= $sql->fetch(PDO::FETCH_OBJ);
				
				$item_code  = $data->syscode;
	            $uom_code   = $data->uom_code; 
	            
	            /*$sqlprice = "select b.current_cost, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_stock='$uom_code' and b.location_id='$location_id' order by b.date_of_record desc limit 1 ";
	            $resultprice=$dbpdo->prepare($sqlprice);
				$resultprice->execute();
				$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);*/
				
			    $unit_cost	    = 0; //$dataprice->current_cost;
	            $qty            = 1;
	            $amount         = $unit_price * $qty;
	            
	        }
						
			if ( !empty($item_code) && !empty($uom_code) ) {		
			
				$discount_det	= numberreplace($_POST['discount_det']);			
				$discount 		= $discount_det; //numberreplace($_POST['discount']);
	            $discount1 		= numberreplace($_POST['discount3_1_det']);
	            $discount2 		= numberreplace($_POST['discount3_2_det']);
	            $discount3 		= numberreplace($_POST['discount3_3_det']);
				$total	 		= numberreplace($_POST['total']);
				
				$uid			= $_SESSION["loginname"];
								
				$sqlstr="select sum(qty) qty, item_code from sewing_tmp where ref='$ref' and vendor_code='$vendor_code' and item_code='$item_code' and uom_code='$uom_code' group by ref, vendor_code, item_code, uom_code";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows=$sql->rowCount();
				$data=$sql->fetch(PDO::FETCH_OBJ);
				
				if($rows >0) {
					$qty = $data->qty + $qty;
					$amount = ($qty * ($unit_cost - $discount));
					//$amount = $qty * $unit_cost;
					$total = $amount;
					
					$sqlstr="update sewing_tmp set date='$date', finish_date='$finish_date', payment_type='$payment_type', qty='$qty', size='$size', location_id='$location_id', memo='$memo', unit_cost='$unit_cost', discount1='$discount1', discount2='$discount2', amount='$amount', total='$total' where ref='$ref' and vendor_code='$vendor_code' and item_code='$item_code' and uom_code='$uom_code'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
				
					$line = maxline('sewing_tmp', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into sewing_tmp (ref, date, finish_date, vendor_code, payment_type, item_code, uom_code, size, qty, discount1, discount2, unit_cost, amount, total, location_id, employee_id, memo, uid, line) values ('$ref', '$date', '$finish_date', '$vendor_code', '$payment_type', '$item_code', '$uom_code', '$size', '$qty', '$discount1', '$discount2', '$unit_cost', '$amount', '$total', '$location_id', '$employee_id', '$memo', '$uid', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();	
				}
										
			}	
				
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert client type
	function insert_client_type(){		
		$dbpdo = DB::create();
		
		try {
			
			$name			=	$_POST["name"];		
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into client_type (name, active, uid, dlu) values('$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert new product
	function insert_new_product($code){		
		$dbpdo = DB::create();
		
		try {
			
			//$code			=	$_POST["code"];
			$old_code		=	$_POST["old_code"];
			$name			=	petikreplace($_POST["name"]);
			$item_group_id	=	(empty($_POST["item_group_id"])) ? 0 : $_POST["item_group_id"];
			$item_subgroup_id	=	(empty($_POST["item_subgroup_id"])) ? 0 : $_POST["item_subgroup_id"];
			$item_type_code		=	$_POST["item_type_code"];
			$item_category_id	=	(empty($_POST["item_category_id"])) ? 0 : $_POST["item_category_id"];
			$brand_id			=	(empty($_POST["brand_id"])) ? 0 : $_POST["brand_id"];
			$size_id			= 	$_POST["size_id"];  //	(empty($_POST["size_id"])) ? 0 : $_POST["size_id"];
			$uom_code_stock		=	$_POST["uom_code_stock"];
			$uom_code_sales		=	$uom_code_stock; //$_POST["uom_code_sales"];
			$uom_code_purchase	=	$uom_code_stock; //$_POST["uom_code_purchase"];
			$minimum_stock		=	numberreplace((empty($_POST["minimum_stock"])) ? 0 : $_POST["minimum_stock"]);
			$maximum_stock		=	numberreplace((empty($_POST["maximum_stock"])) ? 0 : $_POST["maximum_stock"]);
			
			$consigned		=	(empty($_POST["consigned"])) ? 0 : $_POST["consigned"];
			$balance		=	numberreplace($_POST["balance"]);
			$description	=	petikreplace($_POST["description"]);
			$po_date		=	date("Y-m-d", strtotime($_POST["po_date"]));
			$photo_date		=	date("Y-m-d", strtotime($_POST["photo_date"]));
			$catalog_date	=	date("Y-m-d", strtotime($_POST["catalog_date"]));
			$publish_date	=	date("Y-m-d", strtotime($_POST["publish_date"]));
			$designer		=	petikreplace($_POST["designer"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$publish		=	$active;
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$syscode		= 	random(25);
			
			//-----------upload file
		  	$photo2				= $_POST["photo2"];
			$uploaddir_photo 	= 'app/photo_item/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $syscode . '_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			$sqlstr="insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, balance, description, development, publish, po_date, photo_date, catalog_date, publish_date, designer, active, uid, dlu, syscode) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$balance', '$description', 1, '$publish', '$po_date', '$photo_date', '$catalog_date', '$publish_date', '$designer', '$active', '$uid', '$dlu', '$syscode')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*---------insert audit trail (insert)------------*/
			/*$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$active', '$uid', '$dlu', '$syscode', 'insert' )";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();*/
			
			
			##execute otomatis number
			$sqlstr="select a.code from item_group a where a.id='$item_group_id'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			
			notran($date, 'frmitembarcode', 1, '', $data->code);
			
			
			#insert/update set item cost
			$item_code	=	$syscode;
			$uom_code	=	$uom_code_purchase;
			$date_cost			=	date("Y-m-d", strtotime($_POST['date_cost']));
			$efective_from_cost	=	date("Y-m-d", strtotime($_POST['efective_from_cost']));
			
			$point_first_order	=	numberreplace($_POST["point_first_order"]);
			$current_cost		=	numberreplace($_POST['current_cost']);
			$bonus_basic		=	numberreplace($_POST["bonus_basic"]);
			$bonus_prestation	=	numberreplace($_POST["bonus_prestation"]);
			$bonus_unilevel		=	numberreplace($_POST["bonus_unilevel"]);
			$matching_sponsor	=	numberreplace($_POST["matching_sponsor"]);
			$reward				=	numberreplace($_POST["reward"]);
			$repeat_order		=	numberreplace($_POST["repeat_order"]);
			$royalti			=	numberreplace($_POST["royalti"]);
			$total_budget		=	numberreplace($_POST["total_budget"]);
			
			$fo_point			=	numberreplace($_POST["fo_point"]);
			$ro_point			=	numberreplace($_POST["ro_point"]);
			
			if($date_cost == "1970-01-01") {
				$date_cost = date("Y-m-d");
			}
			
			if($efective_from_cost == "1970-01-01") {
				$efective_from_cost = date("Y-m-d");
			}
			
			
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id_cost	=	$_POST['location_id_cost'];
			
			/*$sqlstr = "select item_code, current_cost from set_item_cost where item_code='$item_code' and uom_code='$uom_code' and current_cost='$current_cost'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$last_cost = $data->current_cost;
			
			if($rows == 0) {*/
			
			$sqlstr = "insert into set_item_cost (date, efective_from, item_code, uom_code, current_cost, point_first_order, bonus_basic, bonus_prestation, bonus_unilevel, matching_sponsor, reward, repeat_order, royalti, total_budget, last_cost, fo_point, ro_point, date_of_record, location_id, uid, dlu) values('$date_cost', '$efective_from_cost', '$item_code', '$uom_code', '$current_cost', '$point_first_order', '$bonus_basic', '$bonus_prestation', '$bonus_unilevel', '$matching_sponsor', '$reward', '$repeat_order', '$royalti', '$total_budget', '$last_cost', '$fo_point', '$ro_point', '$date_of_record', '$location_id_cost', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*} else {
				$sqlstr = "update set_item_cost set efective_from='$efective_from_cost', uom_code='$uom_code', current_cost='$current_cost', last_cost='$last_cost', date_of_record='$date_of_record', location_id='$location_id_cost', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}*/
			
			
			#insert/update set item price
			$item_code	=	$syscode;
			$uom_code	=	$uom_code_sales;
			$current_price	=	numberreplace($_POST['current_price']);
			$current_price1	=	numberreplace($_POST['current_price1']);
			$current_price2	=	numberreplace($_POST['current_price2']);
			$current_price3	=	numberreplace($_POST['current_price3']);
			
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$price_tax			=	numberreplace($_POST["price_tax"]);
			$price_member_tax	=	numberreplace($_POST["price_member_tax"]);
			$margin_warehouse	=	numberreplace($_POST["margin_warehouse"]);
			$margin_mlm			=	numberreplace($_POST["margin_mlm"]);
			$registration_rate	=	numberreplace($_POST["registration_rate"]);
			$registration_rate_platinum =	numberreplace($_POST["registration_rate_platinum"]);
			
			$date			=	date("Y-m-d", strtotime($_POST['date']));
			if($date == "1970-01-01") {
				$date = date("Y-m-d");
			}
			$efective_from	=	date("Y-m-d", strtotime($_POST['efective_from']));
			if($efective_from == "1970-01-01") {
				$efective_from = date("Y-m-d");
			}
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id	=	$_POST['location_id'];
			$non_discount	=	$_POST['non_discount'];
			$qty1			=	numberreplace($_POST['qty1']);
			$qty2			=	numberreplace($_POST['qty2']);
			$qty3			=	numberreplace($_POST['qty3']);
			$qty4			=	numberreplace($_POST['qty4']);
			
			/*$sqlstr = "select item_code, current_price from set_item_price where item_code='$item_code' and uom_code='$uom_code' and current_price='$current_price'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$last_price = $data->current_price;
			
			if($rows == 0) {*/
				$sqlstr = "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, tax_rate, price_tax, price_member_tax, margin_warehouse, margin_mlm, registration_rate, registration_rate_platinum, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$tax_rate', '$price_tax', '$price_member_tax', '$margin_warehouse', '$margin_mlm', '$registration_rate', '$registration_rate_platinum', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				//audit trail insert
				$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'insert')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
			/*} else {
				$sqlstr = "update set_item_price set efective_from='$efective_from', uom_code='$uom_code', current_price='$current_price', current_price1='$current_price1', current_price2='$current_price2', current_price3='$current_price3', last_price='$last_price', date_of_record='$date_of_record', location_id='$location_id', non_discount='$non_discount', qty1='$qty1', qty2='$qty2', qty3='$qty3', qty4='$qty4', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				//update audit trail
				$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'update')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}*/
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert finance type
	function insert_finance_type($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$ref; //$_POST["code"];
	        $name			=	petikreplace($_POST["name"]);
	        $location_id	=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
	        $type			=	$_POST["type"];
	        $account_code	=	$_POST["account_code"];
	        $active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
						
			$sqlstr="insert into finance_type (code, name, location_id, type, account_code, active, uid, dlu) values ('$code', '$name', '$location_id', '$type', '$active', '$account_code', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
	
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//------general journal in
	function insert_general_journal_in($ref){
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date			=	date('Y-m-d', strtotime($_POST["date"]));
			$status			= 	$_POST["status"];
			$currency_code	= 	$_POST["currency_code"];
			$rate			=	str_replace(",","",(empty($_POST["rate"])) ? 0 : $_POST["rate"]);
			$memo			= 	$_POST["memo"];
			$total_balance	=	str_replace(",","",(empty($_POST["total_balance"])) ? 0 : $_POST["total_balance"]);
			$total_debit	=	str_replace(",","",(empty($_POST["total_debit"])) ? 0 : $_POST["total_debit"]);
			$total_credit	=	str_replace(",","",(empty($_POST["total_credit"])) ? 0 : $_POST["total_credit"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into general_journal(ref, date, status, currency_code, rate, memo, total_balance, total_debit, total_credit, uid, dlu) values('$ref', '$date', '$status', '$currency_code', '$rate', '$memo', '$total_balance', '$total_debit', '$total_credit', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$account_code 		= $_POST[account_code_.$i];
				$memo2 				= $_POST[memo_.$i];
				$debit_amount		= str_replace(",","",(empty($_POST[debit_amount_.$i])) ? 0 : $_POST[debit_amount_.$i]);
				$credit_amount		= str_replace(",","",(empty($_POST[credit_amount_.$i])) ? 0 : $_POST[credit_amount_.$i]);
				
				if ($account_code != '') { 		
					
					$line = maxline('general_journal_detail', 'line', 'ref', $ref, '');
					
					$sqlstr = "insert into general_journal_detail(ref, account_code, memo, debit_amount, credit_amount, line) values('$ref', '$account_code', '$memo2', '$debit_amount', '$credit_amount', '$line') ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
				
			}
			
			$dbpdo->commit();
	
		}		
	
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert employee_basic_salary
	function insert_employee_basic_salary($ref){
		$dbpdo = DB::create();
		
		try {
			
			$employee_id		=	$ref;
			$efective_date		=	date("Y-m-d", strtotime($_POST["efective_date"]));
			$salary				=	numberreplace($_POST["salary"]);
			$position_allowance	=	numberreplace($_POST["position_allowance"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$line = maxline('employee_basic_salary', 'line', 'employee_id', $ref, '');
			
			$sqlstr="insert into employee_basic_salary (employee_id, efective_date, salary, position_allowance, uid, dlu, line) values ('$employee_id', '$efective_date', '$salary', '$position_allowance', '$uid', '$dlu', '$line')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert salary
	function insert_salary($ref){
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$employee_id	=	$_POST["employee_id"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			//detail
			$total = 0;
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$amount 		= numberreplace($_POST[amount_.$i]);
				$salary_type_id	= $_POST[salary_type_id_.$i];
				$memo			= petikreplace($_POST[memo_.$i]);
				
				if ($amount > 0 && $salary_type_id != "") { 		
					
					$line = maxline('salary_detail', 'line', 'ref', $ref, '');
					
					$sqlstr = "insert into salary_detail(ref, salary_type_id, amount, memo, line) values('$ref', '$salary_type_id', '$amount', '$memo', '$line') ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$total = $total + $amount;
				}
				
			}
			
			$sqlstr="insert into salary (ref, date, employee_id, total, uid, dlu) values ('$ref', '$date', '$employee_id', '$total', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$dbpdo->commit();
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------minute_meet
	function insert_minute_meet($ref){
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$date			=	date('Y-m-d', strtotime($_POST["date"]));
			
			//set member_id
			$member_id_multi	= $_POST[member_id];
			$member_id = "";
			for($q=0; $q<count($member_id_multi); $q++) {
				if(empty($member_id)) {
					$member_id = $member_id_multi[$q];
				} else {
					$member_id = $member_id_multi[$q] . ", " . $member_id;	
				}
			}
			//---------/\--------
						
			$subject		=	petikreplace($_POST["subject"]);
			$division_id	= 	$_POST["division_id"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into minute_meet(ref, date, member_id, subject, division_id, uid, dlu) values('$ref', '$date', '$member_id', '$subject', '$division_id', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$sub_subject 	= petikreplace($_POST[sub_subject_.$i]);
				$problem 		= petikreplace($_POST[problem_.$i]);
				$improvement	= petikreplace($_POST[improvement_.$i]);
				$due_date		= date("Y-m-d", strtotime($_POST[due_date_.$i]));
				$pic			= $_POST[pic_.$i];
				
				if ($sub_subject != '') { 		
					
					$line = maxline('minute_meet_detail', 'line', 'ref', $ref, '');
					
					$sqlstr = "insert into minute_meet_detail(ref, sub_subject, problem, improvement, due_date, pic, line) values('$ref', '$sub_subject', '$problem', '$improvement', '$due_date', '$pic', '$line') ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
				
			}
			
			$dbpdo->commit();
	
		}		
	
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert payment
	function insert_payment($ref){	
		
		$dbpdo = DB::create();
		
		try {
			
	        $date			=	date("Y-m-d", strtotime($_POST["date"]));
			$vendor_code	=	$_POST["vendor_code"];
			$memo			= 	$_POST["memo"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
						
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			$sub_total = 0;
			for ($i=0; $i<=$jmldata; $i++) {
				$select 		= $_POST[select_.$i];
				
				$invoice_no 	= $_POST[invoice_no_.$i];
				$amount_paid 	= numberreplace($_POST[amount_paid_.$i]);
							
				if ( !empty($invoice_no) && $amount_paid <> 0 && $select == 1 ) {
					
					$invoice_date		= date("Y-m-d", strtotime($_POST[invoice_date_.$i]));
					$invoice_due_date	= date("Y-m-d", strtotime($_POST[invoice_due_date_.$i]));
					$amount_due		= numberreplace($_POST[amount_due_.$i]);
					$discount 		= numberreplace($_POST[discount_.$i]);
					$currency_code 	= $_POST[currency_code_.$i];					
					$rate			= numberreplace($_POST[rate_.$i]);
					$ref_type		= $_POST[transaction_.$i];				
					$amount_due		= numberreplace($_POST[amount_due_.$i]);
					$amount 		= $amount_paid - $discount; //numberreplace($_POST[amount_.$i]);
					
					$line = maxline('payment_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into payment_detail (ref, invoice_no, invoice_date, invoice_due_date, discount, amount_paid, invoice_currency_code, invoice_rate, ref_type, amount_due, amount, line) values ('$ref', '$invoice_no', '$invoice_date', '$invoice_due_date', '$discount', '$amount_paid', '$currency_code', '$rate', '$ref_type', '$amount_due', '$amount', $line)";
	                $sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//insert AP
					$sqlv = "select a.* from (select syscode code, name, 'V' type from vendor where active=1 union all
			  select syscode code, concat(name,' (',phone,')') name, 'C' type from client where active=1 and ifnull(name,'') <> '' union all select id code, concat(name, ' ( ','Employee',' )') name, 'E' type from employee where active=1 ) a where a.code='$vendor_code'";
			  		$resultv=$dbpdo->prepare($sqlv);
					$resultv->execute();
					$datav		= $resultv->fetch(PDO::FETCH_OBJ);
					
			  		$typev = $datav->type;
			  		
			  		if($ref_type == 'PIR') {
			  			##credit
			  			if($amount < 0) {
							$amount_credit = $amount * -1;
						}
						$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, line, uid, dlu) values('$ref', '$invoice_no', '$date', '$invoice_due_date', '$typev', '$vendor_code', '', 0, '$amount_credit', '$discount', 'PMT', '$ref_type', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', $line, '$uid', '$dlu')";
	                	$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						##debit
						$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, line, uid, dlu) values('$ref', '$invoice_no', '$date', '$invoice_due_date', '$typev', '$vendor_code', '', '$amount', 0, '$discount', 'PMT', '$ref_type', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', $line, '$uid', '$dlu')";
	                	$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
						
					
				}
			}
			
							
			$status				= 	$_POST["status"];		
			$payment_type		=	$_POST["payment_type"];
			$cheque_no			=	$_POST["cheque_no"];
			$cheque_date		=	date("Y-m-d", strtotime($_POST["cheque_date"]));
			$bank_name			=	$_POST["bank_name"];
			$credit_card_no		=	$_POST["credit_card_no"];
			$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
			$credit_card_holder	=	$_POST["credit_card_holder"];
			$credit_card_expired =	date("Y-m-d", strtotime($_POST["credit_card_expired"]));
			$account_code		= 	$_POST["account_code"];
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);			
			$amount				=	numberreplace($_POST["amount"]);
			
			$round_amount		=	numberreplace($_POST["round_amount"]);
			$round_amount_account	=	$_POST["round_amount_account"];
			if($round_amount == 0) {
				$round_amount_account = "";	
			}
			
			$bank_charge		=	numberreplace($_POST["bank_charge"]);
			$bank_charge_account	= 	$_POST["bank_charge_account"];
			if($bank_charge == 0) {
				$bank_charge_account = "";
			}
			
			$sub_total			=	numberreplace($_POST["sub_total"]);
			$deposit			=	numberreplace($_POST["deposit"]);
			$type				=	$_POST["type"];
			$no_ttfa			=	$_POST["no_ttfa"];
			
			$total				=	numberreplace($_POST["total"]);
			  	
			$sqlstr="insert into payment (ref, date, status, vendor_code, payment_type, cheque_no, cheque_date, bank_name, credit_card_no, credit_card_code, credit_card_holder, credit_card_expired, account_code, currency_code, rate, amount, deposit, sub_total, type, memo, round_amount, round_amount_account, bank_charge, bank_charge_account, opening_balance, total, no_ttfa, uid, dlu) values('$ref', '$date', '$status', '$vendor_code', '$payment_type', '$cheque_no', '$cheque_date', '$bank_name', '$credit_card_no', '$credit_card_code', '$credit_card_holder', '$credit_card_expired', '$account_code', '$currency_code', '$rate', '$amount', '$deposit', '$sub_total', '$type', '$memo', '$round_amount', '$round_amount_account', '$bank_charge', '$bank_charge_account', '0', '$total', '$no_ttfa', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			if($payment_type == "giro" || $payment_type == "cheque") {
				
				//insert APC
				//$sqlstr="insert into apc (ref, date, vendor_code, cheque_no, bank_name, cheque_date, amount, currency_code, rate, account_code, type, memo, uid, dlu) values('$ref', '$date', '$vendor_code', '$cheque_no', '$bank_name', '$cheque_date', '$total', '$currency_code', '$rate', '$account_code', '$receipt_type', '$memo', '$uid', '$dlu')";
				//QueryDbTrans($sql, $success);
                
                //--------detail giro
                $jmldatabg = (empty($_POST['jmldatabg'])) ? 0 : $_POST['jmldatabg'];
        		
                $i = 0;
        		for ($i=0; $i<=$jmldatabg; $i++) {
        			
        			$account_code    = $_POST[account_code_.$i];
                    $cheque_no       = $_POST[cheque_no_.$i];
                    $bank_name       = $_POST[bank_name_.$i];
                    $cheque_date     = date("Y-m-d", strtotime($_POST["cheque_date_.$i"]));
                    $amountbg      	 = numberreplace($_POST[amountbg_.$i]);
        						
        			if ( !empty($account_code) && !empty($cheque_no) && $amountbg <> 0 ) {
        				
                        //insert APC
        				$sqlstr="insert into payment_giro (ref, account_code, cheque_no, bank_name, cheque_date, amountbg, line) values('$ref', '$account_code', '$cheque_no', '$bank_name', '$cheque_date', '$amountbg', '$i')";
        				$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
                        
        				//insert APC
        				$sqlstr="insert into apc (ref, date, vendor_code, cheque_no, bank_name, cheque_date, amount, currency_code, rate, account_code, type, uid, dlu, line) values('$ref', '$date', '$vendor_code', '$cheque_no', '$bank_name', '$cheque_date', '$amountbg', '$currency_code', '$rate', '$account_code', '$receipt_type', '$uid', '$dlu', $i)";
                        $sql=$dbpdo->prepare($sqlstr);
						$sql->execute();	
        				
        			}
        		}				
				
			}
				
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert receipt
	function insert_receipt($ref){	
		$dbpdo = DB::create();
		
		try {
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$client_code	=	$_POST["client_code"];
			$memo			= 	$_POST["memo"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			$sub_total = 0;
			for ($i=0; $i<$jmldata; $i++) {
				$select 		= $_POST[select_.$i];
				
				$invoice_no 	= $_POST[invoice_no_.$i];
				$amount_paid 	= numberreplace($_POST[amount_paid_.$i]);
							
				if ( !empty($invoice_no) && $amount_paid <> 0 && $select == 1 ) {
					
					$invoice_date		= date("Y-m-d", strtotime($_POST[invoice_date_.$i]));
					$invoice_due_date	= date("Y-m-d", strtotime($_POST[invoice_due_date_.$i]));
					$amount_due		= numberreplace($_POST[amount_due_.$i]);
					$discount 		= numberreplace($_POST[discount_.$i]);
					$currency_code 	= $_POST[currency_code_.$i];					
					$rate			= numberreplace($_POST[rate_.$i]);
					$ref_type		= $_POST[transaction_.$i];				
					$amount_due		= numberreplace($_POST[amount_due_.$i]);
					$amount 		= $amount_paid - $discount; //numberreplace($_POST[amount_.$i]);
					
					$line = maxline('receipt_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into receipt_detail (ref, invoice_no, invoice_date, invoice_due_date, discount, amount_paid, invoice_currency_code, invoice_rate, ref_type, amount_due, amount, line) values ('$ref', '$invoice_no', '$invoice_date', '$invoice_due_date', '$discount', '$amount_paid', '$currency_code', '$rate', '$ref_type', '$amount_due', '$amount', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//insert AR
					$sqlc = "select a.* from (select id code, concat(name, ' ( ','Employee',' )') name, 'E' type from employee where active=1 union all  select syscode code, concat(name,' (',phone,')') name, 'C' type from client where active=1 and ifnull(name,'') <> '' ) a where a.code='$client_code'";
					$resultc=$dbpdo->prepare($sqlc);
					$resultc->execute();
					$datac		= $resultc->fetch(PDO::FETCH_OBJ);
					
			  		$typec = $datac->type;
					
					if($ref_type != "DPS") {
						
						if($ref_type == 'SIR') {
				  			##credit
				  			if($amount < 0) {
								$amount_debit = $amount * -1;
							}
							$sqlstr="insert into ar(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$invoice_no', '$date', '$invoice_due_date', '$typec', '$client_code', '', '$amount_debit', 0, '$discount', 'RCI', '$ref_type', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', '$uid', '$dlu')";
		                	$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						} else {
						
							$sqlstr="insert into ar(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$invoice_no', '$date', '$invoice_due_date', '$typec', '$client_code', '', 0, '$amount', '$discount', 'RCI', '$ref_type', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}	
					}
					
					//insert DPS (deposit)
					if($ref_type == "DPS") {
						if($amount < 0) {
							
							$credit = $amount * -1;
							
							$sqlstr="insert into dps(ref, invoice_no, date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$invoice_no', '$date', 'C', '$client_code', '', 0, '$credit', 'RCI', 'RCI', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
						}
					}
					
					
					//update status sales
					$sqlstr = "select sum(ifnull(debit_amount,0)) - sum(ifnull(credit_amount,0)) balance from ar where invoice_no='$invoice_no' group by invoice_no ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$data=$sql->fetch(PDO::FETCH_OBJ);
					if($data->balance > 0) {
						$sqlstr = "update sales_invoice set status='I' where ref='$invoice_no'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
				}
			}
		
			
			$status				= 	$_POST["status"];			
			$receipt_type		=	$_POST["receipt_type"];
			$cheque_no			=	$_POST["cheque_no"];
			$cheque_date		=	date("Y-m-d", strtotime($_POST["cheque_date"]));
			$bank_name			=	$_POST["bank_name"];
			$credit_card_no		=	$_POST["credit_card_no"];
			$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
			$credit_card_holder	=	$_POST["credit_card_holder"];
			$credit_card_expired =	date("Y-m-d", strtotime($_POST["credit_card_expired"]));
			$account_code		= 	$_POST["account_code"];
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);			
			$amount				=	numberreplace($_POST["amount"]);
			
			$round_amount		=	numberreplace($_POST["round_amount"]);
			$round_amount_account	=	$_POST["round_amount_account"];
			if($round_amount == 0) {
				$round_amount_account = "";	
			}
			
			$bank_charge		=	numberreplace($_POST["bank_charge"]);
			$bank_charge_account	= 	$_POST["bank_charge_account"];
			if($bank_charge == 0) {
				$bank_charge_account = "";
			}
			
			$sub_total			=	numberreplace($_POST["sub_total"]);
			$deposit			=	numberreplace($_POST["deposit"]);
			$type				=	$_POST["type"];
			
			$total				=	numberreplace($_POST["total"]);
			
			//------------start upload photo
	  		/*include_once ("app/include/function_crop.php");
	  		
	  		$file_transfer		= 	$_POST["file_transfer"];
	  		$file_transfer1 	= 	resize_image('file_transfer', 'file_transfer/', 'app/file_transfer/', 'file_transfer/', $ref."_".$file_transfer);
	  		$file_transfer_a 	= 	$file_transfer1;*/
			  	
			$sqlstr="insert into receipt (ref, date, status, client_code, receipt_type, cheque_no, cheque_date, bank_name, credit_card_no, credit_card_code, credit_card_holder, credit_card_expired, account_code, currency_code, rate, amount, deposit, sub_total, type, memo, round_amount, round_amount_account, bank_charge, bank_charge_account, opening_balance, total, uid, dlu) values('$ref', '$date', '$status', '$client_code', '$receipt_type', '$cheque_no', '$cheque_date', '$bank_name', '$credit_card_no', '$credit_card_code', '$credit_card_holder', '$credit_card_expired', '$account_code', '$currency_code', '$rate', '$amount', '$deposit', '$sub_total', '$type', '$memo', '$round_amount', '$round_amount_account', '$bank_charge', '$bank_charge_account', '0', '$total', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			if($receipt_type == "giro" || $receipt_type == "cheque") {
				
				//insert ARC
				$sqlstr="insert into arc (ref, date, client_code, cheque_no, bank_name, cheque_date, amount, currency_code, rate, account_code, type, memo, uid, dlu) values('$ref', '$date', '$client_code', '$cheque_no', '$bank_name', '$cheque_date', '$total', '$currency_code', '$rate', '$account_code', '$receipt_type', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();				
				
			}
			
			//insert DPS (Deposit)
			if($deposit < 0) {
				
				$debit = $deposit * -1;
				
				$sqlstr="insert into dps (ref, invoice_no, date, contact_code, contact_type, debit_amount, currency_code, rate, description, invoice_type, ref_type, uid, dlu) values ('$ref', '$ref', '$date', '$client_code', 'C', '$debit', '$currency_code', '$rate', '$memo', 'RCI', 'RCI', '$uid', '$dlu') ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
									
				
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert weekly_assignment_work
	function insert_weekly_assignment_work(){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into weekly_assignment_work (name, active, uid, dlu) values ('$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert regular_item
	function insert_regular_item(){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into regular_item (name, active, uid, dlu) values ('$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert schedule_promo
	function insert_schedule_promo(){
		$dbpdo = DB::create();
		
		try {
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$promo_id		=	$_POST["promo_id"];
			$item_code		=	$_POST["item_code"];
			$note			=	petikreplace($_POST["note"]);
			$hastag			=	petikreplace($_POST["hastag"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$line = maxline('schedule_promo', 'line', 'promo_id', $promo_id, '');
			
			$sqlstr="insert into schedule_promo (date, promo_id, item_code, note, hastag, uid, dlu, line) values ('$date', '$promo_id', '$item_code', '$note', '$hastag', '$uid', '$dlu', '$line')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert schedule_regular_item
	function insert_schedule_regular_item(){
		$dbpdo = DB::create();
		
		try {
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$regular_item_id=	$_POST["regular_item_id"];
			$item_code		=	$_POST["item_code"];
			$note			=	petikreplace($_POST["note"]);
			$hastag			=	petikreplace($_POST["hastag"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$line = maxline('schedule_regular_item', 'line', 'regular_item_id', $regular_item_id, '');
			
			$sqlstr="insert into schedule_regular_item (date, regular_item_id, item_code, note, hastag, uid, dlu, line) values ('$date', '$regular_item_id', '$item_code', '$note', '$hastag', '$uid', '$dlu', '$line')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert insert_set_journal
	function insert_set_journal(){
		$dbpdo = DB::create();
		
		try {
			
			$location_id		=	$_POST["location_id"];
			$account_code_debit	=	$_POST["account_code_debit"];
			$account_code_credit=	$_POST["account_code_credit"];
			$trans_name			=	$_POST["trans_name"];
			$column_name		=	petikreplace($_POST["column_name"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into set_journal (location_id, account_code_debit, account_code_credit, trans_name, column_name, uid, dlu) values ('$location_id', '$account_code_debit', '$account_code_credit', '$trans_name', '$column_name', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert brand
	function insert_brand(){		
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into brand (code, name, active, uid, dlu) values('$code', '$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert pos direct
	function insert_pos_direct($ref, $xndf, $ref_tmp){	
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			date_default_timezone_set('Asia/Jakarta');
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$status			= 	'R'; //$_POST["status"];
			$due_date		=	date("Y-m-d");
			$total			=	numberreplace($_POST["total"]); //$sub_total; 
			$cash_amount	=	numberreplace($_POST["cash_amount"]);
			$cash_voucher	=	numberreplace($_POST["cash_voucher"]);
			$change_amount	=	numberreplace($_POST["change_amount"]);
			$phone			=	$_POST["phone"];
			$ship_to		=	petikreplace($_POST["ship_to"]);
			$bill_to		=	petikreplace($_POST["bill_to"]);
			$shift			=	$_POST["shift"];
			$uid			=	$_SESSION["loginname"];
			
			$dlu			=	date("Y-m-d H:i:s");
			
			##cek data untuk menghindari data double
			$sqlstr = "select uid, dlu from sales_invoice where uid='$uid' and dlu='$dlu'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rowsdata=$sql->rowCount();
			if($rowsdata == 0) {
				
				$sqlstr = "select uid, dlu from sales_invoice where uid='$uid' and DATE_ADD( dlu, INTERVAL 1 
SECOND)='$dlu'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rowsdata1=$sql->rowCount();
				if($rowsdata1 == 0) {
				
					/*$sqlstr = "select uid, dlu from sales_invoice where date='$date' and due_date='$due_date' and total='$total' and cash_amount='$cash_amount' and cash_voucher='$cash_voucher' and change_amount='$change_amount' and shift='$shift' and uid='$uid' and uid='$uid' and DATE_ADD( dlu, INTERVAL 25 
SECOND)>'$dlu'";*/
					/*$sqlstr = "select uid, dlu from sales_invoice where date='$date' and due_date='$due_date' and total='$total' and cash_amount='$cash_amount' and cash_voucher='$cash_voucher' and change_amount='$change_amount' and shift='$shift' and uid='$uid' and uid='$uid' and DATE_ADD( dlu, INTERVAL 17 
SECOND)>'$dlu'";*/
					$sqlstr = "select uid, dlu from sales_invoice where uid='$uid' and DATE_ADD( dlu, INTERVAL 17 SECOND)='$dlu'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata2=$sql->rowCount();
					if($rowsdata2 == 0) {
						
						//-------start insert-----------------
						$location_id	=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
						
						$client_member_code	=	$_POST["client_member_code"];
						/*if($client_member_code == "") {
							$client_member_code2	=	$_POST["client_member_code2"];
							$sqlcln = "select syscode from client where rtrim(ltrim(code))='$client_member_code2' ";
							$sql=$dbpdo->prepare($sqlcln);
							$sql->execute();
							$data   = $sql->fetch(PDO::FETCH_OBJ);
							$client_member_code = $data->syscode;
						}*/
						
						$cash			=	(empty($_POST["cash"])) ? 0 : $_POST["cash"];
						
						
						
						##insert outbount (pengeluaran barang ke toko)
						//$ref_outbound = $this->insert_outbound_pos($date, 'P', 'T', '', '', '', $location_id, 0, $uid, $dlu);
						
						//----------insert item packing detail
						$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
						$sub_total = 0;
						for ($i=0; $i<=$jmldata; $i++) {
							$so_ref 		= $_POST[so_ref_.$i];
							$so_line 		= $_POST[so_line_.$i];
							
							$item_code 		= $_POST[item_code_.$i];
							$uom_code 		= $_POST[uom_code_.$i];
							$select			= $_POST[select_.$i];
							
							if ( !empty($item_code) && !empty($uom_code) && $select==1 ) {
													
								$qty = numberreplace($_POST[qty_.$i]);
								$unit_price = numberreplace($_POST[unit_price_.$i]);
								$discount = numberreplace($_POST[discount_.$i]);
				                $discount3 = numberreplace($_POST[discount3_.$i]);
								$amount = numberreplace($_POST[amount_.$i]);
								$non_discount = (empty($_POST[non_discount_.$i])) ? 0 : $_POST[non_discount_.$i];
								
								//get cogs
								$sqlprice = "select b.cogs, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
								$resultprice=$dbpdo->prepare($sqlprice);
								$resultprice->execute();
								$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
								$unit_cost	= $dataprice->cogs;	
								$amount_cost= $qty * $unit_cost;
								
								$line = maxline('sales_invoice_detail', 'line', 'ref', $ref, '');
								
								$sqlstr="insert into sales_invoice_detail (ref, so_ref, item_code, uom_code, qty, discount, discount3, unit_price, amount, non_discount, unit_cost, amount_cost, line_item_so, line) values ('$ref', '$xndf', '$item_code', '$uom_code', '$qty', '$discount', '$discount3', '$unit_price', '$amount', '$non_discount', '$unit_cost', '$amount_cost', '$so_line', '$line')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();								
								
								//----------insert bincard (debit qty) && update sales order
								if($status != 'P') {
									$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'pos', '', '$item_code', '$uom_code', '$unit_price', 0, '$qty', '$amount', '$line', '$uid', '$dlu')";				
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();	
									
									//update sales order
									$sqlstr="update sales_order_detail set qty_sales=qty_sales + $qty where ref='$so_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$so_line'";				
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
								}
								
								$sub_total = $sub_total + $amount;
								
								
								##insert outbound detail (pengeluaran barang ke toko)
								/*$ref_pos = $ref;
								$this->insert_outbound_pos_detail($ref_outbound, $item_code, $uom_code, $qty, $ref_pos);*/
								
								
							}
						}
						
						
						//detail employee
						/*$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];
						for ($x=0; $x<=$jmldata2; $x++) {
							$line2 = maxline('sales_invoice_employee', 'line', 'ref', $ref, '');
							
							//detail capster
							$get_epy = $_POST[get_epy_.$x];
							if($get_epy == 1) {
								
								$employee_id = $_POST[employee_id_.$x];
								
								$sqlstr="insert into sales_invoice_employee (ref, employee_id, line) values ('$ref', '$employee_id', $line2)";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
						}*/
						
							
							$newclient		=	(empty($_POST["newclient"])) ? 0 : $_POST["newclient"];	
							$client_code	=	$_POST["client_code"];
							
							
							$employee_id		= 	$_POST["employee_id"];						
							$top				=	"C.O.D";
							$tax_code			=	"";
							$tax_rate			=	0;
							$freight_cost 		= 	0;
							$freight_account	= 	"";
							$currency_code		=	"";
							$rate				=	0;
							$memo				= 	$_POST["memo"];
							$discount2			=	numberreplace($_POST["discount"]);
							$deposit			=	0;		
							$commision_rate		=	numberreplace($_POST["commision_rate"]);
							$total_member		=	numberreplace($_POST["total"]);
							
							$photo_file			= 	""; 
							
							$bank_id			=	(empty($_POST["bank_id"])) ? 0 : $_POST["bank_id"];
							$bank_amount		=	numberreplace($_POST["bank_amount2"]);
							$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
							$card_amount		=	numberreplace($_POST["card_amount"]);
							$credit_card_no		=	$_POST["credit_card_no"];
							$credit_card_holder	=	petikreplace($_POST["credit_card_holder"]);
							
							//update status sales order (Paid)
							$sqlstr = "update sales_order set status='D' where ref='$xndf'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						
							$sqlstr="insert into sales_invoice (ref, ref2, date, status, top, due_date, client_code, ship_to, bill_to, tax_code, tax_rate, freight_cost, freight_account, currency_code, rate, employee_id, discount, total, memo, opening_balance, cash, location_id, deposit, taxable, photo_file, cash_amount, cash_voucher, bank_id, bank_amount, credit_card_code, card_amount, credit_card_no, credit_card_holder, change_amount, shift, client_member_code, commision_rate, phone, uid, dlu) values('$ref', '$ref2', '$date', '$status', '$top', '$due_date', '$client_code', '$ship_to', '$bill_to', '$tax_code', '$tax_rate', '$freight_cost', '$freight_account', '$currency_code', '$rate', '$employee_id', '$discount2', '$total', '$memo', 0, '$cash', '$location_id', '$deposit', '$taxable', '$photo_file', '$cash_amount', '$cash_voucher', '$bank_id', '$bank_amount', '$credit_card_code', '$card_amount', '$credit_card_no', '$credit_card_holder', '$change_amount', '$shift', '$client_member_code', '$commision_rate', '$phone', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
				            ##jika piutang
				            if($cash == 0) {
								
								$total = $total - $deposit;
								//insert AR
								if($status != 'P') {
									$sqlstr="insert into ar(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'C', '$client_code', '', '$total', 0, 'cashier', 'pos', '$currency_code', '$rate', '', '', '$top', '$memo', '$uid', '$dlu')";
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
								}
							}
				            //-----------
				            
			            
						}
					}
				} 
				
	            //update sales order (paid)
	            /*$sqlstr="update sales_order set paid=1 where ref='$ref_tmp' ";
			    $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
	            //-------delete invoice detail tmp
				$sqlstr="delete from sales_invoice_tmp where ref='$ref_tmp' and uid='$uid' ";
			    $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();*/
				
				$dbpdo->commit();
		
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert purchase return
	function insert_purchase_return($ref){	
		
		$dbpdo = DB::create();
		
		try {
		
	        $date		=	date("Y-m-d", strtotime($_POST["date"]));
			$status		= 	$_POST["status2"];
			$pi_ref		=	$_POST["pi_ref"];
	        $memo		= 	$_POST["memo"];
	        $uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			//----------insert item return detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			$sub_total = 0;
			for ($i=0; $i<=$jmldata; $i++) {
				$select 		= $_POST[select_.$i];
				
				$item_code 		= $_POST[item_code_.$i];
				$uom_code 		= $_POST[uom_code_.$i];
							
				if ( !empty($item_code) && !empty($uom_code) && $select==1 ) {
					$qty = numberreplace($_POST[qty_.$i]);
					$unit_cost = numberreplace($_POST[unit_cost_.$i]);
					$discount = numberreplace($_POST[discount_.$i]);
					$amount = numberreplace($_POST[amount_.$i]);
					
					$line_item_pi	= $_POST[line_item_pi_.$i];
					
					$line = maxline('purchase_return_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into purchase_return_detail (ref, item_code, uom_code, qty, discount, unit_cost, amount, line_item_pi, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$unit_cost', '$amount', '$line_item_pi', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$sub_total = $sub_total + $amount;
					
					##--------update qty purchase invoice
					if($status != "P") {
						$sqlstr="update purchase_invoice_detail set qty_rtn=ifnull(qty_rtn,0) + $qty where ref='$pi_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_pi' ";	
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();					
						##*****************************************##
	                    
	                    //get location ID
	                    $sqlpi = "select location_id from purchase_invoice where ref='$pi_ref'";
	                    $resultpi=$dbpdo->prepare($sqlpi);
						$resultpi->execute();
						$datapi		= $resultpi->fetch(PDO::FETCH_OBJ);
						
	                    $location_id = $datapi->location_id;
	                    
	                    //----------bincard (debit_qty)
						$amount = $qty * $unit_cost;
						
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_return', '$memo', '$item_code', '$uom_code', '$unit_cost', '0', '$qty', '$amount', '$line', '$uid', '$dlu')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
					}
					
				}
			}
			
									
			$vendor_code		=	$_POST["vendor_code"];			
			$tax_code			=	$_POST["tax_code"];
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);			
			$total				=	$sub_total; //numberreplace($_POST["total"]);
			
			$sqlstr="insert into purchase_return (ref, date, status, vendor_code, pi_ref, tax_code, tax_rate, currency_code, rate, total, memo, uid, dlu) values('$ref', '$date', '$status', '$vendor_code', '$pi_ref', '$tax_code', '$tax_rate', '$currency_code', '$rate', '$total', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//insert AP
			$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '1900-01-01', 'V', '$vendor_code', '', '$total', 0, 'PIR', 'PIR', '$currency_code', '$rate', '', '', '', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
				
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----insert sales return
	function insert_sales_return($ref){	
		
		$dbpdo = DB::create();
		
		try {
		
			$date				=	date("Y-m-d", strtotime($_POST["date"]));
			$status				= 	$_POST["status2"];
			$memo				= 	$_POST["memo"];
			$si_ref				=	$_POST["si_ref"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
				
			//----------insert item return detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			$sub_total = 0;
			for ($i=0; $i<=$jmldata; $i++) {
				$select 		= $_POST['select_'.$i.''];
				
				$item_code 		= $_POST['item_code_'.$i.''];
				$uom_code 		= $_POST['uom_code_'.$i.''];
							
				if ( !empty($item_code) && !empty($uom_code) && $select==1 ) {
					$qty = numberreplace($_POST['qty_'.$i.'']);
					$unit_price = numberreplace($_POST['unit_price_'.$i.'']);
					$discount = numberreplace($_POST['discount_'.$i.'']);
					$charge_p = numberreplace($_POST['charge_p_'.$i.'']);
					$charge = 0;
					$amount = numberreplace($_POST['amount_'.$i.'']);
					
					$line_item_si	= $_POST['line_item_si_'.$i.''];
					
					$line = maxline('sales_return_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into sales_return_detail (ref, item_code, uom_code, qty, discount, unit_price, charge_p, charge, amount, line_item_si, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$unit_price', '$charge_p', '$charge', '$amount', '$line_item_si', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$sub_total = $sub_total + $amount;
					
					##--------update qty sales invoice
					if($status == "R") {
						$sqlstr="update sales_invoice_detail set qty_rtn=ifnull(qty_rtn,0) + $qty where ref='$si_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_si' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						//----------insert bincard (debit qty)
						$sqlsi = "select location_id from sales_invoice where ref='$si_ref' ";
						$sql=$dbpdo->prepare($sqlsi);
						$sql->execute();
						$datasi = $sql->fetch(PDO::FETCH_OBJ);
						$location_id = numberreplace($datasi->location_id);
						
						$expired_date = "00:00:00";
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'sales_return', '$memo', '$item_code', '$uom_code', '$expired_date', '$unit_price', '$qty', 0, '$amount', '$line', '$uid', '$dlu')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						##*****************************************##
						
					}
					
					
				}
			}
			
			$client_code		=	$_POST["client_code"];			
			$reason				=	petikreplace($_POST["reason"]);
			$tax_code			=	$_POST["tax_code"];
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);			
			$total				=	$sub_total; //numberreplace($_POST["total"]);
			
			$sqlstr="insert into sales_return (ref, date, status, client_code, si_ref, tax_code, tax_rate, currency_code, rate, total, reason, memo, uid, dlu) values('$ref', '$date', '$status', '$client_code', '$si_ref', '$tax_code', '$tax_rate', '$currency_code', '$rate', '$total', '$reason', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			##insert AR (credit)
			$tax_rate	=	numberreplace($_POST["tax_rate"]);
			$tax_total	=	($tax_rate * $total) / 100;
			$total	=	$total + $tax_total; // + $total_charge;
			
			$exchange_date = "00:00:00";
			$sqlstr="insert into ar(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '1900-01-01', 'C', '$client_code', '', 0, '$total', 'SIR', 'SIR', '$currency_code', '$rate', '', '$exchange_date', '$top', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}


	//-----insert channel
	function insert_channel(){		
		$dbpdo = DB::create();
		
		try {
			
			$name			=	$_POST["name"];		
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into channel (name, active, uid, dlu) values('$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}


	//-----insert size
	function insert_size(){		
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
			$name			=	$_POST["name"];		
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="insert into size (code, name, active, uid, dlu) values('$code', '$name', '$active', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}


	//-----insert payment_method
	function insert_payment_method(){		
		$dbpdo = DB::create();
		
		try {
			
			$name			=	$_POST["name"];		
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			
			$sqlstr="insert into payment_method (name, active) values('$name', '$active')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}


	//-----insert purchase type
	function insert_purchase_type(){		
		$dbpdo = DB::create();
		
		try {
			
			$name			=	$_POST["name"];		
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			
			$sqlstr="insert into purchase_type (name, active) values('$name', '$active')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}


	//-----insert measuring_size_sewing
	function insert_measuring_size_sewing($ref){	
		
		$dbpdo = DB::create();
		
		try {
			$dbpdo->beginTransaction();
			
			//so_ref, client_code, series, qty, print_ref, press_ref, sampling
			$so_ref			= 	$_POST["so_ref"];
			$client_code 	=	$_POST["client_code"];
			$series  		=	petikreplace($_POST["series"]);
			$br  			=	petikreplace($_POST["br"]);
			$qty  			=	numberreplace($_POST["qty"]);
			$unit_cost 		=	numberreplace($_POST["unit_cost"]);
			$counting_ref 	=	$_POST["counting_ref"];
			$print_ref 		=	$_POST["print_ref"];
			$press_ref 		=	$_POST["press_ref"];
			$sampling 		=	petikreplace($_POST["sampling"]);
			$date 			=	date("Y-m-d", strtotime($_POST["date"]));
			$acc_date_client=	date("Y-m-d", strtotime($_POST["acc_date_client"]));
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");

			//----------update measuring_size_sewing_detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$name			= $_POST["name_".$i.""];
				$size	 		= numberreplace($_POST["size_".$i.""]);
				$uom_code 		= $_POST["uom_code_".$i.""];
				
				if ( !empty($name) ) { //&& !empty($uom_code) 
					
					$line = maxline('measuring_size_sewing_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into measuring_size_sewing_detail (ref, name, size, uom_code, line) values ('$ref', '$name', '$size', '$uom_code', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
																
				}
				
			}
			
			$memo					= 	petikreplace($_POST["memo"]);	
			$mcn_press_speed 		= 	numberreplace($_POST["mcn_press_speed"]);
			$mcn_press_temperature 	= 	numberreplace($_POST["mcn_press_temperature"]);
			$label  				=	numberreplace($_POST["label"]);
			$plat  					=	numberreplace($_POST["plat"]);
			$button  				=	numberreplace($_POST["button"]);
			$pocket  				=	numberreplace($_POST["pocket"]);
			$resleting  			=	numberreplace($_POST["resleting"]);

			/*create folder*/
			$photo_path = 'app/photo_ms';
			if (!file_exists($photo_path) && !is_dir($photo_path)) {
				@mkdir($photo_path, 0777, true);
				@chmod('app/photo_ms', 0777);
				@chmod($photo_path, 0777);
			}
			
			//-----------upload photo
		  	$photo2					= $_POST["photo2x"];
			$uploaddir_photo		= $photo_path .'/';
			$photo					= $_FILES['photo']['name']; 
			$tmpname_photo 			= $_FILES['photo']['tmp_name'];
			$filesize_photo 		= $_FILES['photo']['size'];
			$filetype_photo 		= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} 
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						if (file_exists($photo_path . '/' . $photo2)) {
							unlink($uploaddir_photo . $photo2); //remove file 
						}					
					}
					
					$photo = $ref . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}			
			//---------------------------


			//-----------upload photo1
		  	$photo12				= $_POST["photo12"];
			$uploaddir_photo1		= $photo_path .'/';
			$photo1					= $_FILES['photo1']['name']; 
			$tmpname_photo1 		= $_FILES['photo1']['tmp_name'];
			$filesize_photo1 		= $_FILES['photo1']['size'];
			$filetype_photo1 		= $_FILES['photo1']['type'];
			
			if (empty($photo1)) { 
				$photo1 = $photo12; 
			} 
			
			if($photo1 != "") {
					
				if($photo1 != $photo12) {
					
					if(!empty($photo12)) {
						if (file_exists($photo_path . '/' . $photo12)) {
							unlink($uploaddir_photo1 . $photo12); //remove file 
						}					
					}
					
					$photo1 = $ref . '_' . $photo1;
				}
				$uploaddir_photo1 = $uploaddir_photo1 . $photo1;		
				if (move_uploaded_file($_FILES['photo1']['tmp_name'], $uploaddir_photo1)) {
					echo "";											
				} 	
			}


			//-----------upload photo2
		  	$photo22				= $_POST["photo22"];
			$uploaddir_photo2		= $photo_path .'/';
			$photo2x				= $_FILES['photo2']['name']; 
			$tmpname_photo2 		= $_FILES['photo2']['tmp_name'];
			$filesize_photo2 		= $_FILES['photo2']['size'];
			$filetype_photo2 		= $_FILES['photo2']['type'];
			
			if (empty($photo2x)) { 
				$photo2x = $photo22; 
			} 
			
			if($photo2x != "") {
					
				if($photo2x != $photo22) {
					
					if(!empty($photo22)) {
						if (file_exists($photo_path . '/' . $photo22)) {
							unlink($uploaddir_photo2 . $photo22); //remove file 
						}					
					}
					
					$photo2x = $ref . '_' . $photo2x;
				}
				$uploaddir_photo2 = $uploaddir_photo2 . $photo2x;		
				if (move_uploaded_file($_FILES['photo2']['tmp_name'], $uploaddir_photo2)) {
					echo "";											
				} 	
			}


			//-----------upload photo3
		  	$photo32				= $_POST["photo32"];
			$uploaddir_photo3		= $photo_path .'/';
			$photo3					= $_FILES['photo3']['name']; 
			$tmpname_photo3 		= $_FILES['photo3']['tmp_name'];
			$filesize_photo3 		= $_FILES['photo3']['size'];
			$filetype_photo3 		= $_FILES['photo3']['type'];
			
			if (empty($photo3)) { 
				$photo3 = $photo32; 
			} 
			
			if($photo3 != "") {
					
				if($photo3 != $photo32) {
					
					if(!empty($photo32)) {
						if (file_exists($photo_path . '/' . $photo32)) {
							unlink($uploaddir_photo3 . $photo32); //remove file 
						}					
					}
					
					$photo3 = $ref . '_' . $photo3;
				}
				$uploaddir_photo3 = $uploaddir_photo3 . $photo3;		
				if (move_uploaded_file($_FILES['photo3']['tmp_name'], $uploaddir_photo3)) {
					echo "";											
				} 	
			}


			//-----------upload photo4
		  	$photo42				= $_POST["photo42"];
			$uploaddir_photo4		= $photo_path .'/';
			$photo4					= $_FILES['photo4']['name']; 
			$tmpname_photo4 		= $_FILES['photo4']['tmp_name'];
			$filesize_photo4 		= $_FILES['photo4']['size'];
			$filetype_photo4 		= $_FILES['photo4']['type'];
			
			if (empty($photo4)) { 
				$photo4 = $photo42; 
			} 
			
			if($photo4 != "") {
					
				if($photo4 != $photo42) {
					
					if(!empty($photo42)) {
						if (file_exists($photo_path . '/' . $photo42)) {
							unlink($uploaddir_photo4 . $photo42); //remove file 
						}					
					}
					
					$photo4 = $ref . '_' . $photo4;
				}
				$uploaddir_photo4 = $uploaddir_photo4 . $photo4;		
				if (move_uploaded_file($_FILES['photo4']['tmp_name'], $uploaddir_photo4)) {
					echo "";											
				} 	
			}


			//-----------upload photo5
		  	$photo52				= $_POST["photo52"];
			$uploaddir_photo5		= $photo_path .'/';
			$photo5					= $_FILES['photo5']['name']; 
			$tmpname_photo5 		= $_FILES['photo5']['tmp_name'];
			$filesize_photo5 		= $_FILES['photo5']['size'];
			$filetype_photo5 		= $_FILES['photo5']['type'];
			
			if (empty($photo5)) { 
				$photo5 = $photo52; 
			} 
			
			if($photo5 != "") {
					
				if($photo5 != $photo52) {
					
					if(!empty($photo52)) {
						if (file_exists($photo_path . '/' . $photo52)) {
							unlink($uploaddir_photo5 . $photo52); //remove file 
						}					
					}
					
					$photo5 = $ref . '_' . $photo5;
				}
				$uploaddir_photo5 = $uploaddir_photo5 . $photo5;		
				if (move_uploaded_file($_FILES['photo5']['tmp_name'], $uploaddir_photo5)) {
					echo "";											
				} 	
			}


			//-----------upload photo6
		  	$photo62				= $_POST["photo62"];
			$uploaddir_photo6		= $photo_path .'/';
			$photo6					= $_FILES['photo6']['name']; 
			$tmpname_photo6 		= $_FILES['photo6']['tmp_name'];
			$filesize_photo6 		= $_FILES['photo6']['size'];
			$filetype_photo6 		= $_FILES['photo6']['type'];
			
			if (empty($photo6)) { 
				$photo6 = $photo62; 
			} 
			
			if($photo6 != "") {
					
				if($photo6 != $photo62) {
					
					if(!empty($photo62)) {
						if (file_exists($photo_path . '/' . $photo62)) {
							unlink($uploaddir_photo6 . $photo62); //remove file 
						}					
					}
					
					$photo6 = $ref . '_' . $photo6;
				}
				$uploaddir_photo6 = $uploaddir_photo6 . $photo6;		
				if (move_uploaded_file($_FILES['photo6']['tmp_name'], $uploaddir_photo6)) {
					echo "";											
				} 	
			}


			//-----------upload photo7
		  	$photo72				= $_POST["photo72"];
			$uploaddir_photo7		= $photo_path .'/';
			$photo7					= $_FILES['photo7']['name']; 
			$tmpname_photo7 		= $_FILES['photo7']['tmp_name'];
			$filesize_photo7 		= $_FILES['photo7']['size'];
			$filetype_photo7 		= $_FILES['photo7']['type'];
			
			if (empty($photo7)) { 
				$photo7 = $photo72; 
			} 
			
			if($photo7 != "") {
					
				if($photo7 != $photo72) {
					
					if(!empty($photo72)) {
						if (file_exists($photo_path . '/' . $photo72)) {
							unlink($uploaddir_photo7 . $photo72); //remove file 
						}					
					}
					
					$photo7 = $ref . '_' . $photo7;
				}
				$uploaddir_photo7 = $uploaddir_photo7 . $photo7;		
				if (move_uploaded_file($_FILES['photo7']['tmp_name'], $uploaddir_photo7)) {
					echo "";											
				} 	
			}


			//update counting ms_sewing
			/*$sqlstr="update counting set ms_sewing=1 where ref='$counting_ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

			//update sales_order ms_sewing
			$sqlstr="update sales_order set ms_sewing=1 where ref='$counting_ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();*/
					
			$sqlstr="insert into measuring_size_sewing (ref, date, so_ref, client_code, series, qty, unit_cost, print_ref, press_ref, mcn_press_speed, mcn_press_temperature, counting_ref, sampling, br, memo, photo, photo1, photo2, photo3, photo4, photo5, photo6, photo7, acc_date_client, label, plat, button, pocket, resleting, uid, dlu) values('$ref', '$date', '$so_ref', '$client_code', '$series', '$qty', '$unit_cost', '$print_ref', '$press_ref', '$mcn_press_speed', '$mcn_press_temperature', '$counting_ref', '$sampling', '$br', '$memo', '$photo', '$photo1', '$photo2x', '$photo3', '$photo4', '$photo5', '$photo6', '$photo7', '$acc_date_client', '$label', '$plat', '$button', '$pocket', '$resleting', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$dbpdo->commit();
		
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
		
		return $sql;
	}
	

	//-----insert do_good_receipt_qc
	function insert_do_good_receipt_qc($ref){	
		
		$dbpdo 		= DB::create();
		
		try {
			$dbpdo->beginTransaction();
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			//----------insert item packing detail
			$rcp_ref1 = "";
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			$sub_total = 0;
			for ($i=0; $i<=$jmldata; $i++) {
				
				$do_ref 		= $_POST["do_ref_".$i.""];
				$so_ref 		= $_POST["so_ref_".$i.""];
				$rcp_ref  		= $_POST["rcp_ref_".$i.""];
				$item_code 		= $_POST["item_code_".$i.""];
				$uom_code		= $_POST["uom_code_".$i.""];
				$do_line		= numberreplace($_POST["do_line_".$i.""]);
				$size 			= $_POST["size_".$i.""];
				$qty_rcp 		= numberreplace($_POST["qty_rcp_".$i.""]);
				$qty 			= numberreplace($_POST["qty_".$i.""]);
				$qty_damaged 	= numberreplace($_POST["qty_damaged_".$i.""]);
				$unit_cost 		= numberreplace($_POST["unit_cost_".$i.""]);
				$amount_cost	= numberreplace($_POST["amount_cost_".$i.""]);
				$total_qty 		= $qty + $qty_damaged;

				if($rcp_ref1 == "") {
					$rcp_ref1 = $rcp_ref;
				}

				if ( !empty($item_code) && ($qty>0 || $qty_damaged>0) ) {					
					
					$line = maxline('do_good_receipt_qc_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into do_good_receipt_qc_detail (ref, so_ref, do_ref, rcp_ref, item_code, uom_code, size, unit_cost, amount_cost, do_line, qty_rcp, qty, qty_damaged, line) values ('$ref', '$so_ref', '$do_ref', '$rcp_ref', '$item_code', '$uom_code', '$size', '$unit_cost', '$amount_cost', '$do_line', '$qty_rcp', '$qty', '$qty_damaged', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//update qty do_good_receipt_detail
					$sql2="update good_receipt_detail set qty_qc=ifnull(qty_qc,0) + $qty where ref='$rcp_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$do_line' ";	
					$sql=$dbpdo->query($sql2);

					$sub_total = $sub_total + $amount_cost;
					
				}
			}
			
			
			$date				=	date("Y-m-d", strtotime($date));
			$status				= 	$_POST["status"];
			$vendor_code		=	$_POST["vendor_code"];
			$memo				= 	petikreplace($_POST["memo"]);
			$ms_ref				= 	$_POST["ms_ref"];
			$ms_ref1			= 	$_POST["ms_ref1"];
			$ms_ref2			= 	$_POST["ms_ref2"];

			$label				= 	numberreplace($_POST["label"]);
			$plat				= 	numberreplace($_POST["plat"]);
			$button				= 	numberreplace($_POST["button"]);
			$pocket				= 	numberreplace($_POST["pocket"]);
			$resleting			= 	numberreplace($_POST["resleting"]);

			$label1				= 	numberreplace($_POST["label1"]);
			$plat1				= 	numberreplace($_POST["plat1"]);
			$button1			= 	numberreplace($_POST["button1"]);
			$pocket1			= 	numberreplace($_POST["pocket1"]);
			$resleting1			= 	numberreplace($_POST["resleting1"]);

			$label2				= 	numberreplace($_POST["label2"]);
			$plat2				= 	numberreplace($_POST["plat2"]);
			$button2			= 	numberreplace($_POST["button2"]);
			$pocket2			= 	numberreplace($_POST["pocket2"]);
			$resleting2			= 	numberreplace($_POST["resleting2"]);

			$label_ms				= 	numberreplace($_POST["label_ms"]);
			$plat_ms				= 	numberreplace($_POST["plat_ms"]);
			$button_ms				= 	numberreplace($_POST["button_ms"]);
			$pocket_ms				= 	numberreplace($_POST["pocket_ms"]);
			$resleting_ms			= 	numberreplace($_POST["resleting_ms"]);

			$label_ms1				= 	numberreplace($_POST["label_ms1"]);
			$plat_ms1				= 	numberreplace($_POST["plat_ms1"]);
			$button_ms1				= 	numberreplace($_POST["button_ms1"]);
			$pocket_ms1				= 	numberreplace($_POST["pocket_ms1"]);
			$resleting_ms1			= 	numberreplace($_POST["resleting_ms1"]);

			$label_ms2				= 	numberreplace($_POST["label_ms2"]);
			$plat_ms2				= 	numberreplace($_POST["plat_ms2"]);
			$button_ms2				= 	numberreplace($_POST["button_ms2"]);
			$pocket_ms2				= 	numberreplace($_POST["pocket_ms2"]);
			$resleting_ms2			= 	numberreplace($_POST["resleting_ms2"]);

			//-----------upload file file_qc-------
			$file_qc = 'app/file_do_good_qc'; //.$ref;
			if (!file_exists($file_qc) && !is_dir($file_qc)) {	
				@mkdir($file_qc, 0777, true);
				@chmod('app/file_do_good_qc', 0777);
				@chmod($file_qc, 0777);
			}

			$uploaddir_file_qc	= $file_qc .'/';
			$file_qc			= $_FILES['file_qc']['name']; 
			$tmpname_file_qc 	= $_FILES['file_qc']['tmp_name'];
			$filesize_file_qc 	= $_FILES['file_qc']['size'];
			$filetype_file_qc 	= $_FILES['file_qc']['type'];

			if (empty($file_qc)) { 
				$file_qc = $file_qc2; 
			} else {
				$file_qc = $file_qc;
			}

			if($file_qc != "") {
				$file_qc = $ref. '_' . $file_qc;
				$uploaddir_file_qc = $uploaddir_file_qc . $file_qc;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['file_qc']['tmp_name'], $uploaddir_file_qc)) {
					echo "";											
				} 	
			}	
			//----------------
										
			$sqlstr="insert into do_good_receipt_qc (ref, date, vendor_code, status, memo, ms_ref, ms_ref1, ms_ref2, label, plat, button, pocket, resleting, label1, plat1, button1, pocket1, resleting1, label2, plat2, button2, pocket2, resleting2, label_ms, plat_ms, button_ms, pocket_ms, resleting_ms, label_ms1, plat_ms1, button_ms1, pocket_ms1, resleting_ms1, label_ms2, plat_ms2, button_ms2, pocket_ms2, resleting_ms2, file_qc, uid, dlu) values('$ref', '$date', '$vendor_code', '$status', '$memo', '$ms_ref', '$ms_ref1', '$ms_ref2', '$label', '$plat', '$button', '$pocket', '$resleting', '$label1', '$plat1', '$button1', '$pocket1', '$resleting1', '$label2', '$plat2', '$button2', '$pocket2', '$resleting2', '$label_ms', '$plat_ms', '$button_ms', '$pocket_ms', '$resleting_ms', '$label_ms1', '$plat_ms1', '$button_ms1', '$pocket_ms1', '$resleting_ms1', '$label_ms2', '$plat_ms2', '$button_ms2', '$pocket_ms2', '$resleting_ms2', '$file_qc', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

			//--------hitung ulang payable
			/*$sqlstr = "select sum(amount_cost) amount_cost from do_good_receipt_detail where ref='$rcp_ref1' group by ref";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$total_amount = $data->amount_cost;

			$sqlstr = "update do_good_receipt set total=$total_amount where ref='$rcp_ref1'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

			//update AP
			$sqlstr="select ref from ap where ref='$ref' and invoice_type='receipt_do' and ref_type='receipt_do' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$num2 = $sql->rowCount();
			
			$exchange_date = $date;
			$total_amount = $sub_total;
			$due_date = $date;
			if($num2 > 0) {
				if($total_amount > 0) {
					$sqlstr="update ap set ref='$ref', invoice_no='$ref', date='$date', due_date='$due_date', contact_code='$vendor_code', credit_amount='$total_amount', currency_code='IDR', rate='0', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_type='receipt_do' and ref_type='receipt_do' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			} else {
				if($total_amount > 0) {
					$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'V', '$vendor_code', '', 0, '$total_amount', 'receipt_do', 'receipt_do', 'IDR', '0', '', '$exchange_date', '', '', '$uid', '$dlu')";
					
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}*/
			
			$dbpdo->commit();
		
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}


	//-----insert query string
	function insert_query_string(){
		$dbpdo = DB::create();
		
		try {
			
			$query__	=	($_POST["query__"]);
			
			$sqlstr = $query__;
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//insert into brand (code, name) values ('123','Xtra')
			//insert into brand (code, name) values (''123'',''Xtra'')
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//-----insert_query_select
	function insert_query_select(){
		$dbpdo = DB::create();
		
		try {
			
			$query__	=	petikreplace($_POST["query__"]);
			
			$sqlstr = $query__;
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
	
		return $sql;
	}
	
	
	//------insert_upload_file
	function insert_upload_file(){
		$dbpdo = DB::create();
		
		try {
			
			$main		=	(empty($_POST["main"])) ? 0 : $_POST["main"];
			/*$app		=	(empty($_POST["app"])) ? 0 : $_POST["app"];
			$class		=	(empty($_POST["class"])) ? 0 : $_POST["class"];
			$include	=	(empty($_POST["include"])) ? 0 : $_POST["include"];
			$exec		=	(empty($_POST["exec"])) ? 0 : $_POST["exec"];*/
			
			//-----------upload file
			if($main == 1) {
				$uploaddir_photo 	= '/';	
				if (!file_exists($uploaddir_photo) && !is_dir($uploaddir_photo)) {
					@mkdir($uploaddir_photo, 0777, true);
					@chmod('/', 0777);
					@chmod($uploaddir_photo, 0777);
				}
			}
			
			if($main == 2) {
				$uploaddir_photo 	= 'app/';	
				if (!file_exists($uploaddir_photo) && !is_dir($uploaddir_photo)) {
					@mkdir($uploaddir_photo, 0777, true);
					@chmod('app/', 0777);
					@chmod($uploaddir_photo, 0777);
				}
			}
			
			if($main == 3) {
				$uploaddir_photo 	= 'app/class/';	
				if (!file_exists($uploaddir_photo) && !is_dir($uploaddir_photo)) {
					@mkdir($uploaddir_photo, 0777, true);
					@chmod('app/class/', 0777);
					@chmod($uploaddir_photo, 0777);
				}
			}
			
			if($main == 4) {
				$uploaddir_photo 	= 'app/include/';	
				if (!file_exists($uploaddir_photo) && !is_dir($uploaddir_photo)) {
					@mkdir($uploaddir_photo, 0777, true);
					@chmod('app/include/', 0777);
					@chmod($uploaddir_photo, 0777);
				}
			}
			
			if($main == 5) {
				$uploaddir_photo 	= 'app/exec/';	
				if (!file_exists($uploaddir_photo) && !is_dir($uploaddir_photo)) {
					@mkdir($uploaddir_photo, 0777, true);
					@chmod('app/exec/', 0777);
					@chmod($uploaddir_photo, 0777);
				}
			}
			
			if($main == 6) {
				$uploaddir_photo 	= 'mobile/';	
				if (!file_exists($uploaddir_photo) && !is_dir($uploaddir_photo)) {
					@mkdir($uploaddir_photo, 0777, true);
					@chmod('mobile/', 0777);
					@chmod($uploaddir_photo, 0777);
				}
			}
		  	
			$photo				= $_FILES['app_file']['name']; 
			$tmpname_photo 		= $_FILES['app_file']['tmp_name'];
			$filesize_photo 	= $_FILES['app_file']['size'];
			$filetype_photo 	= $_FILES['app_file']['type'];
			
			if($photo != "") {
				$uploaddir_photo = $uploaddir_photo . $photo;	
				echo $uploaddir_photo;	
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['app_file']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
}

?>
