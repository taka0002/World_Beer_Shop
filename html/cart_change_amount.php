<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'functions.php';
date_default_timezone_set('Asia/Tokyo');
// セッション開始
session_start();

// 登録データを取得できたか確認
if (!isset($_SESSION['user_id'])) {
  
  // ログイン済みユーザのホームページへリダイレクト
  header('Location: login.php');
  exit;

}

$token = get_post('csrf_token');

if(is_valid_csrf_token($token) === false) {
    
    header('Location: login.php');
}

set_session('csrf_token', '');

$user_id = $_SESSION['user_id'];

//バリデーション
$updatedate = date('Y/m/d H:i:s');

$db = get_db_connect();

$user_name = get_user_name($db, $user_id);

$count = count(get_count($db, $user_id));

$carts = get_user_carts($db, $user_id);

$total_price = sum_carts($carts);
    
$user_id = get_post('user_id');

$beer_id = get_post('beer_id');

$amount = get_post('update_amount');

$amount = preg_replace('/^[ 　]+/u', '', $amount);

if(update_cart_amount($db, $beer_id, $user_id, $updatedate, $amount)){
 set_message('商品の個数が変更されました！');   
}
 
$img_dir = '../html/assets/img/';

header('Location: cart.php');

?>