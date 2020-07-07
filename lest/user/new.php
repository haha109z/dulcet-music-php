<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
    <style>
    /* .border {
        border: 1px solid;
    } */
    /* .w-100{
      
    } */
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
<?php //require_once('./templates/title.php'); ?>

<form class="admin-form" name="myForm" method="POST" action="./insert.php" enctype="multipart/form-data">
<table class="table1">
   <tbody> 
    <!-- $sql = "SELECT `userID`, `username`, `userGender`, `userMail`, `userPhone`, 
                        `userBirthday`, `userAddress`, `userImg`, `created_at`, `updated_at`
            FROM `user` 
            ".$sql_where."
            ORDER BY `userID` ASC 
            LIMIT ?, ? "; -->
        
           <tr>
           <th class="border">會員姓名  </th>
            <td class="border">
            <input type="text" name="username" id="username" value="" maxlength="10"  required />
            </td>
</tr>
         
<tr>
  <th class="border">會員性別  </th>
            <td class="border">
                <select name="userGender" id="userGender">
                    <option value="男" selected>男</option>
                    <option value="女">女</option>
                </select>
            </td>
</tr>
<tr>
  <th class="border">會員信箱  </th>
            <td class="border">
                <input type=email name="userMail" id="userMail" value="" maxlength="10" required />
            </td>
</tr>
<tr>
<th class="border">會員生日	 </th>
            <td class="border">
                <input type="date" name="userBirthday" id="userBirthday" value="" maxlength="10" required />
            </td>
          </tr>  
          <tr>
          <th class="border">會員手機	</th>
            <td class="border">
            <input type="text" name="userPhone" id="userPhone" value="" maxlength="10" pattern="[0]{1}[9]{1}[0-9]{8}" title="09########" required />
            </td>
</tr>
<tr>
<th class="border">會員地址	</th>
            <td class="border">
                <input type="text" name="userAddress" id="userAddress" value="" maxlength="50" />
            </td>
</tr>
<tr>
<th class="border">會員照片	</th>
            <td class="border">
                <input type="file" name="userImg" />
            </td>
            </tr>  
    </thead>
  </tbody>
  <tfoot>
        <tr>
            <td class="border" colspan="7">
              <input type="submit" name="smb" class="inp-addbtn" value="送出">
              <a  class="inp-addbtn" href="./admin.php">返回會員列表</a> 
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