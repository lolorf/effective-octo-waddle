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
    echo $id;
    $sql = "SELECT 'name','text','image','tags' FROM `books` WHERE `id` = '{$id}'";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assec($result);
    echo'
    <html>
        <form action="" method="post">
            <input type="text" value='.$row['name'].' name="name">
            <input type="text" value='.$row['text'].' name="text">
            <input type="text" value='.$row['image'].' name="image">
            <input type="text" value='.$row['tags'].' name="tags">
            <input type="submit" value="change">
        </form>
    </html>
    ';
    $name = $_POST['name'];
    $text = $_POST['text'];
    $image = $_POST['image'];
    $tags = $_POST['tags'];
    $sql2 = "UPDATE `books` SET `name`='{$name}',`text`='{$text}',`image`='{$image}',`tags`='{$tags}'";
?>
<html>
    <form action="site.php" method="">
        <input type="submit" value="logout">
    </form>
</html>
