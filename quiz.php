<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: index.php');
    exit;
}
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

    <!-- クイズコンテナ -->
    <div class="quiz-container">
        <h2 id="question">クイズ問題</h2>
        <ul>
            <li><label><input type="radio" name="answer" class="answer" id="a"> <span id="a_text">質問</span></label></li>
            <li><label><input type="radio" name="answer" class="answer" id="b"> <span id="b_text">質問</span></label></li>
            <li><label><input type="radio" name="answer" class="answer" id="c"> <span id="c_text">質問</span></label></li>
        </ul>
        <button id="submit">送信</button>
        <button class="logout-button" onclick="window.location.href='logout.php'">ログアウト</button>
        <button class="settings-button" onclick="window.location.href='settings.php'">ユーザー設定</button>
    </div>

    <script>
        // JavaScriptでクイズを管理
        document.addEventListener('DOMContentLoaded', function() {
            // PHPに関連するクイズデータ
            const quizData = [{
                    question: "PHPで文字列を出力するための関数はどれですか？",
                    a: "echo",
                    b: "print_r",
                    c: "include",
                    correct: "a"
                },
                {
                    question: "PHPの略称は何ですか？",
                    a: "Personal Hypertext Processor",
                    b: "Private Home Page",
                    c: "PHP: Hypertext Preprocessor",
                    correct: "c"
                },
                {
                    question: "PHPの最新バージョンはどれですか？（2024年7月現在）",
                    a: "7.4",
                    b: "9.2",
                    c: "8.3",
                    correct: "c"
                },
                {
                    question: "PHPで変数を宣言するための正しい方法はどれですか？",
                    a: "$変数名",
                    b: "var 変数名",
                    c: "let 変数名",
                    correct: "a"
                },
                {
                    question: "PHPで配列を作成する関数はどれですか？",
                    a: "create_array()",
                    b: "array()",
                    c: "new Array()",
                    correct: "b"
                }
            ];
            let currentQuiz = 0;
            let score = 0;

            // クイズ要素の取得
            const questionEl = document.getElementById('question');
            const a_text = document.getElementById('a_text');
            const b_text = document.getElementById('b_text');
            const c_text = document.getElementById('c_text');
            const submitBtn = document.getElementById('submit');

            // クイズを読み込む関数
            function loadQuiz() {
                const currentQuizData = quizData[currentQuiz];
                questionEl.textContent = currentQuizData.question;
                a_text.textContent = currentQuizData.a;
                b_text.textContent = currentQuizData.b;
                c_text.textContent = currentQuizData.c;
            }

            // 回答を送信するイベントリスナー
            submitBtn.addEventListener('click', () => {
                const answers = document.querySelectorAll('.answer');
                let answer = '';
                answers.forEach((ans) => {
                    if (ans.checked) {
                        answer = ans.id;
                        ans.checked = false;
                    }
                });

                if (answer) {
                    if (answer === quizData[currentQuiz].correct) {
                        score++;
                    }
                    currentQuiz++;
                    if (currentQuiz < quizData.length) {
                        loadQuiz();
                    } else {
                        // スコアを保存し、結果を表示
                        const username = "<?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>";
                        const data = new FormData();
                        data.append('username', username);
                        data.append('score', score);
                        fetch('save_score.php', {
                            method: 'POST',
                            body: data
                        }).then(response => response.text()).then(result => {
                            document.querySelector('.quiz-container').innerHTML = `<h2>あなたのスコアは${score}/${quizData.length}です。</h2><button onclick="location.reload()">リトライ</button><a href="ranking.php" class="ranking-link">ランキングを見る</a>`;
                        });
                    }
                }
            });

            loadQuiz();
        });
    </script>
</body>

</html>