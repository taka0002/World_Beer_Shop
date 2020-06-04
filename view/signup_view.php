<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>新規登録画面</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/common.css">
        <link rel="stylesheet" href="../html/assets/css/signup.css">
        <link rel="stylesheet" href="../html/assets/css/login.css">
        <link rel="stylesheet" href="../html/assets/css/responsive.css">
        <style>
        </style>
    </head>
    <body>
        <?php include VIEW_PATH . 'templates/header.php'; ?>
        <div class="content">
            <div id="login">
                <form action="../html/signup_process.php" method="post">
                    <div class="user_name">
                        <input type="text" name="username" placeholder="ユーザー名">
                    </div>
                    <div class="password">
                        <input type="password" name="password" placeholder="パスワード">
                    </div>
                    <div>
                        <input type="submit" value="新規登録" class="button">
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                </form>
            </div>
        </div>
    </body>
</html>