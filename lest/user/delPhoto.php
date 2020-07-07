<?php
require_once('../checkSession.php');//引入判斷是否登入機制
require_once('../db.inc.php');      //引用資料庫連線 
// 更新圖片
$sql = "UPDATE `user` 
        SET 
        `userImg` = NULL where userID = ?";

$arrParam = [$_GET['userID']];


$sqlGetImg = "SELECT `userImg` FROM `user` WHERE `userID` = ? ";
        $stmtGetImg = $pdo->prepare($sqlGetImg);

        //加入繫結陣列
        $arrGetImgParam = [
           $_GET['userID']
        ];

        //執行 SQL 語法
        $stmtGetImg->execute($arrGetImgParam);

        //若有找到 studentImg 的資料
        if($stmtGetImg->rowCount() > 0) {
            //取得指定 id 的學生資料 (1筆)
            $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC);

            //若是 studentImg 裡面不為空值，代表過去有上傳過
            if($arrImg[0]['userImg'] !== NULL){
                //刪除實體檔案
                @unlink("./files/".$arrImg[0]['userImg']);

                // 更新資料庫
                $stmt = $pdo->prepare($sql);
                $stmt->execute($arrParam);
                // print_r($sql);
                // print_r($arrParam);
                if( $stmt->rowCount() > 0 ){
                    header("Refresh: 3; url=./admin.php");
                    echo "更新成功";
                } else {
                    header("Refresh: 3; url=./admin.php");
                    echo "沒有任何更新";
                }
            } else {
                header("Refresh: 3; url=./admin.php");
                echo "沒有圖片檔案";
            }
            
            /**
             * 因為前面 `studentDescription` = ? 後面沒有加「,」，
             * 若是這裡會有更新 studentImg 的需要，
             * 代表 `studentDescription` = ? 後面缺一個「,」，
             * 不然會報錯
             */
            $sql.= ",";

            //studentImg SQL 語句字串
            $sql.= "`userImg` = ? ";

            //僅對 studentImg 進行資料繫結
            @$arrParam[] = $studentImg;
            
        }else{
            echo "圖片不需刪除";
        }
