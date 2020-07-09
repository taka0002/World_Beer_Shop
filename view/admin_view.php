<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>World Beer Shop｜管理ツール</title>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <link rel="stylesheet" href="../html/assets/css/admin.css">
        <?php include VIEW_PATH . 'templates/header_bootstrap.php'; ?>
    </head>
    <body>
        <h1>商品管理ページ</h1>
        <div>
            <div>
                <?php foreach(get_messages() as $message){ ?>
                  <p><?php print $message; ?></p>
                <?php } ?>
            </div>
            <p><a href="./user.php">ユーザー管理ページはこちら</a></p>
            <p><a href="./customer_history.php">購入者情報ページはこちら</a></p>
            <p><a href="./index.php">トップページへ戻る</a></p>
            <h2>新規商品追加</h2>
            <form method='post' enctype="multipart/form-data" action="../html/admin_insert_item.php">
                <div><label>名前: <input type="text" name="newname" value=''></label></div>
                <div><label>値段: <input type="text" name="newprice" value=''></label></div>
                <div><label>個数: <input type="text" name="stock" value=''></label></div>
                <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                <div><input type="file" name="new_img" value=''></div>
                <div>
                    <select name="status">
                        <option value="0">非公開</option>
                        <option value="1">公開</option>   
                    </select>
                </div>
                <div>
                    ビールの味（キレ）
                    <select name="type_sharp">
                        <option value="0">ちょっと物足りないかも…</option>
                        <option value="1">なかなかよき</option>
                        <option value="2">もう最高</option>
                    </select>
                </div>
                <div>
                    ビールの味（酸味）
                    <select name="type_acidity">
                        <option value="0">ちょっと物足りないかも…</option>
                        <option value="1">なかなかよき</option>
                        <option value="2">もう最高</option>
                    </select>
                </div>
                <div>
                    ビールの味（苦味）
                    <select name="type_bitterness">
                        <option value="0">ちょっと物足りないかも…</option>
                        <option value="1">なかなかよき</option>
                        <option value="2">もう最高</option>
                    </select>
                </div>
                <div>
                    ビールの味（甘み）
                    <select name="type_sweetness">
                        <option value="0">ちょっと物足りないかも…</option>
                        <option value="1">なかなかよき</option>
                        <option value="2">もう最高</option>
                    </select>
                </div>
                <div>
                    ビールの味（コク）
                    <select name="type_tasty">
                        <option value="0">ちょっと物足りないかも…</option>
                        <option value="1">なかなかよき</option>
                        <option value="2">もう最高</option>
                    </select>
                </div>
                <div>
                    おすすめおつまみ
                    <select name="appetizers">
                        <option value="0">ナッツ</option>
                        <option value="1">枝豆</option>
                        <option value="2">たこわさ</option>
                        <option value="3">お刺身</option>
                        <option value="4">餃子</option>
                    </select>
                </div>
                <div>
                    地域
                    <select name="area">
                        <option value="0">ヨーロッパ</option>
                        <option value="1">アメリカ</option>
                        <option value="2">アジア</option>
                        <option value="3">日本</option>
                    </select>
                </div>
                <div>商品の詳細: <input type="text" name="comment" value='' size=200></div>
                <div>
                    <select name="featured">
                        <option value="0">注目アイテムに入れない</option>
                        <option value="1">注目アイテムに入れる</option>   
                    </select>
                </div>
                <div><input type="submit" value="商品を追加"></div>
            </form>
            </div>
            <div>
                <div class="container">
                    <h2>商品情報変更</h2>
                    <p>商品一覧</p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th class=img>商品画像</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>おつまみ</th>
                                <th>地域</th>
                                <th>在庫数</th>
                                <th>ステータス</th>
                                <th>操作</th>
                                <th>注目アイテム</th>
                            </tr>
                            <?php foreach($items as $value) { ?>
                            <!--条件式 ? 式1 : 式2-->
                            <tr class="<?php print $value['status']  === 0 ? "false" : "" ?>">
                            <td class=img><img src="<?php print $img_dir . $value['img']; ?>"></td>
                            <td><?php print h($value['name']); ?></td>
                            <td><?php print $value['price'] . "円"; ?></td>
                            
                            <!--おつまみに関する記述 -->
                            <td>
                                <?php if((int)$value['appetizers'] === 0) { ?>
                                
                                    ナッツ
                                    
                                <?php } else if((int)$value['appetizers'] === 1) { ?>
                                
                                    枝豆
                                    
                                <?php } else if((int)$value['appetizers'] === 2) { ?>
                                
                                    たこわさ
                                    
                                <?php } else if((int)$value['appetizers'] === 3) { ?>
                                
                                    お刺身
                                
                                <?php } else { ?>
                                
                                    餃子
                                
                                <?php } ?>
                            </td>
                            
                            <!--地域に関する記述 -->
                            <td>
                                <?php if((int)$value['area'] === 0) { ?>
                                
                                    ヨーロッパ
                                    
                                <?php } else if((int)$value['area'] === 1) { ?>
                                
                                    アメリカ
                                    
                                <?php } else if((int)$value['area'] === 2) { ?>
                                
                                    アジア
                                    
                                <?php } else { ?>
                                
                                    日本
                                
                                <?php } ?>
                            </td>
                            
                            <!--在庫数の変更についての記述 -->
                            <form method='post' action="../html/admin_change_stock.php">
                            <td>
                            <label><input type='number' name="update_stock" value="<?php print $value['stock']; ?>" size=10>個</label>
                            <input type="hidden" name="beer_id" value="<?php print $value['beer_id']; ?>">
                            <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                            <input type="submit" value="変更">
                            </td>
                            </form>
                            
                            <!--ステータスの変更についての記述 -->
                            <form method="post" action="../html/admin_change_status.php">
                            <td>
                                <?php if((int)$value['status'] === 0) { ?>
                                   
                                   <input type="submit" name = "change_status" value="非公開→公開">
                                
                                <?php } else { ?>
                                    
                                   <input type="submit" name = "change_status" value="公開→非公開">
                                
                                <?php } ?>
                                <input type="hidden" name="beer_id" value="<?php print $value['beer_id']; ?>">
                                <input type="hidden" name="status" value="<?php print $value['status']; ?>">
                                <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                            </td>
                            </form>
                            
                            <!--削除についての記述 -->
                            <form method='post' action="../html/admin_delete_item.php">
                            <td>
                                <input type="hidden" name="beer_id" value="<?php print $value['beer_id']; ?>">
                                <input type="submit" value="削除">
                                <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                            </td>
                            </form>
                            
                             <!--注目アイテムのステータスの変更についての記述 -->
                            <form method="post" action="../html/admin_change_featured.php">
                            <td>
                                <?php if((int)$value['featured'] === 0) { ?>
                                   
                                   <input type="submit" name = "change_status" value="注目アイテムに入れる">
                                
                                <?php } else { ?>
                                    
                                   <input type="submit" name = "change_status" value="注目アイテムから外す">
                                
                                <?php } ?>
                                <input type="hidden" name="featured" value="<?php print $value['featured']; ?>">
                                <input type="hidden" name="beer_id" value="<?php print $value['beer_id']; ?>">
                                <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                            </td>
                            </form>
                            
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>