<?php

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

@$search=$_GET['search'];

$getID = isset($_GET['ID']) ? $_GET['ID'] : "";
$submitButton = isset($_GET['submitButton']) ? $_GET['submitButton'] : "";


// if (!isset($_SESSION)) {
//     session_start();
// }

$sql_where = "";

if($submitButton=="" && $getID ==""){

}else{
// 查詢     當按下按鈕時將表單資料送入迴圈執行
if (isset($_GET['submitButton'])) {
    
    // 若無輸入查詢的關鍵字
    if ($getID!="") {
        // 定義 $search 
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        // 沒有選chbox但有輸入條件
        if ($search == false && $_GET['ID']) {
            // $_SESSION['searchs'] = $_GET['ID'];
            // setcookie('searchs', $_GET['ID']);
            
            $sql_where = "where concat(
            IFNULL(`orderid`,'')
            ,IFNULL(`userID`,'')
            ,IFNULL(`name`,'')
            ,IFNULL(`pay`,'')
            ,IFNULL(`logistics`,'')
            ,IFNULL(`status`,'')
            ,IFNULL(`cashflow`,'')
            ,IFNULL(`create_at`,'')
            ,IFNULL(`update_at`,''))
            like '%".$_GET['ID']."%'";
        }
        
        // 如果chbox有勾選並有輸入文字 進入迴圈否則 $sql_where sql收尋條件為空
        
        if ($search && $_GET['ID']) {

            // 將勾選的所有條件放入$table_column變數中
            // for ($i = 0; $i < count($_GET['search']); $i++) {
                $table_column = $_GET['search'];
                // if ($i === 0) {
                    // 勾選一個 將sql條件放入$sql_where變數中
                    $sql_where = "where `".$table_column."` like '%".$_GET['ID']."%'";
                // } else {
                //     // 勾選多個 將sql條件放入$sql_where變數中
                //     $sql_where .= "OR `".$table_column."` like '%".$_GET['ID']."%'";
                // }
            }
        }
    } else {
        echo"<script>alert('請輸入查詢內容')</script>";
        header("Refresh: 0; url=./admin.php");
        
    }
}





//SQL 敘述: 取得 students 資料表總筆數
$sqlTotal1 = "SELECT count(1) FROM `ordertable`".$sql_where;
// $sqlTotal2 = "SELECT count(1) FROM `ordertable`".$sql_where;

//取得總筆數
$total1 = $pdo->query($sqlTotal1)->fetch(PDO::FETCH_NUM)[0];
// $total2 = $pdo->query($sqlTotal2)->fetch(PDO::FETCH_NUM)[0];

//每頁幾筆
$numPerPage = 10;

// 總頁數
$totalPages1 = ceil($total1/$numPerPage);
// $totalPages2 = ceil($total2/$numPerPage);

//目前第幾頁
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//若 page 小於 1，則回傳 1
$page = $page < 1 ? 1 : $page;


// SQL 敘述
// $sql = "SELECT `orderid`, `userID`, `name`, `pay`, `logistics`, 
//         `status`, `cashflow`,`create_at`,`update_at`
//         FROM `ordertable` 
//             ".$sql_where."
//             ORDER BY `orderid` ASC 
//             LIMIT ?, ? ";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
    <style>
        /* .border {
            border: 1px solid;
        } */

        .w200px {
            width: 200px;
        }
    </style>
<link rel="stylesheet"  type="text/css" href="../css/css-ALL.css">
        </head>
        <body>
            <!-- title -->
            <header class="header">
                         <!-- Logo -->
        <figure>
            <img src="../css/logo_rectangle.svg" title="Logo"  style="height:100px">
        </figure>
        <a href="../logout.php?logout=1" style="margin:20px">登出</a>  
            </header>
            <div class="wrap">
                 <!-- 左側功能列表 -->
                <div class="left-wrap">
                    <?php require_once("./list.php"); ?>
                </div>
                <!-- 右側廠商列表 -->
                <div class="right-wrap">
    
  
    
    
    <form class="title-form " method="get" enctype="multipart/form-data">

<div class="search-inner ">
            <div class="search-list">
        <input type="radio" id="orderid" name="search" value="orderid"
        <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "orderid"){
                            echo $check;
                        }
                    ?>>
        <label for="orderid"> 訂單編號</label>

        <input type="radio" id="userID" name="search" value="userID"
        <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "userID"){
                            echo $check;
                        }
                    ?>>
        <label for="userID"> 會員編號</label>

        <input type="radio" id="name" name="search" value="name"
        <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "name"){
                            echo $check;
                        }
                    ?>>
        <label for="name"> 會員姓名</label>

        <input type="radio" id="pay" name="search" value="pay"
        <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "pay"){
                            echo $check;
                        }
                    ?>>
        <label for="pay"> 付款方式</label>

        <input type="radio" id="logistics" name="search" value="logistics"
        <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "logistics"){
                            echo $check;
                        }
                    ?>>
        <label for="logistics"> 物流狀態</label>

        <input type="radio" id="status" name="search" value="status"
        <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "status"){
                            echo $check;
                        }
                    ?>>
        <label for="status"> 訂單狀態</label>

        <input type="radio" id="cashflow" name="search" value="cashflow"
        <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "cashflow"){
                            echo $check;
                        }
                    ?>>
        <label for="cashflow"> 金流狀態</label>

        輸入關鍵字：
        <input class="inp-searchtxt"  type="text" name="ID" value="" />
        <input class="inp-searchbtn" type="submit" value="搜尋" name="submitButton" />
        
    </div>
    </div>
     <a class="inp-addbtn" href="./insertorder.php">新增訂單</a>
    </form>
   
    <?php //require_once('./title.php'); ?>


    <form name="myForm " method="POST" action="deleteorders.php">
        <table class="table fontfamily">
            <thead>
                <tr>
                    <th class="border" style="white-space:nowrap">選擇</th>
                    <th class="border" style="white-space:nowrap">訂單編號</th>
                    <th class="border" style="white-space:nowrap">會員編號</th>
                    <th class="border" style="white-space:nowrap">會員姓名</th>
                    <th class="border" style="white-space:nowrap">付款方式</th>
                    <th class="border" style="white-space:nowrap">物流狀態</th>
                    <th class="border" style="white-space:nowrap">訂單狀態</th>
                    <th class="border" style="white-space:nowrap">金流狀態</th>
                    <th class="border" style="white-space:nowrap">建立時間</th>
                    <th class="border" style="white-space:nowrap">更新時間</th>
                    <th class="border" style="white-space:nowrap">功能</th>
                </tr>
            </thead>
            <tbody>
            <?php

                // SQL 敘述
            $sql = "SELECT `orderid`,`userID`,`name`,`pay`,
                `logistics`,`status`,`cashflow`,`create_at`,`update_at`
                FROM `ordertable`
                " . $sql_where . "
                ORDER BY `orderid` ASC
                LIMIT ?, ? ";


                //設定繫結值
                $arrParam = [($page - 1) * $numPerPage, $numPerPage];
            
                //查詢分頁後的學生資料
                $stmt = $pdo->prepare($sql);
                $stmt->execute($arrParam);

                //資料數量大於 0，則列出所有資料
                if ($stmt->rowCount() > 0) {
                    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    for ($i = 0; $i < count($arr); $i++) {
                ?>

                        <tr>
                            <td class="border check">
                                <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['orderid']; ?>" />
                            </td>
                            <td class="border check"><?php echo $arr[$i]['orderid']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['userID']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['name']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['pay']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['logistics']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['status']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['cashflow']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['create_at']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['update_at']; ?></td>
                            <td class="border">
                                <a class="inp-edit" href="./detail.php?detailId=<?php echo $arr[$i]['orderid']; ?>">明細</a>
                                <a class="inp-delete" href="./editorder.php?editorderId=<?php echo $arr[$i]['orderid']; ?>"><i class="fas fa-edit"></i></a>
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
                <tfoot>
                <tr>
                    <td class="border">
                        <input class="inp-delete inp-delete2" type="submit" name="smb" value="刪除">
                    </td>  
                    <td class="border text-align-center" colspan="10"> 
                    <?php
                        for($i = 1; $i <= $totalPages1; $i++){ ?>
                                <a class="tfoot-number"  href="?search=<?php echo $search;?>&ID=<?php echo $getID;?>&submitButton=<?php echo $submitButton;?>&page=<?= $i ?>"><?= $i ?></a>
                            <?php }
                        ?>
                    </td>
                </tr>
            </tfoot>
        </table>
        
    </form>
       <!-- 顯示總比數 -->
       <div class="text-align-center fontfamily">
        表單比數：<?php echo $total1; ?>
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