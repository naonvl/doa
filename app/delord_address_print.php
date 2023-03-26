<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

//include_once ("include/queryfunctions.php");
include_once ("include/sambung.php");
include_once ("include/functions.php");
//include_once ("include/inword.php");

include 'class/class.selectview.php';
include 'class/class.select.php';

$selectview = new selectview;
$select = new select;

$petugas		=	$_SESSION["loginname"];
$ref			= 	$_REQUEST['ref'];

//update print status di sales_invoice
$dbpdo = DB::create();
$sqlstr = "select so_ref from delivery_order_detail where ref='$ref'";
$sqldet=$dbpdo->prepare($sqlstr);
$sqldet->execute();
while($datadet = $sqldet->fetch(PDO::FETCH_OBJ)) {
	$so_ref = $datadet->so_ref;

	$sqlstr = "update sales_invoice set print=1 where ref='$so_ref'";
	$sqlsi=$dbpdo->prepare($sqlstr);
	$sqlsi->execute();
}
//---------/\-------------------------

$sql = $selectview->list_delivery_order($ref);
$row_delivery_order=$sql->fetch(PDO::FETCH_OBJ);

$ref			=	$row_delivery_order->ref;
$client_name	=	$row_delivery_order->client_name;
$ship_to		=	$row_delivery_order->ship_to;
$bill_to		=	$row_delivery_order->bill_to;
$phone_cust		=	$row_delivery_order->phone;
if($phone_cust == "") {
	$phone_cust = "-";
}
$address 		=	$row_delivery_order->address; //012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789xxx'; //
$expedition_name= 	$row_delivery_order->expedition_name;

/*---------print header-----------*/
$sqlunit = $select->list_company();
$dataunit = $sqlunit->fetch(PDO::FETCH_OBJ);
$company_name = $dataunit->name;
$bussines_name = $dataunit->businiss_type;

/*$bank_name			=	$dataunit->bank_name;
$bank_account		=	$dataunit->bank_account;
$bank_account_name	=	$dataunit->bank_account_name;*/

/*$sqlunit = $selectview->list_warehouse($_SESSION["location"]);
$dataunit = $sqlunit->fetch(PDO::FETCH_OBJ);

$address = "Jl. A.H. Nasution No. 112, Bandung";
if(!empty($dataunit->address)) {
	$address = $dataunit->address;	
}

$email = "doa@doa.com";
if(!empty($dataunit->email)) {
	$email = $dataunit->email;
}

$phone = "022-7216940";
if(!empty($dataunit->phone)) {
	$phone = $dataunit->phone;
}*/
/*-------------------------------*/


/*---------print detail----------*/
$data		=	array();
$i 			= 	1;		
$size		= 	500;
$sizeadd 	= 	20;

/*-------------------------------------------*/
				



require('pdf/fpdf2.php');
	  	
class PDF extends FPDF
{
	
	var $col=0;
	//Ordinate of column start
	var $y0;
	
	function Header()
	{
		//Page header
		global $company_name;
		global $bussines_name;
		global $address;
		global $phone;
		global $email;
		
		global $ref;
		global $client_name;
		global $ship_to;
		global $bill_to;
		global $date;
		global $phone_cust;
		global $expedition_name;

		if($expedition_name == "") {
			$expedition_name = "FREE SHIPPING";
		}
		
		##----------sender------------		
		$this->SetFont('arial','B',16);		
		$this->Cell(150,0.1,'',1,1,'L',false);

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"Sender",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->SetFont('arial','',14);
		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"DOA Official Store",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"082112933733",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"Jl. Kancra no. 45 Kel. Burangrang",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"Kec. Lengkong 40262",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"Kota Bandung 40262",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"Indonesia",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);
		$this->Cell(150,0.1,'',1,1,'L',false);
		##-----------end sender----------
		$this->Ln(10);
		##------------recipient-------
		$this->SetFont('arial','B',16);		
		$this->Cell(150,0.1,'',1,1,'L',false);

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"Recipient",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->SetFont('arial','',14);
		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,$client_name,0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,$phone_cust,0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		if(strlen($address) <= 50 ) {
			$this->Cell(0.1,7,'',1,0,'L',false);
			$this->Cell(150,7,$address,0,0,'L',false);
			$this->Cell(0.1,7,'',1,1,'L',false);
		}
		if(strlen($address) >50 ) {
			$address1 = substr($address,0,50);
			$address2 = substr($address,50,50);

			$this->Cell(0.1,7,'',1,0,'L',false);
			$this->Cell(150,7,$address1,0,0,'L',false);
			$this->Cell(0.1,7,'',1,1,'L',false);

			$this->Cell(0.1,7,'',1,0,'L',false);
			$this->Cell(150,7,$address2,0,0,'L',false);
			$this->Cell(0.1,7,'',1,1,'L',false);
		}

		/*$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,$address,0,0,'L',false);
		//$this->MultiCell(150,7,$address,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);*/

		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,"Indonesia",0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);

		$this->SetFont('arial','B',16);		
		$this->Cell(0.1,7,'',1,0,'L',false);
		$this->Cell(150,7,$expedition_name,0,0,'L',false);
		$this->Cell(0.1,7,'',1,1,'L',false);
		$this->Cell(150,0.1,'',1,1,'L',false);
		
		
		//Save ordinate
		//$this->y0=$this->GetY();
	}
	
	

	var $B;
	var $I;
	var $U;
	var $HREF;
	
	
	function PDF($orientation='P',$unit='mm', $format='auto') 
	{
		//Call parent constructor
		//$size = 300;
		global $size;
		global $sizeadd;
		
		$this->FPDF2($orientation,$unit,$format,$size); //$size = tinggi
		//Initialization
		$this->B=0;
		$this->I=0;
		$this->U=0;
		$this->HREF='';
		
	}

	//Load data
		
	function LoadData($file)
	{		
		//Read file lines
		//$lines=file($file);
		$lines=($file);
		$cekdata = $file[1];
		if( !empty($cekdata) )  {
			foreach($lines as $line) {
				$data[]=explode(';',$line);
			}
		} else {			
			$data[]=explode(';',$file[0]);
			
		}
			
		//foreach($lines as $data)
			//$data[]=explode(';',chop($line));
		return $data;
	} 
	
	
	function BasicTable($header,$data)
	{
		
				
	} 
	
	
		
}
//===========================				
$pdf=new PDF();

$title='DELIVERY ORDER';
$pdf->SetTitle($title);	
$pdf->SetTitle($nis);	
$pdf->SetTitle($nama);


//$kelas = $tingkat . "/" . $kelas;
//$pdf->SetTitle($kelas);

$pdf->SetTitle($size);


$header=array('Qty','Satuan','Nama Barang');

$data=$pdf->LoadData($data);
$pdf->SetFont('arial','',11);
$pdf->AddPage();

$pdf->BasicTable($header,$data);

$pdf->Output();

?>