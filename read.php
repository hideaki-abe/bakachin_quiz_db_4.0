<?php
require 'db.php'; // データベース接続
session_start();

// ログイン処理
if ($_POST['action'] == 'login' && !empty($_POST['email']) && !empty($_POST['password'])) {
    // ユーザー情報をデータベースから取得
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();

    // パスワードの検証
    if ($user && password_verify($_POST['password'], $user['password'])) {
        // ログイン成功時、セッションにユーザー情報を保存
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        // ログイン情報を更新または挿入
        $stmt = $pdo->prepare('SELECT * FROM user_logins WHERE user_id = :user_id');
        $stmt->bindValue(':user_id', $user['id'], PDO::PARAM_INT);
        $stmt->execute();
        $login = $stmt->fetch();

        if ($login) {
            // 既存のログイン情報を更新
            $stmt = $pdo->prepare('UPDATE user_logins SET last_login = NOW(), login_count = login_count + 1 WHERE user_id = :user_id');
            $stmt->bindValue(':user_id', $user['id'], PDO::PARAM_INT);
        } else {
            // 新しいログイン情報を挿入
            $stmt = $pdo->prepare('INSERT INTO user_logins (user_id, last_login, login_count) VALUES (:user_id, NOW(), 1)');
            $stmt->bindValue(':user_id', $user['id'], PDO::PARAM_INT);
        }
        $stmt->execute();

        if ($user['role'] == 0) {
            echo "<script>window.location = 'admin.php';</script>"; // 管理者の場合
        } else {
            echo "<script>window.location = 'quiz.php';</script>"; // 一般ユーザーの場合
        }
    } else {
        echo "ログイン失敗：無効なユーザー名またはパスワード。";
    }
}