<?php
//引入判斷是否登入機制
require_once('../checkSession.php');

//引用資料庫連線
require_once('../db.inc.php');

//SQL 語法
$sql = "DELETE FROM `Coupon` WHERE `id` = ? ";

$count = 0;

//先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
$sqlGetImg = "SELECT `id` FROM `Coupon` WHERE `id` = ? ";
$stmtGetImg = $pdo->prepare($sqlGetImg);

for($i = 0; $i < count($_POST['chk']); $i++){
    //加入繫結陣列
    $arrGetImgParam = [
        (int)$_POST['chk'][$i]
    ];

    //執行 SQL 語法
    $stmtGetImg->execute($arrGetImgParam);

    
    $arrParam = [
        $_POST['chk'][$i]
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    $count += $stmt->rowCount();
}

if($count > 0) {
    echo "<script>alert('刪除成功');</script>";
    header("Refresh: 0; url=./coupon-admin.php");
    // echo "刪除成功!!!";
} else {
    header("Refresh: 3; url=./coupon-admin.php");
    echo "刪除失敗...";
}