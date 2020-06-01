<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'functions.php';

// セッション開始
session_start();

// 登録データを取得できたか確認
if (!isset($_SESSION['user_id'])) {
  
  // ログイン済みユーザのホームページへリダイレクト
  header('Location: login.php');
  exit;
  
}

$user_id = $_SESSION['user_id'];

$db = get_db_connect();

$user_name = get_user_name($db, $user_id);

$count = count(get_count($db, $user_id));
    
if(get_get('page_id')) {
    $now = $_GET['page_id'];
}else {
  //設定されてない場合は1ページ目にする
  $now = 1;
}

$offset = ($now - 1) * 5;

$history = get_history($db, $user_id);

$items = get_items_list($db, $user_id, $limit = 5, $offset);

$items_count = get_items_count($db, $user_id);

$max_page = ceil($items_count / 5);

//件数の数の表示（$page_fin）とセット
$page_ini = ($offset + 1);

if(count($items) === 5) {
  $page_fin = ($offset + 5);
} else {
  $page_fin = $items_count;
}

//ページネーションの表示数
if((int)$now === 1 || (int)$now === (int)$max_page) {
    $range = 4;
} else if((int)$now === 2 || (int)$now === ((int)$max_page -1)) {
    $range = 3;
} else  {
    $range = 2;
}


$img_dir = '../html/assets/img/'; 

include_once VIEW_PATH . 'history_view.php';

?>