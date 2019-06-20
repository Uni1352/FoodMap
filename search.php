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
            <form action="./search.php" method="POST">
                <div style="display: flex;justify-content: space-between;">
                    <input type="text" name="search" style="width: 90%;" placeholder="請輸入關鍵字" />
                    <input type="submit" value="送出" />
                </div>
                <div style="display: flex;justify-content: flex-start">
                    <label for="restaurant">
                        <input type="radio" name="type" value="restaurant" id="restaurant" checked>餐廳名
                    </label>
                    <label for="MRT">
                        <input type="radio" name="type" value="MRT" id="MRT">捷運站
                    </label>
                    <label for="district">
                        <input type="radio" name="type" value="district" id="district">行政區
                    </label>
                </div>
            </form>
            <article>
                <a href="./article.php">
                    <div>
                        <h3>餐廳名</h3><br>
                        <p>地址</p>
                        <p>得分</p>
                    </div>
                </a>
                <hr>
                <a href="./article.php">
                    <div>
                        <h3>餐廳名</h3><br>
                        <p>地址</p>
                        <p>得分</p>
                    </div>
                </a>
            </article>
        </main>
    </div>
</body>

</html>