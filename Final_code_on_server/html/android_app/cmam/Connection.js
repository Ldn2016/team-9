
function sendAdmissionsData(){

     // var xhr = new ( window.ActiveXObject || XMLHttpRequest )( "Microsoft.XMLHTTP" );
     // var url = "http://178.62.43.189/process_files.php"

    var admission = 0;
    var date = "2016-12-10 00:00:00";
    var age = document.getElementById("age").value;
    var diagnosis = document.getElementById("diagnosis").value;
    var clinic_name = document.getElementById("clinic_name").value;
    var gender = document.getElementById("gender").value;

//    var data = new Array();
    var data  = {
        v0: admission,
        v1: clinic_name,
        v2: date,
        v3: age,
        v4: gender,
        v5: diagnosis 
    };
   // data[0] = admission;
   // data[1] = clinic_name;
   // data[2] = date;
   // data[3] = age;
   // data[4] = gender;
   // data[5] = diagnosis;

    
//      data = new FormData();
//      data.append("file",datafile,"file.txt");
     $.ajax({
            url: 'http://178.62.43.189/mainServer/insert.php',
            data:data,
            type: 'POST',
            success:function(json){
             alert("Data sent successfully");
   },
    error:function(){
        alert("Coud not send data");
     }
    });

}

function sendDischargeData(){

     // var xhr = new ( window.ActiveXObject || XMLHttpRequest )( "Microsoft.XMLHTTP" );
     // var url = "http://178.62.43.189/process_files.php"
    var admission = 1;
    var date = document.getElementById("date").value;
    var age = document.getElementById("age").value;
    var gender = document.getElementById("gender").value;
    var reason = document.getElementById("reason").value;
    var clinic_name = document.getElementById("clinic_name").value;

    // var data = new Array();
    var data  = {
        v0: admission,
        v1: clinic_name,
        v2: date,
        v3: age,
        v4: gender,
        v5: diagnosis 
    };
    // data[0] = admission;
    // data[1] = clinic_name;
    // data[2] = date;
    // data[3] = age;
    // data[4] = gender;
    // data[5] = reason;

    
//      data = new FormData();
//      data.append("file",datafile,"file.txt");
     $.ajax({
            url: 'http://178.62.43.189/mainServer/insert.php',
            data:data,
            type: 'POST',
            success:function(json){
             alert("Data sent successfully");
   },
    error:function(){
        alert("Coud not send data");
     }
    });

}


function writeToFile(){
    var formData = document.getElementById("form1");
    var text = "";
    text += document.getElementById("age").value + " " + document.getElementById("clinic_name").value + " " + document.getElementById("diagnosis").value;
	var data = new Blob([text], {type: 'text/plain'});

    // If we are replacing a previously generated file we need to
    // manually revoke the object URL to avoid memory leaks.
    if (textFile !== null) {
      window.URL.revokeObjectURL(textFile);
    }

    var textFile = window.URL.createObjectURL(data);
    var link = document.getElementById('downloadlink');
    link.download = "file.txt";
    link.href = textFile;  
    link.style.display = 'block';

    document.body.appendChild(link);
    link.click();
    
    // downloadURI(textFile,clinic_name+".txt");
}
