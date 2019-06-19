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
            <h2>資料修改</h2><br>
            <form action="#" method="POST">
                <label for="username">名稱</label>
                <input type="text" name="username" id="username" /><br>
                <label for="useremail">信箱</label>
                <input type="email" name="useremail" id="useremail" /><br>
                <label for="userpassword">密碼</label>
                <input type="password" name="userpassword" id="userpassword" /><br>
                <input type="submit" value="修改" id="modify" />
            </form>
        </main>
    </div>
</body>

</html>