<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'functions.php';
$err_msg = [];

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

$beer_id = get_post('beer_id');

$amount = get_post('amount');

$name1 = get_post('name1');

$name1 = preg_replace('/^[ 　]+/u', '', $name1);

$name2 = get_post('name2');

$name2 = preg_replace('/^[ 　]+/u', '', $name2);

$kana1 = get_post('kana1');

$kana1 = preg_replace('/^[ 　]+/u', '', $kana1);

$kana2 = get_post('kana2');

$kana2 = preg_replace('/^[ 　]+/u', '', $kana2);

$zipcode = get_post('zipcode');

$zipcode = preg_replace('/^[ 　]+/u', '', $zipcode);

$addr1 = get_post('addr1');

$addr1 = preg_replace('/^[ 　]+/u', '', $addr1);

$addr2 = get_post('addr2');

$addr2 = preg_replace('/^[ 　]+/u', '', $addr2);

$tel = get_post('tel');

$tel = preg_replace('/^[ 　]+/u', '', $tel);

$email = get_post('email');

$email = preg_replace('/^[ 　]+/u', '', $email);

$pay = get_post('pay');

$now = time();

setcookie('name1' , $name1, $now + 60 * 60 * 24 * 365);
setcookie('name2' , $name2, $now + 60 * 60 * 24 * 365);
setcookie('kana1' , $kana1, $now + 60 * 60 * 24 * 365);
setcookie('kana2' , $kana2, $now + 60 * 60 * 24 * 365);
setcookie('zipcode' , $zipcode, $now + 60 * 60 * 24 * 365);
setcookie('addr1' , $addr1, $now + 60 * 60 * 24 * 365);
setcookie('addr2' , $addr2, $now + 60 * 60 * 24 * 365);
setcookie('tel' , $tel, $now + 60 * 60 * 24 * 365);
setcookie('email' , $email, $now + 60 * 60 * 24 * 365);

if($name1 === '') {
    $err_msg[] = '名前（姓）を入力してください。';
} else if(!preg_match(REGEXP_ALPHANUMERIC_name1, $name1)) {
    $err_msg[] = '名前（姓）が正しいかどうか確認してください。';
}

if($name2 === '') {
    $err_msg[] = '名前（名）を入力してください。';
} else if(!preg_match(REGEXP_ALPHANUMERIC_name2, $name2)) {
    $err_msg[] = '名前（名）が正しいかどうか確認してください。';
}

if($kana1 === '') {
    $err_msg[] = 'フリガナ（姓）を入力してください。';
} else if(!preg_match(REGEXP_ALPHANUMERIC_kana1, $kana1)) {
    $err_msg[] = 'フリガナ（姓）の表記が正しくありません。';
}

if($kana2 === '') {
    $err_msg[] = 'フリガナ（名）を入力してください。';
} else if(!preg_match(REGEXP_ALPHANUMERIC_kana2, $kana2)) {
    $err_msg[] = 'フリガナ（名）の表記が正しくありません。';
}

if($zipcode === '') {
    $err_msg[] = '郵便番号を入力してください。';
} else if(!preg_match(REGEXP_ALPHANUMERIC_zipcode, $zipcode)) {
    $err_msg[] = '郵便番号の表記が正しくありません。';
}

if($addr1 === '') {
    $err_msg[] = '住所（都道府県市町村）を入力してください。';
}

if($addr2 === '') {
    $err_msg[] = '住所（番地・アパート名）を入力してください';
}

if($tel === '') {
    $err_msg[] = '電話番号を入力してください。';
} else if(!preg_match(REGEXP_ALPHANUMERIC_tel, $tel)) {
    $err_msg[] = '電話番号の表記が正しくありません。';
}

if($email === '') {
    $err_msg[] = 'メールアドレスを入力してください。';
} else if(!preg_match(REGEXP_ALPHANUMERIC_email, $email)) {
    $err_msg[] = 'メールアドレスの表記が正しくありません。';
}

if($pay === 0) {
    $err_msg[] = '支払い方法を選択してください。';
} else if(!preg_match(REGEXP_ALPHANUMERIC_pay, $pay)) {
    $err_msg[] = '不正なステータスです。';
}

$db = get_db_connect();

$user_name = get_user_name($db, $user_id);

$count = count(get_count($db, $user_id));

$carts = get_user_carts($db, $user_id);

$total_price = sum_carts($carts);

$img_dir = '../html/assets/img/';

$token = get_csrf_token();

include_once VIEW_PATH . 'cart_confirm_view.php';

?>