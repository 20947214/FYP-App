<?php
header('Content-type: application/json');

$connection = mysqli_connect('127.0.0.1', 'root', 'rasp', 'openhab');

$item = $_GET['item'];
$query = "SELECT wid,customName FROM settings where ItemName = ?";

$stmt = $connection->stmt_init();

if ($stmt->prepare($query)) {

	$stmt->bind_param("s",$item);
	
	$stmt->execute();
	
    $stmt->store_result();
	$stmt->bind_result($wid, $customName);

	//$stmt->fetch();
	 
$data = array();
while ($stmt->fetch()) {

	array_push($data, array($wid,$customName));

}

echo json_encode($data);
mysqli_free_result($result);
}


$stmt->close();

mysqli_close($connection);
?>