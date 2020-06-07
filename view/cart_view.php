<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>World Beer Shop｜カートページ</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/common.css">
        <link rel="stylesheet" href="../html/assets/css/index.css">
        <link rel="stylesheet" href="../html/assets/css/cart.css">
        <link rel="stylesheet" href="../html/assets/css/responsive.css">
    </head>
    <body>
        <div id="wrapper">
        <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
        <main>
            <div class="cart_content">
                <h1 class="cart_title">カート一覧</h1>
                <?php foreach($carts as $value) { ?>
                    <div class="cart_table">
                        <div>
                            <img class="img" src="<?php print $img_dir . $value['img']; ?>"></span>
                        </div>
                        <span class="cart_name"><?php print h($value['name']); ?></span>
                        
                        <!--削除に関する記述 -->
                        <form method='post' action="../html/cart_delete_cart.php">
                            <input type="submit" value="削除" class="border_responsive">
                            <input type="hidden" name="beer_id" value="<?php print $value['beer_id']; ?>">
                            <input type="hidden" name="user_id" value="<?php print $user_id; ?>">
                            <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                        </form>
                        
                        <span><?php print $value['price'] . "円"; ?></span>
                    
                        <!--数量変更に関する記述 -->
                        <form method='post' action="../html/cart_change_amount.php">
                            <label><input type='number' name="update_amount" value="<?php print $value['amount']; ?>" size=10 class="border_responsive">個</label>
                            <input type="hidden" name="beer_id" value="<?php print $value['beer_id']; ?>">
                            <input type="hidden" name="user_id" value="<?php print $user_id; ?>">
                            <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                            <input type="submit" value="変更" class="border_responsive">
                        </form>
                    </div>
                <?php } ?>
                <div class="buy-sum-box">
                    <span class="buy-sum-title">合計</span>
                    <!-- ここから入力 -->
                    <span class="buy-sum-price">
                    <?php print $total_price . "円"; ?>
                    </span>
                    <!-- ここまで入力 -->
                </div>
                <div>
                    <!-- 購入手続きページに遷移する）-->
                    <form action="../html/cart_pay.php" method="post">
                      <input class="buy-btn" type="submit" value="購入手続きページへ">
                      <?php foreach($carts as $value) { ?>
                          <input type="hidden" name="beer_id" value="<?php print $value['beer_id']; ?>">
                          <input type="hidden" name="amount" value="<?php print $value['amount']; ?>">
                      <?php } ?>
                      <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                    </form>
                </div>
            </div>
        </main>
        <footer>
            <p class="text"><small>Copyright &copy; Takahiro Koyama All Rights Reserved.</small></p>
        </footer>
        </div>
    </body>
</html>