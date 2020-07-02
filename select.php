<?php

/**
 * image.php
 */
//共通処理のファイルを読込。
//requireの呼び出しではファイル読込に失敗した場合はエラーでその先の処理を停止する
require 'common.php';

$pdo = connect_db();


// データ取得SQL作成
$sql = 'SELECT * FROM 06kadai_table';

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
    // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
    // `.=`は後ろに文字列を追加する，の意味
    foreach ($result as $record) {
        $output .= "<div class='box'>";
        $output .= "<div><img src='{$record['img_file']}'></div>";
        $output .= "<h2>{$record['title']}</h2>";
        $output .= "<p class='memo'>{$record['honbun']}</p>";
        $output .= "<div class='etc'>";
        $output .= "<p class='gy'>{$record['hizuke']}</p>";
        // edit deleteリンクを追加
        $output .= "<p class='gy'><a href='edit.php?id={$record["id"]}'><span class='material-icons'>
edit</span></a></p>";
        $output .= "<p class='gy'><a href='delete.php?id={$record["id"]}'><span class='material-icons'>
delete</span></a></p>";
        $output .= "</div>";
        $output .= "</div>";
    }
    // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
    // 今回は以降foreachしないので影響なし
    unset($record);
}





// try {
//     //指定した名前の変数を外部から受取り、オプションでフィルタリングする
//     //$id = isset($_GET[id]); と同義
//     $id = filter_input(INPUT_GET, 'id');

//     // データベースに保存したデータを取得
//     $sql = 'SELECT `id`, `title`, `img_file`, `hizuke`, `honbun` FROM `06kadai_table` WHERE `id` = :id';
//     $arr = [];
//     $arr[':id'] = $id;
//     $rows = select($sql, $arr);
//     $row = reset($rows);
// } catch (Exception $e) {
//     $error = $e->getMessage();
// }





?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>一覧画面</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="wrap">
        <?php if (isset($error)) : ?>
            <p class="error"><?= h($error); ?></p>
        <?php endif; ?>
        <div class="box_area">
            <?= $output ?>
        </div>
        <div class="fixed_btn_block">
            <a href="index.php" class="fixed_btn">
                <span class="material-icons">add</span>
            </a>
        </div>
        <!-- <p>
            <img src="<?= h($row['img_file']); ?>" alt="<?= h($row['title']); ?>" />
        </p>
        <p><?= h($row['title']); ?></p>
        <p><?= h($row['hizuke']); ?></p>
        <p><?= h($row['honbun']); ?></p> -->

    </div>
</body>

</html>