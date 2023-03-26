<?php

class update{

	//------update user
	function update_usr($ref,$photo){
		$dbpdo = DB::create();
		
		try {
			
			$usrid		=	$_POST["usrid"];
			$old_usrid	=	$_POST["old_usrid"];				
			$pass_ori	=	$_POST["pwd"];
			$pwd		=	obraxabrix($pass_ori, $usrid);
			$adm		=	(empty($_POST["adm"])) ? 0 : $_POST["adm"];
			$employee_id=	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			$lvl		=	$_POST["lvl"];
			//$image		=	$_POST["image"];
			$brncde		=	$_POST["brncde"];
			$image2		=	$_POST["image2"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			$act		=	(empty($_POST["act"])) ? 0 : $_POST["act"];
			
			//-----------upload file
		  	$photo2	= $_POST["photo2"];
			$uploaddir_photo = 'app/photo_usr/';
			$photo		= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						unlink($uploaddir_photo . $photo2); //remove file 
					}
					
					$photo = $usrid . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			
			if ($_POST["pwd"]=='') {		
				$sqlstr="update usr set usrid='$usrid',adm='$adm', employee_id='$employee_id', photo='$photo', act='$act',uid='$uid',dlu='$dlu' where id='$ref' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr="update usr set usrid='$usrid',pwd='$pwd',adm='$adm', employee_id='$employee_id', photo='$photo', act='$act',uid='$uid',dlu='$dlu' where id='$ref' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			//----------insert user detail
			$usr_jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<$usr_jmldata; $i++) {
				$usr_slc = numberreplace($_POST['usr_slc_'.$i.'']);
				$usr_old = (empty($_POST['usr_old_'.$i.''])) ? 0 : $_POST['usr_old_'.$i.''];
				
				$usr_frmcde = $_POST['usr_frmcde_'.$i.''];
				$usr_add = (empty($_POST['usr_add_'.$i.''])) ? 0 : $_POST['usr_add_'.$i.''];
				$usr_edt = (empty($_POST['usr_edt_'.$i.''])) ? 0 : $_POST['usr_edt_'.$i.''];
				$usr_dlt = (empty($_POST['usr_dlt_'.$i.''])) ? 0 : $_POST['usr_dlt_'.$i.''];
				$usr_lvl = (empty($_POST['usr_lvl_'.$i.''])) ? 0 : $_POST['usr_lvl_'.$i.''];
				
				if ($usr_old==1) {
					if ($usr_slc==1) {
						$sqlstr="update usr_dtl set usrid='$usrid', madd=$usr_add, medt=$usr_edt, mdel=$usr_dlt, lvl=$usr_lvl where usrid='$old_usrid' and frmcde='$usr_frmcde' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr="delete from usr_dtl where usrid='$old_usrid' and frmcde='$usr_frmcde' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}	
				} 
				
				if ($usr_old==0) {
					
					if ($usr_slc==1) {			
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
				
			}
				
			//-------update user backup
			if ($_POST["pwd"]=='') {		
				$sqlstr="update usr_bup set usrid='$usrid' where usrid='$old_usrid' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$pwd = $_POST['pwd'];
				$sqlstr="update usr_bup set usrid='$usrid',pwd='$pwd' where usrid='$old_usrid' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
		
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----update company
	function update_company($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]); //str_replace("'","''",$_POST["name"]);
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
			
			$sqlstr="update company set name='$name', businiss_type='$businiss_type', npwp='$npwp', address1='$address1', address2='$address2', phone1='$phone1', phone2='$phone2', fax='$fax', city='$city', country='$country', web='$web', email='$email', bank_name='$bank_name', bank_account='$bank_account', bank_account_name='$bank_account_name', active='$active', uid='$uid', dlu='$dlu' where id='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}


	//-----update peserta
	function update_peserta($ref){
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
			
			//update
			$sqlstr="update peserta set no_peserta='$no_peserta', no_registrasi='$no_registrasi', nama='$nama', tanggal_lahir='$tanggal_lahir', alamat='$alamat', no_hp='$no_hp', no_ktp='$no_ktp', aktif='$aktif', uid='$uid', dlu='$dlu' where syscode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			//delete
			$sqlstr="delete from peserta_program where peserta_kode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//----------update sales_order detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];			
			for ($i=0; $i<=$jmldata; $i++) {
				
				$program_id =	$_POST[program_id_.$i];
				$select		=	(empty($_POST[select_.$i])) ? 0 : $_POST[select_.$i];
				
				if ($select == 1) {
					
					$line = maxline('peserta_program', 'line', 'peserta_kode', $ref, '');
					
					$sqlstr="insert into peserta_program (peserta_kode, program_id, line) values('$ref', '$program_id', '$line')";
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
	
	
	//-----update program
	function update_program($ref){
		$dbpdo = DB::create();
		
		try {
			
			$nama			=	petikreplace($_POST["nama"]);
			$aktif			=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update program set nama='$nama', aktif='$aktif', uid='$uid', dlu='$dlu' where id='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
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
	
	
	//-----update coa
	function update_coa($ref){
		$dbpdo = DB::create();
		
		try {
			
			$acc_code			=	$_POST["acc_code"];
			$name				=	$_POST["name"];
			$acc_type			=	(empty($_POST["acc_type"])) ? 0 : $_POST["acc_type"];
			$postable			=	(empty($_POST["postable"])) ? 0 : $_POST["postable"];
			$subacc_code		=	$_POST["subacc_code"];
			
			$opening_balance_old=	numberreplace((empty($_POST["opening_balance_old"])) ? 0 : $_POST["opening_balance_old"]);
			$opening_balance	=	numberreplace((empty($_POST["opening_balance"])) ? 0 : $_POST["opening_balance"]);
			$opening_balance_date	= date("Y-m-d", strtotime($_POST["opening_balance_date"]));
			//$current_balance	=	(empty($_POST["current_balance"])) ? 0 : $_POST["current_balance"];
			//$current_balance	= 	$current_balance - $opening_balance_old + $opening_balance;
			
			$currency_code		=	(empty($_POST["currency_code"])) ? 0 : $_POST["currency_code"];
			$currency_rate		=	(empty($_POST["currency_rate"])) ? 0 : $_POST["currency_rate"];
			$currency_exchange_id		=	(empty($_POST["currency_exchange_id"])) ? 0 : $_POST["currency_exchange_id"];
			$level			=	(empty($_POST["level"])) ? 0 : $_POST["level"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update coa set acc_code='$acc_code', name='$name', acc_type='$acc_type', postable='$postable', subacc_code='$subacc_code', opening_balance='$opening_balance', opening_balance_date='$opening_balance_date', current_balance=ifnull(current_balance,0) - $opening_balance_old + $opening_balance, currency_code='$currency_code', currency_rate='$currency_rate', currency_exchange_id='$currency_exchange_id', level='$level', uid='$uid', dlu='$dlu', active='$active' where syscode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update client
	function update_client($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	petikreplace($_POST["code"]);
	        $title          =   $_POST["title"];
			$name			=	petikreplace($_POST["name"]);
	        $last_name      =	petikreplace($_POST["last_name"]);
			$contact_person	=	petikreplace($_POST["contact_person"]);
	        $contact_person1=	petikreplace($_POST["contact_person1"]);
	        $contact_person2=	petikreplace($_POST["contact_person2"]);
	        $contact_person3=	petikreplace($_POST["contact_person3"]);
			$client_type	=	(empty($_POST["client_type"])) ? 0 : $_POST["client_type"];
			$old_client_type=	(empty($_POST["old_client_type"])) ? 0 : $_POST["old_client_type"];
			if($old_client_type == 6 && $client_type == 5) {
				$client_type = 6;
			}
			$old_client_type=	$client_type;
			
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
	        $bank_name      =   $_POST["bank_name"];
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
			
			$sqlstr="update client set code='$code', title='$title', name='$name', last_name='$last_name', contact_person='$contact_person', contact_person1='$contact_person1', contact_person2='$contact_person2', contact_person3='$contact_person3', client_type='$client_type', old_client_type='$old_client_type', address='$address', ship_to='$ship_to', bill_to='$bill_to', zip_code='$zip_code', country_id='$country_id', state_id='$state_id', kabupaten='$kabupaten', kecamatan='$kecamatan', phone='$phone', phone1='$phone1', fax='$fax', email='$email', web='$web', bank_name='$bank_name', bank_branch='$bank_branch', bank_account='$bank_account', bank_account_no='$bank_account_no', amount='$amount', location_id='$location_id', active='$active', client_syscode='$client_syscode', stockist='$stockist', updateby='$uid', updated='$dlu' where syscode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//check detail
			/*if($client_syscode != "") {
				
				$old_client_syscode	=	$_POST["old_client_syscode"];
				
				$syscode	=	$ref;
				
				$sqlstr = "delete from client_detail where client_code='$old_client_syscode' and client_syscode='$syscode'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				
				$sqlstr = "select client_code, client_syscode from client_detail where client_code='$client_syscode' and client_syscode='$syscode'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows = $sql->rowCount();
				
				if($rows == 0) {
					$line = maxline('client_detail', 'line', 'client_code', $client_syscode, '');
					$sqlstr = "insert into client_detail(client_code, client_syscode, line) values('$client_syscode', '$syscode', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			} else {
				$old_client_syscode	=	$_POST["old_client_syscode"];
				
				$syscode	=	$ref;
				
				$sqlstr = "delete from client_detail where client_code='$old_client_syscode' and client_syscode='$syscode'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}*/

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update item
	function update_item($ref){
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
			
			$balance		=	numberreplace($_POST["balance"]);
			$description	=	petikreplace($_POST["description"]);
			
			//-----------upload file
		  	$photo2			= $_POST["photo2"];
			$uploaddir_photo= 'app/photo_item/';
			$photo			= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo = $_FILES['photo']['size'];
			$filetype_photo = $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						unlink($uploaddir_photo . $photo2); //remove file 					
					}
					
					$photo = $ref . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			
			$consigned		=	(empty($_POST["consigned"])) ? 0 : $_POST["consigned"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update item set code='$code', old_code='$old_code', name='$name', item_group_id='$item_group_id', item_subgroup_id='$item_subgroup_id', item_type_code='$item_type_code', item_category_id='$item_category_id', brand_id='$brand_id', size_id='$size_id', uom_code_stock='$uom_code_stock', uom_code_sales='$uom_code_sales', uom_code_purchase='$uom_code_purchase', minimum_stock='$minimum_stock', maximum_stock='$maximum_stock', photo='$photo', consigned='$consigned', balance='$balance', description='$description', active='$active', uid='$uid', dlu='$dlu' where syscode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*---------insert audit trail (update)------------*/
			$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$active', '$uid', '$dlu', '$ref', 'update' )";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			#insert/update set item cost
			$item_code	=	$ref;
			$uom_code	=	$uom_code_purchase;
			$current_cost	=	numberreplace($_POST['current_cost']);
			$date_cost		=	date("Y-m-d", strtotime($_POST['date_cost']));
			$efective_from_cost	=	date("Y-m-d", strtotime($_POST['efective_from_cost']));
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id_cost	=	0; //$_POST['location_id_cost'];
			$old_date_of_record		=	date("Y-m-d", strtotime($_POST['old_date_of_record']));
			
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

			
			$sqlstr = "select item_code, current_cost from set_item_cost where item_code='$item_code' and uom_code='$uom_code' and current_cost='$current_cost' and point_first_order='$point_first_order' and bonus_basic='$bonus_basic' and bonus_prestation='$bonus_prestation' and bonus_unilevel='$bonus_unilevel' and matching_sponsor='$matching_sponsor' and reward='$reward' and repeat_order='$repeat_order' and royalti='$royalti' and fo_point='$fo_point' and ro_point='$ro_point' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$last_cost = numberreplace($data->current_cost);
			
			if($rows == 0) {
				$sqlstr = "insert into set_item_cost (date, efective_from, item_code, uom_code, current_cost, last_cost, date_of_record, location_id, uid, dlu) values('$date_cost', '$efective_from_cost', '$item_code', '$uom_code', '$current_cost', '$last_cost', '$date_of_record', '$location_id_cost', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr = "update set_item_cost set efective_from='$efective_from_cost', uom_code='$uom_code', current_cost='$current_cost', last_cost='$last_cost', date_of_record='$date_of_record', location_id='$location_id_cost', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code' and date_of_record='$old_date_of_record'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			#insert/update set item price
			$jmldata = $_POST["jmldata"];
			for($x=0; $x<$jmldata; $x++) {
				$item_code	=	$ref;
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
				
				$date			=	date("Y-m-d", strtotime($_POST['date_'.$x.'']));
				$efective_from	=	date("Y-m-d", strtotime($_POST['efective_from_'.$x.'']));
				$date_of_record	=	date("Y-m-d H:i:s");
				$location_id	=	$_POST['location_id_'.$x.''];
				$non_discount	=	numberreplace($_POST['non_discount']);
				$qty1			=	numberreplace($_POST['qty1']);
				$qty2			=	numberreplace($_POST['qty2']);
				$qty3			=	numberreplace($_POST['qty3']);
				$qty4			=	numberreplace($_POST['qty4']);
				$old_date_of_record1		=	date("Y-m-d", strtotime($_POST['old_date_of_record1']));
				
				$sqlstr = "select item_code, current_price from set_item_price where date_of_record='$date_of_record' and item_code='$item_code' and uom_code='$uom_code' and current_price='$current_price' and current_price1='$current_price1' and current_price2='$current_price2' and tax_rate='$tax_rate' and price_tax='$price_tax' and price_member_tax='$price_member_tax' and margin_warehouse='$margin_warehouse' and margin_mlm='$margin_mlm' and registration_rate='$registration_rate' and registration_rate_platinum='$registration_rate_platinum'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows = $sql->rowCount();
				$data = $sql->fetch(PDO::FETCH_OBJ);
				$last_price = numberreplace($data->current_price);
				
				if($rows == 0) {
					$sqlstr = "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//audit trail insert
					/*$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'insert')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();*/
				} else {
					$sqlstr = "update set_item_price set efective_from='$efective_from', uom_code='$uom_code', current_price='$current_price', current_price1='$current_price1', current_price2='$current_price2', current_price3='$current_price3', last_price='$last_price', date_of_record='$date_of_record', location_id='$location_id', non_discount='$non_discount', qty1='$qty1', qty2='$qty2', qty3='$qty3', qty4='$qty4', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code' and date_of_record='$old_date_of_record1'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//audit trail update
					/*$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'update')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();*/
				}

			}

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update item group
	function update_item_group($ref){
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
			
			
			//----------update  detail
			/*$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				
				$old_id		 	= (empty($_POST[old_id_.$i])) ? 0 : $_POST[old_id_.$i];
				$old_line	 	= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$inventory_acccode		=	$_POST[inventory_acccode_.$i];
				$purchase_discount_acccode	=	$_POST[purchase_discount_acccode_.$i];
				$goodintransit_acccode	=	$_POST[goodintransit_acccode_.$i];
				$workinprocess_acccode	=	$_POST[workinprocess_acccode_.$i];
				$cogs_acccode			=	$_POST[cogs_acccode_.$i];
				$consignment_acccode	=	$_POST[consignment_acccode_.$i];
				$location_id	=	(empty($_POST[location_id_.$i])) ? 0 : $_POST[location_id_.$i];
				
				if ( $location_id > 0 ) {
					
					$sqlstr = "select id from item_group_detail where id_header='$ref' and id='$old_id' and line='$old_line' ";			
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update item_group_detail set inventory_acccode='$inventory_acccode', purchase_discount_acccode='$purchase_discount_acccode', goodintransit_acccode='$goodintransit_acccode', workinprocess_acccode='$workinprocess_acccode', cogs_acccode='$cogs_acccode', consignment_acccode='$consignment_acccode', location_id='$location_id' where id_header='$ref' and id='$old_id' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from item_group_detail where id_header='$ref' and id='$old_id' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						}
						
						
					} else {
						
						$line = maxline('item_group_detail', 'line', 'id_header', $ref, '');
					
						$sqlstr="insert into item_group_detail (id_header, inventory_acccode, purchase_discount_acccode, goodintransit_acccode, workinprocess_acccode, cogs_acccode, consignment_acccode, location_id, line) values ('$ref', '$inventory_acccode', '$purchase_discount_acccode', '$goodintransit_acccode', '$workinprocess_acccode', '$cogs_acccode', '$consignment_acccode', '$location_id', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}*/
			
			
			$sqlstr="update item_group set code='$code', name='$name', nonstock='$nonstock', costing_type='$costing_type', inventory_acccode='$inventory_acccode', purchase_discount_acccode='$purchase_discount_acccode', goodintransit_acccode='$goodintransit_acccode', workinprocess_acccode='$workinprocess_acccode', cogs_acccode='$cogs_acccode', consignment_acccode='$consignment_acccode', location_id='$location_id', active='$active', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			/*---------insert audit trail (insert)------------*/
			/*$sqlstr="insert into adt_item_group (id, code, name, nonstock, costing_type, inventory_acccode, purchase_discount_acccode, goodintransit_acccode, workinprocess_acccode, cogs_acccode, consignment_acccode, location_id, active, uid, dlu, adt_status) values('$ref', '$code', '$name', '$nonstock', '$costing_type', '$inventory_acccode', '$purchase_discount_acccode', '$goodintransit_acccode', '$workinprocess_acccode', '$cogs_acccode', '$consignment_acccode', '$location_id', '$active', '$uid', '$dlu', 'update')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();*/

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update client_set_level
	function update_client_set_level($ref){
		$dbpdo = DB::create();
		
		try {
			
			$qualified				=	(empty($_POST["qualified"])) ? 0 : $_POST["qualified"];
			$group_completed		=	(empty($_POST["group_completed"])) ? 0 : $_POST["group_completed"];
			$platinum				=	(empty($_POST["platinum"])) ? 0 : $_POST["platinum"];
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update client_set_level set qualified='$qualified', group_completed='$group_completed', platinum='$platinum', uid='$uid', dlu='$dlu' where id='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update level
	function update_level($ref){
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
			
			$sqlstr="update level set level='$level', indicator_member='$indicator_member', indicator='$indicator', registration='$registration', starter_kit='$starter_kit', prestasi='$prestasi', unilevel='$unilevel', sponsor='$sponsor', bonus='$bonus', uid='$uid', dlu='$dlu' where id='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update warehouse
	function update_warehouse($ref){
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
			
			$sqlstr="update warehouse set code='$code', name='$name', address='$address', email='$email', phone='$phone', active='$active', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update product
	function update_product($ref){
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
			$size_id			= $_POST["size_id"];  //	(empty($_POST["size_id"])) ? 0 : $_POST["size_id"];
			$uom_code_sales		=	$_POST["uom_code_sales"];
			$uom_code_stock		=	$uom_code_sales; //$_POST["uom_code_stock"];
			$uom_code_purchase	=	$uom_code_sales; //$_POST["uom_code_purchase"];
			$minimum_stock		=	numberreplace((empty($_POST["minimum_stock"])) ? 0 : $_POST["minimum_stock"]);
			$maximum_stock		=	numberreplace((empty($_POST["maximum_stock"])) ? 0 : $_POST["maximum_stock"]);
			
			$balance		=	numberreplace($_POST["balance"]);
			
			//-----------upload file
		  	$photo2			= $_POST["photo2"];
			$uploaddir_photo= 'app/photo_item/';
			$photo			= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo = $_FILES['photo']['size'];
			$filetype_photo = $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						unlink($uploaddir_photo . $photo2); //remove file 					
					}
					
					$photo = $ref . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			
			$consigned		=	(empty($_POST["consigned"])) ? 0 : $_POST["consigned"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update item set code='$code', old_code='$old_code', name='$name', item_group_id='$item_group_id', item_subgroup_id='$item_subgroup_id', item_type_code='$item_type_code', item_category_id='$item_category_id', brand_id='$brand_id', size_id='$size_id', uom_code_stock='$uom_code_stock', uom_code_sales='$uom_code_sales', uom_code_purchase='$uom_code_purchase', minimum_stock='$minimum_stock', maximum_stock='$maximum_stock', photo='$photo', consigned='$consigned', balance='$balance', active='$active', uid='$uid', dlu='$dlu' where syscode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*---------insert audit trail (update)------------*/
			$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$active', '$uid', '$dlu', '$ref', 'update' )";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update client deposit
	function update_client_deposit($ref){
		$dbpdo = DB::create();
		
		try {
			
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
			
			$sqlstr="update client_deposit set date='$date', opening_balance='$opening_balance', current_balance='$current_balance', receipt_type='$receipt_type', bank_id='$bank_id', receipt_status='$receipt_status', memo='$memo', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr="update client set amount='$current_balance' where syscode='$client_code'";
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
	
	
	//-----update client transfer saldo
	function update_transfer_saldo($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$client_code	=	$_POST["client_code"];
			$saldo			=	numberreplace($_POST["saldo"]);
			$transfer		=	numberreplace($_POST["transfer"]);
			$client_code1	=	$_POST["client_code1"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update transfer_saldo set client_code='$client_code', saldo='$saldo', transfer='$transfer', client_code1='$client_code1', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
				
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update stock oopname
	function update_stock_opname($ref){
		$dbpdo = DB::create();
		
		try {
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));
			$location_id		=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			$bin				= 	$_POST["bin"];
			$uid				=	$_SESSION["loginname"];
			$beginning_balance	= 	(empty($_POST["beginning_balance"])) ? 0 : $_POST["beginning_balance"];
			$memo				= 	$_POST["memo"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$old_date			=	date("Y-m-d", strtotime($_POST["old_date"]));
			$old_location_id	=	(empty($_POST["old_location_id"])) ? 0 : $_POST["old_location_id"];
			$old_bin			= 	$_POST["old_bin"];
			$old_uid			=	$_POST["old_uid"];
				
			$sqlstr="update stock_opname set date='$date', location_id='$location_id', bin='$bin', uid='$uid', beginning_balance='$beginning_balance', memo='$memo', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//----------update store request detail
			$expired_date 	=	date('Y-m-d');
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST['delete_'.$i.''])) ? 0 : $_POST['delete_'.$i.''];
				
				$old_item_code	 	= $_POST['old_item_code_'.$i.''];
				$old_uom_code 		= $_POST['old_uom_code_'.$i.''];
				$old_line		 	= (empty($_POST['old_line_'.$i.''])) ? 0 : $_POST['old_line_'.$i.''];
				
				$item_code	 	= $_POST['item_code_'.$i.''];
				$uom_code 		= $_POST['uom_code_'.$i.''];
				
				if ( !empty($item_code) && !empty($uom_code) ) {
					$qty 		= numberreplace($_POST['qty_'.$i.'']);
					$unit_cost 	= numberreplace($_POST['unit_cost_'.$i.'']);
					
					$sqlstr = "select ref from stock_opname_detail where ref='$ref' and date='$old_date' and location_id='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update stock_opname_detail set date='$date', location_id='$location_id', bin='$bin', uid='$uid', item_code='$item_code', uom_code='$uom_code', qty='$qty', unit_cost='$unit_cost' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line";
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
								
								$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '$qty', 0, '$amount', $old_line, '$uid', '$dlu')";		
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							} else { //jika minus, maka masuk credit
								$amount = ($unit_cost * $qty) * -1;
								$qty	= $qty * -1;
								
								$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'stockopname', '', '$item_code', '$uom_code', '$expired_date', '$unit_cost', '0', '$qty', '$amount', $old_line, '$uid', '$dlu')";		
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
							
								
						} else {
							$sqlstr="delete from stock_opname_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
							##bincard update
							$sqlstr = "delete from bincard where invoice_no='$ref' and item_code='$item_code' and uom_code='$uom_code'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
												
						}
						
						
					} else {
						$qty 		= $_POST['qty_'.$i.''];

						if($qty != "") {
							$line = maxline('stock_opname_detail', 'line', 'ref', $ref, '');
							
							$sqlstr="insert into stock_opname_detail (ref, date, location_id, bin, uid, item_code, uom_code, line, qty, unit_cost, syscode) values ('$ref', '$date', '$location_id', '$bin', '$uid', '$item_code', '$uom_code', $line, '$qty', '$unit_cost', '$ref')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							##bincard
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
			}
			
			
			//add item
			$item_code 		= $_POST["item_code"];
			$uom_code 		= $_POST["uom_code"];
			//$syscode		= $ref;			
			if ( !empty($item_code) && !empty($uom_code) ) {				
				$qty = numberreplace($_POST["qty"]);
				$unit_cost = numberreplace($_POST["unit_cost"]);
				
				$line = maxline('stock_opname_detail', 'line', 'ref', $ref, '');
									
				$sqlstr = "select qty, unit_cost from stock_opname_detail where ref='$ref' and location_id='$location_id' and bin='$bin' and uid='$uid' and item_code='$item_code' and uom_code='$uom_code' limit 1";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows = $sql->rowCount();
				$data = $sql->fetch(PDO::FETCH_OBJ);
				
				if($rows == 0) {
					$sqlstr="insert into stock_opname_detail (ref, date, location_id, bin, uid, item_code, uom_code, line, qty, unit_cost, syscode) values ('$ref', '$date', '$location_id', '$bin', '$uid', '$item_code', '$uom_code', $line, '$qty', '$unit_cost', '$syscode')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					##bincard
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
					$sqlstr="update stock_opname_detail set qty=ifnull(qty,0) + $qty, unit_cost='$unit_cost' where ref='$ref' and date='$date' and location_id='$location_id' and bin='$bin' and uid='$uid' and item_code='$item_code' and uom_code='$uom_code'";
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
	
	//-----update employee
	function update_employee($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
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
		  	$photo2			= $_POST["photo2"];
			$uploaddir_photo= 'app/photo_employee/';
			$photo			= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo = $_FILES['photo']['size'];
			$filetype_photo = $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						unlink($uploaddir_photo . $photo2); //remove file 
					}
					
					$photo = $code . '_' . $photo;
				}
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
			
			$sqlstr="update employee set code='$code', name='$name', nick_name='$nick_name', born='$born', birth_date='$birth_date', marital_status='$marital_status', religion_id='$religion_id', address='$address', zip_code='$zip_code', country_id='$country_id', state_id='$state_id', phone='$phone', email='$email', photo='$photo', position_id='$position_id', department_id='$department_id', division_id='$division_id', location_id='$location_id', category_id='$category_id', bank_name='$bank_name', bank_account='$bank_account', bank_account_name='$bank_account_name', active='$active', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pos detail
	function insert_pos_capster_detail($ref, $location_id, $item_code, $uom_code, $non_discount, $qty, $unit_price, $amount, $cash, $client_code){	
		
		$dbpdo = DB::create();
		
		try {
								
			if ( !empty($item_code) && !empty($uom_code) ) {		
			
				$line = maxline('sales_invoice_tmp', 'line', 'ref', $ref, '');
					
				$sqlstr="insert into sales_invoice_tmp (ref, client_code, cash, item_code, uom_code, qty, discount, unit_price, amount, discount2, discount3, deposit, total, non_discount, location_id, uid, line) values ('$ref', '$client_code', '$cash', '$item_code', '$uom_code', '$qty', '$discount', '$unit_price', '$amount', '0', '0', '0', '$total', '$non_discount', '$location_id', '$uid', $line)";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
											
			}	
				
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//---------get data sales_order
	function get_sales_order($ref){	
		$dbpdo = DB::create();
		 	
		$sqlstr="select a.item_code, a.uom_code, a.unit_price, a.qty, a.amount, b.client_code from sales_order_detail a left join sales_order b on a.ref=b.ref where a.ref='$ref' order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----update sales order
	function update_sales_order($ref){	
		
		$dbpdo 		= DB::create();
		try {
			
			$dbpdo->beginTransaction();
			
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
			
			//----------update so detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				
				$old_item_code	 	= $_POST[old_item_code_.$i];
				$old_uom_code 		= $_POST[old_uom_code_.$i];
				$old_line		 	= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$item_code	 	= $_POST[item_code_.$i];
				$uom_code 		= $_POST[uom_code_.$i];
								
				if ( !empty($item_code) && !empty($uom_code) ) {
					$qty 		= numberreplace($_POST[qty_.$i]);
					$unit_price	= numberreplace($_POST[unit_price_.$i]);
					$discount 	= numberreplace($_POST[discount_det_.$i]);
					$amount 	= numberreplace($_POST[amount_.$i]);
					
					$sqlstr = "select ref from sales_order_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update sales_order_detail set qty='$qty', uom_code='$uom_code', discount='$discount', unit_price='$unit_price', amount='$amount' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
				
								
						} else {
							$sqlstr="delete from sales_order_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
												
						}
						
						
					} else {
						$line = maxline('sales_order_detail', 'line', 'ref', $ref, '');
				
						$sqlstr="insert into sales_order_detail (ref, item_code, uom_code, qty, discount, unit_price, amount, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$unit_price', '$amount', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
				
					}
					
					
					
				}
			}
			
			
			//get total amaount
			$sqlstr = "select sum(amount) sub_total from sales_order_detail where ref='$ref' group by ref";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$sub_total = $data->sub_total;
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$status			= 	$_POST["status"];
			$employee_id	= 	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			$newclient		= 	(empty($_POST["newclient"])) ? 0 : $_POST["newclient"];
			$client_code	=	$_POST["client_code"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$qo_ref				=	$_POST["qo_ref"];
			$top				=	$_POST["top"];
			$tax_code			=	$_POST["tax_code"];
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$freight_cost 		= 	numberreplace($_POST["freight_cost"]);
			$freight_account	= 	$_POST["freight_account"];
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);
			$memo				= 	$_POST["memo"];
			$total				=	$sub_total + $freight_cost; 
			
			
			$sqlstr="update sales_order set date='$date', status='$status', top='$top', client_code='$client_code', qo_ref='$qo_ref', tax_code='$tax_code', tax_rate='$tax_rate', freight_cost='$freight_cost', freight_account='$freight_account', currency_code='$currency_code', rate='$rate', employee_id='$employee_id', total='$total', memo='$memo', uid='$uid', dlu='dlu' where ref='$ref'";
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
	
	
	//-----update material
	function update_material($ref){
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
			$size_id			= $_POST["size_id"];  //	(empty($_POST["size_id"])) ? 0 : $_POST["size_id"];
			$uom_code_stock		=	$_POST["uom_code_stock"];
			$uom_code_sales		=	$uom_code_stock; //$_POST["uom_code_sales"];
			$uom_code_purchase	=	$uom_code_stock; //$_POST["uom_code_purchase"];
			$minimum_stock		=	numberreplace((empty($_POST["minimum_stock"])) ? 0 : $_POST["minimum_stock"]);
			$maximum_stock		=	numberreplace((empty($_POST["maximum_stock"])) ? 0 : $_POST["maximum_stock"]);
			
			$balance		=	numberreplace($_POST["balance"]);
			$description	=	petikreplace($_POST["description"]);
			
			//-----------upload file
		  	$photo2			= $_POST["photo2"];
			$uploaddir_photo= 'app/photo_item/';
			$photo			= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo = $_FILES['photo']['size'];
			$filetype_photo = $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						unlink($uploaddir_photo . $photo2); //remove file 					
					}
					
					$photo = $ref . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			
			$consigned		=	(empty($_POST["consigned"])) ? 0 : $_POST["consigned"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update item set code='$code', old_code='$old_code', name='$name', item_group_id='$item_group_id', item_subgroup_id='$item_subgroup_id', item_type_code='$item_type_code', item_category_id='$item_category_id', brand_id='$brand_id', size_id='$size_id', uom_code_stock='$uom_code_stock', uom_code_sales='$uom_code_sales', uom_code_purchase='$uom_code_purchase', minimum_stock='$minimum_stock', maximum_stock='$maximum_stock', photo='$photo', consigned='$consigned', balance='$balance', description='$description', active='$active', uid='$uid', dlu='$dlu' where syscode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*---------insert audit trail (update)------------*/
			$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$active', '$uid', '$dlu', '$ref', 'update' )";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			#insert/update set item cost
			$item_code	=	$ref;
			$uom_code	=	$uom_code_purchase;
			$current_cost	=	numberreplace($_POST['current_cost']);
			$date_cost		=	date("Y-m-d", strtotime($_POST['date_cost']));
			$efective_from_cost	=	date("Y-m-d", strtotime($_POST['efective_from_cost']));
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id_cost	=	$_POST['location_id_cost'];
			$old_date_of_record		=	date("Y-m-d", strtotime($_POST['old_date_of_record']));
			
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
			
			$sqlstr = "select item_code, current_cost from set_item_cost where item_code='$item_code' and uom_code='$uom_code' and current_cost='$current_cost' and point_first_order='$point_first_order' and bonus_basic='$bonus_basic' and bonus_prestation='$bonus_prestation' and bonus_unilevel='$bonus_unilevel' and matching_sponsor='$matching_sponsor' and reward='$reward' and repeat_order='$repeat_order' and royalti='$royalti' and fo_point='$fo_point' and ro_point='$ro_point' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$last_cost = $data->current_cost;
			
			if($rows == 0) {
				$sqlstr = "insert into set_item_cost (date, efective_from, item_code, uom_code, current_cost, point_first_order, bonus_basic, bonus_prestation, bonus_unilevel, matching_sponsor, reward, repeat_order, royalti, total_budget, last_cost, fo_point, ro_point, date_of_record, location_id, uid, dlu) values('$date_cost', '$efective_from_cost', '$item_code', '$uom_code', '$current_cost', '$point_first_order', '$bonus_basic', '$bonus_prestation', '$bonus_unilevel', '$matching_sponsor', '$reward', '$repeat_order', '$royalti', '$total_budget', '$last_cost', '$fo_point', '$ro_point', '$date_of_record', '$location_id_cost', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr = "update set_item_cost set efective_from='$efective_from_cost', uom_code='$uom_code', current_cost='$current_cost', point_first_order='$point_first_order', bonus_basic='$bonus_basic', bonus_prestation='$bonus_prestation', bonus_unilevel='$bonus_unilevel', matching_sponsor='$matching_sponsor', reward='$reward', repeat_order='$repeat_order', royalti='$royalti', total_budget='$total_budget', last_cost='$last_cost', fo_point='$fo_point', ro_point='$ro_point', date_of_record='$date_of_record', location_id='$location_id_cost', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code' and date_of_record='$old_date_of_record'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			#insert/update set item price
			$item_code	=	$ref;
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
			$efective_from	=	date("Y-m-d", strtotime($_POST['efective_from']));
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id	=	$_POST['location_id'];
			$non_discount	=	$_POST['non_discount'];
			$qty1			=	numberreplace($_POST['qty1']);
			$qty2			=	numberreplace($_POST['qty2']);
			$qty3			=	numberreplace($_POST['qty3']);
			$qty4			=	numberreplace($_POST['qty4']);
			$old_date_of_record1		=	date("Y-m-d", strtotime($_POST['old_date_of_record1']));
			
			$sqlstr = "select item_code, current_price from set_item_price where date_of_record='$date_of_record' and item_code='$item_code' and uom_code='$uom_code' and current_price='$current_price' and current_price1='$current_price1' and current_price2='$current_price2' and tax_rate='$tax_rate' and price_tax='$price_tax' and price_member_tax='$price_member_tax' and margin_warehouse='$margin_warehouse' and margin_mlm='$margin_mlm' and registration_rate='$registration_rate' and registration_rate_platinum='$registration_rate_platinum'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$last_price = $data->current_price;
			
			if($rows == 0) {
				$sqlstr = "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, tax_rate, price_tax, price_member_tax, margin_warehouse, margin_mlm, registration_rate, registration_rate_platinum, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$tax_rate', '$price_tax', '$price_member_tax', '$margin_warehouse', '$margin_mlm', '$registration_rate', '$registration_rate_platinum', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				//audit trail insert
				$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'insert')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr = "update set_item_price set efective_from='$efective_from', uom_code='$uom_code', current_price='$current_price', current_price1='$current_price1', current_price2='$current_price2', current_price3='$current_price3', tax_rate='$tax_rate', price_tax='$price_tax', price_member_tax='$price_member_tax', margin_warehouse='$margin_warehouse', margin_mlm='$margin_mlm', registration_rate='$registration_rate', registration_rate_platinum='$registration_rate_platinum', last_price='$last_price', date_of_record='$date_of_record', location_id='$location_id', non_discount='$non_discount', qty1='$qty1', qty2='$qty2', qty3='$qty3', qty4='$qty4', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code' and date_of_record='$old_date_of_record1'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				//audit trail update
				$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'update')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update purchase inv
	function update_purchase_inv($ref){
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$old_location_id	=	(empty($_POST["old_location_id"])) ? 0 : $_POST["old_location_id"];
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));
			$location_id		=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			$stock_in			= 	(empty($_POST["stock_in"])) ? 0 : $_POST["stock_in"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//----------update item return detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST['delete_'.$i.''])) ? 0 : $_POST['delete_'.$i.''];
				
				$old_item_code	 	= $_POST['old_item_code_'.$i.''];
				$old_uom_code 		= $_POST['old_uom_code_'.$i.''];
				$old_qty 			= numberreplace($_POST['old_qty_'.$i.'']);
				$old_line		 	= (empty($_POST['old_line_'.$i.''])) ? 0 : $_POST['old_line_'.$i.''];
				
				$item_code3	 	= $_POST['item_code3_'.$i.''];
				$item_code	 	= $_POST['item_code_'.$i.''];
				$uom_code 		= $_POST['uom_code_'.$i.''];
				$qty 			= numberreplace($_POST['qty_'.$i.'']);
				$unit_cost 		= numberreplace($_POST['unit_cost_'.$i.'']);
				$amount 		= numberreplace($_POST['amount_'.$i.'']); 
				
				//jika add item baru
				if($item_code3 != "") {
					$sqlstr = "select syscode, uom_code_purchase uom_code from item where (code='$item_code3' or old_code='$item_code3') limit 1 ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$data = $sql->fetch(PDO::FETCH_OBJ);
					
					$item_code	= $data->syscode;
					$uom_code	= $data->uom_code;
					if($qty == "" || $qty == 0) {
						$qty = 1;
					}
					
					$selectview = new selectview;
					if($unit_cost == "" || $unit_cost == 0) {
						$unit_cost = $selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
					}
					
					if($amount == "" || $amount == 0) {
						$amount = $qty * $unit_cost;
					}
										
				}
				
				if ( !empty($item_code) && !empty($uom_code) ) {
					
					$discount = numberreplace($_POST['discount_'.$i.'']);
                	$discount1 = numberreplace($_POST['discount3_1_'.$i.'']);
					$discount2 = numberreplace($_POST['discount3_2_'.$i.'']);
	                $discount3 = numberreplace($_POST['discount3_3_'.$i.'']);
					
					$line_item_po = (empty($_POST['line_item_po_'.$i.''])) ? 0 : $_POST['line_item_po_'.$i.''];
					
					$sqlstr = "select ref from purchase_invoice_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							
							//jika tidak ada item baru
							$sqlstr="update purchase_invoice_detail set item_code='$item_code', uom_code='$uom_code', qty='$qty', unit_cost='$unit_cost', discount1='$discount1', discount2='$discount2', discount3='$discount3', discount='$discount', amount='$amount' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//----------update bincard (debit qty)
							if($stock_in == 1) {
								$sqlstr="select invoice_no from bincard where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='purchase_inv' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								$rows=$sql->rowCount();
								
								if($rows > 0) {
									$sqlstr="update bincard set location_code='$location_id', date='$date', item_code='$item_code', uom_code='$uom_code', unit_price='$unit_cost', debit_qty='$qty', amount='$amount', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='purchase_inv' ";
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();	
								} else {
									$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_inv', '', '$item_code', '$uom_code', '$unit_cost', '$qty', 0, '$amount', '$old_line', '$uid', '$dlu')";						
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
								}
							}
												
								
						} else {
							$sqlstr="delete from purchase_invoice_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
							//----------delete bincard (debit qty)
							$sqlstr="delete from bincard where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='purchase_inv' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
																		
						}
						
						
					} else {
						$line = maxline('purchase_invoice_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into purchase_invoice_detail (ref, po_ref, item_code, uom_code, qty, unit_cost, amount, line_item_po, line) values ('$ref', '', '$item_code', '$uom_code', '$qty', '$unit_cost', '$amount', '0', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						//----------insert bincard (debit qty)
						if($stock_in == 1) {
							$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_inv', '', '$item_code', '$uom_code', '$unit_cost', '$qty', 0, '$amount', '$line', '$uid', '$dlu')";
							
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}					
					}
					
					
					
				}
			}
			
			
			//insert new item-------------------\/
			$item_code3		= $_POST['item_code2'];
			$uom_code 		= $_POST['uom_code'];
			$size 			= numberreplace($_POST['size']);
			$qty 			= numberreplace($_POST['qty']);
			$unit_cost 		= numberreplace($_POST['unit_cost']);
			$amount 		= numberreplace($_POST['amount']); 
			
			//jika add item baru
			if($item_code3 != "") {
				
				$sqlstr = "select syscode, uom_code_purchase uom_code from item where (code='$item_code3' or old_code='$item_code3') limit 1 ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data = $sql->fetch(PDO::FETCH_OBJ);
				
				$item_code	= $data->syscode;
				if($uom_code == "") {
					$uom_code	= $data->uom_code;
				}
				if($qty == "" || $qty == 0) {
					$qty = 1;
				}
				
				$selectview = new selectview;
				if($unit_cost == "" || $unit_cost == 0) {
					$unit_cost = $selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
				}
				
				if($amount == "" || $amount == 0) {
					$amount = $qty * $unit_cost;
				}
									
			}
			
			if ( !empty($item_code) && !empty($uom_code) ) {
				
				$discount		= numberreplace($_POST['discount_det']); //discount nominal
				$discount1		= numberreplace($_POST['discount3_1_det']); //discount %
				
                
                $discount2 = 0;
                $discount3 = 0;
				
				$line_item_po = maxline('purchase_invoice_detail', 'line', 'ref', $ref, '');
				
				$sqlstr = "select ref from purchase_invoice_detail where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$num = $sql->rowCount();
				
				if($num > 0) {
					
					$sqlstr = "select sum(qty) qty_old from purchase_invoice_detail where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' group by ref, item_code, uom_code ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$data_qty = $sql->fetch(PDO::FETCH_OBJ);
					$qty_upd = $data_qty->qty_old + $qty;
					$amount_upd = $unit_cost - (($unit_cost * $discount1)/100);
					$amount = $amount_upd * $qty_upd;
					
					$sqlstr="update purchase_invoice_detail set size='$size', qty=ifnull(qty,0) + $qty, unit_cost='$unit_cost', discount1='$discount1', discount2='$discount2', discount3='$discount3', discount='$discount', amount='$amount' where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//----------update bincard (debit qty)
					if($stock_in == 1) {
						$sqlstr="update bincard set location_code='$location_id', date='$date', unit_price='$unit_cost', debit_qty=ifnull(debit_qty,0) + $qty, amount='$amount', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_location_id' and item_code='$item_code' and uom_code='$uom_code' and invoice_type='purchase_inv' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}	
					
				} else {
					$line = maxline('purchase_invoice_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into purchase_invoice_detail (ref, po_ref, item_code, uom_code, size, qty, unit_cost, amount, line_item_po, line) values ('$ref', '', '$item_code', '$uom_code', '$size', '$qty', '$unit_cost', '$amount', '0', $line)";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//----------insert bincard (debit qty)
					if($stock_in == 1) {
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_inv', '', '$item_code', '$uom_code', '$unit_cost', '$qty', 0, '$amount', '$line', '$uid', '$dlu')";
						
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}					
				}	
			}		
			//---------------end item new--------/\
			
			
			
			//-get amount
			$sqlstr = "select sum(amount) amount from purchase_invoice_detail where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			
			$sub_total = $data->amount;
			
			$invoice_no			=	$_POST["invoice_no"];
			$status				= 	$_POST["status"];
			$bill_number		= 	$_POST["bill_number"];
			$vendor_code		= 	$_POST["vendor_code"];
			$top				= 	$_POST["top"];
			$tax_code			= 	$_POST["tax_code"];
			$payment_type		=	$_POST["payment_type"];
			$tax_rate			=	numberreplace((empty($_POST["tax_rate"])) ? 0 : $_POST["tax_rate"]);
			$freight_cost		=	numberreplace((empty($_POST["freight_cost"])) ? 0 : $_POST["freight_cost"]);
			$freight_account	= 	petikreplace($_POST["freight_account"]);
			$memo				= 	petikreplace($_POST["memo"]);		
			$cash				=	(empty($_POST["cash"])) ? 0 : $_POST["cash"];
			$cash_amount		= 	numberreplace($_POST["cash_amount"]);
			$change_amount		=	numberreplace($_POST["change_amount"]);
			$discount 			= 	numberreplace($_POST["discount_det"]);
			$due_date			=	date("Y-m-d", strtotime($_POST["due_date"]));
			$total				=	numberreplace($_POST["total"]); //$sub_total + $freight_cost;
			
			$bank_id			=	(empty($_POST["bank_id"])) ? 0 : $_POST["bank_id"];
			$bank_amount		=	numberreplace($_POST["bank_amount"]);
			$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
			$card_amount		=	numberreplace($_POST["card_amount"]);
			$credit_card_no		=	$_POST["credit_card_no"];
			$credit_card_holder	=	petikreplace($_POST["credit_card_holder"]);
			$purchase_type 		=	numberreplace($_POST["purchase_type"]);
			$rate 				=	0;
			$exchange_date 		=	'00:00:00';
			
			//status='$status', 
			$sqlstr="update purchase_invoice set invoice_no='$invoice_no', date='$date', bill_number='$bill_number', vendor_code='$vendor_code', payment_type='$payment_type', top='$top', due_date='$due_date', tax_code='$tax_code', tax_rate='$tax_rate', freight_cost='$freight_cost', freight_account='$freight_account', memo='$memo', discount='$discount', total='$total', cash_amount='$cash_amount', change_amount='$change_amount', bank_id='$bank_id', bank_amount='$bank_amount', credit_card_code='$credit_card_code', card_amount='$card_amount', credit_card_no='$credit_card_no', credit_card_holder='$credit_card_holder', location_id='$location_id', stock_in='$stock_in', purchase_type='$purchase_type', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			if($payment_type == "Kredit") {
				//insert AP
				$sqlstr="delete from ap where ref='$ref' and invoice_type='POV' and ref_type='POV' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'V', '$vendor_code', '', 0, '$total', 'POV', 'POV', '$currency_code', '$rate', '', '$exchange_date', '$top', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				//insert AP
				$sqlstr="delete from ap where ref='$ref' and invoice_type='POV' and ref_type='POV' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
		
			$dbpdo->commit();
		
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------update general journal
	function update_general_journal($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
						
			$date		=	date('Y-m-d', strtotime($_POST["date"]));
			$status		= 	$_POST["status"];
			$currency_code		= 	$_POST["currency_code"];
			$rate		=	str_replace(",","",(empty($_POST["rate"])) ? 0 : $_POST["rate"]);
			$memo		= 	$_POST["memo"];
			$total_balance		=	str_replace(",","",(empty($_POST["total_balance"])) ? 0 : $_POST["total_balance"]);
			$total_debit		=	str_replace(",","",(empty($_POST["total_debit"])) ? 0 : $_POST["total_debit"]);
			$total_credit		=	str_replace(",","",(empty($_POST["total_credit"])) ? 0 : $_POST["total_credit"]);
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$old_account_code	= $_POST[old_account_code_.$i];
				$old_line			= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$account_code 		= $_POST[account_code_.$i];
				$memo2 				= $_POST[memo_.$i];
				$debit_amount		= str_replace(",","",(empty($_POST[debit_amount_.$i])) ? 0 : $_POST[debit_amount_.$i]);
				$credit_amount		= str_replace(",","",(empty($_POST[credit_amount_.$i])) ? 0 : $_POST[credit_amount_.$i]);
				if ($account_code != '') { 		
					
					$sqlstr = "select ref from general_journal_detail where ref='$ref' and account_code='$old_account_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						$sqlstr = "update general_journal_detail set account_code='$account_code', memo='$memo2', debit_amount='$debit_amount', credit_amount='$credit_amount' where ref='$ref' and account_code='$old_account_code' and line='$old_line' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('general_journal_detail', 'line', 'ref', $ref, '');
					
						$sqlstr = "insert into general_journal_detail(ref, account_code, memo, debit_amount, credit_amount, line) values('$ref', '$account_code', '$memo2', '$debit_amount', '$credit_amount', '$line') ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
					}
					
				}
				
			}
			
			$sqlstr = "update general_journal set date='$date', status='$status', currency_code='$currency_code', rate='$rate', memo='$memo', total_balance='$total_balance', total_debit='$total_debit', total_credit='$total_credit', uid='$uid', dlu='$dlu' where  ref='$ref'";
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
	
	//-----update pos
	function update_pos($ref){
		$dbpdo = DB::create();
		
		try {
			$old_location_id	=	(empty($_POST["old_location_id"])) ? 0 : $_POST["old_location_id"];
			
			$client_member_code	=	$_POST["client_member_code"];
						
			$ref2			= 	$_POST["ref2"];
			$date			=	date("Y-m-d", strtotime($_POST["date"]));	
			$taxable		=	(empty($_POST["taxable"])) ? 0 : $_POST["taxable"];		
			$status			= 	$_POST["status"];
			$location_id	=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
	        $client_code	=	$_POST["client_code2"];
	        $phone			=	$_POST["phone"];
			$ship_to		=	petikreplace($_POST["ship_to"]);
			$bill_to		=	petikreplace($_POST["bill_to"]);
			$bank_account 	=	$_POST["bank_account"];
			$expedition_bill=	$_POST["expedition_bill"];
			$receipt_type 	=	$_POST["receipt_type"];
			
			if($taxable == 0) {
				$ref2		= 	"";
			} 
			
			$expired_date 	=	"00:00:00";
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			//----------insert new item detail
			$total_amount	=	0;
			$item_code	 	= $_POST['item_code'];
			$uom_code 		= $_POST['uom_code'];
			$qty = numberreplace($_POST['qty']);
			$unit_price = numberreplace($_POST['unit_price']);
			$discount = numberreplace($_POST['discount']);
            $discount3 = numberreplace($_POST['discount3']);
			$amount = numberreplace($_POST['amount']);
			$non_discount = (empty($_POST['non_discount'])) ? 0 : $_POST['non_discount'];
			
			if ( !empty($item_code) && !empty($uom_code) ) {
				
				//get cogs
				$sqlprice = "select b.current_cost cogs, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
				$resultprice=$dbpdo->prepare($sqlprice);
				$resultprice->execute();
				$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
				$unit_cost	= $dataprice->cogs;	
				$amount_cost= $qty * $unit_cost;
				
				$line = maxline('sales_invoice_detail', 'line', 'ref', $ref, '');
				
				$sqlstr="insert into sales_invoice_detail (ref, so_ref, item_code, uom_code, qty, discount, discount3, unit_price, amount, non_discount, unit_cost, amount_cost, line) values ('$ref', '', '$item_code', '$uom_code', '$qty', '$discount', '$discount3', '$unit_price', '$amount', '$non_discount', '$unit_cost', '$amount_cost', '$line')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();								
				
				//----------insert bincard (debit qty)
				/*$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'pos', '', '$item_code', '$uom_code', '$expired_date', '$unit_price', 0, '$qty', '$amount', '$line', '$uid', '$dlu')";				
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();*/
				
				$total_amount = $amount;
			}
			//-----------/\---------------------------
								
			
			//----------update sales_order detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST['delete_'.$i.''])) ? 0 : $_POST['delete_'.$i.''];
				
				$old_item_code	 	= $_POST['old_item_code_'.$i.''];
				$old_uom_code 		= $_POST['old_uom_code_'.$i.''];
				$old_line		 	= (empty($_POST['old_line_'.$i.''])) ? 0 : $_POST['old_line_'.$i.''];
				
				$item_code	 	= $_POST['item_code_'.$i.''];
				$uom_code 		= $_POST['uom_code_'.$i.''];
				
				if ( !empty($item_code) && !empty($uom_code) ) {	
					$do_ref 		= $_POST['do_ref_'.$i.''];
					$so_ref 		= $_POST['so_ref_'.$i.''];
					$return_ref 	= $_POST['return_ref_'.$i.''];
								
					$qty 		= numberreplace($_POST['qty_'.$i.'']);
					$old_qty	= numberreplace($_POST['old_qty_'.$i.'']);
					$unit_price	= numberreplace($_POST['unit_price_'.$i.'']);
					$unit_price2 = numberreplace($_POST['unit_price2_'.$i.'']);
					$discount	= numberreplace($_POST['discount_det_'.$i.'']);
	                $discount3 	= numberreplace($_POST['discount3_det_'.$i.'']);
					$amount 	= numberreplace($_POST['amount_'.$i.'']);
					$amount2 	= numberreplace($_POST['amount2_'.$i.'']);
					$dummy 		= (empty($_POST['dummy_'.$i.''])) ? 0 : $_POST['dummy_'.$i.'']; //$_POST[dummy_'.$i.''];
					$non_discount = (empty($_POST['non_discount_'.$i.''])) ? 0 : $_POST['non_discount_'.$i.''];
					
					$line_item_do	= numberreplace($_POST['line_item_do_'.$i.'']);
					$line_item_so	= numberreplace($_POST['line_item_so_'.$i.'']);
					
					$sqlstr = "select ref from sales_invoice_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							
							//get cogs
							$sqlprice = "select b.current_cost cogs, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
							$resultprice=$dbpdo->prepare($sqlprice);
							$resultprice->execute();
							$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
							$unit_cost	= numberreplace($dataprice->cogs);	
							$amount_cost= $qty * $unit_cost;
							
							$sqlstr="update sales_invoice_detail set so_ref='$so_ref', return_ref='$return_ref', item_code='$item_code', uom_code='$uom_code', qty='$qty', unit_price='$unit_price', unit_price2='$unit_price2', discount='$discount', discount3='$discount3', amount='$amount', amount2='$amount2', dummy='$dummy', unit_cost='$unit_cost', amount_cost='$amount_cost' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//----------update bincard (credit qty)
							/*$sqlstr="update bincard set location_code='$location_id', date='$date', item_code='$item_code', uom_code='$uom_code', unit_price='$unit_price', credit_qty='$qty', amount='$amount', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='cashier' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();*/
							
							//----------AUDIT TRAIL bincard (update)
							/*$sqlstr="insert into adt_bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu, adt_status) values ('$ref', '$location_id', '$date', 'pos', '', '$item_code', '$uom_code', '$unit_price', 0, '$qty', '$amount', '$old_line', '$uid', '$dlu', 'update')";				
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();*/
							
							$total_amount	=	$total_amount + $amount;
							
						
						} else {
							$sqlstr="delete from sales_invoice_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//----------delete bincard (credit qty)
							$sqlstr="delete from bincard where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='pos' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//----------AUDIT TRAIL bincard (delete)
							/*$sqlstr="insert into adt_bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu, adt_status) values ('$ref', '$old_location_id', '$date', 'pos', '', '$item_code', '$uom_code', '$unit_price', 0, '$qty', '$amount', '$old_line', '$uid', '$dlu', 'delete')";			
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();*/
							
						}
						
						
					} else {
						
						//get cogs
						$sqlprice = "select b.current_cost cogs, a.name from item a left join set_item_cost b on a.syscode=b.item_code where a.syscode='$item_code' and a.uom_code_sales='$uom_code' order by b.date_of_record desc limit 1 ";
						$resultprice=$dbpdo->prepare($sqlprice);
						$resultprice->execute();
						$dataprice		= $resultprice->fetch(PDO::FETCH_OBJ);
						$unit_cost	= numberreplace($dataprice->cogs);	
						$amount_cost= $qty * $unit_cost;
						
						$line = maxline('sales_invoice_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into sales_invoice_detail (ref, do_ref, so_ref, return_ref, item_code, uom_code, qty, discount, discount3, unit_price, unit_price2, amount, amount2, dummy, non_discount, unit_cost, amount_cost, line_item_do, line_item_so, line) values ('$ref', '$do_ref', '$so_ref', '$return_ref', '$item_code', '$uom_code', '$qty', '$discount', '$discount3', '$unit_price', '$unit_price2', '$amount', '$amount2', '$dummy', '$non_discount', '$unit_cost', '$amount_cost', '$line_item_do', '$line_item_so', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						//----------insert bincard (debit qty)
						/*$expired_date = "00:00:00";
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'pos', '', '$item_code', '$uom_code', '$expired_date', '$unit_price', 0, '$qty', '$amount', '$line', '$uid', '$dlu')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();*/
						
						//----------AUDIT TRAIL bincard (insert)
						/*$sqlstr="insert into adt_bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu, adt_status) values ('$ref', '$location_id', '$date', 'pos', '', '$item_code', '$uom_code', '$unit_price', 0, '$qty', '$amount', '$line', '$uid', '$dlu', 'insert')";					
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();*/
						
						$total_amount	=	$total_amount + $amount;
						
					}
					
					
					//----------insert/update set_item_price (ditutup krn harga di seting di set item price aja)
					/*
					$sqlprice = "select item_code from set_item_price where item_code='$item_code' and uom_code='$uom_code' and current_price='$unit_price' and location_id='$location_id' order by date_of_record desc limit 1 ";
					$resultprice = mysql_query($sqlprice);
					$numprice = mysql_num_rows($resultprice);
					
					if($numprice == 0) {
						$sqlprice2 = "select current_price from set_item_price where item_code='$item_code' and uom_code='$uom_code' and location_id='$location_id' order by date_of_record desc limit 1 ";
						$resultprice2 = mysql_query($sqlprice2);
						$dataprice = mysql_fetch_object($resultprice2);
					
						$last_price			=	$dataprice->current_price;
						$date_of_record		=	date("Y-m-d H:i:s");
						
						$sqlstr="insert into set_item_price (date, efective_from, item_code, uom_code, current_price, last_price, date_of_record, uid, dlu) values ('$date', '$date', '$item_code', '$uom_code', '$unit_price', '$last_price', '$date_of_record', '$uid', '$dlu')";				
						$sql=$dbpdo->prepare($sqlstr);
					}	*/
					//------------------------------------/\
					
					
				}
			}
			
			$channel_id 		=	numberreplace($_POST["channel_id"]);
			$cash				=	$_POST["cash"];
			$employee_id		= 	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			$ship_to			=	petikreplace($_POST["ship_to"]);
			$bill_to			=	petikreplace($_POST["bill_to"]);
			$top				=	$_POST["top"];
			$due_date			=	date("Y-m-d", strtotime($_POST["due_date"]));
			$tax_code			=	$_POST["tax_code"];
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$expedition_id		= 	numberreplace($_POST["expedition_id"]);	
			$freight_cost 		= 	numberreplace($_POST["freight_cost"]);
			$freight_account	= 	$_POST["freight_account"];
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);
			$memo				= 	$_POST["memo"];
			$discount2			=	numberreplace($_POST["discount"]);
			$total				=	$total_amount + $freight_cost; //numberreplace($_POST["total"]); //$sub_total; 			
			$deposit			=	numberreplace($_POST["deposit"]);
			$photo_file			=	"";
			
			$cash_amount		=	numberreplace($_POST["cash_amount"]);
			$cash_voucher		=	numberreplace($_POST["cash_voucher"]);
			$bank_id			=	(empty($_POST["bank_id"])) ? 0 : $_POST["bank_id"];
			$bank_amount		=	numberreplace($_POST["bank_amount2"]);
			$credit_card_code	=	(empty($_POST["credit_card_code"])) ? 0 : $_POST["credit_card_code"];
			$card_amount		=	numberreplace($_POST["card_amount"]);
			$credit_card_no		=	$_POST["credit_card_no"];
			$credit_card_holder	=	petikreplace($_POST["credit_card_holder"]);
			$note_transfer 		=	petikreplace($_POST["note_transfer"]);
			$note_ecommerce 	=	petikreplace($_POST["note_ecommerce"]);

			$change_amount		=	($cash_amount + $bank_amount + $card_amount) - $total_amount; //numberreplace($_POST["change_amount"]);
			$shift				=	numberreplace($_POST["shift"]);
			$cash				=	(empty($_POST["cash"])) ? 0 : $_POST["cash"];

			$paid = 0;
			if($status == "Paid") {
				$paid = 1;
			}
			
			$sqlstr="update sales_invoice set ref2='$ref2', date='$date', client_code='$client_code', status='$status', channel_id='$channel_id', top='$top', due_date='$due_date', phone='$phone', ship_to='$ship_to', bill_to='$bill_to', taxable='$taxable', tax_code='$tax_code', tax_rate='$tax_rate', freight_cost='$freight_cost', freight_account='$freight_account', currency_code='$currency_code', rate='$rate', employee_id='$employee_id', discount='$discount2', total='$total', memo='$memo', location_id='$location_id', deposit='$deposit', photo_file='$photo_file', cash_amount='$cash_amount', cash_voucher='$cash_voucher', bank_id='$bank_id', bank_amount='$bank_amount', credit_card_code='$credit_card_code', card_amount='$card_amount', credit_card_no='$credit_card_no', credit_card_holder='$credit_card_holder', change_amount='$change_amount', shift='$shift', client_member_code='$client_member_code', cash='$cash', bank_account='$bank_account', expedition_id='$expedition_id', expedition_bill='$expedition_bill', receipt_type='$receipt_type', note_transfer='$note_transfer', note_ecommerce='$note_ecommerce', paid='$paid', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//----update address client
			$address = petikreplace($_POST['address']);
			$sqlstr="update client set address='$address' where syscode='$client_code'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*---------insert audit trail (update)------------*/
			/*$sqlstr="insert into adt_sales_invoice (ref, ref2, date, status, top, due_date, client_code, ship_to, bill_to, tax_code, tax_rate, freight_cost, freight_account, currency_code, rate, employee_id, discount, total, memo, opening_balance, cash, location_id, deposit, taxable, photo_file, cash_amount, cash_voucher, bank_id, bank_amount, credit_card_code, card_amount, credit_card_no, credit_card_holder, change_amount, shift, client_member_code, uid, dlu, adt_status) values('$ref', '$ref2', '$date', 'R', '$top', '$due_date', '$client_code', '$ship_to', '$bill_to', '$tax_code', '$tax_rate', '$freight_cost', '$freight_account', '$currency_code', '$rate', '$employee_id', '$discount2', '$total', '$memo', 0, '$cash', '$location_id', '$deposit', '$taxable', '$photo_file', '$cash_amount', '$cash_voucher', '$bank_id', '$bank_amount', '$credit_card_code', '$card_amount', '$credit_card_no', '$credit_card_holder', '$change_amount', '$shift', '$client_member_code', '$uid', '$dlu', 'update')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();*/
			
			
            ##jika piutang
            if($ref_type == "Kredit") {
				
				$total = $total - $deposit;
				
				$sqlcekar = "select ref from ar where ref='$ref'";
				$sql=$dbpdo->prepare($sqlcekar);
				$sql->execute();
				$rowsar = $sql->rowCount();
				
				if($rowsar == 1) {
					//update AR
					$sqlstr="update ar set date='$date', contact_code='$client_code', due_date='$due_date', debit_amount='$total', top='$top', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_type='cashier' and ref_type='pos' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
					//insert AR
					$sqlstr="insert into ar(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'C', '$client_code', '', '$total', 0, 'cashier', 'pos', '$currency_code', '$rate', '', '', '$top', '$memo', '$uid', '$dlu')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			} else {
				$sqlcekar = "delete from ar where ref='$ref'";
				$sql=$dbpdo->prepare($sqlcekar);
				$sql->execute();
			}
            //---------
            
			if($bank_amount > 0) {
				
				$sqlbnk = "select name, account_code, account_coa from bank where id='$bank_id' ";
				$sql=$dbpdo->prepare($sqlbnk);
				$sql->execute();
				$data = $sql->fetch(PDO::FETCH_OBJ);
				
				$cheque_no		= $data->account_code;
				$bank_name		= $data->name;
				$receipt_type	= "transfer";
				$cheque_date	= $date;
				$total			= $bank_amount;
				$account_code	= $data->account_coa;
				
				//insert ARC
				$sqlstr = "select ref from arc where ref='$ref' and type='$receipt_type'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows = $sql->rowCount();
				
				if($rows > 0) {
					$sqlstr="update arc set date='$date', client_code='$client_code', cheque_no='$cheque_no', bank_name='$bank_name', cheque_date='$cheque_date', amount='$total', currency_code='$currency_code', rate='$rate', account_code='$account_code', memo='$memo', uid='$uid', dlu='$dlu' where type='$receipt_type' and ref='$ref'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
					$sqlstr="insert into arc (ref, date, client_code, cheque_no, bank_name, cheque_date, amount, currency_code, rate, account_code, type, memo, uid, dlu) values('$ref', '$date', '$client_code', '$cheque_no', '$bank_name', '$cheque_date', '$total', '$currency_code', '$rate', '$account_code', '$receipt_type', '$memo', '$uid', '$dlu')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}								
				
			}
			
			if($card_amount > 0) {
				
				$sqlbnk = "select name, account_code from credit_card_type where code='$credit_card_code' ";
				$sql=$dbpdo->prepare($sqlbnk);
				$sql->execute();
				$data = $sql->fetch(PDO::FETCH_OBJ);
								
				$cheque_no		= $credit_card_no;
				$bank_name		= $data->name;
				$receipt_type	= "card";
				$cheque_date	= $date;
				$total			= $card_amount;
				$account_code	= $data->account_code;
				
				//insert ARC
				$sqlstr = "select ref from arc where ref='$ref' and type='$receipt_type'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows = $sql->rowCount();
				
				if($rows > 0) {
					$sqlstr="update arc set date='$date', client_code='$client_code', cheque_no='$cheque_no', bank_name='$bank_name', cheque_date='$cheque_date', amount='$total', currency_code='$currency_code', rate='$rate', account_code='$account_code', memo='$memo', uid='$uid', dlu='$dlu' where type='$receipt_type' and ref='$ref'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
					$sqlstr="insert into arc (ref, date, client_code, cheque_no, bank_name, cheque_date, amount, currency_code, rate, account_code, type, memo, uid, dlu) values('$ref', '$date', '$client_code', '$cheque_no', '$bank_name', '$cheque_date', '$total', '$currency_code', '$rate', '$account_code', '$receipt_type', '$memo', '$uid', '$dlu')";
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
	
	
	//---------get data sales_order_cutting
	function update_sales_order_cutting(){	
		$dbpdo = DB::create();
		
		$ref			=	$_POST["ref"];
		$item_code_old 	= 	$_POST["item_code_old"];
		$item_code		=	$_POST["item_code"];
		
		//get harga
		$sqlprice = $this->list_set_item_price_last("", $item_code);
		$dataprice = $sqlprice->fetch(PDO::FETCH_OBJ);
		$unit_price = $dataprice->current_price;
		$amount = $unit_price * 1;
		 	
		$sqlstr="update sales_order_detail set item_code='$item_code', unit_price='$unit_price', amount='$amount' where ref='$ref' and item_code='$item_code_old'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get set data item price __
	function list_set_item_price_last($location_id, $item_code){	 
		
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}								
		}
		
		/*if ( $item_code != "") {*/
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		/*}*/
		
		if($location_id=='' && $item_code=='') {
			$where = " where a.item_code = 'ndf'";
		}
		
		$sqlstr="select a.date, a.efective_from, a.item_code, a.uom_code, a.current_price, a.current_price1, a.current_price2, a.current_price3, a.tax_rate, a.price_tax, a.price_member_tax, a.margin_warehouse, a.margin_mlm, a.registration_rate, a.registration_rate_platinum, a.last_price, a.date_of_record, a.location_id, a.qty1, a.uid, a.dlu from set_item_price a " . $where . " order by a.date_of_record desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----update sales order upload
	function update_sales_order_upload($ref){
		$dbpdo = DB::create();
		
		try {
			
			//-----------upload file
		  	$photo2			= $_POST["file_transfer2"];
			$uploaddir_photo= 'app/file_transfer/';
			$photo			= $_FILES['file_transfer']['name']; 
			$tmpname_photo 	= $_FILES['file_transfer']['tmp_name'];
			$filesize_photo = $_FILES['file_transfer']['size'];
			$filetype_photo = $_FILES['file_transfer']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						unlink($uploaddir_photo . $photo2); //remove file 					
					}
					
					$photo = $ref . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['file_transfer']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			
			$sqlstr="update sales_order set file_transfer='$photo' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------update_sales_order_approved
	function update_sales_order_approved($ref){
		$dbpdo = DB::create();
		
		try {
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr="update sales_order set status='A', dlu2='$dlu', uid2='$uid' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update sales order CS
	function update_sales_order_cs($ref){	
		
		$dbpdo 		= DB::create();
		try {
			
			$dbpdo->beginTransaction();
			
			
			//----------update so detail (READY STOCK)
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];			
			for ($i=0; $i<=$jmldata; $i++) {
				$old_item_code	 	= $_POST[old_item_code_.$i];
				$old_uom_code 		= $_POST[old_uom_code_.$i];
				$old_line		 	= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$item_code	 	= $_POST[item_code_.$i];
				$uom_code 		= $_POST[uom_code_.$i];				
				$m_type			= $_POST[m_type_.$i];
				
				//update ready stock
				if($m_type == 0) {				
					if ( !empty($item_code) && !empty($uom_code) ) {
						$qty 		= numberreplace($_POST[old_qty_.$i]);
						$unit_price	= numberreplace($_POST[unit_price_.$i]);
						$discount 	= numberreplace($_POST[discount_det_.$i]);
						$discount_id = $_POST[old_discount_id_.$i];
						
						//get discount
						$sqlstr="select ifnull(value,0) value from discount where id='$discount_id'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$datadiscount=$sql->fetch(PDO::FETCH_OBJ);
						$discount = $datadiscount->value;
						$discount = ($discount * $unit_price)/100;
						$amount   = ($unit_price - $discount) * $qty;
						//$amount   = $amount - $discount;
						
						$sqlstr="update sales_order_detail set qty='$qty', discount_id='$discount_id', discount='$discount', unit_price='$unit_price', amount='$amount' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
				
				if($m_type == 1) {
					//----------insert item detail
					$item_code = $_POST["item_code"];
					$exp = explode("|", $item_code);
					
					$qty = $_POST["qty"];
					$expqty = explode("|", $qty);
					
					$unit_price = $_POST["unit_price"];
					$expunit_price = explode("|", $unit_price);
					
					$discount_id = $_POST["discount_id"];
					$expdiscount_id = explode("|", $discount_id);
					
					$jmldata1 = count($exp);  //(empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
					$j = 0;
					for ($j=0; $j<=$jmldata1; $j++) {
						
						$item_code= $exp[$j];
						$qty= numberreplace($expqty[$j]);
						$unit_price= numberreplace($expunit_price[$j]);
						$discount_id = $expdiscount_id[$j];
						
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
							
							$sqlstr="select ref from sales_order_detail where ref='$ref' and item_code='$item_code' and item_status='RS' and upd='add'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							$rows=$sql->rowCount();
							
							if($rows == 0) {						
								$line = maxline('sales_order_detail', 'line', 'ref', $ref, '');
								
								//RS = Ready Stock
								$sqlstr="insert into sales_order_detail (ref, item_code, uom_code, qty, discount_id, discount, unit_price, amount, item_status, upd, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$discount_id', '$unit_price', '$amount', 'RS', 'add', $line)";
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
							
								$sqlstr="update sales_order_detail set qty='$qty', unit_price='$unit_price', discount_id='$discount_id', discount='$discount', amount='$amount' where ref='$ref' and item_code='$item_code' and upd='add'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
							}
							
						
						}
					}
				}
			}
			
			
			//----------update so detail (PO)
			$i = 0;
			$jmldata_po = (empty($_POST['jmldata_po'])) ? 0 : $_POST['jmldata_po'];		
			for ($i=0; $i<=$jmldata_po; $i++) {
				$old_item_code	 	= $_POST[old_item_code_po_.$i];
				$old_uom_code 		= $_POST[old_uom_code_po_.$i];
				$old_line		 	= (empty($_POST[old_line_po_.$i])) ? 0 : $_POST[old_line_po_.$i];
				
				$item_code	 	= $_POST[item_code_po_.$i];
				$uom_code 		= $_POST[uom_code_po_.$i];				
				$m_type			= $_POST[m_type_po_.$i];
				
				//update PO
				if($m_type == 0) {				
					if ( !empty($item_code) && !empty($uom_code) ) {
						$qty 		= numberreplace($_POST[old_qty_po_.$i]);
						$unit_price	= numberreplace($_POST[unit_price_po_.$i]);
						$discount 	= numberreplace($_POST[discount_det_po_.$i]);
						$amount 	= numberreplace($_POST[amount_po_.$i]);
						$discount_id = $_POST[old_discount_id_po_.$i];
						
						//get discount
						$sqlstr="select ifnull(value,0) value from discount where id='$discount_id'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$datadiscount=$sql->fetch(PDO::FETCH_OBJ);
						$discount = $datadiscount->value;
						$discount = ($discount * $unit_price)/100;
						$amount   = ($unit_price - $discount) * $qty;
						//$amount   = $amount - $discount;
						
						$sqlstr="update sales_order_detail set qty='$qty', discount_id='$discount_id', discount='$discount', unit_price='$unit_price', amount='$amount' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
				
				if($m_type == 1) {
					//----------insert item detail PO
					$item_code_po = $_POST["item_code_po"];
					$exp_po = explode("|", $item_code_po);
					
					$qty_po = $_POST["qty_po"];
					$expqty_po = explode("|", $qty_po);
					
					$unit_price_po = $_POST["unit_price_po"];
					$expunit_price_po = explode("|", $unit_price_po);
					
					$discount_id_po = $_POST["discount_id_po"];
					$expdiscount_id_po = explode("|", $discount_id_po);
					
					$jmldata_po1 = count($exp_po);  //(empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
					$j=0;
					for ($j=0; $j<=$jmldata_po1; $j++) {
						
						$item_code= $exp_po[$j];
						$qty= numberreplace($expqty_po[$j]);
						$unit_price= numberreplace($expunit_price_po[$j]);
						$discount_id = $expdiscount_id_po[$j];
						
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
							
							$sqlstr="select ref from sales_order_detail where ref='$ref' and item_code='$item_code' and item_status='PO' and upd='add'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							$rows=$sql->rowCount();
							
							if($rows == 0) {						
								$line = maxline('sales_order_detail', 'line', 'ref', $ref, '');
								
								//RS = Ready Stock
								$sqlstr="insert into sales_order_detail (ref, item_code, uom_code, qty, discount_id, discount, unit_price, amount, item_status, upd, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$discount_id', '$unit_price', '$amount', 'PO', 'add', $line)";
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
							
								$sqlstr="update sales_order_detail set qty='$qty', unit_price='$unit_price', discount_id='$discount_id', discount='$discount', amount='$amount' where ref='$ref' and item_code='$item_code' and upd='add'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								
							}
							
						
						}
					}
				}
			}
			
			//update field upd=''
			$sqlstr="update sales_order_detail set upd='' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//get total amount
			$sqlstr="select sum(amount) total_amount from sales_order_detail where ref='$ref' group by ref";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data=$sql->fetch(PDO::FETCH_OBJ);
			$total=$data->total_amount;
			//-------------------
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$transfer_date	=	date("Y-m-d", strtotime($_POST["transfer_date"]));
			$status			= 	$_POST["status"];
			$employee_id	= 	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			$newclient		= 	(empty($_POST["newclient"])) ? 0 : $_POST["newclient"];
			$client_code	=	$_POST["client_code"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$qo_ref				=	$_POST["qo_ref"];
			$top				=	$_POST["top"];
			$tax_code			=	$_POST["tax_code"];
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$freight_cost 		= 	numberreplace($_POST["freight_cost"]);
			$freight_account	= 	$_POST["freight_account"];
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);
			$memo				= 	$_POST["memo"];
			$total				=	$total + $freight_cost; //numberreplace($_POST["total"]) + $freight_cost; 
			
			
			$sqlstr="update sales_order set date='$date', status='$status', top='$top', client_code='$client_code', qo_ref='$qo_ref', tax_code='$tax_code', tax_rate='$tax_rate', freight_cost='$freight_cost', freight_account='$freight_account', currency_code='$currency_code', rate='$rate', employee_id='$employee_id', total='$total', transfer_date='$transfer_date', memo='$memo', uid2='$uid', dlu2='dlu' where ref='$ref'";
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
	
	
	//-----update delivery order
	function update_delivery_order($ref){
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
			
			//----------update store request detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST['delete_'.$i.''])) ? 0 : $_POST['delete_'.$i.''];
				
				$old_item_code	 	= $_POST['old_item_code_'.$i.''];
				$old_uom_code 		= $_POST['old_uom_code_'.$i.''];
				$old_line		 	= (empty($_POST['old_line_'.$i.''])) ? 0 : $_POST['old_line_'.$i.''];
				$old_qty			= numberreplace($_POST['old_qty_'.$i.'']);
				
				$so_ref 		= $_POST['so_ref_'.$i.''];
				$item_code	 	= $_POST['item_code_'.$i.''];
				$uom_code 		= $_POST['uom_code_'.$i.''];
				$line_item_so	= $_POST['so_line_'.$i.''];
				
				if ( !empty($item_code) && !empty($uom_code) ) {
					$qty 		= numberreplace($_POST['qty_'.$i.'']);
					$unit_price	= numberreplace($_POST['unit_price_'.$i.'']);
					$discount	= numberreplace($_POST['discount_'.$i.'']);
					
					$sqlstr = "select ref from delivery_order_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update delivery_order_detail set qty='$qty' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							$sqlstr="update sales_invoice_detail set qty_shp=ifnull(qty_shp,0) - $old_qty + $qty where ref='$so_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_so' ";	
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();

							$sqlstr="update sales_invoice set process_whs=1 where ref='$so_ref'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							##bincard update
							$unit_price = $unit_price - $discount;
							$amount = $unit_price * $qty;
							$sqlstr="update bincard set unit_price='$unit_price', credit_qty='$qty', amount='$amount', location_code='$location_id' where invoice_no='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";		
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
								
						} else {
							$sqlstr="delete from delivery_order_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
							##delete update
							$sqlstr = "delete from bincard where invoice_no='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							##--------update qty sales order
							$sqlstr="update sales_invoice_detail set qty_shp=ifnull(qty_shp,0) - $old_qty where ref='$so_ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$line_item_so' ";	
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
				}
			}
			
			
			$sqlstr="update delivery_order set date='$date', location_id='$location_id', memo='$memo', uid2='$uid', dlu2='$dlu' where ref='$ref'";
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
	
	
	//-----update promo
	function update_promo($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update promo set name='$name', active='$active', uid='$uid', dlu='$dlu' where id='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update vendor type
	function update_vendor_type($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name				=	$_POST["name"];
			$location_id 	=	0;
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update vendor_type set name='$name', pch_account='$pch_account', pch_return_account='$pch_return_account', pch_discount_account='$pch_discount_account', vendor_deposit_account='$vendor_deposit_account', currency_account='$currency_account', cheque_payable_account='$cheque_payable_account', location_id='$location_id', active='$active', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

			//----------update  detail
			/*$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				
				$old_id		 	= (empty($_POST[old_id_.$i])) ? 0 : $_POST[old_id_.$i];
				$old_line	 	= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$pch_account			=	$_POST[pch_account_.$i];
				$pch_cash_account		=	$_POST[pch_cash_account_.$i];
				$pch_return_account		=	$_POST[pch_return_account_.$i];
				$pch_discount_account	=	$_POST[pch_discount_account_.$i];
				$vendor_deposit_account	=	$_POST[vendor_deposit_account_.$i];
				$currency_account		=	$_POST[currency_account_.$i];
				$cheque_payable_account	=	$_POST[cheque_payable_account_.$i];
				$hutang_belum_faktur	=	$_POST[hutang_belum_faktur_.$i];
				$location_id	=	(empty($_POST[location_id_.$i])) ? 0 : $_POST[location_id_.$i];
							
				if ( $location_id > 0 ) {
					
					$sqlstr = "select id from vendor_type_detail where id_header='$ref' and id='$old_id' and line='$old_line' ";			
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update vendor_type_detail set pch_account='$pch_account', pch_cash_account='$pch_cash_account', pch_return_account='$pch_return_account', pch_discount_account='$pch_discount_account', vendor_deposit_account='$vendor_deposit_account', currency_account='$currency_account', cheque_payable_account='$cheque_payable_account', hutang_belum_faktur='$hutang_belum_faktur', location_id='$location_id' where id_header='$ref' and id='$old_id' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from vendor_type_detail where id_header='$ref' and id='$old_id' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						}
						
						
					} else {
						
						$line = maxline('vendor_type_detail', 'line', 'id_header', $ref, '');
					
						$sqlstr="insert into vendor_type_detail (id_header, pch_account, pch_cash_account, pch_return_account, pch_discount_account, vendor_deposit_account, currency_account, cheque_payable_account, hutang_belum_faktur, location_id, line) values ('$ref', '$pch_account', '$pch_cash_account', '$pch_return_account', '$pch_discount_account', '$vendor_deposit_account', '$currency_account', '$cheque_payable_account', '$hutang_belum_faktur', '$location_id', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();				
											
					}
					
				}
			}*/
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----update vendor
	function update_vendor($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	petikreplace($_POST["code"]);
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
			
			$sqlstr="update vendor set code='$code', name='$name', contact_person='$contact_person', vendor_type='$vendor_type', address='$address', zip_code='$zip_code', country_id='$country_id', state_id='$state_id', phone='$phone', fax='$fax', email='$email', web='$web', bank_account='$bank_account', active='$active', uid='$uid', dlu='$dlu' where syscode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update sewing
	function update_sewing($ref){	
		
		$dbpdo 		= DB::create();
		try {
			
			$dbpdo->beginTransaction();
			
			$old_location_id	=	(empty($_POST["old_location_id"])) ? 0 : $_POST["old_location_id"];
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));
			$location_id		=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//----------update item return detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				
				$old_item_code	 	= $_POST[old_item_code_.$i];
				$old_uom_code 		= $_POST[old_uom_code_.$i];
				$old_qty 			= numberreplace($_POST[old_qty_.$i]);
				$old_line		 	= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$item_code3	 	= $_POST[item_code3_.$i];
				$item_code	 	= $_POST[item_code_.$i];
				$uom_code 		= $_POST[uom_code_.$i];
				$size 			= numberreplace($_POST[size_.$i]);
				$qty 			= numberreplace($_POST[qty_.$i]);
				$unit_cost 		= numberreplace($_POST[unit_cost_.$i]);
				$amount 		= numberreplace($_POST[amount_.$i]); 
				
				//jika add item baru
				if($item_code3 != "") {
					$sqlstr = "select syscode, uom_code_stock uom_code from item where (code='$item_code3' or old_code='$item_code3') limit 1 ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$data = $sql->fetch(PDO::FETCH_OBJ);
					
					$item_code	= $data->syscode;
					$uom_code	= $data->uom_code;
					if($qty == "" || $qty == 0) {
						$qty = 1;
					}
					
					$selectview = new selectview;
					if($unit_cost == "" || $unit_cost == 0) {
						$unit_cost = $selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
					}
					
					if($amount == "" || $amount == 0) {
						$amount = $qty * $unit_cost;
					}
										
				}
				
				if ( !empty($item_code) && !empty($uom_code) ) {
					
					$discount1 = numberreplace($_POST[discount3_1_.$i]);
					$discount2 = numberreplace($_POST[discount3_2_.$i]);
	                
					$sqlstr = "select ref from sewing_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							
							//jika tidak ada item baru
							$sqlstr="update sewing_detail set item_code='$item_code', uom_code='$uom_code', size='$size', qty='$qty', unit_cost='$unit_cost', discount1='$discount1', discount2='$discount2', amount='$amount' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//----------update bincard (credit qty)
							$sqlstr="update bincard set location_code='$location_id', date='$date', item_code='$item_code', uom_code='$uom_code', unit_price='$unit_cost', credit_qty='$qty', amount='$amount', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='sewing' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
													
								
						} else {
							$sqlstr="delete from sewing_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
							//----------delete bincard (debit qty)
							$sqlstr="delete from bincard where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='sewing' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
																		
						}
						
						
					} else {
						$line = maxline('sewing_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into sewing_detail (ref, item_code, uom_code, size, qty, unit_cost, discount1, discount2, amount, counting_line, qty_good, qty_damaged, remark_damaged, status_damaged, qty_do, line) values ('$ref', '$item_code', '$uom_code', '$size', '$qty', '$unit_cost', '$discount1', '$discount2', '$amount', '0', '$qty_good', '0', '', '$status_damaged', '0', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						//----------insert bincard (credit qty)
						$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_inv', '', '$item_code', '$uom_code', '$unit_cost', '0', '$qty', '$amount', '$line', '$uid', '$dlu')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
					
					
				}
			}
			
			
			//insert new item-------------------\/
			$item_code3		= $_POST['item_code2'];
			$uom_code 		= $_POST['uom_code'];
			$size 			= numberreplace($_POST['size']);
			$qty 			= numberreplace($_POST['qty']);
			$unit_cost 		= numberreplace($_POST['unit_cost']);
			$amount 		= numberreplace($_POST['amount']); 
			
			//jika add item baru
			if($item_code3 != "") {
				
				$sqlstr = "select syscode, uom_code_stock uom_code from item where (code='$item_code3' or old_code='$item_code3') limit 1 ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data = $sql->fetch(PDO::FETCH_OBJ);
				
				$item_code	= $data->syscode;
				$uom_code	= $data->uom_code;
				if($qty == "" || $qty == 0) {
					$qty = 1;
				}
				
				$selectview = new selectview;
				if($unit_cost == "" || $unit_cost == 0) {
					$unit_cost = $selectview->list_purchase_invoice_last_cost($item_code, $uom_code);
				}
				
				if($amount == "" || $amount == 0) {
					$amount = $qty * $unit_cost;
				}
									
			}
			
			if ( !empty($item_code) && !empty($uom_code) ) {
				
				$discount		= numberreplace($_POST['discount_det']); //discount nominal
				$discount1		= numberreplace($_POST['discount3_1_det']); //discount %
				
                
                $discount2 = 0;
                $discount3 = 0;
				
				$line_item_po = maxline('sewing_detail', 'line', 'ref', $ref, '');
				
				$sqlstr = "select ref from sewing_detail where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$num = $sql->rowCount();
				
				if($num > 0) {
					
					$sqlstr = "select sum(qty) qty_old from sewing_detail where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' group by ref, item_code, uom_code ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$data_qty = $sql->fetch(PDO::FETCH_OBJ);
					$qty_upd = $data_qty->qty_old + $qty;
					$amount_upd = $unit_cost - (($unit_cost * $discount1)/100);
					$amount = $amount_upd * $qty_upd;
					
					$sqlstr="update sewing_detail set size='$size', qty=ifnull(qty,0) + $qty, unit_cost='$unit_cost', discount1='$discount1', discount2='$discount2', amount='$amount' where ref='$ref' and item_code='$item_code' and uom_code='$uom_code' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//----------update bincard (credit qty)
					$sqlstr="update bincard set location_code='$location_id', date='$date', unit_price='$unit_cost', credit_qty=ifnull(credit_qty,0) + $qty, amount='$amount', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_location_id' and item_code='$item_code' and uom_code='$uom_code' and invoice_type='sewing' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
						
					
				} else {
					$line = maxline('sewing_detail', 'line', 'ref', $ref, '');
					
					$sqlstr="insert into sewing_detail (ref, item_code, uom_code, size, qty, unit_cost, discount1, discount2, amount, counting_line, qty_good, qty_damaged, remark_damaged, status_damaged, qty_do, line) values ('$ref', '$item_code', '$uom_code', '$size', '$qty', '$unit_cost', '$discount1', '$discount2', '$amount', '0', '$qty_good', '0', '', '$status_damaged', '0', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//----------insert bincard (debit qty)
					$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'sewing', '', '$item_code', '$uom_code', '$unit_cost', '0', '$qty', '$amount', '$line', '$uid', '$dlu')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
										
				}	
			}		
			//---------------end item new--------/\
			
			
			
			//-get amount
			$sqlstr = "select sum(amount) amount from sewing_detail where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$total				=	$data->amount; //numberreplace($_POST["total"]);
			
			$finish_date		=	date("Y-m-d", strtotime($_POST["finish_date"]));
			$due_date			=	$finish_date;
			$status				= 	$_POST["status"];				
			$client_code		=	$_POST["client_code"];
			$vendor_code		= 	$_POST["vendor_code"];
			$payment_type		=	$_POST["payment_type"];
			$memo				= 	petikreplace($_POST["memo"]);	
			
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
			
			
			$sqlstr="update sewing set date='$date', finish_date='$finish_date', status='$status', client_code='$client_code', location_id='$location_id', vendor_code='$vendor_code', payment_type='$payment_type', memo='$memo', employee_id='$employee_id', qc_date='$qc_date', uid='$uid', total_amount='$total', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			if($payment_type == "credit") { //|| $payment_type == "consign") {
				//insert AP
				$sqlstr="delete from ap where ref='$ref' and invoice_type='sewing' and ref_type='sewing' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$currency_code 	= 1; //IDR
				$rate			= 0;	
				
				$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '$due_date', 'V', '$vendor_code', '', 0, '$total', 'sewing', 'sewing', '$currency_code', '$rate', '', '', '$top', '$memo', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				//insert AP
				$sqlstr="delete from ap where ref='$ref' and invoice_type='sewing' and ref_type='sewing' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			$dbpdo->commit();
			
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----update good receipt
	function update_good_receipt($ref){
		$dbpdo = DB::create();
		
		try {
			
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
			
			//----------update store request detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST['delete_'.$i.''])) ? 0 : $_POST['delete_'.$i.''];
				
				$old_item_code	 	= $_POST['old_item_code_'.$i.''];
				$old_uom_code 		= $_POST['old_uom_code_'.$i.''];
				$old_line		 	= (empty($_POST['old_line_'.$i.''])) ? 0 : $_POST['old_line_'.$i.''];
				$old_qty			= numberreplace($_POST['old_qty_'.$i.'']);
				
				$po_ref 		= $_POST['po_ref_'.$i.''];
				$item_code	 	= $_POST['item_code_'.$i.''];
				$uom_code 		= $_POST['uom_code_'.$i.''];
				$qty 			= numberreplace($_POST['qty_'.$i.'']);
				$status_det		= $_POST['status_'.$i.''];
				
				if ( !empty($item_code) && !empty($uom_code) ) {
					
					$unit_cost		= numberreplace($_POST['unit_cost_'.$i.'']);
					$pi_line		= $_POST['pi_line_'.$i.''];
					
					$sqlstr = "select ref from good_receipt_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update good_receipt_detail set status='$status_det', qty='$qty' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							$sqlstr="update purchase_invoice_detail set qty_good=ifnull(qty_good,0) - $old_qty + $qty where ref='$po_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$pi_line' ";	
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							##bincard update
							$amount = $unit_cost * $qty;
							$sqlstr="update bincard set unit_price='$unit_cost', debit_qty='$qty', amount='$amount', location_code='$location_id' where invoice_no='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";		
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();

							if($status_det == 'Good') {
								$sqlstr="select invoice_no from bincard where invoice_no='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";		
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								$rowsbin=$sql->rowCount();

								if($rowsbin == 0) {
									$amount = $unit_cost * $qty;
									$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'good_receipt', '$memo', '$item_code', '$uom_code', '00:00:00', '$unit_cost', '$qty', '0', '$amount', $old_line, '$uid', '$dlu')";		
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
								}
							}
								
						} else {
							$sqlstr="delete from good_receipt_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
							##delete update
							$sqlstr = "delete from bincard where invoice_no='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							##--------update qty purchase invoice
							$sqlstr="update purchase_invoice_detail set qty_good=ifnull(qty_good,0) - $old_qty where ref='$po_ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$pi_line' ";	
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
							##*****************************************##							
												
						}
					} 
				}
			}
			
			
			$sqlstr="update good_receipt set date='$date', status='$status', vendor_code='$vendor_code', date_arrival='$date_arrival', driver='$driver', vehicle='$vehicle', location_id='$location_id', do_ref='$do_ref', memo='$memo', receipt_type='$receipt_type', uid2='$uid', dlu2='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update outbound
	function update_outbound($ref){
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
			$uid_released	=	$_SESSION["loginname"];
			
			
			$old_warehouse_id_from	=	(empty($_POST["old_warehouse_id_from"])) ? 0 : $_POST["old_warehouse_id_from"];
			$old_warehouse_id_to	=	(empty($_POST["old_warehouse_id_to"])) ? 0 : $_POST["old_warehouse_id_to"];
				
			$sqlstr="update outbound set date='$date', status='$status', type='$type', reason='$reason', form_no='$form_no', warehouse_id_from='$warehouse_id_from', warehouse_id_to='$warehouse_id_to', employee_id='$employee_id', employee_id2='$employee_id2', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			

			//--------add item------------
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
			//---------------------

			
			//----------update outbound detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST['delete_'.$i.''])) ? 0 : $_POST['delete_'.$i.''];
				
				$old_item_code	 	= $_POST['old_item_code_'.$i.''];
				$old_uom_code 		= $_POST['old_uom_code_'.$i.''];
				$old_line		 	= (empty($_POST['old_line_'.$i.''])) ? 0 : $_POST['old_line_'.$i.''];
				
				$item_code	 	= $_POST['item_code_'.$i.''];
				$uom_code 		= $_POST['uom_code_'.$i.''];
				$expired_date	= "00:00:00";
				
				if ( !empty($item_code) && !empty($uom_code) ) {
					$qty 		= numberreplace($_POST['qty_'.$i.'']);
					$ref_pos	= $_POST['ref_pos_'.$i.''];
					
					$sqlstr = "select ref from outbound_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update outbound_detail set item_code='$item_code', uom_code='$uom_code', qty='$qty', ref_pos='$ref_pos' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							
							if($status == 'C') {
								
								/*cek bincard from*/
								$sqlstr="select invoice_no from bincard  where invoice_no='$ref' and location_code='$old_warehouse_id_from' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' and invoice_type='outbound' ";
								
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								$rowsdata = $sql->rowCount();
								
								if($rowsdata > 0) {
									//----------update bincard (credit qty)
									$sqlstr="update bincard set location_code='$warehouse_id_from', date='$date', item_code='$item_code', uom_code='$uom_code', credit_qty='$qty', description='$reason', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_warehouse_id_from' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' and invoice_type='outbound' ";
									
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
									
									
								} else {
									//----------insert bincard (credit qty) ======>FROM
									$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$warehouse_id_from', '$date', 'outbound', '$reason', '$item_code', '$uom_code', '$expired_date', 0, 0, '$qty', 0, '$old_line', '$uid', '$dlu')";
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
									
									
								}
								
								
								
								/*cek bincard to*/
								$sqlstr="select invoice_no from bincard  where invoice_no='$ref' and location_code='$old_warehouse_id_to' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' and invoice_type='outbound' ";
								
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								$rowsdata2 = $sql->rowCount();
								
								if($rowsdata2 > 0) {
									//----------update bincard (debit qty)
									$sqlstr="update bincard set location_code='$warehouse_id_to', date='$date', item_code='$item_code', uom_code='$uom_code', debit_qty='$qty', description='$reason', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_warehouse_id_to' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' and invoice_type='outbound' ";
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
									
									
								} else {
									//----------insert bincard (debit qty)  ========>TO
									$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$warehouse_id_to', '$date', 'outbound', '$reason', '$item_code', '$uom_code', '$expired_date', 0, '$qty', 0, 0, '$old_line', '$uid', '$dlu')";
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
									
								}
								
							}
								
						} else {
							$sqlstr="delete from outbound_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
							//----------delete bincard
							$sqlstr="delete from bincard where invoice_no='$ref' and location_code='$old_warehouse_id_from' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' and invoice_type='outbound' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
							
							$sqlstr="delete from bincard where invoice_no='$ref' and location_code='$old_warehouse_id_to' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' and invoice_type='outbound' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
											
						}
						
						
					} else {
						$line = maxline('outbound_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into outbound_detail (ref, item_code, uom_code, qty, ref_pos, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$ref_pos', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						
						if($status == "C") {
							//----------insert bincard (credit qty) ======>FROM
							$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$warehouse_id_from', '$date', 'outbound', '$reason', '$item_code', '$uom_code', 0, 0, '$qty', 0, '$line', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							
							//----------insert bincard (debit qty)  ========>TO 
							$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$warehouse_id_to', '$date', 'outbound', '$reason', '$item_code', '$uom_code', 0, '$qty', 0, 0, '$line', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							
						}
						
					}
					
					
					
				}
			}
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update uom
	function update_uom($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update uom set code='$code', name='$name', active='$active', uid='$uid', dlu='$dlu' where code='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update division
	function update_division($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update division set name='$name', uid='$uid', dlu='$dlu', active='$active' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update position
	function update_position($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update position set name='$name', uid='$uid', dlu='$dlu', active='$active' where id='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update colour
	function update_colour($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update colour set name='$name', uid='$uid', dlu='$dlu', active='$active' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update client type
	function update_client_type($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update client_type set name='$name', active='$active', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pos detail
	function update_pos_detail($ref, $line, $qty, $unit_price, $amount, $item_code, $uom_code, $discount, $discount3){	
		
		$dbpdo = DB::create();
		
		try {
			
			$qty 		    = numberreplace($qty);
			$unit_price     = numberreplace($unit_price);
			$amount 	    = numberreplace($amount); //* numberreplace($qty); //numberreplace($amount);
			$discount     	= numberreplace($discount);
			$discount3	    = numberreplace($discount3);
			
			##cek jmlh qty, krn berpengaruh harga jual
			$datenow = date("Y-m-d");
			$location_id = "0";
			/*$sqlprice = "select a.current_price, a.current_price1, a.current_price2, a.current_price3, a.qty1, a.qty2, a.qty3, a.qty4 from set_item_price a  where a.item_code='$item_code' and a.uom_code='$uom_code' and a.efective_from <='$datenow' order by a.date_of_record desc limit 1 ";
			//and a.location_id='$location_id' 
            $resultprice=$dbpdo->prepare($sqlprice);
			$resultprice->execute();
			$dataprice	= $resultprice->fetch(PDO::FETCH_OBJ);
			
			$current_price 	= $dataprice->current_price;
			$current_price1 = $dataprice->current_price1;
			$current_price2	= $dataprice->current_price2;
			$current_price3	= $dataprice->current_price3;
			
			$qty1 	= $dataprice->qty1;
			$qty2 	= $dataprice->qty2;
			$qty3	= $dataprice->qty3;
			$qty4	= $dataprice->qty4;
			
			if($qty > 0) {
				if($qty <= $qty1) {
					$unit_price = $current_price;
				}
				
				if( ($qty < $qty2) ) {
					$unit_price = $current_price; //$current_price1;
					
				}
				
				if( ($qty >= $qty2) ) {
					if($qty2 < $qty3) {
						$unit_price = $current_price1;
					}
					
				}
				if($qty >= $qty3) {
					$unit_price = $current_price2;
					
				}
				
				
				//jika qty tidak diseting harga
				if( $current_price > 0 && $current_price1 == 0 && $current_price2 == 0) {
					$unit_price = $current_price;
				}
				
				
			} else {
				$qty_tmp = ($qty * -1);
				
				if($qty_tmp <= $qty1) {
					$unit_price = $current_price;
				}
				
				if( ($qty_tmp < $qty2) ) {
					$unit_price = $current_price; //$current_price1;
					
				}
				
				if( ($qty_tmp >= $qty2) ) {
					if($qty2 < $qty3) {
						$unit_price = $current_price1;
					}
					
				}
				if($qty_tmp >= $qty3) {
					$unit_price = $current_price2;
				}
				
				
				//jika qty tidak diseting harga
				if( $current_price > 0 && $current_price1 == 0 && $current_price2 == 0) {
					$unit_price = $current_price;
				}*/
				
				/*if($qty_tmp <= $qty1) {
					$unit_price = $current_price;
				}
				if( ($qty_tmp > $qty1) && ($qty_tmp <= $qty2) ) {
					$unit_price = $current_price1;
					
				}
				if($qty_tmp > $qty2) {
					$unit_price = $current_price2;
				}*/
			//}
			
			
			//$amount = $qty * $unit_price;
			$total = $amount;
			##end cek

			$sqlstr="update sales_invoice_tmp set qty='$qty', unit_price='$unit_price', discount='$discount', discount3=$discount3, amount='$amount', total='$total' where ref='$ref' and line='$line'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
					
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
			
		return $sql;
	}
	
	
	//-----update new product
	function update_new_product($ref){
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
			$size_id			= $_POST["size_id"];  //	(empty($_POST["size_id"])) ? 0 : $_POST["size_id"];
			$uom_code_stock		=	$_POST["uom_code_stock"];
			$uom_code_sales		=	$uom_code_stock; //$_POST["uom_code_sales"];
			$uom_code_purchase	=	$uom_code_stock; //$_POST["uom_code_purchase"];
			$minimum_stock		=	numberreplace((empty($_POST["minimum_stock"])) ? 0 : $_POST["minimum_stock"]);
			$maximum_stock		=	numberreplace((empty($_POST["maximum_stock"])) ? 0 : $_POST["maximum_stock"]);
			$po_date		=	date("Y-m-d", strtotime($_POST["po_date"]));
			$photo_date		=	date("Y-m-d", strtotime($_POST["photo_date"]));
			$catalog_date	=	date("Y-m-d", strtotime($_POST["catalog_date"]));
			$publish_date	=	date("Y-m-d", strtotime($_POST["publish_date"]));
			$designer		=	petikreplace($_POST["designer"]);
			$balance		=	numberreplace($_POST["balance"]);
			$description	=	petikreplace($_POST["description"]);
			
			//-----------upload file
		  	$photo2			= $_POST["photo2"];
			$uploaddir_photo= 'app/photo_item/';
			$photo			= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo = $_FILES['photo']['size'];
			$filetype_photo = $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						unlink($uploaddir_photo . $photo2); //remove file 					
					}
					
					$photo = $ref . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	
			//----------------
			
			$consigned		=	(empty($_POST["consigned"])) ? 0 : $_POST["consigned"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$publish		=	$active;
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update item set code='$code', old_code='$old_code', name='$name', item_group_id='$item_group_id', item_subgroup_id='$item_subgroup_id', item_type_code='$item_type_code', item_category_id='$item_category_id', brand_id='$brand_id', size_id='$size_id', uom_code_stock='$uom_code_stock', uom_code_sales='$uom_code_sales', uom_code_purchase='$uom_code_purchase', minimum_stock='$minimum_stock', maximum_stock='$maximum_stock', photo='$photo', consigned='$consigned', balance='$balance', description='$description', publish='$publish', po_date='$po_date', photo_date='$photo_date', catalog_date='$catalog_date', publish_date='$publish_date', designer='$designer', active='$active', uid='$uid', dlu='$dlu' where syscode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			/*---------insert audit trail (update)------------*/
			/*$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$photo', '$consigned', '$active', '$uid', '$dlu', '$ref', 'update' )";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();*/
			
			
			#insert/update set item cost
			$item_code	=	$ref;
			$uom_code	=	$uom_code_purchase;
			$current_cost	=	numberreplace($_POST['current_cost']);
			$date_cost		=	date("Y-m-d", strtotime($_POST['date_cost']));
			$efective_from_cost	=	date("Y-m-d", strtotime($_POST['efective_from_cost']));
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id_cost	=	$_POST['location_id_cost'];
			$old_date_of_record		=	date("Y-m-d", strtotime($_POST['old_date_of_record']));
			
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
			
			$sqlstr = "select item_code, current_cost from set_item_cost where item_code='$item_code' and uom_code='$uom_code' and current_cost='$current_cost' and point_first_order='$point_first_order' and bonus_basic='$bonus_basic' and bonus_prestation='$bonus_prestation' and bonus_unilevel='$bonus_unilevel' and matching_sponsor='$matching_sponsor' and reward='$reward' and repeat_order='$repeat_order' and royalti='$royalti' and fo_point='$fo_point' and ro_point='$ro_point' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$last_cost = $data->current_cost;
			
			if($rows == 0) {
				$sqlstr = "insert into set_item_cost (date, efective_from, item_code, uom_code, current_cost, point_first_order, bonus_basic, bonus_prestation, bonus_unilevel, matching_sponsor, reward, repeat_order, royalti, total_budget, last_cost, fo_point, ro_point, date_of_record, location_id, uid, dlu) values('$date_cost', '$efective_from_cost', '$item_code', '$uom_code', '$current_cost', '$point_first_order', '$bonus_basic', '$bonus_prestation', '$bonus_unilevel', '$matching_sponsor', '$reward', '$repeat_order', '$royalti', '$total_budget', '$last_cost', '$fo_point', '$ro_point', '$date_of_record', '$location_id_cost', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr = "update set_item_cost set efective_from='$efective_from_cost', uom_code='$uom_code', current_cost='$current_cost', point_first_order='$point_first_order', bonus_basic='$bonus_basic', bonus_prestation='$bonus_prestation', bonus_unilevel='$bonus_unilevel', matching_sponsor='$matching_sponsor', reward='$reward', repeat_order='$repeat_order', royalti='$royalti', total_budget='$total_budget', last_cost='$last_cost', fo_point='$fo_point', ro_point='$ro_point', date_of_record='$date_of_record', location_id='$location_id_cost', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code' and date_of_record='$old_date_of_record'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			#insert/update set item price
			$item_code	=	$ref;
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
			$efective_from	=	date("Y-m-d", strtotime($_POST['efective_from']));
			$date_of_record	=	date("Y-m-d H:i:s");
			$location_id	=	$_POST['location_id'];
			$non_discount	=	$_POST['non_discount'];
			$qty1			=	numberreplace($_POST['qty1']);
			$qty2			=	numberreplace($_POST['qty2']);
			$qty3			=	numberreplace($_POST['qty3']);
			$qty4			=	numberreplace($_POST['qty4']);
			$old_date_of_record1		=	date("Y-m-d", strtotime($_POST['old_date_of_record1']));
			
			$sqlstr = "select item_code, current_price from set_item_price where date_of_record='$date_of_record' and item_code='$item_code' and uom_code='$uom_code' and current_price='$current_price' and current_price1='$current_price1' and current_price2='$current_price2' and tax_rate='$tax_rate' and price_tax='$price_tax' and price_member_tax='$price_member_tax' and margin_warehouse='$margin_warehouse' and margin_mlm='$margin_mlm' and registration_rate='$registration_rate' and registration_rate_platinum='$registration_rate_platinum'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows = $sql->rowCount();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$last_price = $data->current_price;
			
			if($rows == 0) {
				$sqlstr = "insert into set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, tax_rate, price_tax, price_member_tax, margin_warehouse, margin_mlm, registration_rate, registration_rate_platinum, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$tax_rate', '$price_tax', '$price_member_tax', '$margin_warehouse', '$margin_mlm', '$registration_rate', '$registration_rate_platinum', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				//audit trail insert
				$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'insert')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr = "update set_item_price set efective_from='$efective_from', uom_code='$uom_code', current_price='$current_price', current_price1='$current_price1', current_price2='$current_price2', current_price3='$current_price3', tax_rate='$tax_rate', price_tax='$price_tax', price_member_tax='$price_member_tax', margin_warehouse='$margin_warehouse', margin_mlm='$margin_mlm', registration_rate='$registration_rate', registration_rate_platinum='$registration_rate_platinum', last_price='$last_price', date_of_record='$date_of_record', location_id='$location_id', non_discount='$non_discount', qty1='$qty1', qty2='$qty2', qty3='$qty3', qty4='$qty4', uid='$uid', dlu='$dlu' where item_code='$item_code' and uom_code='$uom_code' and date_of_record='$old_date_of_record1'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				//audit trail update
				$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$date', '$efective_from', '$item_code', '$uom_code', '$current_price', '$current_price1', '$current_price2', '$current_price3', '$last_price', '$date_of_record', '$location_id', '$non_discount', '$qty1', '$qty2', '$qty3', '$qty4', '$uid', '$dlu', 'update')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update fiannce type
	function update_finance_type($id){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
	        $name			=	petikreplace($_POST["name"]);
	        $location_id	=	(empty($_POST["location_id"])) ? 0 : $_POST["location_id"];
	        $type			=	$_POST["type"];
	        $account_code	=	$_POST["account_code"];
	        $active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update finance_type set name='$name', location_id='$location_id', type='$type', account_code='$account_code', active='$active', uid='$uid', dlu='$dlu' where id='$id'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------update general journal in
	function update_general_journal_in($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
						
			$date		=	date('Y-m-d', strtotime($_POST["date"]));
			$status		= 	$_POST["status"];
			$currency_code		= 	$_POST["currency_code"];
			$rate		=	str_replace(",","",(empty($_POST["rate"])) ? 0 : $_POST["rate"]);
			$memo		= 	$_POST["memo"];
			$total_balance		=	str_replace(",","",(empty($_POST["total_balance"])) ? 0 : $_POST["total_balance"]);
			$total_debit		=	str_replace(",","",(empty($_POST["total_debit"])) ? 0 : $_POST["total_debit"]);
			$total_credit		=	str_replace(",","",(empty($_POST["total_credit"])) ? 0 : $_POST["total_credit"]);
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$old_account_code	= $_POST[old_account_code_.$i];
				$old_line			= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$account_code 		= $_POST[account_code_.$i];
				$memo2 				= $_POST[memo_.$i];
				$debit_amount		= str_replace(",","",(empty($_POST[debit_amount_.$i])) ? 0 : $_POST[debit_amount_.$i]);
				$credit_amount		= str_replace(",","",(empty($_POST[credit_amount_.$i])) ? 0 : $_POST[credit_amount_.$i]);
				if ($account_code != '') { 		
					
					$sqlstr = "select ref from general_journal_detail where ref='$ref' and account_code='$old_account_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						$sqlstr = "update general_journal_detail set account_code='$account_code', memo='$memo2', debit_amount='$debit_amount', credit_amount='$credit_amount' where ref='$ref' and account_code='$old_account_code' and line='$old_line' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('general_journal_detail', 'line', 'ref', $ref, '');
					
						$sqlstr = "insert into general_journal_detail(ref, account_code, memo, debit_amount, credit_amount, line) values('$ref', '$account_code', '$memo2', '$debit_amount', '$credit_amount', '$line') ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
					}
					
				}
				
			}
			
			$sqlstr = "update general_journal set date='$date', status='$status', currency_code='$currency_code', rate='$rate', memo='$memo', total_balance='$total_balance', total_debit='$total_debit', total_credit='$total_credit', uid='$uid', dlu='$dlu' where  ref='$ref'";
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
	
	//-----update employee_basic_salary
	function update_employee_basic_salary($ref, $line){
		$dbpdo = DB::create();
		
		try {
			
			$efective_date		=	date("Y-m-d", strtotime($_POST["efective_date"]));
			$salary				=	numberreplace($_POST["salary"]);
			$position_allowance	=	numberreplace($_POST["position_allowance"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update employee_basic_salary set efective_date='$efective_date', salary='$salary', position_allowance='$position_allowance', uid='$uid', dlu='$dlu' where employee_id='$ref' and line='$line' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//------update salary
	function update_salary($ref){
		
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
				
				$old_salary_type_id	= $_POST[old_salary_type_id_.$i];
				$old_line			= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$minus				= (empty($_POST[minus_.$i])) ? 0 : $_POST[minus_.$i];
				$amount 			= numberreplace($_POST[amount_.$i]);
				$salary_type_id		= $_POST[salary_type_id_.$i];
				$memo				= petikreplace($_POST[memo_.$i]);
				
				if ($amount > 0 ) { 		
					
					$sqlstr = "select ref from salary_detail where ref='$ref' and salary_type_id='$old_salary_type_id' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						$sqlstr = "update salary_detail set amount='$amount', memo='$memo' where ref='$ref' and salary_type_id='$old_salary_type_id' and line='$old_line' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						if($minus == 1) {
							$total = $total - $amount;
						} else {
							$total = $total + $amount;
						}
						
					} else {
						$line = maxline('salary_detail', 'line', 'ref', $ref, '');
					
						$sqlstr = "insert into salary_detail(ref, salary_type_id, amount, memo, line) values('$ref', '$salary_type_id', '$amount', '$memo', '$line') ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						if($minus == 1) {
							$total = $total - $amount;
						} else {
							$total = $total + $amount;
						}
					}
					
				}
				
			}
			
			$sqlstr="update salary set date='$date', employee_id='$employee_id', total='$total', uid='$uid', dlu='$dlu' where ref='$ref'";
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
	
	
	//------update minute_meet
	function update_minute_meet($ref){
		
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
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				$old_line		= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$sub_subject 	= petikreplace($_POST[sub_subject_.$i]);
				$problem 		= petikreplace($_POST[problem_.$i]);
				$improvement	= petikreplace($_POST[improvement_.$i]);
				$due_date		= date("Y-m-d", strtotime($_POST[due_date_.$i]));
				$pic			= $_POST[pic_.$i];
				
				if($delete == 0) {
					if ($sub_subject != '') { 		
						
						$sqlstr = "select ref from minute_meet_detail where ref='$ref' and line='$old_line' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$num = $sql->rowCount();
						
						if($num > 0) {
							$sqlstr = "update minute_meet_detail set sub_subject='$sub_subject', problem='$problem', improvement='$improvement', due_date='$due_date', pic='$pic' where ref='$ref' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						} else {
							$line = maxline('minute_meet_detail', 'line', 'ref', $ref, '');
						
							$sqlstr = "insert into minute_meet_detail(ref, sub_subject, problem, improvement, due_date, pic, line) values('$ref', '$sub_subject', '$problem', '$improvement', '$due_date', '$pic', '$line') ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						}
						
					}
				} else {
					$sqlstr = "delete from minute_meet_detail where ref='$ref' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
			}
			
			$sqlstr = "update minute_meet set date='$date', member_id='$member_id', subject='$subject', division_id='$division_id', uid='$uid', dlu='$dlu' where  ref='$ref'";
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
	
	
	//-----update payment
	function update_payment($ref){
		$dbpdo = DB::create();
		
		try {
		
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$vendor_code	=	$_POST["vendor_code"];
			$memo			= 	$_POST["memo"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
						
			//----------update sales_order detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				
				$old_invoice_no	 	= $_POST[old_invoice_no_.$i];
				$old_line		 	= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$invoice_no 	= $_POST[invoice_no_.$i];
				$amount_paid 	= numberreplace($_POST[amount_paid_.$i]);
				
				if ( !empty($invoice_no) ) {	
					$invoice_date		= date("Y-m-d", strtotime($_POST[invoice_date_.$i]));
					$invoice_due_date	= date("Y-m-d", strtotime($_POST[invoice_due_date_.$i]));
					$amount_due		= numberreplace($_POST[amount_due_.$i]);
					$discount 		= numberreplace($_POST[discount_.$i]);
					$currency_code 	= $_POST[currency_code_.$i];					
					$rate			= numberreplace($_POST[rate_.$i]);
					$ref_type		= $_POST[transaction_.$i];				
					$amount_due		= numberreplace($_POST[amount_due_.$i]);
					$amount 		= $amount_paid - $discount;
					
					$sqlstr = "select ref from payment_detail where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update payment_detail set invoice_no='$invoice_no', invoice_date='$invoice_date', invoice_due_date='$invoice_due_date', discount='$discount', amount_paid='$amount_paid', invoice_currency_code='$invoice_currency_code', invoice_rate='$rate', amount_due='$amount_due', amount='$amount' where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line'";			
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//update AP
							if($ref_type == 'PIR') {
								##credit
								if($amount < 0) {
									$amount_credit = $amount * -1;
								}
								$sqlstr="update ap set invoice_no='$invoice_no', date='$date', due_date='$invoice_due_date', contact_code='$vendor_code', credit_amount='$amount_credit', discount_amount='$discount', currency_code='$currency_code', rate='$rate', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='PMT' and ref_type='$ref_type' and line='$old_line' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							} else {
								##debit
								$sqlstr="update ap set invoice_no='$invoice_no', date='$date', due_date='$invoice_due_date', contact_code='$vendor_code', debit_amount='$amount', discount_amount='$discount', currency_code='$currency_code', rate='$rate', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='PMT' and ref_type='$ref_type' and line='$old_line' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							}
							
						
						} else {
							$sqlstr="delete from payment_detail where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//delete AP
							$sqlstr="delete from ap where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='PMT' and ref_type='$ref_type' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
												
						}
						
						
					} else {
						$line = maxline('payment_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into payment_detail (ref, invoice_no, invoice_date, invoice_due_date, discount, amount_paid, invoice_currency_code, invoice_rate, ref_type, amount_due, amount, line) values ('$ref', '$invoice_no', '$invoice_date', '$invoice_due_date', '$discount', '$amount_paid', '$currency_code', '$rate', '$ref_type', '$amount_due', '$amount', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						//insert AP
						$sqlv = "select a.* from (select syscode code, name, 'V' type from vendor where active=1 union all
			  select syscode code, concat(name,' (',phone,')') name, 'C' type from client where active=1 and ifnull(name,'') <> '' ) a where a.code='$vendor_code'";
			  			$sql=$dbpdo->prepare($sqlv);
						$sql->execute();
						$datav = $sql->fetch(PDO::FETCH_OBJ);
						
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
							$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$invoice_no', '$date', '$invoice_due_date', '$typev', '$vendor_code', '', '$amount', 0, '$discount', 'PMT', '$ref_type', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
						}
						
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
			
			$sqlstr="update payment set date='$date', status='$status', vendor_code='$vendor_code', payment_type='$payment_type', cheque_no='$cheque_no', cheque_date='$cheque_date', bank_name='$bank_name', credit_card_no='$credit_card_no', credit_card_code='$credit_card_code', credit_card_holder='$credit_card_holder', credit_card_expired='$credit_card_expired', account_code='$account_code', currency_code='$currency_code', rate='$rate', amount='$amount', deposit='$deposit', sub_total='$sub_total', type='$type', memo='$memo', round_amount='$round_amount', round_amount_account='$round_amount_account', bank_charge='$bank_charge', bank_charge_account='$bank_charge_account', total='$total', no_ttfa='$no_ttfa', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			if($payment_type == "giro" || $payment_type == "cheque") {
				
				//insert APC
				$sqlstr="update apc date='$date', vendor_code='$vendor_code', cheque_no='$cheque_no', bank_name='$bank_name', cheque_date='$cheque_date', amount='$total', currency_code='$currency_code', rate='$rate', account_code='$account_code', memo='$memo', uid='$uid', dlu='$dlu' where type='$payment_type' and ref='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();				
				
			}
					
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update receipt
	function update_receipt($ref){
		$dbpdo = DB::create();
		
		try {
		
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$client_code	=	$_POST["client_code"];
			$memo			= 	$_POST["memo"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			//----------update sales_order detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				
				$old_invoice_no	 	= $_POST[old_invoice_no_.$i];
				$old_line		 	= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$invoice_no 	= $_POST[invoice_no_.$i];
				$amount_paid 	= numberreplace($_POST[amount_paid_.$i]);
				
				if ( !empty($invoice_no) ) {	
					$invoice_date		= date("Y-m-d", strtotime($_POST[invoice_date_.$i]));
					$invoice_due_date	= date("Y-m-d", strtotime($_POST[invoice_due_date_.$i]));
					$amount_due		= numberreplace($_POST[amount_due_.$i]);
					$discount 		= numberreplace($_POST[discount_.$i]);
					$currency_code 	= $_POST[currency_code_.$i];					
					$rate			= numberreplace($_POST[rate_.$i]);
					$ref_type		= $_POST[transaction_.$i];				
					$amount_due		= numberreplace($_POST[amount_due_.$i]);
					$amount 		= $amount_paid - $discount;
					
					$sqlstr = "select ref from receipt_detail where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update receipt_detail set invoice_no='$invoice_no', invoice_date='$invoice_date', invoice_due_date='$invoice_due_date', discount='$discount', amount_paid='$amount_paid', invoice_currency_code='$invoice_currency_code', invoice_rate='$rate', amount_due='$amount_due', amount='$amount' where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line'";						
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//update AR
							$sqlstr="update ar set invoice_no='$invoice_no', date='$date', due_date='$invoice_due_date', contact_code='$client_code', credit_amount='$amount', discount_amount='$discount', currency_code='$currency_code', rate='$rate', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='RCI' and ref_type='$ref_type' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//update DPS (Deposit)
							if($amount < 0) {
								$credit = $amount * -1;
								
								$dpscek = "select ref from dps where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='RCI' and ref_type='RCI' ";
								$sql=$dbpdo->prepare($dpscek);
								$sql->execute();
								$rowsdps = $sql->rowCount();
							
								if($rowsdps > 0 ) {
									$sqlstr="update dps set invoice_no='$invoice_no', date='$date', contact_code='$client_code', credit_amount='$credit', currency_code='$currency_code', rate='$rate', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='RCI' and ref_type='RCI' ";
									$sql=$dbpdo->prepare($sqlstr);
									$sql->execute();
								}
								
							}
							
							
						} else {
							$sqlstr="delete from receipt_detail where ref='$ref' and invoice_no='$old_invoice_no' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//delete AR
							$sqlstr="delete from ar where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='RCI' and ref_type='$ref_type' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//delete DPS
							$sqlstr="delete from dps where ref='$ref' and invoice_no='$old_invoice_no' and invoice_type='RCI' and ref_type='$ref_type' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
												
						}
						
						
					} else {
						$line = maxline('receipt_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into receipt_detail (ref, invoice_no, invoice_date, invoice_due_date, discount, amount_paid, invoice_currency_code, invoice_rate, ref_type, amount_due, amount, line) values ('$ref', '$invoice_no', '$invoice_date', '$invoice_due_date', '$discount', '$amount_paid', '$currency_code', '$rate', '$ref_type', '$amount_due', '$amount', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						if($ref_type != "DPS") {
							//insert AR
							$sqlstr="insert into ar(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, discount_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$invoice_no', '$date', '$invoice_due_date', 'C', '$client_code', '', 0, '$amount', '$discount', 'RCI', '$ref_type', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
						
						
						//insert DPS
						if($ref_type == "DPS") {
							if($amount < 0) {
								
								$credit = $amount * -1;
								
								$sqlstr="insert into dps(ref, invoice_no, date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$invoice_no', '$date', 'C', '$client_code', '', 0, '$credit', 'RCI', 'RCI', '$currency_code', '$rate', '', '', 'C.O.D', '$memo', '$uid', '$dlu')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();	
							}
						}
						
						
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
			/*include_once ($__folder."app/include/function_crop.php");
			//include_once ("app/include/function_crop.php");
			
			$file_transfer	= 	$_POST["file_transfer"];
			$photo			=	$_FILES['file_transfer']['name'];
			$photo2			=	$_POST["file_transfer2"];
			if($photo != "") {
				if(!empty($photo2)) {
					$filename = $__folder.'app/file_transfer/' . $photo2;
					
					if (file_exists($filename)) { unlink($__folder.'app/file_transfer/' . $photo2); } //remove file
				}
					
				$photo1 = resize_image('file_transfer', '', $__folder.'app/file_transfer/', '', $ref, $photo_file);
	  			$photo_file = $photo1;
			} else {
				$photo_file	=	$photo2;
			}*/
			
			$sqlstr="update receipt set date='$date', status='$status', client_code='$client_code', receipt_type='$receipt_type', cheque_no='$cheque_no', cheque_date='$cheque_date', bank_name='$bank_name', credit_card_no='$credit_card_no', credit_card_code='$credit_card_code', credit_card_holder='$credit_card_holder', credit_card_expired='$credit_card_expired', account_code='$account_code', currency_code='$currency_code', rate='$rate', amount='$amount', deposit='$deposit', sub_total='$sub_total', type='$type', memo='$memo', round_amount='$round_amount', round_amount_account='$round_amount_account', bank_charge='$bank_charge', bank_charge_account='$bank_charge_account', total='$total', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			if($receipt_type == "giro" || $receipt_type == "cheque") {
				
				//insert ARC
				$sqlstr="update arc date='$date', client_code='$client_code', cheque_no='$cheque_no', bank_name='$bank_name', cheque_date='$cheque_date', amount='$total', currency_code='$currency_code', rate='$rate', account_code='$account_code', memo='$memo', uid='$uid', dlu='$dlu' where type='$receipt_type' and ref='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();				
				
			}
			
			
			//update DPS (Deposit)
			if($deposit < 0) {
				
				$debit = $deposit * -1;
				
				$dpscek = "select ref from dps where ref='$ref' and invoice_no='$ref' and invoice_type='RCI' and ref_type='RCI' ";
				$sql=$dbpdo->prepare($dpscek);
				$sql->execute();
				$rowsdps = $sql->rowCount();
				
				if($rowsdps > 0) {
					$sqlstr="update dps set invoice_no='$ref', date='$date', contact_code='$client_code', debit_amount='$debit', currency_code='$currency_code', rate='$rate', description='$memo', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_no='$ref' and invoice_type='RCI' and ref_type='RCI' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				} else {
					$sqlstr="insert into dps (ref, invoice_no, date, contact_code, contact_type, debit_amount, currency_code, rate, description, invoice_type, ref_type, uid, dlu) values ('$ref', '$ref', '$date', '$client_code', 'C', '$debit', '$currency_code', '$rate', '$memo', 'RCI', 'RCI', '$uid', '$dlu') ";
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
	
	//-----update weekly_assignment_work
	function update_weekly_assignment_work($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update weekly_assignment_work set name='$name', active='$active', uid='$uid', dlu='$dlu' where id='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----update regular_item
	function update_regular_item($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	petikreplace($_POST["name"]);
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update regular_item set name='$name', active='$active', uid='$uid', dlu='$dlu' where id='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update schedule_promo
	function update_schedule_promo($ref, $line){
		$dbpdo = DB::create();
		
		try {
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$promo_id		=	$_POST["promo_id"];
			$item_code		=	$_POST["item_code"];
			$note			=	petikreplace($_POST["note"]);
			$hastag			=	petikreplace($_POST["hastag"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update schedule_promo set item_code='$item_code', note='$note', hastag='$hastag', uid='$uid', dlu='$dlu' where id='$ref' and line='$line' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update schedule_regular_item
	function update_schedule_regular_item($ref, $line){
		$dbpdo = DB::create();
		
		try {
			
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$regular_item_id=	$_POST["regular_item_id"];
			$item_code		=	$_POST["item_code"];
			$note			=	petikreplace($_POST["note"]);
			$hastag			=	petikreplace($_POST["hastag"]);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update schedule_regular_item set item_code='$item_code', note='$note', hastag='$hastag', uid='$uid', dlu='$dlu' where id='$ref' and line='$line' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update set journal
	function update_set_journal($ref){
		$dbpdo = DB::create();
		
		try {
			
			$location_id		=	$_POST["location_id"];
			$account_code_debit	=	$_POST["account_code_debit"];
			$account_code_credit=	$_POST["account_code_credit"];
			$trans_name			=	$_POST["trans_name"];
			$column_name		=	petikreplace($_POST["column_name"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update set_journal set location_id='$location_id', account_code_debit='$account_code_debit', account_code_credit='$account_code_credit', trans_name='$trans_name', column_name='$column_name', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----update brand
	function update_brand($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");	
			
			$sqlstr="update brand set code='$code', name='$name', active='$active', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();

		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update purchase return
	function update_purchase_return($ref){
		$dbpdo = DB::create();
		
		try {
			
	        $date				=	date("Y-m-d", strtotime($_POST["date"]));
			$status				= 	$_POST["status2"];
			$pi_ref				=	$_POST["pi_ref"];
	        $uid			    =	$_SESSION["loginname"];
			$dlu			    =	date("Y-m-d H:i:s");
			
	        //get location ID
	        $sqlpi = "select location_id from purchase_invoice where ref='$pi_ref'";
	        $sql=$dbpdo->prepare($sqlpi);
			$sql->execute();
			$datapi = $sql->fetch(PDO::FETCH_OBJ);
			
	        $location_id = $datapi->location_id;
	        	
			//----------update sales_order detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST[delete_.$i])) ? 0 : $_POST[delete_.$i];
				
				$old_item_code	 	= $_POST[old_item_code_.$i];
				$old_uom_code 		= $_POST[old_uom_code_.$i];
				$old_qty 			= numberreplace($_POST[old_qty_.$i]);
				$old_line		 	= (empty($_POST[old_line_.$i])) ? 0 : $_POST[old_line_.$i];
				
				$item_code	 	= $_POST[item_code_.$i];
				$uom_code 		= $_POST[uom_code_.$i];
				
				if ( !empty($item_code) && !empty($uom_code) ) {	
					
					$qty 		= numberreplace($_POST[qty_.$i]);
					$unit_cost	= numberreplace($_POST[unit_cost_.$i]);
					//$discount	= numberreplace($_POST[discount_.$i]);
					$amount 	= numberreplace($_POST[amount_.$i]);
					
					$line_item_pi	= $_POST[line_item_pi_.$i];
					
					$sqlstr = "select ref from purchase_return_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update purchase_return_detail set item_code='$item_code', uom_code='$uom_code', qty='$qty', unit_cost='$unit_cost', discount='$discount', amount='$amount' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							##--------update qty purchase invoice
							if($status != "P") {
								$sqlstr="update purchase_invoice_detail set qty_rtn=ifnull(qty_rtn,0) - $old_qty + $qty where ref='$pi_ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$line_item_pi' ";	
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();					
								##*****************************************##
	                            
	                            //----------update bincard (credit qty)
								$amount = $qty * $unit_cost;
								
								$sqlstr="update bincard set location_code='$location_id', date='$date', item_code='$item_code', uom_code='$uom_code', unit_price='$unit_cost', credit_qty='$qty', amount='$amount', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='purchase_return' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								
							}
						
						} else {
							$sqlstr="delete from purchase_return_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();	
							
							##--------update qty purchase invoice						
							$sqlstr="update purchase_invoice_detail set qty_rtn=ifnull(qty_rtn,0) - $old_qty where ref='$pi_ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$line_item_pi' ";	
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();					
							##*****************************************##
	                        
	                        //----------delete bincard (credit qty)
							$sqlstr="delete from bincard where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='purchase_return' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
												
						}
						
						
					} else {
						$line = maxline('purchase_return_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into purchase_return_detail (ref, item_code, uom_code, qty, discount, unit_cost, amount, line_item_pi, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$unit_cost', '$amount', '$line_item_pi', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						##--------update qty purchase invoice
						if($status != "P") {
							$sqlstr="update purchase_invoice_detail set qty_rtn=ifnull(qty_rtn,0) + $qty where ref='$pi_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_pi' ";	
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();					
							##*****************************************##
							
	                        //----------insert bincard (debit qty)
	                        $amount = $qty * $unit_cost;
							$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'purchase_return', '$memo', '$item_code', '$uom_code', '0', 0, '$qty', '$amount', '$line', '$uid', '$dlu')";
							
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
						}
						
					}
					
					
					
				}
			}
			
			
			
			//-get amount
			$sqlstr = "select sum(amount) amount from purchase_return_detail where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			
			$sub_total = $data->amount;
						
			$vendor_code		=	$_POST["vendor_code"];			
			$tax_code			=	$_POST["tax_code"];
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);
			$memo				= 	$_POST["memo"];
			$total				=	$sub_total; //numberreplace($_POST["total"]);
			
			$sqlstr="update purchase_return set date='$date', status='$status', pi_ref='$pi_ref', vendor_code='$vendor_code', tax_code='$tax_code', tax_rate='$tax_rate', currency_code='$currency_code', rate='$rate', total='$total', memo='$memo', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			//-------insert AP
			$sqlstr="delete from ap where ref='$ref' and invoice_type='PIR' and ref_type='PIR' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr="insert into ap(ref, invoice_no, date, due_date, contact_type, contact_code, contact_other, debit_amount, credit_amount, invoice_type, ref_type, currency_code, rate, exchange_type, exchange_date, top, description, uid, dlu) values('$ref', '$ref', '$date', '1900-01-01', 'V', '$vendor_code', '', '$total', 0, 'PIR', 'PIR', '$currency_code', '$rate', '', '', '', '$memo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----update sales return
	function update_sales_return($ref){
		
		$dbpdo = DB::create();
		
		try {
		
			$date			=	date("Y-m-d", strtotime($_POST["date"]));
			$status			= 	$_POST["status2"];
			$si_ref			=	$_POST["si_ref"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
				
				
			//----------update sales_order detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			$sub_total = 0;
			$total_charge = 0;
			for ($i=0; $i<=$jmldata; $i++) {
				$delete 		= (empty($_POST['delete_'.$i.''])) ? 0 : $_POST['delete_'.$i.''];
				
				$old_item_code	 	= $_POST['old_item_code_'.$i.''];
				$old_uom_code 		= $_POST['old_uom_code_'.$i.''];
				$old_line		 	= (empty($_POST['old_line_'.$i.''])) ? 0 : $_POST['old_line_'.$i.''];
				
				$item_code	 	= $_POST['item_code_'.$i.''];
				$uom_code 		= $_POST['uom_code_'.$i.''];
				
				if ( !empty($item_code) && !empty($uom_code) ) {	
					
					$qty 		= numberreplace($_POST['qty_'.$i.'']);
					$old_qty	= numberreplace($_POST['old_qty_'.$i.'']);
					$unit_price	= numberreplace($_POST['unit_price_'.$i.'']);
					$charge_p	= numberreplace($_POST['charge_p_'.$i.'']);
					$discount	= numberreplace($_POST['discount_'.$i.'']);
					$amount 	= numberreplace($_POST['amount_'.$i.'']);
					
					$line_item_si	= $_POST['line_item_si_'.$i.''];
					
					$amount_charge	= ($charge_p * ($unit_price * $qty))/100;
					$total_charge	= $total_charge + $amount_charge;
					
					$sub_total		= $sub_total + $amount - $amount_charge;
					
					$sqlcek = "select ref from sales_return_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlcek);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update sales_return_detail set item_code='$item_code', uom_code='$uom_code', qty='$qty', unit_price='$unit_price', charge_p='$charge_p', discount='$discount', amount='$amount' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
							
							
							##--------update qty sales invoice
							if($status == "R") {
								$sqlstr="update sales_invoice_detail set qty_rtn=ifnull(qty_rtn,0) - $old_qty + $qty where ref='$si_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_si' ";	
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								
								//----------update bincard (credit qty)
								$sqlstr = "select location_id from sales_invoice where ref='$si_ref' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								$datasi = $sql->fetch(PDO::FETCH_OBJ);
								$old_location_id = $datasi->location_id;
								
								$sqlstr="update bincard set date='$date', item_code='$item_code', uom_code='$uom_code', unit_price='$unit_price', debit_qty='$qty', amount='$amount', uid='$uid', dlu='$dlu' where invoice_no='$ref' and location_code='$old_location_id' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='sales_return' ";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								
							}
						
						} else {
							$sqlstr="delete from sales_return_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							##--------update qty sales invoice						
							$sqlstr="update sales_invoice_detail set qty_rtn=ifnull(qty_rtn,0) - $qty where ref='$si_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_si' ";	
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//----------delete bincard (credit qty)
							$sqlstr="delete from bincard where invoice_no='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line=$old_line and invoice_type='sales_return' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
												
						}
						
						
					} else {
						$line = maxline('sales_return_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into sales_return_detail (ref, item_code, uom_code, qty, discount, unit_price, charge_p, amount, line_item_si, line) values ('$ref', '$item_code', '$uom_code', '$qty', '$discount', '$unit_price', '$charge_p', '$amount', '$line_item_si', $line)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						##--------update qty sales invoice
						if($status == "R") {
							$sqlstr="update sales_invoice_detail set qty_rtn=ifnull(qty_rtn,0) + $qty where ref='$si_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_si' ";	
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							//----------insert bincard (debit qty)
							$sqlstr = "select location_id from sales_invoice where ref='$si_ref' ";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							$datasi = $sql->fetch(PDO::FETCH_OBJ);
							$location_id = $datasi->location_id;
							
							$expired_date = "00:00:00";
							$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'sales_return', '$memo', '$item_code', '$uom_code', '$expired_date', '$unit_price', '$qty', 0, '$amount', '$line', '$uid', '$dlu')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
							##*****************************************##
							
						}
						
					}
					
					
					
				}
			}
			
			//-get amount
			$sqlstr = "select sum(amount) amount from sales_return_detail where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$sub_total = $data->amount;
			
			$reason				=	petikreplace($_POST["reason"]);
			$client_code		=	$_POST["client_code"];			
			$tax_code			=	$_POST["tax_code"];
			$tax_rate			=	numberreplace($_POST["tax_rate"]);
			$currency_code		=	$_POST["currency_code"];
			$rate				=	numberreplace($_POST["rate"]);
			$memo				= 	$_POST["memo"];
			$total				=	$sub_total; //numberreplace($_POST["total"]);
			
			$sqlstr="update sales_return set date='$date', status='$status', si_ref='$si_ref', client_code='$client_code', tax_code='$tax_code', tax_rate='$tax_rate', currency_code='$currency_code', rate='$rate', total='$total', reason='$reason', memo='$memo', uid='$uid', dlu='$dlu' where ref='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			##insert AR (credit)
			$tax_rate	=	numberreplace($_POST["tax_rate"]);
			$tax_total	=	($tax_rate * $total) / 100;
			$total	=	$total + $tax_total; // + $total_charge;
			
			$sqlstr="delete from ar where ref='$ref' and invoice_type='SIR' and ref_type='SIR' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
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


	//-----update channel
	function update_channel($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update channel set name='$name', active='$active', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}

	
	//-----update size
	function update_size($ref){
		$dbpdo = DB::create();
		
		try {
			
			$code			=	$_POST["code"];
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr="update size set code='$code', name='$name', active='$active', uid='$uid', dlu='$dlu' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}


	//-----update payment_method
	function update_payment_method($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			
			$sqlstr="update payment_method set name='$name', active='$active' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}


	//---update status
	function update_pos_update_status(){
		
		$dbpdo = DB::create();
		
		$jmldata = $_POST['jmldata'];
		for($i=0; $i<$jmldata; $i++) {
			
			$ref 			= $_POST['ref_'.$i.''];
			$process_whs 	= numberreplace($_POST['process_whs_'.$i.'']);
			$print 			= numberreplace($_POST['print_'.$i.'']);
			$onshipped 		= numberreplace($_POST['onshipped_'.$i.'']);
			$shipped 		= numberreplace($_POST['shipped_'.$i.'']);
			$paid 			= numberreplace($_POST['paid_'.$i.'']);

			$old_onshipped  = numberreplace($_POST['old_onshipped_'.$i.'']);

			//update
			if($paid == 1) {
				$sqlstr="update sales_invoice set status='Paid', process_whs='$process_whs', print='$print', onshipped='$onshipped', shipped='$shipped', paid='$paid' where ref='$ref'"; 
				$sql=$dbpdo->query($sqlstr);
			} else {
				$sqlstr="update sales_invoice set process_whs='$process_whs', print='$print', onshipped='$onshipped', shipped='$shipped', paid='$paid' where ref='$ref'"; 
				$sql=$dbpdo->query($sqlstr);
			}
			
			//--------insert bincard (jika onshipped, mk qty berkurang)
			if($onshipped == 1) {
				$sqlstr="select a.item_code, a.uom_code, a.qty, a.unit_price, a.amount, a.line, b.date, b.location_id from sales_invoice_detail a left join sales_invoice b on a.ref=b.ref where a.ref='$ref'";
				$sql1=$dbpdo->prepare($sqlstr);
				$sql1->execute();	
				while($data = $sql1->fetch(PDO::FETCH_OBJ)) {
					$item_code 	=	$data->item_code;
					$uom_code 	=	$data->uom_code;
					$qty 		=	$data->qty;
					$unit_price =	$data->unit_price;
					$amount 	=	$data->amount;
					$line 		=	$data->line;
					$date 		=	$data->date;
					$location_id=	$data->location_id;
					$uid		=	$_SESSION["loginname"];
					$dlu		=	date("Y-m-d H:i:s");

					$sqlstr="select invoice_no from bincard where invoice_no='$ref' and item_code='$item_code' and uom_code='$uom_code' and location_code='$location_id' and line='$line' ";
					$sql2=$dbpdo->prepare($sqlstr);
					$sql2->execute();	
					$rows = $sql2->rowCount();
					if($rows == 0) {
						$expired_date = "00:00:00";
						/*$sqlstr="insert into bincard (invoice_no, location_code, date, invoice_type, description, item_code, uom_code, expired_date, unit_price, debit_qty, credit_qty, amount, line, uid, dlu) values ('$ref', '$location_id', '$date', 'pos', 'onshipped', '$item_code', '$uom_code', '$expired_date', '$unit_price', 0, '$qty', '$amount', '$line', '$uid', '$dlu')";	
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();*/

						if($old_onshipped == 0) {
							$sqlstr="update sales_invoice set shipped_uid='$uid', shipped_dlu='$dlu' where ref='$ref'"; 
							$sql=$dbpdo->query($sqlstr);
						}
					} else {
						/*$sqlstr="update bincard set description='onshipped' where invoice_no='$ref' and item_code='$item_code' and uom_code='$uom_code' and location_code='$location_id' and line='$line' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();*/	

						if($old_onshipped == 0) {
							$sqlstr="update sales_invoice set shipped_uid='$uid', shipped_dlu='$dlu' where ref='$ref'"; 
							$sql=$dbpdo->query($sqlstr);
						}
					}
				}
			}
		}
				
		
		return $sql;
	}
	

	//-----update purchase type
	function update_purchase_type($ref){
		$dbpdo = DB::create();
		
		try {
			
			$name			=	$_POST["name"];
			$active			=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			
			$sqlstr="update purchase_type set name='$name', active='$active' where id='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}


	//-----update measuring_size_sewing
	function update_measuring_size_sewing($ref){	
		
		$dbpdo = DB::create();
		
		try {
			$dbpdo->beginTransaction();
			
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
				
				$delete 		= (empty($_POST["delete_".$i.""])) ? 0 : $_POST["delete_".$i.""];
				
				$old_name 		= $_POST["old_name_".$i.""];
				$old_uom_code 	= $_POST["old_uom_code_".$i.""];
				$old_line		= (empty($_POST["old_line_".$i.""])) ? 0 : $_POST["old_line_".$i.""];
				$old_qty 		= numberreplace($_POST["old_qty_".$i.""]);

				$name			= $_POST["name_".$i.""];
				$size	 		= numberreplace($_POST["size_".$i.""]);
				$uom_code 		= $_POST["uom_code_".$i.""];
				
				if($delete == 0) {
					$sqlstr = "select ref from measuring_size_sewing_detail where ref='$ref' and name='$old_name' and uom_code='$old_uom_code' and line='$old_line' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$num = $sql->rowCount();
					
					if($num > 0) {
						
						$sqlstr="update measuring_size_sewing_detail set name='$name', size='$size', uom_code='$uom_code' where ref='$ref' and uom_code='$old_uom_code' and line=$old_line";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
					} else {
						if ( !empty($name) ) { //&& !empty($uom_code) 
							
							$line = maxline('measuring_size_sewing_detail', 'line', 'ref', $ref, '');
							
							$sqlstr="insert into measuring_size_sewing_detail (ref, name, size, uom_code, line) values ('$ref', '$name', '$size', '$uom_code', '$line')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
																		
						}
					}
				} else {
					$sqlstr="delete from measuring_size_sewing_detail where ref='$ref' and line='$old_line'";
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
					
			$sqlstr="update measuring_size_sewing set date='$date', so_ref='$so_ref', client_code='$client_code', series='$series', qty='$qty', unit_cost='$unit_cost', print_ref='$print_ref', press_ref='$press_ref', mcn_press_speed = '$mcn_press_speed', mcn_press_temperature='$mcn_press_temperature', counting_ref='$counting_ref', sampling='$sampling', br='$br', memo='$memo', photo='$photo', photo1='$photo1', photo2='$photo2x', photo3='$photo3', photo4='$photo4', photo5='$photo5', photo6='$photo6', photo7='$photo7', acc_date_client='$acc_date_client', label='$label', plat='$plat', button='$button', pocket='$pocket', resleting='$resleting', uid='$uid', dlu='$dlu' where ref='$ref'";
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

	
	//-----update do_good_receipt_qc
	function update_do_good_receipt_qc($ref){	
		
		$dbpdo 		= DB::create();
		
		try {
			$dbpdo->beginTransaction();
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			$rcp_ref1 	=	"";
			
			//----------insert item packing detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			$sub_total = 0;
			for ($i=0; $i<=$jmldata; $i++) {
				$delete			= $_POST["delete_".$i.""];
				$old_line		= numberreplace($_POST["old_line_".$i.""]);
				$old_item_code 	= $_POST["old_item_code_".$i.""];
				$old_uom_code	= $_POST["old_uom_code_".$i.""];
				$old_qty 		= numberreplace($_POST["old_qty_".$i.""]);
				$old_qty_damaged= numberreplace($_POST["old_qty_damaged_".$i.""]);
				$old_total_qty = $old_qty + $old_qty_damaged;

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
				$total_qty = $qty + $qty_damaged;

				if($rcp_ref1 == "") {
					$rcp_ref1 = $rcp_ref;
				}

				$sqlstr="select ref from do_good_receipt_qc_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows=$sql->rowCount();
				
				if($rows > 0) {
					if($delete == 0) {
						$sqlstr="update do_good_receipt_qc_detail set qty='$qty', qty_damaged='$qty_damaged', unit_cost='$unit_cost', amount_cost='$amount_cost' where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
						$sql1=$dbpdo->prepare($sqlstr);
						$sql1->execute();
						
						//update qty do_good_receipt_detail
						$sql2="update good_receipt_detail set qty_qc=ifnull(qty_qc,0) - $old_qty + $qty where ref='$rcp_ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$do_line' ";
						$sql=$dbpdo->query($sql2);

					} else {
						$sqlstr="delete from do_good_receipt_qc_detail where ref='$ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$old_line'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						//update qty do_good_receipt_detail
						$sql2="update good_receipt_detail set qty_qc=ifnull(qty_qc,0) - $old_qty where ref='$rcp_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$do_line' ";
						$sql=$dbpdo->query($sql2);

						//update qty do_good_receipt_detail
						/*$sql2="update do_good_receipt_detail set qty_qc1=0, qty_damaged=0, amount_cost=0 where ref='$rcp_ref' and item_code='$old_item_code' and uom_code='$old_uom_code' and line='$do_line' ";	
						$sql=$dbpdo->query($sql2);*/
						//---------/\----------------
					}
				} else {
					if ( !empty($item_code) && ($qty>0 || $qty_damaged>0) ) {					
						
						$line = maxline('do_good_receipt_qc_detail', 'line', 'ref', $ref, '');
						
						$sqlstr="insert into do_good_receipt_qc_detail (ref, so_ref, do_ref, rcp_ref, item_code, uom_code, size, do_line, qty_rcp, qty, qty_damaged, line) values ('$ref', '$so_ref', '$do_ref', '$rcp_ref', '$item_code', '$uom_code', '$size', '$do_line', '$qty_rcp', '$qty', '$qty_damaged', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						//update qty do_good_receipt_detail
						$sql2="update good_receipt_detail set qty_qc=ifnull(qty_qc,0) + $qty where ref='$rcp_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$do_line' ";	
						$sql=$dbpdo->query($sql2);

					}
				}
			}
			
			$date				=	date("Y-m-d", strtotime($_POST["date"]));
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

			//-----------upload file_qc
			$file_qc_folder = 'app/file_do_good_qc'; //.$ref;
			if (!file_exists($file_qc_folder) && !is_dir($file_qc_folder)) {
				@mkdir($file_qc_folder, 0777, true);
				@chmod('app/file_do_good_qc', 0777);
				@chmod($file_qc_folder, 0777);
			}

			$uploaddir_file_qc	= $file_qc_folder .'/';
			$file_qc			= $_FILES['file_qc']['name']; 
			$tmpname_file_qc 	= $_FILES['file_qc']['tmp_name'];
			$filesize_file_qc 	= $_FILES['file_qc']['size'];
			$filetype_file_qc 	= $_FILES['file_qc']['type'];
			
			$file_qc2			= $_POST['file_qc2'];

			if (empty($file_qc)) { 
				$file_qc = $file_qc2; 
			} else {
				$file_qc = $file_qc;
			}

			if($file_qc != "") {
				if($file_qc != $file_qc2) {
					if(!empty($file_qc2)) {
						if (file_exists($file_qc_folder . '/' . $file_qc2)) {
							unlink($uploaddir_file_qc . $file_qc2); //remove file 
						}					
					}
					
					$file_qc = $ref. '_' . $file_qc;
				}
				$uploaddir_file_qc = $uploaddir_file_qc . $file_qc;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['file_qc']['tmp_name'], $uploaddir_file_qc)) {
					echo "";											
				} 	
			}	
			//----------------
						
			if(allowlvl('frmdo_good_receipt_qc')==1 || $_SESSION['adm']==1) {	
				$sqlstr="update do_good_receipt_qc set date='$date', status='$status', memo='$memo', ms_ref='$ms_ref', ms_ref1='$ms_ref1', ms_ref2='$ms_ref2', label='$label', plat='$plat', button='$button', pocket='$pocket', resleting='$resleting', label1='$label1', plat1='$plat1', button1='$button1', pocket1='$pocket1', resleting1='$resleting1', label2='$label2', plat2='$plat2', button2='$button2', pocket2='$pocket2', resleting2='$resleting2', label_ms='$label_ms', plat_ms='$plat_ms', button_ms='$button_ms', pocket_ms='$pocket_ms', resleting_ms='$resleting_ms', label_ms1='$label_ms1', plat_ms1='$plat_ms1', button_ms1='$button_ms1', pocket_ms1='$pocket_ms1', resleting_ms1='$resleting_ms1', label_ms2='$label_ms2', plat_ms2='$plat_ms2', button_ms2='$button_ms2', pocket_ms2='$pocket_ms2', resleting_ms2='$resleting_ms2', file_qc='$file_qc', uid_pmt='$uid', dlu_pmt='$dlu' where ref='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr="update do_good_receipt_qc set date='$date', status='$status', memo='$memo', ms_ref='$ms_ref', ms_ref1='$ms_ref1', ms_ref2='$ms_ref2', label='$label', plat='$plat', button='$button', pocket='$pocket', resleting='$resleting', label1='$label1', plat1='$plat1', button1='$button1', pocket1='$pocket1', resleting1='$resleting1', label2='$label2', plat2='$plat2', button2='$button2', pocket2='$pocket2', resleting2='$resleting2', label_ms='$label_ms', plat_ms='$plat_ms', button_ms='$button_ms', pocket_ms='$pocket_ms', resleting_ms='$resleting_ms', label_ms1='$label_ms1', plat_ms1='$plat_ms1', button_ms1='$button_ms1', pocket_ms1='$pocket_ms1', resleting_ms1='$resleting_ms1', label_ms2='$label_ms2', plat_ms2='$plat_ms2', button_ms2='$button_ms2', pocket_ms2='$pocket_ms2', resleting_ms2='$resleting_ms2', file_qc='$file_qc', uid='$uid', dlu='$dlu' where ref='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}

			//--------hitung ulang payable
			/*$sqlstr = "select sum(amount_cost) amount_cost from good_receipt_qc_detail where ref='$ref' group by ref";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$total_amount = numberreplace($data->amount_cost);


			//update AP
			$sqlstr="select ref from ap where ref='$ref' and invoice_type='receipt_do' and ref_type='receipt_do' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$num2 = $sql->rowCount();
			
			$due_date = $date;
			$exchange_date = $date;
			if($num2 > 0) {
				$sqlstr="update ap set date='$date', due_date='$due_date', contact_code='$vendor_code', credit_amount='$total_amount', currency_code='IDR', rate='0', uid='$uid', dlu='$dlu' where ref='$ref' and invoice_type='receipt_do' and ref_type='receipt_do' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
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
	
			
}

?>
