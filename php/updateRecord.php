<?php 
	include 'connect.php';
    if(isset($_POST["name"])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $isDone =mysqli_real_escape_string($conn,  $_POST["isDone"]);

        $query = "UPDATE " . $tasksTable . " SET name='$name', isDone='$isDone' WHERE id=$id";
        if(mysqli_query($conn, $query)){
            echo 'List updated ...';
          } else {
            echo 'ERROR: '. mysqli_error($conn);
          }
    }	
?> 