<?php


//引用資料庫連線
require_once('../../db.inc.php');
?>
<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
    <style>
   
    .w200px {
        width: 200px;
    }
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

<form class="admin-form" name="myForm" method="POST" action="" enctype="multipart/form-data" class="title-form">
    <table class="table1">
        <tbody>
        <?php
        //SQL 敘述
        $sql = "SELECT `PImg`, `PId`, `PName`, `PPrice`, `PQty`, 
                        `product_category`.`CategoryName` AS 'PCategoryId', `musical_category`.`CategoryName` AS 'PInstrumentId', `PCompanyId`, `product_category`.`CategoryId` AS 'CatId', `PDesciption`
                FROM `product` INNER JOIN `product_category` INNER JOIN `musical_category`
                ON `product`.`PCategoryId`=`product_category`.`CategoryId` AND `product`.`PInstrumentId`=`musical_category`.`CategoryId`
                WHERE `PId` = ?";

        //設定繫結值
        $arrParam = [$_GET['viewId']];

        //查詢
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($arr) > 0) {
        ?>
            <tr>
                <td class="border">商品圖片</td>
                <td class="border">
                <?php if($arr[0]['PImg'] !== NULL) { ?>
                    <img class="w500px" src="./files/<?php echo $arr[0]['PImg']; ?>" />
                <?php } ?>
                <!-- <input type="file" name="PImg" /> -->
                </td>
            </tr>
            <tr>
                <td class="border">商品編號</td>
                <td class="border">
                    <?php echo $arr[0]['PId']; ?>
                </td>
            </tr>
            <tr>
                <td class="border">商品名稱</td>
                <td class="border">
                    <?php echo $arr[0]['PName']; ?>
                </td>
            </tr>
            <tr>
                <td class="border">商品價格</td>
                <td class="border">
                    <?php echo $arr[0]['PPrice']; ?>
                </td>
            </tr>
            <tr>
                <td class="border">商品數量</td>
                <td class="border">
                    <?php echo $arr[0]['PQty']; ?>
                </td>
            </tr>
            <tr>
                <td class="border">商品敘述</td>
                <td class="border">
                    <?php echo $arr[0]['PDesciption']; ?>
                </td>
            </tr>
            <tr>
                <td class="border">商品類別</td>
                <td class="border">
                    <?php echo $arr[0]['PCategoryId']; ?>
                </td>
            </tr>
            <tr>
                <td class="border">樂器類別</td>
                <td class="border">
                    <?php echo $arr[0]['PInstrumentId']; ?>
                </td>
            </tr>
            <tr>
                <td class="border">上架廠商</td>
                <td class="border">
                    <?php echo $arr[0]['PCompanyId']; ?>
                </td>
            </tr>
            <tr>
                <td class="border">功能</td>
                <td class="border">
                    <a class="inp-delete" href="./Instrument_edit.php?editId=<?php echo $arr[0]['PId']; ?>"><i class="fas fa-edit"></i></a>
                    <a class="inp-delete" href="./Instrument_delete.php?deleteId=<?php echo $arr[0]['PId']; ?>"><i class="fas fa-trash"></i></a>
                    
                </td>
            </tr>
        <?php
        } else {
        ?>
            <tr>
                <td class="border" colspan="6">沒有資料</td>
            </tr>
        <?php
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <td class="border" colspan="6">
                <a class="inp-addbtn" href="Instrument_index.php">回樂器列表</a>
            </td>
        </tr>
    </tfoot>
    </table>
</form>

</div>
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