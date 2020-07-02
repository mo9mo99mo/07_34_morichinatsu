<?php
//データ送信されているかチェック
// var_dump($_POST);
// exit();
//
//本文を出力
//var_dump($_POST['honbun']);
//
//受け取った画像ファイルの情報を出力
//var_dump($_FILES);
// echo $_FILES['img_file']['tmp_name']; //inputから送信された一時ファイル名
// echo $_FILES['img_file']['name']; // file name 本来のファイル名
// echo $_FILES['img_file']['type']; //file type ファイルの拡張子
// echo $_FILES['img_file']['size']; //file size ファイルサイズ
// echo $_FILES['img_file']['error']; //file error
//
// if ($_FILES['img_file']['name']) {
//     //faile name
//     echo $_FILES['img_file']['name'];
// }
//
//
//項目入力のチェック
//値が存在しないor空で送信されてきた場合はNGにする
// if (
//     !isset($_FILES['img_file']) || $_FILES['img_file'] == '' ||
//     !isset($_POST['date']) || $_POST['date'] == '' ||
//     !isset($_POST['title']) || $_POST['title'] == ''
// ) {
//     exit('ParamError：必須項目が入力されていない、もしくは空です');
// }
//
// 受け取ったデータを変数に入れる
// $img_file = $_FILES['img_file'];
// $date = $_POST['date'];
// $title = $_POST['title'];
// $honbun = $_POST['honbun'];

////////////////////////////////////////////////////////////////////////
// common.phpで処理する部分
////////////////////////////////////////////////////////////////////////
//データベースに接続
// $dbn = 'mysql:dbname=gsacf_d06_34;charset=utf8;port=3306;host=localhost';
// $user = 'root';
// $pwd = '';

// try {
//     // ここでDB接続処理を実行する
//     $pdo = new PDO($dbn, $user, $pwd);
// } catch (PDOException $e) {
//     // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
//     echo json_encode(["db error" => "{$e->getMessage()}"]); //getMessage SQLからエラー文を取出して表示
//     exit();
// }
//
// データ登録SQL作成
// `updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力
//$sql = '';
//
// SQL準備&実行
//$sql = 'INSERT INTO 06kadai_table(id, title, date, img_file, honbun, updated_at) VALUES(NULL, :title, :date, :img_file, :honbun, sysdate())';
///////////////////////////////////////////////////////////////////////////////////////////////


//共通関数の読込
//requireの呼び出しではファイル読込に失敗した場合はエラーでその先の処理を停止する

require 'common.php';

//画像をuploadsフォルダへアップロード
//画像情報とテキスト情報をDBに保存
function file_upload()
{
    // POSTではないとき何もしない
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
        return;
    }

    //日付
    $hizuke = filter_input(INPUT_POST, 'hizuke');

    // タイトル
    $title = filter_input(INPUT_POST, 'title');
    // if ('' === $title) {
    // throw new Exception('タイトルは入力必須です。');
    // }

    //本文
    $honbun = filter_input(INPUT_POST, 'honbun');

    // 画像アップロードファイル
    $img_file = $_FILES['img_file'];
    //参照 http://php.net/manual/ja/features.file-upload.post-method.php

    if ($img_file['error'] > 0) {
        throw new Exception('ファイルアップロードに失敗しました。');
    }

    $tmp_name = $img_file['tmp_name'];

    // ファイル拡張子をチェック
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimetype = finfo_file($finfo, $tmp_name); //ファイルについての情報を返す

    // 許可するMIMETYPE
    $allowed_types = [
        'jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'
    ];
    if (!in_array($mimetype, $allowed_types)) {
        throw new Exception('許可されていない拡張子のファイルです。');
    }

    // アップロード後のファイル名の処理
    //（ハッシュ値でファイル名を決定するため、同一ファイルは同名で上書きされる）
    $filename = sha1_file($tmp_name);

    // 拡張子
    $ext = array_search($mimetype, $allowed_types);

    // 画像保存先のパス
    $destination = sprintf(
        '%s/%s.%s',
        'uploads',
        $filename,
        $ext
    );

    // アップロードディレクトリに移動
    if (!move_uploaded_file($tmp_name, $destination)) {
        throw new Exception('ファイルの保存に失敗しました。');
    }

    // // Exif 情報を削除
    // $imagick = new Imagick($destination);
    // $imagick->stripimage();
    // $imagick->writeimage($destination);

    // データベースに登録
    $sql = 'INSERT INTO `06kadai_table` (`id`, `title`, `hizuke`, `img_file`, `honbun`, `updated_at`) VALUES (NULL, :title, :hizuke, :img_file, :honbun, sysdate())';
    $arr = [];
    $arr[':title'] = $title;
    $arr[':hizuke'] = $hizuke;
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
