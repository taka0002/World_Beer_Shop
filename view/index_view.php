<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>World Beer Shop｜トップ</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/common.css">
        <link rel="stylesheet" href="../html/assets/css/index.css">
        <link rel="stylesheet" href="../html/assets/css/responsive.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../html/assets/js/top.js"></script>
        <script type="text/javascript" src="../html/assets/js/popup.js"></script>
    </head>
    <body>
        <div id="wrapper">
        <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
        <main>
            <div class="slider">
                <img id="mypic" src="../html/assets/img/beer1.jpg" alt="ビール">
            </div>
            <div id="flex_featured">
                <h2>注目アイテム一覧</h2>
                <ul class="featured">
                        <?php foreach($items as $value) { ?>
                            <?php if((int)$value['status'] === 1 && (int)$value['featured'] === 1 && (int)$value['stock'] >= 1) { ?>
                            <li class="item">
                                <div class="drink_featured">
                                    <button class="item_description">
                                        <img class="item_img" src="<?php print $img_dir . $value['img']; ?>">
                                    </button>
                                    <span class="featured_name"><?php print h($value['name']); ?></span>
                                    <input type='hidden' name="stock" value="<?php print $value['stock']; ?>">
                                    
                                    <!--ポップアップ時の処理-->
                                    <div class="popup">
                                        <div class="popup_content">
                                            <img class="item_img" src="<?php print $img_dir . $value['img']; ?>">
                                            <div class="scroll">
                                                <span>キレ：
                                                <?php if((int)$value['type_sharp'] === 0) { ; 
                                                    print 'ちょっと物足りないかも…';
                                                } else if((int)$value['type_sharp'] === 1) {
                                                    print 'なかなかよき…';
                                                } else {
                                                    print 'もう最高';
                                                } ?>
                                                </span>
                                                <span>酸味：
                                                <?php if((int)$value['type_acidity'] === 0) { ; 
                                                    print 'ちょっと物足りないかも…';
                                                } else if((int)$value['type_acidity'] === 1) {
                                                    print 'なかなかよき…';
                                                } else {
                                                    print 'もう最高';
                                                } ?>
                                                </span>
                                                <span>苦味：
                                                <?php if((int)$value['type_bitterness'] === 0) { ; 
                                                    print 'ちょっと物足りないかも…';
                                                } else if((int)$value['type_bitterness'] === 1) {
                                                    print 'なかなかよき…';
                                                } else {
                                                    print 'もう最高';
                                                } ?>
                                                </span>
                                                <span>甘み：
                                                <?php if((int)$value['type_sweetness'] === 0) { ; 
                                                    print 'ちょっと物足りないかも…';
                                                } else if((int)$value['type_sweetness'] === 1) {
                                                    print 'なかなかよき…';
                                                } else {
                                                    print 'もう最高';
                                                } ?>
                                                </span>
                                                <span>コク：
                                                <?php if((int)$value['type_tasty'] === 0) { ; 
                                                    print 'ちょっと物足りないかも…';
                                                } else if((int)$value['type_tasty'] === 1) {
                                                    print 'なかなかよき…';
                                                } else {
                                                    print 'もう最高';
                                                } ?>
                                                </span>
                                                <span>おすすめおつまみ：
                                                <?php if((int)$value['appetizers'] === 0) { ; 
                                                    print 'ナッツ';
                                                } else if((int)$value['appetizers'] === 1) {
                                                    print '枝豆';
                                                } else if((int)$value['appetizers'] === 2) {
                                                    print 'たこわさ';
                                                } else if((int)$value['appetizers'] === 3) {
                                                    print 'お刺身';
                                                } else {
                                                    print '餃子';
                                                } ?>
                                                </span>
                                                <span class="comment_title">【商品の特徴】</span>
                                                <span class="comment"><?php print $value['comment']; ?></span>
                                            </div>
                                            <span class="price"><?php print $value['price'] . "円"; ?></span>
                                            <form method="post" action="../html/index_add_cart.php">
                                                <input class="cart-btn" type="submit" value="カートに入れる">
                                                <input type="hidden" name="beer_id" value="<?php print $value['beer_id'] ?>">
                                                <input type="hidden" name="user_id" value="<?php print $user_id; ?>">
                                                <input type="hidden" name="user_name" value="<?php print $user_name['username']; ?>">
                                                <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                                            </form>
                                            <button class="close">閉じる</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        <?php } ?>
                </ul>
            </div>
            <div class="area">
                <a href="../html/index_europe.php">
                <div class="europe">
                    <img src="../html/assets/img/europe.jpg" alt="ヨーロッパ" class="area_img">
                    <div class="area_text">
                        <h2>ヨーロッパ</h2>
                        <p>ビール好きにはたまらないヨーロッパのビール。美味しいビールを堪能することを旅行の目的のひとつにしても楽しいほど。</p>
                        <p>ドイツやベルギーをはじめ世界中で人気を博しています。フルーティーなビールも多く、最高の一品を最高のおつまみと共にご堪能あれ！</p>
                        <p class="more"><< 続きを読む</p>
                    </div>
                </div>
                </a>
                <a href="../html/index_america.php">
                <div class="america">
                    <div class="area_text">
                        <h2>アメリカ</h2>
                        <p>近年人気を博しているアメリカのビール。なんと3000を超えるビール醸造所があり、個性豊かなビールがラインナップされています。</p>
                        <p>バドワイザーやブルームーンなど、人気アイテムも当店で取り扱っています！日本ではなかなか味わえない至福のひとときをどうぞ。</p>
                        <p class="more"><< 続きを読む</p>
                    </div>
                    <img src="../html/assets/img//america.jpg" alt="アメリカ" class="area_img">
                </div>
                </a>
                <a href="../html/index_asia.php">
                <div class="asia">
                    <img src="../html/assets/img/asia.jpg" alt="アジア" class="area_img">
                    <div class="area_text">
                        <h2>アジア</h2>
                        <p>東南アジアや中国をはじめ、アジア圏も多くの人の間でビールが親しまれています。一般的に味が薄いといわれていますが、飲みやすいビールが多いのが特徴です。</p>
                        <p>シンハーやタイガービールなど、日本とはまた異なるフレッシュな味を楽しんでみませんか？</p>
                        <p class="more"><< 続きを読む</p>
                    </div>
                </div>
                </a>
                <a href="../html/index_japan.php">
                <div class="japan">
                    <div class="area_text">
                        <h2>日本</h2>
                        <p>コンビニやスーパーなど、日常のあらゆる場所で飲まれている日本ビール。キレのある辛口のものや、飲みやすさ重視のものなど、さまざまな種類のものがラインナップされています。</p>
                        <p>アサヒやサントリー、サッポロなど、みなさんに馴染み深いビールを扱っています。飲み慣れたビールを、ぜひ手にとってみてください。</p>
                        <p class="more"><< 続きを読む</p>
                    </div>
                    <img src="../html/assets/img/japan.jpg" alt="日本" class="area_img">
                </div>
                </a>
            </div>
        </main>
        <footer>
            <p class="text"><small>Copyright &copy; Takahiro Koyama All Rights Reserved.</small></p>
        </footer>
        </div>
    </body>
</html>