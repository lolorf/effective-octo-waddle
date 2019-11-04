<?php
    session_start();
    $host = '127.0.0.1';  
    $user = 'root';    
    $pass = ''; 
    $db_name = 'lel';   
    $link = mysqli_connect($host, $user, $pass, $db_name); 
    if (!$link) {
        echo 'error code' . mysqli_connect_errno() . ', error: ' . mysqli_connect_error();
    exit;
    }
    $id = $_POST['id'];
    $sql = "DELETE FROM `books` WHERE `id` = '{$id}'";
    $result = mysqli_query($link,$sql);
    echo '<script>location.replace("site.php");</script>';
?>
