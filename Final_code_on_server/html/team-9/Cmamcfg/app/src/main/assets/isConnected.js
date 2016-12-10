function sendToServer(){
	  
	var xhr = new ( window.ActiveXObject || XMLHttpRequest )( "Microsoft.XMLHTTP" );
	var url = "52.213.52.212/temp/process_files.php"
	

	var datafile = "file.txt"
	xhr.open( "POST", url);
	data = new FormData();
	data.append(datafile,file);
	try {
	    xhr.send(data);
	    string = "Connected";
	  } catch (error) {
	     string = "Not connected";
	  }

}

function writeFile(){
	set f = CreateObject("Scripting.FileSystemObject");
	var age = document.getElementById("age").value;
	var gender = document.getElementById("age").value;
	var diagnosis = document.getElementById("diagnosis").value;
	var clinic_name = document.getElementById("clinic_name").value;
	set s = f.CreateTextFile(clinic_name+".txt", True);
	s.writeline(age);
    s.writeline(diagnosis);
    s.writeline(clinic_name);
    s.close();
}
