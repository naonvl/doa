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

include 'class/class.select.php';
include 'class/class.selectview.php';
$select = new select;
$selectview = new selectview;

$petugas		=	$_SESSION["loginname"];
$ref			= 	$_REQUEST['ref'];

$sql = $selectview->list_outbound($ref);
$row_outbound=$sql->fetch(PDO::FETCH_OBJ);

$ref			=	$row_outbound->ref;
$client_name	=	$row_outbound->client_name;
$loc_from		=	$row_outbound->from_location;
$loc_to			=	$row_outbound->to_location;
$employee_name	=	$row_outbound->employee_name;
$employee_name2 =	$row_outbound->employee_name2;
$date			=	date("d-m-Y", strtotime($row_outbound->date));

/*---------print header-----------*/
$sqlunit = $select->list_company();
$dataunit = $sqlunit->fetch(PDO::FETCH_OBJ);
$company_name = $dataunit->name;
$bussines_name = $dataunit->businiss_type;
$address1 = $dataunit->address1;

$bank_name			=	$dataunit->bank_name;
$bank_account		=	$dataunit->bank_account;
$bank_account_name	=	$dataunit->bank_account_name;

$sqlunit = $selectview->list_warehouse($_SESSION["location"]);
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
}

/*-------------------------------*/

/*---------print detail----------*/
$total_qty 	=	0;
$data		=	array();
$i 			= 	1;		
$size		= 	500;
$sizeadd 	= 	20;

$sql2 = $selectview->list_outbound_detail($ref);
while($row_outbound_detail=$sql2->fetch(PDO::FETCH_OBJ)) {
	
	$qty		=	number_format($row_outbound_detail->qty,"2",",",".");
	$explodeqty = 	explode(",", $qty);
	if ($explodeqty[1] == 0) {
		$qty		=	number_format($row_outbound_detail->qty,"0",",",".");
	}
	
	$item_code	=	$row_outbound_detail->item_code2;
	$uom_code	=	$row_outbound_detail->uom_code;
	$item_name	=	substr($row_outbound_detail->item_name,0,44);
	
	$total_qty 	=	$total_qty + $qty;

	$data[]=$qty.';'.$uom_code.';'.$item_code.';'.$item_name;
	
	$i++;	
	//$size = $size + $sizeadd;

}

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
		global $address1;
		global $phone;
		global $email;
		
		global $ref;
		global $loc_from;
		global $loc_to;
		global $bill_to;
		global $date;
				
		$this->SetFont('arial','',12);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Cell(30,0,'',0,0,'L',false);
		$this->Cell(50,5,$company_name,0,1,'L',false);
		//$this->Image('../assets/img/logo.jpg', 10, 5, 25, 15, 'jpg', '');
		$this->Image('../images/logo-doa.jpg', 12, 9, 23, 15, 'jpg', '');
		//$this->Ln(1);
		
		$this->Cell(30,5,'',0,0,'L',false);
		$this->Cell(20,5,$bussines_name,0,1,'L',false); //'INDUSTRI DAN DISTRIBUSI MATERIAL BAHAN BANGUNAN'
		//$this->Ln(1);
		
		$this->Cell(30,5,'',0,0,'L',false);
		$this->Cell(50,5,'Alamat :' . $address1,0,1,'L',false); //. ' Telp./Fax.: ' . $phone
		//$this->Ln(2);
		
		$this->Cell(30,5,'',0,0,'L',false);
		$this->Cell(20,5,$email,0,1,'L',false);
		//$this->Ln(2);
		
		$this->SetFont('arial','U',11);
		$this->Cell(145,5,'PEMINDAHAN BARANG',0,0,'L',true);
		$this->Cell(50,5,'No : ' . $ref,0,1,'R',false);
		//$this->Ln(2);
		
		$this->SetFont('arial','',12);
		$this->Cell(36,5,'Dari Lokasi',0,0,'L',true);
		$this->Cell(2,5,':',0,0,'L',false);
		$this->Cell(115,5,$loc_from,0,0,'L',false);
		$this->Cell(20,5,'Tanggal : ' . $date,0,1,'L',false);
		//$this->Ln(2);
		
		$this->Cell(36,5,'Ke Lokasi',0,0,'L',true);
		$this->Cell(2,5,':',0,0,'L',false);
		$this->MultiCell(120,5,$loc_to,0,1,'L',true);
		//$this->Ln(2);
		
		$this->Ln(2);
		
		//Save ordinate
		//$this->y0=$this->GetY();
	}
	
	

	var $B;
	var $I;
	var $U;
	var $HREF;
	
	
	function PDF($orientation='P',$unit='mm', $format='A4') 
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
		//Header
		$i=0;				
		foreach($header as $col) {
			if ($i==0) { $this->Cell(13,6,$col,1,0,"C"); }
			if ($i==1) { $this->Cell(16,6,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(40,6,$col,1,0,"C"); }
			if ($i==3) { $this->Cell(125,6,$col,1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		
		//Data		
		foreach($data as $row)
		{	
			$i=0;
			foreach($row as $col) {
				
				if ($i==0) { $this->Cell(13,6,$col,1,0,"C"); }
				if ($i==1) { $this->Cell(16,6,$col,1,0,"C"); }
				if ($i==2) { $this->Cell(40,6,$col,1,0,"L"); }
				if ($i==3) { $this->Cell(125,6,$col,1,0,"L"); }
				$i++;
			}
			$this->Ln();
			
		}	
		
		//-----set sub group
		global $total_qty;
		global $employee_name;
		global $employee_name2;
				
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetFont('arial','',12);
		
		/*$this->SetFont('arial','',12);
		$this->Cell(144,5,'Terbilang :',0,0,'L',false);
		$this->SetFont('arial','',12);
		$this->Cell(25,5,'Sub Total',0,0,'R',false);*/
		$this->Cell(13,5,$total_qty,0,1,'C',false);
		/*$this->SetFont('arial','',10);
		$this->Cell(144,5,$terbilang,0,0,'L',true);	
		$this->SetFont('arial','',12);
		$this->Cell(25,5,'Ongkos Kirim',0,0,'R',false);
		$this->Cell(25,5,$freight_cost,0,1,'R',false);	
		
		$this->Cell(169,5,'Discount',0,0,'R',false);
		$this->Cell(25,5,$discount2,0,1,'R',false);	*/
		
		//-----------
		$this->SetFont('arial','',10);
		$this->Cell(144,5,'',0,0,'L',true);		
		//-------------
		
		$this->SetFont('arial','',12);
		//$this->Cell(144,5,'',0,0,'L',true);	
		$this->Cell(25,5,'',0,1,'R',false);
		
		$this->SetFont('arial','',10);
		$this->Cell(144,5,'',0,1,'L',true);		
		//$this->Ln(0);
		
		
		//---------
		$this->SetFont('arial','',12);
		$this->Cell(95,5,'Yang Mengeluarkan',0,0,'C',true);
		$this->Cell(49,5,'Yang Menerima',0,1,'C',true);	
		$this->Ln(10);
		
		$this->Cell(95,5,'( ' . $employee_name . ' )',0,0,'C',true);	
		$this->Cell(48,5,'( ' . $employee_name2 . ' )',0,0,'C',true);	
		$this->Ln(10);
		
		$size = $size + $sizeadd;
		
		$this->Ln(2);
		
				
	} 
	
	
		
}
//===========================				
$pdf=new PDF();

$title='FAKTUR / INVOICE';
$pdf->SetTitle($title);	
$pdf->SetTitle($nis);	
$pdf->SetTitle($nama);


//$terbilang = "(" . KalimatUang($total) . ")";
//$pdf->SetTitle($terbilang);

$kelas = $tingkat . "/" . $kelas;
$pdf->SetTitle($kelas);
//$total = number_format($total,"0",".",",");
//$total2 = number_format($total2,"0",".",",");
//$pdf->SetTitle($total);
$pdf->SetTitle($size);

/*$G_LOKASI = "Bandung";
$uid = $petugas; //$_SESSION["loginname"];
$tanggalcetak = $G_LOKASI . ", " . $tglcetak;
$getuser = "(". $uid . ")";
*/

$header=array('Qty','Satuan','Kode Barang','Nama Barang');
//$header2=array('No.','Jenis Biaya','Besarnya');
//Data loading
//$data=$pdf->LoadData('poa.txt');

$data=$pdf->LoadData($data);
//$data2=$pdf->LoadData($data2);
$pdf->SetFont('arial','',12);
$pdf->AddPage();

//if($jmldata > 0) {
	$pdf->BasicTable($header,$data);
//} 

/*
if($jmldata1 > 0) {
	$pdf->BasicTable2($header2,$data2);
} */

/*$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);*/

$pdf->Output();

?>