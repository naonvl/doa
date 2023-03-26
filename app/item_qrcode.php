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
$select     = new select;
$selectview   = new selectview;

include "phpqrcode/qrlib.php"; //<-- LOKASI FILE UTAMA PLUGINNYA

$ref      =   $_REQUEST['ref'];

$dbpdo = DB::create();

require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();


$sql = $select->list_item($ref);
$row_item=$sql->fetch(PDO::FETCH_OBJ);

$qrcode     = $row_item->code; //syscode;
$code       = substr($row_item->code,0,18);
$name       = substr($row_item->name,0,22);
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

$html = '
  <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
</style>
';


$output = "
  <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
</style>

  ";


  $output .= "<table border='0' width='100%' style='text-align: center; margin-top: -30px; margin-left: -20px; font-size: 12px'>
  <tr >
    <td width='50' align='left' valign='top'>"."<img src='phpqrcode/qrcode/".$ref."' width='70' height='70' />"."</td>
    <td align='center' valign='top'>
      <table border='0'>
        <tr>
          <td align='center' valign='top' style='border-top: 1px solid #000000; border-bottom: 1px solid #000000'>DOA</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$code."</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$name."</td>
        </tr>
        <tr>
          <td align='right' valign='top' style='font-weight: bold'>IDR ".$current_price."</td>
        </tr>
        <tr>
          <td align='right' valign='top'>www.doaindonesia.id</td>
        </tr>
      </table>
    </td>    
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width='50' align='left' valign='top'>"."<img src='phpqrcode/qrcode/".$ref."' width='70' height='70' />"."</td>
    <td align='center' valign='top'>
      <table>
        <tr>
          <td align='center' valign='top' style='border-top: 1px solid #000000; border-bottom: 1px solid #000000'>DOA</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$code."</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$name."</td>
        </tr>
        <tr>
          <td align='right' valign='top' style='font-weight: bold'>IDR ".$current_price."</td>
        </tr>
        <tr>
          <td align='right' valign='top'>www.doaindonesia.id</td>
        </tr>
      </table>
    </td>  
  </tr>
  </table>
";

$output .= "<table border='0' width='100%' style='text-align: center; margin-top: 30px; margin-left: -20px; font-size: 12px'>
  <tr >
    <td width='50' align='left' valign='top'>"."<img src='phpqrcode/qrcode/".$ref."' width='70' height='70' />"."</td>
    <td align='center' valign='top'>
      <table border='0'>
        <tr>
          <td align='center' valign='top' style='border-top: 1px solid #000000; border-bottom: 1px solid #000000'>DOA</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$code."</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$name."</td>
        </tr>
        <tr>
          <td align='right' valign='top' style='font-weight: bold'>IDR ".$current_price."</td>
        </tr>
        <tr>
          <td align='right' valign='top'>www.doaindonesia.id</td>
        </tr>
      </table>
    </td>    
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width='50' align='left' valign='top'>"."<img src='phpqrcode/qrcode/".$ref."' width='70' height='70' />"."</td>
    <td align='center' valign='top'>
      <table>
        <tr>
          <td align='center' valign='top' style='border-top: 1px solid #000000; border-bottom: 1px solid #000000'>DOA</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$code."</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$name."</td>
        </tr>
        <tr>
          <td align='right' valign='top' style='font-weight: bold'>IDR ".$current_price."</td>
        </tr>
        <tr>
          <td align='right' valign='top'>www.doaindonesia.id</td>
        </tr>
      </table>
    </td>  
  </tr>
  </table>
";

$output .= "<table border='0' width='100%' style='text-align: center; margin-top: 30px; margin-left: -20px; font-size: 12px'>
  <tr >
    <td width='50' align='left' valign='top'>"."<img src='phpqrcode/qrcode/".$ref."' width='70' height='70' />"."</td>
    <td align='center' valign='top'>
      <table border='0'>
        <tr>
          <td align='center' valign='top' style='border-top: 1px solid #000000; border-bottom: 1px solid #000000'>DOA</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$code."</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$name."</td>
        </tr>
        <tr>
          <td align='right' valign='top' style='font-weight: bold'>IDR ".$current_price."</td>
        </tr>
        <tr>
          <td align='right' valign='top'>www.doaindonesia.id</td>
        </tr>
      </table>
    </td>    
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width='50' align='left' valign='top'>"."<img src='phpqrcode/qrcode/".$ref."' width='70' height='70' />"."</td>
    <td align='center' valign='top'>
      <table>
        <tr>
          <td align='center' valign='top' style='border-top: 1px solid #000000; border-bottom: 1px solid #000000'>DOA</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$code."</td>
        </tr>
        <tr>
          <td align='center' valign='top'>".$name."</td>
        </tr>
        <tr>
          <td align='right' valign='top' style='font-weight: bold'>IDR ".$current_price."</td>
        </tr>
        <tr>
          <td align='right' valign='top'>www.doaindonesia.id</td>
        </tr>
      </table>
    </td>  
  </tr>
  </table>
";


$document->loadHtml($output);

//set page size and orientation

//$customPaper = array(0,0,430,115);
$customPaper = array(0,0,430,(115+115+57));
//$dompdf->set_paper($customPaper);
$document->setPaper($customPaper, 'portrait');

//$document->setPaper('A5', 'portrait');

//Render the HTML as PDF
$document->render();

//Get output of generated pdf in Browser

$document->stream("Webslesson", array("Attachment"=>0));
//1  = Download
//0 = Preview

//hapus file qrcode
unlink('phpqrcode/qrcode/' . $ref);
?>

<!--<table>
  <tr>
    <td colspan="13" valign="top" style="text-align: center"></td>
  </tr>
</table>-->
