<!DOCTYPE html>
<html lang="en">
<head>
	<title>A</title>
	<?php include "layout/head.php" ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
							<h4>Register</h4>
					</div>
					<div class="panel-body">
						<form id="subForm" action="insert.php" method="post" enctype="multipart/form-data">
							<br>
							<label>Choose file</label>
							<br>
							<div class="input-group">
								<label class="input-group-btn">
									<span class="btn btn-primary">
									Browse...<input style="display: none;" type="file" name="file">
									</span>
								</label>
								<input class="form-control" readonly type="text"></input>
							</div>
							<input type="submit" value="Submit post" class="btn btn-primary"></button>
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>

    <script src="js/jqBootstrapValidation.js"></script>

</body>

</html>
