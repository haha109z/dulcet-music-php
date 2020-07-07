<?php

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

$sql = "UPDATE `state` 
        SET  
        `orderid` = ?,
        `PId` = ?,
        `PName` = ?,
        `quantity` = ?,
        `category` = ?,
        `companyId` = ?,
        `money` = ? ";

$arrParam = [
    $_POST['orderid'],
    $_POST['PId'],
    $_POST['PName'],
    $_POST['quantity'],
    $_POST['category'],
    $_POST['companyId'],
    $_POST['money']
];

$sql.= "WHERE `stateid` = ? ";
$arrParam[] = $_GET['editdetailId'];
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if( $stmt->rowCount() > 0 ){
    header("Refresh: 3; url=./admin.php");
    echo "更新成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "沒有任何更新";
}