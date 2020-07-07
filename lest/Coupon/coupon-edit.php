<?php
//引入判斷是否登入機制
require_once('../checkSession.php');
// require_once('./templates/aaa.html');
//引用資料庫連線
// require_once('./coupon-admin.php');
require_once('../db.inc.php');
?>
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
<?php 
 
//require_once('./templates/title.php'); ?>

<form name="myForm" method="POST" action="coupon-updateEdit.php" enctype="multipart/form-data">
    <table class="table1">
        <tbody>
        <?php
        //SQL 敘述
        $sql = "SELECT `id`,`user_id`,`number`,`content`,`price`,`password`,`alidityv`,`use_date`,`status`
                FROM `Coupon`
                WHERE `id` = ?";

        //設定繫結值
        $arrParam = [(int)$_GET['editId']];

        //查詢
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        
        if(count($arr) > 0) {
        ?>
       
            <!-- <tr>
                <td class="border">流水號</td>
                <td class="border">
                    <input type="text" name="id" value="<?php echo $arr['id']; ?>" maxlength="10" readonly />
                </td>
            </tr> -->
            <tr>
                <td class="border">優惠卷編碼</td>
                <td class="border">
                    <input type="text" name="user_id" value="<?php echo $arr['user_id']; ?>" maxlength="10" readonly/>
                </td>
            </tr>
            <tr>
                <td class="border">優惠卷號碼</td>
                <td class="border">
                <input type="text" name="number" value="<?php echo $arr['number']; ?>" maxlength="10" />  
                </td>
            </tr>
            <tr>
                <td class="border">優惠卷內容</td>
                <td class="border">
                    <input type="text" name="content" value="<?php echo $arr['content']; ?>" maxlength="10" />
                </td>
            </tr>
            <tr>
                <td class="border">金額</td>
                <td class="border">
                    <input type="text" name="price" value="<?php echo $arr['price']; ?>" maxlength="10" />
                </td>
                <tr>
                <td class="border">優惠卷密碼</td>
                <td class="border">
                    <input type="text" name="password"" value="<?php echo $arr['password']; ?>" maxlength="10" />
                </td>
            </tr>
            <tr>
                <td class="border">使用時間</td>
                <td class="border">
                <input type="text" name="alidityv" value="<?php echo $arr['alidityv']; ?>" maxlength="10" />
                </td>
            </tr>
            <tr>
                <td class="border">到期時間</td>
                <td class="border">
                <input type="text" name="use_date" value="<?php echo $arr['use_date']; ?>" maxlength="10" />
                </td>
            </tr>
            <tr>
                <td class="border"> -1 過期 0 未使用 1 已使用</td>
                <td class="border">
                <input type="text" name="status" value="<?php echo $arr['status']; ?>" maxlength="10" />
                </td>
            </tr>
            <tr>
                <td class="border">刪除這筆優惠卷</td>
                <td class="border">
                    <a class="inp-delete" href="./coupon-delete.php?deleteId=<?php echo $arr['id']; ?>"><i class="fas fa-trash"></i></a>
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
                <input class="inp-addbtn" type="submit" name="smb" value="修改"> 
                <a class="inp-addbtn" href="./coupon-admin.php" >回優惠列表</a> 
        </td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="editId" value="<?php echo (int)$_GET['editId']; ?>">
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