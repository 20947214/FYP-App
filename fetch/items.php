<?php
header('Content-type: application/json');

$connection = mysqli_connect('127.0.0.1', 'root', 'rasp', 'openhab');

$query = "SELECT ItemId, ItemName FROM Items where ItemName like '%energyToday'";
/*
$stmt = $connection->stmt_init();

if ($stmt = $mysqli->prepare($query)) {

	$stmt->bind_param("s",$id);
	
	$stmt->execute();

    $result = $stmt->get_result();
*/
	//$stmt->fetch();
$result = mysqli_query($connection, $query);	 
$data = array();
while ($row = mysqli_fetch_assoc($result)) {

	array_push($data, array(str_replace('_energyToday','',$row["ItemName"])));

	
}

//$data = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
//JSON_NUMERIC_CHECK to convert numbers in strings to int
echo json_encode($data, JSON_NUMERIC_CHECK);
//mysqli_free_result($result);
//}


//$stmt->close();

mysqli_close($connection);
?>