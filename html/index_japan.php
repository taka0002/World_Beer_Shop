<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
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

$user_id = $_SESSION['user_id'];

$token = get_csrf_token();

$db = get_db_connect();

$items = get_items($db);

$user_name = get_user_name($db, $user_id);

$count = count(get_count($db, $user_id));
    
$sort = get_get('sort');
        
if($sort === "cost_up") {
    
    $items = get_cost_up($db);
    set_message('価格の安い順に並び替えました！');
    
} else if($sort === "cost_down") {
    
    $items = get_cost_down($db);
    set_message('価格の高い順に並び替えました！');
    
}

$img_dir = '../html/assets/img/'; 

include_once VIEW_PATH . 'index_japan_view.php';

?>