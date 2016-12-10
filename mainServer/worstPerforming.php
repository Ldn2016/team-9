<html>
  <head>
	  <?php include "layout/head.php"; ?>
  </head>
  <body>
	  <?php include "layout/nav.php"; ?>
	  <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
					<div class="panel-heading">
						<h3>Worst Performing Sites</h3>
					</div>
					<div class="panel-body">
						<?php
			
							ini_set('display_errors', 1);
							ini_set('display_startup_errors', 1);
							error_reporting(E_ALL);
						
							require "database.php";
							
							$conn = getConnection();
							
							if(!empty($_GET['month']))$month=$_GET['month'];
							else $month="01";
							$year = $_GET['year']."-".$month"-01 00:00:00";
							
							$sql_start="SELECT siteName, count(*) as t, sum(case when reason=0 then 1 else 0 end) as recovered,sum(case when reason=1 then 1 else 0 end) as defaulted,sum(case when reason=2 then 1 else 0 end) as dead FROM discharges ";
							$sql_end=" GROUP BY siteName ORDER BY (recovered/t)";
							
							if(!empty($_GET['month']) && !empty($_GET['age']))
							{
								$stmt = $conn->prepare($sql_start."WHERE YEAR(disTime)=? AND MONTH(disTime)=? AND ageGroup=?".$sql_end);
								$age=$_GET['age']-1;
								$stmt->bind_param("ssi", $_GET['siteName'], $age);
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
							
							while($row = $res->fetch_assoc()) {
								echo ",['".$row['y']."-".$row['m']."',".(100*$row['recovered']/$row['t']).",".(100*$row['defaulted']/$row['t']).",".(100*$row['dead']/$row['t']).", 75, 15, 10]";
							}
						?>
					</div>
				</div>
			</div>
		</div>
  </body>
</html>
