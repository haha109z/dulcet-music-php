<?php
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 
?>
<!-- <!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body> -->

    <!-- title -->
    <!-- <header class="header">
        <p>Music Classroom</p>
        <a href="../logout.php?logout=1" style="margin:20px">登出</a>  
    </header> -->

    <!-- <div class="wrap"> -->
         <!-- 左側功能列表 -->
        <!-- <div class="left-wrap"> -->
            <?php // require_once("./list.php"); ?>
        <!-- </div> -->

        <!-- 右側廠商列表 -->
        <!-- <div class="right-wrap"> -->

            <?php
                //先查詢出特定 companyId (editId) 資料欄位
                $sqlGetId = "SELECT `companyId` FROM `company` WHERE `companyId` = ? ";
                $stmtGetId = $pdo->prepare($sqlGetId);

                //加入繫結陣列
                $arrGetIdParam = [
                    $_GET['deleteId']
                ];

                //執行 SQL 語法
                $stmtGetId->execute($arrGetIdParam);

                //若有找到 stmtGetId 的資料
                if($stmtGetId->rowCount() > 0) {
                    //取得指定 companyId 的資料 (1筆)
                    $arrId = $stmtGetId->fetchAll(PDO::FETCH_ASSOC);
                }

                //SQL 語法
                $sql = "DELETE FROM `company` WHERE `companyId` = ? ";

                $arrParam = [
                    $_GET['deleteId']
                ];

                $stmt = $pdo->prepare($sql);
                $stmt->execute($arrParam);

                if($stmt->rowCount() > 0) {
                    echo "<script>alert('刪除成功');</script>";
                    header("Refresh: 0; url=./company_admin.php");
                } else {
                    echo "<script>alert('刪除失敗');</script>";
                    header("Refresh: 0; url=./company_admin.php");
                }
            ?>
        <!-- </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(".btn2").click(function(){
    $(".p2").toggle(500);
  });
});
</script>
    
</body>

</html> -->
