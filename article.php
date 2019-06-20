<?php
session_start();

// 連接資料庫
$conn = mysqli_connect('localhost','uni','uni0110','foodmap');
if(!$conn){
    die('Could not connect: '.mysqli_connect_error());
}
// 更改編碼
mysqli_set_charset($conn,'utf8');

// 加入搜索紀錄
if(isset($_SESSION['valid_user']) && isset($_GET['count'])){
    $sql = 'insert into Search values
            ("'.$_SESSION['valid_user'].'","'.$_GET['restaurant'].'","'.date('Y-m-d H:i:s').'");';
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die('Error: '.mysqli_error($conn));
    }

    // 判斷是否已加入我的最愛
    $sql = 'select * from Favorite 
            where Username="'.$_SESSION['valid_user'].'" and Resname="'.$_GET['restaurant'].'";';
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die('Error: '.mysqli_error($conn));
    }

    $rows = mysqli_fetch_assoc($result);
    if($rows){
        $flag="t";
    }
    else{
        $flag="f";
    }
}

// 讀取餐廳資料
$sql = 'select * from Restaurants
        where Resname="'.$_GET['restaurant'].'";';
$result = mysqli_query($conn, $sql);
if(!$result){
    die('Error: '.mysqli_error($conn));
}

// 取得資料筆數
$num = mysqli_num_rows($result);
// 取得資料
$rows = mysqli_fetch_assoc($result);
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
            <h2 style="margin-bottom: 25px"><?php echo $_GET['restaurant']; ?></h2>
            <h3 style="margin-bottom: 15px">基本資料</h3><br>
            <p><b>電話：</b><?php echo $rows['Phone']; ?></p>
            <p><b>地址：</b><?php echo $rows['ResAddress']; ?></p>
            <p><b>類型：</b><?php echo $rows['ResType']; ?></p>
            <p><b>營業時間：</b><?php echo $rows['OpenTime']; ?></p>
            <br>
            <!-- TODO: 圖片 -->
            <!-- <img src="#" alt="我是圖喔喔喔喔喔喔喔"><br> -->
            <h3 style="margin-bottom: 15px">簡介</h3><br>
            <p style="text-indent: 2em;"><?php echo $rows['info']; ?></p>
            <br>
            <!-- TODO: 我的最愛按鈕：點兩下才會轉 -->
            <?php
            if(isset($_SESSION['valid_user'])){
                if(isset($_GET['flag'])){
                    $flag = $_GET['flag'];
                }
                
                // 按鈕顯示
                if($flag=="t"){
                    echo '<form action="./article.php?restaurant='.$_GET['restaurant'].'&flag=f" method="POST">
                              <input type="submit" value="從我的最愛移除" id="deleteFavor" name="deleteFavor" style="margin-left: 0;padding: 5px" />
                          </form><br>';
                }
                if($flag=="f"){
                    echo '<form action="./article.php?restaurant='.$_GET['restaurant'].'&flag=t" method="POST">
                              <input type="submit" value="加入我的最愛" id="addFavor" name="addFavor" style="margin-left: 0;padding: 5px" />
                          </form><br>'; 
                }

                // 從我的最愛移除
                if(isset($_POST['deleteFavor'])){
                    $sql = 'delete from Favorite 
                            where Username="'.$_SESSION['valid_user'].'" and Resname="'.$_GET['restaurant'].'";';
                    $result = mysqli_query($conn, $sql);
                    if(!$result){
                        die('Error: '.mysqli_error($conn));
                    }

                    $flag="f";
                }
                    
                // 加入我的最愛
                if(isset($_POST['addFavor'])){
                    $sql = 'insert into Favorite values("'.$_SESSION['valid_user'].'","'.$_GET['restaurant'].'");';
                    $result = mysqli_query($conn, $sql);
                    if(!$result){
                        die('Error: '.mysqli_error($conn));
                    }

                    $flag="t";
                }
            }
            ?>
            <h3 style="margin-bottom: 15px">留言板</h3><br>
            <?php
            if(isset($_SESSION['valid_user'])){
                echo '<form action="./article.php?restaurant='.$_GET['restaurant'].'" method="POST">
                          <p><b>留言人： </b>'.$_SESSION['valid_user'].'</p>
                          <p><b>留言內容： </b></p>
                          <textarea name="msg" id="msg" cols="30" rows="10" required></textarea>
                          <br>
                          <p><b>星星數： </b></p>
                          <input type="number" id="star" name="star" min="0" max="5" required /><br>
                          <input type="submit" value="送出" name="comment" id="comment" style="margin-left: 0" />
                      </form><br>';
            }
            else {
                echo '<p>登入後才可以留言喔喔喔喔喔喔</p><br>';
            }

            // 新增留言
            if(isset($_POST['comment'])){
                $sql = 'insert into Comments values
                    ("'.$_SESSION['valid_user'].'","'.$_GET['restaurant'].'","'.date('Y-m-d').'",'.$_POST['star'].',"'.$_POST['msg'].'")';
                $result = mysqli_query($conn, $sql);
                if(!$result){
                    die('Error: '.mysqli_error($conn));
                }
            }            

            // 取得留言列表
            $sql = 'select * from Comments
                    where Resname="'.$_GET['restaurant'].'";';
            $result = mysqli_query($conn, $sql);
            if(!$result){
                die('Error: '.mysqli_error($conn));
            }
            
            // 取得資料筆數
            $num = mysqli_num_rows($result);
            // 取得資料
            for($i=0; $i<$num; $i++){
                $rows = mysqli_fetch_assoc($result);

                echo '<div class="comment">
                          <div class="comment__content">
                              <h3>'.$rows['Username'].'</h3>
                              <p>'.$rows['Star'].'</p><br>
                          </div>
                          <p>'.$rows['Msg'].'</p>
                          <p>'.$rows['Comment_date'].'</p><br>
                      </div>';
            }

            mysqli_close();
            ?>           
        </main>
    </div>
</body>

</html>