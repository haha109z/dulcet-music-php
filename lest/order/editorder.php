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

    $sql = "SELECT `orderid`,`userID`,`name`,`pay`,
    `logistics`,`status`,`cashflow`
    FROM `ordertable`
    WHERE `orderid` = ?";
    
    $arrParam = [$_GET['editorderId']];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($arr) > 0) {
    ?>


  <form name="myform" method="post" action="./updateorder.php?editorderId=<?php echo $_GET['editorderId']; ?>" enctype="multipart/form-data">
  
   <table  class="table1"> 
      <tbody>

      <tr>
        <td class="border"> 訂單編號 : <?php echo $arr[0]['orderid']; ?><br></td>
      </tr>
        <tr>
        <td class="border">會員編號 : <input class="inp" name="userID" type="text" value="<?php echo $arr[0]['userID']; ?>"><br></td>
      </tr>
      <tr>
        <td class="border">會員姓名 : <input class="inp" name="name" type="text" value="<?php echo $arr[0]['name']; ?>"><br></td>
      </tr>
      <tr>
        <td class="border">付款方式 : <select class="inp" name="pay" type="text" value="<?php echo $arr[0]['pay']; ?>">
          <option value="ATM">ATM</option>
          <option value="Card">Card</option>
          <option value="Store">Store</option>
          </select><br>
        </td>
      </tr>
      <tr>
        <td class="border">物流狀態 : <select class="inp" name="logistics" type="text" value="<?php echo $arr[0]['logistics']; ?>">
          <option value="出貨完成">出貨完成</option>
          <option value="出貨中">出貨中</option>
          <option value="尚未出貨">尚未出貨</option>
          <option value="無">無</option>
          </select><br>
        </td>
      </tr>
      <tr>
        <td class="border">   訂單狀態 : <select class="inp" name="status" type="text" value="<?php echo $arr[0]['status']; ?>">
          <option value="已成立">已成立</option>
          <option value="已取消">已取消</option>
          <option value="已退貨">已退貨</option>
          </select><br>
        </td>
      </tr>
        <td class="border">金流狀態 : <select class="inp" name="cashflow" type="text" value="<?php echo $arr[0]['cashflow']; ?>">
          <option value="已付款">已付款</option>
          <option value="未付款">未付款</option>
          </select><br>
        </td>
        <tr>
          <td class="border" colspan="6">
            <input class="inp-addbtn" type="submit" name="smb" value="送出">
        <a class="inp-addbtn" href="./admin.php">返回訂單首頁</a>
      </td>
    </tr>
        
      </tbody>
    </table>
    <?php
    }else{
        echo "沒有資料";
    }
    ?>
    
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