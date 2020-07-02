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




// データベースの処理 insert
/* @param string $sql
 * @param array $arr
 * @return int lastInsertId
 * 最終行のIDを取得、その後に挿入*/

function insert($sql, $arr = [])
{
    $pdo = connect_db();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);
    return $pdo->lastInsertId(); //最終行のIDを取得
}

/**
 * select
 * @param string $sql
 * @param array $arr
 * @return array $rows
 */
// function select($sql, $arr = [])
// {
//     $pdo = connect_db();
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute($arr);
//     //配列を作成して取り出す？
//     return $stmt->fetchAll();
// }

/**
 * htmlspecialchars
 * @param string $string
 * @return $string
 */
function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}
