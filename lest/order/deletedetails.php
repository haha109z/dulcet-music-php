<?php
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

$sqlstate = "DELETE FROM `state`
WHERE `stateid` = ?";

$count = 0;

if(!isset($_POST['chk'])){
    echo "<script>alert('請勾選欲刪除內容')</script>";
    header("refresh: 0; url=./detail.php");
}else{

for($i = 0; $i < count($_POST['chk']); $i++){
$arrParam = [
    $_POST['chk'][$i]
];

$stmtstate = $pdo->prepare($sqlstate);
$stmtstate->execute($arrParam);
$count += $stmtstate->rowCount();
}


if($count > 0) {
echo "<script>alert('刪除成功');</script>";
header("Refresh: 0; url=./admin.php");
// echo "刪除成功";

} else {
header("Refresh: 3; url=./admin.php");
echo "刪除失敗";
}
}