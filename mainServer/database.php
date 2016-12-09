<?php

function getConnection() {
		$conn = new mysqli("localhost", "admin", "admin", "mainDB");
		/*if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;
		echo "Connected successfully";
		
		$sqla = "SELECT * FROM users";
		$result = $conn->query($sqla);
		if ($conn->query($sqla) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sqla . "<br>" . $conn->error;
		}
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "id: " . $row["userID"].$row["uname"];
			}
		}	 
		else {
			echo "0 results";
		}*/
		return $conn;
	}
	
	/*function lastId() {
		$id = $this->database->insert_id;
		return $id;
	}*/
	
?>
