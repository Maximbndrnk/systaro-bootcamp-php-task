<?php 
	include 'connect.php';
    if(isset($_POST["name"])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $listId = mysqli_real_escape_string($conn, $_POST["listId"]);
        $isDone = mysqli_real_escape_string($conn,  $_POST["isDone"]);

        $query = "INSERT INTO " . $tasksTable . " (listId, name, isDone) VALUES('$listId','$name',$isDone)";
        if(mysqli_query($conn, $query)){
            echo 'Record Added...';
          } else {
            echo 'ERROR: '. mysqli_error($conn);
          }
    }	
?> 