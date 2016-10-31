 <?php
$item = $_GET['item'];
if ($item) {
$rulefile = fopen("/etc/openhab2/rules/$item.rules", 'w') or die("Unable to open file!");

$conOff = array();
$conOn = array();
foreach ($_POST['state_sun'] as $key => $value) {
	$timeParts = explode(":",$_POST['time_sun'][$key]);
	$cronTime = $timeParts[1].' '.$timeParts[0];
	if ($value == "ON") {
		array_push($conOn,'	Time cron "0 '.$cronTime.' ? * SUN *"');
	} else if ($value == "OFF") {
		array_push($conOff,'	Time cron "0 '.$cronTime.' ? * SUN *"');
	}
}
foreach ($_POST['state_mon'] as $key => $value) {
	$timeParts = explode(":",$_POST['time_mon'][$key]);
	$cronTime = $timeParts[1].' '.$timeParts[0];
	if ($value == "ON") {
		array_push($conOn,'	Time cron "0 '.$cronTime.' ? * MON *"');
	} else if ($value == "OFF") {
		array_push($conOff,'	Time cron "0 '.$cronTime.' ? * MON *"');
	}
}
foreach ($_POST['state_tue'] as $key => $value) {
	$timeParts = explode(":",$_POST['time_tue'][$key]);
	$cronTime = $timeParts[1].' '.$timeParts[0];
	if ($value == "ON") {
		array_push($conOn,'	Time cron "0 '.$cronTime.' ? * TUE *"');
	} else if ($value == "OFF") {
		array_push($conOff,'	Time cron "0 '.$cronTime.' ? * TUE *"');
	}
}
foreach ($_POST['state_wed'] as $key => $value) {
	$timeParts = explode(":",$_POST['time_wed'][$key]);
	$cronTime = $timeParts[1].' '.$timeParts[0];
	if ($value == "ON") {
		array_push($conOn,'	Time cron "0 '.$cronTime.' ? * WED *"');
	} else if ($value == "OFF") {
		array_push($conOff,'	Time cron "0 '.$cronTime.' ? * WED *"');
	}
}
foreach ($_POST['state_thu'] as $key => $value) {
	$timeParts = explode(":",$_POST['time_thu'][$key]);
	$cronTime = $timeParts[1].' '.$timeParts[0];
	if ($value == "ON") {
		array_push($conOn,'	Time cron "0 '.$cronTime.' ? * THU *"');
	} else if ($value == "OFF") {
		array_push($conOff,'	Time cron "0 '.$cronTime.' ? * THU *"');
	}
}
foreach ($_POST['state_fri'] as $key => $value) {
	$timeParts = explode(":",$_POST['time_fri'][$key]);
	$cronTime = $timeParts[1].' '.$timeParts[0];
	if ($value == "ON") {
		array_push($conOn,'	Time cron "0 '.$cronTime.' ? * FRI *"');
	} else if ($value == "OFF") {
		array_push($conOff,'	Time cron "0 '.$cronTime.' ? * FRI *"');
	}
}
foreach ($_POST['state_sat'] as $key => $value) {
	$timeParts = explode(":",$_POST['time_sat'][$key]);
	$cronTime = $timeParts[1].' '.$timeParts[0];
	if ($value == "ON") {
		array_push($conOn,'	Time cron "0 '.$cronTime.' ? * SAT *"');
	} else if ($value == "OFF") {
		array_push($conOff,'	Time cron "0 '.$cronTime.' ? * SAT *"');
	}
}

$conditionsOn = implode(" or
",$conOn);
$conditionsOff = implode(" or
",$conOff);
$txt = 'rule SwitchOff
when
'.	$conditionsOff.'
then
	sendCommand('.$item.'_state, OFF)
end

';
fwrite($rulefile, $txt);
$txt = 'rule SwitchOn
when
'.	$conditionsOn.'
then
	sendCommand('.$item.'_state, ON)
end

';
fwrite($rulefile, $txt);
fclose($rulefile);
}
header( 'Location: ../item?item='.$item );


?> 