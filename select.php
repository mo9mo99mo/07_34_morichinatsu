<?php

/**
 * image.php
 */
require 'common.php';

try {
    $id = filter_input(INPUT_GET, 'id');

    // データベースに保存したデータを取得
    $sql = 'SELECT `id`, `title`, `img_file`, `hizuke`, `honbun` FROM `06kadai_table` WHERE `id` = :id';
    $arr = [];
    $arr[':id'] = $id;
    $rows = select($sql, $arr);
    $row = reset($rows);
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>一覧画面</title>
</head>

<body>
    <div id="wrap">
        <?php if (isset($error)) : ?>
            <p class="error"><?= h($error); ?></p>
        <?php endif; ?>
        <p>
            <img src="<?= h($row['img_file']); ?>" alt="<?= h($row['title']); ?>" />
        </p>
        <p><?= h($row['title']); ?></p>
        <p><?= h($row['hizuke']); ?></p>
        <p><?= h($row['honbun']); ?></p>
    </div>
</body>

</html>