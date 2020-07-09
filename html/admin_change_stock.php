<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'functions.php';
date_default_timezone_set('Asia/Tokyo');
// セッション開始
session_start();

$user_id = $_SESSION['user_id'];

if($user_id !== 48) {
  
  // ログイン済みユーザのホームページへリダイレクト
  header('Location: login.php');
  exit;
  
}

$token = get_post('csrf_token');

if(is_valid_csrf_token($token) === false) {
    
    header('Location: login.php');
}

set_session('csrf_token', '');

$db = get_db_connect();

$update_datetime = date('Y/m/d H:i:s');
        
$beer_id = get_post('beer_id');

$update_stock = get_post('update_stock');

$update_stock = preg_replace('/^[ 　]+/u', '', $update_stock);

if(update_item_stock($db, $beer_id, $update_stock, $update_datetime)) {
    set_message('商品の在庫数が変更されました！');
}  else {
    set_message('商品の在庫数を更新できませんでした');
}

$img_dir = '../html/assets/img/'; 

header('Location: admin.php');

?>