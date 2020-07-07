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
    /* .border {
        border: 1px solid;
    } */
    .w200px {
        width: 200px;
    }
    </style>
<link rel="stylesheet"  type="text/css" href="../css/css-ALL.css">
    </style>
</head>
<body>
    <!-- header -->
    <header class="header">
        <!-- Logo -->
        <figure>
            <img src="../css/logo_rectangle.svg" title="Logo"  style="height:100px">
        </figure>
        <!-- *** Lemon刪除 -->
        <!-- <p>Music Classroom</p> -->
        <a href="../logout.php?logout=1" style="margin:20px">登出</a>  
    </header>
            <div class="wrap">
                 <!-- 左側功能列表 -->
                <div class="left-wrap">
                    <?php require_once("./list.php"); ?>
                </div>
                <!-- 右側廠商列表 -->
                <div class="right-wrap">
<!-- 資料表表格 -->
<form name="myForm" method="POST" action="activity_updateEdit.php" enctype="multipart/form-data">
    <table class="table1">
        <tbody>
        <?php
        //SQL 敘述
        $sql = "SELECT `activityId`, `activityCategory`, `activityName`, `activityContent`, `activityStartTime`, 
                        `activityEndTime`, `activityLocation`
                FROM `activity_management` 
                WHERE `activityId` = ?";

        //設定繫結值
        $arrParam = [$_GET['editId']];

        //查詢
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);

        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

       
        if(count($arr) > 0) {
        ?>
            <tr>
                <td class="border">活動編號</td>
                <td class="border">
                    <input type="text" name="activityId" value="<?php echo $arr[0]['activityId']; ?>" readonly/>
                </td>
            </tr>
            <tr>
                <td class="border">活動類別</td>
                <td class="border">
                    <input type="text" name="activityCategory" value="<?php echo $arr[0]['activityCategory']; ?>"  />
                </td>
            </tr>
            <tr>
                <td class="border">活動名稱</td>
                <td class="border">
                    <input type="text" size="30" name="activityName" value="<?php echo $arr[0]['activityName']; ?>"  />
                </td>
            </tr>
            <tr>
                <td class="border">活動內容</td>
                <td class="border">
                    <textarea name="activityContent" style="width:300px;height:100px;"><?php echo $arr[0]['activityContent']; ?></textarea>
                    <!-- <textarea name="activityContent"  required="required"></textarea> -->

                </td>
            </tr>
            <tr>
                <td class="border">活動開始時間</td>
                <td class="border">
                    <input type="text" name="activityStartTime" value="<?php echo $arr[0]['activityStartTime']; ?>"  />
                </td>
            </tr>
            <tr>
                <td class="border">活動結束時間</td>
                <td class="border">
                    <input type="text" name="activityEndTime" value="<?php echo $arr[0]['activityEndTime']; ?>"  />
                </td>
            </tr>
            <tr>
                <td class="border">活動地點</td>
                <td class="border">
                    <input type="text" size="30"name="activityLocation" value="<?php echo $arr[0]['activityLocation']; ?>" />
                </td>
            </tr>
            <!-- <tr>
                <td class="border">大頭貼</td>
                <td class="border">
                <?php // if($arr[0]['studentImg'] !== NULL) { ?>
                    <img class="w200px" src="./files/<?php // echo $arr[0]['studentImg']; ?>" />
                <?php // } ?>
                <input type="file" name="studentImg" />
                </td>
            </tr> -->
            <tr>
                <td class="border">功能</td>
                <td class="border">
                    <a  class="inp-delete" href="./activity_delete.php?deleteId=<?php echo $arr[0]['activityId']; ?>"><i class="fas fa-trash"></i></a>
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
                <input class="inp-addbtn" type="submit" name="smb" value="送出">
                <a class="inp-addbtn" href="./admin.php">返回活動列表</a>
            </td>
            </tr>
        </tfoot>
    </table>
    <!-- 把修改的資料藏入hidden元素(運用POST方法)傳回 -->
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