<?php
header('Content-type: application/json');

$connection = mysqli_connect('127.0.0.1', 'root', 'rasp', 'openhab');
$item = $_GET['item'];
$itemE = $item."_currentPower";
$mysize = $_GET['size'];
$query1 = "SELECT ItemId FROM Items where ItemName like ?";

$stmt = $connection->stmt_init();

if ($stmt->prepare($query1)) {

	$stmt->bind_param("s",$itemE);
	
	$stmt->execute();


	$stmt->store_result();
	$stmt->bind_result($result);

	$stmt->fetch();
	
	$itemId = "Item".$result;
	
}

$stmt->close();
mysqli_free_result();

$data = array();

$query2 = "SELECT ROUND(AVG(Value)) from ".$itemId." where Value > 8 LIMIT 1000";

$stmt = $connection->stmt_init();

if ($stmt->prepare($query2)) {
	
	//$stmt->bind_param("s",$itemId);
	
	$stmt->execute();

	$stmt->bind_result($result2);
	
	
	$stmt->fetch();
	
	$mypower = $result2;
	
	
}

$stmt->close();
mysqli_free_result();


$minsize = $mysize-5;
$maxsize = $mysize+5;

$query3 = "SELECT Brand_Reg, Model_No, ROUND(screensize), Screen_Tech, ROUND(Avg_mode_power) from tv_data where screensize between ? and ? order by Avg_mode_power";
$stmt = $connection->stmt_init();

$added = 0;

if ($stmt->prepare($query3)) {
	

	$stmt->bind_param("ii",$minsize,$maxsize);
	
	$stmt->execute();

	$stmt->store_result();
	$stmt->bind_result($brand, $model, $size, $screen, $avgpower);
	
	
	while ($stmt->fetch()) {

		array_push($data, array($brand, $model, $size, $screen, $avgpower));
	}

	array_push($data, array("<b>Your TV</b>", "", $mysize, "", $mypower));

	
}

$stmt->close();
mysqli_free_result();

echo json_encode($data);






mysqli_free_result();


mysqli_close($connection);
?>