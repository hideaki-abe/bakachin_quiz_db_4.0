<?php
require 'db.php'; // データベース接続

// スコアの読み込みとソート
$stmt = $pdo->query('SELECT * FROM scores ORDER BY score DESC');
$scores = $stmt->fetchAll();
?>
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

    <!-- ランキングコンテナ -->
    <div class="ranking-container">
        <h2>歴代ランキング</h2>
        <table>
            <thead>
                <tr>
                    <th>日時</th>
                    <th>ユーザー名</th>
                    <th>スコア</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($scores as $score) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($score['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($score['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($score['score'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="ranking-link">ホームに戻る</a>
    </div>
</body>

</html>