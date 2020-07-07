<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
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

            <?php //require_once('./templates/company_title.php'); ?>
            <form name="myForm" method="POST" action="./company_insert.php" enctype="multipart/form-data">
            <table class="table1">
            <tbody>
             
                    <tr>
                        <th class="border">廠商編號</th>
                        <td class="border">
                            <input type="text" name="companyId" id="companyId" class="inp1" value="" maxlength="9" pattern="[A-Z]{1}[0-9]{3,4}" title="F###"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="border">廠商名稱</th>
                        <td class="border">
                            <input type="text" name="companyName" id="companyName" class="inp1" value="" maxlength="15"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="border">廠商電話</th>
                        <td class="border">
                            <input type="text" name="companyPhone" id="companyPhone" class="inp1" value="" maxlength="15" />
                        </td>
                    </tr>
                    <tr>
                        <th class="border">負責人</th>
                        <td class="border">
                            <input type="text" name="principal" id="principal" class="inp1" value="" maxlength="10" />
                        </td>
                    </tr>
                    <tr>
                        <th class="border">負責人電話</th>
                        <td class="border">
                            <input type="text" name="principalPhone" id="principal" class="inp1" value="" maxlength="15" />
                        </td>
                    </tr>
                    <tr>
                        <th class="border">信箱</th>
                        <td class="border">
                            <input type="email" name="email" id="email" class="inp1" value="" maxlength="40" />
                        </td>
                    </tr>   
                    <tr> 
                        <th class="border">地址</th>
                        <td class="border">
                            <input type="text" name="companyAddress" id="companyAddress" class="inp1" value="" maxlength="50" />
                        </td>
                    </tr>
                                 
                </tbody>
                <tfoot>
                    <tr>
                        <td class="border" colspan="7">
                          <input class="inp-addbtn" type="submit" name="smb" value="送出">
                        <a class="inp-addbtn" href="./company_admin.php">返回廠商列表</a>
                      </td>
                    </tr>
                </tfoot>
            </table>
            </form>
        </div>
    </div>
</body>

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

</html>