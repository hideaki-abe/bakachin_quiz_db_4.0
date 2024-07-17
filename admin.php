<?php
session_start();
require 'db.php'; // データベース接続

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 0) {
    header('Location: index.php');
    exit;
}

// ユーザー情報とログイン情報の取得
$stmt = $pdo->query('
    SELECT users.id, users.username, users.email, users.password, users.role, user_logins.last_login, user_logins.login_count 
    FROM users 
    LEFT JOIN user_logins ON users.id = user_logins.user_id
');
$users = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        // ユーザー情報の更新処理
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $_POST['current_password'];
        $role = $_POST['role'];
        $id = $_POST['id'];

        $stmt = $pdo->prepare('UPDATE users SET username = :username, email = :email, password = :password, role = :role WHERE id = :id');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':role', $role, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>alert('情報を更新しました'); window.location = 'admin.php';</script>";
    } elseif (isset($_POST['delete'])) {
        // ユーザー情報の削除処理
        $id = $_POST['id'];
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>alert('アカウントを削除しました'); window.location = 'admin.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>管理画面</title>
    <link rel="stylesheet" href="style.css">
    <!-- Googleフォント読込 -->
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>

<body>
    <!-- ページのタイトル -->
    <h1>バカチン<span>★</span>PHPクイズDB ver4.0</h1>

    <!-- 管理画面コンテナ -->
    <div class="admin-container">
        <h2>ユーザー管理画面</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>パスワード</th>
                    <th>ロール</th>
                    <th>最終ログイン</th>
                    <th>ログイン回数</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <form method="post">
                            <td><?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><input type="text" name="username" value="<?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>" required></td>
                            <td><input type="email" name="email" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>" required></td>
                            <td><input type="password" name="password" placeholder="変更する場合のみ入力"></td>
                            <td>
                                <select name="role" required>
                                    <option value="0" <?php if ($user['role'] == 0) echo 'selected'; ?>>管理者</option>
                                    <option value="1" <?php if ($user['role'] == 1) echo 'selected'; ?>>一般ユーザー</option>
                                </select>
                            </td>
                            <td><?php echo htmlspecialchars($user['last_login'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($user['login_count'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="current_password" value="<?php echo htmlspecialchars($user['password'], ENT_QUOTES, 'UTF-8'); ?>">
                                <button type="submit" name="update">更新</button>
                                <button type="submit" name="delete" onclick="return confirm('本当に削除しますか？');">削除</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button onclick="window.location.href='index.php'">戻る</button>
    </div>
</body>

</html>