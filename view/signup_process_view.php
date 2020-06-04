<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>登録完了画面</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/common.css">
        <link rel="stylesheet" href="../html/assets/css/signup.css">
        <link rel="stylesheet" href="../html/assets/css/login.css">
        <link rel="stylesheet" href="../html/assets/css/responsive.css">
        <style>
        </style>
    </head>
    <body>
        <header>
            <div class="header_box">
                <a href="./top.php">World Beer Shop</a>
            </div>
        </header>
        <div class="content">
            <div id="login">
                <?php foreach(get_messages() as $message){ ?>
                  <p class="complete_text"><?php print $message; ?></p>
                <?php } ?>
                <div class="complete_buton">
                    <?php if(preg_match(REGEXP_ALPHANUMERIC_user_name, $user_name) && preg_match(REGEXP_ALPHANUMERIC_pass_word, $pass_word)) { ?>
                        <a href="login.php">ログインページへ</a>
                    <?php } else { ?>
                        <a href="signup.php">新規登録ページへ戻る</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>