<?php

class selectview{	
	
	//---------General Journal
	function rpt_general_journal($ref='', $frmdate='', $todate='', $status='', $memo='', $all=0){	
		$dbpdo = DB::create();
		
		$where = "";
		if ($ref != '') {
			if($where == '') { $where = " where a.ref = '$ref' "; } else { $where = $where . " and a.ref = '$ref' "; } 
		}
		
		if ($frmdate != '') {
			$frmdate = date('Y-m-d', strtotime($frmdate));
			if($where == '') { $where = " where a.date >= '$frmdate' "; } else { $where = $where . " and a.date >= '$frmdate' "; } 
		}
		
		if ($todate != '') {
			$todate = date('Y-m-d', strtotime($todate));
			if($where == '') { $where = " where a.date <= '$todate' "; } else { $where = $where . " and a.date <= '$todate' "; } 
		}
		
		if ($status != '') {
			if($where == '') { $where = " where a.status = '$status' "; } else { $where = $where . " and a.status = '$status' "; } 
		}
		if ($memo != '') {
			if($where == '') { $where = " where a.memo like '%$memo%' "; } else { $where = $where . " and a.memo like '%$memo%' "; } 
		}
		if ($all == 1) {			
			$where = "";
		}
		
		$sqlstr = "select a.ref, a.status, a.date, b.memo, a.currency_code, a.rate, a.total_balance, b.debit_amount total_debit, b.credit_amount total_credit, a.uid, a.dlu from general_journal a left join general_journal_detail b on a.ref=b.ref " . $where . " order by a.ref desc ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//-----------client
	function list_client($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if($_SESSION["adm"] == 1) {
			if ( $client_code != "") {
				if ($where == "") {
					$where = " where a.syscode = '$client_code' ";
				} else {
					$where = $where . " and a.syscode = '$client_code' ";
				}								
			}
			
			if ( $client_syscode != "") {
				if ($where == "") {
					$where = " where a.client_syscode = '$client_syscode' ";
				} else {
					$where = $where . " and a.client_syscode = '$client_syscode' ";
				}								
			}
			
			if ( $active != "") {
				if ($where == "") {
					$where = " where a.active = '$active' ";
				} else {
					$where = $where . " and a.active = '$active' ";
				}								
			}
			
			if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
				$where = " where a.code='NDFxx'";
			}
			
			if($all == 1) {
				$where = "";
			}
			
		} else {
			
			if ( $client_syscode != "" || $client_code != "") {
				if ($where == "") {
					$where = " where a.client_syscode = '$client_syscode' or a.syscode = '$client_code' ";
				} else {
					$where = $where . " and a.client_syscode = '$client_syscode' or a.syscode = '$client_code' ";
				}								
			}
			
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------client
	function list_client_basic($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = " where (a.client_type=5 or a.old_client_type=6)";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.syscode = '$client_code' ";
			} else {
				$where = $where . " and a.syscode = '$client_code' ";
			}								
		}
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		
		if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
			$where = " where a.code='NDFxx'";
		}
		
		if($all == 1) {
			$where = " where (a.client_type=5 or a.old_client_type=6) ";
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------client
	function list_client_platinum($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = ""; //where a.client_type=6 
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.syscode = '$client_code' ";
			} else {
				$where = $where . " and a.syscode = '$client_code' ";
			}								
		}
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		
		if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
			$where = " where a.code='NDFxx'";
		}
		
		if($all == 1) {
			$where = " where a.client_type=6 ";
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------count sub client
	function list_client_detail($client_code='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		if($client_code == "") {
			$where = "where a.client_code='NDF'";
		}
		
		
		$sqlstr="select a.client_code, a.client_syscode, count(a.client_code) qualified from client_detail a " . $where . " group by a.client_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get client detail
	function get_client_detail($client_code='') {
		$dbpdo = DB::create();
		
		$where = " where a.client_syscode in (select client_code from client_detail)";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		if($client_code == "") {
			$where = "where a.client_code='NDF'";
		}
		
		
		$sqlstr="select a.client_syscode from client_detail a " . $where . " order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------count sub client
	function list_client_detail_sub($client_code='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		if($client_code == "") {
			$where = "where a.client_code='NDF'";
		}
		
		
		$sqlstr="select a.client_code, a.client_syscode, count(a.client_code) qualified from client_detail a " . $where . " group by a.client_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get last data client_set_level
	function get_last_client_set_level(){
		$dbpdo = DB::create();
			 	
		$sqlstr="select a.id, a.qualified, a.group_completed, a.platinum, a.uid, a.dlu from client_set_level a order by a.id desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------client commision
	function list_client_commision($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = " where (a.client_type=5 or a.old_client_type=6) ";
		
		if($_SESSION["adm"] == 1) {
			if ( $client_code != "") {
				if ($where == "") {
					$where = " where a.syscode = '$client_code' ";
				} else {
					$where = $where . " and a.syscode = '$client_code' ";
				}								
			}
			
			if ( $client_syscode != "") {
				if ($where == "") {
					$where = " where a.client_syscode = '$client_syscode' ";
				} else {
					$where = $where . " and a.client_syscode = '$client_syscode' ";
				}								
			}
			
			if ( $active != "") {
				if ($where == "") {
					$where = " where a.active = '$active' ";
				} else {
					$where = $where . " and a.active = '$active' ";
				}								
			}
			
			
			if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
				$where = " where (a.client_type=5 or a.old_client_type=6) ";
			}
			
			if($all == 1) {
				$where = " where (a.client_type=5 or a.old_client_type=6) ";
			}
		
		} else {
			
			if ( $client_syscode != "" || $client_code != "") {
				if ($where == "") {
					$where = " where a.client_syscode = '$client_syscode' or a.syscode = '$client_code' ";
				} else {
					$where = $where . " and a.client_syscode = '$client_syscode' or a.syscode = '$client_code' ";
				}								
			}
			
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------count sub client commision
	function list_client_commision_detail($client_code='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		if($client_code == "") {
			$where = "where a.client_code='NDF'";
		}
		
		
		$sqlstr="select a.client_code, a.client_syscode, count(a.client_code) qualified from client_detail a " . $where . " group by a.client_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get client commision detail
	function get_client_commision_detail($client_code='') {
		$dbpdo = DB::create();
		
		$where = " where a.client_syscode in (select client_code from client_detail)";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		if($client_code == "") {
			$where = "where a.client_code='NDF'";
		}
		
		
		$sqlstr="select a.client_syscode from client_detail a " . $where . " order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------count sub client commision
	function list_client_commision_detail_sub($client_code='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		if($client_code == "") {
			$where = "where a.client_code='NDF'";
		}
		
		
		$sqlstr="select a.client_code, a.client_syscode, count(a.client_code) qualified from client_detail a " . $where . " group by a.client_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get level
	function get_level() {
		$dbpdo = DB::create();
		
		$sqlstr="select a.id, a.level, a.indicator_member, a.indicator, a.registration, a.starter_kit, ifnull(a.prestasi,0) prestasi, a.unilevel, ifnull(a.sponsor,0) sponsor, a.bonus, ifnull(a.bonus_ro,0) bonus_ro from `level` a order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get level bonus
	function get_level_bonus($indicator_member) {
		$dbpdo = DB::create();
				
		$sqlstr="select a.id, a.level, a.indicator_member, a.indicator, a.registration, a.starter_kit, ifnull(a.prestasi,0) prestasi, a.unilevel, ifnull(a.sponsor,0) sponsor, a.bonus, ifnull(a.bonus_ro,0) bonus_ro from `level` a where a.indicator_member<= '$indicator_member' order by a.indicator_member desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get level bonus-1
	function get_level_bonus1($level) {
		$dbpdo = DB::create();
				
		$sqlstr="select a.id, a.level, a.indicator_member, a.indicator, a.registration, a.starter_kit, ifnull(a.prestasi,0) prestasi, a.unilevel, ifnull(a.sponsor,0) sponsor, a.bonus, ifnull(a.bonus_ro,0) bonus_ro from `level` a where a.level= '$level' order by a.indicator_member limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------get level sponsor
	function get_level_sponsor() {
		$dbpdo = DB::create();
		
		$sqlstr="select ifnull(a.sponsor,0) sponsor from level a where ifnull(a.sponsor,0)<>0 order by ifnull(a.sponsor,0) desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data item
	function get_item(){
		$dbpdo = DB::create();
		
		$sqlstr="select a.syscode item_code, a.code, a.old_code, a.name, a.item_group_id, b.name item_group_name, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.balance, a.active, (select aa.current_price from set_item_price aa where aa.item_code=a.syscode order by efective_from desc limit 1) hpp_gudang, (select aa.ro_point from set_item_cost aa where aa.item_code=a.syscode order by efective_from desc limit 1) ro_point from item a left join item_group b on a.item_group_id=b.id where a.active=1 order by a.code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------get_level_item_royalty
	function get_level_item_royalty($item_code, $uom_code) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.level, a.royalty from set_item_level a where item_code='$item_code' and uom_code='$uom_code' order by level";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------member
	function list_member($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.syscode = '$client_code' ";
			} else {
				$where = $where . " and a.syscode = '$client_code' ";
			}								
		}
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		
		if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
			$where = " where a.code='NDFxx'";
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------member registration
	function list_member_registration($month='', $year='', $client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $month != "" && $year != '') {
			
			if(strlen($month) == 1) {
				$month = "0".$month;
			}
			
			$monthyear = $year . "-" . $month;
			$periode = date("Y-m", strtotime($monthyear));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m')='$monthyear' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m')='$monthyear' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.syscode = '$client_code' ";
			} else {
				$where = $where . " and a.syscode = '$client_code' ";
			}								
		}
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		
		if($month =='' && $year=='' && $client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
			$where = " where a.code='NDFxx'";
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.dlu desc, a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	
	//---------get data item
	function rpt_budget_product($kode ='', $all=0, $active='', $code='', $old_code='', $name='', $item_group_id='', $from_date='', $to_date=''){
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
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.old_code, a.name, a.item_group_id, b.name item_group_name, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.balance, a.active, a.uid, a.dlu, a.syscode, (select aa.total_budget from set_item_cost aa where aa.item_code=a.syscode order by efective_from desc limit 1) total_budget from item a left join item_group b on a.item_group_id=b.id " . $where . " order by a.code";
		//echo $sqlstr;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get budget bonus
	function rpt_budget_bonus($kode ='', $all=0, $active='', $code='', $old_code='', $name='', $item_group_id='', $from_date='', $to_date=''){
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
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.old_code, a.name, a.item_group_id, b.name item_group_name, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.balance, a.active, a.uid, a.dlu, a.syscode from item a left join item_group b on a.item_group_id=b.id " . $where . " order by a.code";
		//echo $sqlstr;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	function get_set_item_cost($item_code) {
		$dbpdo = DB::create();
		
		$sqlstr = "select a.item_code, a.current_cost stokis, a.bonus_basic, a.bonus_prestation, a.bonus_unilevel, a.matching_sponsor, a.reward, a.repeat_order, a.royalti, a.total_budget from set_item_cost a where a.item_code='$item_code' order by a.efective_from desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------member
	function rpt_member_top10() {
		$dbpdo = DB::create();
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode order by a.dlu, a.code, a.name limit 10 ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------client commision agen platinum
	function list_client_commision_ap($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.syscode = '$client_code' ";
			} else {
				$where = $where . " and a.syscode = '$client_code' ";
			}								
		}
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		
		/*if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
			$where = " where a.code='NDFxx'";
		}*/
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------rpt sponsoring
	function list_sponsoring($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.syscode = '$client_code' ";
			} else {
				$where = $where . " and a.syscode = '$client_code' ";
			}								
		}
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		
		if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
			$where = " where a.code='NDFxx'";
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------client commision RO
	function list_client_commision_ro($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.syscode = '$client_code' ";
			} else {
				$where = $where . " and a.syscode = '$client_code' ";
			}								
		}
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		
		if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
			$where = " where a.code='NDFxx'";
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get jaringan member
	function list_client_jaringan($client_code='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		$sqlstr="select a.client_code, a.client_syscode, b.name from client_detail a left join client b on a.client_code=b.syscode " . $where . " order by a.line, b.code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------get jaringan member basic
	function list_client_jaringan_basic($client_code='') {
		$dbpdo = DB::create();
		
		$where = " where (b.client_type=5 or b.old_client_type=6) ";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		$sqlstr="select a.client_code, a.client_syscode, b.name from client_detail a left join client b on a.client_code=b.syscode " . $where . " order by a.line, b.code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get jaringan member platinum
	function list_client_jaringan_platinum($client_code='') {
		$dbpdo = DB::create();
		
		$where = ""; // where b.client_type=6 
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		$sqlstr="select a.client_code, a.client_syscode, b.name from client_detail a left join client b on a.client_code=b.syscode " . $where . " order by a.line, b.code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get jaringan member platinum
	function list_client_jaringan_platinum_ap($client_code='') {
		$dbpdo = DB::create();
		
		$where = " where c.client_type=6 ";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		$sqlstr="select a.client_code, a.client_syscode, b.name from client_detail a left join client b on a.client_code=b.syscode left join client c on a.client_syscode=c.syscode " . $where . " order by a.line, b.code";
		
		/*$sqlstr="select a.client_code, a.client_syscode, b.name from client_detail a left join client b on a.client_code=b.syscode " . $where . " order by a.line, b.code";*/
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------member upline
	function list_client_upline($client_syscode='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		$sqlstr="select b.code, b.name from client_detail a left join client b on a.client_code=b.syscode " . $where . " order by b.code, b.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------member upline
	function list_client_upline_basic($client_syscode='') {
		$dbpdo = DB::create();
		
		$where = " where b.client_type=5 ";
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		$sqlstr="select b.code, b.name from client_detail a left join client b on a.client_code=b.syscode " . $where . " order by b.code, b.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------member upline platinum
	function list_client_upline_platinum($client_syscode='') {
		$dbpdo = DB::create();
		
		$where = " where b.client_type=6 ";
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		$sqlstr="select b.code, b.name from client_detail a left join client b on a.client_code=b.syscode " . $where . " order by b.code, b.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------client commision ap
	function list_client_commision_platinum($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = " where a.client_type=6 ";
		
		if($_SESSION["adm"] == 1) {
			if ( $client_code != "") {
				if ($where == "") {
					$where = " where a.syscode = '$client_code' ";
				} else {
					$where = $where . " and a.syscode = '$client_code' ";
				}								
			}
			
			if ( $client_syscode != "") {
				if ($where == "") {
					$where = " where a.client_syscode = '$client_syscode' ";
				} else {
					$where = $where . " and a.client_syscode = '$client_syscode' ";
				}								
			}
			
			if ( $active != "") {
				if ($where == "") {
					$where = " where a.active = '$active' ";
				} else {
					$where = $where . " and a.active = '$active' ";
				}								
			}
			
			
			if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
				$where = " where a.client_type=6 ";
			}
			
			if($all == 1) {
				$where = " where a.client_type=6 ";
			}
		
		} else {
			
			if ( $client_syscode != "" || $client_code != "") {
				if ($where == "") {
					$where = " where a.client_syscode = '$client_syscode' or a.syscode = '$client_code' ";
				} else {
					$where = $where . " and a.client_syscode = '$client_syscode' or a.syscode = '$client_code' ";
				}								
			}
			
		}
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------count sub client commision AP
	function list_client_commision_platinum_detail($client_code='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		if($client_code == "") {
			$where = "where a.client_code='NDF'";
		}
		
		
		$sqlstr="select a.client_code, a.client_syscode, count(a.client_code) qualified from client_detail a " . $where . " group by a.client_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------client commision ro
	function list_client_commision_ro2($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if($_SESSION["adm"] == 1) {
			if ( $client_code != "") {
				if ($where == "") {
					$where = " where a.syscode = '$client_code' ";
				} else {
					$where = $where . " and a.syscode = '$client_code' ";
				}								
			}
			
			if ( $client_syscode != "") {
				if ($where == "") {
					$where = " where a.client_syscode = '$client_syscode' ";
				} else {
					$where = $where . " and a.client_syscode = '$client_syscode' ";
				}								
			}
			
			if ( $active != "") {
				if ($where == "") {
					$where = " where a.active = '$active' ";
				} else {
					$where = $where . " and a.active = '$active' ";
				}								
			}
			
			
			if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
				$where = "";
			}
			
			if($all == 1) {
				$where = "";
			}
		
		} else {
			
			if ( $client_syscode != "" || $client_code != "") {
				if ($where == "") {
					$where = " where a.syscode = '$client_code' or a.client_syscode = '$client_syscode' ";
				} else {
					$where = $where . " and a.syscode = '$client_code' or a.client_syscode = '$client_syscode' ";
				}								
			}
			
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client_detail d left join client a on d.client_syscode=a.syscode left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		
		/*select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client_detail d left join client a on d.client_code=a.syscode left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode where a.client_syscode = '214221211701110310201420242191625084231916' or a.syscode = '214221211701110310201420242191625084231916' order by a.code, a.name*/
		
		//echo $sqlstr;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------count sub client commision ro
	function list_client_commision_ro_detail($client_code='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		if($client_code == "") {
			$where = "where a.client_code='NDF'";
		}
		
		
		$sqlstr="select a.client_code, a.client_syscode, count(a.client_code) qualified from client_detail a " . $where . " group by a.client_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------member upline ro
	function list_client_upline_ro($client_syscode='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		$sqlstr="select b.code, b.name from client_detail a left join client b on a.client_code=b.syscode " . $where . " order by b.code, b.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get jaringan member ro
	function list_client_jaringan_ro($client_code='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$client_code' ";
			} else {
				$where = $where . " and a.client_code = '$client_code' ";
			}								
		}
		
		
		$sqlstr="select a.client_code, a.client_syscode, b.name from client_detail a left join client b on a.client_code=b.syscode " . $where . " order by a.line, b.code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------client ro
	function list_client_ro($client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.syscode = '$client_code' ";
			} else {
				$where = $where . " and a.syscode = '$client_code' ";
			}								
		}
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		
		if($client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
			$where = " where a.code='NDFxx'";
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get bulan
	function list_month($month='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $month != "") {
			if ($where == "") {
				$where = " where a.kode = '$month' ";
			} else {
				$where = $where . " and a.kode = '$month' ";
			}								
		}
		
		
		$sqlstr = " select a.* from (
				select 1 kode, 'Januari' bulan union all
				select 2 kode, 'Februari' bulan union all
				select 3 kode, 'Maret' bulan union all
				select 4 kode, 'April' bulan union all
				select 5 kode, 'Mei' bulan union all
				select 6 kode, 'Juni' bulan union all
				select 7 kode, 'Juli' bulan union all
				select 8 kode, 'Agustus' bulan union all
				select 9 kode, 'September' bulan union all
				select 10 kode, 'Oktober' bulan union all
				select 11 kode, 'November' bulan union all
				select 12 kode, 'Desember' bulan ) a order by kode" ;
		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------get bulan
	function list_commision_reward($from_date='', $to_date='') {
		$dbpdo = DB::create();
		
		$where = " where (a.client_type=5 or a.client_type=6) "; //where (a.client_type=5 or a.old_client_type=6)
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data item
	function rpt_sales_product($from_date='', $to_date='', $item_code=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.date, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.date, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.date, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.date, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, a.client_code, d.code, d.name client_name, c.name item_name, b.uom_code, b.qty, b.unit_price, b.amount from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref left join item c on b.item_code=c.syscode and b.uom_code=c.uom_code_sales left join client d on a.client_code=d.syscode " . $where . " order by a.date, a.ref";
		//echo $sqlstr;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------list agent
	function list_data_agent($month='', $year='', $client_code ='', $client_syscode='', $active='', $all='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $month != "" && $year != '') {
			
			if(strlen($month) == 1) {
				$month = "0".$month;
			}
			
			$monthyear = $year . "-" . $month;
			$periode = date("Y-m", strtotime($monthyear));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m')='$monthyear' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m')='$monthyear' ";
			}								
		}
		
		if ( $client_code != "") {
			if ($where == "") {
				$where = " where a.syscode = '$client_code' ";
			} else {
				$where = $where . " and a.syscode = '$client_code' ";
			}								
		}
		
		if ( $client_syscode != "") {
			if ($where == "") {
				$where = " where a.client_syscode = '$client_syscode' ";
			} else {
				$where = $where . " and a.client_syscode = '$client_syscode' ";
			}								
		}
		
		if ( $active != "") {
			if ($where == "") {
				$where = " where a.active = '$active' ";
			} else {
				$where = $where . " and a.active = '$active' ";
			}								
		}
		
		
		if($month =='' && $year=='' && $client_code =='' && $client_syscode=='' && $active=='' && $all=='') {
			$where = " where a.code='NDFxx'";
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.dlu desc, a.code, a.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	
	//---------get topup saldo
	function rpt_topup_saldo($from_date='', $to_date=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $from_date != "") {
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.date, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.date, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.date, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.date, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
				
		$sqlstr="select aa.* from (select a.ref, a.client_code, a.date, a.current_balance, a.opening_balance, a.receipt_type, a.memo, a.dlu, b.code, b.name client_name, c.name bank_name from client_deposit a left join client b on a.client_code=b.syscode left join bank c on a.bank_id=c.id " . $where . " and (a.receipt_type='Tunai' or a.receipt_type='Bank') ";
		
		$sqlstr= $sqlstr . " union all select a.ref, a.client_code, a.date, a.current_balance, 0 opening_balance, a.receipt_type, a.memo, a.dlu, b.code, b.name client_name, c.name bank_name from client_deposit a left join client b on a.client_code=b.syscode left join bank c on a.bank_id=c.id " . $where . " and a.receipt_type='Transfer' ";
		
		$sqlstr= $sqlstr . " union all select a.ref, a.client_code, a.date, a.current_balance, 0 opening_balance, a.receipt_type, a.memo, a.dlu, b.code, b.name client_name, c.name bank_name from client_deposit a left join client b on a.client_code=b.syscode left join bank c on a.bank_id=c.id " . $where . " and a.receipt_type='Registrasi') aa order by aa.dlu desc, aa.client_name ";
		
		//echo $sqlstr;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------get bulan
	function list_commision_reward_summary($month='', $year='', $type='') {
		$dbpdo = DB::create();
		
		$sqlstr = "delete from rpt_commision_reward_summary";
		$sql2=$dbpdo->prepare($sqlstr);
		$sql2->execute();
							
		if($year != "") {
			for($month=1; $month<=12; $month++) {
					$periode 	= 	$year . "-" . $month;
					$period 	= 	date("Y-m", strtotime($periode));
							
					$where = " where (a.client_type=5 or a.old_client_type=6) ";
					
					if ( $period != "") {
						
						if ($where == "") {
							$where = " where date_format(a.dlu, '%Y-%m') >= '$period' ";
						} else {
							$where = $where . " and date_format(a.dlu, '%Y-%m') >= '$period' ";
						}								
					}
					
					if ( $period != "") {
						
						if ($where == "") {
							$where = " where date_format(a.dlu, '%Y-%m') <= '$period' ";
						} else {
							$where = $where . " and date_format(a.dlu, '%Y-%m') <= '$period' ";
						}								
					}
					
					$grand_bonus_basic_total 	= 	0;
					$grand_bonus_basic1_ap		=	0;
					$grand_komisi_pembinaan_ap	=	0;
					$grand_komisi_pembinaan_level1_ap = 0;
					$total_reward 				= 	0;
					$grand_total_ap_ap			=	0;
					$grand_total_reward			=	0;
										
					$sqlstr="select a.code, a.title, a.name, a.last_name, a.contact_person, a.contact_person1, a.contact_person2, a.contact_person3, a.client_type, a.address, a.zip_code, a.country_id, a.state_id, a.phone, a.phone1, a.fax, a.email, a.web, a.bank_name, a.bank_branch, a.bank_account, a.bank_account_no, a.location_id, a.active, a.client_syscode, a.uid, a.dlu, a.syscode, b.name client_type_name, c.name sub_member_name from client a left join client_type b on a.client_type=b.id left join client c on a.client_syscode=c.syscode " . $where . " order by a.code, a.name ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					while($row_client=$sql->fetch(PDO::FETCH_OBJ)){
						
						$client_syscode = $row_client->syscode;
						
						$count_member = 0;
					    $bonus_basic = 0;
						##level-0
						$sqln = $this->list_client_jaringan_basic($client_syscode);
						//total bonus level-0
						$rowsdata = $sqln->rowCount();
						$sql_lvl=$this->get_level_bonus1(1); 
						$row_level_amt = $sql_lvl->fetch(PDO::FETCH_OBJ);
						//$bonus_basic = $row_level_amt->bonus * $rowsdata;
						//-------------------
				    		while($data_net = $sqln->fetch(PDO::FETCH_OBJ)) {
				    			$count_member++;
				    			
				    			if($data_net->client_syscode != "") {
				    				
				    				##level-1
									$sqln1 = $this->list_client_jaringan_basic($data_net->client_syscode);
									//total bonus level-1
									$rowsdata1 = 0;
									$rowsdata1 = $sqln1->rowCount();
				        			$sql_lvl1=$this->get_level_bonus1(2); 
				        			$row_level_amt1 = $sql_lvl1->fetch(PDO::FETCH_OBJ);
				        			if( $bonus_basic1 == "") {
										//$bonus_basic1 = $row_level_amt1->bonus * $rowsdata1;
									}
									//-------------------
				            		while($data_net1 = $sqln1->fetch(PDO::FETCH_OBJ)) {
				            			$count_member++;
				            			
				            			if($data_net1->client_syscode != "") {
				            						
				            				##level-2
				            				$sqln2 = $this->list_client_jaringan_basic($data_net1->client_syscode);
				            				//total bonus level-2
				            				$rowsdata2 = 0;
				            				$rowsdata2 = $sqln2->rowCount();
				                			$sql_lvl2=$this->get_level_bonus1(3); 
				                			$row_level_amt2 = $sql_lvl2->fetch(PDO::FETCH_OBJ);								                            			
				                			if( $bonus_basic2 == "") {
												//$bonus_basic2 = $row_level_amt2->bonus * $rowsdata2;
											}
				                			//-------------------
				            				while($data_net2 = $sqln2->fetch(PDO::FETCH_OBJ)) {
				            					$count_member++;
				            					
				            					if($data_net2->client_syscode != "") {
				            						
				            						##level-3
				                    				$sqln3 = $this->list_client_jaringan_basic($data_net2->client_syscode);
				                    				//total bonus level-3
				                    				$rowsdata3 = 0;
					                    			$rowsdata3 = $sqln3->rowCount();
					                    			$sql_lvl3=$this->get_level_bonus1(3); 
				                        			$row_level_amt3 = $sql_lvl3->fetch(PDO::FETCH_OBJ);		
				                        			if( $bonus_basic3 == "") {
				                        				//$bonus_basic3 = $row_level_amt3->bonus * $rowsdata3;
													}
				                        			//-------------------
				                    				while($data_net3 = $sqln3->fetch(PDO::FETCH_OBJ)) {
				                    					$count_member++;
				                    					
				                    					if($data_net3->client_syscode != "") {
				                    						
				                    						##level-4
						                    				$sqln4 = $this->list_client_jaringan_basic($data_net3->client_syscode);
						                    				while($data_net4 = $sqln4->fetch(PDO::FETCH_OBJ)) {
						                    					$count_member++;
						                    					if($data_net4->client_syscode != "") {
						                    						
						                    						//total bonus level-3
						                    						$rowsdata4 = 0;
									                    			$rowsdata4 = $sqln4->rowCount();
									                    			$sql_lvl4=$this->get_level_bonus1(3); 
							                            			$row_level_amt4 = $sql_lvl4->fetch(PDO::FETCH_OBJ);												                            			
							                            			if( $bonus_basic4 == "") {
																		//$bonus_basic4 = $row_level_amt4->bonus * $rowsdata4;
																	}
							                            			//-------------------
					                            			
						                    						##level-5
								                    				$sqln5 = $this->list_client_jaringan_basic($data_net4->client_syscode);
								                    				while($data_net5 = $sqln5->fetch(PDO::FETCH_OBJ)) {
								                    					$count_member++;
								                    					if($data_net5->client_syscode != "") {
								                    						
								                    						//total bonus level-3
								                    						$rowsdata5 = 0;
											                    			$rowsdata5 = $sqln5->rowCount();
											                    			$sql_lvl5=$this->get_level_bonus1(3); 
									                            			$row_level_amt5 = $sql_lvl5->fetch(PDO::FETCH_OBJ);														                            			
									                            			if( $bonus_basic5 == "") {
																				//$bonus_basic5 = $row_level_amt5->bonus * $rowsdata5;
																			}
									                            			//-------------------
							                            			
								                    						##level-6
										                    				$sqln6 = $this->list_client_jaringan_basic($data_net5->client_syscode);
										                    				while($data_net6 = $sqln6->fetch(PDO::FETCH_OBJ)) {
										                    					$count_member++;
										                    					if($data_net6->client_syscode != "") {
										                    						//total bonus level-3
										                    						$rowsdata6 = 0;
													                    			$rowsdata6 = $sqln6->rowCount();
													                    			$sql_lvl6=$this->get_level_bonus1(3); 
											                            			$row_level_amt6 = $sql_lvl6->fetch(PDO::FETCH_OBJ);																                            			
											                            			if( $bonus_basic6 == "") {
																						//$bonus_basic6 = $row_level_amt6->bonus * $rowsdata6;
																					}
											                            			//-------------------
									                            			
										                    						##level-7
												                    				$sqln7 = $this->list_client_jaringan_basic($data_net6->client_syscode);
												                    				while($data_net7 = $sqln7->fetch(PDO::FETCH_OBJ)) {
												                    					$count_member++;
												                    					if($data_net7->client_syscode != "") {
												                    						//total bonus level-3
												                    						$rowsdata7 = 0;
															                    			$rowsdata7 = $sqln7->rowCount();
															                    			$sql_lvl7=$this->get_level_bonus1(3); 
													                            			$row_level_amt7 = $sql_lvl7->fetch(PDO::FETCH_OBJ);																		                            			
													                            			if( $bonus_basic7 == "") {
																								//$bonus_basic7 = $row_level_amt7->bonus * $rowsdata7;
																							}
													                            			//-------------------
													                            			
												                    						##level-8
														                    				$sqln8 = $this->list_client_jaringan_basic($data_net7->client_syscode);
														                    				while($data_net8 = $sqln8->fetch(PDO::FETCH_OBJ)) {
														                    					$count_member++;
														                    					if($data_net8->client_syscode != "") {
														                    						
														                    						//total bonus level-3
														                    						$rowsdata8 = 0;
																	                    			$rowsdata8 = $sqln8->rowCount();
																	                    			$sql_lvl8=$this->get_level_bonus1(3); 
															                            			$row_level_amt8 = $sql_lvl8->fetch(PDO::FETCH_OBJ);																				                            			
															                            			if( $bonus_basic8 == "") {
																										//$bonus_basic8 = $row_level_amt8->bonus * $rowsdata8;
																									}
															                            			//-------------------
													                            			
														                    						##level-9
																                    				$sqln9 = $this->list_client_jaringan_basic($data_net8->client_syscode);
																                    				while($data_net9 = $sqln9->fetch(PDO::FETCH_OBJ)) {
																                    					$count_member++;
																                    					if($data_net9->client_syscode != "") {
																                    						
																                    						//total bonus level-3
																                    						$rowsdata9 = 0;
																			                    			$rowsdata9 = $sqln9->rowCount();
																			                    			$sql_lvl9=$this->get_level_bonus1(3); 
																	                            			$row_level_amt9 = $sql_lvl9->fetch(PDO::FETCH_OBJ);																						                            			
																	                            			if( $bonus_basic9 == "") {
																												//$bonus_basic9 = $row_level_amt9->bonus * $rowsdata9;
																											}
																	                            			//-------------------
																	                            			
																                    						##level-10
																		                    				$sqln10 = $this->list_client_jaringan_basic($data_net9->client_syscode);
																		                    				while($data_net10 = $sqln10->fetch(PDO::FETCH_OBJ)) {
																		                    					$count_member++;
																		                    					if($data_net10->client_syscode != "") {
																		                    						
																		                    						//total bonus level-3
																		                    						$rowsdata10 = 0;
																					                    			$rowsdata10 = $sqln10->rowCount();
																					                    			$sql_lvl10=$this->get_level_bonus1(3); 
																			                            			$row_level_amt10 = $sql_lvl10->fetch(PDO::FETCH_OBJ);																								                            			
																			                            			if( $bonus_basic10 == "") {
																														//$bonus_basic10 = $row_level_amt10->bonus * $rowsdata10;
																													}
																			                            			//-------------------
																												}
																											}
																										}
																									}
														                    				
																								}
																							}
												                    				
																						}
																					}
										                    				
																				}
																			}
								                    				
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
								
							}
				    		$total_network = $count_member; // - 1;
				    		if($total_network < 0) {
								$total_network = 0;
							}
							
							
							$sqlup = $this->list_client_upline_platinum($client_syscode);
                    		$dataup = $sqlup->fetch(PDO::FETCH_OBJ);
                    		$upline = $dataup->name;
                    		if($upline == "") {
								$upline = "-";
							}
							
							//GET BASIC
							$bonus_basic_total = 0;
			    			
							$jumlah1 = 0;
							$jumlah2 = 0;
							$jumlah3 = 0;
							$jumlah4 = 0;
							$jumlah5 = 0;
							$jumlah6 = 0;
							$jumlah7 = 0;
							$jumlah8 = 0;
							$jumlah9 = 0;
							$jumlah10 = 0;
							
							$bonus1 = 0;
							$bonus2 = 0;
							$bonus3 = 0;
							$bonus4 = 0;
							$bonus5 = 0;
							$bonus6 = 0;
							$bonus7 = 0;
							$bonus8 = 0;
							$bonus9 = 0;
							$bonus10 = 0;
							
							
							if($client_syscode != "") {
								$sqlmember 		= $this->list_client_jaringan_basic($client_syscode);
								$countmember 	= $sqlmember->rowCount();
								
								$countmember1	= 0;
								//$jumlah1 = 0;
								$bonus_basic1 = 0;
								while($data_member = $sqlmember->fetch(PDO::FETCH_OBJ)) {
									$sqlmember1 	= $this->list_client_jaringan_basic($data_member->client_syscode);
									$countmember1 	= $sqlmember1->rowCount();
									$jumlah1++;
																																							
									//get bounus basic															
									$sql_lvl1=$this->get_level_bonus1(1); 
			            			$row_level_amt1 = $sql_lvl1->fetch(PDO::FETCH_OBJ);
			            			if($bonus_basic1 < ($row_level_amt1->bonus * $jumlah1) ) {
										$bonus_basic1 = $row_level_amt1->bonus * $jumlah1;
			            				$bonus_basic_total = $bonus_basic1;		
			            				//echo $jumlah1. "======<br>";				                            				
									}
									$bonus1 = $row_level_amt1->bonus;
			            																																																																														
									$countmember2	= 0;
									//$jumlah2 = 0;
									$bonus_basic2 = 0;
									while($data_member1 = $sqlmember1->fetch(PDO::FETCH_OBJ)) {
										$sqlmember2 	= $this->list_client_jaringan_basic($data_member1->client_syscode);
										$countmember2 	= $sqlmember2->rowCount();
										$jumlah2++;
																										
										//get bounus basic
										$sql_lvl2=$this->get_level_bonus1(2); 
			                			$row_level_amt2 = $sql_lvl2->fetch(PDO::FETCH_OBJ);
			                			if($bonus_basic2 < ($row_level_amt2->bonus * $jumlah2) ) {
			                				$bonus_basic2 = $row_level_amt2->bonus * $jumlah2;						                            							                            										                            				
										//} else {
											$bonus_basic_total = numberreplace($bonus_basic_total) + $bonus_basic2;	
											/*echo $bonus_basic2. "<br>";
											echo $bonus_basic_total. "=>>>><br>";*/	
										}			
										$bonus2 = $row_level_amt2->bonus;
										
			                																																																																																																																																																																			
										$countmember3	= 0;
										//$jumlah3 = 0;
										$bonus_basic3 = 0;
										while($data_member2 = $sqlmember2->fetch(PDO::FETCH_OBJ)) {
											$sqlmember3 	= $this->list_client_jaringan_basic($data_member2->client_syscode);
											$countmember3 	= $sqlmember3->rowCount();
											$jumlah3++;
											
											//get bounus basic																	
											$sql_lvl3=$this->get_level_bonus1(3); 
			                    			$row_level_amt3 = $sql_lvl3->fetch(PDO::FETCH_OBJ);
			                    			if($bonus_basic3 < ($row_level_amt3->bonus * $jumlah3) ) {
			                    				$bonus_basic3 = $row_level_amt3->bonus * $jumlah3;							                            										                            										                            				
											//} else {
												$bonus_basic_total = numberreplace($bonus_basic_total) + $bonus_basic3;
											}
											$bonus3 = $row_level_amt3->bonus;
																											
																																																																																																
											$countmember4	= 0;
											//$jumlah4 = 0;
											$bonus_basic4 = 0;
											while($data_member3 = $sqlmember3->fetch(PDO::FETCH_OBJ)) {
												$sqlmember4		= $this->list_client_jaringan_basic($data_member3->client_syscode);
												$countmember4 	= $sqlmember4->rowCount();
												$jumlah4++;
												
												//get bounus basic
												$sql_lvl4=$this->get_level_bonus1(4); 
			                        			$row_level_amt4 = $sql_lvl4->fetch(PDO::FETCH_OBJ);
			                        			if($bonus_basic4 < ($row_level_amt4->bonus * $jumlah4) ) {
			                            			$bonus_basic4 = $row_level_amt4->bonus * $jumlah4;	
													$bonus_basic_total = numberreplace($bonus_basic_total) + $bonus_basic4;
												}
												$bonus4 = $row_level_amt4->bonus;
												
																														
												$countmember5	= 0;
												//$jumlah5 = 0;
												$bonus_basic5 = 0;
												while($data_member4 = $sqlmember4->fetch(PDO::FETCH_OBJ)) {
													$sqlmember5		= $this->list_client_jaringan_basic($data_member4->client_syscode);
													$countmember5 	= $sqlmember5->rowCount();
													$jumlah5++;
													
													//get bounus basic
													$sql_lvl5=$this->get_level_bonus1(5); 
			                            			$row_level_amt5 = $sql_lvl5->fetch(PDO::FETCH_OBJ);
			                            			if($bonus_basic5 < ($row_level_amt5->bonus * $jumlah5) ) {
			                            				$bonus_basic5 = $row_level_amt5->bonus * $jumlah5;	
														$bonus_basic_total = numberreplace($bonus_basic_total) + $bonus_basic5;
													}
													$bonus5 = $row_level_amt5->bonus;
													
													
													$countmember6	= 0;
													//$jumlah6 = 0;
													$bonus_basic6 = 0;
													while($data_member5 = $sqlmember5->fetch(PDO::FETCH_OBJ)) {
														$sqlmember6		= $this->list_client_jaringan_basic($data_member5->client_syscode);
														$countmember6 	= $sqlmember6->rowCount();
														$jumlah6++;
														
														//get bounus basic																				
														$sql_lvl6=$this->get_level_bonus1(6); 
				                            			$row_level_amt6 = $sql_lvl6->fetch(PDO::FETCH_OBJ);
				                            			if($bonus_basic6 < ($row_level_amt6->bonus * $jumlah6) ) {
				                            				$bonus_basic6 = $row_level_amt6->bonus * $jumlah6;	
															$bonus_basic_total = numberreplace($bonus_basic_total) + $bonus_basic6;
														}
														$bonus6 = $row_level_amt6->bonus;
														
														$countmember7	= 0;
														//$jumlah7 = 0;
														$bonus_basic7 = 0;
														while($data_member6 = $sqlmember6->fetch(PDO::FETCH_OBJ)) {
															$sqlmember7		= $this->list_client_jaringan_basic($data_member6->client_syscode);
															$countmember7 	= $sqlmember7->rowCount();
															$jumlah7++;
															
															//get bounus basic																					
															$sql_lvl7=$this->get_level_bonus1(7); 
					                            			$row_level_amt7 = $sql_lvl7->fetch(PDO::FETCH_OBJ);
					                            			$bonus_basic7 = $row_level_amt7->bonus * $jumlah7;	
															$bonus_basic_total = numberreplace($bonus_basic_total) + $bonus_basic7;
															$bonus7 = $row_level_amt7->bonus;
															
															$countmember8	= 0;
															//$jumlah8 = 0;
															$bonus_basic8 = 0;
															while($data_member7 = $sqlmember7->fetch(PDO::FETCH_OBJ)) {
																$sqlmember8		= $this->list_client_jaringan_basic($data_member7->client_syscode);
																$countmember8 	= $sqlmember8->rowCount();
																$jumlah8++;
																
																//get bounus basic																						
																$sql_lvl8=$this->get_level_bonus1(8); 
						                            			$row_level_amt8 = $sql_lvl8->fetch(PDO::FETCH_OBJ);
						                            			$bonus_basic8 = $row_level_amt8->bonus * $jumlah8;	
																$bonus_basic_total = numberreplace($bonus_basic_total) + $bonus_basic8;
																$bonus8 = $row_level_amt8->bonus;
																
																$countmember9	= 0;
																//$jumlah9 = 0;
																$bonus_basic9 = 0;
																while($data_member8 = $sqlmember8->fetch(PDO::FETCH_OBJ)) {
																	$sqlmember9		= $this->list_client_jaringan_basic($data_member8->client_syscode);
																	$countmember9 	= $sqlmember9->rowCount();
																	$jumlah9++;
																	
																	//get bounus basic																							
																	$sql_lvl9=$this->get_level_bonus1(9); 
							                            			$row_level_amt9 = $sql_lvl9->fetch(PDO::FETCH_OBJ);
							                            			$bonus_basic9 = $row_level_amt9->bonus * $jumlah9;	
																	$bonus_basic_total = numberreplace($bonus_basic_total) + $bonus_basic9;
																	$bonus9 = $row_level_amt9->bonus;
																	
																	$countmember10	= 0;
																	//$jumlah10 = 0;
																	$bonus_basic10 = 0;
																	while($data_member9 = $sqlmember9->fetch(PDO::FETCH_OBJ)) {
																		$sqlmember10	= $this->list_client_jaringan_basic($data_member9->client_syscode);
																		$countmember10 	= $sqlmember10->rowCount();
																		$jumlah10++;
																		
																		//get bounus basic
																		$sql_lvl10=$this->get_level_bonus1(10); 
								                            			$row_level_amt10 = $sql_lvl10->fetch(PDO::FETCH_OBJ);
								                            			$bonus_basic10 = $row_level_amt10->bonus * $jumlah10;	
																		$bonus_basic_total = numberreplace($bonus_basic_total) + $bonus_basic10;
																		$bonus10 = $row_level_amt10->bonus;
																	}
																
																}
																
															}
															
														}
													}
												}
											}
										}
									}
								}														
							}
							
							//$bonus_basic_total = 0;
							$bonus_basic1 = $jumlah1 * $bonus1;
							$bonus_basic2 = $jumlah2 * $bonus2;
							$bonus_basic3 = $jumlah3 * $bonus3;
							
			    			if($total_network == 0) {
								$bonus_basic_total = 0;
							} else {
			    				$bonus_basic_total = $bonus_basic1 + $bonus_basic2 + $bonus_basic3; // + $bonus_basic4 + $bonus_basic5 + $bonus_basic6 + $bonus_basic7 + $bonus_basic8 + $bonus_basic9 + $bonus_basic10;
							}
							
							
							//PRESTASI
							$total_ap2 = 0;
								
							$total_ap2 = $jumlah1_ap + $jumlah2_ap + $jumlah3_ap;
							
							$bonus_basic1_ap = $jumlah1_ap * $bonus1_ap;
							$bonus_basic2_ap = $jumlah2_ap * $bonus2_ap;
							$bonus_basic3_ap = $jumlah3_ap * $bonus3_ap;
							/*$bonus_basic4_ap = $jumlah4_ap * $bonus4_ap;
							$bonus_basic5_ap = $jumlah5_ap * $bonus5_ap;*/
							
			    			if($total_network_ap == 0) {
								$bonus_basic_total_ap = 0;
							} else {
			    				$bonus_basic_total_ap = $bonus_basic1_ap + $bonus_basic2_ap + $bonus_basic3_ap; // + $bonus_basic4_ap + $bonus_basic5_ap; // + $bonus_basic6 + $bonus_basic7 + $bonus_basic8 + $bonus_basic9 + $bonus_basic10;
							}
								
			        		$total_network_ap = $count_member_ap; // - 1;
			        		if($total_network_ap < 0) {
								$total_network_ap = 0;
							}
							
							$komisi_pembinaan_ap = 0;
							$komisi_pembinaan_ap = ($jumlah1_ap * 120000) + ($jumlah2_ap * 100000) + ($jumlah3_ap * 20000) + ($jumlah4_ap * 40000) + ($jumlah5_ap * 120000);
							
							if($upline == "-") {
								$komisi_pembinaan_level1_ap =  (($jumlah2_ap * 220000) * 25)/100;
							} else {
								$komisi_pembinaan_level1_ap =  (($jumlah2_ap * 120000) * 25)/100;
							}
							
							$total_ap_ap = $bonus_basic1_ap + $komisi_pembinaan_ap + $komisi_pembinaan_level1_ap;
								
							
							
							//PREMIUM
							$bonus_basic_total_ap = 0;
			    			$count_member_ap = 0;
			    			
							$jumlah1_ap = 0;
							$jumlah2_ap = 0;
							$jumlah3_ap = 0;
							$jumlah4_ap = 0;
							$jumlah5_ap = 0;
							$jumlah6_ap = 0;
							$jumlah7_ap = 0;
							$jumlah8_ap = 0;
							$jumlah9_ap = 0;
							$jumlah10_ap = 0;
							
							$bonus1_ap = 0;
							$bonus2_ap = 0;
							$bonus3_ap = 0;
							$bonus4_ap = 0;
							$bonus5_ap = 0;
							$bonus6_ap = 0;
							$bonus7_ap = 0;
							$bonus8_ap = 0;
							$bonus9_ap = 0;
							$bonus10_ap = 0;
							
							if($client_syscode != "") {
								$sqlmember 		= $this->list_client_jaringan_platinum_ap($client_syscode);
								$countmember_ap 	= $sqlmember->rowCount();
								
								$countmember1_ap	= 0;
								//$jumlah1 = 0;
								$bonus_basic1_ap = 0;
								while($data_member_ap = $sqlmember->fetch(PDO::FETCH_OBJ)) {
									$count_member_ap++;
									
									$sqlmember1_ap 	= $this->list_client_jaringan_platinum_ap($data_member_ap->client_syscode);
									$countmember1_ap 	= $sqlmember1_ap->rowCount();
									$jumlah1_ap++;
																																							
									//get bounus basic															
									$sql_lvl1_ap=$this->get_level_bonus1(1); 
			            			$row_level_amt1_ap = $sql_lvl1_ap->fetch(PDO::FETCH_OBJ);
			            			if($bonus_basic1_ap < ($row_level_amt1_ap->prestasi * $jumlah1_ap) ) {
										$bonus_basic1_ap = $row_level_amt1_ap->prestasi * $jumlah1_ap;
			            				$bonus_basic_total_ap = $bonus_basic1_ap;		
			            				//echo $jumlah1. "======<br>";				                            				
									}
									$bonus1_ap = $row_level_amt1_ap->prestasi;
			            																																																																														
									$countmember2_ap	= 0;
									//$jumlah2 = 0;
									$bonus_basic2_ap = 0;
									while($data_member1_ap = $sqlmember1_ap->fetch(PDO::FETCH_OBJ)) {
										$count_member_ap++;
										
										$sqlmember2_ap 	= $this->list_client_jaringan_platinum_ap($data_member1_ap->client_syscode);
										$countmember2_ap 	= $sqlmember2_ap->rowCount();
										$jumlah2_ap++;
																										
										//get bounus basic
										$sql_lvl2_ap=$this->get_level_bonus1(2); 
			                			$row_level_amt2_ap = $sql_lvl2_ap->fetch(PDO::FETCH_OBJ);
			                			if($bonus_basic2_ap < ($row_level_amt2_ap->prestasi * $jumlah2_ap) ) {
			                				$bonus_basic2_ap = $row_level_amt2_ap->prestasi * $jumlah2_ap;						                            							                            										                            				
										//} else {
											$bonus_basic_total_ap = numberreplace($bonus_basic_total_ap) + $bonus_basic2_ap;	
											/*echo $bonus_basic2. "<br>";
											echo $bonus_basic_total. "=>>>><br>";*/	
										}			
										$bonus2_ap = $row_level_amt2_ap->prestasi;
										
			                																																																																																																																																																																			
										$countmember3_ap	= 0;
										//$jumlah3 = 0;
										$bonus_basic3_ap = 0;
										while($data_member2_ap = $sqlmember2_ap->fetch(PDO::FETCH_OBJ)) {
											$count_member_ap++;
											
											$sqlmember3_ap 	= $this->list_client_jaringan_platinum_ap($data_member2_ap->client_syscode);
											$countmember3_ap 	= $sqlmember3_ap->rowCount();
											$jumlah3_ap++;
											
											//get bounus basic																	
											$sql_lvl3_ap=$this->get_level_bonus1(3); 
			                    			$row_level_amt3_ap = $sql_lvl3_ap->fetch(PDO::FETCH_OBJ);
			                    			if($bonus_basic3_ap < ($row_level_amt3_ap->prestasi * $jumlah3_ap) ) {
			                    				$bonus_basic3_ap = $row_level_amt3_ap->prestasi * $jumlah3_ap;							                            										                            										                            				
											//} else {
												$bonus_basic_total_ap = numberreplace($bonus_basic_total_ap) + $bonus_basic3_ap;
											}
											$bonus3_ap = $row_level_amt3_ap->prestasi;
																											
																																																																																																
											$countmember4_ap	= 0;
											//$jumlah4 = 0;
											$bonus_basic4_ap = 0;
											while($data_member3_ap = $sqlmember3_ap->fetch(PDO::FETCH_OBJ)) {
												$count_member_ap++;
												
												$sqlmember4_ap		= $this->list_client_jaringan_platinum_ap($data_member3->client_syscode);
												$countmember4_ap 	= $sqlmember4_ap->rowCount();
												$jumlah4_ap++;
												
												//get bounus basic
												$sql_lvl4_ap=$this->get_level_bonus1(4); 
			                        			$row_level_amt4_ap = $sql_lvl4_ap->fetch(PDO::FETCH_OBJ);
			                        			if($bonus_basic4_ap < ($row_level_amt4_ap->prestasi * $jumlah4_ap) ) {
			                            			$bonus_basic4_ap = $row_level_amt4_ap->prestasi * $jumlah4_ap;	
													$bonus_basic_total_ap = numberreplace($bonus_basic_total_ap) + $bonus_basic4_ap;
												}
												$bonus4_ap = $row_level_amt4_ap->prestasi;
												
																														
												$countmember5_ap	= 0;
												//$jumlah5 = 0;
												$bonus_basic5_ap = 0;
												while($data_member4_ap = $sqlmember4_ap->fetch(PDO::FETCH_OBJ)) {
													$count_member_ap++;
													
													$sqlmember5_ap		= $this->list_client_jaringan_platinum_ap($data_member4_ap->client_syscode);
													$countmember5_ap 	= $sqlmember5_ap->rowCount();
													$jumlah5_ap++;
													
													//get bounus basic
													$sql_lvl5_ap=$this->get_level_bonus1(5); 
			                            			$row_level_amt5_ap = $sql_lvl5_ap->fetch(PDO::FETCH_OBJ);
			                            			if($bonus_basic5_ap < ($row_level_amt5_ap->prestasi * $jumlah5_ap) ) {
			                            				$bonus_basic5_ap = $row_level_amt5_ap->prestasi * $jumlah5_ap;	
														$bonus_basic_total_ap = numberreplace($bonus_basic_total_ap) + $bonus_basic5_ap;
													}
													$bonus5_ap = $row_level_amt5_ap->prestasi;
													
													
													$countmember6_ap	= 0;
													//$jumlah6 = 0;
													$bonus_basic6_ap = 0;
													while($data_member5_ap = $sqlmember5_ap->fetch(PDO::FETCH_OBJ)) {
														$count_member_ap++;
														
														$sqlmember6_ap		= $this->list_client_jaringan_platinum_ap($data_member5_ap->client_syscode);
														$countmember6_ap 	= $sqlmember6_ap->rowCount();
														$jumlah6_ap++;
														
														//get bounus basic																				
														$sql_lvl6_ap=$this->get_level_bonus1(6); 
				                            			$row_level_amt6_ap = $sql_lvl6_ap->fetch(PDO::FETCH_OBJ);
				                            			if($bonus_basic6_ap < ($row_level_amt6_ap->prestasi * $jumlah6_ap) ) {
				                            				$bonus_basic6_ap = $row_level_amt6_ap->prestasi * $jumlah6_ap;	
															$bonus_basic_total_ap = numberreplace($bonus_basic_total_ap) + $bonus_basic6_ap;
														}
														$bonus6_ap = $row_level_amt6_ap->prestasi;
														
														$countmember7_ap	= 0;
														//$jumlah7 = 0;
														$bonus_basic7_ap = 0;
														while($data_member6_ap = $sqlmember6_ap->fetch(PDO::FETCH_OBJ)) {
															$count_member_ap++;
															
															$sqlmember7_ap		= $this->list_client_jaringan_platinum_ap($data_member6_ap->client_syscode);
															$countmember7_ap 	= $sqlmember7->rowCount();
															$jumlah7_ap++;
															
															//get bounus basic																					
															$sql_lvl7_ap=$this->get_level_bonus1(7); 
					                            			$row_level_amt7_ap = $sql_lvl7_ap->fetch(PDO::FETCH_OBJ);
					                            			$bonus_basic7_ap = $row_level_amt7_ap->prestasi * $jumlah7_ap;	
															$bonus_basic_total_ap = numberreplace($bonus_basic_total_ap) + $bonus_basic7_ap;
															$bonus7_ap = $row_level_amt7_ap->prestasi;
															
															$countmember8_ap	= 0;
															//$jumlah8 = 0;
															$bonus_basic8_ap = 0;
															while($data_member7_ap = $sqlmember7_ap->fetch(PDO::FETCH_OBJ)) {
																$count_member_ap++;
																
																$sqlmember8_ap		= $this->list_client_jaringan_platinum_ap($data_member7_ap->client_syscode);
																$countmember8_ap 	= $sqlmember8_ap->rowCount();
																$jumlah8_ap++;
																
																//get bounus basic																						
																$sql_lvl8_ap=$this->get_level_bonus1(8); 
						                            			$row_level_amt8_ap = $sql_lvl8_ap->fetch(PDO::FETCH_OBJ);
						                            			$bonus_basic8_ap = $row_level_amt8_ap->prestasi * $jumlah8_ap;	
																$bonus_basic_total_ap = numberreplace($bonus_basic_total_ap) + $bonus_basic8_ap;
																$bonus8_ap = $row_level_amt8_ap->prestasi;
																
																$countmember9_ap	= 0;
																//$jumlah9 = 0;
																$bonus_basic9_ap = 0;
																while($data_member8_ap = $sqlmember8_ap->fetch(PDO::FETCH_OBJ)) {
																	$count_member_ap++;
																	
																	$sqlmember9_ap		= $this->list_client_jaringan_platinum_ap($data_member8_ap->client_syscode);
																	$countmember9_ap 	= $sqlmember9_ap->rowCount();
																	$jumlah9_ap++;
																	
																	//get bounus basic																							
																	$sql_lvl9_ap=$this->get_level_bonus1(9); 
							                            			$row_level_amt9_ap = $sql_lvl9_ap->fetch(PDO::FETCH_OBJ);
							                            			$bonus_basic9_ap = $row_level_amt9_ap->prestasi * $jumlah9_ap;	
																	$bonus_basic_total_ap = numberreplace($bonus_basic_total_ap) + $bonus_basic9_ap;
																	$bonus9_ap = $row_level_amt9_ap->prestasi;
																	
																	$countmember10_ap	= 0;
																	//$jumlah10 = 0;
																	$bonus_basic10_ap = 0;
																	while($data_member9_ap = $sqlmember9_ap->fetch(PDO::FETCH_OBJ)) {
																		$count_member_ap++;
																		
																		$sqlmember10_ap	= $this->list_client_jaringan_platinum_ap($data_member9_ap->client_syscode);
																		$countmember10_ap 	= $sqlmember10_ap->rowCount();
																		$jumlah10_ap++;
																		
																		//get bounus basic
																		$sql_lvl10_ap=$this->get_level_bonus1(10); 
								                            			$row_level_amt10_ap = $sql_lvl10_ap->fetch(PDO::FETCH_OBJ);
								                            			$bonus_basic10_ap = $row_level_amt10_ap->prestasi * $jumlah10_ap;	
																		$bonus_basic_total_ap = numberreplace($bonus_basic_total_ap) + $bonus_basic10_ap;
																		$bonus10_ap = $row_level_amt10_ap->prestasi;
																	}
																
																}
																
															}
															
														}
													}
												}
											}
										}
									}
								}														
							}
							
							$total_ap2 = 0;
							//$bonus_basic_total = 0;
							/*$jumlah1_ap = floor($jumlah1_ap / 6);
							$jumlah2_ap = floor($jumlah2_ap / 36);
							$jumlah3_ap = floor($jumlah3_ap / 216);*/
							/*$jumlah4_ap = $jumlah4_ap * $bonus4_ap;
							$jumlah5_ap = $jumlah5_ap * $bonus5_ap;*/
							$total_ap2 = $jumlah1_ap + $jumlah2_ap + $jumlah3_ap;
							
							$bonus_basic1_ap = $jumlah1_ap * $bonus1_ap;
							$bonus_basic2_ap = $jumlah2_ap * $bonus2_ap;
							$bonus_basic3_ap = $jumlah3_ap * $bonus3_ap;
							/*$bonus_basic4_ap = $jumlah4_ap * $bonus4_ap;
							$bonus_basic5_ap = $jumlah5_ap * $bonus5_ap;*/
							
			    			if($total_network_ap == 0) {
								$bonus_basic_total_ap = 0;
							} else {
			    				$bonus_basic_total_ap = $bonus_basic1_ap + $bonus_basic2_ap + $bonus_basic3_ap; // + $bonus_basic4_ap + $bonus_basic5_ap; // + $bonus_basic6 + $bonus_basic7 + $bonus_basic8 + $bonus_basic9 + $bonus_basic10;
							}
								
			        		$total_network_ap = $count_member_ap; // - 1;
			        		if($total_network_ap < 0) {
								$total_network_ap = 0;
							}
							
							//$komisi_pembinaan_ap = 0;
							$komisi_pembinaan_ap = ($jumlah1_ap * 120000) + ($jumlah2_ap * 100000) + ($jumlah3_ap * 20000) + ($jumlah4_ap * 40000) + ($jumlah5_ap * 120000);
							
							if($upline == "-") {
								$komisi_pembinaan_level1_ap =  (($jumlah2_ap * 220000) * 25)/100;
							} else {
								$komisi_pembinaan_level1_ap =  (($jumlah2_ap * 120000) * 25)/100;
							}
							
							$total_ap_ap = $bonus_basic1_ap + $komisi_pembinaan_ap + $komisi_pembinaan_level1_ap;
							
							
							//GRAND TOTAL;
							$grand_bonus_basic_total 	= 	$grand_bonus_basic_total + $bonus_basic_total;
							$grand_bonus_basic1_ap		=	$grand_bonus_basic1_ap + $bonus_basic1_ap;
							$grand_komisi_pembinaan_ap	=	$grand_komisi_pembinaan_ap + $komisi_pembinaan_ap;
							$grand_komisi_pembinaan_level1_ap = $grand_komisi_pembinaan_level1_ap + $komisi_pembinaan_level1_ap;
							
							//$grand_total_ap_ap			=	$grand_total_ap_ap + $total_ap_ap;
												
							$total_ap_ap 				= 	$bonus_basic_total + $bonus_basic1_ap + $komisi_pembinaan_ap + $komisi_pembinaan_level1_ap;
							$grand_total_ap_ap			=	$grand_total_ap_ap + $total_ap_ap;
							
							$total_reward 				= 	0;
							$grand_total_reward			=	0;
							
					}							
					
					//insert to data table
					$sqlstr = "select id from rpt_commision_reward_summary where type='Komisi'";
					$sql2=$dbpdo->prepare($sqlstr);
					$sql2->execute();
					$rows_komisi = $sql2->rowCount();
					
					/*if($month == 1) { $january	=	$grand_bonus_basic_total; }
					if($month == 2) { $february	=	$grand_bonus_basic_total; }
					if($month == 3) { $march	=	$grand_bonus_basic_total; }
					if($month == 4) { $april	=	$grand_bonus_basic_total; }
					if($month == 5) { $may		=	$grand_bonus_basic_total; }
					if($month == 6) { $juny		=	$grand_bonus_basic_total; }
					if($month == 7) { $july		=	$grand_bonus_basic_total; }
					if($month == 8) { $august	=	$grand_bonus_basic_total; }
					if($month == 9) { $september=	$grand_bonus_basic_total; }
					if($month == 10) { $october	=	$grand_bonus_basic_total; }
					if($month == 11) { $november=	$grand_bonus_basic_total; }
					if($month == 12) { $december=	$grand_bonus_basic_total; }*/
					
					if($rows_komisi == 0) {
						$sqlstr = "insert into rpt_commision_reward_summary (id, type, name, january, february, march, april, may, juny, july, august, september, october, november, december) values ('1', 'Komisi', 'Komisi Agen Basic', '$january', '$february', '$march', '$april', '$may', '$juny', '$july', '$august', '$september', '$october', '$november', '$december')";
						$sql2=$dbpdo->prepare($sqlstr);
						$sql2->execute();
						
						$sqlstr = "insert into rpt_commision_reward_summary (id, type, name, january, february, march, april, may, juny, july, august, september, october, november, december) values ('2', 'Komisi', 'Komisi Prestasi', '$january', '$february', '$march', '$april', '$may', '$juny', '$july', '$august', '$september', '$october', '$november', '$december')";
						$sql2=$dbpdo->prepare($sqlstr);
						$sql2->execute();
						
						$sqlstr = "insert into rpt_commision_reward_summary (id, type, name, january, february, march, april, may, juny, july, august, september, october, november, december) values ('3', 'Komisi', 'Komisi Pembinaan', '$january', '$february', '$march', '$april', '$may', '$juny', '$july', '$august', '$september', '$october', '$november', '$december')";
						$sql2=$dbpdo->prepare($sqlstr);
						$sql2->execute();
						
						$sqlstr = "insert into rpt_commision_reward_summary (id, type, name, january, february, march, april, may, juny, july, august, september, october, november, december) values ('4', 'Komisi', 'Royalti Pembinaan', '$january', '$february', '$march', '$april', '$may', '$juny', '$july', '$august', '$september', '$october', '$november', '$december')";
						$sql2=$dbpdo->prepare($sqlstr);
						$sql2->execute();
						
						$sqlstr = "insert into rpt_commision_reward_summary (id, type, name, january, february, march, april, may, juny, july, august, september, october, november, december) values ('5', 'Komisi', 'RO Pribadi', '$january', '$february', '$march', '$april', '$may', '$juny', '$july', '$august', '$september', '$october', '$november', '$december')";
						$sql2=$dbpdo->prepare($sqlstr);
						$sql2->execute();
						
						$sqlstr = "insert into rpt_commision_reward_summary (id, type, name, january, february, march, april, may, juny, july, august, september, october, november, december) values ('6', 'Komisi', 'RO Generasi', '$january', '$february', '$march', '$april', '$may', '$juny', '$july', '$august', '$september', '$october', '$november', '$december')";
						$sql2=$dbpdo->prepare($sqlstr);
						$sql2->execute();
						
						$sqlstr = "insert into rpt_commision_reward_summary (id, type, name, january, february, march, april, may, juny, july, august, september, october, november, december) values ('7', 'Komisi', 'Royalti RO', '$january', '$february', '$march', '$april', '$may', '$juny', '$july', '$august', '$september', '$october', '$november', '$december')";
						$sql2=$dbpdo->prepare($sqlstr);
						$sql2->execute();
						
					} else {
						
						if($month == 1) { 
							$january	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set january='$january' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$january	=	$grand_bonus_basic1_ap;
							$sqlstr = "update rpt_commision_reward_summary set january='$january' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$january	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set january='$january' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$january	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set january='$january' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();							
							
						}
						
						if($month == 2) { 
							$february	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set february='$february' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							$february	=	$grand_bonus_basic1_ap;
							$sqlstr = "update rpt_commision_reward_summary set february='$february' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$february	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set february='$february' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$february	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set february='$february' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
						if($month == 3) { 
							$march	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set march='$march' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//----------
							$march	=	$grand_bonus_basic1_ap;
							$sqlstr = "update rpt_commision_reward_summary set march='$march' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$march	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set march='$march' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$march	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set march='$march' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
						if($month == 4) { 
							$april	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set april='$april' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//---
							$april	=	$grand_bonus_basic1_ap; 
							$sqlstr = "update rpt_commision_reward_summary set april='$april' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$april	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set april='$april' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$april	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set april='$april' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
						if($month == 5) { 
							$may	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set may='$may' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//---
							$may	=	$grand_bonus_basic1_ap; 
							$sqlstr = "update rpt_commision_reward_summary set may='$may' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$may	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set may='$may' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$may	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set may='$may' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
						if($month == 6) { 
							$juny	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set juny='$juny' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//---
							$juny	=	$grand_bonus_basic1_ap; 
							$sqlstr = "update rpt_commision_reward_summary set juny='$juny' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$juny	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set juny='$juny' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$juny	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set juny='$juny' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
						if($month == 7) { 
							$july	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set july='$july' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//---
							$july	=	$grand_bonus_basic1_ap; 
							$sqlstr = "update rpt_commision_reward_summary set july='$july' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$july	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set july='$july' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$july	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set july='$july' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
						if($month == 8) { 
							$august	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set august='$august' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//---
							$august	=	$grand_bonus_basic1_ap; 
							$sqlstr = "update rpt_commision_reward_summary set august='$august' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$august	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set august='$august' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$august	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set august='$august' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
						if($month == 9) { 
							$september	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set september='$september' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//---
							$september	=	$grand_bonus_basic1_ap; 
							$sqlstr = "update rpt_commision_reward_summary set september='$september' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$september	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set september='$september' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$september	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set september='$september' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
						if($month == 10) { 
							$october	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set october='$october' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//---
							$october	=	$grand_bonus_basic1_ap; 
							$sqlstr = "update rpt_commision_reward_summary set october='$october' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$october	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set october='$october' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$october	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set october='$october' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
						if($month == 11) { 
							$november	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set november='$november' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//---
							$november	=	$grand_bonus_basic1_ap; 
							$sqlstr = "update rpt_commision_reward_summary set november='$november' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$november	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set november='$november' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$november	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set november='$november' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
						if($month == 12) { 
							$december	=	$grand_bonus_basic_total; 
							$sqlstr = "update rpt_commision_reward_summary set december='$december' where type='Komisi' and name='Komisi Agen Basic'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//---
							$december	=	$grand_bonus_basic1_ap; 
							$sqlstr = "update rpt_commision_reward_summary set december='$december' where type='Komisi' and name='Komisi Prestasi'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$december	=	$grand_komisi_pembinaan_ap;
							$sqlstr = "update rpt_commision_reward_summary set december='$december' where type='Komisi' and name='Komisi Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
							
							//------
							$december	=	$grand_komisi_pembinaan_level1_ap;
							$sqlstr = "update rpt_commision_reward_summary set december='$december' where type='Komisi' and name='Royalti Pembinaan'";
							$sql2=$dbpdo->prepare($sqlstr);
							$sql2->execute();
						}
						
					}
					
					
					
			}
		}
		
				
		return $sql;
	}	
	
	
	//-----------get adta commision_reward_summary
	function get_commision_reward_summary_date($type='') {
		$dbpdo = DB::create();
		
		$sqlstr = "select id, type, name, january, february, march, april, may, juny, july, august, september, october, november, december from rpt_commision_reward_summary where type='$type' order by id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	
	//---------get data item
	function list_item_online_shop($kode =''){
		$dbpdo = DB::create();
			 	
		$where = " where b.name <> 'Pendaftaran' ";
		
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
			
			$from_date = date("Y-m-d", strtotime($from_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') >= '$from_date' ";
			}								
		}
		
		if ( $to_date != "") {
			
			$to_date = date("Y-m-d", strtotime($to_date));
			
			if ($where == "") {
				$where = " where date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			} else {
				$where = $where . " and date_format(a.dlu, '%Y-%m-%d') <= '$to_date' ";
			}								
		}
		
		if($all == 1) {
			$where = "";
		}
		
		$sqlstr="select a.code, a.old_code, a.name, a.item_group_id, b.name item_group_name, a.item_subgroup_id, a.item_type_code, a.item_category_id, a.brand_id, a.size_id, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, a.minimum_stock, a.maximum_stock, a.photo, a.consigned, a.balance, a.description, a.active, a.uid, a.dlu, a.syscode from item a left join item_group b on a.item_group_id=b.id " . $where . " order by a.code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data item
	function get_item_online_shop($client_code =''){
		$dbpdo = DB::create();
			 	
		$where = " where a.client_code = '$client_code' ";
		
		
		$sqlstr="select a.client_code, sum(b.amount) amount, sum(b.qty) qty from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref " . $where . " group by a.client_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data item
	function rpt_sales_summary($item_code ='', $month='', $year=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $item_code != "") {
			if ($where == "") {
				$where = " where a.client_code = '$item_code' ";
			} else {
				$where = $where . " and a.client_code = '$item_code' ";
			}								
		}
		
		if ( $month != "" && $year != "") {
			
			$month = $year . '-' . $month;
			$month = date("Y-m", strtotime($month));
			
			if ($where == "") {
				$where = " where date_format(a.date, '%Y-%m') = '$month' ";
			} else {
				$where = $where . " and date_format(a.date, '%Y-%m') = '$month' ";
			}								
		}
		
		if($item_code == '' && $year=='') {
			$where = " where a.ref = '' ";
		}		
		
		$sqlstr="select sum(b.qty) qty, b.unit_price, sum(b.amount) amount from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref " . $where . " group by a.client_code, date_format(a.date, '%Y-%m')";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data ietm form bincard2
	function rpt_item_bincard($item_code='', $uom_code='', $all = 0, $item_group_id=''){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(a.name,'') <> '' ";
		
		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where (a.syscode = trim('$item_code') or a.code = trim('$item_code') or a.old_code = trim('$item_code')) ";
			} else {
				$where = $where . " and (a.syscode = trim('$item_code') or a.code = trim('$item_code') or a.old_code = trim('$item_code')) ";
			}								
		}
		
		
		if ( $uom_code != "") {
			
			if ($where == "") {
				$where = " where a.uom_code_stock = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code_stock = '$uom_code' ";
			}								
		}
		
		if ( $item_group_id != "") {
			
			if ($where == "") {
				$where = " where a.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and a.item_group_id = '$item_group_id' ";
			}								
		}
		
		
		if($all != 0) {
			$where = " where ifnull(a.name,'') <> '' ";
		}
		
		$sqlstr="select distinct case when b.uom_code<>'' then b.uom_code else a.uom_code_stock end uom_code, a.syscode item_code, a.code, a.name item_name from item a left join (select distinct item_code, uom_code from bincard) b on a.syscode=b.item_code " . $where . " order by a.name";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data opnblc item form bincard
	function rpt_bincard_openblc_item($item_code='', $uom_code='', $location_id='', $date='', $all = 0){	
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $location_id != "" && $location_id != "0") {
			
			if ($where == "") {
				$where = " where a.location_code = '$location_id' ";
			} else {
				$where = $where . " and a.location_code = '$location_id' ";
			}								
		}
				
		
		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		}
		
		if ( $uom_code != "") {
			
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
        
        
        ##get date stock opname terakhir
        if($location_id == "" || $location_id != "0") {
            $sqlstr		= "select date from bincard where invoice_type='stockopname' and item_code='$item_code' and uom_code='$uom_code' order by date desc limit 1";
            $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
        } else {
            $sqlstr		= "select date from bincard where invoice_type='stockopname' and location_code='$location_id' and item_code='$item_code' and uom_code='$uom_code' order by date desc limit 1";
            $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
        }
		
        //echo $sqlstring."<br>";
		//$sqlstock		= mysql_query($sqlstring);
		$datadate		= $sql->fetch(PDO::FETCH_OBJ);
		$datebincard 	= $datadate->date;
		
		
		if ( $datebincard != "") {
			$datebincard = date("Y-m-d", strtotime($datebincard));
			if ($where == "") {
				$where = " where a.date >= '$datebincard' ";
			} else {
				$where = $where . " and a.date >= '$datebincard' ";
			}	
            
            if ( $date != "") {
				$date = str_replace(',', ' ', $date);
    			$date = date("Y-m-d", strtotime($date));
    			
    			if ($where == "") {
    				$where = " where a.date < '$date' ";
    			} else {
    				$where = $where . " and a.date < '$date' ";
    			}								
    		}
            
		} else {
            if ( $date != "") {
				$date = str_replace(',', ' ', $date);
    			$date = date("Y-m-d", strtotime($date));
    			
    			if ($where == "") {
    				$where = " where a.date < '$date' ";
    			} else {
    				$where = $where . " and a.date < '$date' ";
    			}		
    								
    		}
        }
		##-----------------
        
        if($all != 0) {
			$date = date("Y-m-d");
			
			$where = " where a.date < '$date' ";
		}
		
        $sqlstr = "select ifnull(sum(a.debit_qty) - sum(a.credit_qty),0) opnblc from bincard a left join item b on a.item_code=b.syscode " . $where . " group by a.item_code, a.uom_code ";
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
        //$sql=mysql_query($sqlstr);

		
		return $sql;
	}
	
	
	//---------get data bincard
	function rpt_bincard($item_code = '', $location_id = '', $uom_code = '', $date_from='', $date_to='', $all = 0){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(b.name,'') <> '' ";
		
		if ( $location_id != "") {
			
			if ($where == "") {
				$where = " where a.location_code = '$location_id' ";
			} else {
				$where = $where . " and a.location_code = '$location_id' ";
			}								
		}
		
		
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
		
		if($all != 0) {
			$where = " where ifnull(b.name,'') <> '' ";
			
		}
		
		/*if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code')) ";
			} else {
				$where = $where . " and (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code')) ";
			}								
		}*/
		
		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where (a.item_code = trim('$item_code')) ";
			} else {
				$where = $where . " and (a.item_code = trim('$item_code')) ";
			}								
		}
		
		if ( $uom_code != "") {
		
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
		
		$sqlstr="select a.invoice_no, a.date, a.invoice_type, a.description, a.uom_code, a.debit_qty, a.credit_qty, b.name item_name, a.item_code, a.location_code, c.name location_name from bincard a left join item b on a.item_code=b.syscode left join warehouse c on a.location_code=c.id " . $where . " order by a.date, a.dlu";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get data purchase invoice last unit cost
	function list_purchase_invoice_last_cost($item_code='', $uom_code=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $item_code != "") {
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		}
		
		if ( $uom_code != "") {
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
		
		$sqlstr="select a.ref, b.date, a.item_code, a.uom_code, a.qty, ifnull(a.unit_cost,0) unit_cost, a.amount, a.line_item_po, a.line, b.dlu from purchase_invoice_detail a left join purchase_invoice b on a.ref=b.ref " . $where . " order by b.dlu desc, a.line desc limit 1 ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();			
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$current_cost = $data->unit_cost;
		
		if($current_cost == 0) {
			$sqlstr = "select ifnull(a.current_cost,0) current_cost from set_item_cost a " . $where . " order by a.date_of_record desc limit 1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$current_cost = $data->current_cost;
		}
		
		
		return $current_cost;
	}
	
	
	//---------get data bincard (stock opname only)
	function rpt_bincard_stok_opname($item_code = '', $location_id = '', $uom_code = '', $date_from='', $all = 0){
		$dbpdo = DB::create();
			 	
		$where = " where ifnull(b.name,'') <> '' and a.invoice_type='stockopname' ";
		
		if ( $location_id != "") {
			
			if ($where == "") {
				$where = " where a.location_code = '$location_id' ";
			} else {
				$where = $where . " and a.location_code = '$location_id' ";
			}								
		}
		
		
		if ( $date_from != "") {
			$date_from = str_replace(',', ' ', $date_from);
			$date_from = date("Y-m-d", strtotime($date_from));
			
			if ($where == "") {
				$where = " where a.date = '$date_from' ";
			} else {
				$where = $where . " and a.date = '$date_from' ";
			}								
		}
		
		/*if ( $date_to != "") {
			
			$date_to = date("Y-m-d", strtotime($date_to));
			
			if ($where == "") {
				$where = " where a.date <= '$date_to' ";
			} else {
				$where = $where . " and a.date <= '$date_to' ";
			}								
		}*/
		
		if($all != 0) {
			$where = " where ifnull(b.name,'') <> '' ";
			
		}
		
		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code')) ";
			} else {
				$where = $where . " and (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code')) ";
			}								
		}
		
		if ( $uom_code != "") {
		
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
		
		$sqlstr="select sum(a.debit_qty) - sum(a.credit_qty) qty from bincard a left join item b on a.item_code=b.syscode left join warehouse c on a.location_code=c.id " . $where . " group by b.name, a.date, a.item_code, b.code, b.old_code, a.uom_code, a.invoice_type, a.location_code order by a.date, a.dlu asc";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	
	//---------get item cost
	function get_item_cost($location_id, $item_code, $month='', $year=''){	 
		
		$dbpdo = DB::create();
			
		$where = " where a.invoice_type='stockopname' ";
		
		if ( $location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}								
		}
		
		if ( $item_code != "") {
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		}
		
		if ( $month != "" && $year == "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%m') <= '$month' ";
			} else {
				$where = $where . " and date_format(a.date,'%m') <= '$month' ";
			}								
		}
		
		if ( $month == "" && $year != "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%Y') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y') <= '$year' ";
			}								
		}
		
		if ( $month != "" && $year != "") {
			
			$year = $year . "-" . $month;
			
			if ($where == "") {
				$where = " where date_format(a.date,'%Y-%m') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y-%m') <= '$year' ";
			}								
		}
		
		if($location_id=='' && $item_code=='' && $month=='' && $year=='') {
			$where = " where a.item_code = 'ndf'";
		}
		
		$sqlstr="select a.unit_price from bincard a " . $where . " order by a.date desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get item cost
	function get_item_cost_price($location_id, $item_code, $month='', $year=''){	 
		
		$dbpdo = DB::create();
			
		$where = "";
		
		if ( $location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}								
		}
		
		if ( $item_code != "") {
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		}
		
		if ( $month != "" && $year == "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%m') <= '$month' ";
			} else {
				$where = $where . " and date_format(a.date,'%m') <= '$month' ";
			}								
		}
		
		if ( $month == "" && $year != "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%Y') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y') <= '$year' ";
			}								
		}
		
		if ( $month != "" && $year != "") {
			
			$year = $year . "-" . $month;
			
			if ($where == "") {
				$where = " where date_format(a.date,'%Y-%m') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y-%m') <= '$year' ";
			}								
		}
		
		if($location_id=='' && $item_code=='' && $month=='' && $year=='') {
			$where = " where a.item_code = 'ndf'";
		}
		
		$sqlstr="select a.date, a.efective_from, a.item_code, a.uom_code, a.current_price, a.current_price1, a.current_price2, a.current_price3, a.tax_rate, a.price_tax, a.price_member_tax, a.margin_warehouse, a.margin_mlm, a.registration_rate, a.registration_rate_platinum, a.last_price, a.date_of_record, a.location_id, a.qty1, a.uid, a.dlu from set_item_price a " . $where . " order by a.date_of_record desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data stock
	function rpt_stock($item_code='', $location_id='', $uom_code='', $all = 0, $item_group_id='', $item_subgroup_id='', $date_from='', $date_to='', $month='', $year=''){	 	
		
		$dbpdo = DB::create();
		
		$where = " where ifnull(b.name,'') <> '' ";
		
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
				$where = " where (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code'))  ";
			} else {
				$where = $where . " and (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code')) ";
			}								
		}
		
		if ( $location_id != "") {
			
			if ($where == "") {
				$where = " where a.location_code = '$location_id' ";
			} else {
				$where = $where . " and a.location_code = '$location_id' ";
			}								
		}
		
		if ( $uom_code != "") {
			
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
		
		
		if ( $item_group_id != "") {
			
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		if ( $item_subgroup_id != "") {
			
			if ($where == "") {
				$where = " where b.item_subgroup_id = '$item_subgroup_id' ";
			} else {
				$where = $where . " and b.item_subgroup_id = '$item_subgroup_id' ";
			}								
		}
		
		//-----------
		if ( $month != "" && $year == "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%m') <= '$month' ";
			} else {
				$where = $where . " and date_format(a.date,'%m') <= '$month' ";
			}								
		}
		
		if ( $month == "" && $year != "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%Y') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y') <= '$year' ";
			}								
		}
		
		if ( $month != "" && $year != "") {
			
			$year = $year . "-" . $month;
			
			if ($where == "") {
				$where = " where date_format(a.date,'%Y-%m') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y-%m') <= '$year' ";
			}								
		}
		//--------------
		
		if($all != 0) {
			$where = " where ifnull(b.name,'') <> '' ";
		}
		
		
        $sqlstr="select a.item_code, b.code, b.name, a.uom_code, a.location_code, c.name location_name, b.item_group_id, b.item_subgroup_id, sum(ifnull(a.debit_qty,0)) debit_qty, sum(ifnull(a.credit_qty,0)) credit_qty, sum(ifnull(a.debit_qty,0)) - sum(ifnull(a.credit_qty,0)) qty from bincard a left join item b on a.item_code=b.syscode left join warehouse c on a.location_code=c.id " . $where . " group by a.item_code, a.uom_code, a.location_code, b.item_group_id, b.item_subgroup_id, b.name, b.old_code, b.code having sum(ifnull(a.debit_qty,0)) - sum(ifnull(a.credit_qty,0)) <> 0 order by b.name";
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
		
	}
	
	
	//---------get data stock cek stok opname
	function rpt_stock_stock_opname_limit1($item_code='', $location_id='', $uom_code='', $all = 0, $item_group_id='', $item_subgroup_id='', $date_from='', $date_to='', $type='', $month = '', $year = ''){	 	
		
		$dbpdo = DB::create();
		
		if($type == "stockopname") {
			$where = " where ifnull(b.name,'') <> '' and a.invoice_type='stockopname' ";
		} else {
			$where = " where ifnull(b.name,'') <> ''";
		}
		
		
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
        
        
        //-----------
		if ( $month != "" && $year == "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%m') <= '$month' ";
			} else {
				$where = $where . " and date_format(a.date,'%m') <= '$month' ";
			}								
		}
		
		if ( $month == "" && $year != "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%Y') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y') <= '$year' ";
			}								
		}
		
		if ( $month != "" && $year != "") {
			
			$year = $year . "-" . $month;
			
			if ($where == "") {
				$where = " where date_format(a.date,'%Y-%m') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y-%m') <= '$year' ";
			}								
		}
		//--------------
		
        
		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code'))  ";
			} else {
				$where = $where . " and (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code')) ";
			}								
		}
		
		if ( $location_id != "") {
			
			if ($where == "") {
				$where = " where a.location_code = '$location_id' ";
			} else {
				$where = $where . " and a.location_code = '$location_id' ";
			}								
		}
		
		if ( $uom_code != "") {
			
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
		
		
		if ( $item_group_id != "") {
			
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		if ( $item_subgroup_id != "") {
			
			if ($where == "") {
				$where = " where b.item_subgroup_id = '$item_subgroup_id' ";
			} else {
				$where = $where . " and b.item_subgroup_id = '$item_subgroup_id' ";
			}								
		}
		
		
		if($all != 0) {
			$where = " where ifnull(b.name,'') <> '' ";
		}
		
		
        ##cek stok opname (jika ada maka query yg dipakai query ini)
		$sqlstr = "select a.invoice_type from bincard a left join item b on a.item_code=b.syscode ". $where ." order by a.date desc, a.dlu desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		
		return $sql;
		
	}
	
	
	//---------get data stock cek stok opname
	function rpt_check_stock_opname($item_code='', $location_id='', $uom_code='', $all = 0, $item_group_id='', $item_subgroup_id='', $date_from='', $date_to='', $month='', $year=''){	 	
		
		$dbpdo = DB::create();
		
		$where = " where ifnull(b.name,'') <> '' and (ifnull(a.debit_qty,0) - ifnull(a.credit_qty,0) <> 0) and a.invoice_type='stockopname'";
		
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
        
        
        //-----------
		if ( $month != "" && $year == "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%m') <= '$month' ";
			} else {
				$where = $where . " and date_format(a.date,'%m') <= '$month' ";
			}								
		}
		
		if ( $month == "" && $year != "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%Y') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y') <= '$year' ";
			}								
		}
		
		if ( $month != "" && $year != "") {
			
			$year = $year . "-" . $month;
			
			if ($where == "") {
				$where = " where date_format(a.date,'%Y-%m') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y-%m') <= '$year' ";
			}								
		}
		//--------------
		
		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code'))  ";
			} else {
				$where = $where . " and (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code')) ";
			}								
		}
		
		if ( $location_id != "") {
			
			if ($where == "") {
				$where = " where a.location_code = '$location_id' ";
			} else {
				$where = $where . " and a.location_code = '$location_id' ";
			}								
		}
		
		if ( $uom_code != "") {
			
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
		
		
		if ( $item_group_id != "") {
			
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		if ( $item_subgroup_id != "") {
			
			if ($where == "") {
				$where = " where b.item_subgroup_id = '$item_subgroup_id' ";
			} else {
				$where = $where . " and b.item_subgroup_id = '$item_subgroup_id' ";
			}								
		}
		
		
		if($all != 0) {
			$where = " where ifnull(b.name,'') <> '' ";
		}
		
		
        ##cek stok opname (jika ada maka query yg dipakai query ini)
        $sqlstr2="select a.date, a.item_code, b.code, b.name, a.uom_code, a.location_code, c.name location_name, ifnull(a.debit_qty,0) debit_qty, ifnull(a.credit_qty,0) credit_qty, ifnull(a.debit_qty,0) - ifnull(a.credit_qty,0) qty, a.unit_price from bincard a left join item b on a.item_code=b.syscode left join warehouse c on a.location_code=c.id " . $where . " order by a.date desc, a.dlu desc limit 1";
        
		/*$sqlstr2="select a.item_code, b.code, b.name, a.uom_code, a.location_code, c.name location_name, sum(ifnull(a.debit_qty,0)) debit_qty, sum(ifnull(a.credit_qty,0)) credit_qty, sum(ifnull(a.debit_qty,0)) - sum(ifnull(a.credit_qty,0)) qty from bincard a left join item b on a.item_code=b.syscode left join warehouse c on a.location_code=c.id " . $where . " group by a.date, a.item_code, a.uom_code, a.location_code, b.item_group_id, b.item_subgroup_id, b.name, b.old_code, b.code, a.invoice_type having sum(ifnull(a.debit_qty,0)) - sum(ifnull(a.credit_qty,0)) <> 0 and a.invoice_type='stockopname' order by b.name";*/
		$sql=$dbpdo->prepare($sqlstr2);
		$sql->execute();
		##----------------/\--------------------
		
		
		return $sql;
		
	}
	
	
	//---------get data stock 
	function rpt_stock_non_so($item_code='', $location_id='', $uom_code='', $all = 0, $item_group_id='', $item_subgroup_id='', $date_from='', $date_to='', $month='', $year=''){	 	
		
		$dbpdo = DB::create();
		
		$where = " where ifnull(b.name,'') <> '' ";
		
        if ( $date_from != "") {
			$date_from = str_replace(',', ' ', $date_from);
            $date_from = date("Y-m-d", strtotime($date_from));
            
			if ($where == "") {
				$where = " where a.date > '$date_from' ";
			} else {
				$where = $where . " and a.date > '$date_from' ";
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
        
        
        //-----------
		if ( $month != "" && $year == "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%m') <= '$month' ";
			} else {
				$where = $where . " and date_format(a.date,'%m') <= '$month' ";
			}								
		}
		
		if ( $month == "" && $year != "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%Y') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y') <= '$year' ";
			}								
		}
		
		if ( $month != "" && $year != "") {
			
			$year = $year . "-" . $month;
			
			if ($where == "") {
				$where = " where date_format(a.date,'%Y-%m') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y-%m') <= '$year' ";
			}								
		}
		//--------------
		
		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code'))  ";
			} else {
				$where = $where . " and (a.item_code = trim('$item_code') or b.code = trim('$item_code') or b.old_code = trim('$item_code')) ";
			}								
		}
		
		if ( $location_id != "") {
			
			if ($where == "") {
				$where = " where a.location_code = '$location_id' ";
			} else {
				$where = $where . " and a.location_code = '$location_id' ";
			}								
		}
		
		if ( $uom_code != "") {
			
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
		
		
		if ( $item_group_id != "") {
			
			if ($where == "") {
				$where = " where b.item_group_id = '$item_group_id' ";
			} else {
				$where = $where . " and b.item_group_id = '$item_group_id' ";
			}								
		}
		
		if ( $item_subgroup_id != "") {
			
			if ($where == "") {
				$where = " where b.item_subgroup_id = '$item_subgroup_id' ";
			} else {
				$where = $where . " and b.item_subgroup_id = '$item_subgroup_id' ";
			}								
		}
		
		
		if($all != 0) {
			$where = " where ifnull(b.name,'') <> '' ";
		}
		
		
        $sqlstr="select a.item_code, b.code, b.name, a.uom_code, a.location_code, c.name location_name, b.item_group_id, b.item_subgroup_id, sum(ifnull(a.debit_qty,0)) debit_qty, sum(ifnull(a.credit_qty,0)) credit_qty, sum(ifnull(a.debit_qty,0)) - sum(ifnull(a.credit_qty,0)) qty from bincard a left join item b on a.item_code=b.syscode left join warehouse c on a.location_code=c.id " . $where . " group by a.item_code, a.uom_code, a.location_code, b.item_group_id, b.item_subgroup_id, b.name, b.old_code, b.code having sum(ifnull(a.debit_qty,0)) - sum(ifnull(a.credit_qty,0)) <> 0 order by b.name";
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
		
	}
	
	//---------get_komisi_platinum
	function get_komisi_platinum($month='', $year=''){	 
		
		$dbpdo = DB::create();
			
		$where = "";
		$group_by = "";
		
		if ( $month != "" && $year == "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%m') <= '$month' ";
			} else {
				$where = $where . " and date_format(a.date,'%m') <= '$month' ";
			}	
			
			$group_by = " group by date_format(a.date,'%m') ";							
		}
		
		if ( $month == "" && $year != "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%Y') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y') <= '$year' ";
			}		
			
			$group_by = " group by date_format(a.date,'%Y') ";						
		}
		
		if ( $month != "" && $year != "") {
			
			$year = $year . "-" . $month;
			
			if ($where == "") {
				$where = " where date_format(a.date,'%Y-%m') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y-%m') <= '$year' ";
			}		
			
			$group_by = " group by date_format(a.date,'%Y-%m') ";						
		}
		
		
		$sqlstr="select sum(a.komisi_prestasi) komisi_prestasi, sum(a.komisi_pembinaan) komisi_pembinaan, sum(a.royalti_pembinaan) royalti_pembinaan from sms_komisi_agen_platinum a " . $where . $group_by . " order by a.date";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get_komisi_reward
	function get_komisi_reward($month='', $year=''){	 
		
		$dbpdo = DB::create();
			
		$where = "";
		$group_by = "";
		
		if ( $month != "" && $year == "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%m') <= '$month' ";
			} else {
				$where = $where . " and date_format(a.date,'%m') <= '$month' ";
			}	
			
			$group_by = " group by date_format(a.date,'%m') ";							
		}
		
		if ( $month == "" && $year != "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%Y') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y') <= '$year' ";
			}		
			
			$group_by = " group by date_format(a.date,'%Y') ";						
		}
		
		if ( $month != "" && $year != "") {
			
			$year = $year . "-" . $month;
			
			if ($where == "") {
				$where = " where date_format(a.date,'%Y-%m') <= '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y-%m') <= '$year' ";
			}		
			
			$group_by = " group by date_format(a.date,'%Y-%m') ";						
		}
		
		
		$sqlstr="select sum(a.komisi_basic) komisi_basic, sum(a.komisi_prestasi) komisi_prestasi, sum(a.komisi_pembinaan) komisi_pembinaan, sum(a.royalti_pembinaan) royalti_pembinaan, sum(a.ro_pribadi) ro_pribadi, sum(a.ro_generasi) ro_generasi, sum(a.ro_royalti) ro_royalti, sum(a.reward) reward from sms_komisi_reward a " . $where . $group_by . " order by a.date";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get_client_deposit
	function rpt_cash_client_deposit($month='', $year=''){	 
		
		$dbpdo = DB::create();
			
		$where = " where a.receipt_type='Tunai' ";
		
		if ( $month != "" && $year == "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%m') = '$month' ";
			} else {
				$where = $where . " and date_format(a.date,'%m') = '$month' ";
			}	
			
			$group_by = " group by date_format(a.date,'%m') ";							
		}
		
		if ( $month == "" && $year != "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%Y') = '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y') = '$year' ";
			}		
			
			$group_by = " group by date_format(a.date,'%Y') ";						
		}
		
		if ( $month != "" && $year != "") {
			
			$year1 = $year . "-" . $month;
			
			if ($where == "") {
				$where = " where date_format(a.date,'%Y-%m') = '$year1' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y-%m') = '$year1' ";
			}		
			
			$group_by = " group by date_format(a.date,'%Y-%m') ";						
		}
		
		if ($year=='') {
			$where = " where a.receipt_type='ndf' ";
		}
		
		$sqlstr="select sum(a.current_balance) saldo from client_deposit a " . $where . $group_by . " order by a.date";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get_client_deposit bank
	function rpt_cash_client_deposit_bank($month='', $year='', $bank_id=''){	 
		
		$dbpdo = DB::create();
			
		$where = " where a.receipt_type='Transfer' ";
		
		if ( $month != "" && $year == "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%m') = '$month' ";
			} else {
				$where = $where . " and date_format(a.date,'%m') = '$month' ";
			}	
			
			$group_by = " group by date_format(a.date,'%m') ";							
		}
		
		if ( $month == "" && $year != "") {
			if ($where == "") {
				$where = " where date_format(a.date,'%Y') = '$year' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y') = '$year' ";
			}		
			
			$group_by = " group by date_format(a.date,'%Y') ";						
		}
		
		if ( $month != "" && $year != "") {
			
			$year1 = $year . "-" . $month;
			
			if ($where == "") {
				$where = " where date_format(a.date,'%Y-%m') = '$year1' ";
			} else {
				$where = $where . " and date_format(a.date,'%Y-%m') = '$year1' ";
			}		
			
			$group_by = " group by date_format(a.date,'%Y-%m') ";						
		}
		
		if ( $bank_id != "") {
			if ($where == "") {
				$where = " where a.bank_id = '$bank_id' ";
			} else {
				$where = $where . " and a.bank_id = '$bank_id' ";
			}	
			
			$group_by = " group by a.bank_id, date_format(a.date,'%m') ";							
		}
		
		if ($year=='') {
			$where = " where a.receipt_type='ndf' ";
		}
		
		$sqlstr="select sum(a.current_balance) saldo from client_deposit a " . $where . $group_by . " order by a.date";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------set decimal harga
	function item_decimal($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select ifnull(a.scala,0) scala from item a where a.syscode='$id' limit 1 ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$scala = $data->scala;
				
		return $scala;
	}
	
	//---------get data cash invoice
	function list_cash_invoice($kode ='', $all=0, $act=''){	
		$dbpdo = DB::create();
		 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.top, a.client_code, b.name client_name, b.phone, a.ship_to, a.bill_to, a.tax_code, a.tax_rate, a.freight_cost, a.freight_account, a.currency_code, a.rate, a.employee_id, a.total, a.memo, a.opening_balance, a.cash, a.location_id, ifnull(a.deposit,0) deposit, a.discount, a.cash_amount, a.cash_voucher, a.change_amount, (case when ifnull(a.expedition_name,'')='' then c.name else a.expedition_name end) expedition_name, a.paid, a.print, a.process_whs, a.onshipped, a.shipped, a.note_transfer, a.note_ecommerce, a.uid, a.dlu from sales_invoice a left join client b on a.client_code=b.syscode left join expedition c on a.expedition_id=c.id " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------cash invoice detail (saat update)
	function list_cash_invoice_detail($id='', $posisi=0, $batas=0) {
		$dbpdo = DB::create();
		
		if($batas > 0) {
			$limit = " limit $posisi, $batas";
		}
				
		$sqlstr="select a.ref, a.do_ref, a.so_ref, a.return_ref, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.qty_shp, a.discount, a.unit_price, a.unit_price2, a.amount, a.amount2, a.dummy, a.line_item_do, a.line_item_so, a.line from sales_invoice_detail a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line " . $limit;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data purchase invoice last discount
	function list_purchase_invoice_last_discount($item_code='', $uom_code=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $item_code != "") {
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		}
		
		if ( $uom_code != "") {
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
		
		$sqlstr="select a.item_code, a.uom_code, a.qty, a.unit_cost, a.discount1, a.discount, b.tax_rate from purchase_invoice_detail a left join purchase_invoice b on a.ref=b.ref " . $where . " order by b.dlu desc, a.line desc limit 1 ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();			
		
		return $sql;
	}
	
	
	function get_total_so($ref) {
		$dbpdo = DB::create();
		
		$sqlstr = "select sum(ifnull(a.qty,0)) total_so from sales_order_detail a where ref='$ref' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
		
	}
	
	//-----------outbound detail (item group)
	function list_outbound_detail_itemgroup($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select distinct b.item_group_id, c.name item_group from sales_invoice_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id' order by c.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------otb detail (item group)
	function list_otb_detail_itemgroup($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select distinct b.item_group_id, c.name item_group from outbound_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id' order by c.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------delord detail (item group)
	function list_delivery_order_detail_itemgroup($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select distinct b.item_group_id, c.name item_group from delivery_order_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id' order by c.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data delivery orser
	function list_delivery_order($kode ='', $from_date='', $to_date='', $all=''){
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
		
		$sqlstr="select a.ref, a.date, a.status, a.location_id, a.ship_to, a.po_number, a.client_code, a.memo, a.uid, a.dlu, b.name client_name, a.delivered, c.name location_name, b.address, b.kabupaten, b.kecamatan, b.zip_code, b.phone, d.nama nama_kota, e.nama nama_kecamatan, (select case when ifnull(y.expedition_name,'')='' then z.name else y.expedition_name end from delivery_order_detail x left join sales_invoice y on x.so_ref=y.ref left join expedition z on y.expedition_id=z.id where x.ref=a.ref limit 1) expedition_name from delivery_order a left join client b on a.client_code=b.syscode left join warehouse c on a.location_id=c.id left join kota d on b.kabupaten=d.syscode left join kecamatan e on b.kecamatan=e.syscode  " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	//-----------sales delivery detail (saat update)
	function list_delivery_order_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.so_ref, a.item_code, b.code, b.old_code, b.name item_name, a.uom_code, a.qty, a.ship_date, a.line_item_so, a.line, c.delivered from delivery_order_detail a left join item b on a.item_code=b.syscode left join delivery_order c on a.ref=c.ref where a.ref='$id' order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//-----------pch ivi detail (item group)
	function list_purchase_invoice_detail_itemgroup($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select distinct b.item_group_id, c.name item_group from purchase_invoice_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id' order by c.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}			
	
	
	//-----------purchase invoice detail (saat update)
	function list_purchase_invoice_detail($id='', $item_group_id='') {
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
		
		$sqlstr="select a.ref, a.po_ref, a.item_code, a.uom_code, a.size, a.qty, ifnull(a.qty,0)-ifnull(a.qty_good,0) qty_po, a.unit_cost, a.discount1, a.discount2, a.discount3, a.discount, a.amount, a.line_item_po, a.line, b.code, b.name item_name from purchase_invoice_detail a left join item b on a.item_code=b.syscode ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------purchase invoice detail (saat update)
	function get_purchase_invoice_detail_outstanding($id='', $item_group_id='') {
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.qty,0)-ifnull(a.qty_good,0) > 0";
		
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
		
		$sqlstr="select a.ref, a.po_ref, a.item_code, a.uom_code, a.size, a.qty, ifnull(a.qty,0)-ifnull(a.qty_good,0) qty_po, a.unit_cost, a.discount1, a.discount2, a.discount3, a.discount, a.amount, a.line_item_po, a.line, b.code, b.name item_name from purchase_invoice_detail a left join item b on a.item_code=b.syscode ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------pch ivi detail (item group)
	function list_good_receipt_detail_itemgroup($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select distinct b.item_group_id, c.name item_group from good_receipt_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id' order by c.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	function get_total_sewing($ref) {
		$dbpdo = DB::create();
		
		$sqlstr = "select sum(ifnull(a.qty,0)) total_sewing from sewing_detail a where ref='$ref' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
		
	}
	
	
	//-----------sewing detail outstanding
	function get_sewing_detail_outstanding($id='', $item_group_id='') {
		$dbpdo = DB::create();
		
		$where = " where ifnull(a.qty,0)-ifnull(a.qty_good,0) > 0";
		
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
		
		$sqlstr="select a.ref, a.item_code, a.uom_code, a.size, a.qty, ifnull(a.qty,0)-ifnull(a.qty_good,0) qty_po, a.unit_cost, a.discount1, a.discount2, a.amount, a.line, b.code, b.name item_name from sewing_detail a left join item b on a.item_code=b.syscode ".$where." order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//-----------sewing detail (item group)
	function list_sewing_detail_itemgroup($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select distinct b.item_group_id, c.name item_group from sewing_detail a left join item b on a.item_code=b.syscode left join item_group c on b.item_group_id=c.id where a.ref='$id' order by c.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//----------Report AP Outstanding
	function rpt_ap_outstanding($date_from = '', $date_to = '', $all = 0, $vendor_code='') {
		$dbpdo = DB::create();
		
		$where = "";
		
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
		
		if ( $vendor_code != "") {
			
			if ($where == "") {
				$where = " where a.contact_code = '$vendor_code' ";
			} else {
				$where = $where . " and a.contact_code = '$vendor_code' ";
			}								
		}
		
		if($all != 0) {
			$where = "";
		}
		
		$sqlstr="select a.invoice_no, a.date, a.contact_code, b.name vendor_name, sum(a.debit_amount) debit_amount, sum(a.credit_amount) credit_amount, sum(a.credit_amount) - sum(a.debit_amount) amount, c.tax_rate, (select sum(aa.amount) from purchase_invoice_detail aa group by aa.ref having aa.ref=a.ref) amount_total from ap a left join vendor b on a.contact_code=b.syscode left join purchase_invoice c on a.ref=c.ref " . $where . " group by a.contact_code, a.invoice_no having sum(a.credit_amount) - sum(a.debit_amount) <> 0 and ifnull(b.name,'') <> '' order by b.name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//----------Report AR Outstanding
	function rpt_ar_outstanding($date_from = '', $date_to = '', $contact_code = '', $all = 0, $so_no='') {
		$dbpdo = DB::create();
		
		$where = "";
		
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
		
		if ( $contact_code != "") {
			
			if ($where == "") {
				$where = " where a.client_code = '$contact_code' ";
			} else {
				$where = $where . " and a.client_code = '$contact_code' ";
			}								
		}
		
		if ( $so_no != "") {
			
			if ($where == "") {
				$where = " where b.ref2 = '$so_no' ";
			} else {
				$where = $where . " and b.ref2 = '$so_no' ";
			}								
		}
		
		
		if($date_from == "" && $date_to == "" && $contact_code == "" && $all == "" && $so_no == "") {
			$where = " where c.ref = 'ndf' ";
		}
		
		if($all != 0) {
			$where = "";
		}
		
		//sum(a.debit_amount) - sum(a.credit_amount) <> 0 and
		$sqlstr="select aa.* from (select a.invoice_no, a.date, a.due_date, b.name client_name, a.contact_code, sum(a.debit_amount) debit_amount, sum(a.credit_amount) credit_amount, sum(a.debit_amount) - sum(a.credit_amount) amount from ar a left join client b on a.contact_code=b.syscode " . $where . " group by a.contact_code, a.invoice_no having ifnull(b.name,'') <> '') aa " . $where2 . " order by aa.date, aa.client_name ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data Payment
	function list_payment($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.vendor_code, a.payment_type, a.cheque_no, a.cheque_date, a.bank_name, a.credit_card_no, a.credit_card_code, a.credit_card_holder, a.credit_card_expired, a.account_code, a.currency_code, a.rate, a.amount, a.deposit, a.sub_total, a.type, a.memo, a.round_amount, a.round_amount_account, a.bank_charge, a.bank_charge_account, a.opening_balance, a.total, a.no_ttfa, a.uid, a.dlu, b.name contact_name, b.address, b.phone from payment a left join vendor b on a.vendor_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		return $sql;
	}
	
	
	//----------list_payment_detail
	function list_payment_detail($id='', $posisi=0, $batas=0) {
		$dbpdo = DB::create();
		
		if($batas > 0) {
			$limit = " limit $posisi, $batas";
		}
				
		$sqlstr="select a.ref, a.invoice_no, b.invoice_no no_nota, a.invoice_date, a.invoice_due_date, a.invoice_currency_code, a.invoice_rate, a.amount_due, a.discount, a.amount_paid, a.ref_type invoice_type, a.amount, a.line from payment_detail a left join purchase_invoice b on a.invoice_no=b.ref where a.ref='$id' order by a.line " . $limit ;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data warehouse
	function list_warehouse($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.code = '$kode' ";
			} else {
				$where = $where . " and a.code = '$kode' ";
			}								
		}

		$sqlstr="select a.id, a.code, a.name, a.address, a.email, a.phone, a.active, a.uid, a.dlu from warehouse a " . $where . " order by a.id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}
	
	//----------Report Receipt Total
	function rpt_receipt_total($invoice_no='') {
		$dbpdo = DB::create();
		
		$where = "";
		
		if ( $invoice_no != "") {
			
			if ($where == "") {
				$where = " where a.invoice_no = '$invoice_no' ";
			} else {
				$where = $where . " and a.invoice_no = '$invoice_no' ";
			}								
		}
		
		$sqlstr="select a.debit_amount from ar a " . $where . " order by a.date, a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//----------Report Receipt History
	function rpt_receipt_history($invoice_no='') {
		$dbpdo = DB::create();
		
		$where = " where ifnull(b.name,'') <> '' and (a.invoice_type = 'RCI') ";
		
		if ( $invoice_no != "") {
			
			if ($where == "") {
				$where = " where a.invoice_no = '$invoice_no' ";
			} else {
				$where = $where . " and a.invoice_no = '$invoice_no' ";
			}								
		}
		
		$sqlstr="select a.ref, a.invoice_no, a.date, b.name client_name, a.credit_amount from ar a left join  (select id code, concat(name, ' ( ','Employee',' )') name, 'E' type from employee where active=1 union all  select syscode code, name, 'C' type from client where active=1 and ifnull(name,'') <> '' ) b on a.contact_code=b.code left join receipt c on a.ref=c.ref " . $where . " order by a.date, a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data Receipt
	function list_receipt($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.ref = '$kode' ";
			} else {
				$where = $where . " and a.ref = '$kode' ";
			}								
		}
		
		$sqlstr="select a.ref, a.date, a.status, a.client_code, a.receipt_type, a.cheque_no, a.cheque_date, a.bank_name, a.credit_card_no, a.credit_card_code, a.credit_card_holder, a.credit_card_expired, a.account_code, a.currency_code, a.rate, a.amount, a.deposit, a.sub_total, a.type, a.memo, a.round_amount, a.round_amount_account, a.bank_charge, a.bank_charge_account, a.opening_balance, a.total, a.uid, a.dlu, b.name contact_name, b.address, b.phone from receipt a left join client b on a.client_code=b.syscode " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		return $sql;
	}
	
	
	//----------list_direct_receipt_detail
	function list_receipt_detail($id='', $posisi=0, $batas=0) {
		$dbpdo = DB::create();
		
		if($batas > 0) {
			$limit = " limit $posisi, $batas";
		}
				
		$sqlstr="select a.ref, a.invoice_no, a.invoice_date, a.invoice_due_date, a.invoice_currency_code, a.invoice_rate, a.amount_due, a.discount, a.amount_paid, a.ref_type invoice_type, a.amount, a.line from receipt_detail a where a.ref='$id' order by a.line " . $limit ;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//----------get no invoice
	function get_no_ref_quick_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select distinct a.so_ref, ifnull(b.cash,0) cash from delivery_order_detail a left join sales_invoice b on a.so_ref=b.ref where a.ref='$id' order by a.so_ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data purchase inv
	function list_purchase_inv($kode ='', $from_date='', $to_date='', $vendor_code='', $all=0){
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
	
	//-----------purchase_inv detail (saat update)
	function list_purchase_inv_detail($id) {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.po_ref, a.item_code, b.code item_code2, b.name item_name, a.uom_code, a.size, a.qty, ifnull(a.qty_good,0) qty_good, a.unit_cost, a.discount1, a.discount2, a.discount3, a.discount4, a.discount, a.amount, a.line_item_po, a.line from purchase_invoice_detail a left join item b on a.item_code=b.syscode where a.ref='$id' order by a.line desc ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---------get data balance sheet
	function list_coa_balance_sheet($code=''){
		$dbpdo = DB::create();
				
		$sqlstr= "select a.acc_code, a.name, a.syscode from coa a where a.acc_code like '$code%' order by a.acc_code";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data profit loss
	function profit_loss_sales($from_date='', $to_date='', $location_id=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		$from_date = "2019-01-01";
		
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
		
		if($location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}
		}
		
		$sqlstr= "select a.location_id, b.name location_name, sum(a.total) total from sales_invoice a left join warehouse b on a.location_id=b.id " . $where . " group by a.location_id order by a.location_id";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//----------Sales Journal
	function journal_sales_invoice_credit($date_from = '', $date_to = '', $contact_code = '', $all = 0) {
		$dbpdo = DB::create();
		
		$where = "";
		
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
		
		if ( $contact_code != "") {
			
			if ($where == "") {
				$where = " where a.client_code = '$contact_code' ";
			} else {
				$where = $where . " and a.client_code = '$contact_code' ";
			}								
		}
		
		if($date_from == "" && $date_to == "" && $contact_code == "" && $all == "") {
			$where = " where c.ref = 'ndf' ";
		}
		
		if($all != 0) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, b.name client_name, a.total debit from sales_invoice a left join client b on a.client_code=b.syscode ".$where." order by a.date, a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//----------Sales Journal deail
	function journal_sales_invoice_detail_credit($ref) {
		$dbpdo = DB::create();
		
		$sqlstr="select sum(b.amount) credit from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where a.ref='$ref' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	function journal_account($location_id='', $trans_name='', $column_name='', $type='debit') {
		$dbpdo = DB::create();
		
		$where = " where a.trans_name='$trans_name' and a.column_name='$column_name'";
		
		if ( $location_id != "") {
			
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}								
		}
		
		if($type == 'debit') {
			$sqlstr="select b.acc_code, b.name acc_name from set_journal a left join coa b on a.account_code_debit=b.syscode " . $where . " order by a.id ";	
		}
		if($type == 'credit') {
			$sqlstr="select b.acc_code, b.name acc_name from set_journal a left join coa b on a.account_code_credit=b.syscode " . $where . " order by a.id ";
		}		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//----------Purchase Journal
	function journal_purchase_invoice_credit($date_from = '', $date_to = '', $contact_code = '', $all = 0) {
		$dbpdo = DB::create();
		
		$where = "";
		
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
		
		if ( $contact_code != "") {
			
			if ($where == "") {
				$where = " where a.vendor_code = '$contact_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$contact_code' ";
			}								
		}
		
		if($date_from == "" && $date_to == "" && $contact_code == "" && $all == "") {
			$where = " where c.ref = 'ndf' ";
		}
		
		if($all != 0) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, b.name vendor_name, a.total credit from purchase_invoice a left join vendor b on a.vendor_code=b.syscode ".$where." order by a.date, a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//----------Purchase Journal deail
	function journal_purchase_invoice_detail_credit($ref) {
		$dbpdo = DB::create();
		
		$sqlstr="select sum(b.amount) debit from purchase_invoice a left join purchase_invoice_detail b on a.ref=b.ref where a.ref='$ref' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//----------Receipt Journal
	function journal_receipt($date_from = '', $date_to = '', $contact_code = '', $all = 0) {
		$dbpdo = DB::create();
		
		$where = "";
		
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
		
		if ( $contact_code != "") {
			
			if ($where == "") {
				$where = " where a.client_code = '$contact_code' ";
			} else {
				$where = $where . " and a.client_code = '$contact_code' ";
			}								
		}
		
		if($date_from == "" && $date_to == "" && $contact_code == "" && $all == "") {
			$where = " where c.ref = 'ndf' ";
		}
		
		if($all != 0) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, b.name client_name, a.total debit from receipt a left join client b on a.client_code=b.syscode ".$where." order by a.date, a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//----------Receipt Journal deail
	function journal_receipt_detail($ref) {
		$dbpdo = DB::create();
		
		$sqlstr="select sum(b.amount) credit from receipt a left join receipt_detail b on a.ref=b.ref where a.ref='$ref' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//----------Payment Journal
	function journal_payment($date_from = '', $date_to = '', $contact_code = '', $all = 0) {
		$dbpdo = DB::create();
		
		$where = "";
		
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
		
		if ( $contact_code != "") {
			
			if ($where == "") {
				$where = " where a.vendor_code = '$contact_code' ";
			} else {
				$where = $where . " and a.vendor_code = '$contact_code' ";
			}								
		}
		
		if($date_from == "" && $date_to == "" && $contact_code == "" && $all == "") {
			$where = " where c.ref = 'ndf' ";
		}
		
		if($all != 0) {
			$where = "";
		}
		
		$sqlstr="select a.ref, a.date, b.name vendor_name, a.total credit from payment a left join vendor b on a.vendor_code=b.syscode ".$where." order by a.date, a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//----------Payment Journal detail
	function journal_payment_detail($ref) {
		$dbpdo = DB::create();
		
		$sqlstr="select sum(b.amount) debit from payment a left join payment_detail b on a.ref=b.ref where a.ref='$ref' group by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	function list_pos_item_get_price($kode ='', $all=0, $act=''){
		$dbpdo = DB::create();
			 	
		$where = " where a.active=1 ";
		
		if ( $kode != "") {
			if ($where == "") {
				$where = " where a.syscode = '$kode' ";
			} else {
				$where = $where . " and a.syscode = '$kode' ";
			}								
		}
		
        $sqlstr="select a.syscode, a.code, a.old_code, a.name, a.uom_code_stock, a.uom_code_sales, a.uom_code_purchase, (select current_price from set_item_price where item_code=a.syscode and uom_code=a.uom_code_sales order by date_of_record desc limit 1) current_price from item a " . $where . " order by a.code";
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data profit loss
	function profit_loss_purchase($from_date='', $to_date='', $location_id=''){
		$dbpdo = DB::create();
			 	
		$where = "";
		
		$from_date = "2019-01-01";
		
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
		
		if($location_id != "") {
			if ($where == "") {
				$where = " where a.location_id = '$location_id' ";
			} else {
				$where = $where . " and a.location_id = '$location_id' ";
			}
		}
		
		$sqlstr= "select a.location_id, b.name location_name, sum(a.total) total from purchase_invoice a left join warehouse b on a.location_id=b.id " . $where . " group by a.location_id order by a.location_id";
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
		
		$sqlstr="select a.ref, a.item_code, a.uom_code, a.qty, a.ref_pos, a.line, b.code item_code2, b.old_code, b.name item_name from outbound_detail a left join item b on a.item_code=b.syscode " . $where . " order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//-----------sales return detail (saat update)
	function list_sales_return_detail($si_ref='', $item_code='') {
		$dbpdo = DB::create();
		
		$sqlstr="select a.ref, a.item_code, b.code, b.name item_name, a.uom_code, a.qty, a.discount, a.unit_price, a.charge_p, a.amount, a.line_item_si, a.line from sales_return_detail a left join item b on a.item_code=b.syscode left join sales_return c on a.ref=c.ref where c.si_ref='$si_ref' and a.item_code='$item_code' order by a.line";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}


	//---------rpt_bincard_daily_item
	function rpt_bincard_daily_item($item_code='', $uom_code='', $location_id='', $from_date='', $to_date='', $invoice_type=''){	
		$dbpdo = DB::create();
		
		$where = " where a.invoice_type<>'stockopname'";
		
		if ( $location_id != "" && $location_id != "0") {
			
			if ($where == "") {
				$where = " where a.location_code = '$location_id' ";
			} else {
				$where = $where . " and a.location_code = '$location_id' ";
			}								
		}
				
		
		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		}
		
		if ( $uom_code != "") {
			
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
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

		if($invoice_type != '') {

			if ($where == "") {
				$where = " where a.invoice_type = '$invoice_type' ";
			} else {
				$where = $where . " and a.invoice_type = '$invoice_type' ";
			}	
		}

        		
        $sqlstr = "select a.item_code, a.uom_code, ifnull(sum(ifnull(a.debit_qty,0)),0) debit_qty, ifnull(sum(ifnull(a.credit_qty,0)),0) credit_qty from bincard a left join item b on a.item_code=b.syscode " . $where . " group by a.item_code, a.uom_code, a.location_code ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		
		return $sql;
	}


	//---------get data opnblc item form bincard
	function rpt_bincard_openblc_item__($item_code='', $uom_code='', $location_id='', $date='', $all = 0, $available=0){	
		$dbpdo = DB::create();
		
		$where = "";

		$date_end = date("Y-m-d", strtotime($date));
		
		if ( $location_id != "" && $location_id != "0") {
			
			if ($where == "") {
				$where = " where a.location_code = '$location_id' ";
			} else {
				$where = $where . " and a.location_code = '$location_id' ";
			}								
		}
				
		
		if ( $item_code != "") {
			
			if ($where == "") {
				$where = " where a.item_code = '$item_code' ";
			} else {
				$where = $where . " and a.item_code = '$item_code' ";
			}								
		}
		
		if ( $uom_code != "") {
			
			if ($where == "") {
				$where = " where a.uom_code = '$uom_code' ";
			} else {
				$where = $where . " and a.uom_code = '$uom_code' ";
			}								
		}
        
        
        ##get date stock opname terakhir
        if($location_id == "") {
            $sqlstr		= "select date, dlu from bincard where (invoice_type='stockopname' or invoice_type='stock_opname') and item_code='$item_code' and uom_code='$uom_code' order by date desc limit 1";			
            $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
        } else {
            $sqlstr		= "select date, dlu from bincard where (invoice_type='stockopname' or invoice_type='stock_opname') and location_code='$location_id' and item_code='$item_code' and uom_code='$uom_code' order by date desc limit 1";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
        }
        //echo $sqlstring."<br>";
		//$sqlstock		= mysql_query($sqlstring);
		$rows_so		= $sql->rowCount();
		$datadate		= $sql->fetch(PDO::FETCH_OBJ);
		$datebincard 	= $datadate->date;

		$balance = 0;
		if ( $rows_so > 0) {
			$datebincard = date("Y-m-d", strtotime($datebincard));
			// if ($where == "") {
			// 	$where = " where a.date >= '$datebincard' and a.date <= '$datebincard'";
			// } else {
			// 	$where = $where . " and a.date >= '$datebincard' and a.date <= '$datebincard'";
			// }	

			$date = date("Y-m-d", strtotime($date));
			
			if($datebincard > $date) {
				if ($where == "") {
					$where = " where a.date >= '$datebincard' and a.date <= '$date'";
				} else {
					$where = $where . " and a.date >= '$datebincard' and a.date <= '$date'";
				}	

			} else if($datebincard == $date) {
				$date = date("Y-m-d", strtotime($date));
				if ($where == "") {
					$where = " where a.date <= '$datebincard'";
				} else {
					$where = $where . " and a.date <= '$datebincard' ";
				}	

			} else if($datebincard < $date) {
				$date = date("Y-m-d", strtotime($date));
				if ($where == "") {
					$where = " where a.date <= '$datebincard'";
				} else {
					$where = $where . " and a.date <= '$datebincard' ";
				}

				//cek transaksi setelah stock opname
				$sqlstr	= "select sum(ifnull(debit_qty,0)) - sum(ifnull(credit_qty,0)) balance from bincard where invoice_type<>'stockopname' and invoice_type<>'stock_opname' and location_code='$location_id' and item_code='$item_code' and uom_code='$uom_code' and date>='$datebincard' and dlu > '$datadate->dlu' and date<'$date_end' group by item_code, uom_code, location_code";
		        $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data_after = $sql->fetch(PDO::FETCH_OBJ);
				$balance = numberreplace($data_after->balance);
				
			} else {
				$date = date("Y-m-d", strtotime($date));
				if ($where == "") {
					$where = " where a.date <= '$datebincard'";
				} else {
					$where = $where . " and a.date <= '$datebincard' ";
				}	

				//cek transaksi setelah stock opname
				$sqlstr	= "select sum(ifnull(debit_qty,0)) - sum(ifnull(credit_qty,0)) balance from bincard where invoice_type<>'stockopname' and invoice_type<>'stock_opname' and location_code='$location_id' and item_code='$item_code' and uom_code='$uom_code' and date='$datebincard' and dlu > '$datadate->dlu' group by item_code, uom_code, location_code";	
		        $sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data_after = $sql->fetch(PDO::FETCH_OBJ);
				$balance = numberreplace($data_after->balance);

			}
            
			

            if($all != 0) {
				$date = date("Y-m-d");
				
				$where = " where a.date < '$date' ";
			}
			
			/*$having = "";
			if($available != 0) {
				$having = " having ifnull(sum(a.debit_qty) - sum(a.credit_qty),0) > 0 ";	
			}*/
			
	        $sqlstr = "select a.item_code, a.uom_code, sum(ifnull(a.debit_qty,0)) + $balance opnblc from bincard a left join item b on a.item_code=b.syscode " . $where . " group by a.item_code, a.uom_code, a.location_code " . $having;
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		} else {
            if ( $date != "") {
			
    			$date = date("Y-m-d", strtotime($date));
    			
    			if ($where == "") {
    				$where = " where a.date < '$date' ";
    			} else {
    				$where = $where . " and a.date < '$date' ";
    			}		
    								
    		}

    		$sqlstr = "select a.item_code, a.uom_code, sum(ifnull(a.debit_qty,0)) - sum(ifnull(a.credit_qty,0)) opnblc from bincard a left join item b on a.item_code=b.syscode " . $where . " group by a.item_code, a.uom_code, a.location_code " . $having;
    		$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
        }
		##-----------------

		return $sql;
	}

		
}
?>