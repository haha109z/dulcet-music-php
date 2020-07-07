<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
    <style>
    
    </style>
<link rel="stylesheet"  type="text/css" href="../../css/css-ALL.css">
        </head>
        <body>
            <!-- title -->
            <header class="header">
                 <!-- Logo -->
                 <figure>
            <img src="../../css/logo_rectangle.svg" title="Logo"  style="height:100px">
        </figure>
        <a href="../../logout.php?logout=1" style="margin:20px">登出</a>    </header>
            <div class="wrap">
                 <!-- 左側功能列表 -->
                <div class="left-wrap">
                    <?php require_once("./list.php"); ?>
                </div>
                <!-- 右側廠商列表 -->
                <div class="right-wrap">
<form name="myForm" method="POST" action="./Instrument_insert.php" enctype="multipart/form-data">
<table class="table1">
    <tbody>
    <tr>
                <td class="border">商品圖片</td>
                <td class="border">
                <input type="file" name="PImg" required="required"/>
                </td>
            </tr>
            <tr>
                <td class="border">商品編號</td>
                <td class="border">
                    <input type="text" name="PId" value="" maxlength="9" required="required"/>
                </td>
            </tr>
            <tr>
                <td class="border">商品名稱</td>
                <td class="border">
                    <input type="text" name="PName" value="" maxlength="10" required="required"/>
                </td>
            </tr>
            <tr>
                <td class="border">商品價格</td>
                <td class="border">
                    <input type="text" name="PPrice" value="" maxlength="10" required="required"/>
                </td>
            </tr>
            <tr>
                <td class="border">商品數量</td>
                <td class="border">
                    <input type="text" name="PQty" value="" maxlength="10" required="required"/>
                </td>
            </tr>
            <tr>
                <td class="border">商品敘述</td>
                <td class="border" >
                    <textarea style="width:300px;height:100px;" name="PDesciption" required="required"></textarea>
                </td>
            </tr>
            <tr>
                <td class="border">樂器類別</td>
                <td class="border">
                    <select name="PInstrumentId" id="">
                        <option value="1" >鋼琴</option>
                        <option value="2" >電子琴</option>
                        <option value="3" >小提琴</option>
                        <option value="4" >中提琴</option>
                        <option value="5" >薩克斯風</option>
                        <option value="6" >長笛</option>
                        <option value="7" >烏克莉莉</option>
                        <option value="8" >爵士鼓</option>
                                        
                    </select>
                </td>
            </tr>
            <tr>
                <td class="border">上架廠商</td>
                <td class="border">
                    <input type="text" name="PCompanyId" value="" maxlength="10" required="required"/>
                </td>
            </tr>
    </tbody>
    <tfoot>
        <tr>
            <td class="border" colspan="6">
                <input  class="inp-addbtn" type="submit" name="smb"value="送出">
            <a class="inp-addbtn" href="Instrument_index.php">返回樂器列表</a>
        </td>
        </tr>
    </tfoot>
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