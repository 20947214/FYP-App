<!DOCTYPE html>
<html>
	<head>
		<?php require_once("view/meta.php"); ?>
		
		
		<script src="js/item.js"></script>
		
		<title>Power Usage</title>
	</head>
	<body>
	<?php require_once("view/navbar.php"); ?>
		<div class="container">
			<div id="itemtitle"></div>
			<div id="stats"><iframe src="" scrolling="no" frameborder="no"></iframe></div>
			<div id="settings">
				<form action="" method="post" id="updatename">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="New Item Name" name="newname">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit" >Update Name</button>
					</span>
				</div>
				</form>
				<label for="basic-url" style="margin-top: 20px;">Compare Models: </label>
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					TV <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
					<li><a href="#">TV</a></li>
					<li><a href="#">Sound System</a></li>
					<li><a href="#">Computer</a></li>
				  </ul>
				</div>
				
				<form action="bar" method="get" id="compare">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">Diagonal Screen Size</span>
				  <input type="number" name="size" min="13" max="271" class="form-control" placeholder="100" aria-describedby="basic-addon1" required>
				  <input type="hidden" name="item" value="" id="compareItem">
				  <span class="input-group-addon">cm</span>
				</div>
				
				<button type="submit" class="btn btn-default" id="break" style="margin: 0 auto 20px;">Compare</button>
				</form>

			</div>
			
		</div>

	</body>
</html>
