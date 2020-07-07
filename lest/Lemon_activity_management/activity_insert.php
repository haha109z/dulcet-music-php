<?php
header("Content-Type: text/html; chartset=utf-8");

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

//SQL 敘述
$sql = "INSERT INTO `activity_management` 
        (`activityId`, `activityCategory`, `activityName`, `activityContent`, `activityStartTime`, `activityEndTime`, `activityLocation`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$arr = [
            $_POST['activityId'],
            $_POST['activityCategory'],
            $_POST['activityName'],
            $_POST['activityContent'],
            $_POST['activityStartTime'],
            $_POST['activityEndTime'],
            $_POST['activityLocation']
        ];

    
$pdo_stmt = $pdo->prepare($sql);
$pdo_stmt->execute($arr);
if($pdo_stmt->rowCount() === 1) {
        header("Refresh: 3; url=./admin.php");
        echo "新增成功";
    } else {
        header("Refresh: 3; url=./admin.php");
            echo "新增失敗";
    }



