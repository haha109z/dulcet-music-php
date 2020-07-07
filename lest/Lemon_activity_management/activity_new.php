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
<?php //require_once('./title.php'); ?>


<form name="myForm" method="POST" action="./activity_insert.php" enctype="multipart/form-data">
<table class="table1">
<tbody>
    
        <tr>
            <th class="border">活動編號</th> 
            <td class="border">
                <input type="text" name="activityId" id="activityId" value="" maxlength="5" required="required"/>
            </td>
          </tr>
          <tr>
            <th class="border">活動類別</th>
            <td class="border">
                <input type="text" name="activityCategory" id="activityCategory" value="" maxlength="5" required="required"/>
            </td>
            </tr>
          <tr>
            <th class="border">活動名稱</th> 
            <td class="border">
                <input type="text" name="activityName" id="activityName" value="" maxlength="15" required="required"/>   
            </td>
            </tr>
          <tr>
            <th class="border">活動內容</th>
            <td class="border">
            <textarea name="activityContent" style="width:300px;height:100px;"><?php //echo $arr[0]['activityContent']; ?></textarea>
            </td>
            </tr>
          <tr>
            <th class="border">活動開始時間</th>
            <td class="border">
                <input type="text" name="activityStartTime" id="activityStartTime" value=""  required="required" />
            </td>
            </tr>
          <tr>
            <th class="border">活動結束時間</th>
            <td class="border">
                <input type="text" name="activityEndTime" id="activityEndTime" value=""  required="required" />
            </td>
          </tr>
          <tr>
            <th class="border">活動地點</th>
          <td class="border">
                <input type="text" name="activityLocation" id="activityLocation" value="" maxlength="50" required="required"/>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td class="border" colspan="7">
              <input class="inp-addbtn" type="submit" name="smb" value="新增" onclick="newActivity()">
              <a class="inp-addbtn" href="./admin.php">返回活動列表</a>
            </td>
        </tr>
    </tfoot>
</table>
</form>
<script>

function newActivity() {
    if (myForm.activityId.value == 0 || myForm.activityCategory.value == 0 || myForm.activityName.value == 0 || myForm.activityContent.value == 0 || myForm.activityStartTime.value == 0 || myForm.activityEndTime.value == 0 || myForm.activityLocation.value == 0) {
        alert("表單欄位請勿空白");
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