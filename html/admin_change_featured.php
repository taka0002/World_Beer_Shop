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

$items = get_items($db);

$beer_id = get_post('beer_id');

$featured = get_post('featured');

$update_datetime = date('Y/m/d H:i:s');

if(change_item_featured($db, $beer_id, $update_datetime, $featured)){
    set_message('注目アイテムのステータス変更が完了しました！');
} else {
    set_message('注目アイテムのステータス変更に失敗しました！');
}

header('Location: admin.php');

?>