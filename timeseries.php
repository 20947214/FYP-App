<!DOCTYPE html>
<html>
	<head>
		<?php require_once("view/meta.php"); ?>
		
		<script src="highstocks/js/highstock.js"></script>
		<script src="highstocks/js/modules/exporting.js"></script>
		<script src="js/timeseries.js"></script>
		<script src="js/chart-theme.js"></script>
		
		<title>Power Usage</title>
	</head>
	<body>
		<?php require_once("view/navbar.php"); ?>
		<div id="day_select">
			<!--
			<button onclick="prevDay();" type="button" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
			</button>
			-->
			<span id="day"></span>
			<!--
			<button onclick="nextDay();" type="button" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
			</button>
			-->
		</div>
		
		<div id="visual"></div>
		
		<div class="container">
		<div id="facts"></div>
		</div>
	</body>
</html>
