<!DOCTYPE html>
<html>
	<head>
		
		<?php require_once("view/meta.php"); ?>
		
		<script src="highcharts/js/highcharts.js"></script>
		<script src="highcharts/js/highcharts-more.js"></script>
		<script src="highcharts/js/modules/heatmap.js"></script>
		<script src="highcharts/js/modules/exporting.js"></script>
		<script src="js/heat.js"></script>
		<script src="js/chart-theme.js"></script>
		
		<title>Power Usage</title>
	</head>
	<body>
		<?php require_once("view/navbar.php"); ?>
		<div id="month_select">
			<button onclick="prevMonth();" type="button" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
			</button>
			<span id="month"></span>
			<button onclick="nextMonth();" type="button" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
			</button>
		</div>
		<div id="visual"></div>

		
	</body>
</html>
