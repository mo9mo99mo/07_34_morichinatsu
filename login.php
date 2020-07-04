<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>課題：DB連携アプリ</title>
    <meta name="description" content="06_php課題">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <header>
        <h1>会員ログイン</h1>
    </header>
    <section id="form_block">
        <form action="login_insert.php" method="post" onsubmit="return chk(this)" id="form">
            <div class="form_1colmun">
                <div class="form_input">
                    <input type="text" name="user_name" id="user_name" placeholder="ユーザーネーム">
                    <span id="username_error" class="error_msg"></span>
                </div>
            </div>
            <div class="form_1colmun">
                <div class="form_input">
                    <input id="psw" type="text" name="psw" placeholder="パスワード">
                    <span id="pw_error" class="error_msg"></span>
                </div>
            </div>
            <div class="form_btn">
                <button id="post" type="submit" name="login" class="btn" value="ログイン">ログイン</button>
            </div>
        </form>
    </section>
    <footer>
        <a href="index.php" class="btn">会員登録はこちら</a>
    </footer>
</body>

</html>