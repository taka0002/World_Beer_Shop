<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'functions.php';

date_default_timezone_set('Asia/Tokyo');
$create_datetime = date('Y/m/d H:i:s');
$update_datetime = date('Y/m/d H:i:s');

// セッション開始
session_start();

// 登録データを取得できたか確認
if (!isset($_SESSION['user_id'])) {
  
  // ログイン済みユーザのホームページへリダイレクト
  header('Location: login.php');
  exit;

}

$user_id = $_SESSION['user_id'];

$token = get_post('csrf_token');

if(is_valid_csrf_token($token) === false) {
    
    header('Location: login.php');
}

set_session('csrf_token', '');

$db = get_db_connect();

$user_name = get_user_name($db, $user_id);

$count = count(get_count($db, $user_id));

$carts = get_user_carts($db, $user_id);

$total_price = sum_carts($carts);
    
$beer_id = get_post('beer_id');

$amount = get_post('amount');
    
$name1 = get_post('name1');

$name2 = get_post('name2');

$kana1 = get_post('kana1');

$kana2 = get_post('kana2');

$zipcode = get_post('zipcode');

$addr1 = get_post('addr1');

$addr2 = get_post('addr2');

$tel = get_post('tel');

$email = get_post('email');

$pay = get_post('pay');

if(purchase_carts($db, $carts, $update_datetime, $user_id, $name1, $name2, $kana1, $kana2, $zipcode, $addr1, $addr2, $tel, $email, $pay, $create_datetime, $beer_id, $amount)) {
    set_message('購入が完了しました！');
} else {
    set_message('購入に失敗しました');
}

$img_dir = '../html/assets/img/'; 

include_once VIEW_PATH . 'cart_finish_view.php';

?>