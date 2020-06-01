<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>購入完了ページ</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/beershop.css">
    </head>
    <body>
        <div id="wrapper">
        <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
        <main>
            <div class="cart_content">
                <h1 class="cart_title">購入商品</h1>
                <?php foreach($carts as $value) { ?>
                    <div class="cart_table">
                        <div>
                            <img class="img" src="<?php print $img_dir . $value['img']; ?>"></span>
                        </div>
                        <span><?php print h($value['name']); ?></span>
                        <span><?php print $value['price'] . "円"; ?></span>
                        <span><?php print $value['amount'] . "個"; ?></span>
                    </div>
                <?php } ?>
                <div class="buy-sum-box">
                    <span class="buy-sum-title">合計</span>
                    <!-- ここから入力 -->
                    <span class="buy-sum-price">
                        <?php print $total_price . "円"; ?>
                    </span>
                </div>
            </div>
            <?php if(!empty($beer_id) && !empty($amount) && $carts[0]['stock'] !== 0 && $carts[0]['stock'] >= $carts[0]['amount']) { ?>
                <div class="finish_message">
                    <h3>ご注文ありがとうございました！</h3>
                    <p>支払い方法：
                    <?php
                    if($pay === "1") {
                        print "代金引換";
                    } else if($pay === "2") {
                        print "クレジットカード";
                    } else if($pay === "3") {
                        print "コンビニエンスストアで支払い";
                    } else if($pay === "4") {
                        print "振込";
                    }
                    ?>
                    </p>
                    <p><?php print $email; ?>宛てにメールを送信しましたのでご確認くださいませ。</p>
                    <p>なお、商品は以下の住所に発送させていただきます。</p>
                    <p>〒<?php print $zipcode; ?></p>
                    <p><?php print h($addr1) . h($addr2); ?></p>
                </div>
            <?php } ?>
        </main>
        <footer>
            <p class="text"><small>Copyright &copy; Takahiro Koyama All Rights Reserved.</small></p>
        </footer>
        </div>
    </body>
</html>