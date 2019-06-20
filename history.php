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
            <?php
            // 連接資料庫
            $conn = mysqli_connect('localhost','uni','uni0110','foodmap');
            if(!$conn){
                die('Could not connect: '.mysqli_connect_error());
            }
            // 更改編碼
            mysqli_set_charset($conn,'utf8');

            $sql = 'select R.Resname, ResAddress, Phone, Search_time
                    from Search as S,Restaurants as R 
                    where Username="'.$_SESSION['valid_user'].'" and R.Resname=S.Resname
                    order by Search_time desc;';
            $result = mysqli_query($conn, $sql);
            if(!$result){
                die('Error: '.mysqli_error($conn));
            }
            // 取得資料筆數
            $num = mysqli_num_rows($result);
            
            // 印出所有資料
            for($i=0; $i<$num; $i++){
                $rows = mysqli_fetch_assoc($result);
                
                if($rows){                    
                    echo '<a href="./article.php?restaurant='.$rows['Resname'].'&count=yes">
                              <div>
                                  <div style="display: flex;margin-left: 0">
                                      <h3 style="font-size: 1.2em">'.$rows['Resname'].'</h3>&nbsp;
                                      <p style="font-size: 1em">'.$rows['Search_time'].'</p>                               
                                  </div>
                                  <p>'.$rows['Phone'].'</p>
                                  <p>'.$rows['ResAddress'].'</p>
                              </div>
                          </a><hr>';
                }
            }
            
            mysqli_close();
            ?>
            </article>
        </main>
    </div>
</body>

</html>