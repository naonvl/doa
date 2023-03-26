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

$from_date	            =    $_REQUEST['from_date'];
$to_date		    	=    $_REQUEST['to_date'];
$all			       	=    $_REQUEST['all'];

/*---------print detail----------*/
$data		=	array();
$i 			= 	1;		
$size		= 	500;
$sizeadd 	= 	20;

$sql2 = $select->list_outbound("", $from_date, $to_date, $all);
while($row_outbound=$sql2->fetch(PDO::FETCH_OBJ)) {
	
	$status = $row_outbound->status;
    if($status == "P") {
		$status = "Planned";
	}
	if($status == "R") {
		$status = "Released";
	}
	if($status == "C") {
		$status = "Receipt";
	}

	$ref		=	$row_outbound->ref;
	$date		=	date('d-m-Y', strtotime($row_outbound->date));
	$from_location	=	$row_outbound->from_location;
	$to_location	=	$row_outbound->to_location;
	$employee_name	=	$row_outbound->employee_name;
	$employee_name2	=	$row_outbound->employee_name2;
	$qty	=	number_format($row_outbound->qty,"0",".",",");
	 
	$data[]=$i.';'.$ref.';'.$date.';'.$from_location.';'.$to_location.';'.$employee_name.';'.$employee_name2.';'.$qty.';'.$status;
	
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
				
		//Save ordinate
		//$this->y0=$this->GetY();

		$this->SetFont('arial','B',11);

		$this->Cell(200,7,'DAFTAR PEMINDAHAN BARANG',0,1,'L',false);
		$this->Ln(2);

		$this->SetFont('arial','',11);
	}
	
	

	var $B;
	var $I;
	var $U;
	var $HREF;
	
	
	function PDF($orientation='L',$unit='mm', $format='A4') 
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
			if ($i==1) { $this->Cell(37,6,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(27,6,$col,1,0,"C"); }
			if ($i==3) { $this->Cell(45,6,$col,1,0,"C"); }
			if ($i==4) { $this->Cell(45,6,$col,1,0,"C"); }
			if ($i==5) { $this->Cell(40,6,$col,1,0,"C"); }
			if ($i==6) { $this->Cell(40,6,$col,1,0,"C"); }
			if ($i==7) { $this->Cell(15,6,$col,1,0,"C"); }
			if ($i==8) { $this->Cell(20,6,$col,1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		
		//Data		
		foreach($data as $row)
		{	
			$i=0;
			foreach($row as $col) {
				
				if ($i==0) { $this->Cell(13,6,$col,1,0,"C"); }
				if ($i==1) { $this->Cell(37,6,$col,1,0,"L"); }
				if ($i==2) { $this->Cell(27,6,$col,1,0,"L"); }
				if ($i==3) { $this->Cell(45,6,$col,1,0,"L"); }
				if ($i==4) { $this->Cell(45,6,$col,1,0,"L"); }
				if ($i==5) { $this->Cell(40,6,$col,1,0,"L"); }
				if ($i==6) { $this->Cell(40,6,$col,1,0,"L"); }
				if ($i==7) { $this->Cell(15,6,$col,1,0,"C"); }
				if ($i==8) { $this->Cell(20,6,$col,1,0,"L"); }
				$i++;
			}
			$this->Ln();
			
		}	
		
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetFont('arial','',11);
		
		//$size = $size + $sizeadd;
        $freight_cost_tmp = $freight_cost;
        $deposit_tmp      = $deposit;
        
		
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

$kelas = $tingkat . "/" . $kelas;
$pdf->SetTitle($kelas);
$pdf->SetTitle($size);

$header=array('No','No. Ref','Tanggal','Dari Gudang','Ke Gudang','Nama Pengirim','Nama Penerima','Jumlah','Status');

$data=$pdf->LoadData($data);
//$data2=$pdf->LoadData($data2);
$pdf->SetFont('arial','',12);
$pdf->AddPage();

//if($jmldata > 0) {
	$pdf->BasicTable($header,$data);
//} 

$pdf->Output();

?>