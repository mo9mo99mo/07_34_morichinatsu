<?php


//共通処理のファイルを読込。
//requireの呼び出しではファイル読込に失敗した場合はエラーでその先の処理を停止する
require 'common.php';

$pdo = connect_db();


// データ取得SQL作成
$sql = 'SELECT * FROM users_table';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    $output = "";
    // foreachで順番に$outputへデータを追加
    // `.=`は後ろに文字列を追加する，の意味
    foreach ($result as $record) {
        $output .= "<tr class='line'>";
        $output .= "<td>{$record['username']}</td>";
        $output .= "<td>{$record['password']}</td>";
        $output .= "<td class='options'>";
        // edit deleteリンクを追加
        $output .= "<div><a href='edit.php?id={$record["id"]}'><span class='material-icons'>
edit</span></a></div>";
        $output .= "<div><a href='delete.php?id={$record["id"]}'><span class='material-icons'>
delete</span></a></div>";
        $output .= "</td>";
        $output .= "</tr>";
    }
    // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
    // 今回は以降foreachしないので影響なし
    unset($record);
}











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
        <h1>登録ユーザー一覧(管理者用)</h1>
    </header>
    <div id="wrap" class="user_list_area">
        <?php if (isset($error)) : ?>
            <p class="error"><?= h($error); ?></p>
        <?php endif; ?>
        <div class="list_area">
            <table class="user_list_table">
                <?= $output ?>
            </table>

        </div>
        <!-- <div class="fixed_btn_block">
            <a href="index.php" class="fixed_btn">
                <span class="material-icons">add</span>
            </a>
        </div> -->


    </div>
</body>

</html>