<html>
  <head>
	  <?php include "layout/head.php"; ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
		google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Site name', 'Recovered', 'Defaulted', 'Dead']
			<?php
			
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			
				require "database.php";
				
				$conn = getConnection();
							
				if(!empty($_GET['month'])){
					$month=$_GET['month'];
				}
				else $month="01";
				if(!empty($_GET['year'])){
					$year=$_GET['year'];
				}
				else $year="2013";
				
				$sql_start="SELECT * FROM (SELECT siteName, count(siteName) as t, sum(case when reason=0 then 1 else 0 end) as recovered,sum(case when reason=1 then 1 else 0 end) as defaulted,sum(case when reason=2 then 1 else 0 end) as dead FROM discharges ";
				$sql_end=" GROUP BY siteName) a ORDER BY (recovered/t) LIMIT 3";
				
				if(!empty($_GET['month']) && !empty($_GET['age']))
				{
					$stmt = $conn->prepare($sql_start."WHERE YEAR(disDate)=? AND MONTH(disDate)=? AND ageGroup=?".$sql_end);
					$age=$_GET['age']-1;
					$stmt->bind_param("ssi", $year,$month, $age);
					$stmt->execute();
				}
				else if(!empty($_GET['age']))
				{
					$stmt = $conn->prepare($sql_start."WHERE YEAR(disDate)=? AND ageGroup=?".$sql_end);
					$age=$_GET['age']-1;
					$stmt->bind_param("si", $year, $age);
					$stmt->execute();
				}
				else if(!empty($_GET['month']))
				{
					$stmt = $conn->prepare($sql_start."WHERE YEAR(disDate)=? AND MONTH(disDate)=?".$sql_end);
					$stmt->bind_param("ss", $year,$month);
					$stmt->execute();
				}
				else
				{
					$stmt = $conn->prepare($sql_start."WHERE YEAR(disDate)=?".$sql_end);
					$stmt->bind_param("s", $year);
					$stmt->execute();
				}
				
				$res = $stmt->get_result();
				
				while($row = $res->fetch_assoc()) {
					echo ",['".$row['siteName']."',".(100*$row['recovered']/$row['t']).",".(100*$row['defaulted']/$row['t']).",".(100*$row['dead']/$row['t'])."]";
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

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

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
						<h3>Worst Performaning Sites</h3>
					</div>
					<div class="panel-body">
						<div class="center-block" id="columnchart_material" style="width: 900px; height: 500px"></div>
					</div>
					<form id="queryForm" action="worstPerforming.php" method="get" novalidate>
						<div class="control-group form-group">
							<div class="controls">
								<label>Year</label>
								<input type="text" class="form-control" id="year" name="year" value=<?php if(!empty($_GET['year']))echo '"'.$_GET['year'].'"'; else echo ""; ?> >
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label>Month</label>
								<input type="text" class="form-control" id="month" name="month" value=<?php if(!empty($_GET['month']))echo '"'.$_GET['month'].'"'; else echo ""; ?> >
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
