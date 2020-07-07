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
    <link rel="stylesheet" type="text/css" href="../css/css-ALL.css">
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
            <?php //require_once('./templates/company_title.php'); ?>
                <table class="table">
                    <?php

                        // 針對搜索按鈕判斷
                        // 判斷文本框的值是否為空，若是空，則點選搜索按鈕時會跳出訊息
                        if(isset($_GET["searchtxt"]) && empty($_GET["searchtxt"])){
                          header("Refresh: 0; url=./company_admin.php");
                            echo "<script>alert('請輸入關鍵字查詢');</script>";
                            exit();
                        }else{
                            // 搜尋方法一：
                            $_SESSION["search"] = $_GET["search"];
                            $_SESSION["searchtxt"] = $_GET["searchtxt"];
                        }

                        $value = $_SESSION["search"];
                        $name = $_SESSION["searchtxt"];

                        //SQL 敘述: 取得 students 資料表總筆數
                    $sqlTotal = "SELECT count(1) FROM `company`
                    WHERE `{$value}` LIKE '%{$name}%'";

                    //取得總筆數
                    $total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

                    //每頁幾筆
                    $numPerPage = 8;

                    // 總頁數
                    $totalPages = ceil($total/$numPerPage);

                    //目前第幾頁
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                    //若 page 小於 1，則回傳 1
                    $page = $page < 1 ? 1 : $page;

                    $sql = "SELECT `companyId`, `companyName`, `companyPhone`, `principal`,
                    `principalPhone`, `email`, `companyAddress`
                    FROM `company`
                    WHERE `{$value}` LIKE '%{$name}%'
                    ORDER BY `companyId` ASC
                    LIMIT ?,?";

                    //設定繫結值
                    $arrParam = [($page - 1) * $numPerPage, $numPerPage];

                    //查詢分頁後的學生資料
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($arrParam);

                    ?>
                    <thead>
                        <th class="border">廠商編號</th>
                        <th class="border">廠商名稱</th>
                        <th class="border">廠商電話</th>
                        <th class="border">負責人</th>
                        <th class="border">負責人電話</th>
                        <th class="border">信箱</th>
                        <th class="border">地址</th>
                    </thead>
                    <tbody>
                    <?php

                        if( $stmt->rowcount() > 0 ){
                            $arrlike = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            for($i = 0; $i < count($arrlike); $i++) {
                    ?>
                        <tr>
                        <td class="border"><?php echo $arrlike[$i]['companyId']; ?></td>
                        <td class="border"><?php echo $arrlike[$i]['companyName']; ?></td>
                        <td class="border"><?php echo $arrlike[$i]['companyPhone']; ?></td>
                        <td class="border"><?php echo $arrlike[$i]['principal']; ?></td>
                        <td class="border"><?php echo $arrlike[$i]['principalPhone']; ?></td>
                        <td class="border"><?php echo $arrlike[$i]['email']; ?></td>
                        <td class="border"><?php echo $arrlike[$i]['companyAddress']; ?></td>
                        </tr>
                    <?php
                        }
                    }
                        else {
                            ?>
                            <tr>
                                <td class="border" colspan="7">沒有資料</td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="border text-align-center" colspan="6">
                        <?php
                        $search = $_SESSION["search"];
                        $searchtxt = $_SESSION["searchtxt"];
                        $link = '&search='.$search.'&searchtxt='.$searchtxt;

                        for($i = 1; $i <= $totalPages; $i++){ ?>
                            <a class="tfoot-number" href="?page=<?= $i.$link ?>"><?= $i ?></a>
                        <?php } ?>
                        
                        </td>
                        <td class="border"> <a class="inp-addbtn" href="./company_admin.php" >回廠商列表</a> </td>
                    </tr>
                </tfoot>
                
            </table>
              <!-- 顯示總比數 -->
        <div class="text-align-center fontfamily">
        表單比數：<?php echo $total; ?>
       </div> 
        </div>
    </div>
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