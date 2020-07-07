<?php
//啟動 session
session_start();

header("Content-Type: text/html; chartset=utf-8");

//引用資料庫連線
require_once('./db.inc.php');


if( isset($_POST['username']) && isset($_POST['pwd']) ){
    //SQL 語法
    $sql = "SELECT `username`, `pwd` ";
    $sql.= "FROM `admin` ";
    $sql.= "WHERE `username` = ? ";
    $sql.= "AND `pwd` = ? ";

    $arrParam = [
        $_POST['username'],
        sha1($_POST['pwd'])
    ];

    $pdo_stmt = $pdo->prepare($sql);
    $pdo_stmt->execute($arrParam);

    if( $pdo_stmt->rowCount() > 0 ){        
        echo "<script>alert('登入成功');</script>";

        //3 秒後跳頁
        header("Refresh: 0; url=./user/admin.php");
        
        //將傳送過來的 post 變數資料，放到 session，
        $_SESSION['username'] = $_POST['username'];

    } else {
        echo "<script>alert('登入失敗…3秒後自動回登入頁');</script>";
        header("Refresh: 0; url=./index.php");
    }
} else {
    echo "<script>alert('請確實登入…3秒後自動回登入頁');</script>";
    header("Refresh: 3; url=./index.php");
    // echo "請確實登入…3秒後自動回登入頁";
}
?>
<head>
<meta charset="UTF-8">
<title>Dulcet Music</title>
</head>