<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'functions.php';

session_start();

$user_id = $_SESSION['user_id'];

if($user_id !== 48) {
  
  // ログイン済みユーザのホームページへリダイレクト
  header('Location: login.php');
  exit;
  
}

$db = get_db_connect();

$users = get_users($db);

include_once VIEW_PATH . 'user_view.php';

?>