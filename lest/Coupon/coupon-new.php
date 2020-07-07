<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
    <style>
    /* .border {
        border: 1px solid;
    } */
    </style>
<link rel="stylesheet" type="text/css" href="../css/css-ALL.css">     
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
<?php //require_once('./templates/coupon-title.php');?>

<form name="myForm" method="POST" action="./coupon-insert.php" enctype="multipart/form-data">
<table class="table1">
   <tbody>
   
        <tr>      
                <th class="border">使用者編號</th>
          <td class="border">
                <input type="text" name="user_id" id="user_id" value="" maxlength="10" />
            </td>
  </tr>
  <tr>
                <th class="border">優惠卷號碼</th>
                  <td class="border">
            <input type="text" name="number" id="number" value="" maxlength="10" />
            </td>
            </tr>
  <tr>
                <th class="border">優惠卷內容</th>
                   <td class="border">
                <input type="text" name="content" id="content" value="" maxlength="10" />
            </td>
            </tr>
  <tr>
                <th class="border">金額</th>
                <td class="border">
                <input type="text" name="price" id="price" value="" maxlength="10" />
            </td>
            </tr>
  <tr>
                <th class="border">優惠卷密碼</th>
                <td class="border">
                <input type="text" name="password" id="password" value="" maxlength="10" />
            </td>
            </tr>
          <tr>
              <th class="border">使用時間</th>
                <td class="border">
            <input type="text" name="use_date" id="use_date" value="" maxlength="10" />
            </td>
            </tr>
          <tr>
                <th class="border">到期時間</th>
                <td class="border">
            <input type="text" name="alidityv" id="alidityv" value="" maxlength="10" />
            </td>
          </tr>
          <tr>
            <th class="border">-1過期,0未使用,1使用過</th>
            <td class="border">
            <input type="text" name="status" id="status" value="" maxlength="10" />
            </td>
          </tr>
  
        
    
  </tbody>
    <tfoot>
        <tr>
            <td class="border" colspan="7">
              <input class="inp-addbtn"  type="submit" name="smb" value="送出">
            <a class="inp-addbtn" href="./coupon-admin.php" >回優惠列表</a> 
            </td>
        </tr>
    </tfoot>
</table>
</form>
</div>
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