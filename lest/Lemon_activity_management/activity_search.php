<?php
header("Content-Type: text/html; chartset=utf-8");
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 
?>

<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
    <!-- 套用css -->
    
    <style>
    /* .border {
        border: 1px solid;
    } */
    .w200px {
        width: 200px;
    }
    </style>
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
            <div class="wrap">
                 <!-- 左側功能列表 -->
                <div class="left-wrap">
                    <?php require_once("./list.php"); ?>
                </div>
                <!-- 右側廠商列表 -->
                <div class="right-wrap">
<?php //require_once('./title.php'); ?>

    <table class="table">
        
            <?php   

                 // 針對搜索按鈕判斷
                // 判斷文本框的值是否為空，若是空，則點選搜索按鈕時會跳出訊息
                if(isset($_GET["searchtxt"]) && empty($_GET["searchtxt"])){
                    header("Refresh: 0; url=./admin.php");
                    echo "<script>alert('請輸入關鍵字查詢');</script>";
                    exit();
                }else{
                     // 搜尋方法一：
                     $_SESSION["search"] = $_GET["search"];
                     $_SESSION["searchtxt"] = $_GET["searchtxt"];
                }    
                
                $value = $_SESSION["search"];
                $name = $_SESSION["searchtxt"]; 
                
                //SQL 敘述: 取得資料表總筆數
            $sqlTotal = "SELECT count(1) FROM `activity_management` 
            WHERE `{$value}` LIKE '%{$name}%'"; 

            //取得總筆數
            $total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

            //每頁幾筆
            $numPerPage = 5;

            // 總頁數
            $totalPages = ceil($total/$numPerPage); 

            //目前第幾頁
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            //若 page 小於 1，則回傳 1
            $page = $page < 1 ? 1 : $page;

            $sql = "SELECT `activityId`, `activityCategory`, `activityName`, `activityContent`,
            `activityStartTime`, `activityEndTime`, `activityLocation`
            FROM `activity_management`
            WHERE `{$value}` LIKE '%{$name}%'
            ORDER BY `activityId` ASC
            LIMIT ?,?";

            //設定繫結值
            $arrParam = [($page - 1) * $numPerPage, $numPerPage];

            //查詢分頁後的學生資料
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);
                
            ?>
            <thead>
                <th class="border">選擇</th>
                <th class="border">活動編號</th>
                <th class="border">活動類別</th>
                <th class="border">活動名稱</th>
                <th class="border">活動內容</th>
                <!-- <th class="border">活動開始時間</th> -->
                <!-- <th class="border">活動結束時間</th> -->
                <th class="border">活動地點</th>
                <!-- <th class="border">功能</th> -->
            </thead>
            <tbody>
            <?php
            
                if( $stmt->rowcount() > 0 ){
                    $arrlike = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    for($i = 0; $i < count($arrlike); $i++) {
            ?>           
                <tr>
                <td class="border">
                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['activityId']; ?>" />
                </td>
                <td class="border"style="white-space:nowrap;"><?php echo $arrlike[$i]['activityId']; ?></td>
                <td class="border"style="white-space:nowrap;"><?php echo $arrlike[$i]['activityCategory']; ?></td>
                <td class="border"style="white-space:nowrap;"><?php echo $arrlike[$i]['activityName']; ?></td>
                <td class="border"><?php echo $arrlike[$i]['activityContent']; ?></td>
                <!-- <td class="border"><?php // echo $arrlike[$i]['activityStartTime']; ?></td> -->
                <!-- <td class="border"><?php // echo $arrlike[$i]['activityEndTime']; ?></td> -->
                <td class="border" style="white-space:nowrap;"><?php echo $arrlike[$i]['activityLocation']; ?></td>
                <!-- <td class="border">
                     <a href="./edit.php?editId=<?php //echo $arr[$i]['activityId']; ?>">編輯</a>
                    <a href="./delete.php?deleteId=<?php //echo $arr[$i]['activityId']; ?>">刪除</a> 
                </td> -->
                </tr>
            <?php
                }
            }
                 else {
                    ?>
                    <tr>
                        <td class="border" colspan="9">沒有資料</td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="border text-align-center" colspan="5">
                <?php 
                $search = $_SESSION["search"];
                $searchtxt = $_SESSION["searchtxt"];
                $link = '&search='.$search.'&searchtxt='.$searchtxt;

                for($i = 1; $i <= $totalPages; $i++){ ?>
                    <a class="tfoot-number" href="?page=<?= $i.$link ?>"><?= $i ?></a>
                <?php } ?>
                </td>
                <td class="border">
                <a class="inp-addbtn" href="./admin.php">返回活動列表</a>
                </td>
            </tr>
        </tfoot>
    </table>
     <!-- 顯示總比數 -->
  <div class="text-align-center fontfamily">
        表單比數：<?php echo $total; ?>
       </div> 
</body>
</html>