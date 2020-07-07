<?php

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 
          

//SQL 語法
$sql = "DELETE FROM `activity_management` WHERE `activityId` = ? ";

$count = 0;

if ( empty($_POST['chk']) ) {

    header("Refresh: 0; url=./admin.php");
    echo "<script>alert('沒有勾選刪除欄位');</script>";
    exit();

} else {
    
    for($i = 0; $i < count($_POST['chk']); $i++) {

    $arrParam = [
        $_POST['chk'][$i]
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    $count += $stmt->rowCount();

    }

}



if($count > 0) {
    echo "<script>alert('刪除成功');</script>";
    header("Refresh: 0; url=./admin.php");
    // echo "刪除成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "刪除失敗";
}