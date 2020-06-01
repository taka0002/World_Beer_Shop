<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>世界のビールSHOP</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/beershop.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../html/assets/js/popup.js"></script>
    </head>
    <body>
        <div id="wrapper">
        <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
        <main>
            <div class="slider">
                <img src="../html/assets/img/america.jpg" alt="アメリカ">
            </div>
            <div class="description_america">
                <h2>アメリカビールの特徴</h2>
                <p>アメリカ大陸でも、世界一の消費大国であるアメリカをはじめ、さまざまなビールがラインナップ。淡色で飲みやすく、後味のよさも日本人にあっており、多くの人気を集めています。</p>
                <p>また、日本をはじめ、世界各国で愛されている人気アイテムが多いのも魅力のひとつ。気になる方は、ぜひチェックしてみてくださいね！</p>
            </div>
            <div class="sort">
                <form method="get" action = "../html/index_america.php">
                        <!-- 並び替え方法選択 -->
                        <select name="sort">
                            <option value="cost_up">値段の安い順</option>
                            <option value="cost_down">値段の高い順</option>
                        </select>
                        <!-- 並び替えボタン -->
                        <input type="submit" name="sort_button" value="並び替える" class="rearranges">
                </form>
            </div>
            <div id="flex">
            <?php foreach($items as $value) { ?>
                
                <?php if((int)$value['status'] === 1 && (int)$value['area'] === 1) { ?>
                    
                    <div class = "drink">
                        <button class="item_description">
                            <img class="item_img" src="<?php print $img_dir . $value['img']; ?>">
                        </button>
                        <span><?php print h($value['name']); ?></span>
                        <span class="price"><?php print $value['price'] . "円"; ?></span>
                        <input type='hidden' name="stock" value="<?php print $value['stock']; ?>">
                        
                        <?php if($value['stock'] >= 1) {?>
                            
                            <form method="post" action="../html/index_america_add_cart.php">
                                <input class="cart-btn" type="submit" value="カートに入れる">
                                <input type="hidden" name="beer_id" value="<?php print $value['beer_id'] ?>">
                                <input type="hidden" name="user_id" value="<?php print $user_id; ?>">
                                <input type="hidden" name="user_name" value="<?php print $user_name['username']; ?>">
                                <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                            </form>
                        
                        <?php } else if($value['stock'] === 0)  {?>
                            
                            <span class="red">売り切れ</span>
                        
                        <?php } ?>
                        
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
                                <button class="close">閉じる</button>
                            </div>
                        </div>
                        
                    </div>
                <?php } ?>
            <?php } ?>
            </div>
        </main>
        <footer>
            <p class="text"><small>Copyright &copy; Takahiro Koyama All Rights Reserved.</small></p>
        </footer>
        </div>
    </body>
</html>