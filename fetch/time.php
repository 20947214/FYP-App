<?php
header('Content-type: application/json');

$connection = mysqli_connect('127.0.0.1', 'root', 'rasp', 'openhab');
$item = $_GET['item'];
$itemE = $item."_currentPower";

$query1 = "SELECT ItemId FROM Items where ItemName like ?";

$stmt = $connection->stmt_init();

if ($stmt->prepare($query1)) {

	$stmt->bind_param("s",$itemE);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($result);
	$stmt->fetch();
	
	$itemId = $result;
}
$stmt->close();


$itemtable = "Item".$itemId;
$date = $_GET['date'];
$data = array();

$query2 = "SELECT UNIX_TIMESTAMP(CONVERT_TZ(Time, '+00:00', @@global.time_zone)),Value FROM ".$itemtable.
						" WHERE Time between ? and ? + INTERVAL 1 DAY";

$stmt = $connection->stmt_init();

if ($stmt->prepare($query2)) {

	$stmt->bind_param("ss", $date, $date);

	$stmt->execute();
	$stmt->store_result();
    $stmt->bind_result($time, $value);

	while ($stmt->fetch()) {
		array_push($data, array($time*1000,$value));		
	}
}
//JSON_NUMERIC_CHECK to convert numbers in strings to int
echo json_encode($data, JSON_NUMERIC_CHECK);
$stmt->close();

mysqli_close($connection);
?>