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
            <li class="menu__item"><a href="#">捷運</a>
                <ul class="submenu submenu--block">
                    <li><a href="#">文湖線</a></li>
                    <li><a href="#">板南線</a></li>
                    <li><a href="#">淡水信義線</a></li>
                    <li><a href="#">中和新蘆線</a></li>
                    <li><a href="#">松山新店線</a></li>
                </ul>
            </li>
            <li class="menu__item"><a href="#">台北</a>
                <ul class="submenu submenu--flex">
                    <div>
                        <li><a href="#">中正區</a></li>
                        <li><a href="#">大同區</a></li>
                        <li><a href="#">中山區</a></li>
                        <li><a href="#">松山區</a></li>
                        <li><a href="#">大安區</a></li>
                        <li><a href="#">萬華區</a></li>
                    </div>
                    <div>
                        <li><a href="#">信義區</a></li>
                        <li><a href="#">士林區</a></li>
                        <li><a href="#">北投區</a></li>
                        <li><a href="#">內湖區</a></li>
                        <li><a href="#">南港區</a></li>
                        <li><a href="#">文山區</a></li>
                    </div>
                </ul>
            </li>
            <li class="menu__item"><a href="#">新北</a>
                <ul class="submenu submenu--block">
                    <li><a href="#">永和區</a></li>
                </ul>
            </li>
            
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
    <header style="background-color: lavender">
        <div class="banner">
            <div style="text-align: center">
                <h1>台北捷運美食地圖</h1>
                <h3>餓了嗎？來找點東西吃吧~</h3>
            </div>
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
        </div>
    </header>
</body>

</html>