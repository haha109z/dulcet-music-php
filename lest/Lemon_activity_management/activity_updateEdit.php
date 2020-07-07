<?php
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

$sql = "UPDATE `activity_management` 
        SET 
        `activityId` = ?, 
        `activityCategory` = ?,
        `activityName` = ?,
        `activityContent` = ?,
        `activityStartTime` = ?,
        `activityEndTime` = ?,
        `activityLocation` = ? ";

$arrParam = [
    $_POST['activityId'],
    $_POST['activityCategory'],
    $_POST['activityName'],
    $_POST['activityContent'],
    $_POST['activityStartTime'],
    $_POST['activityEndTime'],
    $_POST['activityLocation']
];

// SQL 結尾
$sql.= "WHERE `activityId` = ? ";  

$arrParam[] = $_POST['editId'];
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);


if( $stmt->rowCount() > 0 ){
    header("Refresh: 3; url=./admin.php?editId=".$_POST['editId']);
    echo "更新成功";
} else {
    header("Refresh: 3; url=./admin.php?editId=".$_POST['editId']);
    echo "沒有任何更新";
}