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

$items = array();

$user_id = $_SESSION['user_id'];

$db = get_db_connect();

$user_name = get_user_name($db, $user_id);

$count = count(get_count($db, $user_id));
    
$area = get_get('area');

$appetizers = get_get('appetizers');

$name = get_get('name');

$name = preg_replace('/^[ 　]+/u', '', $name);

if($area !== "" && $appetizers !== "" && $name !== "") {
    
    $items = get_search_all($db, $area, $appetizers, $name);
    
} else if($area !== "" && $appetizers !== "") {
    
    $items = get_search_area_appetizers($db, $area, $appetizers);
    
} else if($area !== "" && $name !== "") {
    
    $items = get_search_area_name($db, $area, $name);
    
} else if($appetizers !== "" && $name !== "") {
    
    $items = get_search_appetizers_name($db, $appetizers, $name);
    
} else if($area !== "") {
    
    $items = get_search_area($db, $area);
    
} else if($appetizers !== "") {
    
    $items = get_search_appetizers($db, $appetizers);
    
} else if($name !== "") {
    
    $items = get_search_name($db, $name);
    
} 

$items_count = count($items);

$token = get_csrf_token();

//画像関連
$img_dir = '../html/assets/img/';    // アップロードした画像ファイルの保存ディレクトリ

include_once VIEW_PATH . 'search_view.php';

?>