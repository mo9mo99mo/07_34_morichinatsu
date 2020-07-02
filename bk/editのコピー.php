<?php
// 送信データチェック
// var_dump($_GET);
// exit();
//OK

// 関数ファイルの読み込み
//先に共通処理を読込んであげないといけない
//requireではファイル読込に失敗した場合、エラーとしてその先の処理を停止する
require 'common.php';

// idの受取 送信されたidをGETで受け取る
// aタグは$_GETしか送れない
$id = $_GET['id'];

// DB接続
$pdo = connect_db();
$sql = 'SELECT * FROM 06kadai_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($_GET['id']);
// exit();
//OK

// データ取得SQL作成
$sql = '';

// SQL準備&実行
// fetch()で1レコード取得できる
// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>課題：DB連携アプリ</title>
    <meta name="description" content="07_php課題">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <header>
        <h1>編集画面</h1>
    </header>
    <section id="form_block">
        <?php if (isset($error)) : ?>
            <p class="error"><?= h($error); ?></p>
        <?php endif; ?>
        <!-- 画像ファイルアップロードにはformタグにenctype="multipart/form-data"を追加 -->
        <form action="update.php" method="post" onsubmit="return chk(this)" id="form" enctype="multipart/form-data">
            <!-- 画像アップロード -->
            <div class="form_1colmun">
                <div class="form_input">
                    <input id="img_file" type="file" name="img_file" value="<?= $record["img_file"] ?>">
                    <span id="img_error" class="error_msg"></span>
                </div>
            </div><!-- /画像アップロード -->
            <div class="form_1colmun">
                <div class="form_input">
                    <input type="date" name="hizuke" id="hizuke" value="<?= $record["hizuke"] ?>">
                    <span id="date_error" class="error_msg"></span>
                </div>
            </div>
            <div class="form_1colmun">
                <div class="form_input">
                    <input id="ttl" type="text" name="title" value="<?= $record["title"] ?>">
                    <span id=" ttl_error" class="error_msg"></span>
                </div>
            </div>
            <div class="form_1colmun">
                <div class="form_input">
                    <input id="honbun" type="text" name="honbun" value="<?= $record["honbun"] ?>">
                    <span id="honbun_error" class="error_msg"></span>
                </div>
            </div>
            <div class="form_btn">
                <button id="post" type="submit" name="upload" class="btn" value="投稿">投稿</button>
            </div>
            <input type="hidden" name="id" value="<?= $record['id'] ?>">
        </form>
    </section>
    <footer>
        <a href="select.php" class="btn">投稿一覧をみる</a>
    </footer>
</body>

</html>