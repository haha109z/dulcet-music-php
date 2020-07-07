<?php
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 
?>
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
    <form name="myForm" method="POST" action="company_updateEdit.php" enctype="multipart/form-data">
        <table class="table1">
            <tbody>
                    <?php
                    //SQL 敘述
                    $sql = "SELECT `companyId`, `companyName`, `companyPhone`, `principal`,
                                    `principalPhone`, `email`, `companyAddress`
                            FROM `company`
                            WHERE `companyId` = ?";

                    //設定繫結值
                    $arrParam = [$_GET['editId']];

                    //查詢
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($arrParam);
                    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if(count($arr) > 0) {
                    ?>
                    <tr>
                            <td class="border">廠商編號</td>
                            <td class="border">
                                <input type="text" readonly="readonly" name="companyId" value="<?php echo $arr[0]['companyId']; ?>" maxlength="5" class="edit" />
                            </td>
                        </tr>
                        <tr>
                            <td class="border">廠商名稱</td>
                            <td class="border">
                                <input type="text" name="companyName" value="<?php echo $arr[0]['companyName']; ?>" maxlength="10" class="edit"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="border">廠商電話</td>
                            <td class="border">
                                <input type="text" name="companyPhone" value="<?php echo $arr[0]['companyPhone']; ?>" maxlength="15" class="edit" />
                            </td>
                        </tr>
                        <tr>
                            <td class="border">負責人</td>
                            <td class="border">
                                <input type="text" name="principal" value="<?php echo $arr[0]['principal']; ?>" maxlength="10" class="edit"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="border">負責人電話</td>
                            <td class="border">
                                <input type="text" name="principalPhone" value="<?php echo $arr[0]['principalPhone']; ?>" maxlength="15" class="edit"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="border">信箱</td>
                            <td class="border">
                                <input type="text" size="30" name="email" value="<?php echo $arr[0]['email']; ?>" maxlength="40" class="edit"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="border">地址</td>
                            <td class="border">
                                <input type="text" size="30"name="companyAddress" value="<?php echo $arr[0]['companyAddress']; ?>" maxlength="50" class="edit"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="border">功能</td>
                            <td class="border">
                               <!-- 要換圖片 -->
                               <a href="./company_delete.php?deleteId=<?php echo $arr[0]['companyId']; ?>" class="inp-delete"><i class="fas fa-trash"></i></a> 
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
                            <input class="inp-addbtn" type="submit" name="smb"value="送出">
                            <a class="inp-addbtn" href="./company_admin.php">返回廠商列表</a>
                        </td>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" name="editId" value="<?php echo $_GET['editId']; ?>">
            </form>
        </div>
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