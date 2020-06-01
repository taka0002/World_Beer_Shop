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
                <?php if(!empty($beer_id) && !empty($amount) && count($msg) === 0) { ?>
                    <div class="cart_content">
                        <form action="../html/cart_confirm.php" class="form" method="post">
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
                                <span class="buy-sum-price">
                                    <?php print $total_price . "円"; ?>
                                </span>
                            </div>
                            <h1 class="cart_title">入力部分</h1>
                            <p class="required">（すべてご記入ください）</p>
                            <div class="well">
                                <fieldset>
                                      <legend>お届け先</legend>
                                      <div class="form-group">
                                        <label for="name">お名前</label>
                                        <div>
                                          <input type="text" name="name1" id="name1" class="form-control border_responsive" placeholder="姓" value="<?php print $name1; ?>" required>
                                        </div>
                                        <div>
                                          <input type="text" name="name2" id="name2" class="form-control border_responsive" placeholder="名" value="<?php print $name2; ?>" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="kana">お名前（フリガナ）</label>
                                        <div>
                                          <input type="text" name="kana1" id="kana1" class="form-control border_responsive" placeholder="セイ" value="<?php print $kana1; ?>" required>
                                        </div>
                                        <div>
                                          <input type="text" name="kana2" id="kana2" class="form-control border_responsive" placeholder="メイ" value="<?php print $kana2; ?>" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="zipcode">郵便番号</label>
                                        <div>
                                          <div class="input-group">
                                            <span class="input-group-addon">〒</span>
                                            <input type="text" name="zipcode" id="zipcode" class="form-control border_responsive" placeholder="000-0000" value="<?php print $zipcode; ?>" required>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div>
                                          <input type="text" name="addr1" id="addr1" class="form-control border_responsivel" placeholder="都道府県市区町村名" value="<?php print $addr1; ?>" required>
                                          <p class="help-block">住所は2つに分けてご記入ください。</p>
                                          <input type="text" name="addr2" id="addr2" class="form-control border_responsive" placeholder="番地・アパート名" value="<?php print $addr2; ?>" required>
                                          <p class="help-block">番地・アパート名は必ず記入してください。</p>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="tel">電話番号（ハイフンなし）</label>
                                        <div>
                                          <div class="input-group">
                                            <input type="tel" name="tel" id="tel" class="form-control border_responsive" placeholder="08012345678" value="<?php print $tel; ?>" required>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="email">メールアドレス</label>
                                        <div>
                                          <input type="email" name="email" id="email" class="form-control border_responsive" placeholder="メールアドレスを入力してください" value="<?php print $email; ?>" required>
                                        </div>
                                      </div>
                                </fieldset>
                            </div>
                            <h2>支払い方法</h2>
                            <div class="select">
                                <div>
                                    <span><input type="radio" name="pay" value="1" required>代金引換</span>
                                </div>
                                <div>
                                    <span><input type="radio" name="pay" value="2">クレジットカード</span>
                                </div>
                                <div>
                                    <span><input type="radio" name="pay" value="3">コンビニエンスストアで支払い</span>
                                </div>
                                <div>
                                    <span><input type="radio" name="pay" value="4">振込</span>
                                </div>
                            </div>
                            <input class="buy-btn" type="submit" value="購入する">
                            <?php foreach($carts as $value) { ?>
                                <input type="hidden" name="beer_id" value="<?php print $value['beer_id']; ?>">
                                <input type="hidden" name="amount" value="<?php print $value['amount']; ?>">
                            <?php } ?>
                            <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
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