<?php 
	include 'connect.php';
    $stmt = mysqli_prepare($conn, "INSERT INTO " . $listTable . " (name, createDate, updateDate) VALUES (?, ?, ?)");
    if(isset($_POST["name"])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $createDate = mysqli_real_escape_string($conn, $_POST["createDate"]);
        $updateDate =mysqli_real_escape_string($conn,  $_POST["updateDate"]);

        $query = "INSERT INTO " . $listTable . " (name, createDate, updateDate) VALUES('$name','$createDate','$updateDate')";
        if(mysqli_query($conn, $query)){
            echo 'User Added...';
          } else {
            echo 'ERROR: '. mysqli_error($conn);
          }
    }

	
?> 