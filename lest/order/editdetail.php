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
<?php //require_once('./title.php'); ?>


    <?php

    $sql = "SELECT `stateid`,`orderid`,`PId`,`PName`,`quantity`
    ,`category`,`companyId`,`money`
    FROM `state`
    WHERE `stateid` = ?";
    
    $arrParam = [$_GET['editdetailId']];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($arr) > 0) {
    ?>
    
 
    <form class="admin-form" name="myform" method="POST" action="./updatedetail.php?editdetailId=<?php echo $_GET['editdetailId']; ?>" enctype="multipart/form-data">
    
   <table class="table1">
    <tbody>
  
    <tr>
      <td class="border">明細編號 : <?php echo $arr[0]['stateid']; ?><br></td></tr>
    <tr>
      <td class="border">訂單編號 : <input  name="orderid" type="text" value="<?php echo $arr[0]['orderid']; ?>" readonly="readonly"><br>    </td></tr>
    <tr>
      <td class="border">商品編號 : <input name="PId" type="text" value="<?php echo $arr[0]['PId']; ?>"><br>
</td></tr>
    <tr>
      <td class="border">商品名稱 : <input size="35" name="PName" type="text" value="<?php echo $arr[0]['PName']; ?>"><br>
</td></tr>
    <tr>
      <td class="border">商品數量 : <input name="quantity" type="text" value="<?php echo $arr[0]['quantity']; ?>"><br>
</td></tr>
    <tr>
      <td class="border">商品類別 : <select name="category" type="text" value="<?php echo $arr[0]['category']; ?>">
                <option value="樂器">樂器</option>
                <option value="影片">影片</option>
                <option value="課程">課程</option>
                </select><br></td></tr>
    <tr>
      <td class="border">    廠商編號 : <input class="inp" name="companyId" type="text" value="<?php echo $arr[0]['companyId']; ?>"><br>
</td></tr>
    <tr>
      <td class="border">    商品價格 : <input class="inp" name="money" type="text" value="<?php echo $arr[0]['money']; ?>"><br>
</td></tr>
  <tr>
    <td class="border" colspan="6">
      <input  class="inp-addbtn" type="submit" name="smb" value="修改">
  <a  class="inp-addbtn" href="./admin.php">返回訂單首頁</a> 
</td>
</tr>
    
    <?php
    }else{
        echo "沒有資料";
    }
    ?></tbody>  
</table>
   </form>
    

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