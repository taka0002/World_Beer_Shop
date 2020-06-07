<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'functions.php';

$token = get_csrf_token();

$db = get_db_connect();

$items = get_items($db);

// セッション開始
session_start();

// 登録データを取得できたか確認
if (isset($_SESSION['user_id'])) {
    
    $user_id = $_SESSION['user_id'];
    $user_name = get_user_name($db, $user_id);
    $count = count(get_count($db, $user_id));
}

$img_dir = '../html/assets/img/'; 

include_once VIEW_PATH . 'index_view.php';

?>