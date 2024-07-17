<?php
// データベース接続情報
$host = 'localhost'; // データベースのホスト名
$db = 'php_quiz';    // データベース名
$user = 'root';      // データベースユーザー名
$pass = '';          // データベースパスワード

// DSN (データソースネーム) の設定
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

// PDOオプションの設定
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // エラーモードを例外に設定
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // デフォルトのフェッチモードを連想配列に設定
    PDO::ATTR_EMULATE_PREPARES => false, // プリペアドステートメントのエミュレーションを無効化
];

// PDOインスタンスの作成
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}