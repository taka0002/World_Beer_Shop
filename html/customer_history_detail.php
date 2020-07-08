<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'cart.php';

$db = get_db_connect();

$history_id = get_post('history_id');

$zipcode = get_post('zipcode');

$addr1 = get_post('addr1');

$addr2 = get_post('addr2');

$tel = get_post('tel');

$email = get_post('email');

$pay = get_post('pay');

$create_datetime = get_post('create_datetime');

$get_customer_history_detail = get_customer_history_detail($db, $create_datetime);

$customer_total_price = customer_sum_carts($get_customer_history_detail);

include_once VIEW_PATH . 'customer_history_detail_view.php';

?>