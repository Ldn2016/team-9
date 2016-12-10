<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'database.php';

$conn = getConnection();

	if($myArray[0] == '1')
	{
		$stmt = $conn->prepare("INSERT INTO discharges VALUES(?,?,?,?,?)");
		$stmt->bind_param("ssisi", $_POST['data'][1], $_POST['data'][2],$_POST['data'][3],$_POST['data'][4],$_POST['data'][5]);
		$stmt->execute();
	}
	else
	{
		$stmt = $conn->prepare("INSERT INTO admissions VALUES(?,?,?,?,?)");
		$stmt->bind_param("ssisi", $_POST['data'][1], $_POST['data'][2],$_POST['data'][3],$_POST['data'][4],$_POST['data'][5]);
		$stmt->execute();
	}
}

fclose($handle);
?>
