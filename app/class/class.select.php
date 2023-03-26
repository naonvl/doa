<?php

class select{	

	//---------get data user
	function list_usr($ref=''){	
		$dbpdo = DB::create();
		
	 	if ($ref == "") {
			$where = "";
			if (user_admin()==0) {
				$uid = $_SESSION["loginname"];
				$where = " where a.uid = '$uid' ";
			} 
			$sqlstr="select a.id, a.usrid, a.pwd, a.adm, b.pwd pwdori, a.employee_id, a.photo, a.act, a.uid, a.dlu from usr a left join usr_bup b on a.usrid=b.usrid " . $where . " order by a.usrid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {
			$sqlstr="select a.id, a.usrid, a.pwd, b.pwd pwdori, a.adm, a.employee_id, a.photo, a.act, a.uid, a.dlu from usr a left join usr_bup b on a.usrid=b.usrid where a.id='$ref' order by a.usrid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		
		return $sql;
	}
	
	//-----------user form akses(saat add)
	function list_usrfrm() {
		$dbpdo = DB::create();
		
		$sqlstr="select frmcde, frmnme from usr_frm order by frmnme";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------user detail akses(saat update)
	function list_usrdtl($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select usrid from usr where id=$id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		
		$sqlstr="select usrid from usr where userid='$data->usrid' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check user
	function list_usr_check($ref=''){	
		$dbpdo = DB::create();
		 	
		$sqlstr="select usrid from usr where usrid='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------user form akses(saat update)
	function list_usrrgh($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select usrid from usr where id=$id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		
		$sqlstr="select aa.* from (select a.id, a.frmcde, b.frmnme, 1 mslc, a.madd, a.medt, a.mdel, a.lvl, 1 old from usr_dtl a left join usr_frm b on a.frmcde=b.frmcde where a.usrid='$data->usrid' union all
		select 0 id, frmcde, frmnme, 0 mslc, 0 madd, 0 medt, 0 mdel, 0 lvl, 0 old from usr_frm where frmcde not in (select frmcde from usr_dtl where usrid='$data->usrid' )) aa order by aa.id desc, aa.frmnme ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data company
	function list_company($kode ='', $all=0, $act=''){	 	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where id = '$kode' ";
			} else {
				$where = $where . " and id = '$kode' ";
			}								
		}
		
		$sqlstr="select id, name, businiss_type, npwp, address1, address2, phone1, phone2, fax, city, country, web, email, bank_name, bank_account, bank_account_name, active, uid, dlu from company " . $where . " order by id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}

	
    //-----------peserta
	function list_peserta($syscode='', $no_peserta='', $no_registrasi='', $nama='', $no_ktp='', $aktif='', $all='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $syscode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$syscode' ";
			} else {
				$where = $where . " and a.syscode = '$syscode' ";
			}								
		}
		
		if ( $no_peserta != "") {
			if ($where == "") {
				$where = " where a.no_peserta = '$no_peserta' ";
			} else {
				$where = $where . " and a.no_peserta = '$no_peserta' ";
			}								
		}
		
				
		if ( $no_registrasi != "") {
			if ($where == "") {
				$where = " where a.no_registrasi = '$no_registrasi' ";
			} else {
				$where = $where . " and a.no_registrasi = '$no_registrasi' ";
			}								
		}
		
		
		if ( $nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}								
		}
		
		
		if ( $no_ktp != "") {
			if ($where == "") {
				$where = " where a.no_ktp = '$no_ktp' ";
			} else {
				$where = $where . " and a.no_ktp = '$no_ktp' ";
			}								
		}
		
		
		if ( $aktif != "") {
			if ($where == "") {
				$where = " where a.aktif = '$aktif' ";
			} else {
				$where = $where . " and a.aktif = '$aktif' ";
			}								
		}
		
		
		if($syscode=='' && $no_peserta=='' && $no_registrasi=='' && $nama=='' && $no_ktp=='' && $aktif=='' && $all=='') {
			$where = "where a.no_registrasi='NDF12345'";
		}
		
		if($all == 1) {
			$where = "";
		}
		
				
		$sqlstr="select a.no_peserta, a.no_registrasi, a.nama, a.tanggal_lahir, a.alamat, a.no_hp, no_ktp, a.aktif, a.uid, a.dlu, a.syscode from peserta a ".$where." order by a.no_peserta ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data peserta detail
	function list_peserta_detail($id ='', $program_id=''){	 	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.peserta_kode = '$id' ";
			} else {
				$where = $where . " and a.peserta_kode = '$id' ";
			}								
		}
		
		if ( $program_id != "") {
			if ($where == "") {
				$where = " where a.program_id = '$program_id' ";
			} else {
				$where = $where . " and a.program_id = '$program_id' ";
			}								
		}
		
		$sqlstr="select a.peserta_kode, a.program_id, a.line from peserta_program a " . $where . " order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data program
	function list_program($id =''){	 	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.id = '$id' ";
			} else {
				$where = $where . " and a.id = '$id' ";
			}								
		}
		
		$sqlstr="select a.id, a.nama, a.aktif, a.uid, a.dlu from program a " . $where . " order by a.id";
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
	
	
	//---------get data coa
	function list_coa($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}
		
		$sqlstr="select a.acc_code, a.name, a.acc_type, a.postable, a.subacc_code, a.opening_balance, a.opening_balance_date, a.current_balance, a.currency_code, a.currency_rate, a.currency_exchange_id, a.level, a.active, a.uid, a.dlu, a.syscode, b.name acc_type_name, c.acc_code sub_of_acc_code, c.name sub_of_acc_name from coa a left join coa_type b on a.acc_type=b.id left join coa c on a.subacc_code=c.syscode " . $where . " order by b.name, a.acc_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------client
	function list_client($kode ='', $all='', $act='', $client_type_id='', $kabupaten='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}
		
		if ( $client_type_id != "") {
			if ($where == "") {
				$where = " where a.client_type = '$client_type_id' ";
			} else {
				$where = $where . " and a.client_type = '$client_type_id' ";
			}								
		}

		if($kabupaten != '') {
			if ($where == "") {
				$where = " where a.kabupaten = '$kabupaten' ";
			} else {
				$where = $where . " and a.kabupaten = '$kabupaten' ";
			}	
		}
		
		if($kode == '' && $all == '' && $act == '' && $client_type_id == '' && $kabupaten == '') {
			$where = " where a.syscode='ndf' ";
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.kabupaten, a.kecamatan, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.ship_to, a.bill_to, a.uid, a.dlu, a.syscode, b.name client_type_name from client a left join client_type b on a.client_type=b.id " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data item
	function list_item($kode ='', $all=0, $active='', $code='', $old_code='', $name='', $item_group_id='', $from_date='', $to_date=''){
		$dbpdo = DB::create();
		
		$where = ""; // where (ifnull(a.development,0)=0 or a.publish=1) and a.item_group_id =5 
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		if ( $code != "") {
			if ($where == "") {
				$where = " where a.code = '$code' ";
			} else {
				$where = $where . " and a.code = '$code' ";
			}								
		}
		
		if ( $old_code != "") {
			if ($where == "") {
				$where = " where a.old_code = '$old_code' ";
			} else {
				$where = $where . " and a.old_code = '$old_code' ";
			}								
		}
		
		if ( $name != "") {
			$name = petikreplace($name);
			if ($where == "") {
				$where = " where a.syscode = '$name' ";
			} else {
				$where = $where . " and a.syscode = '$name' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where a.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and a.item_group_id = '$item_group_id' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
		if($kode=='' && $all==0 && $active=='' && $code=='' && $old_code=='' && $name=='' && $item_group_id=='' && $from_date=='' && $to_date=='') {
			$where = " where a.syscode = 'NDF' ";
		}
				
		if($all == 1) {
			$where = ""; // where (ifnull(a.development,0)=0 or a.publish=1) and a.item_group_id =5 
		}
		
		$sqlstr="select a.code, a.old_code, a.name, a.item_group_id, b.name item_group_name, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.balance, a.description, a.active, a.uid, a.dlu, a.syscode, c.name size_name from item a left join item_group b on a.item_group_id=b.id left join size c on a.size_id=c.id " . $where . " order by a.code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data item
	function get_item($ref=''){
		$dbpdo = DB::create();
		
		$where = " where a.active=1 ";

		if($ref != "") {
			if ($where == "") {
				$where = " where a.syscode not in (select item_code from stock_opname_detail where ref='$ref') ";
			} else {
				$where = $where . " and a.syscode not in (select item_code from stock_opname_detail where ref='$ref') ";
			}
		}
		
		$sqlstr="select a.code, a.old_code, a.name, a.item_group_id, b.name item_group_name, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.balance, a.description, a.active, a.uid, a.dlu, a.syscode, c.name size_name from item a left join item_group b on a.item_group_id=b.id left join size c on a.size_id=c.id " . $where . " order by a.code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}


	//---------get set data item cost __
	function list_set_item_cost_last($location_id, $item_code){	 
		
		$dbpdo = DB::create();
			
		$where = "";
		
		/*if ( $location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}								
		}*/
		
		/*if ( $item_code != "") {*/
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		/*}*/
		
		//cek harga pembelian terakhir
		$sqlstr2 = "select a.unit_cost, b.date, ifnull(a.discount1,0) discount1, b.tax_rate from purchase_invoice_detail a left join purchase_invoice b on a.ref=b.ref where a.item_code='$item_code' order by b.dlu desc limit 1 ";
		$sql2=$dbpdo->prepare($sqlstr2);
		$sql2->execute();
		$data2=$sql2->fetch(PDO::FETCH_OBJ);
		$unit_cost=$data2->unit_cost;
		$discount1= ($unit_cost * $data2->discount1)/100;
		$tax_rate= ($unit_cost * $data2->tax_rate)/100;
		$unit_cost=($unit_cost - $discount1) + $tax_rate;
		$date = $data2->date;
		
		
		//ceh harg setup biaya
		$sqlstr="select a.date, a.efective_from, a.item_code, a.uom_code, a.current_cost, a.point_first_order, a.bonus_basic, a.bonus_prestation, a.bonus_unilevel, a.matching_sponsor, a.reward, a.repeat_order, a.royalti, a.total_budget, a.last_cost, a.fo_point, a.ro_point, a.cogs, a.date_of_record, a.location_id, a.uid, a.dlu from set_item_cost a " . $where . " order by a.date_of_record desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$date2 = $data->date;
		
		if($date > $date2) {
			$sqlstr="select '$date' date, $unit_cost current_cost";
			//$sqlstr="select '$date' date, a.efective_from, a.item_code, a.uom_code, $unit_cost current_cost, a.last_cost, a.date_of_record, a.location_id, a.uid, a.dlu from set_item_cost a " . $where . " order by a.date_of_record desc limit 1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {
			$sqlstr="select a.date, a.efective_from, a.item_code, a.uom_code, a.current_cost, a.point_first_order, a.bonus_basic, a.bonus_prestation, a.bonus_unilevel, a.matching_sponsor, a.reward, a.repeat_order, a.royalti, a.total_budget, a.last_cost, a.fo_point, a.ro_point, a.cogs, a.date_of_record, a.location_id, a.uid, a.dlu from set_item_cost a " . $where . " order by a.date_of_record desc limit 1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		}
		
		return $sql;
	}
	
	
	//---------get data item group
	function list_item_group($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.code, a.name, a.nonstock, a.costing_type, a.inventory_acccode, a.purchase_discount_acccode, a.goodintransit_acccode, a.workinprocess_acccode, a.cogs_acccode, a.consignment_acccode, a.location_id, a.active, a.uid, a.dlu from item_group a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data client_set_level
	function list_client_set_level(){
		$dbpdo = DB::create();
			 	
		$sqlstr="select a.id, a.qualified, a.group_completed, a.platinum, a.uid, a.dlu from client_set_level a order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data level
	function list_level($kode=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
			 	
		$sqlstr="select a.id, a.level, a.indicator_member, a.indicator, a.registration, a.starter_kit, a.prestasi, a.unilevel, a.sponsor, a.bonus, a.uid, a.dlu from level a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get data warehouse
	function list_warehouse($kode ='', $all=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}

		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.id, a.code, a.name, a.address, a.email, a.phone, a.active, a.uid, a.dlu from warehouse a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get data product
	function list_product($kode ='', $all=0, $active='', $code='', $old_code='', $name='', $item_group_id='', $from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		if ( $code != "") {
			if ($where == "") {
				$where = " where a.code = '$code' ";
			} else {
				$where = $where . " and a.code = '$code' ";
			}								
		}
		
		if ( $old_code != "") {
			if ($where == "") {
				$where = " where a.old_code = '$old_code' ";
			} else {
				$where = $where . " and a.old_code = '$old_code' ";
			}								
		}
		
		if ( $name != "") {
			$name = petikreplace($name);
			if ($where == "") {
				$where = " where a.syscode = '$name' ";
			} else {
				$where = $where . " and a.syscode = '$name' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where a.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and a.item_group_id = '$item_group_id' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
		/*if($kode=='' && $all==0 && $act=='' && $code=='' && $old_code=='' && $name=='' && $item_group_id=='' && $from_date=='' && $to_date=='') {
			$where = " where a.syscode = 'NDF' ";
		}*/
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.old_code, a.name, a.item_group_id, b.name item_group_name, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.balance, a.active, a.uid, a.dlu, a.syscode from item a left join item_group b on a.item_group_id=b.id " . $where . " order by a.code";
		//echo $sqlstr;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------client deposit
	function list_client_deposit($client_code ='', $ref='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}								
		}
				
		if($client_code =='' && $ref=='') {
			$where = " where a.ref='NDFxx'";
		}
		
		
		$sqlstr="select a.ref, a.date, a.client_code, a.opening_balance, (select amount from client where syscode=a.client_code) current_balance, a.receipt_type, a.bank_id, a.receipt_status, a.memo, a.uid, a.dlu from client_deposit a left join client b on a.client_code=b.syscode " . $where . " order by a.ref, a.date ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------client transfer_saldo
	function list_transfer_saldo($ref='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.id = '$ref' ";
			} else {
				$where = $where . " and a.id = '$ref' ";
			}								
		}
				
		/*if($ref=='') {
			$where = " where a.id='NDFxx'";
		}*/
		
		
		$sqlstr="select a.id, a.client_code, a.saldo, a.transfer, a.client_code1, a.uid, a.dlu, b.code id_stockist, b.name name_stockist, c.code id_agent, c.name name_agent from transfer_saldo a left join client b on a.client_code=b.syscode left join client c on a.client_code1=c.syscode " . $where . " order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------client saldo
	function get_client_saldo($client_code='') {
		$dbpdo = DB::create();
		
		$sqlstr="select a.current_balance, ifnull(b.stockist,0) stockist from client_deposit a left join client b on a.client_code=b.syscode where a.client_code = '$client_code' order by a.dlu desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------sales_invoice_tmp
	function get_sales_invoice_tmp($ref='') {
		$dbpdo = DB::create();
		
		$uid	= $_SESSION["loginname"];
		
		$sqlstr="select a.ref, a.item_code, a.uom_code, b.name item_name, a.uom_code, sum(a.qty) qty, a.unit_price, sum(a.amount) amount from sales_invoice_tmp a left join item b on a.item_code=b.syscode where a.ref = '$ref' and a.uid='$uid' group by a.ref, a.item_code order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data sales_shop_order
	function list_sales_shop_order($kode='', $from_date='', $to_date='', $client_code='', $status='', $all=''){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%CSR%' "; // and ifnull(a.total,0) <> 0 ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date	=	date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date	=	date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where a.status = '$status' ";
			} else {
				$where = $where . " and a.status = '$status' ";
			}								
		}
		
		if($kode=='' && $from_date=='' && $to_date=='' && $client_code=='' && $status=='' && $all=='') {
			$where = "where a.ref='NDFxx'";
		}		
		
		if($all == 1) {
			$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%CSR%' ";  //and ifnull(a.total,0) <> 0 ";
		}
		
		$sqlstr="select a.ref, a.ref2, a.date, a.status, a.top, a.due_date, a.client_code, b.name client_name, a.ship_to, a.bill_to, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.currency_code, a.rate, a.employee_id, a.discount, a.total, a.memo, a.opening_balance, a.cash, a.location_id, a.deposit, a.taxable, a.photo_file, a.cash_amount, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.change_amount, a.uid, a.dlu, c.name client_type_name from sales_invoice a left join client b on a.client_code=b.syscode left join client_type c on b.client_type=c.id " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
    
    
    //-----------cashier detail (saat update)
	function list_sales_shop_order_detail($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select a.ref, a.do_ref, a.so_ref, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.discount, a.discount3, a.unit_price, a.qty_shp, a.amount, a.unit_price2, a.amount2, a.dummy, a.line_item_do from sales_invoice_detail a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data stock opname
	function list_stock_opname($kode ='', $from_date='', $to_date='', $all='', $location_id=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.location_id, b.name location_name, a.bin, a.uid, a.beginning_balance, a.memo, a.dlu, a.syscode from stock_opname a left join warehouse b on a.location_id=b.id " . $where . " order by a.date";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------stock oopname detail (saat update)
	function list_stock_opname_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.date, a.location_id, a.bin, a.uid, a.item_code, a.uom_code, a.line, a.qty, a.unit_cost, a.syscode, b.code item_code2, b.name item_name  from stock_opname_detail a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data employee
	function list_employee($kode ='', $all=0, $act='', $multi_id='', $division_id='', $category_id=''){	
		$dbpdo = DB::create();
		 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		if ( $multi_id != "") {
			if ($where == "") {
				$where = " where a.id in ( ".$multi_id." ) ";
			} else {
				$where = $where . " and a.id in ( ".$multi_id." ) ";
			}								
		}
		
		if ( $division_id != "") {
			if ($where == "") {
				$where = " where a.division_id = '$division_id' ";
			} else {
				$where = $where . " and a.division_id = '$division_id' ";
			}								
		}
		
		if ( $category_id != "") {
			if ($where == "") {
				$where = " where a.category_id = '$category_id' ";
			} else {
				$where = $where . " and a.category_id = '$category_id' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.id, a.code, a.name, a.nick_name, a.born, a.birth_date, a.marital_status, a.religion_id, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.email, a.photo, a.position_id, a.department_id, a.division_id, a.location_id, a.category_id, a.bank_name, a.bank_account, a.bank_account_name, d.name category_name, a.active, a.uid, a.dlu, b.name position_name, c.name division_name from employee a left join position b on a.position_id=b.id left join division c on a.division_id=c.id left join employee_category d on a.category_id=d.id " . $where . " order by a.name";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data sales_order
	function get_sales_order(){	
		$dbpdo = DB::create();
		
		$date = date("Y-m-d");
		 	
		$sqlstr="select a.ref, b.date, b.antrian_no, c.name client_name, a.item_code, d.name item_name, d.photo, e.name employee_name from sales_order_detail a left join sales_order b on a.ref=b.ref left join client c on b.client_code=c.syscode left join item d on a.item_code=d.syscode left join employee e on b.employee_id=e.id where ifnull(b.cutting,0)=0 and b.date='$date' order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data cutting
	function get_sales_order_list($kode ='', $all=0, $from_date='', $to_date='', $cashier='', $status=''){	
		$dbpdo = DB::create();
		
		$where = " where a.ref in (select a.ref from sales_order_detail where ifnull(a.qty,0) - ifnull(a.qty_sales,0) > 0) ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where b.ref = '$kode' ";
			} else {
				$where = $where . " and b.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where b.date >= '$from_date' ";
			} else {
				$where = $where . " and b.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where b.date <='$to_date' ";
			} else {
				$where = $where . " and b.date <= '$to_date' ";
			}								
		}
		
		if ( $cashier != "") {
			if ($where == "") {
				$where = " where b.uid = '$cashier' ";
			} else {
				$where = $where . " and b.uid = '$cashier' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where b.status = '$status' ";
			} else {
				$where = $where . " and b.status = '$status' ";
			}								
		}
		
		if($all == 1) {
			$where = ""; // where ifnull(b.paid,0)=0 and b.status='R' 
		}
		 	
		$sqlstr="select a.ref, b.status, b.date, b.antrian_no, c.name client_name, d.name item_name, d.photo, e.name employee_name, sum(a.qty) qty, sum(a.amount) amount, b.total, b.file_transfer, b.freight_cost from sales_order_detail a left join sales_order b on a.ref=b.ref left join client c on b.client_code=c.syscode left join item d on a.item_code=d.syscode left join employee e on b.employee_id=e.id ".$where." group by a.ref order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------pos get total amount detail
	function list_pos_total_detail($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select sum(a.amount) amount from sales_invoice_tmp a where a.ref='$id' group by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$amount=$data->amount;
		
		return $amount;
	}
	
	//-----------pos get detail
	function list_pos_get_detail($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select a.ref, a.client_code, a.cash, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.discount, a.unit_price, a.amount, a.discount2, a.discount3, a.deposit, a.total, a.non_discount, a.location_id, a.employee_id, a.phone, a.ship_to, a.bill_to, a.line from sales_invoice_tmp a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line desc ";
		
		/*$sqlstr="select a.ref, c.client_code, 1 cash, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.discount, a.unit_price, a.amount, 0 discount2, 0 discount3, 0 deposit, c.total, c.freight_cost, 0 non_discount, a.line, c.employee_id, c.commision_rate, c.uid cs, d.address, d.phone from sales_order_detail a left join item b on a.item_code=b.syscode left join sales_order c on a.ref=c.ref left join client d on c.client_code=d.syscode where a.ref='$id' order by a.line desc ";*/
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pos
	function list_pos($kode ='', $all=0, $from_date='', $to_date='', $shift='', $cashier='', $employee_id='', $location_id='', $client_code='', $client_type='', $channel_id='', $status='', $receipt_type=''){
		$dbpdo = DB::create();
		
		$loginname = $_SESSION['loginname'];

		$where = " where ifnull(a.opening_balance,0) = 0 and (a.ref like '%POS%' or a.ref like '%SLS%' or a.ref like '%DOA%') ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $shift != "" && $shift != 0) {
			if ($where == "") {
				$where = " where a.shift = '$shift' ";
			} else {
				$where = $where . " and a.shift = '$shift' ";
			}								
		}
		
		/*if ( $cashier != "") {
			if ($where == "") {
				$where = " where a.uid = '$cashier' ";
			} else {
				$where = $where . " and a.uid = '$cashier' ";
			}								
		}*/
		
		/*if ( $employee_id != "") {
			if ($where == "") {
				$where = " where a.employee_id = '$employee_id' ";
			} else {
				$where = $where . " and a.employee_id = '$employee_id' ";
			}								
		}
		
		if ( $location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}								
		}*/

		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}

		if ( $client_type != "") {
			if ($where == "") {
				$where = " where b.client_type = '$client_type' ";
			} else {
				$where = $where . " and b.client_type = '$client_type' ";
			}								
		}

		if ( $channel_id != "") {
			if ($where == "") {
				$where = " where a.channel_id = '$channel_id' ";
			} else {
				$where = $where . " and a.channel_id = '$channel_id' ";
			}								
		}

		/*if($_SESSION["adm"] != 1) {
			if ($where == "") {
				$where = " where a.uid = '$loginname' ";
			} else {
				$where = $where . " and a.uid = '$loginname' ";
			}	
		}*/

		if ( $status != "") {
			if($status == 'warehouse') {
				if ($where == "") {
					$where = " where a.process_whs = 1 ";
				} else {
					$where = $where . " and a.process_whs = 1 ";
				}	
			}
			if($status == 'print') {
				if ($where == "") {
					$where = " where a.print = 1 ";
				} else {
					$where = $where . " and a.print = 1 ";
				}	
			}
			if($status == 'onshipped') {
				if ($where == "") {
					$where = " where a.onshipped = 1 ";
				} else {
					$where = $where . " and a.onshipped = 1 ";
				}	
			}
			if($status == 'shipped') {
				if ($where == "") {
					$where = " where a.shipped = 1 ";
				} else {
					$where = $where . " and a.shipped = 1 ";
				}	
			}
			if($status == 'paid') {
				if ($where == "") {
					$where = " where a.paid = 1 ";
				} else {
					$where = $where . " and a.paid = 1 ";
				}	
			}
										
		}

		if($receipt_type != "") {
			if ($where == "") {
				$where = " where a.receipt_type = '$receipt_type' ";
			} else {
				$where = $where . " and a.receipt_type = '$receipt_type' ";
			}	
		}
		
		if($all == 1) {
			/*if($_SESSION["adm"] != 1) {
				$where = " where a.uid='$loginname' and ifnull(a.opening_balance,0) = 0 and (a.ref like '%POS%' or a.ref like '%SLS%' or a.ref like '%DOA%') ";
			} else {*/
				$where = " where ifnull(a.opening_balance,0) = 0 and (a.ref like '%POS%' or a.ref like '%SLS%' or a.ref like '%DOA%') ";
			//}
		}
		
		//$sqlstr="select aa.* from (select a.ref, a.ref2, a.date, a.status, a.top, a.due_date, a.client_code, b.name client_name, a.ship_to, a.bill_to, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.currency_code, a.rate, a.employee_id, a.discount, a.total, a.memo, a.opening_balance, a.cash, a.location_id, a.deposit, a.taxable, a.photo_file, a.cash_amount, a.cash_voucher, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.change_amount, a.shift, a.client_member_code, a.uid, a.dlu, c.code client_member_code2, c.name member_name, (select sum(x.point) point from sales_invoice_point x where x.cleared=0 and x.client_code=a.client_code group by x.client_code) point, a.printed, a.commision_rate, d.name employee_name from sales_invoice a left join client b on a.client_code=b.syscode left join client c on a.client_member_code=c.syscode left join employee d on a.employee_id=d.id where a.ref not in (select ref from sales_invoice_employee)";
		
		//(select sum(x.point) point from sales_invoice_point x where x.cleared=0 and x.client_code=a.client_code group by x.client_code) 
		//inner join sales_invoice_employee d on a.ref=d.ref 

		$sqlstr= "select a.ref, a.ref2, a.date, a.status, a.top, a.due_date, a.client_code, a.channel_id, b.name client_name, b.address, a.ship_to, a.bill_to, a.expedition_id, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.currency_code, a.rate, a.employee_id, a.discount, a.total, a.memo, a.opening_balance, a.cash, a.location_id, a.deposit, a.taxable, a.photo_file, a.cash_amount, a.cash_voucher, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.change_amount, a.shift, a.client_member_code, a.phone, a.bank_account, a.expedition_bill, a.receipt_type, a.note_transfer, a.note_ecommerce, a.process_whs, a.print, a.onshipped, a.shipped, a.paid, a.uid, a.dlu, c.code client_member_code2, c.name member_name, 0 point, a.printed, a.commision_rate, e.name employee_name, f.name client_type_name, g.name channel_name from sales_invoice a left join client b on a.client_code=b.syscode left join client c on a.client_member_code=c.syscode left join employee e on a.employee_id=e.id left join client_type f on b.client_type=f.id left join channel g on a.channel_id=g.id " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------pos detail (saat update)
	function list_pos_detail($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select a.ref, a.do_ref, a.so_ref, a.return_ref, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.discount, a.discount3, a.unit_price, a.qty_shp, a.amount, a.unit_price2, a.amount2, a.dummy, a.unit_cost, a.amount_cost, a.line_item_do, a.line_item_so, a.line from sales_invoice_detail a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------get total detail 
	function get_pos_detail($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select sum(a.discount3) discount3, sum(a.unit_price) unit_price, sum(a.qty_shp) qty_shp, sum(a.amount) amount, sum(a.unit_price2) unit_price2, sum(a.amount2) amount2, sum(a.unit_cost) unit_cost, sum(a.amount_cost) amount_cost from sales_invoice_detail a where a.ref='$id' group by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------total purchase inv detail
	function list_purchase_inv_total_tmp($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select sum(a.amount) total from purchase_invoice_tmp a where a.ref='$id' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$total=$data->total;
		
		return $total;
	}
	
	
	//-----------total purchase inv detail
	function list_purchase_inv_total($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select sum(a.total) total from purchase_invoice a where a.ref='$id' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$total=$data->total;
		
		return $total;
	}
	
	//---------get data purchase inv
	function list_purchase_inv($kode ='', $from_date='', $to_date='', $vendor_code='', $all=0, $purchase_type=''){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%POV%' ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		
		if ( $vendor_code != "") {
			if ($where == "") {
				$where = " where a.vendor_code = '$vendor_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$vendor_code' ";
			}								
		}

		if ( $purchase_type != "") {
			if ($where == "") {
				$where = " where a.purchase_type = '$purchase_type' ";
			} else {
				$where = $where . " and a.purchase_type = '$purchase_type' ";
			}								
		}
		
		if($all == 1) {
			$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%POV%' ";
		}
		
		$sqlstr="select a.ref, a.invoice_no, a.date, a.status, a.bill_number, a.vendor_code, a.payment_type, b.name vendor_name, a.top, a.due_date, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.memo, a.discount, a.total, a.location_id, a.cash, a.cash_amount, a.change_amount, a.bank_id, a.bank_account, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.stock_in, a.purchase_type, a.uid, a.dlu, (select sum(aa.amount) from purchase_invoice_detail aa group by aa.ref having aa.ref=a.ref) amount, c.name order_name from purchase_invoice a left join vendor b on a.vendor_code=b.syscode left join purchase_type c on a.purchase_type=c.id " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//-----------purchase_inv detail (saat update)
	function list_purchase_inv_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.po_ref, a.item_code, b.code item_code2, b.name item_name, a.uom_code, a.size, a.qty, ifnull(a.qty_good,0) qty_good, a.unit_cost, a.discount1, a.discount2, a.discount3, a.discount4, a.discount, a.amount, a.line_item_po, a.line from purchase_invoice_detail a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line desc ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------pos purchase inv detail
	function list_purchase_inv_get_detail($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select a.ref, a.vendor_code, a.item_code, b.code, b.name item_name, a.uom_code, a.size, a.qty, a.discount1, a.discount2, a.discount3, a.discount4, a.discount, a.unit_cost, a.amount, a.total, a.location_id, a.payment_type, a.stock_in, a.line from purchase_invoice_tmp a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line desc";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------General Journal
	function list_general_journal($ref='', $frmdate='', $todate='', $status='', $memo='', $all=0){	
		$dbpdo = DB::create();
		
		$where = "  where left(a.ref,3)='COT' ";
		if ($ref != '') {
			if($where == '') { $where = " where a.ref = '$ref' "; } else { $where = $where . " and a.ref = '$ref' "; } 
		}
		
		if ($frmdate != '') {
			$frmdate = str_replace(',', ' ', $frmdate);
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date >= '$frmdate' "; } else { $where = $where . " and a.date >= '$frmdate' "; } 
		}
		
		if ($todate != '') {
			$todate = str_replace(',', ' ', $todate);
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date <= '$todate' "; } else { $where = $where . " and a.date <= '$todate' "; } 
		}
		
		/*if ($frmdate != '' && $todate == '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date = '$frmdate' "; } else { $where = $where . " and a.date = '$frmdate' "; } 
		}
		if ($frmdate == '' && $todate != '') {
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date = '$todate' "; } else { $where = $where . " and a.date = '$todate' "; } 
		}
		if ($frmdate != '' && $todate != '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date >= '$frmdate' and a.date <= '$todate' "; } else { $where = $where . " and a.date >= '$frmdate' and a.date <= '$todate' "; } 
		}*/
		if ($status != '') {
			if($where == '') { $where = " where a.status = '$status' "; } else { $where = $where . " and a.status = '$status' "; } 
		}
		if ($memo != '') {
			if($where == '') { $where = " where a.memo like '%$memo%' "; } else { $where = $where . " and a.memo like '%$memo%' "; } 
		}
		if ($all == 1) {			
			$where = "  where left(a.ref,3)='COT' ";
		}
		
		/*if ($all == 0) {			
			$frmdate = date('d-m-Y', strtotime('-7 day'));
			$frmdate = date('Y-m-d', strtotime($frmdate));
			$todate 	= date("Y-m-d");			
			if($where == '') { $where = " where a.date >= '$frmdate' and a.date <= '$todate' "; }
		}
		if (user_admin()==0) {
			$uid = $_SESSION["loginname"];
			
			if($where == '') {
				$where = " where b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			} else {
				$where = $where . " and b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			}
		}*/
		
		$sqlstr = "select distinct a.ref, a.status, a.date, a.memo, a.currency_code, a.rate, a.total_balance, a.total_debit, a.total_credit, a.uid, a.dlu from general_journal a " . $where . " order by a.ref desc ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		
/*		if ($ref == "") {
			$where = "";
			if (user_admin()==0) {
				$uid = $_SESSION["loginname"];
				
				$where = " where b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			} 
			$sql=mysql_query("select distinct a.ref, a.status, a.date, a.memo, a.curcde, a.excrte, a.ttlblc, a.ttldbt, a.ttlcrd, a.uid, a.dlu from gnrjrn a left join usr_dtl2 b on a.uid=b.usrid " . $where . " order by a.ref desc ");			
		} else {
			$sql=mysql_query("select a.ref, a.status, a.date, a.memo, a.curcde, a.excrte, a.ttlblc, a.ttldbt, a.ttlcrd, a.uid, a.dlu from gnrjrn a left join usr_dtl2 b on a.uid=b.usrid where a.ref='$ref' order by a.ref desc ");
		}
*/				
		return $sql;
	}
	
	//---------General Journal detail
	function list_general_journal_detail($ref='', $kode=''){	 
		$dbpdo = DB::create();
		
		$where = "";
		
		if($ref != "") {
			if($where == "") {
				$where = "where a.ref='$ref'";
			} else {
				$where = $where . " and a.ref='$ref'";
			}
		}
		
		if($kode != "") {
			if($where == "") {
				$where = "where a.account_code='$kode'";
			} else {
				$where = $where . " and a.account_code='$kode'";
			}
		}	
		
		if($ref=='' && $kode=='') {
			$where = "where a.ref='ndfxxx'";
		}
		
		$sqlstr = "select a.ref, b.code, a.account_code, a.memo, a.debit_amount, a.credit_amount, a.line, b.name from general_journal_detail a left join finance_type b on a.account_code=b.id " . $where . " order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data coa
	function list_coa_get($kode=''){	 	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		} else {
			$where = " where a.syscode = 'ndfxx' ";
		}
		
		
		$sqlstr = "select a.syscode, a.acc_code, a.name accdcr from coa a " . $where . " order by a.name";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data capster
	function get_data_capster(){	 	
		$dbpdo = DB::create();
		
		$sqlstr="select id, code, name from employee where active=1 and division_id=2 order by name";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data capster
	function list_sales_order_employee($ref, $employee_id=''){	 	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}								
		} 
		
		if ( $employee_id != "") {
			if ($where == "") {
				$where = " where a.employee_id = '$employee_id' ";
			} else {
				$where = $where . " and a.employee_id = '$employee_id' ";
			}								
		} 
		
		$sqlstr="select a.ref, a.employee_id, b.name from sales_order_employee a left join employee b on a.employee_id=b.id ".$where." order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data capster
	function list_sales_invoice_employee($ref, $employee_id=''){	 	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}								
		} 
		
		if ( $employee_id != "") {
			if ($where == "") {
				$where = " where a.employee_id = '$employee_id' ";
			} else {
				$where = $where . " and a.employee_id = '$employee_id' ";
			}								
		} 
		
		$sqlstr="select a.ref, a.employee_id, b.name from sales_invoice_employee a left join employee b on a.employee_id=b.id ".$where." order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------General Journal
	function get_total_general_journal($frmdate='', $todate=''){	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($frmdate != '') {
			$frmdate = str_replace(',', ' ', $frmdate);
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date >= '$frmdate' "; } else { $where = $where . " and a.date >= '$frmdate' "; } 
		}
		
		if ($todate != '') {
			$todate = str_replace(',', ' ', $todate);
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date <= '$todate' "; } else { $where = $where . " and a.date <= '$todate' "; } 
		}
		
		$sqlstr = "select a.date, sum(a.total_credit) total_credit from general_journal a " . $where . " group by a.date";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data sales orser
	function list_sales_order($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.top, a.client_code, b.name client_name, a.qo_ref, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.currency_code, a.rate, a.employee_id, a.total, a.memo, a.file_transfer, a.uid, a.dlu from sales_order a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	//-----------sales order detail (saat update)
	function list_sales_order_detail($id='', $item_group_id='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.ref = '$id' ";
			} else {
				$where = $where . " and a.ref = '$id' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		$sqlstr="select a.ref, a.item_code, a.uom_code, a.qty, a.qty_shp, a.discount, a.unit_price, a.amount, a.line, b.code, b.name item_name, a.item_status, c.name item_status_name from sales_order_detail a left join item b on a.item_code=b.syscode left join discount c on a.discount_id=c.id ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data sales invoice
	function list_sales_invoice($kode ='', $all=0, $from_date='', $to_date='', $shift='', $cashier='', $employee_id='', $client_code=''){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(a.opening_balance,0) = 0 and (a.ref like '%POS%' or a.ref like '%SLS%' or a.ref like '%DOA%') ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $shift != "") {
			if ($where == "") {
				$where = " where a.shift = '$shift' ";
			} else {
				$where = $where . " and a.shift = '$shift' ";
			}								
		}
		
		if ( $cashier != "") {
			if ($where == "") {
				$where = " where a.uid = '$cashier' ";
			} else {
				$where = $where . " and a.uid = '$cashier' ";
			}								
		}
		
		if ( $employee_id != "") {
			if ($where == "") {
				$where = " where a.employee_id = '$employee_id' ";
			} else {
				$where = $where . " and a.employee_id = '$employee_id' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if($all == 1) {
			$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%POS%' or a.ref like '%SLS%' or a.ref like '%DOA%' ";
		}
		
		/*$sqlstr= " select a.ref, a.ref2, a.date, a.status, a.top, a.due_date, a.client_code, b.name client_name, a.ship_to, a.bill_to, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.currency_code, a.rate, a.discount, a.total, a.memo, a.opening_balance, a.cash, a.location_id, a.deposit, a.taxable, a.photo_file, a.cash_amount, a.cash_voucher, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.change_amount, a.shift, a.client_member_code, a.uid, a.dlu, c.code client_member_code2, c.name member_name, (select sum(x.point) point from sales_invoice_point x where x.cleared=0 and x.client_code=a.client_code group by x.client_code) point, a.printed, a.commision_rate from sales_invoice a left join client b on a.client_code=b.syscode left join client c on a.client_member_code=c.syscode " . $where . " order by a.ref";*/
		
		$sqlstr= " select a.ref, a.ref2, a.date, a.status, a.top, a.due_date, a.client_code, b.name client_name, a.ship_to, a.bill_to, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.currency_code, a.rate, a.discount, a.total, a.memo, a.opening_balance, a.cash, a.location_id, a.deposit, a.taxable, a.photo_file, a.cash_amount, a.cash_voucher, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.change_amount, a.shift, a.client_member_code, a.uid, a.dlu, c.code client_member_code2, c.name member_name, 0 point, a.printed, a.commision_rate, d.name employee_name from sales_invoice a left join client b on a.client_code=b.syscode left join client c on a.client_member_code=c.syscode left join employee d on a.employee_id=d.id " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	//-----------sales incvoice detail (saat update)
	function list_sales_invoice_detail($kode='', $item_group_id='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		$sqlstr="select a.ref, a.so_ref, a.item_code, a.uom_code, a.qty, a.discount, a.unit_price, a.amount, a.line, b.code, b.name item_name from sales_invoice_detail a left join item b on a.item_code=b.syscode ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data delivery orser
	function list_delivery_order($kode ='', $from_date='', $to_date='', $all='', $expedition_id=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));

			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}

		if($expedition_id != "") {
			if ($where == "") {
				$where = " where a.ref in (select a.ref from delivery_order_detail a left join sales_invoice b on a.so_ref=b.ref where b.expedition_id='$expedition_id') ";
			} else {
				$where = $where . " and a.ref in (select a.ref from delivery_order_detail a left join sales_invoice b on a.so_ref=b.ref where b.expedition_id='$expedition_id') ";
			} 
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.location_id, a.ship_to, a.po_number, a.client_code, a.memo, a.uid, a.dlu, b.name client_name, a.delivered, c.name location_name, (select sum(qty) from delivery_order_detail where ref=a.ref) qty, (select y.freight_cost from delivery_order_detail x left join sales_invoice y on x.so_ref=y.ref where x.ref=a.ref limit 1) freight_cost from delivery_order a left join client b on a.client_code=b.syscode left join warehouse c on a.location_id=c.id  " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//-----------sales delivery detail (saat update)
	function list_delivery_order_detail($id='', $item_group_id='') {
		$dbpdo = DB::create();
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.ref = '$id' ";
			} else {
				$where = $where . " and a.ref = '$id' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		$sqlstr="select a.ref, a.so_ref, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.unit_price, a.discount, a.ship_date, a.line_item_so, a.line, c.delivered from delivery_order_detail a left join item b on a.item_code=b.syscode left join delivery_order c on a.ref=c.ref ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data item po stock
	function list_item_po_stock($kode ='', $all=0, $active='', $code='', $old_code='', $name='', $item_group_id='', $from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		if ( $code != "") {
			if ($where == "") {
				$where = " where a.code = '$code' ";
			} else {
				$where = $where . " and a.code = '$code' ";
			}								
		}
		
		if ( $old_code != "") {
			if ($where == "") {
				$where = " where a.old_code = '$old_code' ";
			} else {
				$where = $where . " and a.old_code = '$old_code' ";
			}								
		}
		
		if ( $name != "") {
			$name = petikreplace($name);
			if ($where == "") {
				$where = " where a.syscode = '$name' ";
			} else {
				$where = $where . " and a.syscode = '$name' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where a.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and a.item_group_id = '$item_group_id' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
		/*if($kode=='' && $all==0 && $act=='' && $code=='' && $old_code=='' && $name=='' && $item_group_id=='' && $from_date=='' && $to_date=='') {
			$where = " where a.syscode = 'NDF' ";
		}*/
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.old_code, a.name, a.item_group_id, b.name item_group_name, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.balance, a.description, a.active, a.uid, a.dlu, a.syscode from item a left join item_group b on a.item_group_id=b.id " . $where . " order by a.code limit 9";
		//echo $sqlstr;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data cutting
	function list_sales_order_cs_list($kode ='', $all=0, $from_date='', $to_date='', $cashier='', $status=''){	
		$dbpdo = DB::create();
		
		$where = ""; // where ifnull(b.paid,0)=0 and b.status='R' 
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where b.ref = '$kode' ";
			} else {
				$where = $where . " and b.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where b.date >= '$from_date' ";
			} else {
				$where = $where . " and b.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where b.date <='$to_date' ";
			} else {
				$where = $where . " and b.date <= '$to_date' ";
			}								
		}
		
		if ( $cashier != "") {
			if ($where == "") {
				$where = " where b.uid = '$cashier' ";
			} else {
				$where = $where . " and b.uid = '$cashier' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where b.status = '$status' ";
			} else {
				$where = $where . " and b.status = '$status' ";
			}								
		}
		
		if($all == 1) {
			$where = ""; // where ifnull(b.paid,0)=0 and b.status='R' 
		}
		 	
		$sqlstr="select a.ref, b.client_code, b.status, b.date, b.antrian_no, c.name client_name, d.name item_name, d.photo, e.name client_name, e.address, e.state_id, e.phone, e.zip_code, e.kabupaten, e.kecamatan, sum(a.qty) qty, sum(a.amount) amount, b.transfer_date, b.total, b.file_transfer, b.freight_account, b.freight_cost from sales_order_detail a left join sales_order b on a.ref=b.ref left join client c on b.client_code=c.syscode left join item d on a.item_code=d.syscode left join client e on b.client_code=e.syscode ".$where." group by a.ref order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------sales order detail (saat update)
	function list_sales_order_cs_detail_rs($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select aa.* from (select a.ref, a.item_code, a.uom_code, a.qty, a.discount, a.unit_price, a.amount, a.line, b.code, b.name item_name, a.item_status, a.discount_id, c.name item_status_name, '0' m_type from sales_order_detail a left join item b on a.item_code=b.syscode left join discount c on a.discount_id=c.id where a.ref='$id' and a.item_status='RS'";
		
		$sqlstr=$sqlstr . " union all select '' ref, a.syscode item_code, a.uom_code_sales uom_code, 1 qty, 0 discount, 0 unit_price, 0 amount, 0 line, a.code, a.name item_name, 'RS' item_status, 0 discount_id, '' item_status_name, '1' m_type from item a left join item_group b on a.item_group_id=b.id where a.item_group_id = '4' ) aa order by aa.m_type, aa.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------sales order detail (saat update)
	function list_sales_order_cs_detail_po($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select aa.* from (select a.ref, a.item_code, a.uom_code, a.qty, a.discount, a.unit_price, a.amount, a.line, b.code, b.name item_name, a.item_status, a.discount_id, c.name item_status_name, '0' m_type from sales_order_detail a left join item b on a.item_code=b.syscode left join discount c on a.discount_id=c.id where a.ref='$id' and a.item_status='PO'";
		
		$sqlstr=$sqlstr . " union all select '' ref, a.syscode item_code, a.uom_code_sales uom_code, 1 qty, 0 discount, 0 unit_price, 0 amount, 0 line, a.code, a.name item_name, 'PO' item_status, 0 discount_id, '' item_status_name, '1' m_type from item a left join item_group b on a.item_group_id=b.id where a.item_group_id = '4') aa order by aa.m_type, aa.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data acc
	function get_sales_order_acc_list($kode ='', $all=0, $from_date='', $to_date='', $cashier='', $status=''){	
		$dbpdo = DB::create();
		
		$where = " where b.status in ('A','S') ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where b.ref = '$kode' ";
			} else {
				$where = $where . " and b.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where b.date >= '$from_date' ";
			} else {
				$where = $where . " and b.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where b.date <='$to_date' ";
			} else {
				$where = $where . " and b.date <= '$to_date' ";
			}								
		}
		
		if ( $cashier != "") {
			if ($where == "") {
				$where = " where b.uid = '$cashier' ";
			} else {
				$where = $where . " and b.uid = '$cashier' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where b.status = '$status' ";
			} else {
				$where = $where . " and b.status = '$status' ";
			}								
		}
		
		if($all == 1) {
			$where = " where b.status='A' ";
		}
		 	
		$sqlstr="select a.ref, b.status, b.date, b.client_code, b.antrian_no, c.name client_name, d.name item_name, d.photo, e.name employee_name, sum(a.qty) qty, sum(a.amount) amount, b.total, b.file_transfer, b.freight_cost from sales_order_detail a left join sales_order b on a.ref=b.ref left join client c on b.client_code=c.syscode left join item d on a.item_code=d.syscode left join employee e on b.employee_id=e.id ".$where." group by a.ref order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------sales invoice detail RS (saat update)
	function list_sales_invoice_rs_detail($id='',$item_group_id='') {
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.qty,0) - ifnull(a.qty_shp,0) >0 ";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.ref = '$id' ";
			} else {
				$where = $where . " and a.ref = '$id' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		$sqlstr="select a.ref, a.item_code, a.uom_code, a.qty, a.discount, a.unit_price, a.amount, a.line, b.code, b.name item_name from sales_invoice_detail a left join item b on a.item_code=b.syscode ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data PO
	function get_sales_order_po_list($kode ='', $all=0, $from_date='', $to_date='', $cashier='', $status=''){	
		$dbpdo = DB::create();
		
		$where = " where a.item_status='PO'";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where b.ref = '$kode' ";
			} else {
				$where = $where . " and b.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where b.date >= '$from_date' ";
			} else {
				$where = $where . " and b.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where b.date <='$to_date' ";
			} else {
				$where = $where . " and b.date <= '$to_date' ";
			}								
		}
		
		if ( $cashier != "") {
			if ($where == "") {
				$where = " where b.uid = '$cashier' ";
			} else {
				$where = $where . " and b.uid = '$cashier' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where b.status = '$status' ";
			} else {
				$where = $where . " and b.status = '$status' ";
			}								
		}
		
		if($all == 1) {
			$where = " where a.item_status='PO'";
		}
		 	
		$sqlstr="select a.ref, b.status, b.date, b.client_code, b.antrian_no, c.name client_name, d.name item_name, d.photo, e.name employee_name, sum(a.qty) qty, sum(a.amount) amount, b.total, b.file_transfer, b.freight_cost from sales_order_detail a left join sales_order b on a.ref=b.ref left join client c on b.client_code=c.syscode left join item d on a.item_code=d.syscode left join employee e on b.employee_id=e.id ".$where." group by a.ref order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------list promo
	function list_promo($id=''){	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.id = '$id' ";
			} else {
				$where = $where . " and a.id = '$id' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.active, a.uid, a.dlu from promo a ".$where." order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------vendor Type
	function list_vendor_type($kode ='', $all=0, $act='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.pch_account, a.pch_return_account, a.pch_discount_account, a.vendor_deposit_account, a.currency_account, a.cheque_payable_account, a.location_id, b.name w_name, a.active, a.uid, a.dlu  from vendor_type a left join warehouse b on a.location_id=b.id " . $where . " order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data vendor type detail
	function list_vendor_type_detail($id_header =''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $id_header != "") {
			if ($where == "") {
				$where = " where a.id_header = '$id_header' ";
			} else {
				$where = $where . " and a.id_header = '$id_header' ";
			}								
		}
		
		$sqlstr="select a.id, a.id_header, a.pch_account, a.pch_cash_account, a.pch_return_account, a.pch_discount_account, a.vendor_deposit_account, a.currency_account, a.cheque_payable_account, a.hutang_belum_faktur, a.location_id, a.line  from vendor_type_detail a " . $where . " order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------vendor
	function list_vendor($kode ='', $all=0, $act='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}
		
		$sqlstr="select a.code, a.name, a.contact_person, a.vendor_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.fax, a.email, a.web, a.bank_account, a.active, a.uid, a.dlu, a.syscode, b.name vendor_type_name  from vendor a left join vendor_type b on a.vendor_type=b.id " . $where . " order by a.code ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data sewing
	function list_sewing($kode='', $from_date='', $to_date='', $client_code='', $status='', $vendor_code='', $all=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date	=	date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date	=	date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if ( $vendor_code != "") {
			if ($where == "") {
				$where = " where a.vendor_code = '$vendor_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$vendor_code' ";
			}								
		}
		
		if ( $status != "") {
			if ($where == "") {
				$where = " where a.status = '$status' ";
			} else {
				$where = $where . " and a.status = '$status' ";
			}								
		}
		
		if($kode=='' && $from_date=='' && $to_date=='' && $client_code=='' && $status=='' && $vendor_code=='' && $all=='') {
			$where = "where a.ref='NDFxx'";
		}		
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.finish_date, a.status, a.vendor_code, a.client_code, a.employee_id, a.location_id, a.memo, case when ifnull(a.total_amount,0)=0 then e.amount else a.total_amount end total_amount, a.payment_type, a.uid, a.dlu, b.name client_name, c.name vendor_name, d.name location_name from sewing a left join client b on a.client_code=b.syscode left join vendor c on a.vendor_code=c.syscode left join warehouse d on a.location_id=d.id left join (select x.ref, sum(x.amount) amount from sewing_detail x group by x.ref) e on a.ref=e.ref " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//-----------cousewingnting detail (saat update)
	function list_sewing_detail($id) {
		$dbpdo = DB::create();
		
		/*$sqlstr="select a.ref, a.item_code, a.uom_code, a.qty, a.qty_good, a.qty_damaged, a.remark_damaged, a.status_damaged, a.time, a.upd, a.line, b.code, b.name item_name, c.name item_group_name, b.photo from sewing_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id' order by a.line ";*/
		
		/*$sqlstr="select aa.* from (select a.ref, a.item_code, a.uom_code, a.qty, a.qty_good, a.qty_damaged, a.remark_damaged, a.status_damaged, a.time, a.line, b.code, b.name item_name, c.name item_group_name, b.photo, '0' m_type from sewing_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id'";
		
		$sqlstr=$sqlstr . " union all select '' ref, a.syscode item_code, a.uom_code_stock uom_code, 1 qty, 0 qty_good, 0 qty_damaged, '' remark_damaged, '' status_damaged, '' time, 0 line, a.code, a.name item_name, b.name item_group_name, a.photo, '1' m_type from item a left join item_group b on a.item_group_id=b.id ) aa order by m_type, aa.line";*/
		
		$sqlstr="select a.ref, a.item_code, a.uom_code, a.size, a.qty, a.qty_good, a.qty_damaged, a.remark_damaged, a.status_damaged, a.unit_cost, a.discount1, a.discount2, a.amount, a.time, a.line, b.code item_code2, b.name item_name, c.name item_group_name, b.photo, '0' m_type from sewing_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data purchase inv
	function get_purchase_inv_outstanding($kode ='', $from_date='', $to_date='', $vendor_code='', $all=0){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%POV%' ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		
		if ( $vendor_code != "") {
			if ($where == "") {
				$where = " where a.vendor_code = '$vendor_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$vendor_code' ";
			}								
		}
		
		if($all == 1) {
			$where = " where ifnull(a.opening_balance,0) = 0 and a.ref like '%POV%' ";
		}
		
		$sqlstr="select a.ref, a.invoice_no, a.date, a.status, a.bill_number, a.vendor_code, a.payment_type, b.name vendor_name, a.top, a.due_date, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.memo, a.discount, a.total, a.location_id, a.cash, a.cash_amount, a.change_amount, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.uid, a.dlu, (select sum(aa.amount) from purchase_invoice_detail aa group by aa.ref having aa.ref=a.ref) amount from purchase_invoice a left join vendor b on a.vendor_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data good receipt
	function list_good_receipt($kode ='', $from_date='', $to_date='', $all=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.vendor_code, a.date_arrival, a.driver, a.vehicle, a.location_id, a.do_ref, a.memo, a.receipt_type, a.uid, a.dlu, b.name vendor_name, c.name location_name, (select sum(aa.qty) from good_receipt_detail aa where aa.ref=a.ref group by ref) qty from good_receipt a left join vendor b on a.vendor_code=b.syscode left join warehouse c on a.location_id=c.id  " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//-----------good_receipt detail (saat update)
	function list_good_receipt_detail($id='', $item_group_id='') {
		$dbpdo = DB::create();
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.ref = '$id' ";
			} else {
				$where = $where . " and a.ref = '$id' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		$sqlstr="select a.ref, a.item_code, a.uom_code, a.size, a.po_ref, a.qty, a.unit_cost, a.pi_line, a.status, a.line, b.code, b.name item_name from good_receipt_detail a left join item b on a.item_code=b.syscode ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data outbound
	function list_outbound($kode ='', $from_date='', $to_date='', $all='', $warehouse_id_from='', $warehouse_id_to=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $warehouse_id_from != "") {
			if ($where == "") {
				$where = " where a.warehouse_id_from = '$warehouse_id_from' ";
			} else {
				$where = $where . " and a.warehouse_id_from = '$warehouse_id_from' ";
			}								
		}
		
		if ( $warehouse_id_to != "") {
			if ($where == "") {
				$where = " where a.warehouse_id_to = '$warehouse_id_to' ";
			} else {
				$where = $where . " and a.warehouse_id_to = '$warehouse_id_to' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.reason, a.type, a.form_no, a.warehouse_id_from, a.warehouse_id_to, a.employee_id, a.employee_id2, a.uid, a.dlu, b.name from_location, c.name to_location, d.name employee_name, e.name employee_name2, (select sum(q.qty) from outbound_detail q group by q.ref having q.ref=a.ref) qty from outbound a left join warehouse b on a.warehouse_id_from=b.id left join warehouse c on a.warehouse_id_to=c.id left join employee d on a.employee_id=d.id left join employee e on a.employee_id2=e.id " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------outbound detail (saat update)
	function list_outbound_detail($kode='', $item_group_id='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		$sqlstr="select a.ref, a.item_code, a.uom_code, a.qty, a.ref_pos, a.line, b.code item_code2, b.name item_name from outbound_detail a left join item b on a.item_code=b.syscode " . $where . " order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------outbound detail last
	function list_outbound_get_detail_last($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select a.ref, a.warehouse_id_from, a.warehouse_id_to, a.employee_id, a.employee_id2, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.line from outbound_tmp a left join item b on a.item_code=b.syscode where a.ref='$id' and a.warehouse_id_to<>0 order by a.line limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------outbound detail
	function list_outbound_get_detail($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select a.ref, a.warehouse_id_from, a.warehouse_id_to, a.employee_id, a.employee_id2, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.line from outbound_tmp a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data uom
	function list_uom($kode ='', $all=0, $act=''){	
		$dbpdo = DB::create();
		 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.code = '$kode' ";
			} else {
				$where = $where . " and a.code = '$kode' ";
			}								
		}
		
		$sqlstr="select a.code, a.name, a.active, a.uid, a.dlu from uom a " . $where . " order by a.code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data division
	function list_division($kode ='', $all=0, $act=''){	
		$dbpdo = DB::create();
		 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.active, a.uid, a.dlu from division a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data position
	function list_position($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.active, a.uid, a.dlu from position a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data colour
	function list_colour($kode ='', $all=0, $act=''){	
		$dbpdo = DB::create();
		 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.active, a.uid, a.dlu from colour a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------total sewing detail
	function list_sewing_total_tmp($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select sum(a.amount) total from sewing_tmp a where a.ref='$id' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$total=$data->total;
		
		return $total;
	}
	
	
	//-----------total sewing detail
	function list_sewing_total($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select sum(a.total_amount) total from sewing a where a.ref='$id' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$total=$data->total;
		
		return $total;
	}
	
	
	//-----------pos sewing detail
	function list_sewing_get_detail($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select a.ref, a.date, a.finish_date, a.vendor_code, a.employee_id, a.location_id, a.item_code, b.code, b.name item_name, a.uom_code, a.size, a.qty, a.discount1, a.discount2, a.unit_cost, a.amount, a.total, a.location_id, a.memo, a.line from sewing_tmp a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line desc";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data outstanding sewing
	function get_sewing_outstanding($kode ='', $from_date='', $to_date='', $vendor_code='', $all=0){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		
		if ( $vendor_code != "") {
			if ($where == "") {
				$where = " where a.vendor_code = '$vendor_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$vendor_code' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		
		$sqlstr="select a.ref, a.date, a.finish_date, a.status, a.vendor_code, a.client_code, a.employee_id, a.location_id, a.memo, a.total_amount, a.payment_type, a.uid, a.dlu, b.name client_name, c.name vendor_name from sewing a left join client b on a.client_code=b.syscode left join vendor c on a.vendor_code=c.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//-----------client Type
	function list_client_type($kode ='', $all=0, $act='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.active, a.uid, a.dlu  from client_type a " . $where . " order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	function get_pos_detail_discount($id) {
		$dbpdo = DB::create();
				
		$sqlstr="select sum(a.discount) discount from sales_invoice_detail a where a.ref='$id' group by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data new product
	function list_new_product($kode ='', $all=0, $active='', $code='', $old_code='', $name='', $item_group_id='', $from_date='', $to_date='', $designer=''){
		$dbpdo = DB::create();
			 	
		$where = " where a.development=1 ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		if ( $code != "") {
			if ($where == "") {
				$where = " where a.code = '$code' ";
			} else {
				$where = $where . " and a.code = '$code' ";
			}								
		}
		
		if ( $old_code != "") {
			if ($where == "") {
				$where = " where a.old_code = '$old_code' ";
			} else {
				$where = $where . " and a.old_code = '$old_code' ";
			}								
		}
		
		if ( $name != "") {
			$name = petikreplace($name);
			if ($where == "") {
				$where = " where a.syscode = '$name' ";
			} else {
				$where = $where . " and a.syscode = '$name' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where a.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and a.item_group_id = '$item_group_id' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
		if ( $designer != "") {
			if ($where == "") {
				$where = " where a.designer like '%$designer%' ";
			} else {
				$where = $where . " and a.designer like '%$designer%' ";
			}								
		}
		
		/*if($kode=='' && $all==0 && $act=='' && $code=='' && $old_code=='' && $name=='' && $item_group_id=='' && $from_date=='' && $to_date=='') {
			$where = " where a.syscode = 'NDF' ";
		}*/
		
		if($all == 1) {
			$where = " where a.development=1 ";
		}
		
		$sqlstr="select a.code, a.old_code, a.name, a.item_group_id, b.name item_group_name, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.balance, a.description, a.po_date, a.photo_date, a.catalog_date, a.publish_date, a.designer, a.active, a.development, a.uid, a.dlu, a.syscode from item a left join item_group b on a.item_group_id=b.id " . $where . " order by a.code";
		//echo $sqlstr;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data finance type
	function list_finance_type($kode ='', $type='', $act='', $location_id='', $all=''){	 	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		if ( $type != "") {
			if ($where == "") {
				$where = " where a.type = '$type' ";
			} else {
				$where = $where . " and a.type = '$type' ";
			}								
		}
		
		if ( $act != "") {
			if ($where == "") {
				$where = " where a.active = '$act' ";
			} else {
				$where = $where . " and a.active = '$act' ";
			}								
		}
		
		if ( $location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}								
		}
		
		if($all != "") {
			$where = "";
		}
		
		$sqlstr="select a.id, a.code, a.name, a.location_id, a.type, a.account_code, c.acc_code, c.name acc_name, a.active, a.uid, a.dlu, b.name warehouse_name from finance_type a left join warehouse b on a.location_id=b.id left join coa c on a.account_code=c.syscode " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------General Journal in
	function list_general_journal_in($ref='', $frmdate='', $todate='', $status='', $memo='', $all=0){	
		$dbpdo = DB::create();
		
		$where = "  where left(a.ref,3)='CIT' ";
		if ($ref != '') {
			if($where == '') { $where = " where a.ref = '$ref' "; } else { $where = $where . " and a.ref = '$ref' "; } 
		}
		
		if ($frmdate != '') {
			$frmdate = str_replace(',', ' ', $frmdate);
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date >= '$frmdate' "; } else { $where = $where . " and a.date >= '$frmdate' "; } 
		}
		
		if ($todate != '') {
			$todate = str_replace(',', ' ', $todate);
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date <= '$todate' "; } else { $where = $where . " and a.date <= '$todate' "; } 
		}
		
		/*if ($frmdate != '' && $todate == '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date = '$frmdate' "; } else { $where = $where . " and a.date = '$frmdate' "; } 
		}
		if ($frmdate == '' && $todate != '') {
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date = '$todate' "; } else { $where = $where . " and a.date = '$todate' "; } 
		}
		if ($frmdate != '' && $todate != '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date >= '$frmdate' and a.date <= '$todate' "; } else { $where = $where . " and a.date >= '$frmdate' and a.date <= '$todate' "; } 
		}*/
		if ($status != '') {
			if($where == '') { $where = " where a.status = '$status' "; } else { $where = $where . " and a.status = '$status' "; } 
		}
		if ($memo != '') {
			if($where == '') { $where = " where a.memo like '%$memo%' "; } else { $where = $where . " and a.memo like '%$memo%' "; } 
		}
		if ($all == 1) {			
			$where = "  where left(a.ref,3)='CIT' ";
		}
		
		/*if ($all == 0) {			
			$frmdate = date('d-m-Y', strtotime('-7 day'));
			$frmdate = date('Y-m-d', strtotime($frmdate));
			$todate 	= date("Y-m-d");			
			if($where == '') { $where = " where a.date >= '$frmdate' and a.date <= '$todate' "; }
		}
		if (user_admin()==0) {
			$uid = $_SESSION["loginname"];
			
			if($where == '') {
				$where = " where b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			} else {
				$where = $where . " and b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			}
		}*/
		
		$sqlstr = "select distinct a.ref, a.status, a.date, a.memo, a.currency_code, a.rate, a.total_balance, a.total_debit, a.total_credit, a.uid, a.dlu from general_journal a " . $where . " order by a.ref desc ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		
/*		if ($ref == "") {
			$where = "";
			if (user_admin()==0) {
				$uid = $_SESSION["loginname"];
				
				$where = " where b.brncde in (select ifnull(brncde,'') brncde from usr_dtl2 where usrid='$uid') ";
			} 
			$sql=mysql_query("select distinct a.ref, a.status, a.date, a.memo, a.curcde, a.excrte, a.ttlblc, a.ttldbt, a.ttlcrd, a.uid, a.dlu from gnrjrn a left join usr_dtl2 b on a.uid=b.usrid " . $where . " order by a.ref desc ");			
		} else {
			$sql=mysql_query("select a.ref, a.status, a.date, a.memo, a.curcde, a.excrte, a.ttlblc, a.ttldbt, a.ttlcrd, a.uid, a.dlu from gnrjrn a left join usr_dtl2 b on a.uid=b.usrid where a.ref='$ref' order by a.ref desc ");
		}
*/				
		return $sql;
	}
	
	//---------General Journal detail in
	function list_general_journal_in_detail($ref='', $kode=''){	 
		$dbpdo = DB::create();
		
		$where = "";
		
		if($ref != "") {
			if($where == "") {
				$where = "where a.ref='$ref'";
			} else {
				$where = $where . " and a.ref='$ref'";
			}
		}
		
		if($kode != "") {
			if($where == "") {
				$where = "where a.account_code='$kode'";
			} else {
				$where = $where . " and a.account_code='$kode'";
			}
		}	
		
		if($ref=='' && $kode=='') {
			$where = "where a.ref='ndfxxx'";
		}
		
		$sqlstr = "select a.ref, b.code, a.account_code, a.memo, a.debit_amount, a.credit_amount, a.line, b.name from general_journal_detail a left join finance_type b on a.account_code=b.id " . $where . " order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data employee
	function list_employee_basic_salary($ref='', $line=''){	
		$dbpdo = DB::create();
		
		$where = "";
		
		if($ref != "") {
			if($where == "") {
				$where = "where a.employee_id='$ref'";
			} else {
				$where = $where . " and a.employee_id='$ref'";
			}
		}
		
		if($line != "") {
			if($where == "") {
				$where = "where a.line='$line'";
			} else {
				$where = $where . " and a.line='$line'";
			}
		}
		
		$sqlstr="select a.id, a.employee_id, a.efective_date, a.salary, a.position_allowance, a.uid, a.dlu, a.line, b.name employee_name from employee_basic_salary a left join employee b on a.employee_id=b.id ".$where." order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data salary
	function list_salary($ref='', $employee_id='', $from_date='', $to_date='', $all='', $division_id='', $category_id=''){	
		$dbpdo = DB::create();
		
		$where = "";
		
		if($ref != "") {
			if($where == "") {
				$where = "where a.ref='$ref'";
			} else {
				$where = $where . " and a.ref='$ref'";
			}
		}
		
		if($employee_id != "") {
			if($where == "") {
				$where = "where a.employee_id='$employee_id'";
			} else {
				$where = $where . " and a.employee_id='$employee_id'";
			}
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if($division_id != "") {
			if($where == "") {
				$where = "where b.division_id='$division_id'";
			} else {
				$where = $where . " and b.division_id='$division_id'";
			}
		}
		
		if($category_id != "") {
			if($where == "") {
				$where = "where b.category_id='$category_id'";
			} else {
				$where = $where . " and b.category_id='$category_id'";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.employee_id, a.total, a.uid, a.dlu, b.name employee_name, c.name category_name from salary a left join employee b on a.employee_id=b.id left join employee_category c on b.category_id=c.id ".$where." order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------user salary detail
	function list_salary_detail($ref) {
		$dbpdo = DB::create();
		
		$sqlstr="select aa.* from (select a.ref, a.salary_type_id, b.name salary_type_name,  a.amount, a.memo, a.line, 1 old, b.minus from salary_detail a left join salary_type b on a.salary_type_id=b.id where a.ref='$ref' union all
		select '' ref, a.id salary_type_id, a.name salary_type_name, 0 amount, '' memo, 0 line, 0 old, a.minus from salary_type a where id not in (select salary_type_id from salary_detail where ref='$ref')) aa order by aa.old desc, aa.salary_type_id, aa.salary_type_name";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------user salary type
	function list_salary_type($ref='', $act='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if($ref != "") {
			if($where == "") {
				$where = "where a.id='$ref'";
			} else {
				$where = $where . " and a.id='$ref'";
			}
		}
		
		if($act != "") {
			if($where == "") {
				$where = "where a.active='$act'";
			} else {
				$where = $where . " and a.active='$act'";
			}
		}
		
		$sqlstr="select a.id, a.name, a.active, a.minus from salary_type a ".$where." order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data employee
	function get_employee_basic_salary($employee_id='', $date=''){	
		$dbpdo = DB::create();
		
		$date = str_replace(',', ' ', $date);
		$date = date("Y-m-d", strtotime($date));
		
		$sqlstr="select a.salary, a.position_allowance from employee_basic_salary a where a.employee_id='$employee_id' and a.efective_date<='$date' order by a.line desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data payment
	function list_payment($kode ='', $from_date='', $to_date='', $vendor_code='', $all=0){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $vendor_code != "") {
			if ($where == "") {
				$where = " where a.vendor_code = '$vendor_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$vendor_code' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.vendor_code, a.payment_type, a.cheque_no, a.cheque_date, a.bank_name, a.credit_card_no, a.credit_card_code, a.credit_card_holder, a.credit_card_expired, a.account_code, a.currency_code, a.rate, a.amount, a.deposit, a.sub_total, a.type, a.memo, a.round_amount, a.round_amount_account, a.bank_charge, a.bank_charge_account, a.opening_balance, a.total, a.no_ttfa, a.uid, a.dlu, b.name vendor_name from payment a left join vendor b on a.vendor_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------payment detail (saat update)
	function list_payment_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.invoice_no, b.invoice_no no_nota, a.invoice_date, a.invoice_due_date, a.invoice_currency_code, a.invoice_rate, a.amount_due, a.discount, a.amount_paid, a.ref_type invoice_type, a.amount, a.line from payment_detail a left join purchase_invoice b on a.invoice_no=b.ref where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------payment giro
	function list_payment_giro($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.account_code, a.cheque_no, a.bank_name, a.cheque_date, a.amountbg, a.line from payment_giro a where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------minute_meet
	function list_minute_meet($ref='', $frmdate='', $todate='', $all=0){	
		$dbpdo = DB::create();
		
		$where = "";
		if ($ref != '') {
			if($where == '') { $where = " where a.ref = '$ref' "; } else { $where = $where . " and a.ref = '$ref' "; } 
		}
		
		if ($frmdate != '') {
			$frmdate = str_replace(',', ' ', $frmdate);
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date >= '$frmdate' "; } else { $where = $where . " and a.date >= '$frmdate' "; } 
		}
		
		if ($todate != '') {
			$todate = str_replace(',', ' ', $todate);
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date <= '$todate' "; } else { $where = $where . " and a.date <= '$todate' "; } 
		}
		
		if ($all == 1) {			
			$where = "";
		}
		
		$sqlstr = "select a.ref, a.date, a.member_id, a.subject, a.division_id, b.name division_name, a.uid, a.dlu from minute_meet a left join division b on a.division_id=b.id " . $where . " order by a.ref desc ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------minute_meet detail
	function list_minute_meet_detail($ref=''){	 
		$dbpdo = DB::create();
		
		$sqlstr = "select a.ref, a.sub_subject, a.problem, a.improvement, a.due_date, a.pic, a.line from minute_meet_detail a where a.ref='$ref' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	function get_payment_detail($vendor_code='') {
		$dbpdo = DB::create();
		
		$sqlstr="select aa.* from (select a.invoice_no, b.bill_number no_nota, a.date, a.due_date, a.contact_type, a.contact_code, a.contact_other, a.ref_type invoice_type, sum(ifnull(a.credit_amount,0)) - sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.discount_amount,0)) amount_paid, a.ref_type, a.currency_code, a.rate, a.exchange_type, a.exchange_date, a.top, a.description, a.uid, a.dlu from ap a left join purchase_invoice b on a.ref=b.ref group by a.contact_code, a.contact_type, a.invoice_no, a.ref_type having (sum(ifnull(a.credit_amount,0)) - sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.discount_amount,0))) <> 0) aa where aa.contact_code = '$vendor_code' order by aa.invoice_no, aa.date";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	function get_invoice_detail($clien_code='') {
		$dbpdo = DB::create();
		
		$querystring = "select aa.*, bb.installment, bb.loan from 
			(select a.invoice_no, a.date, a.due_date, a.contact_type, a.contact_code, a.contact_other, a.ref_type invoice_type, sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.credit_amount,0)) - sum(ifnull(a.discount_amount,0)) amount_paid, a.ref_type, a.currency_code, a.rate, a.exchange_type, a.exchange_date, a.top, a.description, a.uid, a.dlu from ar a group by a.contact_code, a.contact_type, a.invoice_no, a.ref_type having (sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.credit_amount,0)) - sum(ifnull(a.discount_amount,0))) <> 0 and left(a.invoice_no,3) <> 'CSR'
			union all
			select a.invoice_no, a.date, '1900-01-01' due_date, a.contact_type, a.contact_code, a.contact_other, 'DPS' invoice_type, (sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.credit_amount,0))) * -1 amount_paid, a.ref_type, a.currency_code, a.rate, a.exchange_type, a.exchange_date, a.top, a.description, a.uid, a.dlu from dps a group by a.contact_code, a.contact_type, a.invoice_no, a.invoice_type having (sum(ifnull(a.debit_amount,0)) - sum(ifnull(a.credit_amount,0))) > 0 and left(a.invoice_no,3) <> 'CSR' )  aa left join direct_receipt bb on aa.invoice_no=bb.ref where aa.contact_code = '$clien_code' order by aa.invoice_no, aa.date";
			//echo $querystring;
		$sql=$dbpdo->prepare($querystring);
		$sql->execute();
				
		//$sql=mysql_query($querystring);
		
		
		return $sql;
	}
	
	//---------get data receipt
	function list_receipt($kode ='', $from_date='', $to_date='', $client_code='', $all=0){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.client_code, a.receipt_type, a.cheque_no, a.cheque_date, a.bank_name, a.credit_card_no, a.credit_card_code, a.credit_card_holder, a.credit_card_expired, a.account_code, a.currency_code, a.rate, a.amount, a.deposit, a.sub_total, a.type, a.memo, a.round_amount, a.round_amount_account, a.bank_charge, a.bank_charge_account, a.opening_balance, a.total, a.uid, a.dlu, b.name client_name from receipt a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------receipt detail (saat update)
	function list_receipt_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.invoice_no, a.invoice_date, a.invoice_due_date, a.invoice_currency_code, a.invoice_rate, a.amount_due, a.discount, a.amount_paid, a.ref_type invoice_type, a.amount, a.line from receipt_detail a where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------weekly_assignment_work (saat update)
	function list_weekly_assignment_work($id='', $active='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$id' ";
			} else {
				$where = $where . " and a.id = '$id' ";
			}								
		}
		
		if ( $active == 1) {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.active, a.uid, a.dlu from weekly_assignment_work a ".$where." order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data cash flow
	function list_cash_flow($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		$sqlstr= "select a.location_id, b.name location_name, sum(a.total) total from sales_invoice a left join warehouse b on a.location_id=b.id " . $where . " group by a.location_id order by a.location_id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data cash flow (HPP)
	function list_cash_flow_hpp($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		$sqlstr= "select a.location_id, b.name location_name, sum(ifnull(c.amount_cost,0)) total from sales_invoice_detail c left join sales_invoice a on c.ref=a.ref left join warehouse b on a.location_id=b.id " . $where . " group by a.location_id order by a.location_id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data cash flow (purchasing)
	function list_cash_flow_purchasing($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		$sqlstr= "select a.vendor_code, sum(a.total) total, b.name vendor_name from purchase_invoice a left join vendor b on a.vendor_code=b.syscode " . $where . " group by a.vendor_code order by a.vendor_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data cash flow (payment)
	function list_cash_flow_payment($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		$sqlstr= "select a.vendor_code, sum(a.total) total, b.name vendor_name from payment a left join vendor b on a.vendor_code=b.syscode " . $where . " group by a.vendor_code order by a.vendor_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data cash flow (AP)
	function list_cash_flow_ap($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		$sqlstr= "select a.contact_code, sum(ifnull(a.credit_amount,0))-sum(ifnull(a.debit_amount,0)) total, b.name vendor_name from ap a left join vendor b on a.contact_code=b.syscode " . $where . " group by a.contact_code order by a.contact_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data cash flow (BRUTO)
	function list_cash_flow_bruto($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		/*$sqlstr= "select a.location_id, b.name location_name, sum(a.total)-sum(a.discount)-sum(c.amount_cost) total from sales_invoice a left join warehouse b on a.location_id=b.id left join sales_invoice_detail c on a.ref=c.ref " . $where . " group by a.location_id order by a.location_id";*/
		$sqlstr= "select a.location_id, b.name location_name, sum(a.total)-sum(a.discount) total from sales_invoice a left join warehouse b on a.location_id=b.id " . $where . " group by a.location_id order by a.location_id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		/*$sqlstr= "select a.location_id, b.name location_name, sum(a.total) total from sales_invoice a left join warehouse b on a.location_id=b.id " . $where . " group by a.location_id order by a.location_id";
		$sql=$dbpdo->prepare($sqlstr);*/
				
		return $sql;
	}
	
	
	//---------get data cash flow (pengeluaran)
	function list_cash_flow_cashout($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(b.credit_amount,0) > 0"; // where b.account_code not in (7,14) 
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		$sqlstr= "select b.account_code, sum(ifnull(b.credit_amount,0)) total, c.name finance_name from general_journal a left join general_journal_detail b on a.ref=b.ref left join finance_type c on b.account_code=c.id " . $where . " group by b.account_code order by b.account_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data cash flow (pemasukan)
	function list_cash_flow_cashin($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(b.debit_amount,0) > 0 "; // where b.account_code not in (7,14) 
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		$sqlstr= "select b.account_code, sum(ifnull(b.debit_amount,0)) total, c.name finance_name from general_journal a left join general_journal_detail b on a.ref=b.ref left join finance_type c on b.account_code=c.id " . $where . " group by b.account_code order by b.account_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data cash flow (pengeluaran overhead)
	function list_cash_flow_cashout_overhead($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = " where b.account_code in (7,14) ";
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		$sqlstr= "select b.account_code, sum(ifnull(b.credit_amount,0)) total, b.line, b.memo finance_name from general_journal a left join general_journal_detail b on a.ref=b.ref left join finance_type c on b.account_code=c.id " . $where . " group by b.account_code, b.line order by b.account_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data cash flow (ar)
	function list_cash_flow_ar($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(b.name,'') <> '' ";
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		$sqlstr= "select a.contact_code, sum(ifnull(a.debit_amount,0))-sum(ifnull(a.credit_amount,0)) total, b.name client_name from ar a left join client b on a.contact_code=b.syscode " . $where . " group by a.contact_code order by a.contact_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data cash flow (fixed cost)
	function list_cash_flow_fixed_cost($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m') <='$to_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m') <= '$to_date' ";
			}								
		}
		
		$sqlstr= "select a.date, sum(a.total) total, 'GAJI' memo from salary a " . $where . " group by date_format(a.dlu, '%Y-%m')";
		$sqlstr = $sqlstr . "union all select '' date, 0 total, 'SEWA KANTOR' memo ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------regular_item (saat update)
	function list_regular_item($id='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.id = '$id' ";
			} else {
				$where = $where . " and a.id = '$id' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.active, a.uid, a.dlu from regular_item a ".$where." order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get new product
	function get_weekly_assignment_sch($weekly_assignment_work_id='', $day='', $month='', $year='') {
		$dbpdo = DB::create();
		
		$date = $year.'-'.$month.'-'.$day;
		$date = date("Y-m-d", strtotime($date));
		
		if($weekly_assignment_work_id == 1) {
			$where = " where a.syscode='11' ";
		}
		if($weekly_assignment_work_id == 2) {
			$where = " where a.syscode='11' ";
		}
		if($weekly_assignment_work_id == 3) {
			$where = " where date_format(a.dlu,'%Y-%m-%d')='$date' ";
		}
		if($weekly_assignment_work_id == 4) {
			$where = " where a.syscode='11' ";
		}
		if($weekly_assignment_work_id == 5) {
			$where = " where a.catalog_date='$date' ";
		}
		if($weekly_assignment_work_id == 6) {
			$where = " where a.syscode='11' ";
		}
		if($weekly_assignment_work_id == 7) {
			$where = " where a.publish_date='$date' ";
		}
		
		$sqlstr="select a.name from item a ".$where." order by a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------schedule_promo (saat update)
	function list_schedule_promo($id='', $promo_id='', $date='', $line='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.id = '$id' ";
			} else {
				$where = $where . " and a.id = '$id' ";
			}								
		}
		
		if ( $promo_id != "") {
			if ($where == "") {
				$where = " where a.promo_id = '$promo_id' ";
			} else {
				$where = $where . " and a.promo_id = '$promo_id' ";
			}								
		}
		
		if ( $date != "") {
			$date = str_replace(',', ' ', $date);
			$date = date("Y-m-d", strtotime($date));
			if ($where == "") {
				$where = " where a.date = '$date' ";
			} else {
				$where = $where . " and a.date = '$date' ";
			}								
		}
		
		if ( $line != "") {
			if ($where == "") {
				$where = " where a.line = '$line' ";
			} else {
				$where = $where . " and a.line = '$line' ";
			}								
		}
		
		$sqlstr="select a.id, a.date, a.promo_id, a.item_code, a.note, a.hastag, a.uid, a.dlu, a.line, b.name item_name, c.name promo_name from schedule_promo a left join item b on a.item_code=b.syscode left join promo c on a.promo_id=c.id ".$where." order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------schedule_regular_item (saat update)
	function list_schedule_regular_item($id='', $regular_item_id='', $date='', $line='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.id = '$id' ";
			} else {
				$where = $where . " and a.id = '$id' ";
			}								
		}
		
		if ( $regular_item_id != "") {
			if ($where == "") {
				$where = " where a.regular_item_id = '$regular_item_id' ";
			} else {
				$where = $where . " and a.regular_item_id = '$regular_item_id' ";
			}								
		}
		
		if ( $date != "") {
			$date = str_replace(',', ' ', $date);
			$date = date("Y-m-d", strtotime($date));
			if ($where == "") {
				$where = " where a.date = '$date' ";
			} else {
				$where = $where . " and a.date = '$date' ";
			}								
		}
		
		if ( $line != "") {
			if ($where == "") {
				$where = " where a.line = '$line' ";
			} else {
				$where = $where . " and a.line = '$line' ";
			}								
		}
		
		$sqlstr="select a.id, a.date, a.regular_item_id, a.item_code, a.note, a.hastag, a.uid, a.dlu, a.line, b.name item_name, c.name regular_name from schedule_regular_item a left join item b on a.item_code=b.syscode left join regular_item c on a.regular_item_id=c.id ".$where." order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data acc
	function get_sales_invoice_list($kode ='', $all=0, $from_date='', $to_date='', $shift='', $cashier='', $employee_id='', $location_id=''){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(a.opening_balance,0) = 0 and (a.ref like '%POS%' or a.ref like '%SLS%' or a.ref like '%DOA%' ) and a.ref in (select ref from sales_invoice_detail group by ref having sum(ifnull(qty,0)) - sum(ifnull(qty_shp,0)) > 0) and ifnull(a.cash,0)=0 "; //and ifnull(a.onshipped,0)=1 
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $shift != "") {
			if ($where == "") {
				$where = " where a.shift = '$shift' ";
			} else {
				$where = $where . " and a.shift = '$shift' ";
			}								
		}
		
		if ( $cashier != "") {
			if ($where == "") {
				$where = " where a.uid = '$cashier' ";
			} else {
				$where = $where . " and a.uid = '$cashier' ";
			}								
		}
		
		if ( $employee_id != "") {
			if ($where == "") {
				$where = " where a.employee_id = '$employee_id' ";
			} else {
				$where = $where . " and a.employee_id = '$employee_id' ";
			}								
		}
		
		if ( $location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}								
		}
		
		if($all == 1) {
			$where = " where ifnull(a.opening_balance,0) = 0 and (a.ref like '%POS%' or a.ref like '%SLS%' or a.ref like '%DOA%' ) and a.ref in (select ref from sales_invoice_detail group by ref having sum(ifnull(qty,0)) - sum(ifnull(qty_shp,0)) > 0) and ifnull(a.cash,0)=0 "; // and ifnull(a.onshipped,0)=1
		}
		
		$sqlstr= "select a.ref, a.ref2, a.date, a.status, a.top, a.due_date, a.client_code, b.name client_name, b.address, a.ship_to, a.bill_to, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.currency_code, a.rate, a.employee_id, a.discount, a.total, a.memo, a.opening_balance, a.cash, a.location_id, a.deposit, a.taxable, a.photo_file, a.cash_amount, a.cash_voucher, a.bank_id, a.bank_amount, a.credit_card_code, a.card_amount, a.credit_card_no, a.credit_card_holder, a.change_amount, a.shift, a.client_member_code, a.uid, a.dlu, c.code client_member_code2, c.name member_name, 0 point, a.printed, a.commision_rate, e.name employee_name from sales_invoice a left join client b on a.client_code=b.syscode left join client c on a.client_member_code=c.syscode left join employee e on a.employee_id=e.id " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------data set journal
	function list_set_journal($ref='', $trans_name='', $all=''){	
		$dbpdo = DB::create();
		
		$where = "";
		
		if($ref != "") {
			if($where == "") {
				$where = "where a.id='$ref'";
			} else {
				$where = $where . " and a.id='$ref'";
			}
		}
		
		if($trans_name != "") {
			if($where == "") {
				$where = "where a.trans_name='$trans_name'";
			} else {
				$where = $where . " and a.trans_name='$trans_name'";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.id, a.location_id, a.account_code_debit, a.account_code_credit, a.trans_name, a.column_name, a.uid, a.dlu, b.name location_name, c.acc_code acc_code_debit, c.name account_name_debit, d.acc_code acc_code_credit, d.name account_name_credit from set_journal a left join warehouse b on a.location_id=b.id left join coa c on a.account_code_debit=c.syscode left join coa d on a.account_code_credit=d.syscode " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data brand
	function list_brand($kode ='', $all=0, $act=''){	
		$dbpdo = DB::create();
		 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.code, a.name, a.active, a.uid, a.dlu from brand a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	function get_sales_order_detail($id='', $item_group_id='') {
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.qty,0) - ifnull(a.qty_sales,0) > 0";
		
		if ( $id != "") {
			if ($where == "") {
				$where = " where a.ref = '$id' ";
			} else {
				$where = $where . " and a.ref = '$id' ";
			}								
		}
		
		if ( $item_group_id != "") {
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		$sqlstr="select a.ref, a.item_code, a.uom_code, ifnull(a.qty,0) - ifnull(a.qty_sales,0) qty, a.qty_shp, a.discount, a.unit_price, a.amount, a.line, b.code, b.name item_name, a.item_status, c.name item_status_name from sales_order_detail a left join item b on a.item_code=b.syscode left join discount c on a.discount_id=c.id ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get pi detail (saat update)
	function get_pi_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref pi_ref, a.item_code, c.code, c.name item_name, a.uom_code, ifnull(a.qty,0)-ifnull(a.qty_rtn,0) qty, a.unit_cost, 0 discount, a.amount, a.line line_pi from purchase_invoice_detail a left join purchase_invoice b on a.ref=b.ref left join item c on a.item_code=c.syscode where a.ref='$id' and ifnull(a.qty,0)-ifnull(a.qty_rtn,0) > 0 order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data purchase return
	function list_purchase_return($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.vendor_code, a.pi_ref, b.name vendor_name, a.tax_code, a.tax_rate, a.currency_code, a.rate, a.total, a.memo, a.uid, a.dlu from purchase_return a left join vendor b on a.vendor_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	//-----------sales purchase detail (saat update)
	function list_purchase_return_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.discount, a.unit_cost, a.amount, a.line_item_pi, a.line from purchase_return_detail a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data sales return
	function list_sales_return($kode ='', $from_date='', $to_date='', $all=0, $si_ref=''){	 	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}

		if ( $from_date != "") {
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}

		if($si_ref != "") {
			if ($where == "") {
				$where = " where a.si_ref ='$si_ref' ";
			} else {
				$where = $where . " and a.si_ref = '$si_ref' ";
			}
		}

		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.client_code, a.si_ref, b.name client_name, a.tax_code, a.tax_rate, a.currency_code, a.rate, a.total, a.reason, a.memo, a.uid, a.dlu from sales_return a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------sales return detail (saat update)
	function list_sales_return_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.discount, a.unit_price, a.charge_p, a.amount, a.line_item_si, a.line from sales_return_detail a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get si detail (saat update)
	function get_si_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref si_ref, a.item_code, c.code, c.name item_name, a.uom_code, ifnull(a.qty,0)-ifnull(a.qty_rtn,0) qty, a.unit_price, 0 discount, a.amount, a.line line_si from sales_invoice_detail a left join sales_invoice b on a.ref=b.ref left join item c on a.item_code=c.syscode where a.ref='$id' and ifnull(a.qty,0)-ifnull(a.qty_rtn,0) > 0 order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//-----------channel
	function list_channel($kode ='', $all=0, $act='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.active, a.uid, a.dlu  from channel a " . $where . " order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//-----------size
	function list_size($kode ='', $all=0, $act='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.code, a.name, a.active, a.uid, a.dlu  from size a " . $where . " order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//-----------payment_mothod
	function list_payment_method($kode ='', $all=0, $act='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.active from payment_method a " . $where . " order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}

	
	//-----------purchase Type
	function list_purchase_type($kode ='', $all=0, $act='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.id = '$kode' ";
			} else {
				$where = $where . " and a.id = '$kode' ";
			}								
		}
		
		$sqlstr="select a.id, a.name, a.active from purchase_type a " . $where . " order by a.id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//-----------
	function dashboard_sales_top10($from_date ='', $to_date='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $from_date != "") {		
			$from_date = str_replace(',', ' ', $from_date);	
			$from_date = date("Y-m-d", strtotime($from_date));			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {			
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		$sqlstr = "select c.code, c.name, sum(b.qty) qty from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref left join item c on b.item_code=c.syscode ".$where." group by b.item_code order by sum(b.qty) desc limit 10";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//-----------
	function dashboard_sales_ecommerce($from_date ='', $to_date='', $channel_id='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $from_date != "") {			
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {			
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}

		if($channel_id != "") {
			if ($where == "") {
				$where = " where a.channel_id ='$channel_id' ";
			} else {
				$where = $where . " and a.channel_id = '$channel_id' ";
			}	
		}
		
		$sqlstr = "select sum(b.qty) qty, sum(a.total) total from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref left join item c on b.item_code=c.syscode ".$where." group by a.channel_id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}

	//-----------
	function dashboard_sales_return($from_date ='', $to_date='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $from_date != "") {			
			$from_date = str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {			
			$to_date = str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));			
			if ($where == "") {
				$where = " where a.date <='$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}

		
		$sqlstr = "select a.date, a.si_ref, c.code, c.name, sum(b.qty) qty, sum(b.amount) amount from sales_return a left join sales_return_detail b on a.ref=b.ref left join item c on b.item_code=c.syscode ".$where." group by a.si_ref, b.item_code order by a.date desc ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//---------dashboard_bincard_stok_opname
	function dashboard_bincard_stok_opname($item_code = '', $date_from='', $date_to=''){
		$dbpdo = DB::create();
			 	
		$where = ""; //where ifnull(b.name,'') <> '' and a.invoice_type='stockopname' ";
		
		if ( $date_from != "") {
			$date_from = str_replace(',', ' ', $date_from);
			$date_from = date("Y-m-d", strtotime($date_from));
			
			if ($where == "") {
				$where = " where a.date >= '$date_from' ";
			} else {
				$where = $where . " and a.date >= '$date_from' ";
			}								
		}
		
		if ( $date_to != "") {
			$to_date = str_replace(',', ' ', $to_date);
			$date_to = date("Y-m-d", strtotime($date_to));
			
			if ($where == "") {
				$where = " where a.date <= '$date_to' ";
			} else {
				$where = $where . " and a.date <= '$date_to' ";
			}								
		}

		//-------cek stokopname
		$sqlstr="select date from bincard where item_code='$item_code' and date>='$date_from' and date<='$date_to' and invoice_type='stockopname' order by date desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$rows=$sql->rowCount();
		if($rows > 0) {
			$data=$sql->fetch(PDO::FETCH_OBJ);
			$date_from = $data->date;
			$where = " where a.date >= '$date_from' and a.date <= '$date_to' ";
		}
		
		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		}
		
		$sqlstr="select sum(a.debit_qty) - sum(a.credit_qty) qty from bincard a left join item b on a.item_code=b.syscode left join warehouse c on a.location_code=c.id " . $where . " group by b.name, a.date, a.item_code, b.code, b.old_code, a.uom_code, a.invoice_type, a.location_code order by a.date, a.dlu asc";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}


	//---------dashboard_bincard_good_receipt
	function dashboard_bincard_good_receipt($item_code = '', $date_from='', $date_to=''){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(b.status,'Good') = 'Reject' ";
		
		if ( $date_from != "") {
			$date_from = str_replace(',', ' ', $date_from);
			$date_from = date("Y-m-d", strtotime($date_from));
			
			if ($where == "") {
				$where = " where a.date >= '$date_from' ";
			} else {
				$where = $where . " and a.date >= '$date_from' ";
			}								
		}
		
		if ( $date_to != "") {
			$date_to = str_replace(',', ' ', $date_to);
			$date_to = date("Y-m-d", strtotime($date_to));
			
			if ($where == "") {
				$where = " where a.date <= '$date_to' ";
			} else {
				$where = $where . " and a.date <= '$date_to' ";
			}								
		}

		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where b.item_code = '$item_code' ";
			} else {
				$where = $where . " and b.item_code = '$item_code' ";
			}								
		}

		$sqlstr="select sum(b.qty) qty from good_receipt a left join good_receipt_detail b on a.ref=b.ref ".$where." group by b.item_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}


	//---------get measuring_size_sewing
	function list_measuring_size_sewing($ref='', $from_date='', $to_date='', $client_code='', $so_ref=''){
		$dbpdo = DB::create();
			 	
		$where = "";

		$limit__ = " order by a.date ";
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}	
		}

		if ( $from_date != "") {
			$from_date 	= 	str_replace(',', ' ', $from_date);
			$from_date	=	date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			$to_date 	= 	str_replace(',', ' ', $to_date);
			$to_date	=	date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}


		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}	
		}

		if ( $so_ref != "") {
			if ($where == "") {
				$where = " where a.so_ref = '$so_ref' ";
			} else {
				$where = $where . " and a.so_ref = '$so_ref' ";
			}	

			$limit__ = " order by a.dlu desc limit 1";
		}
				
		$sqlstr="select a.ref, a.date, a.so_ref, a.client_code, a.series, a.qty, a.unit_cost, a.print_ref, a.press_ref, a.counting_ref, a.mcn_press_speed, a.mcn_press_temperature, a.sampling, a.br, a.memo, a.photo, a.photo1, a.photo2, a.photo3, a.photo4, a.photo5, a.photo6, a.photo7, a.acc_date_client, a.label, a.plat, a.button, a.pocket, a.resleting, a.uid, a.dlu, b.name client_name from measuring_size_sewing a left join client b on a.client_code=b.syscode " . $where . $limit__;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}



	function list_measuring_size_sewing_detail ($ref) {
		$dbpdo = DB::create();
		
		$sqlstr = "select a.ref, a.name, a.size, a.uom_code, a.line from measuring_size_sewing_detail a where a.ref='$ref' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//---------get data do_good_receipt_qc
	function list_do_good_receipt_qc($ref ='', $from_date='', $to_date='', $vendor_code='', $so_ref='', $all=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}								
		}
		
		if ( $from_date != "") {
			$from_date 	= 	str_replace(',', ' ', $from_date);
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where a.date >= '$from_date' ";
			} else {
				$where = $where . " and a.date >= '$from_date' ";
			}								
		}
		
		
		if ( $to_date != "") {
			$to_date 	= 	str_replace(',', ' ', $to_date);
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where a.date <= '$to_date' ";
			} else {
				$where = $where . " and a.date <= '$to_date' ";
			}								
		}
		
		if ( $vendor_code != "") {
			if ($where == "") {
				$where = " where a.vendor_code = '$vendor_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$vendor_code' ";
			}								
		}
		
		if ( $so_ref != "") {
			if ($where == "") {
				$where = " where a.ref in (select ref from do_good_receipt_qc_detail where so_ref='$so_ref') ";
			} else {
				$where = $where . " and a.ref in (select ref from do_good_receipt_qc_detail where so_ref='$so_ref') ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.vendor_code, a.status, a.memo, a.ms_ref, a.ms_ref1, a.ms_ref2, a.label, a.plat, a.button, a.pocket, a.resleting, a.label1, a.plat1, a.button1, a.pocket1, a.resleting1, a.label2, a.plat2, a.button2, a.pocket2, a.resleting2, a.label_ms, a.plat_ms, a.button_ms, a.pocket_ms, a.resleting_ms, a.label_ms1, a.plat_ms1, a.button_ms1, a.pocket_ms1, a.resleting_ms1, a.label_ms2, a.plat_ms2, a.button_ms2, a.pocket_ms2, a.resleting_ms2, a.file_qc, a.uid, a.dlu, b.name vendor_name, '' so_ref, (select x.rcp_ref from do_good_receipt_qc_detail x where x.ref=a.ref limit 1) rcp_ref from do_good_receipt_qc a left join vendor b on a.vendor_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		//
		
		return $sql;
	}


	//-----------do_good_receipt_qc detail
	function list_do_good_receipt_qc_detail($ref='', $rcp_ref='') {
		$dbpdo = DB::create();

		$where = "";
		
		if ( $ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}								
		}

		if ( $rcp_ref != "") {
			if ($where == "") {
				$where = " where a.rcp_ref = '$rcp_ref' ";
			} else {
				$where = $where . " and a.rcp_ref = '$rcp_ref' ";
			}								
		}
		
		$sqlstr="select a.ref, a.so_ref, a.do_ref, a.rcp_ref, a.item_code, a.uom_code, a.size, a.unit_cost, a.amount_cost, a.do_line, a.qty_rcp, a.qty, a.qty_damaged, a.line, b.name item_name from do_good_receipt_qc_detail a left join item b on a.item_code=b.syscode ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//-----------get good receipt detail (saat update)
	function get_good_receipt_detail($id) {
		$dbpdo = DB::create();
		
		//$sqlstr="select a.ref, a.so_ref, a.do_ref, a.item_code, a.uom_code, a.qty-ifnull(a.qty_qc1,0) qty, a.qty_damaged, a.unit_cost, a.amount_cost, a.do_line, a.line, b.name item_name, a.size from do_good_receipt_detail a left join item b on a.item_code=b.syscode where a.ref='$id' and a.qty-ifnull(a.qty_qc1,0)>0 order by a.line ";
		
		$where = " where a.ref='$id' and a.qty-ifnull(a.qty_qc,0)>0 ";

		$sqlstr="select a.ref, a.item_code, a.uom_code, a.size, a.po_ref, a.qty, a.unit_cost, a.pi_line, a.status, a.line, b.code, b.name item_name from good_receipt_detail a left join item b on a.item_code=b.syscode ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}

	
}
?>