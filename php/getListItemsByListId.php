<?php 
    include 'connect.php';

    if(isset($_GET['id'])){
        $query = 'SELECT * FROM ' . $tasksTable . ' WHERE listId=' . $_GET['id'];

    // Get Result
    $result = mysqli_query($conn, $query);

    // Fetch Data
    $records = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($records);
    }
