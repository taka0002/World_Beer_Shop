<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'functions.php';

$db = get_db_connect();

session_start();

// リクエストメソッド確認
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    
  // POSTでなければログインページへリダイレクト
  header('Location: login.php');
  exit;
  
}

$token = get_post('csrf_token');

if(is_valid_csrf_token($token) === false) {
    
    header('Location: login.php');
}

set_session('csrf_token', '');

$user_name = get_post('user_name');

$pass_word = get_post('password');

session_start();
// ユーザー名をCookieへ保存
setcookie('user_name', $user_name, time() + 60 * 60 * 24 * 365);

$get_user_id = get_user_id($db, $user_name, $pass_word);

user_confirm($db, $get_user_id);

get_post_data($key);

?>