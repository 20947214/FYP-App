<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-flash" aria-hidden="true"></span></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">

			<li><a href="/">Items</a></li>

		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			<?php
			$connection = mysqli_connect('127.0.0.1', 'root', 'rasp', 'openhab');
			
			$year = date("Y");
			$month = date("m");
			$day = date("d");
			$j = 0;
			$query = "SELECT ItemId, ItemName FROM Items where ItemName like '%energyToday'";
			
			$result = mysqli_query($connection, $query);	 
			while ($row = mysqli_fetch_assoc($result)) {

				$item = str_replace('_energyToday','',$row["ItemName"]);
				$name = $item;
				$query2 = "SELECT customName FROM settings where itemName = ?";

				
				$stmt = $connection->stmt_init();

				if ($stmt->prepare($query2)) {

					$stmt->bind_param("s",$item);
					
					$stmt->execute();
					
					$stmt->store_result();
					$stmt->bind_result($customName);

					$stmt->fetch();
					 


					if ($customName) {
						$name = $customName;
					}

				

				mysqli_free_result($customName);
				}


				$stmt->close();
				
				
				echo '<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="item'.$j.'">'.$name.' <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="http://raspberrypi/app/item?item='.$item.'">Details</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="http://raspberrypi/app/heat?item='.$item.'&year='.$year.'&month='.$month.'">Power Usage Calendar</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="http://raspberrypi/app/timeseries?item='.$item.'&date='.$year.'-'.$month.'-'.$day.'">Today\'s Power Usage</a></li>
					
				  </ul>
				</li>';

				$j++;
			}
			mysqli_close($connection);
			?>
			
			

		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>