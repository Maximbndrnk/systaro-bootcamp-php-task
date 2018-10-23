<?php 
	include 'constants.php';	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
    	echo "Connection failed: " . $conn->connect_error;
    	$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) {
	    	die("Connection to server failed: " . $conn->connect_error);
		} 
	} 
	
?>