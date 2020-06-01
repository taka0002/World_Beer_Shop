<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'functions.php';
date_default_timezone_set('Asia/Tokyo');
// セッション開始
session_start();

$db = get_db_connect();

$update_datetime = date('Y/m/d H:i:s');
        
$beer_id = get_post('beer_id');

$status = get_post('status');

$update_datetime = date('Y/m/d H:i:s');

if(change_item_status($db, $beer_id, $update_datetime, $status)){
    set_message('ステータスの変更が完了しました！');
} else {
    set_message('ステータスの変更に失敗しました！');
}

$img_dir = '../html/assets/img/'; 

header('Location: admin.php');

?>