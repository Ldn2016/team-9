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
	// echo $_POST['v0'];
	//echo $_POST['v1'].$_POST['v2'].$_POST['v3'].$_POST['v4'].$_POST['v5'];
	if($_POST['v0'] == '1')
	{
		echo "1";
		$stmt = $conn->prepare("INSERT INTO discharges (siteName, adDate, ageGroup, gender, reason) VALUES(?,NOW(),?,?,?)");
		$stmt->bind_param("sisi", $v1,$v3,$v4,$v5);
	

		$v1 = $_POST['v1'];
		$v2 = $_POST['v2'];
		$v3 = $_POST['v3'];
		$v4 = $_POST['v4'];
		$v5 = $_POST['v5'];

		$stmt->execute();
		
	}
	else
	{
		echo "2";
		if ($stmt = $conn->prepare("INSERT INTO admissions (siteName, adDate, ageGroup, gender, reason) VALUES(?,NOW(),?,?,?)")) {
			// $stmt->bind_param("ssisi", $_POST['v1'], $_POST['v2'],$_POST['v3'],$_POST['v4'],$_POST['v5']);
			$stmt->bind_param("sisi", $v1,$v3,$v4,$v5);
			//$stmt->bind_param("s", $v2);
			//$stmt->bind_param("i", $v3);
			// $stmt->bind_param("s", $v4);
			//$stmt->bind_param("i", $v5);

			$v1 = $_POST['v1'];
			$v2 = $_POST['v2'];
			$v3 = $_POST['v3'];
			$v4 = $_POST['v4'];
			$v5 = $_POST['v5'];
			/*$v1 = $_GET['v1'];
			$v2 = $_GET['v2'];
			$v3 = $_GET['v3'];
			$v4 = $_GET['v4'];
			$v5 = $_GET['v5'];*/
			$stmt->execute();
		}else{
			echo "Dead";
		}
		
	}
?>