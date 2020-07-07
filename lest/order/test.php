<?php
// 查詢     當按下按鈕時將表單資料送入迴圈執行
if(isset($_GET['submitButton'])){
    // 若無輸入查詢的關鍵字
    if($_GET['ID']!=""){
        
            // 沒有選chbox但有輸入條件
        if($_GET['search'] == 0 && $_GET['ID']){

            $sql_where = "where concat(
            IFNULL(`orderid`,'')
            ,IFNULL(`userID`,'')
            ,IFNULL(`name`,'')
            ,IFNULL(`pay`,'')
            ,IFNULL(`logistics`,'')
            ,IFNULL(`status`,'')
            ,IFNULL(`cashflow`,''))
            like '%".$_GET['ID']."%'";
                         
            
        }
        // 如果chbox有勾選並有輸入文字 進入迴圈否則 $sql_where sql收尋條件為空
        if($_GET['search'] && $_GET['ID']){
        // 將勾選的所有條件放入$table_column變數中
            for($i = 0 ;  $i < count($_GET['search']); $i++ ){
                $table_column = $_GET['search'][$i];
            if($i === 0){
                // 勾選一個 將sql條件放入$sql_where變數中
                $sql_where = "where `".$table_column."` like '%".$_GET['ID']."%'";
            }else{
                // 勾選多個 將sql條件放入$sql_where變數中
                $sql_where .= "OR `".$table_column."` like '%".$_GET['ID']."%'";
            }
        }
        
        }

    }else{
    echo "<script>alert('請輸入查詢內容')</script>";
    }
    
}
                    
// SQL 敘述
$sql = "SELECT `orderid`, `userID`, `name`, `pay`, `logistics`, 
        `status`, `cashflow`
        FROM `ordertable` 
            ".$sql_where."
            ORDER BY `orderid` ASC 
            LIMIT ?, ? ";
?>
<form method="get" action="admin.php">
            <input type="checkbox" id="orderid" name="search[]" value="orderid">
            <label for="orderid">訂單編號</label>

            <input type="checkbox" id="userID" name="search[]" value="userID">
            <label for="userID">會員編號</label>

            <input type="checkbox" id="name" name="search[]" value="name">
            <label for="name"> 會員名稱</label>

            輸入關鍵字：
            <input type="text" name="ID" value="" />
            <input type="submit" value="查詢" name="submitButton" />
</form>