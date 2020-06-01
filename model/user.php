<!--user.php-->
<?php
$msg = [];
require_once '../model/functions.php';
require_once '../model/db.php';


function get_users($db){
  $sql = '
    SELECT
        username,
        createdate
    FROM
        users
  ';
    
  return fetch_all_query($db, $sql);
}

//register_complete.php
function insert_users($db, $user_name , $pass_word , $createdate , $updatedate) {
    if(!preg_match(REGEXP_ALPHANUMERIC_user_name, $user_name) && !preg_match(REGEXP_ALPHANUMERIC_pass_word, $pass_word)){
        set_message('ユーザー名は6文字以上、10文字以下の半角英数字で登録してください。');
        set_message('パスワードは6文字以上、10文字以下の半角英数字で登録してください。');
        return false;
    } 
    if(!preg_match(REGEXP_ALPHANUMERIC_user_name, $user_name)) {
        set_message('ユーザー名は6文字以上、10文字以下の半角英数字で登録してください。');
        return false;
    }
    if(!preg_match(REGEXP_ALPHANUMERIC_pass_word, $pass_word)) {
        set_message('パスワードは6文字以上、10文字以下の半角英数字で登録してください。');
        return false;
    }
    $sql = '
        INSERT INTO 
            users (
                username,
                password,
                createdate,
                updatedate
                )
        VALUES(?, ? ,?, ?)
    ';
    
    return execute_query($db, $sql, array($user_name, $pass_word, $createdate, $updatedate));
}


function get_user_id($db, $user_name, $pass_word) {
    $sql = '
        SELECT 
            user_id
        FROM
            users
        WHERE
            username = ?
        AND
            password = ?
    ';
    
    return fetch_query($db, $sql, array($user_name, $pass_word));
}



function get_login_user($db){
    $login_user_id = get_session('user_id');
    
    return get_user($db, $login_user_id);
}

function user_confirm($db, $get_user_id) {
    // 登録データを取得できたか確認
    if (isset($get_user_id['user_id'])) {
      // セッション変数にuser_idを保存
      $_SESSION['user_id'] = $get_user_id['user_id'];
      
      // ログイン済みユーザのホームページへリダイレクト
      header('Location: index.php');
      exit;
      
    } else {
        
      $_SESSION['login_err'] = "ログインできませんでした。";
      
      // ログインページへリダイレクト
      header('Location: login.php');
      exit;
      
    }
}

//POSTデータから任意データの取得
function get_post_data($key) {
  $str = '';
  if (isset($_POST[$key])) {
    $str = $_POST[$key];
  }
  return $str;
}

function send_mail($name1, $name2, $zipcode, $addr1, $addr2, $tel, $email, $pay){
    //言語と文字コードの使用宣言
    mb_language("ja");
    mb_internal_encoding("UTF-8");
    
    $subject = "購入ありがとうございました！【世界のビールSHOP】";
    $message_1 = $name1 . $name2 . "様、この度は購入いただきありがとうございました！\r\n\r\n以下の住所に商品を発送いたしますのでご確認ください。\r\n\r\n【住所】\r\n〒" . $zipcode . "\r\n" . $addr1 . $addr2 . "\r\n\r\n【電話番号】\r\n" . $tel . "\r\n\r\n【支払い方法】\r\n";
    
    if($pay === "1") {
        $message_2 = "代金引換";
    } else if($pay === "2") {
        $message_2 = "クレジットカード";
    } else if($pay === "3") {
        $message_2 = "コンビニエンスストアで支払い";
    } else if($pay === "4") {
        $message_2 = "振込";
    }
    
    $message_3 = "\r\n\r\nまたの購入をお待ちしております。";
    $header = "From: ttakka365@gmail.com\r\n";
    $header .= "Return-Path: ttakka365@gmail.com\r\n";
    $param = "-f ttakka365@gmail.com";
    
    return mb_send_mail($email, $subject, $message_1 . $message_2 . $message_3, $header, $param);
}
    
?>

