<?php
//引入判斷是否登入機制
require_once('../checkSession.php');

//引用資料庫連線
require_once('../db.inc.php');

//先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
$sqlGetImg = "SELECT `id` FROM `Coupon` WHERE `id` = ? ";
$stmtGetImg = $pdo->prepare($sqlGetImg);

//加入繫結陣列
$arrGetImgParam = [
    (int)$_GET['deleteId']
];

//執行 SQL 語法
$stmtGetImg->execute($arrGetImgParam);



//SQL 語法
$sql = "DELETE FROM `Coupon` WHERE `id` = ? ";

$arrParam = [
    (int)$_GET['deleteId']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if($stmt->rowCount() > 0) {
    echo "<script>alert('刪除成功');</script>";
    header("Refresh: 0; url=./coupon-admin.php");
    // echo "刪除成功";
} else {
    header("Refresh: 3; url=./coupon-admin.php");
    echo "刪除失敗";
}