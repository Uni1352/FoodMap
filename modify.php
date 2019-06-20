<?php
session_start();

// 連接資料庫
$conn = mysqli_connect('localhost','uni','uni0110','foodmap');
if(!$conn){
    die('Could not connect: '.mysqli_connect_error());
}


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
            <form action="./modify.php" method="POST">
                <label for="username">名稱</label>
                <input type="text" name="username" id="username" value="<?php echo $_SESSION['valid_user']; ?>" disabled/><br>
                <label for="useremail">信箱</label>
                <input type="email" name="useremail" id="useremail" required /><br>
                <label for="userOldpsw">舊密碼</label>
                <input type="password" name="userOldpsw" id="userOldpsw" required /><br>
                <label for="userNewpsw">新密碼</label>
                <input type="password" name="userNewpsw" id="userNewpsw" required /><br>
                <?php
                // 修改資料
                if(isset($_POST['modify'])){
                    if(isset($_POST['useremail']) && isset($_POST['userOldpsw']) && isset($_POST['userNewpsw'])){
                        $sql = 'select * from Users where Email="'.$_POST['useremail'].'";';
                        $result = mysqli_query($conn, $sql);
                        if(!$result){
                            die('Error: '.mysqli_error($conn));
                        }

                        $num = mysqli_num_rows($result);
                        if($num==0){
                            // 新舊密碼是否相同
                            if($_POST['userOldpsw']==$_POST['userNewpsw']){
                                $sql = 'update Users set Email="'.$_POST['useremail'].'",Pwd="'.$_POST['userNewpsw'].'"
                                        where Username="'.$_SESSION['valid_user'].'";';
                                $result = mysqli_query($conn, $sql);
                                if(!$result){
                                    die('Error: '.mysqli_error($conn));
                                }
                                
                                echo '<p style="color: green">修改成功</p>';
                            }
                            else{
                                echo '<p style="color: red">修改失敗</p>';
                            }
                        }
                        else{
                            echo '<p style="color: red">修改失敗</p>';
                        }
                    }
                }
                ?>
                <input type="submit" value="修改" name="modify" id="modify" />
            </form>
        </main>
    </div>
</body>

</html>