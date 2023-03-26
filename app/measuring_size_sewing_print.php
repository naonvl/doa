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
$so_ref			= 	$_REQUEST['so_ref'];

$sql = $selectview->list_measuring_size_sewing($ref);
$row_receipt=$sql->fetch(PDO::FETCH_OBJ);

$ref			=	$row_receipt->ref;
//$so_ref			=	$row_receipt->so_ref;
$client_name	=	$row_receipt->client_name;
$series			=	$row_receipt->series;
$br				=	$row_receipt->br;
$qty			=	number_format($row_receipt->qty,0,'.',',');
$date			=	date("d-m-Y", strtotime($row_receipt->date));
$machine_print 	= 	$row_receipt->machine_print;
$machine_press 	= 	$row_receipt->machine_press;
$mcn_press_speed =	$row_receipt->mcn_press_speed;
$mcn_press_temperature =	$row_receipt->mcn_press_temperature;
$sampling_name 	=	$row_receipt->sampling_name;

if($row_receipt->label == 0) {
	$label 			=	"Tidak";
}
if($row_receipt->label == 1) {
	$label 			=	"Ya";
}

$memo 			=	$row_receipt->memo;
$photo 			=	$row_receipt->photo;
$photo1 		=	$row_receipt->photo1;
$photo2 		=	$row_receipt->photo2;
$photo3 		=	$row_receipt->photo3;
$photo4 		=	$row_receipt->photo4;
$photo5 		=	$row_receipt->photo5;
$photo6 		=	$row_receipt->photo6;
$photo7 		=	$row_receipt->photo7;
$acc_date_client=	date("d-m-Y", strtotime($row_receipt->acc_date_client));

/*---------print header-----------*/
$sqlcmp=$select->list_company();
$row_company=$sqlcmp->fetch(PDO::FETCH_OBJ);

$company_name = $row_company->name;
$bussines_type= $row_company->businiss_type;
					
$sqlunit = $selectview->list_warehouse($_SESSION["location"]);
$dataunit = $sqlunit->fetch(PDO::FETCH_OBJ);

$address = $row_company->address1; //"Jl. Sample No. 21, Bandung";
if(!empty($dataunit->address)) {
	$address = $dataunit->address;	
}

$email = $row_company->email; //"nadhif@programmer.net";
if(!empty($dataunit->email)) {
	$email = $dataunit->email;
}

$phone = $row_company->phone1; //"0813-38251798";
if(!empty($dataunit->phone)) {
	$phone = $dataunit->phone;
}
/*-------------------------------*/

/*---------print detail----------*/
$data		=	array();
$i 			= 	1;		
$size		= 	500;
$sizeadd 	= 	20;


$sql2 = $selectview->list_measuring_size_sewing_detail($ref);
while($row_delivery_order_detail=$sql2->fetch(PDO::FETCH_OBJ)) {
	
	$name		=	$row_delivery_order_detail->name;
	$size1		=	$row_delivery_order_detail->size;
	$uom_code	=	$row_delivery_order_detail->uom_code;
			
	$data[]=$i.';'.$name.';'.$size1.';'.$uom_code;
	
	$i++;	
	$size = $size + $sizeadd;

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
		global $bussines_type;
		
		global $address;
		global $phone;
		global $email;
		
		$this->SetFont('Arial','',10);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Ln(13);
		$this->Cell(200,3,'',0,0,'C',false);
		//$this->Cell(90,3,$company_name,0,1,'C',false);
		$this->Image('../assets/img/logo.jpg', 88, 10, 45, 13, 'jpg', '');
		$this->Ln(1);
		
		/*$this->Cell(46,3,'',0,0,'L',false);
		$this->Cell(20,3,$bussines_type,0,1,'L',false);
		$this->Ln(1);*/


		$this->Cell(46,3,'',0,0,'C',false);
		//$this->Cell(50,3,'Alamat Kantor :' . $address . ' Telp: ' . $phone,0,1,'L',false);
		$this->Cell(115,3,$address,0,1,'C',false);
		$this->Ln(2);
		
		// $this->Cell(26,3,'',0,0,'L',false);
		// $this->Cell(20,3,'',0,1,'L',false); //$email
		// $this->Ln(2);
		
		$this->SetFont('Arial','',11);
		$this->Cell(200,5,'MEASURING SIZE JAHIT',0,1,'C',true);
		//$this->Cell(50,5,'No : ' . $ref,0,1,'R',false);
		$this->Ln(2);
		
		

		//Save ordinate
		$this->y0=$this->GetY();
	}
	
	

	var $B;
	var $I;
	var $U;
	var $HREF;
	
	
	function PDF($orientation='P',$unit='mm', $format='a4') 
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

		global $so_ref;
		global $ref;
		global $client_name;
		global $series;
		global $date;
		global $br;
		global $qty;
		global $machine_print;
		global $machine_press;
		global $mcn_press_speed;
		global $mcn_press_temperature;
		global $sampling_name;
		global $label;

		global $photo;
		global $photo1;
		global $photo2;
		global $photo3;
		global $photo4;
		global $photo5;
		global $photo6;
		global $photo7;

		$photo_type = substr($photo, strlen($photo)-3, 3);
		if($photo_type == 'peg') {
			$photo_type = substr($photo, strlen($photo)-4, 4);
		}

		$photo1_type = substr($photo1, strlen($photo1)-3, 3);
		if($photo1_type == 'peg') {
			$photo1_type = substr($photo1, strlen($photo1)-4, 4);
		}

		$photo2_type = substr($photo2, strlen($photo2)-3, 3);
		if($photo2_type == 'peg') {
			$photo2_type = substr($photo2, strlen($photo2)-4, 4);
		}

		$photo3_type = substr($photo3, strlen($photo3)-3, 3);
		if($photo3_type == 'peg') {
			$photo3_type = substr($photo3, strlen($photo3)-4, 4);
		}
		

		$this->Cell(30,3,'NO MS',0,0,'L',false);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(80,3,$ref,0,1,'L',false);
		$this->Ln(2);

		$this->Cell(30,3,'TANGGAL',0,0,'L',false);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(80,3,$date,0,0,'L',false);
		//$this->Ln(2);

		$this->Cell(30,3,'BR',0,0,'L',false);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(20,3,$br,0,1,'L',false);
		$this->Ln(2);

		$this->SetFont('Arial','',10);
		$this->Cell(30,3,'NO PO',0,0,'L',false);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(80,3,$so_ref,0,0,'L',false);
		//$this->Ln(2);

		$this->Cell(30,3,'QTY',0,0,'L',false);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(20,3,$qty,0,1,'L',false);
		$this->Ln(2);

		$this->Cell(30,3,'BRAND',0,0,'L',false);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(20,3,$client_name,0,1,'L',false);	
		$this->Ln(2);

		$this->Cell(30,3,'SERIES',0,0,'L',false);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(80,3,$series,0,0,'L',false);
		//$this->Ln(2);

		$this->Cell(30,3,'LABEL',0,0,'L',false);
		$this->Cell(2,3,':',0,0,'L',false);
		$this->Cell(20,3,$label,0,1,'L',false);
		$this->Ln(2);
		
		$this->Cell(30,5,'PRINT',1,0,'L',false);
		$this->Cell(20,5,'MESIN',1,0,'L',false);
		$this->Cell(30,5,$machine_print,1,0,'L',false);
		$this->Cell(25,5,'DETAIL FILE',1,0,'L',false);
		$this->Cell(45,5,'',1,1,'L',false);
		$this->Ln(0);

		$this->Cell(30,5,'PRESS',1,0,'L',false);
		$this->Cell(20,5,'MESIN',1,0,'L',false);
		$this->Cell(30,5,$machine_press,1,0,'L',false);
		$this->Cell(25,5,'SPEED',1,0,'L',false);
		$this->Cell(15,5,$mcn_press_speed,1,0,'L',false);
		$this->Cell(15,5,'TEMP.',1,0,'L',false);
		$this->Cell(15,5,$mcn_press_temperature,1,1,'L',false);
		$this->Ln(0);

		$this->Cell(30,5,'SAMPLING',1,0,'L',false);
		$this->Cell(20,5,$sampling_name,1,1,'L',false);
		$this->Ln(2);

		$this->Cell(200,3,'',0,0,'L',false);


		if($photo != "") {
			$this->Image('../app/photo_ms/'.$photo, 40, 75, 60, 50, $photo_type, false);
		}

		if($photo1 != "") {
			$this->Image('../app/photo_ms/'.$photo1, 110, 75, 60, 50, $photo1_type, false);
		}
		$this->Ln(2);

		$this->Cell(200,3,'',0,0,'L',false);

		if($photo2 != "") {
			$this->Image('../app/photo_ms/'.$photo2, 40, 130, 60, 50, $photo2_type, false);
		}

		if($photo3 != "") {
			$this->Image('../app/photo_ms/'.$photo3, 110, 130, 60, 50, $photo3_type, false);
		}

		//---------------------------
		if($photo4 != "") {
			$this->Image('../app/photo_ms/'.$photo4, 40, 185, 60, 50, $photo4_type, false);
		}

		if($photo5 != "") {
			$this->Image('../app/photo_ms/'.$photo5, 110, 185, 60, 50, $photo5_type, false);
		}
		$this->Ln(2);

		$this->Cell(200,3,'',0,0,'L',false);

		if($photo6 != "") {
			$this->Image('../app/photo_ms/'.$photo6, 40, 240, 60, 50, $photo6_type, false);
		}

		if($photo7 != "") {
			$this->Image('../app/photo_ms/'.$photo7, 110, 240, 60, 50, $photo7_type, false);
		}


		if ( ($photo != "" || $photo1 != "") && $photo2 == "" && $photo3 == "" && $photo4 == "" && $photo5 == "" && $photo6 == "" && $photo7 == "") {
			$this->Ln(55);
		} else if ( ($photo != "" || $photo1 != "") && ($photo2 != "" || $photo3 != "") && $photo4 == "" && $photo5 == "" && $photo6 == "" && $photo7 == "") {
			$this->Ln(105);
		} else if ( ($photo != "" || $photo1 != "") && ($photo2 != "" || $photo3 != "") && ($photo4 != "" || $photo5 != "") && $photo6 == "" && $photo7 == "") {
			$this->Ln(165);
		} else if ( ($photo != "" || $photo1 != "") && ($photo2 != "" || $photo3 != "") && ($photo4 != "" || $photo5 != "") && ($photo6 != "" || $photo7 != "") ) {
			$this->Ln(215);
		} else {
			$this->Ln(2);
		}
		


		//Header
		
		$this->SetFont('Arial','',10);
		
		$i=0;				
		foreach($header as $col) {
			if ($i==0) { $this->Cell(13,7,$col,1,0,"C"); }
			if ($i==1) { $this->Cell(114,7,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(21,7,$col,1,0,"C"); }
			if ($i==3) { $this->Cell(15,7,$col,1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		global $total_sisa2;
		$total_sisa = 0;
		
		//Data		
		foreach($data as $row)
		{	
			$i=0;
			foreach($row as $col) {
				if ($i==0) { $this->Cell(13,6,$col,1,0,"C"); }
				if ($i==1) { $this->Cell(114,6,$col,1,0,"L"); }
				if ($i==2) { $this->Cell(21,6,$col,1,0,"C"); }
				if ($i==3) { $this->Cell(15,6,$col,1,0,"C"); }
				$i++;
			}
			$this->Ln();
			
		}	
		
		//-----set sub group
		global $memo;
		global $acc_date_client;

		if( $acc_date_client == '01-01-1970') {
			$acc_date_client = '';
		}
		
		$this->Ln(1);
		//-----------
		$this->SetFont('Arial','',10);

		$this->Cell(50,5,'Approve Tanggal Customer :',0,0,'L',false);
		$this->Cell(20,5,$acc_date_client,0,1,'L',false);
		$this->Ln(2);

		$this->SetFont('Arial','I',10);
		$this->Cell(20,5,'Memo :',0,1,'L',false);
		
		$this->SetFont('Arial','',10);
		$this->MultiCell(190,5,$memo,0,'J','');
		$this->Ln(2);

		//MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false)
		//---------
		$this->SetFont('Arial','',10);
		$this->Cell(60,5,'Menyetujui',0,0,'C',false);
		$this->Cell(60,5,'',0,0,'C',false);
		$this->Cell(60,5,'Hormat Kami',0,1,'C',false);	
		$this->Ln(15);
		
		$size = $size + $sizeadd;
		
		$this->Cell(60,5,'( ' . '..................................' . ' )',0,0,'C',false);	
		$this->Cell(60,5,' ' . '' . ' ',0,0,'C',false);	
		$this->Cell(60,5,'( ' . '..................................' . ' )',0,1,'C',false);	
		$this->Ln(2);
		
	} 
	
	
		
}
//===========================				
$pdf=new PDF();

$title='DELIVERY ORDER';
$pdf->SetTitle($title);	
$pdf->SetTitle($nis);	
$pdf->SetTitle($nama);


//$terbilang = "(" . KalimatUang($total) . ")";
//$pdf->SetTitle($terbilang);

//$total = number_format($total,"0",".",",");
//$total2 = number_format($total2,"0",".",",");
//$pdf->SetTitle($total);
$pdf->SetTitle($size);

/*$G_LOKASI = "Bandung";
$uid = $petugas; //$_SESSION["loginname"];
$tanggalcetak = $G_LOKASI . ", " . $tglcetak;
$getuser = "(". $uid . ")";
*/

$header=array('No.','Keterangan','Size','Satuan');

$data=$pdf->LoadData($data);
//$data2=$pdf->LoadData($data2);
$pdf->SetFont('Arial','',11);
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