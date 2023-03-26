<?php
session_start();
            
error_reporting(E_ALL & ~E_NOTICE);

if (($_SESSION["logged"] == 0)) {
  echo 'Access denied';
  exit;
}

include_once ("include/sambung.php");
include_once ("include/functions.php");

include 'class/class.select.php';
include 'class/class.selectview.php';
$select 		= new select;
$selectview 	= new selectview;

$petugas		=	$_SESSION["loginname"];
$ref			= 	$_REQUEST['ref'];

$dbpdo = DB::create();

require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();

$html = '
  <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<table>
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
</table>
';

$sql = $select->list_do_good_receipt_qc($ref);
$row_invoice=$sql->fetch(PDO::FETCH_OBJ);

$ref			=	$row_invoice->ref;
$so_ref			=	$row_invoice->so_ref;
$date			=	date("d-m-Y", strtotime($row_invoice->date));
$op_qc			=	$row_invoice->uid;
$vendor_name	=	$row_invoice->vendor_name;

$sql_so = $select->list_sales_order($so_ref);
$row_so=$sql_so->fetch(PDO::FETCH_OBJ);
$client_name    =  $row_so->client_name;

/*---------print header-----------*/
$sqlunit = $select->list_company();
$dataunit = $sqlunit->fetch(PDO::FETCH_OBJ);

$company_name = $row_company->name;
$bussines_type= $row_company->businiss_type;
					
$sqlunit = $selectview->list_warehouse($_SESSION["location_id"]);
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

$output = "
  <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    text-align: left;
}
</style>

<table border='0' width='100%' style='text-align: center'>
	<tr style='font-size: 14px'>
    	<th style='text-align: center' colspan='6'><img src='..//images/logo-doa.jpg' width='120' height='50'></th>
  </tr>
  <tr>
    <td style='text-align: center' colspan='6'>".$address."</td>
  </tr>
</table>
  ";


$output .= "
  <table border='0' width='100%' style='text-align: center'>
	  <tr>
	    <td style='text-align: center' colspan='3'><font style='font-size: 18px; font-weight: bold'>FORM QC VENDOR</font></td>
	  </tr>
	</table>";

  $output .= "<table border='0' width='100%' style='text-align: center; font-size: 14px;'>
  <tr>
    <td colspan='1' width='10%' style='border-right 1px solid #ffffff'>NO QC</td>
    <td colspan='1' width='45%'>: ".$ref."</td>
  </tr>
  <tr>
    <td colspan='1'>NO PO</td>
    <td colspan='1'>: ".$so_ref."</td>
  </tr>
  <tr>
    <td colspan='1'>NAMA BRAND</td>
    <td colspan='1'>: ".$client_name."</td>
  </tr>
  <tr>
    <td colspan='1'>TANGGAL QC</td>
    <td colspan='1'>: ".$date."</td>
  </tr>
  <tr>
    <td colspan='1'>OP QC</td>
    <td colspan='1'>: ".$op_qc."</td>
  </tr>
  <tr>
    <td colspan='1'>NAMA VENDOR</td>
    <td colspan='1'>: ".$vendor_name."</td>
  </tr>
  </table>
  <br>
";

$output .= '<table border="1" width="100%" style="text-align: center; font-size: 14px;">
			<tr>
	      <td style="text-align: center; width: 5%">NO</td>
	      <td style="text-align: center; width: 20%">NO PO</td>
	      <td style="text-align: center; width: 20%">NO PENERIMAAN</td>
	      <td style="text-align: center; width: 20%">NAMA ARTIKEL</td>
	      <td style="text-align: center; width: 5%">QTY GOOD</td>
	      <td style="text-align: center; width: 5%">QTY CACAT</td>
	    </tr>
	  ';

$total_qty = 0;
$total_qty_damaged = 0;
$i = 0;
$sql2 = $select->list_do_good_receipt_qc_detail($ref);
while($row_purchase_quick_detail=$sql2->fetch(PDO::FETCH_OBJ)) {

	$rcp_ref	=	$row_purchase_quick_detail->rcp_ref;
	$item_name	=	$row_purchase_quick_detail->item_name;
	$qty		=	$row_purchase_quick_detail->qty;
	$qty_damaged	=	$row_purchase_quick_detail->qty_damaged;

	$total_qty = $total_qty + $qty;
	$total_qty_damaged = $total_qty_damaged + $qty_damaged;

	$output .= '
		    <tr>
		      <td style="text-align: center; width: 5%">'.($i+1).'.</td>
		      <td style="text-align: left; width: 10%">'.$so_ref.'</td>
		      <td style="text-align: left; width: 10%">'.$rcp_ref.'</td>
		      <td style="text-align: left; width: 10%">'.$item_name.'</td>
		      <td style="text-align: center; width: 10%">'.number_format($qty,0,'.',',').'</td>
		      <td style="text-align: center; width: 10%">'.number_format($qty_damaged,0,'.',',').'</td>
		    </tr>
		  ';

	$i++;

}

$output .= '
		    <tr>
		      <td colspan="4" style="text-align: right; width: 5%">TOTAL</td>
		      <td style="text-align: center; width: 10%">'.number_format($total_qty,0,'.',',').'</td>
		      <td style="text-align: center; width: 10%">'.number_format($total_qty_damaged,0,'.',',').'</td>
		    </tr>
		  ';

$output .= '</table>';

$output .= '<table border="0" width="100%">
		<tr>
	      <td style="text-align: center">
	      	<br>'.$sign_director.'<u>
	      	'.$director_name.'</u><br>
	      	TEAM QC,
	      </td>
	      <td style="text-align: center">&nbsp;</td>
	      <td style="text-align: center">
	      	<br>'.$sign_request.'
	      	'.$request_by_name.'<br>
	      	INPUT SISFO
	      </td>
	    </tr>
	  </table>';
//echo $output;

$document->loadHtml($output);

//set page size and orientation

$document->setPaper('A4', 'portrait');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Webslesson", array("Attachment"=>0));
//1  = Download
//0 = Preview
?>

<!--<table>
  <tr>
    <td colspan="13" valign="top" style="text-align: center"></td>
  </tr>
</table>-->
