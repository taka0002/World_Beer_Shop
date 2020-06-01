<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'functions.php';
date_default_timezone_set('Asia/Tokyo');
session_start();

$token = get_post('csrf_token');

if(is_valid_csrf_token($token) === false) {
    
    header('Location: login.php');
}

set_session('csrf_token', '');

$db = get_db_connect();
$createdate = date('Y/m/d H:i:s');
$updatedate = date('Y/m/d H:i:s');
    
$user_name = get_post('username');

$pass_word = get_post('password');
    
if(insert_users($db, $user_name , $pass_word , $createdate , $updatedate)) {
    set_message('ユーザー登録が完了しました！');
}

include_once VIEW_PATH . 'signup_process_view.php';
?>