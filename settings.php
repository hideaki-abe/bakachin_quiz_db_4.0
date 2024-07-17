<?php
session_start();
require 'db.php'; // データベース接続

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 1) {
    header('Location: index.php');
    exit;
}

$user_email = $_SESSION['email'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
$stmt->bindValue(':email', $user_email, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        // ユーザー情報の更新処理
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];

        $stmt = $pdo->prepare('UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':id', $user['id'], PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        echo "<script>alert('情報を更新しました'); window.location = 'settings.php';</script>";
    } elseif (isset($_POST['delete'])) {
        // ユーザー情報の削除処理
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
        $stmt->bindValue(':id', $user['id'], PDO::PARAM_INT);
        $stmt->execute();
        session_destroy();
        echo "<script>alert('アカウントを削除しました'); window.location = 'index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ユーザー設定</title>
    <link rel="stylesheet" href="style.css">
    <!-- Googleフォント読込 -->
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>

<body>
    <!-- ページのタイトル -->
    <h1>バカチン<span>★</span>PHPクイズ ver4.0</h1>

    <!-- ユーザー設定コンテナ -->
    <div class="settings-container">
        <h2>ユーザー設定</h2>
        <form method="post">
            ユーザー名: <input type="text" name="username" value="<?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>" required>
            メールアドレス: <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
            パスワード: <input type="password" name="password" placeholder="変更する場合のみ入力">
            <button type="submit" name="update">更新</button>
            <button class=delete-button type="submit" name="delete" onclick="return confirm('本当に削除しますか？');">削除</button>
        </form>
        <button onclick="window.location.href='quiz.php'">戻る</button>
    </div>
</body>

</html>