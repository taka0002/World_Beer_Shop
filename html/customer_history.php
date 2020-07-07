<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'functions.php';

$db = get_db_connect();

$customer_history = get_customer_history($db);

include_once VIEW_PATH . 'customer_history_view.php';

?>