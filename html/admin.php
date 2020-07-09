<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'functions.php';

session_start();

$user_id = $_SESSION['user_id'];

if($user_id !== 48) {
  
  // ログイン済みユーザのホームページへリダイレクト
  header('Location: login.php');
  exit;
  
}

$db = get_db_connect();

$items = get_items($db);

$token = get_csrf_token();

$img_dir = '../html/assets/img/'; 

include_once VIEW_PATH . 'admin_view.php';

?>