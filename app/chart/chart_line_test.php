<?php
$dbpdo = DB::create();

$sqlstr = "select sum(a.jan) jan, sum(a.feb) feb, sum(a.mar) mar, sum(a.apr) apr, sum(a.may) may, sum(a.jun) jun, sum(a.jul) jul, sum(a.aug) aug, sum(a.sep) sep, sum(a.oct) oct, sum(a.nov) nov, sum(a.des) des, a.monthyear from (
select (total) jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-01' union all
select 0 jan, (total) feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-02' union all
select 0 jan, 0 feb, (total) mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice union all
select 0 jan, 0 feb, 0 mar, (total) apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-04' union all
select 0 jan, 0 feb, 0 mar, 0 apr, (total) may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-05' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, (total) jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-06' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, (total) jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-07' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, (total) aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-08' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, (total) sep, 0 oct, 0 nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-09' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, (total) oct, 0 nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-10' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, (total) nov, 0 des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-11' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, (total) des, date_format(date,'%Y-%m') monthyear from sales_invoice where date_format(date,'%Y-%m')='2022-12') a group by date_format(a.monthyear,'%Y')";
$sales = $dbpdo->query($sqlstr);

$sqlstr = "select sum(a.jan) jan, sum(a.feb) feb, sum(a.mar) mar, sum(a.apr) apr, sum(a.may) may, sum(a.jun) jun, sum(a.jul) jul, sum(a.aug) aug, sum(a.sep) sep, sum(a.oct) oct, sum(a.nov) nov, sum(a.des) des, a.monthyear from (
select (b.discount) jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-01' union all
select 0 jan, (b.discount) feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-02' union all
select 0 jan, 0 feb, (b.discount) mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-03' union all    
select 0 jan, 0 feb, 0 mar, (b.discount) apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-04' union all
select 0 jan, 0 feb, 0 mar, 0 apr, (b.discount) may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-05' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, (b.discount) jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-06' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, (b.discount) jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-07' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, (b.discount) aug, 0 sep, 0 oct, 0 nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-08' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, (b.discount) sep, 0 oct, 0 nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-09' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, (b.discount) oct, 0 nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-10' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, (b.discount) nov, 0 des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-11' union all
select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, (b.discount) des, date_format(a.date,'%Y-%m') monthyear from sales_invoice a left join sales_invoice_detail b on a.ref=b.ref where date_format(a.date,'%Y-%m')='2022-12') a group by date_format(a.monthyear,'%Y')";
$discount = $dbpdo->query($sqlstr);

$sqlstr = "select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des";
$capital = $dbpdo->query($sqlstr);

$sqlstr = "select 0 jan, 0 feb, 0 mar, 0 apr, 0 may, 0 jun, 0 jul, 0 aug, 0 sep, 0 oct, 0 nov, 0 des";
$margin = $dbpdo->query($sqlstr);
?>


<script src="app/chart/js/Chart.js"></script>
<style type="text/css">
        .container {
            width: 40%;
            margin: 15px auto;
        }
</style>

<div class="container" style="width: 100%;">
    <canvas id="linechart" width="180" height="70"></canvas>
</div>

<script  type="text/javascript">
  var ctx = document.getElementById("linechart").getContext("2d");
  var data = {
            labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
            datasets: [
                  {
                    label: "Sales",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#29B0D0",
                    borderColor: "#29B0D0",
                    pointHoverBackgroundColor: "#29B0D0",
                    pointHoverBorderColor: "#29B0D0",
                    data: [<?php while ($p = $sales->fetch(PDO::FETCH_ASSOC)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['des'] . '",';}?>]
                  },
                  {
                    label: "Discount",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#2A516E",
                    borderColor: "#2A516E",
                    pointHoverBackgroundColor: "#2A516E",
                    pointHoverBorderColor: "#2A516E",
                    data: [<?php while ($p = $discount->fetch(PDO::FETCH_ASSOC)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['des'] . '",';}?>]
                  },
                  {
                    label: "Capital",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#F07124",
                    borderColor: "#F07124",
                    pointHoverBackgroundColor: "#F07124",
                    pointHoverBorderColor: "#F07124",
                    data: [<?php while ($p = $capital->fetch(PDO::FETCH_ASSOC)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['des'] . '",';}?>]
                  },
                  {
                    label: "Margin",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#979193",
                    borderColor: "#979193",
                    pointHoverBackgroundColor: "#979193",
                    pointHoverBorderColor: "#979193",
                    data: [<?php while ($p = $margin->fetch(PDO::FETCH_ASSOC)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['des'] . '",';}?>]
                  }
                ]
          };

  var myBarChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
            legend: {
              display: true
            },
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                  ticks: {
                      min: 0,
                  }
              }],
              xAxes: [{
                          gridLines: {
                              color: "rgba(0, 0, 0, 0)",
                          }
                      }]
              }
          }
        });
</script>