<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>World Beer Shop｜購入明細</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/user.css">
        <?php include VIEW_PATH . 'templates/header_bootstrap.php'; ?>
    </head>
    <body>
        <h1>購入明細ページ</h1>
        <p><a href="../html/admin.php">商品管理ページはこちら</a></p>
        <p><a href="../html/user.php">ユーザー管理ページはこちら</a></p>
        <p><a href="./index.php">トップページへ戻る</a></p>
        <div class="container">
            <h2>ユーザー情報</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>郵便番号</th>
                            <th>住所</th>
                            <th>電話番号</th>
                            <th>メールアドレス</th>
                            <th>支払い方法</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php print $zipcode;?></td>
                            <td><?php print h($addr1) . h($addr2);?></td>
                            <td><?php print $tel;?></td>
                            <td><?php print $email;?></td>
                            <td>
                            <?php if($pay === "1") {
                                print "代金引換";
                            } else if($pay === "2") {
                                print "クレジット";
                            } else if($pay === "3") {
                                print "コンビニ";
                            } else if($pay === "4") {
                                print "振込";
                            }
                            ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h2>購入情報一覧</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>商品名</th>
                            <th>金額</th>
                            <th>購入数</th>
                            <th>小計</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($get_customer_history_detail as $value) { ?>
                            <tr>
                                <td><?php print h($value['name']);?></td>
                                <td><?php print $value['price'];?></td>
                                <td><?php print $value['amount'];?></td>
                                <td><?php print $value['price'] * $value['amount'];?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <p class="customer_total_price">合計金額：<span><?php print $customer_total_price; ?></span>円</p>
            <p><a href="../html/customer_history.php">購入者情報ページに戻る</a></p>
        </div>
    </body>
</html>