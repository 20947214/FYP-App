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


$month = $_GET['month'];
$year = $_GET['year'];

$itemtable = "Item".$itemId;
$date = $year."-".$month."-01";

$data = array();
$i = 0;

$query2 = "SELECT DATE_FORMAT(Time, '%Y-%m-%d'),Value FROM ".$itemtable.
						" WHERE Time between ? and ? + INTERVAL 1 MONTH";
						
$stmt = $connection->stmt_init();

if ($stmt->prepare($query2)) {

	$stmt->bind_param("ss", $date, $date);

	$stmt->execute();
	$stmt->store_result();
    $stmt->bind_result($time, $value);

	while ($stmt->fetch()) {
		$weekdigit = date('w',strtotime($time));
		array_push($data, array($weekdigit,$i,$value,$time));
		if ($weekdigit==6) {
			$i++;
		}		
	}
}
//JSON_NUMERIC_CHECK to convert numbers in strings to int
echo json_encode($data, JSON_NUMERIC_CHECK);
$stmt->close();


mysqli_close($connection);
?>