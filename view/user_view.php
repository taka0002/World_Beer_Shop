<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>World Beer Shop｜ユーザー管理</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <?php include VIEW_PATH . 'templates/header_bootstrap.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/user.css">
    </head>
    <body>
        <h1>ユーザー管理ページ</h1>
        <p><a href="../html/admin.php">商品管理ページはこちら</a></p>
        <p><a href="../html/customer_history.php">購入者情報ページはこちら</a></p>
        <h2>ユーザー情報</h2>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ユーザー名</th>
                            <th>登録日</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $value) { ?>
                        <tr>
                            <td><?php print $value['username'];?></td>
                            <td><?php print $value['createdate'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>