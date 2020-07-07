<?php
header("Content-Type: text/html; chartset=utf-8");

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

$sqldetail= "INSERT INTO `state`(`orderid`,`PId`,`PName`,`quantity`,`category`,`companyId`,`money`)
VALUES (?,?,?,?,?,?,?)";
$stmtdetail = $pdo->prepare($sqldetail);

$arr2 = [
    $_POST['orderid'],
    $_POST['PId'],
    $_POST['PName'],
    $_POST['quantity'],
    $_POST['category'],
    $_POST['companyId'],
    $_POST['money'],
];

$stmtdetail->execute($arr2);

if($stmtdetail->rowCount() === 1){
    header("Refresh: 3; url=./admin.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "新增失敗";
}