<?php
session_start();

$type = $_POST['type'];
$search = $_POST['search'];

// 連接資料庫
$conn = mysqli_connect('localhost','uni','uni0110','foodmap');
if(!$conn){
    die('Could not connect: '.mysqli_connect_error());
}
// 更改編碼
mysqli_set_charset($conn,'utf8');

// 尋找店家
switch($type){
    case 'restaurant':
      $sql = 'select * from Restaurants as R, Nearby as N
              where Resname like "%'.$search.'%" and R.Resname=N.Resname;';    
      break;
    case 'MRT':
      $sql = 'select * from Restaurants as R, Nearby as N
              where MRT like "%'.$search.'%" and R.Resname=N.Resname;';
      break;
    case 'district':
      $sql = 'select * from Restaurants as R, Nearby as N
              where ResAddress like "%'.$search.'%" and R.Resname=N.Resname;';
      break;
}
$result = mysqli_query($conn, $sql);
if(!$result){
    die('Error: '.mysqli_error($conn));
}
// 取得資料筆數
$num = mysqli_num_rows($result);
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
            <br>
            <article>
            <?php
            // 顯示資料
            if($num==0){
                echo '<p>沒有 <b>'.$search.'</b> 的相關結果</p><br>';
            }
            else{
                echo '<p>查詢 <b>'.$search.'</b> 的相關結果：</p><br>';
                for($i=0; $i<$num; $i++){
                    $rows = mysqli_fetch_assoc($result);

                    if($rows){                    
                        echo '<a href="./article.php?restaurant='.$rows['Resname'].'&count=yes" target="_blank">
                                  <div>
                                      <h3>'.$rows['Resname'].'</h3><br>
                                      <p>電話：'.$rows['Phone'].'</p>
                                      <p>地址：'.$rows['ResAddress'].'</p>
                                      <p>附近捷運站：'.$rows['MRT'].'</p>
                                  </div>
                              </a><hr>';
                    }
                }
            }

            mysqli_close();
            ?>
            </article>
        </main>
    </div>
</body>

</html>