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

function writeFile(){
	text = "kidosjmdosaodsam";
	var data = new Blob([text], {type: 'text/plain'});

    // If we are replacing a previously generated file we need to
    // manually revoke the object URL to avoid memory leaks.
    if (textFile !== null) {
      window.URL.revokeObjectURL(textFile);
    }

    textFile = window.URL.createObjectURL(data);
}
