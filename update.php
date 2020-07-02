<?php

// 送信データのチェック 画像ファイルは？
// var_dump($_POST);
// exit();

// 関数ファイルの読み込み
//先に共通処理を読込んであげないといけない
//requireではファイル読込に失敗した場合、エラーとしてその先の処理を停止する
require 'common.php';

// 送信データ受け取り
//更新update.phpのformは登録と同じくpostで各値を送信している
// var_dump($_FILES['img_file']);
// exit();
$id = $_POST['id'];
// $img_file = $_FILES['img_file'];
$title = $_POST['title'];
$honbun = $_POST['honbun'];
$hizuke = $_POST['hizuke'];

// DB接続
$pdo = connect_db();

// UPDATE文を作成&実行
//DBに入れるそれぞれの値をつなげる
$sql = "UPDATE 06kadai_table SET title=:title, hizuke=:hizuke, honbun=:honbun, 
updated_at=sysdate() WHERE id=:id";
// $sql = "UPDATE 06kadai_table SET img_file=:img_file, title=:title, hizuke=:hizuke, honbun=:honbun, 
// updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
//$stmt->bindValue(':img_file', $img_file, PDO::PARAM_STR); //値が文字列
$stmt->bindValue(':title', $title, PDO::PARAM_STR); //値が文字列
$stmt->bindValue(':hizuke', $hizuke, PDO::PARAM_STR); //値が文字列
$stmt->bindValue(':honbun', $honbun, PDO::PARAM_STR); //値が文字列
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
