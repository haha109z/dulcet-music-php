<?php

require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 
?>
<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
    <style>
    
    
    </style>
  <link rel="stylesheet"  type="text/css" href="../css/css-ALL.css">
    </head>
    <body>
    
    <!-- title -->
    <header class="header">
                 <!-- Logo -->
                 <figure>
            <img src="../css/logo_rectangle.svg" title="Logo"  style="height:100px;">
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
<form name="myForm" method="POST" action="updateEdit.php" enctype="multipart/form-data">
    <table class="table1">
        <tbody>
        <?php
        //SQL 敘述
        $sql = "SELECT `userID`, `username`, `userGender`, `userMail`, `userPhone`, 
        `userBirthday`, `userAddress`, `userImg`
                FROM `user`  
                WHERE `userID` = ?";


        //設定繫結值
        $arrParam = [$_GET['editId']];

        //查詢
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($arr) > 0) {
        ?>
            <tr>
                <td class="border">會員ID</td>
                <td class="border">
                    <input type="text" name="userID" value="<?php echo $arr[0]['userID']; ?>" maxlength="9" disabled="disabled"  required/>
                </td>
            </tr>
            <tr>
                <td class="border">會員姓名</td>
                <td class="border">
                    <input type="text" name="username" value="<?php echo $arr[0]['username']; ?>" maxlength="10" required/>
                </td>
            </tr>
            <tr>
                <td class="border">會員性別</td>
                <td class="border">
                    <select name="userGender">
                        <option value="<?php echo $arr[0]['userGender']; ?>" selected><?php echo $arr[0]['userGender']; ?></option>
                        <option value="男">男</option>
                        <option value="女">女</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="border">會員信箱</td>
                <td class="border">
                    <input type=email name="userMail" value="<?php echo $arr[0]['userMail']; ?>" required />
                </td>
            </tr>
            <tr>
                <td class="border">會員生日</td>
                <td class="border">
                    <input type="date" name="userBirthday" value="<?php echo $arr[0]['userBirthday']; ?>" maxlength="20" required  />
                </td>
            </tr>
            <tr>
                <td class="border">會員手機</td>
                <td class="border">
                    <input type="text" name="userPhone" value="<?php echo $arr[0]['userPhone']; ?>" maxlength="10" pattern="[0]{1}[9]{1}[0-9]{8}" title="09########" required />
                </td>
            </tr>
            <tr>
                <td class="border">會員地址</td>
                <td class="border">
                <textarea name="userAddress"><?php echo $arr[0]['userAddress']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="border">會員照片</td>
                <td class="border">
                <?php if($arr[0]['userImg'] !== NULL) { ?>
                    <img class="w200px" src="./files/<?php echo $arr[0]['userImg']; ?>" />
                <?php } ?>
                <input type="file" name="userImg" />
               
                <a class="inp-addbtn" href="./delPhoto.php?userID=<?php echo $arr[0]['userID']; ?>">刪除照片</a>
                </td>
            </tr>
            

            <tr>
                <td class="border">功能</td>
                <td class="border">
                    <a class="inp-edit" href="./delete.php?deleteId=<?php echo $arr[0]['userID']; ?>"><i class="fas fa-trash"></i></a>
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
            <input type="submit" name="smb" class="inp-addbtn" value="送出">
            <a class="inp-addbtn" href="./admin.php">返回會員列表</a></td>
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