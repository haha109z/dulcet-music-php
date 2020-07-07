<?php
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

$sql = "UPDATE `ordertable` 
        SET 
        `userID` = ?,
        `name` = ?,
        `pay` = ?,
        `logistics` = ?,
        `status` = ?,
        `cashflow` = ? ";

$arrParam = [
    $_POST['userID'],
    $_POST['name'],
    $_POST['pay'],
    $_POST['logistics'],
    $_POST['status'],
    $_POST['cashflow']
];

$sql.= "WHERE `orderid` = ? ";
$arrParam[] = $_GET['editorderId'];
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if( $stmt->rowCount() > 0 ){
    header("Refresh: 3; url=./admin.php");
    echo "更新成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "沒有任何更新";
}