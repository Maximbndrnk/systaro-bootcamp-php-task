<?php 
	include 'connect.php';
    if(isset($_POST["id"])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);

        $query = "DELETE FROM " . $listTable . " WHERE id=$id";
        if(mysqli_query($conn, $query)){
            echo 'List deleted...';
            $query = "DELETE FROM " . $tasksTable . " WHERE listId=$id";
            if(mysqli_query($conn, $query)){
                echo 'Records deleted...';
              } else {
                echo 'ERROR: '. mysqli_error($conn);
              }
          } else {
            echo 'ERROR: '. mysqli_error($conn);
          }
    }	
?> 