<?php
//全ファイル共通の処理をまとめる

//データベースに接続
function connect_db()
{

    //$dbn = 'mysql:dbname=gsacf_d06_34;charset=utf8;port=3306;host=localhost';
    $dsn = 'mysql:host=localhost;dbname=gsacf_d06_34;charset=utf8';
    $username = 'root';
    $password = '';
    $options = [
        //error report PDO::ERRMODE_EXCEPTION 例外を投げる
        //FETCH_MODE 配列の形式を指定するモード PDO::ATTR_DEFAULT_FETCH_MODE デフォルトの設定 PDO::FETCH_ASSOC カラム名の配列を返す
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    return new PDO($dsn, $username, $password, $options);
}
