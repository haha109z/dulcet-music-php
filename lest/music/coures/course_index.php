<?php
require_once('../../checkSession.php');//引入判斷是否登入機制
require_once('../../db.inc.php');      //引用資料庫連線 

//SQL 敘述: 取得 students 資料表總筆數
$sqlTotal = "SELECT count(1) FROM `product` WHERE `PCategoryId` = 'C'";

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
    <style>
    /* .border {
        border: 1px solid;
    } */
    /* .w200px {
        width: 200px;
    } */
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
<form class="title-form" method="GET" action="course_search.php" class="title-form"><!--斜線！！禮拜一在改給一路他們看--> 
<div class="search-inner">
            <div class="search-list"> 

<span>關鍵字：</span><input type="text" name="search" class="inp-searchtxt" ><br>
        <span>價格區間：</span><input class="inp-searchtxt" type="text" name="priceMin"><span>~</span><input class="inp-searchtxt" type="text" name="priceMax"><br>
        <span>樂器類別：</span>
        <select name="Category" class="inp-searchtxt"  id="">
            <option value="0" >全部</option>
            <option value="1" >鋼琴</option>
            <option value="2" >電子琴</option>
            <option value="3" >小提琴</option>
            <option value="4" >中提琴</option>
            <option value="5" >薩克斯風</option>
            <option value="6" >長笛</option>
            <option value="7" >烏克莉莉</option>
            <option value="8" >爵士鼓</option>
        </select><br>
        <!-- <span>廠商編號：</span><input type="text" name="CId"><br> -->

        <input class="inp-searchbtn" type="submit" name="smb" value="搜尋">
        <br><br><a class="inp-addbtn" href="./course_new.php" >新增課程</a>
  </div>
</div>
    </form> 



<form class="admin-form" name="myForm" method="POST" action="course_deleteIds.php">
    <table class="table">
        <thead>
            <tr>
                <th class="border" style="white-space:nowrap">選擇</th>
                <th class="border" style="white-space:nowrap">課程編號</th>
                <th class="border" style="white-space:nowrap">課程名稱</th>
                <th class="border" style="white-space:nowrap">課程價格</th>
                <th class="border" style="white-space:nowrap">人數</th>
                <th class="border" style="white-space:nowrap">上課時數</th>
                <th class="border" style="white-space:nowrap">樂器類別</th>
                <th class="border" style="white-space:nowrap">功能</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //SQL 敘述


                $sql = "SELECT `PId`,`PImg`, `PName`, `PPrice`, `PQty`, `PTime`, 
                `PDesciption`,
                `musical_category`.`CategoryId` AS 'PInstrumentId',  `musical_category`.`CategoryName` AS 'PInstrumentName',
                `product_category`.`CategoryId` AS 'PCategoryId' , `product_category`.`CategoryName` AS 'PCategoryName'
                FROM `product` INNER JOIN `musical_category` INNER JOIN `product_category`
                ON `product`.`PInstrumentId` = `musical_category`.`CategoryId` AND `product`.`PCategoryId` = `product_category`.`CategoryId`
                WHERE `PCategoryId` = 'C' 
                ORDER BY `PId` ASC 
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
                <td class="border text-align-center">
                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['PId']; ?>" />
                </td>
                <td class="border check"><?php echo $arr[$i]['PId']; ?></td>
                <td class="border check"><?php echo $arr[$i]['PName']; ?></td>
                <td class="border check"><?php echo $arr[$i]['PPrice']; ?></td>
                <td class="border check"><?php echo $arr[$i]['PQty']; ?></td>
                <td class="border check"><?php echo $arr[$i]['PTime']; ?></td>
                <td class="border check"><?php echo $arr[$i]['PInstrumentName']; ?></td>
                
             
                <td style="padding-left:100px" class="border">
                    <a href="./course_view.php?viewId=<?php echo $arr[$i]['PId']; ?>"  class="inp-delete"><i class="fas fa-eye"></i></a>
                    <a href="./course_edit.php?editId=<?php echo $arr[$i]['PId']; ?>"  class="inp-edit"><i class="fas fa-edit"></i></a>
                    <a href="./course_delete.php?deleteId=<?php echo $arr[$i]['PId']; ?>" class="inp-delete"><i class="fas fa-trash"></i></a>
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
                <td class="text-align-center border" colspan="9">
                <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                    <a  class="tfoot-number" href="?page=<?= $i ?>"><?= $i ?></a>
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