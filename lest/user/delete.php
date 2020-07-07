<?php

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

//先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
$sqlGetImg = "SELECT `userImg` FROM `user` WHERE `userID` = ? ";
$stmtGetImg = $pdo->prepare($sqlGetImg);

//加入繫結陣列
$arrGetImgParam = [
    $_GET['deleteId']
];

//執行 SQL 語法
$stmtGetImg->execute($arrGetImgParam);


//若有找到 studentImg 的資料
if($stmtGetImg->rowCount() > 0) {
    //取得指定 id 的學生資料 (1筆)
    $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC);

    //若是 studentImg 裡面不為空值，代表過去有上傳過
    if($arrImg[0]['userImg'] !== NULL){
        //刪除實體檔案
        @unlink("./files/".$arrImg[0]['userImg']);
    }     
}

//SQL 語法
$sql = "DELETE FROM `user` WHERE `userID` = ? ";

$arrParam = [
    $_GET['deleteId']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if($stmt->rowCount() > 0) {
    echo "<script>alert('刪除成功');</script>";
    header("Refresh: 0; url=./admin.php");
    // echo "刪除成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "刪除失敗";
}