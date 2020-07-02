<?php

// 送信データのチェック 画像ファイルは？
// var_dump($_POST);
// exit();


// 送信データ受取り
//更新update.phpのformは登録と同じくpostで各値を送信している
// exit();
$id = $_POST['id'];
$user_name = $_POST['user_name'];
$psw = $_POST['psw'];
// var_dump($_POST['psw']);
// exit(); OK!

// 関数ファイルの読み込み
//先に共通処理を読込んであげないといけない
//requireではファイル読込に失敗した場合、エラーとしてその先の処理を停止する
require 'common.php';

// DB接続
$pdo = connect_db();

// UPDATE文を作成&実行
//DBに入れるそれぞれの値をつなげる
$sql = "UPDATE users_table SET username=:user_name, password=:psw, 
updated_at=sysdate() WHERE id=:id";


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR); //値が文字列
$stmt->bindValue(':psw', $psw, PDO::PARAM_STR); //値が文字列
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //値が数値
$status = $stmt->execute();



// 各値をpostで受け取る 
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する 
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常に実行された場合は一覧ページファイルに移動，処理を実行する 
    header("Location:select.php");
    exit();
}
