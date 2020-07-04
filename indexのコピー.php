<?php
//サーバーに一時的にデータを保存する
session_start();
require 'common.php';
// DB接続
$pdo = connect_db();

//入力欄（$_POST）に値が存在するかどうか判別
if (!empty($_POST)) {
    if ($_POST['user_name'] === '') {
        $error['user_name'] = 'blank'; //エラー呼出しに使用する
    }
    if ($_POST['psw'] === '') {
        $error['psw'] = 'blank'; //エラー呼出しに使用する
    }



    if (!isset($error)) {
        //$_SESSION['join'] = $_POST;
        header("Location: insert.php");
        exit();
    }
}
?>
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
        <h1>ユーザー登録画面</h1>
    </header>
    <section id="form_block">
        <form action="" method="post" id="form">
            <div class="form_1colmun">
                <div class="form_input">
                    <?php if ($error['user_name'] === 'blank') : ?>
                        <p class="error">名前を入力してください</p>
                    <?php endif ?>
                    <input type="text" name="user_name" id="user_name" placeholder="ユーザーネーム" value="<?php echo htmlspecialchars($_POST['username'], ENT_QUOTES); ?>">
                </div>
            </div>
            <div class="form_1colmun">
                <div class="form_input">
                    <?php if ($error['psw'] === 'blank') : ?>
                        <p class="error">パスワードを入力してください</p>
                    <?php endif ?>
                    <input id="psw" type="text" name="psw" placeholder="パスワード">
                    <span id="pw_error" class="error_msg"></span>
                </div>
            </div>
            <div class="form_btn">
                <button id="post" type="submit" name="entry" class="btn" value="新規会員登録">新規会員登録</button>
            </div>
        </form>
    </section>
    <!-- <footer>
        <a href="select.php" class="btn">投稿一覧をみる</a>
    </footer> -->
</body>

</html>