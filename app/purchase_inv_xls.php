<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Pembelian_List.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/function_excel.php");

include 'class/class.select.php';

$select = new select;

$from_date	      =    	$_REQUEST['from_date'];
$to_date		  =    	$_REQUEST['to_date'];
$vendor_code      =    $_REQUEST['vendor_code'];
$purchase_type    =    $_REQUEST['purchase_type'];
$all              =    $_REQUEST['all'];


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
    <Cell ss:MergeAcross="8" ss:StyleID="judul"><Data ss:Type="String">DAFTAR PEMBELIAN</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="3" ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';

	echo '<Row>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">No. Nota</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Tanggal</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Supplier</Data></Cell>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Jenis Order</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Jenis Bayar</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Jumlah</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Jumlah Pajak</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Total</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Kode</Data></Cell>';     
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Nama Barang</Data></Cell>';     
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Satuan</Data></Cell>';     
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Qty</Data></Cell>';     
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Harga</Data></Cell>'; 
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Discount</Data></Cell>';           
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Discount(%)</Data></Cell>'; 	
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Jumlah</Data></Cell>'; 
	echo '</Row>';
	
	$no = 0;
	$sql=$select->list_purchase_inv('', $from_date, $to_date, $vendor_code, $all, $purchase_type);
	while ($row_pch=$sql->fetch(PDO::FETCH_OBJ)) {
		
		$tax_amount = ($row_pch->tax_rate * $row_pch->amount)/100;
    $tax_amount = number_format($tax_amount,2,".",",");
    $sub_total = $row_pch->amount;
    $total = $sub_total + numberreplace($tax_amount);
    
    if($row_pch->payment_type == "Transfer") {
        $payment_type = "Transfer";
    }
    if($row_pch->payment_type == "Midtrans") {
        $payment_type = "Midtrans";
    }
    if($row_pch->payment_type == "Kredit") {
        $payment_type = "Kredit";
    }

		$no++;
		echo '<Row>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.$no.'</Data></Cell>';
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch->ref."</Data></Cell>";
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.date("d-m-Y", strtotime($row_pch->date)).'</Data></Cell>';
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch->vendor_name."</Data></Cell>";
        echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch->order_name."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$payment_type."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$sub_total."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tax_amount."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$total."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".""."</Data></Cell>";
		echo '</Row>';

		$sql1=$select->list_purchase_inv_detail($row_pch->ref);
		while ($row_pch_detail=$sql1->fetch(PDO::FETCH_OBJ)) {
				echo '<Row>';
				echo '<Cell ss:MergeAcross="8" ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>';
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch_detail->item_code2."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch_detail->item_name."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch_detail->uom_code."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch_detail->qty."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch_detail->unit_cost."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch_detail->discount."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch_detail->discount1."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$row_pch_detail->amount."</Data></Cell>";
				echo '</Row>';
			}
	}


echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

