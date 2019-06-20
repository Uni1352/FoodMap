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
            <li class="menu__item"><a href="#">會員</a>
                <ul class="submenu submenu--block">
                    <li><a href="./history.php">搜尋紀錄</a></li>
                    <li><a href="./favorite.php">我的最愛</a></li>
                    <li><a href="./modify.php">資料修改</a></li>
                    <li><a href="./logout.php">登出</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="sidebar" style="flex-grow: 1;">
            <ul class="menu" style="flex-flow: column wrap;">
                <li class="menu__item" style="display: block;text-align: left"><a href="./history.php">搜尋紀錄</a></li>
                <li class="menu__item" style="display: block;text-align: left"><a href="./favorite.php">我的最愛</a></li>
                <li class="menu__item" style="display: block;text-align: left"><a href="./modify.php">資料修改</a></li>
                <li class="menu__item" style="display: block;text-align: left"><a href="./logout.php">登出</a></li>
            </ul>
        </div>
        <main style="flex-grow: 10">
            <h2>搜索紀錄</h2><br>
            <article>
                <a href="./article.php">
                    <div>
                        <h3>餐廳名</h3><br>
                        <p>地址</p>
                        <p>時間</p>
                    </div>
                </a>
                <hr>
                <a href="./article.php">
                    <div>
                        <h3>餐廳名</h3><br>
                        <p>地址</p>
                        <p>時間</p>
                    </div>
                </a>
            </article>
        </main>
    </div>
</body>

</html>