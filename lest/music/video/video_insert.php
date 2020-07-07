<?php
header("Content-Type: text/html; chartset=utf-8");
require_once('../../checkSession.php');//引入判斷是否登入機制
require_once('../../db.inc.php');      //引用資料庫連線 
//SQL 敘述
$sql = "INSERT INTO `product` 
        (`PImg`, `PVideo` , `PId`,`PName`, `PPrice`, `PQty`, `PTime`, `PDesciption`, `PCategoryId`,`PInstrumentId`, `PCompanyId`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'V', ?, ?)";

if( $_FILES["PImg"]["error"] === 0 ) {
    //為上傳檔案命名
    $strDatetime = date("YmdHis");
    
    //找出副檔名
    $extension = pathinfo($_FILES["PImg"]["name"], PATHINFO_EXTENSION);

    //建立完整名稱
    $PImg = "Product_".$strDatetime.".".$extension;

    //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
    if( !move_uploaded_file($_FILES["PImg"]["tmp_name"], "./files/".$PImg) ) {
        header("Refresh: 3; url=./course_new.php");
        echo "圖片上傳失敗";
        exit();
    }
}

if( $_FILES["PVideo"]["error"] === 0 ) {
    //為上傳檔案命名
    $strDatetime = date("YmdHis");
    
    //找出副檔名
    $extension = pathinfo($_FILES["PVideo"]["name"], PATHINFO_EXTENSION);

    //建立完整名稱
    $PVideo = "Product_".$strDatetime.".".$extension;

    //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
    if( !move_uploaded_file($_FILES["PVideo"]["tmp_name"], "./files/".$PVideo) ) {
        header("Refresh: 3; url=./vdeio_new.php");
        echo "影片上傳失敗";
        exit();
    }
}

//繫結用陣列
$arr = [
    $PImg,
    $PVideo,
    $_POST['PId'],
    $_POST['PName'],
    $_POST['PPrice'],
    $_POST['PQty'],
    $_POST['PTime'],
    $_POST['PDesciption'],
    $_POST['PInstrumentId'],
    $_POST['PCompanyId']
];

$pdo_stmt = $pdo->prepare($sql);
$pdo_stmt->execute($arr);
if($pdo_stmt->rowCount() === 1) {
    header("Refresh: 3; url=./video_index.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./video_new.php");
    echo "新增失敗";
    
}