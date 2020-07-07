<?php

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dulcet Music</title>
    <style>
    /* .border {
        border: 1px solid;
    } */
    .w200px {
        width: 200px;
    }
    </style>
<link rel="stylesheet"  type="text/css" href="../css/css-ALL.css">
        </head>
        <body>
            <!-- title -->
            <header class="header">
                         <!-- Logo -->
        <figure>
            <img src="../css/logo_rectangle.svg" title="Logo"  style="height:100px">
        </figure>
        <a href="../logout.php?logout=1" style="margin:20px">登出</a>  
            </header>
            <div class="wrap">
                 <!-- 左側功能列表 -->
                <div class="left-wrap">
                    <?php require_once("./list.php"); ?>
                </div>
                <!-- 右側廠商列表 -->
                <div class="right-wrap">
                



<form class="title-form" name="myform" method="post" action="./deletedetails.php">

<a class="inp-addbtn"href="./insertdetail.php?detailId=<?php echo $_GET['detailId'] ?>">新增明細列表</a>

  </form>
  <form class="admin-form" name="myform" method="post" action="./deletedetails.php">
<table class="table">
        <thead>
            <tr>
                <th class="border">選擇</th>
                <th class="border">明細編號</th>
                <th class="border">訂單編號</th>
                <th class="border">商品編號</th>
                <th class="border">商品名稱</th>
                <th class="border">商品數量</th>
                <th class="border">商品類別</th>
                <th class="border">廠商編號</th>
                <th class="border">商品價格</th>
                <th class="border">功能</th>
            </tr>
        </thead>
        <tbody>
<?php
$sql = "SELECT `stateid`,`orderid`,`PId`,`PName`,`quantity`
        ,`category`,`companyId`,`money`
        FROM `state`
        WHERE `orderid` = ?
        ORDER BY `stateid` ASC";

$arrParam = [
    @$_GET['detailId']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

$total = 0;

if($stmt->rowCount() > 0) {
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0; $i < count($arr); $i++) {
        $total += (int)$arr[$i]['money'] * $arr[$i]['quantity'];
?>
<tr>
<td class="border check">
    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['stateid']; ?>" />
</td>
<td class="border check"><?php echo $arr[$i]['stateid']; ?></td>
<td class="border check"><?php echo $arr[$i]['orderid']; ?></td>
<td class="border check"><?php echo $arr[$i]['PId']; ?></td>
<td class="border check"><?php echo $arr[$i]['PName']; ?></td>
<td class="border check"><?php echo $arr[$i]['quantity']; ?></td>
<td class="border check"><?php echo $arr[$i]['category']; ?></td>
<td class="border check"><?php echo $arr[$i]['companyId']; ?></td>
<td class="border check"><?php echo $arr[$i]['money']; ?></td>
<td class="border">
    <a style="padding-left:50px" class="inp-edit" href="./editdetail.php?editdetailId=<?php echo $arr[$i]['stateid']; ?>"><i class="fas fa-edit"></i></a>
</td>

<?php } ?>
</tr>
<?php
} else {
?>
    <tr>
        <td class="border" colspan="10">沒有資料</td>
    </tr>
<?php
}
?>

</tbody>
<tfoot>
  <tr>
    <td>
    <input class="inp-delete inp-delete2" type="submit" name="smb" value="刪除"></td>


</td>
<td class="text-align-center" colspan="8">
<h3>總共金額 : <?php echo $total ?> 元</h3></td>
<td><a class="inp-addbtn"href="./admin.php">返回訂單首頁</a> </td>
</tr>
</tfoot>
</table>

</form>
<script src="https://kit.fontawesome.com/39e79750f1.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
$(document).ready(function(){
  $(".btn1").click(function(){
    $(".p1").toggle(500);
  });
});
$(document).ready(function(){
  $(".btn2").click(function(){
    $(".p2").toggle(500);
  });
});
$(document).ready(function(){
  $(".btn3").click(function(){
    $(".p3").toggle(500);
  });
});
$(document).ready(function(){
  $(".btn4").click(function(){
    $(".p4").toggle(500);
  });
});
$(document).ready(function(){
  $(".btn5").click(function(){
    $(".p5").toggle(500);
  });
});
$(document).ready(function(){
  $(".btn6").click(function(){
    $(".p6").toggle(500);
  });
});
</script>
</body>
</html>
