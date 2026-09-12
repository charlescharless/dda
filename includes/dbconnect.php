<?php
	try {
		// $servername = "localhost";
		// $username = "if0_42879807";
		// $password = "ljmff0ZDXq4";
		// $db = "dda";

		$servername = "localhost";
		$username = "root";
		$password = "";
		$db = "dda";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $db);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	} catch (Exception $e) {
		print("Connection failed: ");
	}
	
	//echo "Connected successfully";
?>