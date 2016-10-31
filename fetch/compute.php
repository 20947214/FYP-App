<?php
 
$connection = mysqli_connect('127.0.0.1', 'root', 'rasp', 'openhab');
$query = "SELECT ItemId, ItemName FROM Items where ItemName like '%energyToday'";
$items = array();
$result = mysqli_query($connection, $query);	
while ($row = mysqli_fetch_assoc($result)) {
	
				array_push($items, str_replace('_energyToday','',$row["ItemName"]));
				
}


for ($i=0; $i<count($items); $i++) {
$item = $items[$i];
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
mysqli_free_result($result);


//$hours = ['00','01','02','03','04','05','06','07','08','09','10','11',
//			'12','13','14','15','16','17','18','19','20','21','22','23'];


$data = array();
$query2 = "SELECT 1 FROM switchOn WHERE Time like ? and WEEKDAY(Time) = ? LIMIT 1";

$temp1 = "CREATE TEMPORARY TABLE IF NOT EXISTS switchOn AS (SELECT * From Item"
					.$itemId." WHERE Value > 8)";
mysqli_query($connection, $temp1);
$stmt = $connection->stmt_init();

if ($stmt->prepare($query2)) {
	
	for ($day=0; $day<7; $day++) {
	for ($hour=0; $hour<24; $hour++) {
	$hourpad = str_pad(strval($hour), 2, '0', STR_PAD_LEFT);

	$wildtime = '% '.$hourpad.':%';

	$stmt->bind_param("si",$wildtime,$day);
	$stmt->execute();
	$stmt->bind_result($value);
	
	
	if ($stmt->fetch()) {
		array_push($data, array($day,"ON",$hourpad));
	} else {
		array_push($data, array($day,"OFF",$hourpad));
	}
	
mysqli_free_result($value);
	}
}
}

$stmt->close();

$schedule = json_encode($data);


$query3 = "UPDATE settings SET schedule = ? WHERE ItemName = ?";

$stmt = $connection->stmt_init();

if ($stmt->prepare($query3)) {

	$stmt->bind_param("ss",$schedule,$item);
	
	$stmt->execute();
	
}


$stmt->close();

echo $schedule;
}
//header( 'Location: ../item?item='.$item ) ;

//echo json_encode([[0,"ON","00"],[0,"ON","01"],[0,"OFF","02"],[0,"OFF","03"],[0,"OFF","04"],[0,"OFF","05"],[0,"OFF","06"],[0,"OFF","07"],[0,"OFF","08"],[0,"OFF","09"],[0,"OFF","10"],[0,"OFF","11"],[0,"OFF","12"],[0,"OFF","13"],[0,"OFF","14"],[0,"OFF","15"],[0,"OFF","16"],[0,"OFF","17"],[0,"ON","18"],[0,"ON","19"],[0,"ON","20"],[0,"ON","21"],[0,"ON","22"],[0,"ON","23"],[1,"ON","00"],[1,"ON","01"],[1,"OFF","02"],[1,"OFF","03"],[1,"OFF","04"],[1,"OFF","05"],[1,"OFF","06"],[1,"OFF","07"],[1,"OFF","08"],[1,"OFF","09"],[1,"OFF","10"],[1,"OFF","11"],[1,"OFF","12"],[1,"OFF","13"],[1,"OFF","14"],[1,"OFF","15"],[1,"OFF","16"],[1,"OFF","17"],[1,"ON","18"],[1,"ON","19"],[1,"ON","20"],[1,"ON","21"],[1,"ON","22"],[1,"ON","23"],[2,"ON","00"],[2,"ON","01"],[2,"OFF","02"],[2,"OFF","03"],[2,"OFF","04"],[2,"OFF","05"],[2,"OFF","06"],[2,"OFF","07"],[2,"OFF","08"],[2,"OFF","09"],[2,"OFF","10"],[2,"OFF","11"],[2,"OFF","12"],[2,"OFF","13"],[2,"OFF","14"],[2,"OFF","15"],[2,"OFF","16"],[2,"OFF","17"],[2,"ON","18"],[2,"ON","19"],[2,"ON","20"],[2,"ON","21"],[2,"ON","22"],[2,"ON","23"],[3,"ON","00"],[3,"ON","01"],[3,"ON","02"],[3,"OFF","03"],[3,"OFF","04"],[3,"OFF","05"],[3,"OFF","06"],[3,"OFF","07"],[3,"ON","08"],[3,"ON","09"],[3,"OFF","10"],[3,"OFF","11"],[3,"OFF","12"],[3,"OFF","13"],[3,"OFF","14"],[3,"OFF","15"],[3,"OFF","16"],[3,"OFF","17"],[3,"ON","18"],[3,"ON","19"],[3,"ON","20"],[3,"ON","21"],[3,"ON","22"],[3,"ON","23"],[4,"ON","00"],[4,"OFF","01"],[4,"OFF","02"],[4,"OFF","03"],[4,"OFF","04"],[4,"OFF","05"],[4,"OFF","06"],[4,"OFF","07"],[4,"OFF","08"],[4,"OFF","09"],[4,"ON","10"],[4,"ON","11"],[4,"ON","12"],[4,"ON","13"],[4,"ON","14"],[4,"OFF","15"],[4,"OFF","16"],[4,"ON","17"],[4,"ON","18"],[4,"ON","19"],[4,"ON","20"],[4,"ON","21"],[4,"ON","22"],[4,"ON","23"],[5,"ON","00"],[5,"ON","01"],[5,"ON","02"],[5,"ON","03"],[5,"ON","04"],[5,"ON","05"],[5,"ON","06"],[5,"ON","07"],[5,"ON","08"],[5,"ON","09"],[5,"ON","10"],[5,"ON","11"],[5,"ON","12"],[5,"ON","13"],[5,"ON","14"],[5,"ON","15"],[5,"ON","16"],[5,"ON","17"],[5,"ON","18"],[5,"ON","19"],[5,"ON","20"],[5,"ON","21"],[5,"ON","22"],[5,"ON","23"],[6,"ON","00"],[6,"ON","01"],[6,"ON","02"],[6,"OFF","03"],[6,"ON","04"],[6,"ON","05"],[6,"ON","06"],[6,"ON","07"],[6,"ON","08"],[6,"ON","09"],[6,"ON","10"],[6,"ON","11"],[6,"ON","12"],[6,"ON","13"],[6,"ON","14"],[6,"ON","15"],[6,"ON","16"],[6,"ON","17"],[6,"ON","18"],[6,"ON","19"],[6,"ON","20"],[6,"ON","21"],[6,"ON","22"],[6,"ON","23"]]);

mysqli_close($connection);
?> 