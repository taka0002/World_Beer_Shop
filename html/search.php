<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'functions.php';

$items = array();

$db = get_db_connect();

// セッション開始
session_start();

// 登録データを取得できたか確認
if (isset($_SESSION['user_id'])) {
    
    $user_id = $_SESSION['user_id'];
    $user_name = get_user_name($db, $user_id);
    $count = count(get_count($db, $user_id));
}
    
$area = get_get('area');

$appetizers = get_get('appetizers');

$name = get_get('name');

$name = preg_replace('/^[ 　]+/u', '', $name);

if($area !== "" && $appetizers !== "" && $name !== "") {
    
    $items = get_search_all($db, $area, $appetizers, $name, $status = 1);
    
} else if($area !== "" && $appetizers !== "") {
    
    $items = get_search_area_appetizers($db, $area, $appetizers, $status = 1);
    
} else if($area !== "" && $name !== "") {
    
    $items = get_search_area_name($db, $area, $name, $status = 1);
    
} else if($appetizers !== "" && $name !== "") {
    
    $items = get_search_appetizers_name($db, $appetizers, $name, $status = 1);
    
} else if($area !== "") {
    
    $items = get_search_area($db, $area, $status = 1);
    
} else if($appetizers !== "") {
    
    $items = get_search_appetizers($db, $appetizers, $status = 1);
    
} else if($name !== "") {
    
    $items = get_search_name($db, $name, $status = 1);
    
} 

$items_count = count($items);

$token = get_csrf_token();

//画像関連
$img_dir = '../html/assets/img/';    // アップロードした画像ファイルの保存ディレクトリ

include_once VIEW_PATH . 'search_view.php';

?>