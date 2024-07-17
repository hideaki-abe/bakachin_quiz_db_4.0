<?php
require 'db.php'; // データベース接続

// スコア保存処理
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // スコアをデータベースに保存
    $stmt = $pdo->prepare('INSERT INTO scores (username, score) VALUES (:username, :score)');
    $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
    $stmt->bindValue(':score', $_POST['score'], PDO::PARAM_INT);
    $stmt->execute();
}