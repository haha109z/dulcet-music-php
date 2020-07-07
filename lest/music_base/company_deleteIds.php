<?php
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

//SQL 語法
$sql = "DELETE FROM `company` WHERE `companyId` = ? ";

$count = 0;

// 先查詢出特定 id (editId)
$sqlGetId = "SELECT `companyId` FROM `company` WHERE `companyId` = ? ";
$stmtGetId = $pdo->prepare($sqlGetId);

if(empty($_POST['chk'])){
    header("Refresh: 0; url=./company_admin.php");
        echo "<script>alert('沒有勾選刪除欄位');</script>";
        exit();
}

for($i = 0; $i < count($_POST['chk']); $i++){
    //加入繫結陣列
    $arrGetIdParam = [
        $_POST['chk'][$i]
    ];

    //執行 SQL 語法
    $stmtGetId->execute($arrGetIdParam);

    //若有找到 stmtGetId 的資料
    if($stmtGetId->rowCount() > 0) {
        //取得指定 id 的資料 (1筆)
        $arrId = $stmtGetId->fetchAll(PDO::FETCH_ASSOC);

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
    header("Refresh: 0; url=./company_admin.php");
} else {
    echo "<script>alert('刪除失敗');</script>";
    header("Refresh: 0; url=./company_admin.php");
}