<?php 
session_start(); 
if(isset($_SESSION['mail'])) header('Location: /'); 
$host = '127.0.0.1';  
$user = 'root';    
$pass = ''; 
$db_name = 'lel';   
$link = mysqli_connect($host, $user, $pass, $db_name); 
if (!$link) {
    echo 'error code' . mysqli_connect_errno() . ', error: ' . mysqli_connect_error();
exit;
} 

function shifr($qqq){
    $shlog = $qqq;
    $shlog = htmlentities ($shlog);
    $shlog = stripslashes($shlog);
    return $shlog;
    
}

$role= 'user';
$login= shifr($_POST['login']);
$password= shifr($_POST['password']);

if($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $sql1 = "SELECT `login` FROM `users` WHERE `login` = '{$login}'";
    $result = mysqli_query($link,$sql1);
    $row = mysqli_fetch_assoc($result);
    if (empty($row) == '0'){
        ?>
        <script>
            alert('login already exist!');
        </script>
        <?
    echo '<script>location.replace("registr.php");</script>'; exit;
    }else{
        $sql2 = "INSERT INTO `users`(`login`, `password`) VALUES ('{$login}','{$password}')";
        $result = mysqli_query($link,$sql2);
        $_SESSION['role'] = $role;
        $_SESSION['login'] = $login;
        echo '<script>location.replace("index.php");</script>'; exit;
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="css/ough.css">
</head>

<body>
    <div class="login-page">
        <div class="form">
            <p>
                <?php if(isset($error) && $error) echo $error; ?>
            </p>
            <form class="login-form" method="post">
                <input type="text" name="login" required placeholder="Введите логин" />
                <input type="password" name="password" required placeholder="Введите пароль" />
                <button>Зарегистрироватся</button>
            </form>
        </div>
    </div>
</body>
</html>