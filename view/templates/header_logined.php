<header>
    <div class="top_header_box">
        <div class="top_header">
            <a href="../html/index.php" class="name">ようこそ<?php print $user_name['username']; ?>さん</a>
            <div class="area_header">
                <ul>
                    <li><a href="../html/index_europe.php" class="area_top">ヨーロッパ</a></li>
                    <li><a href="../html/index_america.php" class="area_top">アメリカ</a></li>
                    <li><a href="../html/index_asia.php" class="area_top">アジア</a></li>
                    <li><a href="../html/index_japan.php" class="area_top">日本</a></li>
                </ul>
            </div>
            <a href="../html/cart.php" class="cart"><img src="../html/assets/img/icon.png" ></a>
            <span class="amount"><?php print $count; ?></span>
        </div>
        <div class="logout_header">
            <a href="../html/logout.php" class="logout">ログアウト</a>
        </div>
    </div>
    <div>
        <?php foreach(get_messages() as $message){ ?>
              <p class="success-msg"><?php print $message; ?></p>
        <?php } ?>
    </div>
    <div class="nav_bar border">
    <div class="buy_history">
        <a href="../html/history.php">購入履歴はこちら＞＞</a>
    </div>
        <form method="get" action=../html/search.php>
            <ul>
                <li class="selectbox_1 color">地域:
                    <select name="area">
                      <option value="">指定しない</option>
                      <option value="0">ヨーロッパ</option>
                      <option value="1">アメリカ</option>
                      <option value="2">アジア</option>
                      <option value="3">日本</option>
                    </select>
                </li>
                <span>または</span>
                <li class="selectbox_2 color">ビールにあうおつまみ:
                    <select name="appetizers">
                      <option value="">指定しない</option>
                      <option value="0">ナッツ</option>
                      <option value="1">枝豆</option>
                      <option value="2">たこわさ</option>
                      <option value="3">お刺身</option>
                      <option value="4">餃子</option>
                    </select>
                </li>
                <span>または</span>
                <li>キーワード:
                    <input type="text" name="name" class="border_responsive">
                </li>
                <input type="submit" value="検索" class="find">
            </ul>
        </form>
    </div>
</header>