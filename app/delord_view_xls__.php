<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Pengiriman_Report.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/function_excel.php");

include 'class/class.select.php';

$select = new select;

$from_date              =    $_REQUEST['from_date'];
$to_date                =    $_REQUEST['to_date'];
$client_code            =    $_REQUEST['client_code'];
$expedition_id          =    $_REQUEST["expedition_id"];
$all                    =    $_REQUEST['all'];


echo '
<?xml version="1.0" encoding="iso-8859-1"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 

 <Styles>
  <Style ss:ID="judul">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="kepala">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#ffffff" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="badan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>  
  
  <Style ss:ID="numberkanan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="0"/>
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  
  <Style ss:ID="badankanan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  
 </Styles>
 <Worksheet ss:Name="Data">

  <Table>
   <Column ss:Index="1" ss:Width="30"/>
   <Column ss:Index="2" ss:Width="100"/>
   <Column ss:Index="3" ss:Width="100"/>
   <Column ss:Index="4" ss:Width="100"/>
   
   <Row>
    <Cell ss:MergeAcross="6" ss:StyleID="judul"><Data ss:Type="String">LAPORAN PENGIRIMAN</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="3" ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';

	echo '<Row>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">No. Ref</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Tanggal</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Dari Gudang/Toko</Data></Cell>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Nama Pengirim</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Nama Penerima</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Jumlah</Data></Cell>';
	echo '</Row>';
	
	$no = 0;
	$sql=$select->list_delivery_order("", $from_date, $to_date, $all, $expedition_id);
    while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
    
        $no++;
		echo '<Row>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.$no.'</Data></Cell>';
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_delivery_order->ref."</Data></Cell>";
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.date("d-m-Y", strtotime($row_delivery_order->date)).'</Data></Cell>';
        echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_delivery_order->location_name."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_delivery_order->uid."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_delivery_order->client_name."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_delivery_order->qty."</Data></Cell>";
		echo '</Row>';
	}


echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

