
<!-- 搜索-html -->
<form action="./company_search.php"  method="GET" name="mysearch" class="title-form">
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
                <input type="text" name="searchtxt" class="inp-searchtxt" value=""><input type="submit" name="searchbtn" class="inp-searchbtn" value="搜索">
            </div>
            
        </div>
        <a href="./company_new.php">新增廠商</a> | <a href="./company_admin.php">返回廠商列表</a>
</form>

<!-- <a href="./company_admin.php">廠商列表</a> | <a href="./company_new.php">新增廠商</a> | <a href="./logout.php?logout=1">登出</a> -->

