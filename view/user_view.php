<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>World Beer Shop｜ユーザー管理</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/user.css">
    </head>
    <body>
        <h1>ユーザー管理ページ</h1>
        <a href="../html/admin.php">商品管理ページはこちら</a>
        <h2>ユーザー情報</h2>
        <table>
        <tr>
            <th>ユーザー名</th>
            <th>登録日</th>
        </tr>
        <?php foreach($users as $value) { ?>
        <tr>
            <td><?php print $value['username'];?></td>
            <td><?php print $value['createdate'];?></td>
        </tr>
        <?php } ?>
        </table>
    </body>
</html>