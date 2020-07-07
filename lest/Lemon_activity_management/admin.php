<?php

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

//SQL 敘述
$sqlTotal = "SELECT count(1) FROM `activity_management`";
//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];
//每頁幾筆
$numPerPage = 6;
// 總頁數
$totalPages = ceil($total/$numPerPage);


//目前第幾頁
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  
//若 page 小於 1，則回傳 1
$page = $page < 1 ? 1 : $page;

?>


<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulect Music</title>
    <!-- 下列這個link放錯位置了 -->
    <link rel="stylesheet"  type="text/css" href="../css/css-ALL.css">
    </style>
</head>
<body>
    <!-- header -->
    <header class="header">
        <!-- Logo -->
        <figure>
            <img src="../css/logo_rectangle.svg" title="Logo"  style="height:100px">
        </figure>
        <!-- *** Lemon刪除 -->
        <!-- <p>Music Classroom</p> -->
        <a href="../logout.php?logout=1" style="margin:20px">登出</a>  
    </header>
    <!-- header下方 -->
    <div class="wrap"> 
        <!-- 左側menu bar-->
        <div class="left-wrap">
            <?php require_once("./list.php"); ?>
        </div>
        <!-- 右側資訊區 -->
        <div class="right-wrap">

            <!-- 搜索欄 -->
            <form class="title-form" action="./activity_search.php"  method="GET" name="mysearch">
                <div class="search-inner">
                    <div class="search-list">
                        <input  type="radio" name="search" value="activityId" checked>
                        活動編號
                        <input type="radio" name="search" value="activityCategory"                    
                            <?php
                            // 當此項被選中，搜索後保持選擇狀態
                            $check = "checked='checked'";
                            if(isset($_POST["search"]) && $_POST["search"] === "activityCategory"){
                                echo $check;
                            }
                            ?>  
                        >活動類別
                        <input type="radio" name="search" value="activityName"
                            <?php
                            // 當此項被選中，搜索後保持選擇狀態
                            $check = "checked='checked'";
                            if(isset($_POST["search"]) && $_POST["search"] === "activityName"){
                                echo $check;
                            }
                            ?>                  
                        >活動名稱
                        <input type="radio" name="search" value="activityContent"
                            <?php
                            $check = "checked='checked'";
                            if(isset($_POST["search"]) && $_POST["search"] === "activityContent"){
                                    echo $check;
                            }
                            ?>                 
                        >活動內容
                        <input type="radio" name="search" value="activityLocation"
                            <?php
                            $check = "checked='checked'";
                            if(isset($_POST["search"]) && $_POST["search"] === "activityLocation"){
                                echo $check;
                            }
                            ?>                 
                        >活動地點
                        <span>&nbsp&nbsp&nbsp</spna>輸入關鍵字：<input class="inp-searchtxt" type="text" name="searchtxt" value="" placeholder="請輸入關鍵字">
                        <input class="inp-searchbtn" type="submit" name="searchbtn" value="搜尋">
                    </div>
                </div>
                <a class="inp-addbtn" href="./activity_new.php">新增活動</a>
            </form>
            <!-- 活動列表 -->
            <form class="admin-form" name="myForm" method="POST" action="activity_deleteIds.php">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border" style="white-space:nowrap">選擇</th>
                            <th class="border"  style="white-space:nowrap">活動編號</th>
                            <th class="border"  style="white-space:nowrap">活動類別</th>
                            <th class="border" style="white-space:nowrap">活動名稱</th>
                            <th class="border" style="white-space:nowrap">活動內容</th>
                            <th class="border" style="white-space:nowrap">活動開始時間</th>
                            <th class="border" style="white-space:nowrap">活動結束時間</th>
                            <th class="border" style="white-space:nowrap">活動地點</th>
                            <!-- <th class="border"style="white-space:nowrap;">建立時間</th>
                            <th class="border"style="white-space:nowrap;">更新時間</th> -->
                            <th class="border">功能</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    //SQL 敘述
                    $sql = "SELECT `activityId`, `activityCategory`, `activityName`, `activityContent`, `activityStartTime`, 
                                    `activityEndTime`, `activityLocation`,`created_at`, `updated_at`
                            FROM `activity_management` 
                            ORDER BY `activityId` ASC 
                            LIMIT ?, ? ";

                    //設定繫結值
                    $arrParam = [($page - 1) * $numPerPage, $numPerPage];

                    //查詢分頁後的學生資料
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($arrParam);

                    //資料數量大於 0，則列出所有資料
                    if($stmt->rowCount() > 0) {
                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        for($i = 0; $i < count($arr); $i++) {
                    ?>
                        <tr class="border">
                            <td class="border check">
                                <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['activityId']; ?>" />
                            </td>
                            <td class="border"><?php echo $arr[$i]['activityId']; ?></td>
                            <td class="border"style="white-space:nowrap;"><?php echo $arr[$i]['activityCategory']; ?></td>
                            <td class="border"style="white-space:nowrap;"><?php echo $arr[$i]['activityName']; ?></td>
                            <td class=" border1"><?php echo $arr[$i]['activityContent']; ?></td>
                            <td class="border"><?php echo $arr[$i]['activityStartTime']; ?></td>
                            <td class="border"><?php echo $arr[$i]['activityEndTime']; ?></td>
                            <td class="border"style="white-space:nowrap;"><?php echo $arr[$i]['activityLocation']; ?></td>
                            <!-- <td class="border"><?php //echo $arr[$i]['created_at']; ?></td>
                            <td class="border"><?php //echo $arr[$i]['updated_at']; ?></td> -->
                            <!-- 功能欄：編輯/刪除該筆資料(建置link) -->
                            <td class="border">
                                <a class="inp-edit" href="./activity_edit.php?editId=<?php echo $arr[$i]['activityId']; ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="inp-delete" href="./activity_delete.php?deleteId=<?php echo $arr[$i]['activityId']; ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td class="border" colspan="11">沒有資料</td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                    <!-- 加入頁碼&連結  -->
                    <tfoot>
                        <tr>
                            <td class="border">
                            <input class="inp-delete inp-delete2" type="submit" name="smb" value="刪除">
                            </td>
                            <td class="border text-align-center" colspan="11">
                                <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                                    <a class="tfoot-number" href="?page=<?= $i ?>"><?= $i ?></a>
                                <?php } ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
             <!-- 顯示總比數 -->
  <div class="text-align-center fontfamily">
        表單比數：<?php echo $total; ?>
       </div> 
        </div>

<script src="https://kit.fontawesome.com/39e79750f1.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(".btn1").click(function(){
    $(".p1").toggle(500);
  });
});
$(document).ready(function(){
  $(".btn2").click(function(){
    $(".p2").toggle(500);
  });
});
$(document).ready(function(){
  $(".btn3").click(function(){
    $(".p3").toggle(500);
  });
});
$(document).ready(function(){
  $(".btn4").click(function(){
    $(".p4").toggle(500);
  });
});
$(document).ready(function(){
  $(".btn5").click(function(){
    $(".p5").toggle(500);
  });
});
$(document).ready(function(){
  $(".btn6").click(function(){
    $(".p6").toggle(500);
  });
});
</script>
</body>
</html>