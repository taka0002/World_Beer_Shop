<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>World Beer Shop｜購入履歴</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/common.css">
        <link rel="stylesheet" href="../html/assets/css/index.css">
        <link rel="stylesheet" href="../html/assets/css/history.css">
        <link rel="stylesheet" href="../html/assets/css/cart.css">
        <link rel="stylesheet" href="../html/assets/css/responsive.css">
    </head>
    <body>
        <div id="wrapper">
        <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
        <main>
            <div class="cart_content">
                <h1 class="cart_title">購入履歴一覧</h1>
                <?php foreach($items as $value) { ?>
                        <div class="cart_table history">
                            <div>
                                <img class="img" src="<?php print $img_dir . $value['img']; ?>"></span>
                            </div>
                            <span class="cart_name"><?php print h($value['name']); ?></span>
                            <span><?php print $value['price'] . "円"; ?></span>
                            <span><?php print $value['amount'] . "個"; ?></span>
                            <span><p>購入日</p><?php print $value['create_datetime']; ?></span>
                        </div>
                <?php } ?>
            </div>
            <div class="pagi_nation">
                <?php if($items_count !== 0) { ?>
                <form method="get" action="history.php">
                  <p>
                    <?php print $items_count. '件中'.$page_ini. "〜" .$page_fin. "件目の商品"; ?>
                  </p>
                  <p>
                  <?php
                    // リンクをつけるかの判定
                    if($now > 1){ 
                        print '<a href=\'../html/history.php?page_id='.($now - 1).'\')>前へ</a>'. '　';
                    } else {
                        print '前へ'. '　';
                    }
                    
                    for($i = 1; $i <= $max_page; $i++){
                        if($i >= $now - $range && $i <= $now + $range) {
                            if ($i == $now) {
                                print '<a class="current_page" href=\'history.php?page_id='.$now.'\')>'. $now. '</a>'. '　';
                            } else {
                                print '<a href=\'../html/history.php?page_id='.$i. '\')>'. $i. '</a>'. '　';
                            }
                        }
                    }
                    // リンクをつけるかの判定
                    if($now < $max_page){ 
                        print '<a href=\'../html/history.php?page_id='.($now + 1).'\')>次へ</a>'. '　';
                    } else {
                        print '次へ';
                    }
                  ?>
                  </p>
                </form>
                <?php } else { ?>
                    <p>購入履歴はありません。</p>
                <?php } ?>
             </div>
        </main>
        <footer>
            <p class="text"><small>Copyright &copy; Takahiro Koyama All Rights Reserved.</small></p>
        </footer>
        </div>
    </body>
</html>
