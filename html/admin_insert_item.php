<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'functions.php';
date_default_timezone_set('Asia/Tokyo');
// セッション開始
session_start();

$create_datetime = date('Y/m/d H:i:s');
$update_datetime = date('Y/m/d H:i:s');

$db = get_db_connect();
            
$newname = get_post('newname');

$newname = preg_replace('/^[ 　]+/u', '', $newname);

$newprice = get_post('newprice');

$newprice = preg_replace('/^[ 　]+/u', '', $newprice);

$stock = get_post('stock');

$stock = preg_replace('/^[ 　]+/u', '', $stock);

$status = get_post('status');

$featured = get_post('featured');

$type_sharp = get_post('type_sharp');

$type_acidity = get_post('type_acidity');

$type_bitterness = get_post('type_bitterness');

$type_sweetness = get_post('type_sweetness');

$type_tasty = get_post('type_tasty');

$appetizers = get_post('appetizers');

$area = get_post('area');

$comment = get_post('comment');

$comment = preg_replace('/^[ 　]+/u', '', $comment);

$img_dir = '../html/assets/img/'; 

if(insert_items($db,$newname, $newprice, $status, $stock, $type_sharp, $type_acidity, $type_bitterness, $type_sweetness, $type_tasty, $appetizers, $area, $comment, $featured, $create_datetime, $update_datetime)) {
    set_message('商品の追加が完了しました！');
}

header('Location: admin.php');

?>