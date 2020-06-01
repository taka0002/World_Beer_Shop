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

$db = get_db_connect();

$items = get_items($db);

$img_dir = '../html/assets/img/'; 

include_once VIEW_PATH . 'admin_view.php';

?>