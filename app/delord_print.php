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

$dbpdo = DB::create();

$selectview = new selectview;
$select = new select;

$petugas		=	$_SESSION["loginname"];
$ref			= 	$_REQUEST['ref'];

$sql = $selectview->list_delivery_order($ref);
$row_delivery_order=$sql->fetch(PDO::FETCH_OBJ);

$ref			=	$row_delivery_order->ref;
$client_name	=	$row_delivery_order->client_name;
$ship_to		=	$row_delivery_order->address;
$bill_to		=	$row_delivery_order->bill_to;
$phone_cust		=	$row_delivery_order->phone;
$date			=	date("d-m-Y", strtotime($row_delivery_order->date));

$freight_cost 	= 	$row_delivery_order->freight_cost;
$discount2	 	= 	$row_delivery_order->discount;
$total 			= 	$row_delivery_order->total;
$deposit 		= 	$row_delivery_order->deposit;
$grand_total 	= 	$total; //$total - $deposit;


/*---------print header-----------*/
$sqlunit = $select->list_company();
$dataunit = $sqlunit->fetch(PDO::FETCH_OBJ);
$company_name = $dataunit->name;
$bussines_name = $dataunit->businiss_type;

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
$data		=	array();
$i 			= 	1;		
$size		= 	500;
$sizeadd 	= 	20;

$sql2 = $selectview->list_delivery_order_detail($ref);
while($row_delivery_order_detail=$sql2->fetch(PDO::FETCH_OBJ)) {
	
	$qty		=	number_format($row_delivery_order_detail->qty,"2",",",".");
	$explodeqty = 	explode(",", $qty);
	if ($explodeqty[1] == 0) {
		$qty		=	number_format($row_delivery_order_detail->qty,"0",",",".");
	}
	
	$uom_code	=	$row_delivery_order_detail->uom_code;
	$item_name	=	$row_delivery_order_detail->item_name;
	
	$data[]=$qty.';'.$uom_code.';'.$item_name;
	
	$i++;	
	$size = $size + $sizeadd;

	##-----update status sales
	$so_ref = $row_delivery_order_detail->so_ref;
	$sqlstr="update sales_invoice set print=1 where ref='$so_ref'";
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();

}

$noinvoice = "";
$sqlref = $selectview->get_no_ref_quick_detail($ref);
while($row_ref_detail=$sqlref->fetch(PDO::FETCH_OBJ)) {
	if($noinvoice == "") {
		$noinvoice = $row_ref_detail->so_ref;
	} else {
		$noinvoice = $noinvoice . ", " . $row_ref_detail->so_ref;			
	}
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
		global $address;
		global $phone;
		global $email;
		
		global $ref;
		global $client_name;
		global $ship_to;
		global $bill_to;
		global $date;
		global $phone_cust;
				
		$this->SetFont('arial','',11);
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
		$this->Cell(50,5,'Alamat Kantor :' . $address,0,1,'L',false); //. ' Telp./Fax.: ' . $phone
		//$this->Ln(2);
		
		$this->Cell(30,5,'',0,0,'L',false);
		$this->Cell(20,5,$email,0,1,'L',false);
		//$this->Ln(2);
		
		$this->SetFont('arial','U',11);
		$this->Cell(145,5,'DELIVERY ORDER',0,0,'L',true);
		$this->Cell(50,5,'No : ' . $ref,0,1,'R',false);
		//$this->Ln(2);
		
		$this->SetFont('arial','',11);
		$this->Cell(34,5,'Nama',0,0,'L',true);
		$this->Cell(2,5,':',0,0,'L',false);
		$this->Cell(120,5,$client_name,0,0,'L',false);
		$this->Cell(20,5,'Tanggal : ' . $date,0,1,'L',false);
		//$this->Ln(2);
		
		$this->Cell(34,5,'Alamat',0,0,'L',true);
		$this->Cell(2,5,':',0,0,'L',false);
		$this->MultiCell(120,5,$ship_to,0,1,'L',true);
		//$this->Ln(2);
		
		$this->Cell(34,5,'No. Telepon',0,0,'L',true);
		$this->Cell(2,5,':',0,0,'L',false);
		$this->Cell(50,5,$phone_cust,0,1,'L',true);
		$this->Ln(2);
		
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
		//Header
		$i=0;				
		foreach($header as $col) {
			if ($i==0) { $this->Cell(15,6,$col,1,0,"C"); }
			if ($i==1) { $this->Cell(15,6,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(164,6,$col,1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		
		//Data		
		foreach($data as $row)
		{	
			$i=0;
			foreach($row as $col) {
				
				if ($i==0) { $this->Cell(15,6,$col,1,0,"C"); }
				if ($i==1) { $this->Cell(15,6,$col,1,0,"C"); }
				if ($i==2) { $this->Cell(164,6,$col,1,0,"L"); }
				$i++;
			}
			$this->Ln();
			
		}	
		
		//-----set sub group
		global $noinvoice;
		global $client_name;
		global $petugas;
		
		
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Ln(1);
		$this->SetFont('arial','',10);
		$this->Cell(112,5,'No Invoice : ' . $noinvoice,0,1,'C',true);
		$this->Ln(2);
		
		//$size = $size + $sizeadd;
		
		//---------
		$this->SetFont('arial','',11);
		$this->Cell(95,5,'Pelanggan',0,0,'C',true);
		$this->Cell(59,5,'Petugas',0,1,'C',true);	
		$this->Ln(7);
		
		$this->Cell(95,5,'( ' . $client_name . ' )',0,0,'C',true);	
		$this->Cell(58,5,'( ' . $petugas . ' )',0,0,'C',true);	
		//$this->Ln(2);
		
		$size = $size + $sizeadd;
		
		
		$this->Ln(10);

		$this->Cell(95,5,'Catatan :',0,1,'L',false);
		$this->Cell(195,5,'Dimohon sertakan video unboxing untuk permohonan Retur/Refund',0,0,'L',false);
		$this->Ln(2);		
		
				
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