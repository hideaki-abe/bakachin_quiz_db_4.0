<?php
require 'db.php'; // データベース接続

// 新規登録処理
if ($_POST['action'] == 'register' && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // パスワードをハッシュ化
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // 新規ユーザーをデータベースに挿入
    $stmt = $pdo->prepare('INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)');
    $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
    $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':role', 1, PDO::PARAM_INT); // デフォルトで一般ユーザー
    $stmt->execute();

    // セッションを開始し、ユーザー情報を保存
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['role'] = 1;

    // クイズページにリダイレクト
    echo "<script>window.location = 'quiz.php';</script>";
}