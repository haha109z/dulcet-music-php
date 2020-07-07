<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dulcet Music</title>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
</head>
<body>
    <div class="card">
        <figure class="logo">
            <img src="./css/logo_square.svg" title="Logo">
        </figure>
        <form class="myForm" name="myForm" method="post" action="./login.php">
            <div class="input">帳號：<input type="text" name="username" value="" placeholder="請輸入帳戶"/><br /></div>
            <div class="input">密碼：<input type="password" name="pwd" value="" placeholder="請輸入密碼"  /><br /></div>
            <div class="input submit"><input type="submit" value="登入" style="font-family: var(--mainFont-family);color:var(--color01);background:var(--color03);"/></div>
    </div>
</form>
</body>
</html>