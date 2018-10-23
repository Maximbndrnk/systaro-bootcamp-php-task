<?php 
	include 'connect.php';
    if(isset($_POST["id"])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);     
        $query = "DELETE FROM " . $tasksTable . " WHERE id=$id";
        if(mysqli_query($conn, $query)){
            echo 'record deleted ...';
        } else {
         echo 'ERROR: '. mysqli_error($conn);
        }
    }   
?> 