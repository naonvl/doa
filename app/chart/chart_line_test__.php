<script>
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
	title:{
		text: "Total Sales per Bulan"
	},
	axisY:[{
		title: "Sales",
		lineColor: "#C24642",
		tickColor: "#C24642",
		labelFontColor: "#C24642",
		titleFontColor: "#C24642",
		includeZero: true,
		suffix: ""
	},
	{
		title: "Discount",
		lineColor: "#369EAD",
		tickColor: "#369EAD",
		labelFontColor: "#369EAD",
		titleFontColor: "#369EAD",
		includeZero: true,
		suffix: ""
	}],
	axisY2: {
		title: "Margin",
		lineColor: "#7F6084",
		tickColor: "#7F6084",
		labelFontColor: "#7F6084",
		titleFontColor: "#7F6084",
		includeZero: true,
		prefix: "",
		suffix: ""
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "line",
		name: "Discount",
		color: "#369EAD",
		showInLegend: true,
		axisYIndex: 1,
		dataPoints: [
			{ x: new Date(2022, 00, 7), y: 8500000 }, 
			{ x: new Date(2022, 00, 14), y: 9200000 },
			{ x: new Date(2022, 00, 21), y: 6400000 },
			{ x: new Date(2022, 00, 28), y: 5800000 },
			{ x: new Date(2022, 01, 4), y: 6300000 },
			{ x: new Date(2022, 01, 11), y: 6900000 },
			{ x: new Date(2022, 01, 18), y: 8800000 },
			{ x: new Date(2022, 01, 25), y: 6600000 },
			{ x: new Date(2022, 05, ''), y: 8100000 },
			{ x: new Date(2022, 02, 11), y: 6000000 },
			{ x: new Date(2022, 02, 18), y: 8700000 },
			{ x: new Date(2022, 02, 25), y: 9800000 }
		]
	},
	{
		type: "line",
		name: "Sales",
		color: "#C24642",
		axisYIndex: 0,
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2022, 00, 7), y: 32000000 }, 
			{ x: new Date(2022, 00, 14), y: 33000000 },
			{ x: new Date(2022, 00, 21), y: 26000000 },
			{ x: new Date(2022, 00, 28), y: 15000000 },
			{ x: new Date(2022, 01, 4), y: 18000000 },
			{ x: new Date(2022, 01, 11), y: 34000000 },
			{ x: new Date(2022, 01, 18), y: 37000000 },
			{ x: new Date(2022, 01, 25), y: 24000000 },
			{ x: new Date(2022, 02, 4), y: 35000000 },
			{ x: new Date(2022, 02, 11), y: 12000000 },
			{ x: new Date(2022, 02, 18), y: 38000000 },
			{ x: new Date(2022, 02, 25), y: 42000000 }
		]
	},
	{
		type: "line",
		name: "Margin",
		color: "#7F6084",
		axisYType: "secondary",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2022, 00, 7), y: 42000000 }, 
			{ x: new Date(2022, 00, 14), y: 44000000 },
			{ x: new Date(2022, 00, 21), y: 28000000 },
			{ x: new Date(2022, 00, 28), y: 22000000 },
			{ x: new Date(2022, 01, 4), y: 25000000 },
			{ x: new Date(2022, 01, 11), y: 45000000 },
			{ x: new Date(2022, 01, 18), y: 54000000 },
			{ x: new Date(2022, 01, 25), y: 32000000 },
			{ x: new Date(2022, 02, 4), y: 43000000 },
			{ x: new Date(2022, 02, 11), y: 26000000 },
			{ x: new Date(2022, 02, 18), y: 40000000 },
			{ x: new Date(2022, 02, 25), y: 54000000 }
		]
	},
	{
		type: "line",
		name: "Capital",
		color: "#7F6084",
		axisYType: "secondary",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2022, 00, 7), y: 32000000 }, 
			{ x: new Date(2022, 00, 14), y: 34000000 },
			{ x: new Date(2022, 00, 21), y: 18000000 },
			{ x: new Date(2022, 00, 28), y: 12000000 },
			{ x: new Date(2022, 01, 4), y: 15000000 },
			{ x: new Date(2022, 01, 11), y: 35000000 },
			{ x: new Date(2022, 01, 18), y: 44000000 },
			{ x: new Date(2022, 01, 25), y: 22000000 },
			{ x: new Date(2022, 02, 4), y: 33000000 },
			{ x: new Date(2022, 02, 11), y: 16000000 },
			{ x: new Date(2022, 02, 18), y: 30000000 },
			{ x: new Date(2022, 02, 25), y: 44000000 }
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

<!-- https://canvasjs.com/javascript-charts/line-chart-multiple-axis/ -->
<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->