<?php

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 


//SQL 語法
$sql = "DELETE FROM `activity_management` WHERE `activityId` = ? ";
$arrParam = [
    $_GET['deleteId']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if($stmt->rowCount() > 0) {
    echo "<script>alert('刪除成功');</script>";
    header("Refresh: 0; url=./admin.php");
    // echo "刪除成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "刪除失敗";
}