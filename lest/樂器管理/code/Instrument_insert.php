<?php
header("Content-Type: text/html; chartset=utf-8");

//引用資料庫連線
require_once('../../db.inc.php');

//SQL 敘述
$sql = "INSERT INTO `product` 
        (`PId`, `PName`, `PImg`, `PPrice`, `PQty`, `PDesciption`, `PCategoryId`, `PInstrumentId`, `PCompanyId`) 
        VALUES (?, ?, ?, ?, ?, ?, 'I', ?, ?) ";

if( $_FILES["PImg"]["error"] === 0 ) {
    //為上傳檔案命名
    $PImg = date("YmdHis");
    
    //找出副檔名
    $extension = pathinfo($_FILES["PImg"]["name"], PATHINFO_EXTENSION);

    //建立完整名稱
    $imgFileName = "Product_".$PImg.".".$extension;
    
    //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
    if( !move_uploaded_file($_FILES["PImg"]["tmp_name"], "./files/".$imgFileName) ) {
        header("Refresh: 3; url=./Instrument_index.php");
        echo "圖片上傳失敗";
        exit();
    }


}

//繫結用陣列
$arrParam = [
    $_POST['PId'],
    $_POST['PName'],
    $imgFileName,
    $_POST['PPrice'],
    (int)$_POST['PQty'],
    $_POST['PDesciption'],
    $_POST['PInstrumentId'],
    $_POST['PCompanyId']
];

$pdo_stmt = $pdo->prepare($sql);
$pdo_stmt->execute($arrParam);
if($pdo_stmt->rowCount() === 1) {
    header("Refresh: 3; url=./Instrument_index.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./Instrument_index.php");
    echo "新增失敗";
}