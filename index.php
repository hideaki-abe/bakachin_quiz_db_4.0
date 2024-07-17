<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>バカチン★PHPクイズDB</title>
    <link rel="stylesheet" href="style.css">
    <!-- Googleフォント読込 -->
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>

<body>
    <!-- ページのタイトル -->
    <h1>バカチン<span>★</span>PHPクイズDB ver4.0</h1>

    <!-- 新規登録とログインフォーム -->
    <div class="form-container">
        <h2>新規登録</h2>
        <form action="create.php" method="post">
            ユーザー名: <input type="text" name="username" required>
            メールアドレス: <input type="email" name="email" required>
            パスワード: <input type="password" name="password" required>
            <button type="submit" name="action" value="register">登録</button>
        </form>

        <h2>ログイン</h2>
        <form action="read.php" method="post">
            メールアドレス: <input type="email" name="email" required>
            パスワード: <input type="password" name="password" required>
            <button type="submit" name="action" value="login">ログイン</button>
        </form>
    </div>
</body>

</html>