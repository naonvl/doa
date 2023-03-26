<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Sales_Report.xlsx";

header("Content-Type: application/xlsx");
header("Content-Disposition: attachment;filename=".$namafile." ");

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/function_excel.php");

include 'class/class.select.php';

$select = new select;

$from_date              =    $_REQUEST['from_date'];
$to_date                =    $_REQUEST['to_date'];
$shift                  =    $_REQUEST['shift'];
$cashier                =    $_REQUEST['cashier'];
$employee_id            =    $_POST["employee_id"];
$client_code            =    $_POST["client_code"];
$client_type            =    $_POST["client_type"];
$channel_id             =    $_POST["channel_id"];
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
    <Cell ss:MergeAcross="14" ss:StyleID="judul"><Data ss:Type="String">LAPORAN PENJUALAN</Data></Cell>
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
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Jam</Data></Cell>';
    echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Customer</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Jenis Customer</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Jenis Chanel</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Kasir</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Gross Sales</Data></Cell>';
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Discount</Data></Cell>';     
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Net Sales</Data></Cell>';     
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">COGS</Data></Cell>';     
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Gross Profit</Data></Cell>';     
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Kontan</Data></Cell>'; 
	echo '<Cell ss:StyleID="badan"><Data ss:Type="String">Debit</Data></Cell>';
	echo '</Row>';
	
	$no = 0;
	$grand_gross_sales = 0;
    $grand_net_sales = 0;
    $grand_cogs = 0;
    $grand_gross_profit = 0;
    $grand_total = 0;
    $grand_discount = 0;
    $grand_cash     = 0;
    $grand_bank     = 0;
    $grand_total_owner = 0;
    $grand_total_capster = 0;       
    $i = 0;                                 

    $sql=$select->list_pos('', $all, $from_date, $to_date, $shift, $cashier, $employee_id, "", $client_code, $client_type, $channel_id);
    while($row_pos=$sql->fetch(PDO::FETCH_OBJ)){
    
        $i++;
        
        $status = "";
        if ($row_pos->status == "P") {
            $status = "Planned";
        }
        if ($row_pos->status == "R") {
            $status = "Released";
        }
        if ($row_pos->status == "I") {
            $status = "Paid in Part";
        }
        if ($row_pos->status == "F") {
            $status = "Paid in Full";
        }
        if ($row_pos->status == "V") {
            $status = "Void";
        }
        if ($row_pos->status == "S") {
            $status = "Shipped in Part";
        }
        if ($row_pos->status == "E") {
            $status = "Shipped in Full";
        }
        if ($row_pos->status == "C") {
            $status = "Closed";
        }
        
        //get discount detail
        $discount = 0;
        $sqldsc = $select->get_pos_detail_discount($row_pos->ref);
        $datadisc = $sqldsc->fetch(PDO::FETCH_OBJ);
        $discount_det = $datadisc->discount;
        $discount = $discount_det + $row_pos->discount;
        
        //get employee
        $jmlcapster = 0;
        $employee = $row_pos->employee_name;
        if($employee == "") {                               
            $sql3 = $select->list_sales_invoice_employee($row_pos->ref, $employee_id);
            while($data3 = $sql3->fetch(PDO::FETCH_OBJ)) {
                if($employee == "") {
                    $employee = $data3->name;
                } else {
                    $employee = $employee . "<br>" . $data3->name;
                    $jmlcapster = 1;
                }
            }
        }
        
        $sql2 = $select->list_sales_invoice_employee($row_pos->ref, "");
        $rows = $sql2->rowCount();
        if($rows == 0 || $jmlcapster == 1) {
            $rows = 1;
        }
        
        $grand_total = $grand_total + ( ($row_pos->total-$discount)/$rows);
        
        //hitung commision
        $total  =   ( ($row_pos->total-$discount)/$rows);
        $total  =   $total - (( ( ($row_pos->total-$discount)/$rows) * $row_pos->commision_rate)/100);
        $commision = ( ( ($row_pos->total-$discount)/$rows) * $row_pos->commision_rate)/100;
        
        $grand_total_owner = $grand_total_owner + $total;
        $grand_total_capster = $grand_total_capster + $commision;
        
        //
        $grand_cash     = $grand_cash + (($row_pos->total-$row_pos->bank_amount-$discount))/$rows;
        $grand_bank     = $grand_bank + $row_pos->bank_amount;
        
        //get cogs
        $sqldet = $select->get_pos_detail($row_pos->ref);
        $data_det = $sqldet->fetch(PDO::FETCH_OBJ);
        
        $grand_discount = $grand_discount + $row_pos->discount + $data_det->discount;
        $grand_gross_sales = $grand_gross_sales + $row_pos->total;
        $grand_net_sales = $grand_net_sales + ($row_pos->total-$row_pos->discount-$data_det->discount);
        $grand_cogs = $grand_cogs + $data_det->amount_cost;
        $grand_gross_profit = $grand_gross_profit + ($row_pos->total-$row_pos->discount-$data_det->amount_cost);

		$no++;
		echo '<Row>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.$no.'</Data></Cell>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.$row_pos->ref.'</Data></Cell>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.date("d-m-Y", strtotime($row_pos->date)).'</Data></Cell>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.date("H:i", strtotime($row_pos->dlu)).'</Data></Cell>';
        echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.$row_pos->client_name.'</Data></Cell>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.$row_pos->client_type_name.'</Data></Cell>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.$row_pos->channel_name.'</Data></Cell>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.$row_pos->employee_name.'</Data></Cell>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.number_format($row_pos->total,0,'.',',').'</Data></Cell>';
		echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.number_format($row_pos->discount,0,'.',',').'</Data></Cell>';

        echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.number_format($row_pos->total-$row_pos->discount,0,'.',',').'</Data></Cell>';
        echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.number_format($data_det->amount_cost,0,'.',',').'</Data></Cell>';
        echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.number_format($row_pos->total-$row_pos->discount-$data_det->amount_cost,0,'.',',').'</Data></Cell>';
        echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.number_format(($row_pos->total-$row_pos->bank_amount->$discount)/$rows,0,'.',',').'</Data></Cell>';
        echo '<Cell ss:StyleID="badan"><Data ss:Type="String">'.number_format($row_pos->bank_amount,0,'.',',').'</Data></Cell>';
		echo '</Row>';
	}


echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

