<?php
require_once('../checkSession.php');
// require_once('aaa.php');
require_once('../db.inc.php');
//SQL 敘述: 取得 students 資料表總筆數
$sqlTotal = "SELECT count(1) FROM `Coupon`";

//取得總筆數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

//每頁幾筆
$numPerPage = 15;

// 總頁數
$totalPages = ceil($total/$numPerPage); 

//目前第幾頁
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//若 page 小於 1，則回傳 1
$page = $page < 1 ? 1 : $page;
?>
        <?php

?>

<?php

?>
<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <style>
    /* .border {
        border: 1px solid;
    } */
    .w200px {
        width: 200px;
    }
    </style>  
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
<!-- <nav class="navbar navbar-expand-sm navbar-light style-header">
        <a class="navbar-brand col-11" href="#">Music</a>
        <a href="./logout.php?logout=1"class="col-1">登出</a>

        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId"> 
</div>
</nav> --> 
<form class="title-form" action="./coupon-search.php"  method="GET" name="mysearch">
<!-- 這邊要放搜尋列-->
<div class="search-inner">
            <div class="search-list">
            <!-- <input type="radio" name="search" value="id"  checked 
                    <?php
                            // $check = "checked='checked'";

                            // if(isset($_POST["search"]) && $_POST["search"] === "companyId"){
                            //     echo $check;
                            // }
                    ?>
                >ID -->
               
                <input type="radio" name="search" value="user_id"
                    <?php
                      // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "companyName"){
                            echo $check;
                        }
                    ?>
                >使用者編號
                <input type="radio" name="search" value="number"
                    <?php
                        // 當此項被選中，搜索後保持選擇狀態
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "companyPhone"){
                            echo $check;
                        }
                    ?>
                >優惠卷號碼
                <input type="radio" name="search" value="content"
                    <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "principal"){
                            echo $check;
                        }
                    ?>
                >優惠卷內容
                <input type="radio" name="search" value="price"
                    <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "principalPhone"){
                            echo $check;
                        }
                    ?>
                >金額
                <input type="radio" name="search" value="password"
                    <?php
                        $check = "checked='checked'";

                        if(isset($_GET["search"]) && $_GET["search"] === "principalPhone"){
                            echo $check;
                        }
                    ?>
                >優惠卷密碼
                <span>&nbsp&nbsp&nbsp</spna>
                <label for="">輸入關鍵字：</label>
                <input type="text" name="searchtxt" class="inp-searchtxt" value="">                
                <input class="inp-searchbtn"type="submit" name="searchbtn" class="inp-searchbtn" value="搜尋">
            </div>
        </div>
                    
  <a class="inp-addbtn"  href="./coupon-new.php">新增優惠</a>
</form>

<form class="admin-form"name="myForm" method="POST" action="coupon-deleteIds.php">
    <table class="table">
        <thead>
            <tr>
                <th class="border" style="white-space:nowrap">選擇</th>
                <!-- <th class="border" style="white-space:nowrap">ID</th> -->
                <th class="border" style="white-space:nowrap">使用者編號</th>
                <th class="border" style="white-space:nowrap">優惠卷號碼</th>
                <th class="border" style="white-space:nowrap">優惠卷內容</th>
                <th class="border" style="white-space:nowrap">金額</th>
                <th class="border" style="white-space:nowrap">優惠卷密碼</th>
                <th class="border" style="white-space:nowrap">使用時間</th>
                <th class="border" style="white-space:nowrap">到期時間</th>
                <th class="border" style="white-space:nowrap">-1過期,0未使用,1使用過</th>
                <th class="border" style="white-space:nowrap">功能</th>

            </tr>
        </thead>
        <tbody>
        <?php
        //SQL 敘述
        $sql = "SELECT `id`,`user_id`,`number`,`content`,`price`,`password`,`alidityv`,`use_date`,`status`
                FROM `Coupon`
                ORDER BY `id` ASC 
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
                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['id']; ?>" />
                </td>
                <!-- <td class="border"><?php //echo $arr[$i]['id']; ?></td> -->
                <td class="border check"><?php echo $arr[$i]['user_id']; ?></td>
                <td class="border"><?php echo $arr[$i]['number']; ?></td>
                <td class="border"><?php echo $arr[$i]['content']; ?></td>
                <td class="border"><?php echo $arr[$i]['price']; ?></td>
                <td class="border"><?php echo $arr[$i]['password']; ?></td>
                <td class="border"><?php echo ($arr[$i]['use_date']); ?></td>
                <td class="border"><?php echo $arr[$i]['alidityv']; ?></td>
                <td class="border check"><?php echo ($arr[$i]['status']); ?></td>
                <td class="border">
                    <a class="inp-edit"  href="./coupon-edit.php?editId=<?php echo $arr[$i]['id'];?>" class="style-btn"><i class="fas fa-edit"></i></a>
                    <a class="inp-delete" href="./coupon-delete.php?deleteId=<?php echo $arr[$i]['id']; ?>" class="style-btn"><i class="fas fa-trash"></i></a>
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
    <td class="border" colspan="12">
    <input class="inp-delete inp-delete2" type="submit" name="smb" value="刪除">
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
        <!-- <div class="col-2">
            <div class="list-group" id="list-tab" role="tablist" >
                <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="" href="#list-home" role="tab" aria-controls="home">會員列表</a>
                <a class="list-group-item list-group-item-action" id="" data-toggle="" href="#list-profile" role="tab" aria-controls="">廠商列表</a>
                <a class="list-group-item list-group-item-action" id="" data-toggle="" href="#list-messages" role="tab" aria-controls="">商品列表</a>
                <a class="list-group-item list-group-item-action" id="" data-toggle="" href="#list-settings" role="tab" aria-controls="">訂單列表</a>
                <a class="list-group-item list-group-item-action" id="" data-toggle="" href="./coupon.php" role="tab" aria-controls="">優惠卷管理</a>
                <a class="list-group-item list-group-item-action" id="" data-toggle="" href="#list-settings" role="tab" aria-controls="">活動管理</a>
                <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
              <a class="dropdown-item" href="./coupon.php">Action 1</a>
              <a class="dropdown-item" href="./conpon">Action 2</a>
            </div>
          </li>           
            </div>         
        </div> -->
    <!-- </div>     
</form>   -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                crossorigin="anonymous"></script> -->
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



