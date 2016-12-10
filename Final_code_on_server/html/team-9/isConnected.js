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

function writeToFile(){
	
window.requestFileSystem = window.requestFileSystem || window.webkitRequestFileSystem;
var formData = document.getElementById("form1");
	var string = "";
for(var data in formData.element){
	string += (data.element+",");
}
	
 window.requestFileSystem(window.TEMPORARY, 1024*1024, function(fs) {
    fs.root.getFile('test.txt', {create: true}, function(fileEntry) { // test.bin is filename
        fileEntry.createWriter(function(fileWriter) {
            var arr = new Uint8Array(3); // data length

            arr[0] = 97; // byte data; these are codes for 'abc'
            arr[1] = 98;
            arr[2] = 99;

            var blob = new Blob([arr]);

            fileWriter.addEventListener("writeend", function() {
                // navigate to file, will download
                location.href = fileEntry.toURL();
            }, false);

            fileWriter.write(blob);
        }, function() {});
    }, function() {});
}, function() {});	
	
}

// function writeFile(){
// 	text = "kidosjmdosaodsam";
// 	var data = new Blob([text], {type: 'text/plain'});

//     // If we are replacing a previously generated file we need to
//     // manually revoke the object URL to avoid memory leaks.
//     if (textFile !== null) {
//       window.URL.revokeObjectURL(textFile);
//     }

//     textFile = window.URL.createObjectURL(data);
//     downloadURI(textFile,clinic_name+".txt");
// }
// function downloadURI(url, name) {
//   var link = document.createElement("a");
//   link.download = name;
//   link.href = uri;
//   document.body.appendChild(link);
//   link.click();
//   document.body.removeChild(link);
//   delete link;
// }
