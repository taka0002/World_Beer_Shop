<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'functions.php';

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

$db = get_db_connect();

$user_name = get_user_name($db, $user_id);

$count = count(get_count($db, $user_id));

$carts = get_user_carts($db, $user_id);

$total_price = sum_carts($carts);

$name1 = get_cookie('name1');

$name2 = get_cookie('name2');

$kana1 = get_cookie('kana1');

$kana2 = get_cookie('kana2');

$zipcode = get_cookie('zipcode');

$addr1 = get_cookie('addr1');

$addr2 = get_cookie('addr2');

$tel = get_cookie('tel');

$email = get_cookie('email');

$beer_id = get_post('beer_id');

$amount = get_post('amount');


if(empty($beer_id) && empty($amount)) {
    set_message("カートに商品を入れてください。");
}

$img_dir = '../html/assets/img/'; 

$token = get_csrf_token();

include_once VIEW_PATH . 'cart_pay_view.php';

?>
