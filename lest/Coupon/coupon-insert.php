<?php
header("Content-Type: text/html; chartset=utf-8");

//引入判斷是否登入機制
require_once('../checkSession.php');

//引用資料庫連線
require_once('../db.inc.php');

//SQL 敘述
$sql = "INSERT INTO `Coupon`(`user_id`,`number`,`content`,`price`,`password`,`alidityv`,`use_date`,`status`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

//繫結用陣列
$arr = [
    $_POST['user_id'],
    $_POST['number'],
    $_POST['content'],
    $_POST['price'],
    $_POST['password'],
    $_POST['alidityv'],
    $_POST['use_date'],
    $_POST['status'],
];

for($i = 0 , $len = count($arr); $i < $len; $i++){
    if(strlen($arr[$i])<=0){
        header("Refresh: 0; url=./coupon-new.php");
        echo "<script>alert('請輸入完整資訊');</script>";
        exit();
    }
}

$pdo_stmt = $pdo->prepare($sql);
$pdo_stmt->execute($arr);
if($pdo_stmt->rowCount() === 1) {
    header("Refresh: 3; url=./coupon-admin.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./coupon-admin.php");
    echo "新增失敗";
}