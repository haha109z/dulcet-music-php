<?php
// session_start();
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
        
        
        .sub{
            width:200px;
            height:50px;
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
<?php //require_once('./title_2.php'); ?>

    
<form name="myform" method="post" action="./adddetail.php">

<table  class="table1">
<tbody>

<tr><td class="border">訂單編號 : <input name="orderid" type="text" required="required" value="<?php echo $_GET['detailId'] ?>" readonly="readonly"><br>
</td></tr>
<tr><td class="border">商品編號 : <input name="PId" type="text" required="required"><br>
</td></tr>
<tr><td class="border">商品名稱 : <input name="PName" size="35" type="text" required="required"><br>
</td></tr>
<tr><td class="border">商品數量 : <input name="quantity" type="text" required="required"><br>
</td></tr>
<tr><td class="border">商品類別 : <select name="category" type="text" required="required">
            <option value="樂器">樂器</option>
            <option value="影片">影片</option>
            <option value="課程">課程</option>
        </select>
      </td>
    </tr>
<tr>
  <td class="border">廠商編號 : <input name="companyId" type="text"><br>
</td>
</tr>
<tr>
  <td class="border">商品價格 : <input name="money" type="text" required="required"><br>
</td>
</tr>
<tr>
  <td class="border1" colspan="7">
  <input  class="inp-addbtn" type="submit" onclick="check()" value="新增">
  <a class="inp-addbtn" href="./admin.php">返回訂單首頁</a> 
</td>
</tr>
<!-- 明細編號 : <input class="inp" name="stateid" type="text" required="required"><br> -->

</tbody>
</table>
</form>
<script>
    function check() {
        if(myform.orderid.value == false  || myform.PId.value == false  || myform.PName.value == false  
        || myform.quantity.value == false  || myform.category.value == false  || myform.money.value == false ) 
                {
                        alert("表單不可為空白");
                        event.preventDefault();
                }
    }
</script>
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
