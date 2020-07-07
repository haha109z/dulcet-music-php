<?php
require_once('../../checkSession.php');//引入判斷是否登入機制
require_once('../../db.inc.php');      //引用資料庫連線 
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
        <a href="../../logout.php?logout=1" style="margin:20px">登出</a>  
            </header>
    <div class="wrap">
         <!-- 左側功能列表 -->
        <div class="left-wrap">
            <?php require_once("./list.php"); ?>
        </div>
  
        <!-- 右側廠商列表 -->
        <div class="right-wrap">


<form name="myForm" method="POST" action="video_updateEdit.php" enctype="multipart/form-data">
    <table class="table1">
        <tbody>
        <?php

        $sql = "SELECT `PId`,`PImg`,`PVideo`, `PName`, `PPrice`, `PQty`, `PTime`, 
                `PDesciption`,`PCompanyId`,
                `musical_category`.`CategoryId` AS 'PInstrumentId',  `musical_category`.`CategoryName` AS 'PInstrumentName',
                `product_category`.`CategoryId` AS 'PCategoryId' , `product_category`.`CategoryName` AS 'PCategoryName'
                FROM `product` INNER JOIN `musical_category` INNER JOIN `product_category`
                ON `product`.`PInstrumentId` = `musical_category`.`CategoryId` AND `product`.`PCategoryId` = `product_category`.`CategoryId`

                WHERE `PId` =?";

                

        //設定繫結值
        $arrParam = [$_GET['editId']];

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
                <?php echo "<br/>" ?>
                <input type="file" name="PImg" />
                </td>
            </tr>
            
            <tr>
                <td class="border">影片預覽</td>
                <td class="border">
                <?php if($arr[0]['PVideo'] !== NULL) { ?>
                    <video controls>
                    <source src="./files/<?php echo $arr[0]['PVideo']; ?>"/>
                    </video>
                <?php } ?>
                <?php echo "<br/>" ?>
                <input type="file" name="PVideo" />
                </td>
            </tr>

            <tr>
                <td class="border">影片編號</td>
                <td class="border">
                    <input type="text" name="PId" value="<?php echo $arr[0]['PId']; ?>" maxlength="9" disabled />
                </td>
            </tr>
            <tr>
                <td class="border">影片名稱</td>
                <td class="border">
                    <input type="text" name="PName" size="35" value="<?php echo $arr[0]['PName']; ?>" maxlength="10" />
                </td>
            </tr>
            <tr>
                <td class="border">影片價格</td>
                <td class="border">
                    <input type="text" name="PPrice" value="<?php echo $arr[0]['PPrice']; ?>" maxlength="10" />
                </td>
            </tr>
            <tr>
                <td class="border">數量</td>
                <td class="border">
                    <input type="text" name="PQty" value="<?php echo $arr[0]['PQty']; ?>" maxlength="10" />
                </td>
            </tr>
            <tr>
                <td class="border">影片時數</td>
                <td class="border">
                    <input type="text" name="PTime" value="<?php echo $arr[0]['PTime']; ?>" maxlength="10" />
                </td>
            </tr>
            <tr>
                <td class="border">影片描述</td>
                <td class="border">
                    <textarea name="PDesciption"><?php echo $arr[0]['PDesciption']; ?></textarea>
                </td>
            </tr>

            <tr>
                <td class="border">樂器類別</td>
                <td class="border">

                <select name="PInstrumentId" id="">
                    <option value="1" <?php if($arr[0]['PInstrumentName'] == '鋼琴'){echo 'selected';}?>>鋼琴</option>
                    <option value="2" <?php if($arr[0]['PInstrumentName'] == '電子琴'){echo 'selected';}?>>電子琴</option>
                    <option value="3" <?php if($arr[0]['PInstrumentName'] == '小提琴'){echo 'selected';}?>>小提琴</option>
                    <option value="4" <?php if($arr[0]['PInstrumentName'] == '中提琴'){echo 'selected';}?>>中提琴</option>
                    <option value="5" <?php if($arr[0]['PInstrumentName'] == '薩克斯風'){echo 'selected';}?>>薩克斯風</option>
                    <option value="6" <?php if($arr[0]['PInstrumentName'] == '長笛'){echo 'selected';}?>>長笛</option>
                    <option value="7" <?php if($arr[0]['PInstrumentName'] == '烏克莉莉'){echo 'selected';}?>>烏克莉莉</option>
                    <option value="8" <?php if($arr[0]['PInstrumentName'] == '爵士鼓'){echo 'selected';}?>>爵士鼓</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td class="border">上架廠商</td>
                <td class="border">
                    <input type="text" name="PCompanyId" value="<?php echo $arr[0]['PCompanyId']; ?>" maxlength="10" />
                </td>
            </tr>

            <tr>
                <td class="border">功能</td>
                <td class="border">
                    <a class="inp-edit" href="./video_delete.php?deleteId=<?php echo $arr[0]['PId']; ?>"><i class="fas fa-trash"></i></a>
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
                <input  class="inp-addbtn" type="submit" name="smb" value="送出">
            <a class="inp-addbtn" href="./video_index.php">回影片列表</a>
        </td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="editId" value="<?php echo $_GET['editId']; ?>">
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