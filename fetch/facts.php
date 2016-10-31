<?php
header('Content-type: application/json');
/*
error_reporting(E_ALL);
ini_set('display_errors',1);
*/

$connection = mysqli_connect('127.0.0.1', 'root', 'rasp', 'openhab');

$item = $_GET['item'];
$itemE = $item."_energyToday";

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



$data = array();

$itemtable = "Item".$itemId;
$date = $_GET['date'];
$datelike = $_GET['date'].'%';

$query2 = "SELECT Value FROM ".$itemtable.
						" WHERE Time like ?";

$stmt = $connection->stmt_init();

if ($stmt->prepare($query2)) {

	$stmt->bind_param("s", $datelike);

	$stmt->execute();
	$stmt->store_result();
    $stmt->bind_result($value);

	$stmt->fetch();
	$power = $value;
	
}

$stmt->close();


$dayofweek = date('l', strtotime($date));
array_push($data, $dayofweek);
$numdayofweek = date('N', strtotime($date)) - 1;

$query3 = "SELECT AVG(Value) FROM ".$itemtable.
						" WHERE WEEKDAY(Time) = ?";

$stmt = $connection->stmt_init();

if ($stmt->prepare($query3)) {

	$stmt->bind_param("i", $numdayofweek);

	$stmt->execute();
	$stmt->store_result();
    $stmt->bind_result($value);

	$stmt->fetch();
	$avg = $value;
	
}
$stmt->close();
if ($power != null) {
	$percentChange = round((1 - $avg / $power) * 100);
	if ($percentChange < 0) {
		$percentChange = abs($percentChange).'% less';
	} else $percentChange = $percentChange.'% more';
} else $percentChange = -1;

array_push($data, $percentChange);

$cost = number_format(($power/1000 * 26.4740)/100, 2);
array_push($data, $cost);

echo json_encode($data, JSON_NUMERIC_CHECK);

mysqli_close($connection);
?>