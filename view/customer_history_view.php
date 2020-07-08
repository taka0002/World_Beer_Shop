<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>World Beer Shop｜購入者情報</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/user.css">
        <?php include VIEW_PATH . 'templates/header_bootstrap.php'; ?>
    </head>
    <body>
        <h1>購入者情報ページ</h1>
        <p><a href="../html/admin.php">商品管理ページはこちら</a></p>
        <p><a href="../html/user.php">ユーザー管理ページはこちら</a></p>
        <div class="container">
            <h2>ユーザー情報</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ユーザー名</th>
                            <th>名前</th>
                            <th>名前（フリガナ）</th>
                            <th>購入日</th>
                            <th>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($customer_history as $value) { ?>
                        <form method="post" action="./customer_history_detail.php">
                            <tr>
                                <td><?php print $value['username'];?></td>
                                <td><?php print h($value['name1']) . h($value['name2']);?></td>
                                <td><?php print h($value['kana1']) . h($value['kana2']);?></td>
                                <td><?php print $value['create_datetime'];?></td>
                                <td><input class="btn btn-block btn-primary" type="submit" value="詳細はこちら"></td>
                            </tr>
                            <input type="hidden" name="history_id" value="<?php print($value['history_id']); ?>">
                            <input type="hidden" name="zipcode" value="<?php print($value['zipcode']); ?>">
                            <input type="hidden" name="addr1" value="<?php print($value['addr1']); ?>">
                            <input type="hidden" name="addr2" value="<?php print($value['addr2']); ?>">
                            <input type="hidden" name="tel" value="<?php print($value['tel']); ?>">
                            <input type="hidden" name="email" value="<?php print($value['email']); ?>">
                            <input type="hidden" name="pay" value="<?php print($value['pay']); ?>">
                            <input type="hidden" name="create_datetime" value="<?php print($value['create_datetime']); ?>">
                        </form>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
