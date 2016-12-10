// function sendToServer(){
	  
// 	var xhr = new ( window.ActiveXObject || XMLHttpRequest )( "Microsoft.XMLHTTP" );
// 	var url = "52.213.52.212/temp/process_files.php"
	

// 	var datafile = "file.txt"
// 	xhr.open( "POST", url);
// 	data = new FormData();
// 	data.append(datafile,file);
// 	try {
// 	    xhr.send(data);
// 	    string = "Connected";
// 	  } catch (error) {
// 	     string = "Not connected";
// 	  }

// }

// function sendData(){ //Processes form data without use of a local file
// 	var formData = document.getElementById("form1");
	
// 	$.ajax({
//  		  type: "POST",
//  		  data: {data:formData.element},
//    		url: "http://178.62.43.189/processdata.php",
//   		 success: function(msg){
//    			  alert("Data received by server");
//  	 	 }
// 	});
	
// }
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
    data[0] = admission;
    data[1] = clinic_name;
    data[2] = date;
    data[3] = age;
    data[4] = gender;
    data[5] = reason;

    
//      data = new FormData();
//      data.append("file",datafile,"file.txt");
     $.ajax({
    url: 'http://178.62.43.189/insert.php',
    data: data,
    type: 'POST',
    success: function(msg){
     alert("Data sent successfully");
   }
    });
     // xhr.open( "POST", url);
     // data = new FormData();
     // data.append(datafile,file);
     // try {
     //     xhr.send(data);
     //     string = "Connected";
     //   } catch (error) {
     //      string = "Not connected";
     //   }


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
