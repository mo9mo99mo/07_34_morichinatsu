<!--  -->

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
        <h1>投稿画面</h1>
    </header>
    <section>
        <?php if (isset($error)) : ?>
            <p class="error"><?= h($error); ?></p>
        <?php endif; ?>
        <!-- 画像ファイルアップロードにはformタグにenctype="multipart/form-data"を追加 -->
        <form action="insert.php" method="post" onsubmit="return chk(this)" id="form" enctype="multipart/form-data">
            <!-- 画像アップロード -->
            <div class="form_1colmun">
                <div class="form_input">
                    <input id="img_file" type="file" name="img_file" placeholder="画像ファイルを選択">
                    <span id="img_error" class="error_msg"></span>
                </div>
            </div><!-- /画像アップロード -->
            <div class="form_1colmun">
                <div class="form_input">
                    <input type="date" name="hizuke" id="hizuke">
                    <span id="date_error" class="error_msg"></span>
                </div>
            </div>
            <div class="form_1colmun">
                <div class="form_input">
                    <input id="ttl" type="text" name="title" placeholder="タイトルを入力">
                    <span id="ttl_error" class="error_msg"></span>
                </div>
            </div>
            <div class="form_1colmun">
                <div class="form_input">
                    <input id="honbun" type="text" name="honbun" placeholder="コメント・説明を入力">
                    <span id="honbun_error" class="error_msg"></span>
                </div>
            </div>
            <div class="form_btn">
                <button id="post" type="submit" name="upload" class="btn" value="投稿">投稿</button>
            </div>
        </form>
    </section>
    <footer>
        <a href="select.php" class="btn">投稿一覧をみる</a>
    </footer>
</body>

</html>