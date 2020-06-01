<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'functions.php';

$msg = [];

// セッション開始
session_start();
// セッション変数からログイン済みか確認
if (isset($_SESSION['user_id'])) {
  // ログイン済みの場合、ホームページへリダイレクト
  header('Location: index.php');
  exit;
} 

if(isset($_SESSION['login_err']) === TRUE) {
    $msg[] = $_SESSION['login_err'];
}

set_session('login_err', '');

// Cookie情報からユーザー名を取得
$user_name = get_cookie('user_name');

$token = get_csrf_token();


include_once VIEW_PATH . 'login_view.php';
?>