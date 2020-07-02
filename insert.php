<?php
//データ送信されているかチェック
// var_dump($_POST);
// exit();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
    !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
    !isset($_POST['psw']) || $_POST['psw'] == ''
) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}
// 送信データ $_POSTで受取
// 更新update.phpのformも登録と同じくpostで各値を送信している
$user_name = $_POST['user_name'];
$psw = $_POST['psw'];

//共通関数の読込
require 'common.php';

// DB接続
$pdo = connect_db();



// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO users_table(id, username, password, is_admin, is_deleted, created_at, updated_at) VALUES(NULL, :user_name, :psw, 1, 0, sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR); //値が文字列
$stmt->bindValue(':psw', $psw, PDO::PARAM_STR); //値が文字列
$status = $stmt->execute();


// 各値をpostで受け取る 
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する 
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常に実行された場合は一覧ページファイルに移動，処理を実行する 
    header("Location:index.php");
    exit();
}
