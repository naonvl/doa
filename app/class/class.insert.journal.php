<?php

class insert_journal{
	
	//-----journal petty cash receipt
	function journal_cash_receipt($ref){
		$dbpdo = DB::create();
		
		try {
			
			$ivino			=	$ref;
			$dte			=	date('Y-m-d', strtotime($_POST["date"]));
			$account_code	=	$_POST['account_code'];
			$memo			=	$_POST['memo'];
			//$amount			=	numberreplace($_POST['amount']);
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$amount	= 0;
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			for ($i=0; $i<=$jmldata; $i++) {
				
				$acccde 			= $_POST[account_code_.$i];
				$mmo 				= $_POST[memo_.$i];
				$crdamt				= numberreplace($_POST[credit_amount_.$i]);
				
				$amount				=	$amount + $crdamt;
				
				if ($acccde != '') { 		
					
					$j++;
					
					$keycode2	=	$ivino . $acccde;
					if($crdamt > 0) { //credit
						$sqlstr	=	"insert into jrn(ivino, ivitpe, ividte, acccde, dcr, dbtamt, crdamt, curcde, excrte, keycde, lne, uid, dlu, sysdte) values('$ivino', 'cash_receipt', '$dte', '$acccde', '$mmo', '0', '$crdamt', 'idr', '0', '$keycode2', '$j', '$uid', '$dlu', '$dlu' )";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();			
					}
					if($crdamt  < 0) { //debit
						$crdamt = $crdamt * -1;
						$sqlstr	=	"insert into jrn(ivino, ivitpe, ividte, acccde, dcr, dbtamt, crdamt, curcde, excrte, keycde, lne, uid, dlu, sysdte) values('$ivino', 'cash_receipt', '$dte', '$acccde', '$mmo', '$crdamt', '0', 'idr', '0', '$keycode2', '$j', '$uid', '$dlu', '$dlu' )";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();			
					}
					
					
				}
				
			}
			
			
			//----------------insert journal
			$keycode		=	$ivino . $account_code;		
			if($amount > 0) { 
				##debet
				$sqlstr="insert into jrn(ivino, ivitpe, ividte, acccde, dcr, dbtamt, crdamt, curcde, excrte, keycde, lne, uid, dlu, sysdte) values('$ivino', 'cash_receipt', '$dte', '$account_code', '$memo', '$amount', '0', 'idr', '0', '$keycode', '0', '$uid', '$dlu', '$dlu' )";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} 
			if($amount < 0) { 
				##credit
				$amount = $amount * -1;
				$sqlstr="insert into jrn(ivino, ivitpe, ividte, acccde, dcr, dbtamt, crdamt, curcde, excrte, keycde, lne, uid, dlu, sysdte) values('$ivino', 'cash_receipt', '$dte', '$account_code', '$memo', '0', '$amount', 'idr', '0', '$keycode', '0', '$uid', '$dlu', '$dlu' )";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}	
	
	
	
}

?>
