<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'database.php';

$conn = getConnection();

//$arr=implode(", ", $_POST['data']);

	/*if($arr[0] == '1')
	{
		$stmt = $conn->prepare("INSERT INTO discharges VALUES(?,?,?,?,?)");
		$stmt->bind_param("ssisi", $arr[1], $_POST['data'][2],$_POST['data'][3],$_POST['data'][4],$_POST['data'][5]);
		$stmt->execute();
	}
	else
	{
		$stmt = $conn->prepare("INSERT INTO admissions VALUES(?,?,?,?,?)");
		$stmt->bind_param("ssisi", $arr[1], $_POST['data'][2],$_POST['data'][3],$_POST['data'][4],$_POST['data'][5]);
		$stmt->execute();
	}*/
	if($_POST['v0'] == '1')
	{
		echo "1";
		$stmt = $conn->prepare("INSERT INTO discharges VALUES(?,?,?,?,?)");
		$stmt->bind_param("ssisi", $_POST['v1'], $_POST['v2'],$_POST['v3'],$_POST['v4'],$_POST['v5']);
		$stmt->execute();
	}
	else
	{
		echo "2";
		$stmt = $conn->prepare("INSERT INTO admissions VALUES(?,?,?,?,?)");
		$stmt->bind_param("ssisi", $_POST['v1'], $_POST['v2'],$_POST['v3'],$_POST['v4'],$_POST['v5']);
		$stmt->execute();
	}

?>
