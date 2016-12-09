<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'database.php';

$conn = getConnection();

$handle = fopen($_FILES['file']['tmp_name'], "r");
while (($line = fgets($handle)) !== false)
{
	$myArray = explode(',', $line);
	print_r($myArray);
	if($myArray[0] == '1')
	{
		$stmt = $conn->prepare("INSERT INTO discharges VALUES(?,?,?,?,?)");
		$stmt->bind_param("ssisi", $myArray[1], $myArray[2],$myArray[3],$myArray[4],$myArray[5]);
		$stmt->execute();
	}
	else
	{
		$stmt = $conn->prepare("INSERT INTO admissions VALUES(?,?,?,?,?)");
		$stmt->bind_param("ssisi", $myArray[1], $myArray[2],$myArray[3],$myArray[4],$myArray[5]);
		$stmt->execute();
	}
}

fclose($handle);
?>
