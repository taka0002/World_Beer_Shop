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

$db = get_db_connect();

$items = get_items($db);

$user_name = get_user_name($db, $user_id);

$count = count(get_count($db, $user_id));

$user_id = get_post('user_id');

$beer_id = get_post('beer_id');

$createdate = date('Y/m/d H:i:s');
$updatedate = date('Y/m/d H:i:s');

if(add_cart($db, $user_id, $beer_id, $createdate, $updatedate)) {
    set_message('カートに追加しました！');
} else {
    set_message('カートの登録に失敗しました！');
}
        
$img_dir = '../html/assets/img/'; 

header('Location: index_asia.php');
?>