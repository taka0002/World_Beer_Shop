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
        <h2>ユーザー情報</h2>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ユーザー名</th>
                            <th>名前</th>
                            <th>名前（フリガナ）</th>
                            <th>郵便番号</th>
                            <th>住所</th>
                            <th>電話番号</th>
                            <th>メールアドレス</th>
                            <th>支払い方法</th>
                            <th>購入日</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($customer_history as $value) { ?>
                        <tr>
                            <td><?php print $value['username'];?></td>
                            <td><?php print h($value['name1']) . h($value['name2']);?></td>
                            <td><?php print h($value['kana1']) . h($value['kana2']);?></td>
                            <td><?php print $value['zipcode'];?></td>
                            <td><?php print h($value['addr1']) . h($value['addr2']);?></td>
                            <td><?php print $value['tel'];?></td>
                            <td><?php print $value['email'];?></td>
                            <td>
                            <?php if($value['pay'] === 1) {
                                print "代金引換";
                            } else if($value['pay'] === 2) {
                                print "クレジット";
                            } else if($value['pay'] === 3) {
                                print "コンビニ";
                            } else if($value['pay'] === 4) {
                                print "振込";
                            }
                            ?>
                            </td>
                            <td><?php print $value['create_datetime'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>