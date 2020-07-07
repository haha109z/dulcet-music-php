<?php
header("Content-Type: text/html; chartset=utf-8");

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

$sqlorder = "INSERT INTO `ordertable`(`userID`,`name`,`pay`,`logistics`,`status`,`cashflow`)
VALUES (?,?,?,?,?,?)";




$arr = [
    // $_POST['orderid'],
    $_POST['userID'],
    $_POST['name'],
    $_POST['pay'],
    $_POST['logistics'],
    $_POST['status'],
    $_POST['cashflow']
    
];
$stmtorder = $pdo->prepare($sqlorder);
// print_r($stmtorder);
$stmtorder->execute($arr);
// print_r($arr);
if($stmtorder->rowCount() === 1) {
    header("Refresh: 3; url=./admin.php");
    echo "新增成功";
} else {
    // header("Refresh: 3; url=./admin.php");
    echo "新增失敗";
    // echo $stmtorder->rowCount();
    print_r($arr);
  
}