<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>ログイン画面</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/common.css">
        <link rel="stylesheet" href="../html/assets/css/login.css">
        <link rel="stylesheet" href="../html/assets/css/responsive.css">
        <link rel="stylesheet" href="../html/assets/css/signup.css">
        <style>
        </style>
    </head>
    <body>
        <?php include VIEW_PATH . 'templates/header.php'; ?>
        <div class="bg-slider">
          <h1 class="bg-slider__title"></h1>
        </div>
        <div class="content">
            <div id="login">
                <?php foreach($msg as $value) { ?>
                    <p class="complete_text"><?php print $value; ?></p>
                <?php } ?>
                <form method="post" action="../html/login_process.php">
                <div class="user_name">
                    <input type="text" name="user_name" placeholder="ユーザー名">
                </div>
                <div class="password">
                    <input type="password" name="password" placeholder="パスワード">
                </div>
                <div>
                    <input type="submit" value="ログイン" class="button">
                </div>
                <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                </form>
                <div class="new_button">
                    <a href="../html/signup.php">新規追加</a>
                </div>
            </div>
        </div>
    </body>
</html>