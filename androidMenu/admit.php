<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="isConnected.js"></script>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <?php include 'header.php' ?>
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    CMAM
                </h1>
            </div>
      </div>
      <div id="register" class="container">
           <div class="row ">
                  <div class="col-sm-8">
                      <form role="form" action="login.php" method="post" onsubmit="writeToFile()" id="form1">
                        <div class="form-group">
                          <label for="clinic_name">Clinic Name:</label>
                          <select name="clinic_name">
                            <option value="Ethiopia"> Ethiopia</option>
                            <option value="Kenya"> Kenya</option>
                            <option value="SouthAfrica"> South Africa</option>
                            <option value="Brazil"> Brazil</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="diagnosis">Age:</label>
                          <select name="diagnosis">
                            <option value="0"> < 6 months </option>
                            <option value="1"> > 6 months </option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="diagnosis">Diagnosis:</label>
                          <select name="diagnosis">
                            <option value="a">WF/BMI (a)</option>
                            <option value="b"> MUAC (b)</option>
                            <option value="c"> Oedema (c)</option>
                            <option value="d"> Relapse (d)</option>
                          </select>
                        </div>
                      </form>
                 </div>
             </div>
      </div>
      <script>
		  function sendData(){

     // var xhr = new ( window.ActiveXObject || XMLHttpRequest )( "Microsoft.XMLHTTP" );
     // var url = "http://178.62.43.189/process_files.php"
    var discharge = 1;
    var admission = 0;
    var date = 2016-12;
    var age = document.getElementById("age");
    var diagnosis = document.getElementById("diagnosis");
    var clinic_name = document.getElementById("clinic_name");

    var data = new Array();
    data[0] = 0;
    data[1] = "w";
    data[2] = "2016";
    data[3] = 1;
    data[4] = "F";
    data[5] = 1;

    
//      data = new FormData();
//      data.append("file",datafile,"file.txt");
     $.ajax({
    url: 'insertVar.php',
    data: data,
    type: 'POST',
    success: function(msg){
     alert("Data sent successfully");
   }
    });

}
		 </script>
      <button class="btn btn-default" onclick="sendData()">Submit</button>
    <script>

    <footer class="container-fluid text-center">
            <a href="#top" title="To Top">
              <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
            <p> <a href="#"> ©CMAM </a></p>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- password strength JQuery library -->
    <script type="text/javascript" src="js/pwstrength-bootstrap-1.2.9.min.js"></script>
  </body>
</html>
