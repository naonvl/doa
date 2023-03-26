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

include "phpqrcode/qrlib.php"; //<-- LOKASI FILE UTAMA PLUGINNYA

$selectview = new selectview;
$select = new select;

$ref			= 	$_REQUEST['ref'];

$sql = $select->list_item($ref);
$row_item=$sql->fetch(PDO::FETCH_OBJ);

$qrcode			=	$row_item->code; //syscode;
$code 			=	substr($row_item->code,0,18);
$name 			=	substr($row_item->name,0,22);
//DOABKRCALANTHABLUEB
//set current price
$sqlprice = $select->list_set_item_price_last("", $row_item->syscode);
$dataprice = $sqlprice->fetch(PDO::FETCH_OBJ);
$current_price = number_format($dataprice->current_price,0,'.',',');

//create QRCode--------------
//$isi_teks = '{"nama":"'.$qrcode.'","tinggi":"120"}';
$isi_teks = $qrcode;
//$ref = "qrcode";
$tempdir = "phpqrcode/qrcode/";
$url2 = $ref; //$public_url.obraxabrix('press')."/".$ref."/".$machine_id;
//$isi_teks = $url2; //get_current_url($_SERVER); //inputan fungsi tadi itu cuma $_SERVER aja
$namafile = $ref;
$quality = 'H';
$ukuran = 20;
$padding = 2;

QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
//---------------/\----------

/*---------print detail----------*/
$data		=	array();
$i 			= 	1;		
$size		= 	1000; //1500;
$sizeadd 	= 	30;

$sizeadd_qr	= 	7; //25; //30
$size_qr	=   5; //115;

$so_ref1		=	"";

$size_qr = $size_qr + $sizeadd_qr;
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
		global $bussines_type;
		
		global $address;
		global $phone;
		global $email;
		
		global $ref;
		global $qrcode;
		global $so_ref;
		global $client_name;
		global $address_client;
		global $date;
		global $dlu;
		global $operator;
				
		$this->SetFont('Arial','',16);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		
		$this->SetFont('Arial','',14);
		
		//Save ordinate
		$this->y0=$this->GetY();
	}
	
	

	var $B;
	var $I;
	var $U;
	var $HREF;
	
	
	function PDF($orientation='P',$unit='mm', $format='qrcode') //tmsize
	{
		//Call parent constructor
		//$size = 300;
		global $size;
		global $sizeadd;
		
		$this->FPDF2($orientation,$unit,$format,140,350); //$size = tinggi
		//Initialization
		$this->B=0;
		$this->I=0;
		$this->U=0;
		$this->HREF='';
		
	}

	//Load data
		
	function LoadData($file)
	{		
		
	} 
	
	
	function BasicTable($header,$data)
	{
		
		$this->SetFont('Arial','',11);
		
		//-----set sub group
		global $ref;
		global $name;
		global $code;
		global $current_price;
				
		$this->SetFillColor(255,255,255);
				
		//$this->Ln(-5);
		$this->Ln(1);
		$this->SetFont('Arial','',10);
		
		$qrcode_position = 9;
		for($t=0; $t<1; $t++) {
			$size_qr = $size_qr + 10;
			/*$this->Ln($size_qr-112);*/
			//$this->Cell(100,3,$name,0,1,'C',false);
			//$this->Cell(56,1,'',0,0,'L',false);
			//$this->Cell(50,5,'WOMEN',0,1,'L',false);

			$this->Image('phpqrcode/qrcode/'.$ref, 1, $qrcode_position, 15, 15, 'png', '');
			$this->Cell(6,3,'',0,0,'L',false);
			$this->Cell(40,0.1,'',1,1,'L',false);

			//------kolom kanan
			$this->Image('phpqrcode/qrcode/'.$ref, 63, $qrcode_position, 15, 15, 'png', '');
			$this->Cell(68,3,'',0,0,'L',false);
			$this->Cell(40,0.1,'',1,1,'L',false);
			//-----------------

			$this->Cell(6,3,'',0,0,'L',false);
			$this->Cell(40,3,'DOA',0,0,'C',false);

			//------kolom kanan
			$this->Cell(20,3,'',0,0,'L',false);
			$this->Cell(40,3,'DOA',0,1,'C',false);
			//----------------

			$this->Cell(6,3,'',0,0,'L',false);
			$this->Cell(40,0.1,'',1,0,'L',false);

			//------kolom kanan
			$this->Cell(22,3,'',0,0,'L',false);
			$this->Cell(40,0.1,'',1,1,'L',false);
			//----------------

			$this->Cell(6,3,'',0,0,'L',false);
			$this->Cell(40,4,$code,0,0,'L',false);

			//------kolom kanan
			$this->Cell(22,3,'',0,0,'L',false);
			$this->Cell(40,4,$code,0,1,'L',false);
			//----------------

			$this->Cell(6,3,'',0,0,'L',false);
			$this->Cell(40,3,$name,0,0,'L',false);

			//------kolom kanan
			$this->Cell(22,3,'',0,0,'L',false);
			$this->Cell(40,3,$name,0,1,'L',false);
			//----------------

			$this->SetFont('Arial','B',10);
			$this->Cell(6,3,'',0,0,'L',false);
			$this->Cell(40,3,'IDR '.$current_price,0,0,'R',false);

			//------kolom kanan
			$this->Cell(22,3,'',0,0,'L',false);
			$this->Cell(40,3,'IDR '.$current_price,0,1,'R',false);
			//----------------

			$this->SetFont('Arial','',10);
			$this->Cell(6,3,'',0,0,'L',false);
			$this->Cell(40,3,'www.doaindonesia.id',0,0,'R',false);

			//------kolom kanan
			$this->Cell(22,3,'',0,0,'L',false);
			$this->Cell(40,3,'www.doaindonesia.id',0,1,'R',false);
			//----------------

			$this->Ln(5);
			
			if($t > 0) {
				$add = 0; //$add + 1;
				$qrcode_position = $qrcode_position + 18 + $add;
			}
			//$size = $size + $sizeadd;		
		}

		//hapus file qrcode
		unlink('phpqrcode/qrcode/' . $ref);

	} 
	
	
		
}
//===========================				
$pdf=new PDF();

$title='QRCode';
/*$pdf->SetTitle($title);	
$pdf->SetTitle($nis);	
$pdf->SetTitle($nama);

$pdf->SetTitle($size);*/

$header=array('No.','Artikel','Size','Qty','');

$data=$pdf->LoadData($data);
$pdf->SetFont('Arial','',11);
$pdf->AddPage();

$pdf->BasicTable($header,$data);
$pdf->Output();


?>

?>