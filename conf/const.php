<?php
if($_SERVER['SERVER_ADDR'] === '172.31.15.199') {
    define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/beershop_mvc/model/');
    define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/beershop_mvc/view/');
    
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'codecamp32092');
    define('DB_USER', 'codecamp32092');
    define('DB_PASS', 'GKZFNNEL');
    
} else {

    define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/beershop_mvc/model/');
    define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/beershop_mvc/view/');
    
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'beer');
    define('DB_USER', 'root');
    define('DB_PASS', 't21oklbVJ');

}

define('DB_CHARSET', 'utf8');

//admin.php関連
define('REGEXP_ALPHANUMERIC_newprice', '/^[0-9]*$/');
define('REGEXP_ALPHANUMERIC_stock', '/^[0-9]*$/');
define('REGEXP_ALPHANUMERIC_update_stock', '/\+?[1-9][0-9]*/u');
define('REGEXP_ALPHANUMERIC_status', '/^[0-1]*$/');
define('REGEXP_ALPHANUMERIC_featured', '/^[0-1]*$/');
define('REGEXP_ALPHANUMERIC_type_sharp', '/^[0-2]*$/');
define('REGEXP_ALPHANUMERIC_type_acidity', '/^[0-2]*$/');
define('REGEXP_ALPHANUMERIC_type_bitterness', '/^[0-2]*$/');
define('REGEXP_ALPHANUMERIC_type_sweetness', '/^[0-2]*$/');
define('REGEXP_ALPHANUMERIC_type_tasty', '/^[0-2]*$/');
define('REGEXP_ALPHANUMERIC_appetizers', '/^[0-4]*$/');
define('REGEXP_ALPHANUMERIC_area', '/^[0-3]*$/');

//購入情報入力関連
define('REGEXP_ALPHANUMERIC_name1', '/^[ぁ-んァ-ヶー一-龠]+$/u');
define('REGEXP_ALPHANUMERIC_name2', '/^[ぁ-んァ-ヶー一-龠]+$/u');
define('REGEXP_ALPHANUMERIC_kana1', '/^[ァ-ヶー]+$/u');
define('REGEXP_ALPHANUMERIC_kana2', '/^[ァ-ヶー]+$/u');
define('REGEXP_ALPHANUMERIC_zipcode', '/^\d{3}-\d{4}$/');
define('REGEXP_ALPHANUMERIC_tel', '/^(0{1}\d{9,10})$/');
define('REGEXP_ALPHANUMERIC_email', '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/');
define('REGEXP_ALPHANUMERIC_pay', '/^[0-4]$/');

//新規登録関連
define('REGEXP_ALPHANUMERIC_user_name', '/\A[a-z\d]{6,10}+\z/i');
define('REGEXP_ALPHANUMERIC_pass_word', '/\A[a-z\d]{6,10}+\z/i');

?>