<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'functions.php';

session_start();

$token = get_csrf_token();

include_once VIEW_PATH . 'signup_view.php';

?>