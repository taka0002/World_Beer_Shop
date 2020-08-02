<?php

//getで受け取った値
function get_get($name){
  if(isset($_GET[$name]) === true){
    return $_GET[$name];
  };
  return '';
}

//postで受け取った値
function get_post($name){
  if(isset($_POST[$name]) === true){
    return $_POST[$name];
  };
  return '';
}

function get_post_replace($name){
  if(isset($_POST[$name]) === true){
    return $_POST[$name];
  };
  return '';
}

function get_cookie($name){
  if(isset($_COOKIE[$name]) === true){
    return $_COOKIE[$name];
  };
  return '';
}

function get_session($name){
  if(isset($_SESSION[$name]) === true){
    return $_SESSION[$name];
  };
  return '';
}

function set_session($name, $value){
  //セッション変数に$valueを保存
  $_SESSION[$name] = $value;
}

function set_message($message){
  $_SESSION['__messages'][] = $message;
}

function get_messages(){
  $messages = get_session('__messages');
  if($messages === ''){
    return array();
  }
  set_session('__messages',  array());
  return $messages;
}

function h($string) {
  return htmlspecialchars($string, ENT_QUOTES, "UTF-8"); 
}

function get_random_string($length = 20) {
    return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}

// トークンの生成
function get_csrf_token(){
  // get_random_string()はユーザー定義関数。
  $token = get_random_string(30);
  // set_session()はユーザー定義関数。
  //session変数に'csrf_token'を保存している($_SESSION['csrf_token'] = $token;)
  set_session('csrf_token', $token);
  return $token;
}

// トークンのチェック
function is_valid_csrf_token($token){
  if($token === '') {
    return false;
  }
  // get_session()はユーザー定義関数
  //(isset($_SESSION['csrf_token'])がTUREであれば返り値はSESSION変数に保存されている['csrf_token'])
  return $token === get_session('csrf_token');
}

?>
