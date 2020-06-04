<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>ログアウト画面</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/common.css">
        <link rel="stylesheet" href="../html/assets/css/logout.css">
        <link rel="stylesheet" href="../html/assets/css/login.css">
        <link rel="stylesheet" href="../html/assets/css/responsive.css">
        <style>
        </style>
    </head>
    <body>
        <?php include VIEW_PATH . 'templates/header.php'; ?>
        <div class="content">
            <div id="login">
                <p class="logout_text">ログアウトしました</p>
                <div class="logout_buton">
                <a href="../html/login.php">再度ログインページへ</a>
                </div>
            </div>
        </div>
    </body>
</html>