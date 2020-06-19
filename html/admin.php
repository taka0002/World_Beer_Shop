<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'functions.php';

session_start();

$db = get_db_connect();

$items = get_items($db);

$img_dir = '../html/assets/img/'; 

include_once VIEW_PATH . 'admin_view.php';

?>