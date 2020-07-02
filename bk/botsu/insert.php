<?php
//データ送信されているかチェック
// var_dump($_POST);
// exit();

//本文を出力
//var_dump($_POST['honbun']);

//受け取った画像ファイルの情報を出力
// var_dump($_FILES);
// echo $_FILES['img_file']['name']; //file name
// echo $_FILES['img_file']['type']; //file type 拡張子
// echo $_FILES['img_file']['size']; //file size
// echo $_FILES['img_file']['error']; //file error

// if ($_FILES['img_file']['name']) {
//     //faile name
//     echo $_FILES['img_file']['name'];
// }


//項目入力のチェック
//値が存在しないor空で送信されてきた場合はNGにする
if (
    !isset($_FILES['img_file']) || $_FILES['img_file'] == '' ||
    !isset($_POST['date']) || $_POST['date'] == '' ||
    !isset($_POST['title']) || $_POST['title'] == ''
) {
    exit('ParamError：必須項目が入力されていない、もしくは空です');
}

// 受け取ったデータを変数に入れる
$img_file = $_FILES['img_file'];
$date = $_POST['date'];
$title = $_POST['title'];
$honbun = $_POST['honbun'];

//データベースに接続
$dbn = 'mysql:dbname=gsacf_d06_34;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    // ここでDB接続処理を実行する
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["db error" => "{$e->getMessage()}"]); //getMessage SQLからエラー文を取出して表示
    exit();
}

// データ登録SQL作成
// `updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力
//$sql = '';

// SQL準備&実行
//$sql = 'INSERT INTO 06kadai_table(id, title, date, img_file, honbun, updated_at) VALUES(NULL, :title, :date, :img_file, :honbun, sysdate())';

//画像をuploadsフォルダへアップロード
//画像情報とテキスト情報をDBに保存
function file_upload()
{
    // POSTではないとき何もしない
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
        return;
    }

    //日付
    $date = $_POST['date'];

    // タイトル
    $title = filter_input(INPUT_POST, 'title');
    // if ('' === $title) {
    // throw new Exception('タイトルは入力必須です。');
    // }

    //本文
    $honbun = $_POST['honbun'];

    // 画像アップロードファイル
    $img_file = $_FILES['img_file'];
    //参照 http://php.net/manual/ja/features.file-upload.post-method.php

    if ($img_file['error'] > 0) {
        throw new Exception('ファイルアップロードに失敗しました。');
    }

    $tmp_name = $img_file['tmp_name'];

    // ファイル拡張子をチェック
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimetype = finfo_file($finfo, $tmp_name);

    // 許可するMIMETYPE
    $allowed_types = [
        'jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'
    ];
    if (!in_array($mimetype, $allowed_types)) {
        throw new Exception('許可されていない拡張子のファイルです。');
    }

    // ファイル名（ハッシュ値でファイル名を決定するため、同一ファイルは同盟で上書きされる）
    $filename = sha1_file($tmp_name);

    // 拡張子
    $ext = array_search($mimetype, $allowed_types);

    // 画像保存先のパス
    $destination = sprintf(
        '%s/%s.%s',
        'uploads',
        $img_file,
        $ext
    );

    // アップロードディレクトリに移動
    if (!move_uploaded_file($tmp_name, $destination)) {
        throw new Exception('ファイルの保存に失敗しました。');
    }

    // Exif 情報の削除
    $imagick = new Imagick($destination);
    $imagick->stripimage();
    $imagick->writeimage($destination);

    // データベースに登録
    $sql = 'INSERT INTO 06kadai_table(id, title, date, img_file, honbun, updated_at) VALUES(NULL, :title, :date, :img_file, :honbun, sysdate())';
    $arr = [];
    $arr[':title'] = $title;
    $arr[':date'] = $date;
    $arr[':honbun'] = $honbun;
    $arr[':img_file'] = $destination;
    $lastInsertId = insert($sql, $arr);


    // 成功時にページを移動する
    header(sprintf('Location: select.php?id=%d', $lastInsertId));
}

try {
    // ファイルアップロード
    file_upload();
} catch (Exception $e) {
    $error = $e->getMessage();
}


//DBに直接画像を保存するため却下
// if ($_SERVER['REQUEST_METHOD'] != 'POST') {
// // 画像を取得

// } else {
// // 画像を保存
// if (!empty($_FILES['image']['name'])) {
// $name = $_FILES['image']['name'];
// $type = $_FILES['image']['type'];
// $content = file_get_contents($_FILES['image']['tmp_name']);
// $size = $_FILES['image']['size'];

// $sql = 'INSERT INTO images(image_name, image_type, image_content, image_size, created_at)
// VALUES (:image_name, :image_type, :image_content, :image_size, now())';
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
// $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
// $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
// $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
// $stmt->execute();
// }
// unset($pdo);
// header('Location:list.php');
// exit();
// }

// unset($pdo);
