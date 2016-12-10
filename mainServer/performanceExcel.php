<?php
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
				require "database.php";
				
				$conn = getConnection();

				$sql_start="SELECT CONCAT(YEAR(disDate), '-', MONTH(disDate)) as year, recovered/t as recovered, defaulted/t as defaulted, dead/t as dead  FROM (SELECT disDate, YEAR(disDate) as y, MONTH(disDate) as m,count(*) as t, sum(case when reason=0 then 1 else 0 end) as recovered,sum(case when reason=1 then 1 else 0 end) as defaulted,sum(case when reason=2 then 1 else 0 end) as dead FROM discharges ";
				$sql_end=" GROUP BY YEAR(disDate), MONTH(disDate)) table1 ORDER BY disDate";
				
				if(!empty($_GET['siteName']) && !empty($_GET['age']))
				{
					$stmt = $conn->prepare($sql_start."WHERE siteName=? AND ageGroup=?".$sql_end);
					$age=$_GET['age']-1;
					$stmt->bind_param("si", $_GET['siteName'], $age);
					$stmt->execute();
				}
				else if(!empty($_GET['siteName']))
				{
					$stmt = $conn->prepare($sql_start."WHERE siteName=?".$sql_end);
					$stmt->bind_param("s", $_GET['siteName']);
					$stmt->execute();
				}
				else if(!empty($_GET['age']))
				{
					$stmt = $conn->prepare($sql_start."WHERE ageGroup=?".$sql_end);
					$age=$_GET['age']-1;
					$stmt->bind_param("i", $age);
					$stmt->execute();
				}
				else
				{
					$stmt = $conn->prepare($sql_start.$sql_end);
					$stmt->execute();
				}
				
				$res = $stmt->get_result();
				
				
//header("Content-Type: text/plain");
	$filename = "performance.xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");
  
  $flag = false;
  foreach($res as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\r\n";
      $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
  }
  exit;
			?>
