<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'functions.php';

// セッション開始
session_start();

$db = get_db_connect();

$beer_id = get_post('beer_id');

if(delete_item($db,$beer_id)) {
    set_message('商品を削除しました！');
} else {
    set_message('商品の削除に失敗しました');
}

$img_dir = '../html/assets/img/'; 

header('Location: admin.php');

?>