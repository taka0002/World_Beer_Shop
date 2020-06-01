<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>購入手続きページ</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/beershop.css">
    </head>
    <body>
        <div id="wrapper">
            <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
            <main>
                <?php if(!empty($beer_id) && !empty($amount) && count($err_msg) === 0) { ?>
                    <div class="cart_content">
                        <form action="../html/finish.php" class="form" method="post">
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
                            <h1 class="cart_title">入力部分</h1>
                            <h2>住所</h2>
                            <div class="well">
                                <fieldset>
                                      <legend>お届け先</legend>
                                      <div class="form-group">
                                        <label for="name">お名前</label>
                                        <div>
                                          <?php print h($name1) . h($name2); ?>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="kana">お名前（フリガナ）</label>
                                        <div>
                                          <?php print h($kana1) . h($kana2); ?>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="zipcode">郵便番号</label>
                                        <div>
                                          <div class="input-group">
                                            <span class="input-group-addon">〒</span>
                                            <?php print $zipcode; ?>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                          <?php print h($addr1) . h($addr2); ?>
                                      </div>
                                      <div class="form-group">
                                        <label for="tel">電話番号</label>
                                          <div class="input-group">
                                            <?php print $tel; ?>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="email">メールアドレス</label>
                                        <div>
                                          <?php print $email; ?>
                                        </div>
                                      </div>
                                </fieldset>
                            </div>
                            <h2>支払い方法</h2>
                            <div class="select confirm">
                                <ul>
                                <li>
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
                                </li>
                                </ul>
                            </div>
                            <input class="buy-btn" type="submit" value="購入を確定する">
                            <?php foreach($carts as $value) { ?>
                                <input type="hidden" name="beer_id" value="<?php print $value['beer_id'] ?>">
                                <input type="hidden" name="amount" value="<?php print $value['amount'] ?>">
                            <?php } ?>
                            <input type="hidden" name="name1" value="<?php print $name1; ?>">
                            <input type="hidden" name="name2" value="<?php print $name2; ?>">
                            <input type="hidden" name="kana1" value="<?php print $kana1; ?>">
                            <input type="hidden" name="kana2" value="<?php print $kana2; ?>">
                            <input type="hidden" name="zipcode" value="<?php print $zipcode; ?>">
                            <input type="hidden" name="addr1" value="<?php print $addr1; ?>">
                            <input type="hidden" name="addr2" value="<?php print $addr2; ?>">
                            <input type="hidden" name="tel" value="<?php print $tel; ?>">
                            <input type="hidden" name="email" value="<?php print $email; ?>">
                            <input type="hidden" name="pay" value="<?php print $pay; ?>">
                            <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                        </form>
                        <form action="../html/cart_pay.php" method="post">
                            <!--戻るボタンを押したときに入力した部分がそのまま表示されるようにしたい（SESSIONを使う）-->
                            <div class="return">
                                <input class="buy-btn return_button" type="submit" value="入力画面に戻る">
                                <?php foreach($carts as $value) { ?>
                                    <input type="hidden" name="beer_id" value="<?php print $value['beer_id']; ?>">
                                    <input type="hidden" name="amount" value="<?php print $value['amount']; ?>">
                                <?php } ?>
                                <input type="hidden" name="name1" value="<?php print $name1; ?>">
                                <input type="hidden" name="name2" value="<?php print $name2; ?>">
                                <input type="hidden" name="kana1" value="<?php print $kana1; ?>">
                                <input type="hidden" name="kana2" value="<?php print $kana2; ?>">
                                <input type="hidden" name="zipcode" value="<?php print $zipcode; ?>">
                                <input type="hidden" name="addr1" value="<?php print $addr1; ?>">
                                <input type="hidden" name="addr2" value="<?php print $addr2; ?>">
                                <input type="hidden" name="tel" value="<?php print $tel; ?>">
                                <input type="hidden" name="email" value="<?php print $email; ?>">
                                <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                            </div>
                        </form>
                    </div>
                <?php } else { ?>
                    <div class="err_msg">
                        <?php foreach($err_msg as $value) { ?>
                        <ul>
                            <li><?php print $value; ?></li>
                        </ul>
                        <?php } ?>
                        <form action="../html/cart_pay.php" method="post">
                            <!--戻るボタンを押したときに入力した部分がそのまま表示されるようにしたい（SESSIONを使う）-->
                            <div class="return">
                                <input class="buy-btn return_button" type="submit" value="入力画面に戻る">
                                <?php foreach($carts as $value) { ?>
                                    <input type="hidden" name="beer_id" value="<?php print $value['beer_id']; ?>">
                                    <input type="hidden" name="amount" value="<?php print $value['amount']; ?>">
                                <?php } ?>
                                <input type="hidden" name="name1" value="<?php print $name1; ?>">
                                <input type="hidden" name="name2" value="<?php print $name2; ?>">
                                <input type="hidden" name="kana1" value="<?php print $kana1; ?>">
                                <input type="hidden" name="kana2" value="<?php print $kana2; ?>">
                                <input type="hidden" name="zipcode" value="<?php print $zipcode; ?>">
                                <input type="hidden" name="addr1" value="<?php print $addr1; ?>">
                                <input type="hidden" name="addr2" value="<?php print $addr2; ?>">
                                <input type="hidden" name="tel" value="<?php print $tel; ?>">
                                <input type="hidden" name="email" value="<?php print $email; ?>">
                                <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
            </main>
            <footer>
                <p class="text"><small>Copyright &copy; Takahiro Koyama All Rights Reserved.</small></p>
            </footer>
        </div>
    </body>
</html>