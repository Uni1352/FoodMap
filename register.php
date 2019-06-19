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
            <li class="menu__item"><a href="./login.php">登入</a></li>
        </ul>
    </nav>
    <div class="container container--col" style="justify-content: center;align-items: center">
        <h2>註冊</h2>
        <form action="register.php" method="POST" style="width: 30%;">
            <label for="username">名稱</label>
            <input type="text" name="username" id="username" /><br>
            <label for="useremail">信箱</label>
            <input type="email" name="useremail" id="useremail" /><br>
            <label for="userpassword">密碼</label>
            <input type="password" name="userpassword" id="userpassword" /><br>
            <?php
            // 檢查欄位是否空白
            if(isset($_POST['username']) && isset($_POST['useremail']) && isset($_POST['userpassword'])){
                $name = $_POST['username'];
                $email = $_POST['useremail'];
                $password = $_POST['userpassword'];

                // 連接資料庫
                $conn = mysqli_connect('localhost','uni','uni0110','foodmap');
                if(!$conn){
                    die('Could not connect: '.mysqli_connect_error());
                }

                // 尋找是否有相同名字的用戶和信箱
                $sql = 'select * from Users where Username="'.$name.'" or Email="'.$email.'";';
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    die('Error: '.mysqli_error($conn));
                }

                $rows = mysqli_fetch_assoc($result);
                if(!$rows){
                    // 新增使用者
                    $sql = 'insert into Users values("'.$name.'","'.$email.'","'.$password.'","'.date('Y-m-d').'");';
                    $result = mysqli_query($conn, $sql);
                    if(!$result){
                        die('Error: '.mysqli_error($conn));
                    }

                    header('location:login.php');
                    exit();
                }
                else{
                    echo '<p style="color: red">註冊失敗，請再試一次</p><br>';
                }
            }

            mysqli_close();
            ?>
            <p>已經有帳戶？ <a href="./login.php" style="display: inline">登入</a></p>
            <input type="submit" id="register" name="register" value="註冊" />
        </form>
    </div>
</body>

</html>