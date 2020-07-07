<?php
header("Content-Type: text/html; chartset=utf-8");

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

//SQL 敘述
$sql = "INSERT INTO `company` 
        (`companyId`, `companyName`, `companyPhone`, `principal`,`principalPhone`, `email`, `companyAddress`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";


//繫結用陣列
$arr = [
    $_POST['companyId'],
    $_POST['companyName'],
    $_POST['companyPhone'],
    $_POST['principal'],
    $_POST['principalPhone'],
    $_POST['email'],
    $_POST['companyAddress']
];

for($i = 0 , $len = count($arr); $i < $len; $i++){
    if(empty($arr[$i])){
        header("Refresh: 0; url=./company_new.php");
        echo "<script>alert('請輸入完整資訊');</script>";
        exit();
    }
}

$pdo_stmt = $pdo->prepare($sql);
$pdo_stmt2 = $pdo_stmt->execute($arr);


if($pdo_stmt->rowCount() === 1) {
    header("Refresh: 3; url=./company_admin.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./company_admin.php");
    echo "新增失敗";
}

