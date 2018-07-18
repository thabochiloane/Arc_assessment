<?php

	$servername = "localhost";
	$username = "easyghnv_arc";
	$password = "+5I*rm!.ag@u";
	$dbname = "easyghnv_exportcsv";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	
	define('DB_SERVER', 'localhost');
	define('DB_USER', 'easyghnv_arc');
	define('DB_PASSWORD', '+5I*rm!.ag@u');
	define('DB_NAME', 'easyghnv_exportcsv');
?>