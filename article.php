<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>美食地圖</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- TODO: nav -->
    <nav>
        <ul class="menu">
            <li class="menu__item"><a href="./index.php">首頁</a></li>
            <?php
            if(isset($_SESSION['valid_user'])){
            ?>
                <li class="menu__item"><a href="#">會員</a>
                    <ul class="submenu submenu--block">
                        <li><a href="./history.php">搜尋紀錄</a></li>
                        <li><a href="./favorite.php">我的最愛</a></li>
                        <li><a href="./modify.php">資料修改</a></li>
                        <li><a href="./logout.php">登出</a></li>
                    </ul>
                </li>
            <?php
            }
            else{
            ?>
                <li class="menu__item"><a href="./login.php">登入</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
    <div class="container">
        <main style="flex-grow: 1">
            <h2>餐廳名</h2><br>
            <h3>基本資料</h3><br>
            <!-- TODO: 基本資料 -->
            <!-- TODO: 圖片 -->
            <img src="#" alt="我是圖喔喔喔喔喔喔喔"><br>
            <h3>簡介</h3><br>
            <!-- TODO: 簡介 -->
            <h3>留言板</h3><br>
            <!-- TODO: 留言板 -->
            <form action="#" method="POST">
                <!-- TODO: 登入與非登入 -->
                <label for="name">名稱</label>
                <input type="text" id="name" style="padding:5px;margin: 10px 0" /><br>
                <label for="msg">內容</label>
                <textarea name="msg" id="msg" cols="30" rows="10"></textarea>
                <br>
                <input type="submit" value="送出" id="sendMsg" style="margin-left: 0" />
            </form>
        </main>
    </div>
</body>

</html>