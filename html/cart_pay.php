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

$now = time();

$name1 = get_post('name1');

$name2 = get_post('name2');

$kana1 = get_post('kana1');

$kana2 = get_post('kana2');

$zipcode = get_post('zipcode');

$addr1 = get_post('addr1');

$addr2 = get_post('addr2');

$tel = get_post('tel');

$email = get_post('email');

setcookie('name1' , $name1, $now + 60 * 60 * 24 * 365);
setcookie('name2' , $name2, $now + 60 * 60 * 24 * 365);
setcookie('kana1' , $kana1, $now + 60 * 60 * 24 * 365);
setcookie('kana2' , $kana2, $now + 60 * 60 * 24 * 365);
setcookie('zipcode' , $zipcode, $now + 60 * 60 * 24 * 365);
setcookie('addr1' , $addr1, $now + 60 * 60 * 24 * 365);
setcookie('addr2' , $addr2, $now + 60 * 60 * 24 * 365);
setcookie('tel' , $tel, $now + 60 * 60 * 24 * 365);
setcookie('email' , $email, $now + 60 * 60 * 24 * 365);

$beer_id = get_post('beer_id');

$amount = get_post('amount');


if(empty($beer_id) && empty($amount)) {
    set_message("カートに商品を入れてください。");
}

$img_dir = '../html/assets/img/'; 

$token = get_csrf_token();

include_once VIEW_PATH . 'cart_pay_view.php';

?>