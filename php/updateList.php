<?php 
	include 'connect.php';
    if(isset($_POST["name"])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $updateDate =mysqli_real_escape_string($conn,  $_POST["updateDate"]);

        $query = "UPDATE " . $listTable . " SET name='$name', updateDate='$updateDate' WHERE id=$id";
        if(mysqli_query($conn, $query)){
            echo 'List updated ...';
          } else {
            echo 'ERROR: '. mysqli_error($conn);
          }
    }	
?> 