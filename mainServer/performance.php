<html>
  <head>
	  <?php include "layout/head.php"; ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Recovered', 'Defaulted', 'Dead', 'Discharge Thres', 'Default Thres', 'Dead Thres']
			<?php
			
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			
				require "database.php";
				
				$conn = getConnection();
				
				$sql_start="SELECT YEAR(disDate) as y, MONTH(disDate) as m,count(*) as t, sum(case when reason=0 then 1 else 0 end) as recovered,sum(case when reason=1 then 1 else 0 end) as defaulted,sum(case when reason=2 then 1 else 0 end) as dead FROM discharges ";
				$sql_end=" GROUP BY YEAR(disDate), MONTH(disDate) ORDER BY disDate";
				
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
				
				while($row = $res->fetch_assoc()) {
					echo ",['".$row['y']."-".$row['m']."',".(100*$row['recovered']/$row['t']).",".(100*$row['defaulted']/$row['t']).",".(100*$row['dead']/$row['t']).", 75, 15, 10]";
				}
			?>
        ]);

        var options = {
          title: '',
          vAxis: {title:'Percentage'},
          hAxis: {title:'Reporting Period'},
          legend: { position: 'bottom' },
          series:{
			  3: { visibleInLegend: false, lineDashStyle: [4,4] },
			  4: { visibleInLegend: false,lineDashStyle: [4,4] },
			  5: { visibleInLegend: false,lineDashStyle: [4,4] }
		  }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
	  <?php include "layout/nav.php"; ?>
	  <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
					<div class="panel-heading">
						<h3>Performance</h3>
					</div>
					<div class="panel-body">
						<div class="center-block" id="curve_chart" style="width: 900px; height: 500px"></div>
					</div>
					<form id="queryForm" action="performance.php" method="get" novalidate>
						<div class="control-group form-group">
							<div class="controls">
								<label>Site name</label>
								<input type="text" class="form-control" id="siteName" name="siteName" value=<?php if(!empty($_GET['siteName']))echo '"'.$_GET['siteName'].'"'; else echo ""; ?> >
							</div>
						</div>
						<div class="form-group">
                          <label>Age:</label>
                            <input type="radio" name="age" value="2"><strong> > 6 months </strong>
                            <input type="radio" name="age" value="1"> <strong> < 6 months </strong>
                            <input type="radio" name="age" value="0"> <strong> Any </strong>
                        </div>
						<!--<div class="control-group form-group">
							<div class="controls">
								<label>Password</label>
								<input type="password" class="form-control" id="password" name="password" required data-validation-required-message="Please enter your Password.">
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label>Retype Password</label>
								<input type="password" class="form-control" id="password_re" name="passwordVerify" required data-validation-required-message="Please retype your Password.">
							</div>
						</div>
						<div id="success"></div>-->
						<input type="submit" value="Query" class="btn btn-primary"></button>
					</form>
				</div>
			</div>
		</div>
  </body>
</html>
