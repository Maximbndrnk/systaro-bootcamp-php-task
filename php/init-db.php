<?php
	include 'connect.php';
	$dbSelected = mysqli_select_db($conn, $dbname);
	if(!$dbSelected){
		// If we couldn't, then it either doesn't exist, or we can't see it.
			$sql = 'CREATE DATABASE ' . $dbname;
			if ($conn->query($sql) === TRUE) {
		    echo "Database created successfully<br>";
		    $conn = new mysqli($servername, $username, $password, $dbname);
		    if ($conn->connect_error) {
				die("Connection failed to db: " . $conn->connect_error);
			} 		   
		    $sql = 'CREATE TABLE ' . $listTable . ' (
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
					name VARCHAR(30) NOT NULL,					
					createDate DATE NOT NULL,
					updateDate DATE NOT NULL					
					)';
			if ($conn->query($sql) === TRUE) {
				echo "Table " . $listTable . " created successfully!<br>";
			} else {
				echo "Error creating table: " . $conn->error;
			}
		    $sql = 'CREATE TABLE ' . $tasksTable . ' (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
                    listId INT(6) NOT NULL,
					name VARCHAR(30) NOT NULL,					
					isDone BOOLEAN NOT NULL DEFAULT 0					
					)';
			if ($conn->query($sql) === TRUE) {
				echo "Table " . $tasksTable . " created successfully!<br>";
			} else {
				echo "Error creating table: " . $conn->error;
			}
		} else {
		    echo "Error creating database: " . $conn->error;
		}
	}
	$conn->close();
?>