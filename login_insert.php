<?php
session_start();

//ログインデータ取得
$user_name = $_POST['user_name'];
$psw = $_POST['psw'];

// データベース接続
require_once('common.php');
$pdo = connect_db();


// データ取得 SQL準備&実行
$sql = 'SELECT * FROM users_table WHERE username=:user_name AND password=:psw';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':psw', $psw, PDO::PARAM_STR);
$status = $stmt->execute();


// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}


// 抽出データ数を取得
$val = $stmt->fetch();

// 該当レコードがあればSESSIONに値を代入
if ($val["id"] != "") {
    $_SESSION["chk_ssid"] = session_id();
    $_SESSION["username"] = $val["user_name"];
    $_SESSION["password"] = $val["psw"];
    // 正常にSQLが実行された場合
    header('Location:member.php');
} else {
    // NGの場合
    header('Location:login.php');
}

// 処理を終了する
exit();

// // ログイン認証ファイルを読込
// require_once('auth.php');

// // エラーメッセージ初期化
// $errorMessage = "";
// // ログイン処理
// if ($_POST['mode'] == "login") {
//     if (!empty($_POST['user_name']) && !empty($_POST['psw'])) {
//         if ($account = login($_POST['user_name'], $_POST['psw'])) {
//             $_SESSION['account'] = $account;
//             header("Location: ./login.php");
//             // ログイン失敗時の表示
//         } else {
//             $errorMessage = "ログインに失敗しました。";
//         }
//     } else {
//         $errorMessage = "ユーザーネームとパスワードを入力してください。";
//     }
// }
