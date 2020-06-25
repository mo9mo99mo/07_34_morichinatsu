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
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    return new PDO($dsn, $username, $password, $options);
}

// データベースの処理 insert
/* @param string $sql
 * @param array $arr
 * @return int lastInsertId
 * 最終行のIDを取得*/

function insert($sql, $arr = [])
{
    $pdo = connect_db();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);
    return $pdo->lastInsertId();
}

/**
 * select
 * @param string $sql
 * @param array $arr
 * @return array $rows
 */
function select($sql, $arr = [])
{
    $pdo = connect_db();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);
    return $stmt->fetchAll();
}

/**
 * htmlspecialchars
 * @param string $string
 * @return $string
 */
function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}
