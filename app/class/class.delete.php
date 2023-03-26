<?php

class delete{
	
	//----hapus user
	function delete_usr($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select usrid from usr where id=$ref");
		$data=$sql->fetch(PDO::FETCH_OBJ);;
		
		$sql=$dbpdo->query("delete from usr_dtl where usrid='$data->usrid' ");
		
		$sql=$dbpdo->query("delete from usr where id='$ref' ");
	
		//----delete user backup
		$sql=$dbpdo->query("delete from usr_bup where usrid='$data->usrid' ");
		
		return $sql;
	}
	
	//---hapus company
	function delete_company($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from company where id='$ref' ");
	
		return $sql;
	}
	
	
	//---hapus peserta
	function delete_peserta($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from peserta where syscode='$ref'");
	
		return $sql;
	}
	
	
	//---hapus program
	function delete_program($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from program where id='$ref'");
		
		$sql=$dbpdo->query("delete from set_item_price where item_code='$ref'");
			
		return $sql;
	}
	
	
	//---hapus coa
	function delete_coa($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from coa where syscode='$ref' ");
	
		return $sql;
	}
	
	
	//---hapus client
	function delete_client($ref){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from client_detail where client_syscode='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sqlstr="delete from client where syscode='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		return $sql;
	}
	
	//---hapus client type
	function delete_client_type($ref){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from client_type where id='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		return $sql;
	}
	
	//---hapus item
	function delete_item($ref){
		$dbpdo = DB::create();
		
		/*---------insert audit trail item (delete)------------*/
		$select=new select;
		$sqldel=$select->list_item($ref);
		$data = $sqldel->fetch(PDO::FETCH_OBJ);
		
		$uid			=	$_SESSION["loginname"];
		$dlu			=	date("Y-m-d H:i:s");
		$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$data->code', '$data->old_code', '$data->name', '$data->item_group_id', '$data->item_subgroup_id', '$data->item_type_code', '$data->item_category_id', '$data->brand_id', '$data->size_id', '$data->uom_code_stock', '$data->uom_code_sales', '$data->uom_code_purchase', '$data->minimum_stock', '$data->maximum_stock', '$data->photo', '$data->consigned', '$data->active', '$uid', '$dlu', '$data->syscode', 'delete' )";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		/*---------insert audit trail set item price (delete)------------*/
		$select=new select;
		$sqldel=$select->list_set_item_price_last("", $ref);
		$data = $sqldel->fetch(PDO::FETCH_OBJ);
		
		$uid			=	$_SESSION["loginname"];
		$dlu			=	date("Y-m-d H:i:s");
		$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$data->date', '$data->efective_from', '$data->item_code', '$data->uom_code', '$data->current_price', '$data->current_price1', '$data->current_price2', '$data->current_price3', '$data->last_price', '$data->date_of_record', '$data->location_id', '$data->non_discount', '$data->qty1', '$data->qty2', '$data->qty3', '$data->qty4', '$data->uid', '$data->dlu', 'delete')";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sql=$dbpdo->query("delete from set_item_price where item_code='$ref' ");
		
		$sql=$dbpdo->query("delete from item where syscode='$ref' ");
	
		return $sql;
	}
	
	
	//---hapus item group
	function delete_item_group($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from item_group where id='$ref' ");
		
		$sql=$dbpdo->query("delete from item_group_detail where id_header='$ref' ");
		
		return $sql;
	}
	
	
	//---hapus client_set_level
	function delete_client_set_level($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from client_set_level where id='$ref' ");
		
		return $sql;
	}
	
	
	//---hapus level
	function delete_level($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from level where id='$ref' ");
		
		return $sql;
	}
	
	//---hapus warehouse
	function delete_warehouse($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from warehouse where id='$ref' ");
		
		return $sql;
	}
	
	
	
	//---hapus product
	function delete_product($ref){
		$dbpdo = DB::create();
		
		/*---------insert audit trail item (delete)------------*/
		$select=new select;
		$sqldel=$select->list_item($ref);
		$data = $sqldel->fetch(PDO::FETCH_OBJ);
		
		$uid			=	$_SESSION["loginname"];
		$dlu			=	date("Y-m-d H:i:s");
		$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$data->code', '$data->old_code', '$data->name', '$data->item_group_id', '$data->item_subgroup_id', '$data->item_type_code', '$data->item_category_id', '$data->brand_id', '$data->size_id', '$data->uom_code_stock', '$data->uom_code_sales', '$data->uom_code_purchase', '$data->minimum_stock', '$data->maximum_stock', '$data->photo', '$data->consigned', '$data->active', '$uid', '$dlu', '$data->syscode', 'delete' )";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		/*---------insert audit trail set item price (delete)------------*/
		$select=new select;
		$sqldel=$select->list_set_item_price_last("", $ref);
		$data = $sqldel->fetch(PDO::FETCH_OBJ);
		
		$uid			=	$_SESSION["loginname"];
		$dlu			=	date("Y-m-d H:i:s");
		$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$data->date', '$data->efective_from', '$data->item_code', '$data->uom_code', '$data->current_price', '$data->current_price1', '$data->current_price2', '$data->current_price3', '$data->last_price', '$data->date_of_record', '$data->location_id', '$data->non_discount', '$data->qty1', '$data->qty2', '$data->qty3', '$data->qty4', '$data->uid', '$data->dlu', 'delete')";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sql=$dbpdo->query("delete from item where syscode='$ref' ");
	
		return $sql;
	}
	
	
	//---hapus client deposit
	function delete_client_deposit($ref){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from client_deposit where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
				
		return $sql;
	}
	
	//---hapus client transfer saldo
	function delete_transfer_saldo($ref){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from transfer_saldo where id='$ref' ";
		$sql=$dbpdo->query($sqlstr);
				
		return $sql;
	}
	
	//---hapus sales_invoice_tmp
	function delete_sales_invoice_tmp(){
		
		$dbpdo = DB::create();
		
		$ref = $_SESSION["client_code"];
		$sqlstr = "delete from sales_invoice_tmp where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---hapus stock opname
	function delete_stock_opname($ref){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from bincard where invoice_no='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sqlstr="delete from stock_opname where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from stock_opname_detail where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
			
		return $sql;
	}
	
	//---hapus employee
	function delete_employee($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from employee where id='$ref' ");
	
		return $sql;
	}
	
	
	//---hapus pos
	function delete_pos($ref){
		$dbpdo = DB::create();
		
		
		//update sales order
		$sqlstr = "select so_ref, item_code, uom_code, qty, line_item_so from sales_invoice_detail where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		while($data=$sql->fetch(PDO::FETCH_OBJ)) {
			$sqlstr="update sales_order_detail set qty_sales=qty_sales - $data->qty where ref='$data->so_ref' and item_code='$data->item_code' and uom_code='$data->uom_code' and line='$data->line_item_so'";				
			$sql1=$dbpdo->prepare($sqlstr);
			$sql1->execute();	
		}		
		//-------/\----------
									
		$sql2="delete from bincard where invoice_no='$ref'";
		$sql=$dbpdo->query($sql2);
		
		$sqlstr="delete from sales_invoice where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from sales_invoice_detail where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
		
		//delete journal
		$sqlstr="delete from jrn where ivino='$ref' and ivitpe='sales' ";
		$sql=$dbpdo->query($sqlstr);
		
		//delete ARC
		$sqlstr="delete from arc where ref='$ref'";
		$sql=$dbpdo->query($sqlstr);
        
        //delete AR
		$sqlstr="delete from ar where ref='$ref'";
		$sql=$dbpdo->query($sqlstr);
		
		//delete member
		/*$sqlstr="delete from sales_invoice_point where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();*/
	
		return $sql;
	}
	
	
	//---hapus material
	function delete_material($ref){
		$dbpdo = DB::create();
		
		/*---------insert audit trail item (delete)------------*/
		$select=new select;
		$sqldel=$select->list_item($ref);
		$data = $sqldel->fetch(PDO::FETCH_OBJ);
		
		$uid			=	$_SESSION["loginname"];
		$dlu			=	date("Y-m-d H:i:s");
		$sqlstr="insert into adt_item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, consigned, active, uid, dlu, syscode, adt_status) values ('$data->code', '$data->old_code', '$data->name', '$data->item_group_id', '$data->item_subgroup_id', '$data->item_type_code', '$data->item_category_id', '$data->brand_id', '$data->size_id', '$data->uom_code_stock', '$data->uom_code_sales', '$data->uom_code_purchase', '$data->minimum_stock', '$data->maximum_stock', '$data->photo', '$data->consigned', '$data->active', '$uid', '$dlu', '$data->syscode', 'delete' )";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		/*---------insert audit trail set item price (delete)------------*/
		$select=new select;
		$sqldel=$select->list_set_item_price_last("", $ref);
		$data = $sqldel->fetch(PDO::FETCH_OBJ);
		
		$uid			=	$_SESSION["loginname"];
		$dlu			=	date("Y-m-d H:i:s");
		$sqlstr = "insert into adt_set_item_price (date, efective_from, item_code, uom_code, current_price, current_price1, current_price2, current_price3, last_price, date_of_record, location_id, non_discount, qty1, qty2, qty3, qty4, uid, dlu, adt_status) values('$data->date', '$data->efective_from', '$data->item_code', '$data->uom_code', '$data->current_price', '$data->current_price1', '$data->current_price2', '$data->current_price3', '$data->last_price', '$data->date_of_record', '$data->location_id', '$data->non_discount', '$data->qty1', '$data->qty2', '$data->qty3', '$data->qty4', '$data->uid', '$data->dlu', 'delete')";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sql=$dbpdo->query("delete from set_item_price where item_code='$ref' ");
		
		$sql=$dbpdo->query("delete from item where syscode='$ref' ");
	
		return $sql;
	}
	
	
	//---hapus purchase inv
	function delete_purchase_inv($ref){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from purchase_invoice where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from purchase_invoice_detail where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
		
		//delete AP
		$sqlstr="delete from ap where ref='$ref' and invoice_type='POV'";
		$sql=$dbpdo->query($sqlstr);
		
		//delete journal
		$sqlstr="delete from jrn where ivino='$ref' and ivitpe='purchase_inv' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from bincard where invoice_no='$ref' and invoice_type='purchase_inv' ";
		$sql=$dbpdo->query($sql2);
		
		return $sql;
	}
	
	//---hapus 
	function delete_sales_order($ref){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from sales_order_detail where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sqlstr="delete from sales_order where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
				
		return $sql;
	}
	
	//---hapus 
	function delete_sales_order_detail($ref, $line){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from sales_order_detail where ref='$ref' and line='$line'";
		$sql=$dbpdo->query($sqlstr);
		
		//get total amount
		$sqlstr="select sum(amount) total_amount from sales_order_detail where ref='$ref' group by ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$total=$data->total_amount;
		//-------------------
		
		$sqlstr="update sales_order set total='$total' where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	//---hapus general_journal_detail
	function delete_general_journal_detail($ref='', $line=''){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from general_journal_detail where ref='$ref' and line='$line'";
		$sql=$dbpdo->query($sqlstr);
						
		$sqlstr="delete from jrn where ivino='$ref' and lne='$line'";
		$sql=$dbpdo->query($sqlstr);
		
		//update total; dbtamt	crdamt
		$sqlstr = "select sum(debit_amount) dbtamt, sum(credit_amount) crdamt from general_journal_detail where ref='$ref' group by ref";				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$ttlblc = $data->dbtamt - $data->crdamt;
		$ttldbt = $data->dbtamt;
		$ttlcrd = $data->crdamt;
		
		$sqlstr = "update general_journal set total_balance='$total_balance', total_debit='$total_debit', total_credit='$total_credit' where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---hapus general journal
	function delete_general_journal($ref){
		
		$dbpdo = DB::create();
		
		## Delete Journal
		$sqlstr="delete from jrn where ivino='$ref' and ivitpe='Gnr Journal' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sqlstr="delete from general_journal where ref='$ref' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sqlstr="delete from general_journal_detail where ref='$ref' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus delivery order
	function delete_delivery_order($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			##--------update qty sales order	
			$sql_do="select so_ref, item_code, uom_code, line_item_so, ifnull(qty,0) qty from delivery_order_detail where ref='$ref'";
			$result=$dbpdo->query($sql_do);
			while($data = $result->fetch(PDO::FETCH_OBJ)) {
				$so_ref = $data->so_ref;
				$item_code = $data->item_code;
				$uom_code = $data->uom_code;
				$line_item_so = $data->line_item_so;
				$qty = $data->qty;
				
				$sql2="update sales_invoice_detail set qty_shp=ifnull(qty_shp,0) - $qty where ref='$so_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_so' ";	
				$sql=$dbpdo->query($sql2);	
				
				/*update status sales order : S=Shipped in Part (dikirim sebagian)
											  F=Shipped in Full (dikirm semua)
											  C=Closed (tidak dikirim sama sekali, tetapi transaksi di close)	
				*/
				$sql2 = "select sum(ifnull(qty,0)) qty, sum(ifnull(qty_shp,0)) qty_shp from sales_invoice_detail group by ref having ref='$so_ref'";
				$result1 = $dbpdo->query($sql2);
				$data1 = $result1->fetch(PDO::FETCH_OBJ);
				$qty_shp = $data1->qty_shp;
				$qty = $data1->qty;

				if($qty_shp < $qty ) {
					$sql2="update sales_invoice set status='S', process_whs=0 where ref='$so_ref' ";
					$sql=$dbpdo->query($sql2);	
				}
				
				if($qty_shp >= $qty ) {
					$sql2="update sales_invoice set status='F', process_whs=0 where ref='$so_ref' ";
					$sql=$dbpdo->query($sql2);	
				}
				
				if($qty_shp <= 0 ) {
					$sql2="update sales_invoice set status='A', process_whs=0 where ref='$so_ref' ";
					$sql=$dbpdo->query($sql2);	
				}
				##*****************************************##
			}					
			
			//-----------delete bin card
			$sqlstr="delete from bincard where invoice_no='$ref'";
			$sql=$dbpdo->query($sqlstr);
							
			$sqlstr="delete from delivery_order where ref='$ref' ";
			$sql=$dbpdo->query($sqlstr);
			
			$sql2="delete from delivery_order_detail where ref='$ref' ";
			$sql=$dbpdo->query($sql2);
			
			$sqlstr="delete from jrn where ivino='$ref' and ivitpe='delivery_order' ";
			$sql=$dbpdo->query($sqlstr);
			
			$dbpdo->commit();
			
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//---hapus promo
	function delete_promo($ref){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from promo where id='$ref' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	//---hapus vendor type
	function delete_vendor_type($ref){
		
		$dbpdo = DB::create();
		
		
		
		$sqlstr="delete from vendor_type where id='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sqlstr="delete from vendor_type_detail where id_header='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		return $sql;
	}
	
	//---hapus vendor
	function delete_vendor($ref){
		
		$dbpdo = DB::create();
		
		
		
		$sqlstr="delete from vendor where syscode='$ref' ";
		$sql=$dbpdo->query($sqlstr);
			
		return $sql;
	}
	
	//---hapus 
	function delete_sewing($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$sqlstr="delete from bincard where invoice_no='$ref'";
			$sql=$dbpdo->query($sqlstr);
			
			$sqlstr="delete from ap where ref='$ref'";
			$sql=$dbpdo->query($sqlstr);
			
			$sqlstr="delete from sewing_detail where ref='$ref' ";
			$sql=$dbpdo->query($sqlstr);
			
			$sqlstr="delete from sewing where ref='$ref' ";
			$sql=$dbpdo->query($sqlstr);
		
			$dbpdo->commit();
			
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
				
		return $sql;
	}
	
	
	function delete_good_receipt($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			##--------update qty sales order	
			$sql_do="select po_ref, item_code, uom_code, pi_line, ifnull(qty,0) qty from good_receipt_detail where ref='$ref'";
			$result1=$dbpdo->query($sql_do);
			while($data = $result1->fetch(PDO::FETCH_OBJ)) {
				$po_ref = $data->po_ref;
				$item_code = $data->item_code;
				$uom_code = $data->uom_code;
				$pi_line = $data->pi_line;
				$qty = $data->qty;
				
				$sql2="update purchase_invoice_detail set qty_good=ifnull(qty_good,0) - $qty where ref='$po_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$pi_line' ";	
				$sql=$dbpdo->query($sql2);	
				
				/*update status sales order : S=Shipped in Part (dikirim sebagian)
											  F=Shipped in Full (dikirm semua)
											  C=Closed (tidak dikirim sama sekali, tetapi transaksi di close)	
				*/
				##--------update qty purchase invoice
				$sql2 = "select sum(ifnull(qty,0)) qty, sum(ifnull(qty_good,0)) qty_good from purchase_invoice_detail group by ref having ref='$po_ref'";
				$result=$dbpdo->prepare($sql2);
				$result->execute();
				$data1 = $result->fetch(PDO::FETCH_OBJ);
				
				$qty_good = $data1->qty_good;
				$qty = $data1->qty;
				
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
			
			$sqlstr="delete from bincard where invoice_no='$ref'";
			$sql=$dbpdo->query($sqlstr);
			
			$sqlstr="delete from good_receipt_detail where ref='$ref' ";
			$sql=$dbpdo->query($sqlstr);
			
			$sqlstr="delete from good_receipt where ref='$ref' ";
			$sql=$dbpdo->query($sqlstr);
			
			$dbpdo->commit();
			
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
				
		return $sql;
	}
	
	
	//---hapus outbound
	function delete_outbound($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$sqlstr="delete from outbound where ref='$ref' ";
			$sql=$dbpdo->query($sqlstr);
			
			$sql2="delete from outbound_detail where ref='$ref' ";
			$sql=$dbpdo->query($sql2);
			
			$sql2="delete from bincard where invoice_no='$ref' and invoice_type='outbound' ";
			$sql=$dbpdo->query($sql2);
			
			$dbpdo->commit();
			
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//---hapus 
	function delete_sewing_detail($ref, $line){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$sqlstr="delete from sewing_detail where ref='$ref' and line='$line'";
			$sql=$dbpdo->query($sqlstr);
			
			//cek detail
			$sqlstr="select ref from sewing_detail where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$rows=$sql->rowCount();
			//-------------------
			
			if($rows == 0) {
				$sqlstr="delete from sewing where ref='$ref'";
				$sql=$dbpdo->query($sqlstr);	
			}
			
			$dbpdo->commit();
			
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//---hapus uom
	function delete_uom($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from uom where code='$ref' ");
	
		return $sql;
	}
	
	
	//---hapus division
	function delete_division($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from division where id='$ref' ");
	
		return $sql;
	}
	
	
	//---hapus position
	function delete_position($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from position where id='$ref' ");
	
		return $sql;
	}
	
	//---hapus colour
	function delete_colour($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from colour where id='$ref' ");
	
		return $sql;
	}
	
	//---hapus pos detail
	function delete_pos_detail($ref, $line){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from sales_invoice_tmp where ref='$ref' and line='$line' ");
	
		return $sql;
	}
	
	
	//---hapus new product
	function delete_new_product($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from set_item_price where item_code='$ref' ");
		
		$sql=$dbpdo->query("delete from item where syscode='$ref' ");
	
		return $sql;
	}
	
	
	//---hapus general journal in
	function delete_general_journal_in($ref){
		
		$dbpdo = DB::create();
		
		## Delete Journal
		$sqlstr="delete from jrn where ivino='$ref' and ivitpe='Gnr Journal' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sqlstr="delete from general_journal where ref='$ref' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sqlstr="delete from general_journal_detail where ref='$ref' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
	
		return $sql;
	}
	
	
	//---hapus general_journal_in_detail
	function delete_general_journal_in_detail($ref='', $line=''){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from general_journal_detail where ref='$ref' and line='$line'";
		$sql=$dbpdo->query($sqlstr);
						
		$sqlstr="delete from jrn where ivino='$ref' and lne='$line'";
		$sql=$dbpdo->query($sqlstr);
		
		//update total; dbtamt	crdamt
		$sqlstr = "select sum(debit_amount) dbtamt, sum(credit_amount) crdamt from general_journal_detail where ref='$ref' group by ref";				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$ttlblc = $data->dbtamt - $data->crdamt;
		$ttldbt = $data->dbtamt;
		$ttlcrd = $data->crdamt;
		
		$sqlstr = "update general_journal set total_balance='$total_balance', total_debit='$total_debit', total_credit='$total_credit' where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---hapus setup salary
	function delete_employee_basic_salary_detail($ref='', $line=''){
		
		$dbpdo = DB::create();
		
		$sqlstr = "delete from employee_basic_salary where employee_id='$ref' and line='$line'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---hapus salary
	function delete_salary($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$sqlstr="delete from salary_detail where ref='$ref'";
			$sql=$dbpdo->query($sqlstr);
			
			$sqlstr="delete from salary where ref='$ref'";
			$sql=$dbpdo->query($sqlstr);
			
			$dbpdo->commit();
			
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
				
		return $sql;
	}
	
	
	//---hapus minute_meet
	function delete_minute_meet($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dbpdo->beginTransaction();
			
			$sqlstr="delete from minute_meet_detail where ref='$ref'";
			$sql=$dbpdo->query($sqlstr);
			
			$sqlstr="delete from minute_meet where ref='$ref'";
			$sql=$dbpdo->query($sqlstr);
			
			$dbpdo->commit();
			
		}
		
		catch(PDOException $e){
			$dbpdo->rollBack();
			echo $e->getMessage();
		}
				
		return $sql;
	}
	
	
	//---hapus minute_meet_detail
	function delete_minute_meet_detail($ref='', $line=''){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from minute_meet_detail where ref='$ref' and line='$line'";
		$sql=$dbpdo->query($sqlstr);
						
		return $sql;
	}
	
	
	//---hapus payment
	function delete_payment($ref){
		
		$dbpdo = DB::create();
		
		
		$sqlstr="delete from payment where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from payment_detail where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
		
		$sql2="delete from ap where ref='$ref' and invoice_type='PMT' ";
		$sql=$dbpdo->query($sql2);
		
		//delete APC
		$sqlstr="delete from apc where ref='$ref'";
		$sql=$dbpdo->query($sqlstr);	
		
		$sql2="delete from jrn where ivino='$ref' and ivitpe='payment' ";
		$sql=$dbpdo->query($sql2);
					
		return $sql;
	}
	
	
	//---hapus receipt
	function delete_receipt($ref){
		
		$dbpdo = DB::create();
		
		
		$sqlstr="delete from receipt where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from receipt_detail where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
		
		$sql2="delete from ar where ref='$ref' and invoice_type='RCI' ";
		$sql=$dbpdo->query($sql2);
		
		//delete ARC
		$sqlstr="delete from arc where ref='$ref'";
		$sql=$dbpdo->query($sqlstr);	
		
		//delete journal
		$sql2="delete from jrn where ivino='$ref' and ivitpe='receipt' ";
		$sql=$dbpdo->query($sql2);
		
		//delete DPS
		$sqlstr="delete from dps where ref='$ref' and invoice_type='RCI' ";
		$sql=$dbpdo->query($sqlstr);	
		
		return $sql;
	}
	
	
	//---hapus weekly_assignment_work
	function delete_weekly_assignment_work($ref=''){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from weekly_assignment_work where id='$ref'";
		$sql=$dbpdo->query($sqlstr);
						
		return $sql;
	}
	
	//---hapus regular_item
	function delete_regular_item($ref=''){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from regular_item where id='$ref'";
		$sql=$dbpdo->query($sqlstr);
						
		return $sql;
	}
	
	//---hapus schedule_promo
	function delete_schedule_promo($id=''){
		
		$dbpdo = DB::create();
		
		$sqlstr = "delete from schedule_promo where id='$id'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---hapus schedule_regular_item
	function delete_schedule_regular_item($id=''){
		
		$dbpdo = DB::create();
		
		$sqlstr = "delete from schedule_regular_item where id='$id'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---hapus set journal
	function delete_set_journal($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from set_journal where id='$ref' ");
	
		return $sql;
	}
	
	//---hapus brand
	function delete_brand($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from brand where id='$ref' ");
	
		return $sql;
	}
	
	//---hapus purchase return
	function delete_purchase_return($ref){
		
		$dbpdo = DB::create();
		
		
		
		##--------update qty purchase invoice	
		$qty_pi = 0;
		
		$sql_pi="select b.pi_ref, a.item_code, a.uom_code, ifnull(a.qty,0) qty, a.line_item_pi from purchase_return_detail a left join purchase_return b on a.ref=b.ref where a.ref='$ref'";
		$result=$dbpdo->query($sql_pi);
		while($data = $result->fetch(PDO::FETCH_OBJ)) {
			$pi_ref = $data->pi_ref;
			$item_code = $data->item_code;
			$uom_code = $data->uom_code;
			$qty = $data->qty;
			$line_item_pi = $data->line_item_pi;
			
			$sql2="update purchase_invoice_detail set qty_rtn=ifnull(qty_rtn,0) - $qty where ref='$pi_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_pi' ";	
			$sql=$dbpdo->query($sql2);	
			
		}			
		
		//delete AP
		$sqlstr="delete from ap where ref='$ref' and invoice_type='PIR'";
		$sql=$dbpdo->query($sqlstr);
		
		//delete journal
		$sqlstr="delete from jrn where ivino='$ref' and ivitpe='purchase_return' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sqlstr="delete from purchase_return where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sql2="delete from purchase_return_detail where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
		
		return $sql;
	}
	
	//---hapus sales return
	function delete_sales_return($ref){
		
		$dbpdo = DB::create();
		
		##--------update qty sales invoice	
		$sql_si="select b.si_ref, a.item_code, a.uom_code, a.line_item_si, ifnull(a.qty,0) qty from sales_return_detail a left join sales_return b on a.ref=b.ref where a.ref='$ref'";
		$result=$dbpdo->query($sql_si);
		while($data = $result->fetch(PDO::FETCH_OBJ)) {
			$si_ref = $data->si_ref;
			$item_code = $data->item_code;
			$uom_code = $data->uom_code;
			$line_item_si = $data->line_item_si;
			$qty = $data->qty;
			
			$sql2="update sales_invoice_detail set qty_rtn=ifnull(qty_rtn,0) - $qty where ref='$si_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$line_item_si' ";	
			$sql=$dbpdo->query($sql2);
			
			##*****************************************##
		}	
		
		
		$sql2="delete from sales_return where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
		
		$sql2="delete from sales_return_detail where ref='$ref' ";
		$sql=$dbpdo->query($sql2);
		
		$sql2="delete from bincard where invoice_no='$ref' and invoice_type='sales_return' ";
		$sql=$dbpdo->query($sql2);
		
		//delete AR
		$sql2="delete from ar where ref='$ref' and invoice_type='SIR'";
		$sql=$dbpdo->query($sql2);
		
		//delete journal
		$sql2="delete from jrn where ivino='$ref' and ivitpe='sales_return' ";
		$sql=$dbpdo->query($sql2);
		
		return $sql;
	}
	
	
	//---hapus delete_finance_type
	function delete_finance_type($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from finance_type where id='$ref' ");
	
		return $sql;
	}

	//---hapus delete_channel
	function delete_channel($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from channel where id='$ref' ");
	
		return $sql;
	}


	//---hapus delete_size
	function delete_size($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from size where id='$ref' ");
	
		return $sql;
	}


	//---hapus delete_payment_method
	function delete_payment_method($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("delete from payment_method where id='$ref' ");
	
		return $sql;
	}


	//---hapus purchase type
	function delete_purchase_type($ref){
		
		$dbpdo = DB::create();
		
		$sqlstr="delete from purchase_type where id='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		
		return $sql;
	}


	//---hapus measuring_size_sewing
	function delete_measuring_size_sewing($ref){
		
		$dbpdo = DB::create();
		
		//ms_sewing
		$sqlstr="select counting_ref, photo, photo1, photo2, photo3, photo4, photo5, photo6, photo7 from measuring_size_sewing where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$photo = $data->photo;
		$photo1 = $data->photo1;
		$photo2 = $data->photo2;
		$photo3 = $data->photo3;

		//update counting ms_sewing
		/*$sqlstr="update counting set ms_sewing=0 where ref='$data->counting_ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		//update sales_order ms_sewing
		$sqlstr="update sales_order set ms_sewing=0 where ref='$data->counting_ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();*/

		//hapus photo
		$photo_path = 'app/photo_ms/';
		if(!empty($photo)) {
			if (file_exists($photo_path . $photo)) { 
				unlink($photo_path . $photo); 
			}
		}
		if(!empty($photo1)) {
			if (file_exists($photo_path . $photo1)) { 
				unlink($photo_path . $photo1); 
			}
		}
		if(!empty($photo2)) {
			if (file_exists($photo_path . $photo2)) { 
				unlink($photo_path . $photo2); 
			}
		}
		if(!empty($photo3)) {
			if (file_exists($photo_path . $photo3)) { 
				unlink($photo_path . $photo3); 
			}
		}
		if(!empty($photo4)) {
			if (file_exists($photo_path . $photo4)) { 
				unlink($photo_path . $photo4); 
			}
		}
		if(!empty($photo5)) {
			if (file_exists($photo_path . $photo5)) { 
				unlink($photo_path . $photo5); 
			}
		}
		if(!empty($photo6)) {
			if (file_exists($photo_path . $photo6)) { 
				unlink($photo_path . $photo6); 
			}
		}
		if(!empty($photo7)) {
			if (file_exists($photo_path . $photo7)) { 
				unlink($photo_path . $photo7); 
			}
		}


		##delete measuring_size_sewing_detail
		$sqlstr="delete from measuring_size_sewing_detail where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		##delete measuring_size_sewing
		$sqlstr="delete from measuring_size_sewing where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}


	//---hapus do_good_receipt_qc
	function delete_do_good_receipt_qc($ref){
		
		$dbpdo = DB::create();
		
		##--------update do receipt
		$sql_gr="select rcp_ref, item_code, uom_code, qty, qty_damaged, do_line from do_good_receipt_qc_detail where ref='$ref'";
		$result=$dbpdo->query($sql_gr);
		while($data = $result->fetch(PDO::FETCH_OBJ)) {
			$rcp_ref = $data->rcp_ref;
			$item_code = $data->item_code;
			$uom_code = $data->uom_code;
			$qty = numberreplace($data->qty);
			$qty_damaged = numberreplace($data->qty_damaged);
			$total_qty = $qty; //+ $qty_damaged;
			$do_line = $data->do_line;
			
			//update do_good_receipt_detail
			$sql2="update good_receipt_detail set qty_qc=ifnull(qty_qc,0) - $qty where ref='$rcp_ref' and item_code='$item_code' and uom_code='$uom_code' and line='$do_line' ";	
			$sql=$dbpdo->query($sql2);

		}	
		##*****************************************##

		##delete file
		$sql_gr="select file_qc from do_good_receipt_qc where ref='$ref'";
		$result=$dbpdo->query($sql_gr);
		$data = $result->fetch(PDO::FETCH_OBJ);
		$uploaddir_file_qc 	= 'app/file_do_good_qc/';
		$file_qc = $data->file_qc;
		if(!empty($file_qc)) {
			if (file_exists($uploaddir_file_qc . $file_qc)) { 
				unlink($uploaddir_file_qc . $file_qc); 
			}
		}

		$sqlstr="delete from ap where ref='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sqlstr="delete from do_good_receipt_qc_detail where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);
		
		$sqlstr="delete from do_good_receipt_qc where ref='$ref' ";
		$sql=$dbpdo->query($sqlstr);

		return $sql;
	}
	


}

?>
