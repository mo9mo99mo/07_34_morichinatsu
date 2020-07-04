<?php

session_start();
// データベース接続
require_once('common.php');
$pdo = connect_db();










?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録者一覧画面</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>マイページ</h1>
    </header>
    <div id="wrap" class="user_list_area">
        <p>ようこそ <?php echo $_SESSION['username']; ?> さん</p>


    </div>
</body>

</html>