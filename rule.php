<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
		<?php require_once("view/meta.php"); ?>
		
		
		<script src="js/rule.js"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>
		<title>Power Usage</title>
	</head>
	<body>
	<?php require_once("view/navbar.php"); ?>
		<div class="container">
		<div class="loader"></div>
		<form action=""  method="post" id="rules">
		<div id="rule" style="visibility: hidden;">
				<div id="sun" style="margin-top: 20px;">Sunday: 
				</div>
				<button onclick="addRule('sun','ON','0:00');" type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size:16px;"></span></button>
	
				<div id="mon" style="margin-top: 20px;">Monday: 
				</div>
				<button onclick="addRule('mon','ON','0:00');" type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size:16px;"></span></button>
	
				<div id="tue" style="margin-top: 20px;">Tuesday: 
				</div>
				<button onclick="addRule('tue','ON','0:00');" type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size:16px;"></span></button>
				
				<div id="wed" style="margin-top: 20px;">Wednesday: 
				</div>
				<button onclick="addRule('wed','ON','0:00');" type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size:16px;"></span></button>
				
				<div id="thu" style="margin-top: 20px;">Thursday: 
				</div>
				<button onclick="addRule('thu','ON','0:00');" type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size:16px;"></span></button>
	
				<div id="fri" style="margin-top: 20px;">Friday: 
				</div>
				<button onclick="addRule('fri','ON','0:00');" type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size:16px;"></span></button>
	
				<div id="sat" style="margin-top: 20px;">Saturday: 
				</div>
				<button onclick="addRule('sat','ON','0:00');" type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size:16px;"></span></button>
	
	
	
				<button type="submit" class="btn btn-default pull-right" id="break" style="margin: 0 auto 20px;">Activate Schedule</button>

			</div>
			</form>
			
			</div>
		</div>

	</body>
</html>
