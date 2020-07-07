<?php
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

//SQL 敘述: 取得 students 資料表總筆數
$sqlTotal = "SELECT count(1) FROM `company`";

//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

//每頁幾筆
$numPerPage = 8;

// 總頁數
$totalPages = ceil($total/$numPerPage);

//目前第幾頁
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//若 page 小於 1，則回傳 1
$page = $page < 1 ? 1 : $page;
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
        <!-- 搜索-html -->
<form class="title-form" action="./company_search.php"  method="GET" name="mysearch">
        <div class="search-inner">
            <div class="search-list">
                <input type="radio" name="search" value="companyId"  checked 
                    <?php
                            // $check = "checked='checked'";

                            // if(isset($_POST["search"]) && $_POST["search"] === "companyId"){
                            //     echo $check;
                            // }
                    ?>
                >廠商編號
                <input type="radio" name="search" value="companyName"
                    <?php
                      // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "companyName"){
                            echo $check;
                        }
                    ?>
                >廠商名稱
                <input type="radio" name="search" value="companyPhone"
                    <?php
                        // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "companyPhone"){
                            echo $check;
                        }
                    ?>
                >廠商電話
                <input type="radio" name="search" value="principal"
                    <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "principal"){
                            echo $check;
                        }
                    ?>
                >負責人
                <input type="radio" name="search" value="principalPhone"
                    <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "principalPhone"){
                            echo $check;
                        }
                    ?>
                >負責人電話
                <input type="radio" name="search" value="email"
                    <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "email"){
                            echo $check;
                        }
                    ?>
                >信箱
                <input type="radio" name="search" value="companyAddress"
                    <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "companyAddress"){
                            echo $check;
                        }
                    ?>
                >地址
                <span>&nbsp&nbsp&nbsp</spna>
                <label for="">輸入關鍵字：</label>
                <input type="text" name="searchtxt" class="inp-searchtxt" value="">                
                <input class="inp-searchbtn"type="submit" name="searchbtn" class="inp-searchbtn" value="搜尋">
            </div>
        </div>
                    
        <a class="inp-addbtn"  href="./company_new.php">新增廠商</a>
           </form> <?php //require_once('./templates/company_title.php'); ?>
            <form class="admin-form" name="myForm" method="POST" action="company_deleteIds.php">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border" style="white-space:nowrap">選擇</th>
                            <th class="border" style="white-space:nowrap">廠商編號</th>
                            <th class="border" style="white-space:nowrap">廠商名稱</th>
                            <th class="border" style="white-space:nowrap">廠商電話</th>
                            <th class="border" style="white-space:nowrap">負責人</th>
                            <th class="border" style="white-space:nowrap">負責人電話</th>
                            <th class="border" style="white-space:nowrap">信箱</th>
                            <th class="border" style="white-space:nowrap">地址</th>
                            <th class="border" style="white-space:nowrap">功能</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    //SQL 敘述
                    $sql = "SELECT `companyId`, `companyName`, `companyPhone`, `principal`,
                                    `principalPhone`, `email`, `companyAddress`
                            FROM `company`
                            ORDER BY `companyId` ASC
                            LIMIT ?, ? ";

                    //設定繫結值
                    $arrParam = [($page - 1) * $numPerPage, $numPerPage];

                    //查詢分頁後的學生資料
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($arrParam);

                    //資料數量大於 0，則列出所有資料
                    if($stmt->rowCount() > 0) {
                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        for($i = 0; $i < count($arr); $i++) {
                    ?>
                        <tr>
                            <td class="border check">
                                <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['companyId']; ?>" />
                            </td>
                            <td class="border check"><?php echo $arr[$i]['companyId']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['companyName']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['companyPhone']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['principal']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['principalPhone']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['email']; ?></td>
                            <td class="border check"><?php echo $arr[$i]['companyAddress']; ?></td>
                            <td class="border check">
                                <a href="./company_edit.php?editId=<?php echo $arr[$i]['companyId']; ?>" class="inp-edit"><i class="fas fa-edit"></i></a>
                                <a href="./company_delete.php?deleteId=<?php echo $arr[$i]['companyId']; ?>" class="inp-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td class="border" colspan="9">沒有資料</td>
                        </tr>
                    <?php
                    }
                    ?>
                    
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="border">
                            <input class="inp-delete inp-delete2" type="submit" name="smb" value="刪除">
                            </td>
                            <td class="border text-align-center" colspan="10">
                            <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                                <a class="tfoot-number" href="?page=<?= $i ?>"><?= $i ?></a>                            
                            <?php } 
                            ?>
                            </td>
                            
                        </tr>
                    </tfoot>
                </table>
                
            </form>
              <!-- 顯示總比數 -->
        <div class="text-align-center fontfamily">
        表單比數：<?php echo $total; ?>
       </div> 


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/39e79750f1.js" crossorigin="anonymous"></script>
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