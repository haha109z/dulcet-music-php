<?php


require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

$sql = "SELECT * FROM `user` ORDER BY `user`.`userID` DESC LIMIT 1";
// 將語法連結至資料庫
$stmt = $pdo->query($sql);
$result = $stmt->fetch(PDO::FETCH_OBJ);
// 單抓出userID得值
$userID = $result->userID;
// 最後一筆user num
// 將抓出得值（字串）切割並轉成數值
$num = (int)str_replace('U',"",$userID);
// 取得新USERID 將抓出的數字+1並補0再加Ｕ最後放在變數中
$newUserID = 'U'.str_pad($num +1, 4, '0', STR_PAD_LEFT);


//SQL 敘述
$sql = "INSERT INTO `user`
        (`userID`, `username`, `userGender`, `userMail`, `userBirthday`, `userPhone`, `userAddress`, `userImg`) 
        VALUES (?, ?, ?, ?, ?, ?, ? , ? )";


if( $_FILES["userImg"]["error"] === 0 )  {
    //為上傳檔案命名
    $studentImg = date("YmdHis");
    
    //找出副檔名
    $extension = pathinfo($_FILES["userImg"]["name"], PATHINFO_EXTENSION);

    //建立完整名稱
    $imgFileName = $studentImg.".".$extension;

    //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
    if( !move_uploaded_file($_FILES["userImg"]["tmp_name"], "./files/".$imgFileName) ) {
        header("Refresh: 3; url=./admin.php");
        echo "圖片上傳失敗";
        exit();
    }
}

//繫結用陣列
$arr = [
    $newUserID ,
    $_POST['username'],
    $_POST['userGender'],
    $_POST['userMail'],
    $_POST['userBirthday'],
    $_POST['userPhone'],
    $_POST['userAddress'],
    $imgFileName
];

$pdo_stmt = $pdo->prepare($sql);
$pdo_stmt->execute($arr);
// print_r($arr );
// echo "<br>";
// print_r($pdo_stmt );
// echo "<br>";
// print_r($pdo_stmt->execute($arr));
// exit;

if($pdo_stmt->rowCount() === 1){
    header("Refresh: 3; url=./admin.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "新增失敗";
}