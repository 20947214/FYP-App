<!DOCTYPE html>
<html>
	<head>
		<?php require_once("view/meta.php"); ?>
		
		<script src="highcharts/js/highcharts.js"></script>
		<script src="highcharts/js/modules/exporting.js"></script>
		<script src="js/bar.js"></script>
		<script src="js/chart-theme.js"></script>
		
		<title>Power Usage</title>
	</head>
	<body>
	
		<?php require_once("view/navbar.php"); ?>
		
		<div id="day_select">
			<span id="day"></span>
		</div>
		<div id="visual"></div>
		<div class="container">
		</div>
	</body>
</html>
