 <?php
$item = $_GET['item'];
$newname = $_POST['newname'];

$connection = mysqli_connect('127.0.0.1', 'root', 'rasp', 'openhab');

$query = "UPDATE settings SET customName = ? WHERE ItemName = ?";

$stmt = $connection->stmt_init();

if ($stmt->prepare($query)) {

	$stmt->bind_param("ss",$newname,$item);
	
	$stmt->execute();
	
}


$stmt->close();

mysqli_close($connection);

header( 'Location: ../item?item='.$item ) ;


?> 