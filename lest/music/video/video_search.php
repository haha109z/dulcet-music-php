<?php
require_once('../../checkSession.php');//引入判斷是否登入機制
require_once('../../db.inc.php');      //引用資料庫連線 

// 搜尋條件
$search=$_GET['search'];
$priceMin=(int)$_GET['priceMin'];
$priceMax=(int)$_GET['priceMax'];
$Category=$_GET['Category'];
$CId=$_GET['CId'];
$arrSQL=array();
if($search==''&&$priceMin==0&&$priceMax==0&&$Category=='0'&&$CId==''){
    echo "請輸入搜尋條件";
    header("Refresh: 3; url=../video_index.php");
    exit();
}

$sqlTotal = "SELECT count(1) FROM `product` WHERE `PCategoryId` = 'V' ";
// sql語法
// $sql = "SELECT `PId`, `PName`, `PPrice`, `PQty`, `PTime`
// `product_category`.`CategoryName` AS 'PCategoryId', `musical_category`.`CategoryName` AS 'PInstrumentId', `PCompanyId`
//         FROM `product` INNER JOIN `product_category` INNER JOIN `musical_category`
//         ON `product`.`PCategoryId`=`product_category`.`CategoryId` AND `product`.`PInstrumentId`=`musical_category`.`CategoryId`

    $sql = "SELECT `PId`,`PImg`, `PName`, `PPrice`, `PQty`, `PTime`, 
                `PDesciption`,`PCompanyId`,
                `musical_category`.`CategoryId` AS 'PInstrumentId',  `musical_category`.`CategoryName` AS 'PInstrumentName',
                `product_category`.`CategoryId` AS 'PCategoryId' , `product_category`.`CategoryName` AS 'PCategoryName'
                FROM `product` INNER JOIN `musical_category` INNER JOIN `product_category`
                ON `product`.`PInstrumentId` = `musical_category`.`CategoryId` AND `product`.`PCategoryId` = `product_category`.`CategoryId`
                WHERE `PCategoryId` = 'V' ";

if($priceMin!=0){
    $arrSQL[]=" AND `PPrice`>=$priceMin";
}
if($priceMax!=0){
    $arrSQL[]=" AND `PPrice`<=$priceMax";
}
if($CId!=''){
    $arrSQL[]=" AND `PCompanyId`='$CId'";
}
if($search!=''){
    $arrSQL[]=" AND ((`PName` LIKE '%$search%') OR (`PDesciption` LIKE '%$search%'))";
}
if($Category!='0'){
    $arrSQL[]=" AND `PInstrumentId`='$Category'";
}

// 組合sql語法
foreach($arrSQL as $value){
    $sql.=$value;
    $sqlTotal.=$value;
}
$sql.=" ORDER BY `PId` ASC ";

//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

//每頁幾筆
$numPerPage = 10;

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
    <title>Dulect Music</title>
    <style>
    /* .border {
        border: 1px solid;
    } */
    .w200px {
        width: 200px;
    }
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


<form name="myForm" method="POST" action="" enctype="">
    <table class="table">
    <thead>
    <tr>
                <th class="border">選擇</th>
                <th class="border">影片編號</th>
                <th class="border">影片名稱</th>
                <th class="border">影片價格</th>
                <th class="border">影片時數</th>
                <th class="border">樂器類別</th>
                <th class="border">上架廠商</th>
                <th class="border">功能</th>
            </tr>
        </thead>
        <tbody>


<?php 
$sql.="LIMIT ?, ? ";

$arrParam = [($page - 1) * $numPerPage, $numPerPage];

//查詢分頁後的學生資料
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);
// 印出資料
        //資料數量大於 0，則列出所有資料
        if($stmt->rowCount() > 0) {
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            for($i = 0; $i < count($arr); $i++) {
        ?>
            <tr>
                <td class="border check">
                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['PId']; ?>" />
                </td>
                <td class="border check"><?php echo $arr[$i]['PId']; ?></td>
                <td class="border check"><?php echo $arr[$i]['PName']; ?></td>
                <td class="border check"><?php echo $arr[$i]['PPrice']; ?></td>
                <td class="border check"><?php echo $arr[$i]['PTime']; ?></td>
                <td class="border check"><?php echo $arr[$i]['PInstrumentName']; ?></td>
                <td class="border check"><?php echo $arr[$i]['PCompanyId']; ?></td>
                <td class="border"style="padding-left:50px">
                    <a class="inp-delete"href="./video_view.php?viewId=<?php echo $arr[$i]['PId']; ?>"><i class="fas fa-eye"></i></a>
                    <a class="inp-edit" href="./video_edit.php?editId=<?php echo $arr[$i]['PId']; ?>"><i class="fas fa-edit"></i></a>
                    <a class="inp-delete" href="./video_delete.php?deleteId=<?php echo $arr[$i]['PId']; ?>"><i class="fas fa-trash"></i></a>
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
                <td colspan="1" class="border">
                <input class="inp-delete inp-delete2" type="submit" name="smb" value="刪除">
                </td>
                <td class="border text-align-center" colspan="6">
                   
                <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                    <a class="tfoot-number" href="?search=<?php echo $search?>&priceMin=<?php echo $priceMin?>&priceMax=<?php echo $priceMax?>&Category=<?php echo $Category?>&CId=<?php echo $CId?>&page=<?= $i ?>"><?= $i ?></a>
                <?php } ?>
                </td>
                <td class="border" colspan="7">
          <a class="inp-addbtn" href="./video_index.php">回影片列表</a>
                </td>
            </tr>
        </tfoot>
    </table>
    
</form>
   <!-- 顯示總比數 -->
   <div class="text-align-center fontfamily">
        表單比數：<?php echo $total; ?>
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


