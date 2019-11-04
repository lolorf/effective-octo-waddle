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
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html">
    <meta charset="UTF-8">
    <title>BookStore</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="/styless/ololol.css">
    <link rel="stylesheet" type="text/css" href="/styless/reset.css">
    <link rel="stylesheet" type="text/css" href="/styless/style.css">
    <link rel="stylesheet" type="text/css" href="/styless/superfish.css">

</head>
<body id="glagne">
    <header>
        <div class="logomiri">
            <a href=""><img src="images/logo.png" alt="logo" class="logo"></a>
        </div>

        </div>
        <center>
            <div class="signin-signup">
                <p class="inf-form">
                    <?php if (isset($_SESSION['login'])) : ?>
                    Вы вошли как <?php echo $_SESSION['role'] ?><br>
                    <a class="log-reg-form" href="logout.php" id="btnout">Выйти</a>
                    <?php else: ?>
                    <a class="log-reg-form" href="login.php" id="btnvoiti">Войти</a><br><a id="btnili">или</a><br><a class="log-reg-form" href="registr.php" id="btnzareg"> Зарегестрироваться</a>
                    <?php endif; ?>
                </p>
            </div>
        </center>
    </header>
    <nav>
            <div class="wrapper">
                <ul class="sf-menu">
                    <li class="current active"><a href="index.php" id="btnmain">Главная</a></li>
                    <li><a href="" id="">Корзина</a></li>
                    <li><a href="" id="">Оформить заказ</a></li>
                </ul>
            </div>
    </nav>

    <div class="findbook">
    <form action="" method="post">
        <input type="text" class="placeholder" name="bookname" placeholder="название книги">
        <input type="submit" class="buttone" value="Поиск книги">
    </form>
    </div>

    <br>

    <? if ($_SESSION['role'] == 'admin'): ?>
    <div class="makebook">
    <form action="" method="post">
        <input type="text" name="bookname" class="placeholder" placeholder="название книги" required>
        <input type="text" name="booktext" class="placeholder" placeholder="описание книги" required>
        <input type="text" name="image" class="placeholder" placeholder="url картинки">
        <input type="text" name="tags" class="placeholder" placeholder="теги" required>
        <input type="text" name="value" class="placeholder" placeholder="количество книг">
        <input type="submit" class="buttone" value="Добавить книгу">
    </form>
    </div>
    <?php endif; ?>
    
    <?
    if ($_SESSION['role'] == 'admin'):
        $name = $_POST['bookname'];
        $text = $_POST['booktext'];
        $image = $_POST['image'];
        $tags = $_POST['tags'];
        $tags = $_POST['value'];
        if (empty($image) == "0"){
            $sql = "INSERT INTO `books`(`name`, `text`, `image`, `tags`, `value`) VALUES ('{$name}','{$text}','{$image}','{$tags}','{$value}')";
            $result = mysqli_query($link,$sql);
        }else{
            $sql = "INSERT INTO `books`(`name`, `text`, `tags`, `value`) VALUES ('{$name}','{$text}','{$tags}','{$value}')";
            $result = mysqli_query($link,$sql);
        }
    
    endif;
    $speps = (mysqli_query($link, "SELECT * FROM `books` ORDER BY `id`"));
    while ($row = mysqli_fetch_assoc($speps)) {
      $sortbyid[$row['id']] = array( 'id' => $row['id'] , 'name' => $row['name'] , 'text' => $row['text']
      , 'image' => $row['image'] , 'tags' =>$row['tags']);
    }
    if ($_SESSION['role'] == 'admin'):
    foreach ($sortbyid as $key) {
        echo '
        <br>
        <div class="flexx">
            <a href=""><img src='.$key['image'].' class="imageg" alt="no image"></a>
            <br>
            <div class="zamer">
                <div class="blockes">
                    <div class="bookname123">'.$key['name'].'</div>
                    <div class="booktext123">Описание: '.$key['text'].'</div>
                    <div class="booktags123">Теги: '.$key['tags'].'</div>
                </div>
                <form action="change.php" method="post">
                    <input type="hidden" name="id" value="'.$key['id'].'">
                    <div class="knopeka"><input type="submit" value="Изменить" class="buttone"></div>
                </form>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="'.$key['id'].'">
                    <div class="knopeka"><input type="submit" value="Удалить" class="buttone"></div>
                </form>
            </div>
        </div>
        ';
    }
    endif; 
    if ($_SESSION['role'] != 'admin'):
        foreach ($sortbyid as $key) {
            echo '
            <br>
            <div class="flexx">
                <a href=""><img src='.$key['image'].' class="imageg" alt="no image"></a>
                <br>
                <div class="zamer">
                    <div class="bookname123">'.$key['name'].'</div>
                    <div class="booktext123">Описание: '.$key['text'].'</div>
                    <div class="booktags123">Теги: '.$key['tags'].'</div>
                </div>
            </div>
            ';
        }
        endif; 
    ?>
    <footer>
            <div class="copy">
               <li>&copy; Copyright 2018 BOOKSTORE.RU</li>
               <li>Design by <a title="Styleshout" href="">Sanya</a></li>          
            </div>
    </footer>
    </body>
</html>
