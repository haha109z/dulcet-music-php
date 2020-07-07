<?php
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 

@$gettext = $_GET['text'];
@$submitButton = $_GET['submitButton'];
@$search=$_GET["search"];

if($submitButton=="" && $gettext ==""){

}else{

    if(isset($_GET['submitButton'])){
    // 若無輸入查詢的關鍵字
        if($_GET['text']!=""){
            // 沒有選chbox但有輸入條件
            if(@$_GET['search']==0 && $_GET['text']){
                    $sql_where = "where  concat(
                        IFNULL(`userID`,'')
                        ,IFNULL(`username`,'')
                        ,IFNULL(`userGender`,'')
                         ,IFNULL(`userPhone`,'')
                         ,IFNULL(`userMail`,'')
                         ,IFNULL(`userBirthday`,'')
                         ,IFNULL(`userAddress`,'')
                         ,IFNULL(`created_at`,'')
                         ,IFNULL(`updated_at`,''))
                         like '%".$_GET['text']."%'";
                }

                    // 如果chbox有勾選並有輸入文字 進入迴圈否則 $sql_where sql收尋條件為空
            if(@$_GET['search'] && $_GET['text']){
                // 將勾選的所有條件放入$table_column變數中
                // for($i= 0 ;  $i < count($_GET['search']); $i++ ){
                    // $table_column = $_GET['search'][$i];
                    $table_column = $_GET['search'];
                    // if($i === 0){
                    //     // 勾選一個 將sql條件放入$sql_where變數中
                        $sql_where = "where `".$table_column."` like '%".$_GET['text']."%' ";
                    // }else{
                    //      // 勾選多個 將sql條件放入$sql_where變數中
                        // $sql_where .= "OR `".$table_column."` like '%".$_GET['text']."%'";
                    // }
                        
                // }
            }
        }else{
            echo "<script>alert('請輸入關鍵字')</script>"; 
            header("Refresh: 0; url=./admin.php");
        }
    }   
}
  


//SQL 敘述: 取得 user` 資料表總筆數
@$sqlTotal = "SELECT count(1) FROM `user` ".$sql_where;

//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

//每頁幾筆
$numPerPage = 6;

// 總頁數
$totalPages = ceil($total/$numPerPage); 

//目前第幾頁
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//若 page 小於 1，則回傳 1
$page = $page < 1 ? 1 : $page;


                    
//SQL 敘述
@$sql = "SELECT `userID`, `username`, `userGender`, `userMail`, `userPhone`, 
                        `userBirthday`, `userAddress`, `userImg`, `created_at`, `updated_at`
            FROM `user` 
            ".$sql_where."
            ORDER BY `userID` ASC 
            LIMIT ?, ? ";





//設定繫結值
$arrParam = [($page - 1) * $numPerPage, $numPerPage];

//查詢分頁後的user資料
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);


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
            /* .w200px {
        width: 100px;
        height:100px ;
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
        
        <form class="title-form" method="get" action="admin.php">
        <div class="search-inner">
        <div class="search-list">


            <input type="radio" name="search" value="userID" id="userID"
                    <?php
                      // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "userID"){
                            echo $check;
                        }
                    ?>
                >
                <label for="userID"> 會員編號</label>


        <input type="radio" name="search" value="username" id="username"
                    <?php
                      // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "username"){
                            echo $check;
                        }
                    ?>
                >
            <label for="username"> 會員姓名</label>


        <input type="radio" name="search" value="userGender" id="userGender"
                    <?php
                      // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "userGender"){
                            echo $check;
                        }
                    ?>
                >
            <label for="userGender"> 會員性別</label>

        <input type="radio" name="search" value="userMail" id="userMail"
                    <?php
                      // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "userMail"){
                            echo $check;
                        }
                    ?>
                >
            <label for="userMail">會員信箱</label>

        
        <input type="radio" name="search" value="userPhone" id="userPhone"
                    <?php
                      // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "userPhone"){
                            echo $check;
                        }
                    ?>
                >
            <label for="userPhone">會員手機</label>

        <input type="radio" name="search" value="userBirthday" id="userBirthday"
                    <?php
                      // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "userBirthday"){
                            echo $check;
                        }
                    ?>
                >
            <label for="userBirthday">會員生日</label>

            <input type="radio" name="search" value="userAddress" id="userAddress"
                    <?php
                      // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "userAddress"){
                            echo $check;
                        }
                    ?>
                >
            <label for="userAddress">會員地址</label>
            <span>&nbsp</spna>
            輸入關鍵字：
            <input type="text" name="text"  class="inp-searchtxt" >
            <input class="inp-searchbtn" type="submit" value="搜尋" name="submitButton"   />
        </div>
        </div>
        <a class="inp-addbtn" href="./new.php">新增會員</a>
        </form>
        <?php //require_once('./templates/title.php'); ?>
        
       
       <form class="admin-form" name="myForm" method="POST" action="deleteIds.php">
            <table class="table">
               <thead>
                    <tr class="">
                        <th class="border" style="white-space:nowrap">選擇</th>
                        <th class="border" style="white-space:nowrap">會員ID</th>
                        <th class="border" style="white-space:nowrap">會員姓名</th>
                        <th class="border" style="white-space:nowrap">性別</th>
                        <th class="border" style="white-space:nowrap">會員信箱</th>
                        <th class="border" style="white-space:nowrap">會員生日</th>
                        <th class="border" style="white-space:nowrap">會員手機</th>
                        <th class="border" style="white-space:nowrap">會員地址</th>
                        <th class="border" style="white-space:nowrap">會員照片</th>
                        <th class="border" style="white-space:nowrap">註冊時間</th>
                        <th class="border" style="white-space:nowrap">更新時間</th>
                        <th class="border" style="white-space:nowrap">功能</th>
                    </tr>
</thead>
                <tbody>
                    <?php

        //資料數量大於 0，則列出所有資料
        if($stmt->rowCount() > 0) {
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            for($i = 0; $i < count($arr); $i++) {
        ?>
                    <tr>
                        <td class="border check">
                            <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['userID']; ?>" />
                        </td>
                        <td class="border check"><?php echo $arr[$i]['userID']; ?></td>
                        <td class="border check" style="white-space:nowrap"><?php echo $arr[$i]['username']; ?></td>
                        <td class="border check"><?php echo $arr[$i]['userGender']; ?></td>
                        <td class="border check"><?php echo $arr[$i]['userMail']; ?></td>
                        <td class="border check" style="white-space:nowrap"><?php echo $arr[$i]['userBirthday']; ?></td>
                        <td class="border check"><?php echo $arr[$i]['userPhone']; ?></td>
                        <td class="border check"><?php echo $arr[$i]['userAddress']; ?></td>
                        <td class="w200px border check">
                            <?php if($arr[$i]['userImg'] !== NULL) { ?>
                            <img  class="w200px" src="./files/<?php echo $arr[$i]['userImg']; ?>">
                            <?php }else{ echo "無";} ?>
                        </td>
                        <td class="border check"><?php echo $arr[$i]['created_at']; ?></td>
                        <td class="border check"><?php echo $arr[$i]['updated_at']; ?></td>


                        <td class="border">
                        <!-- 編輯和刪除要圖片 -->
                       

                            <a href="./edit.php?editId=<?php echo $arr[$i]['userID']; ?>" class="inp-edit"><i class="fas fa-edit"></i></a>
                            <a href="./delete.php?deleteId=<?php echo $arr[$i]['userID']; ?>" class="inp-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
            }
        } else {
        ?>
                    <tr>
                        <td class="border" colspan="12">沒有資料</td>
                    </tr>
                    <?php
        }
        ?>
                </tbody>
                <tfoot>
                    <tr>
                        <!-- 資料頁數 -->
                        <td class="border">
                            <input class="inp-delete inp-delete2" type="submit" name="smb" value="刪除">
                        </td>
                        <td class="border text-align-center" colspan="12">
                           
                            <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                                <a class="tfoot-number" href="?text=<?php echo $gettext;?>&submitButton=<?php echo $submitButton;?>&search=<?php echo$search;?>&page=<?= $i ?>"><?= $i ?></a>
                            <?php } ?>
                          </td>  
                    </tr>
                    
                </tfoot>
            </table>
                         
        </form>
        <!-- 顯示總比數 -->
        <div class="text-align-center fontfamily">
        表單比數：<?php echo $total; ?>
       </div> 
    </div>
        <script src="https://kit.fontawesome.com/39e79750f1.js" crossorigin="anonymous"></script>
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
    </body>

    </html>