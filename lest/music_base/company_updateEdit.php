<?php
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

/**
 * 注意：
 * 
 * 因為要判斷更新時檔案有無上傳，
 * 所以要先對前面/其它的欄位先進行 SQL 語法字串連接，
 * 再針對圖片上傳的情況，給予對應的 SQL 字串和資料繫結設定。
 * 
 */

// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
// exit();

//先對其它欄位，進行 SQL 語法字串連接
$sql = "UPDATE `company` 
        SET 
        `companyId` = ?, 
        `companyName` = ?,
        `companyPhone` = ?,
        `principal` = ?,
        `principalPhone` = ?,
        `email` = ? ,
        `companyAddress` = ?
        WHERE `companyId` = ?";

//先對其它欄位進行資料繫結設定
$arrParam = [
    @$_POST['companyId'],
    @$_POST['companyName'],
    @$_POST['companyPhone'],
    @$_POST['principal'],
    @$_POST['principalPhone'],
    @$_POST['email'],
    @$_POST['companyAddress']
];

$arrParam[] = @$_POST['editId'];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if( $stmt->rowCount() > 0 ){
    header("Refresh: 3; url=./company_admin.php");
    echo "更新成功";
} else {
    header("Refresh: 3; url=./company_admin.php");
    echo "沒有任何更新";
}