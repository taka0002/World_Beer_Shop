<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'functions.php';

$db = get_db_connect();

$users = get_users($db);

include_once VIEW_PATH . 'user_view.php';

?>