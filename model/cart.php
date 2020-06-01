<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_user_carts($db, $user_id){
  $sql = "
    SELECT
      items.beer_id,
      items.name,
      items.price,
      items.stock,
      items.status,
      items.img,
      carts.amount
    FROM
      items
    JOIN
      carts
    ON
      items.beer_id = carts.beer_id
    WHERE
      carts.user_id = {$user_id}
  ";
  return fetch_all_query($db, $sql);
}

//sum_carts関数の定義
function sum_carts($carts){
  $total_price = 0;
  foreach($carts as $cart){
    $total_price += $cart['price'] * $cart['amount'];
  }
  return $total_price;
}

function get_identify_cart($db, $user_id, $beer_id){
  $sql = '
    SELECT
        beer_id,
        user_id,
        amount
    FROM
        carts
    where
        beer_id = '. $beer_id .
    ' AND
        user_id = '. $user_id;
  
  return fetch_query($db, $sql);
}

function insert_cart($db, $user_id, $beer_id, $createdate, $updatedate, $amount = 1){
  $sql = "
    INSERT INTO
      carts
      (
        beer_id,
        user_id,
        amount,
        createdate,
        updatedate
      )
    VALUES(?, ?, ?, ?, ?)
  ";
  
  return execute_query($db, $sql, array($beer_id, $user_id, $amount, $createdate, $updatedate));
}

//update_cart_amount関数の定義
function update_cart_amount($db, $beer_id, $user_id, $updatedate, $amount){
    if(!preg_match(REGEXP_ALPHANUMERIC_update_stock, $amount)) {
        set_message('変更した購入数は1以上の整数を入力してください。');
        return false;
    }
    $get_stock = get_stock($db, $beer_id);
    if($get_stock['stock'] < $amount) {
        set_message('在庫数が足りないので変更できません。' . $get_stock['stock'] . '個までなら購入できます。');
        return false;
    }

    $sql = "
    UPDATE
      carts
    SET
      amount = ?,
      updatedate = ?
    WHERE
      beer_id = ?
    AND
      user_id = ?
  ";

  return execute_query($db, $sql, array($amount, $updatedate, $beer_id, $user_id));

}

function add_cart($db, $user_id, $beer_id, $createdate, $updatedate){
    $cart = get_identify_cart($db, $user_id, $beer_id);
    if($cart === false) {
        return insert_cart($db, $user_id, $beer_id, $createdate, $updatedate);
    }
    return update_cart_amount($db, $beer_id, $user_id, $updatedate, $cart['amount'] + 1);
}

//delete_cart関数の定義
function delete_cart($db, $beer_id, $user_id){
  $sql = '
    DELETE FROM
        carts
    WHERE
        beer_id = ?
    AND
        user_id = ?
  ';
  
  return execute_query($db, $sql, array($beer_id, $user_id));
}

//delete_user_carts関数の定義
function delete_user_carts($db, $user_id){
  $sql = "
    DELETE FROM
      carts
    WHERE
      user_id = ?
  ";

  execute_query($db, $sql, array($user_id));
}

function get_stock($db, $beer_id) {
  $sql = '
    SELECT
        stock
    FROM
        items
    WHERE
        beer_id = ' . $beer_id
  ;
  return fetch_query($db, $sql);
}

//insert_history関数の定義(購入履歴)
function insert_history($db, $user_id, $beer_id, $amount, $create_datetime) {
  $sql = "
    INSERT INTO
      history(
        user_id,
        beer_id,
        amount,
        create_datetime
      )
    VALUES(?, ?, ?, ?)
  ";

  return execute_query($db, $sql, array($user_id, $beer_id, $amount, $create_datetime));
}

//在庫を減らす処理
function decrease_stock($db, $update_datetime, $user_id){
  $sql = '
    UPDATE
        items 
    INNER JOIN
        carts
    ON
        items.beer_id = carts.beer_id
    SET
        items.stock = items.stock - carts.amount,
        items.update_datetime = ?
    WHERE
        user_id = ?
  ';
  
  return execute_query($db, $sql, array($update_datetime, $user_id));
}


//insert_details関数の定義(顧客情報履歴)
function customer_history($db, $user_id, $name1, $name2, $kana1, $kana2, $zipcode, $addr1, $addr2, $tel, $email, $pay, $create_datetime) {
  $sql = "
    INSERT INTO
      customer_history(
        user_id,
        name1,
        name2,
        kana1,
        kana2,
        zipcode,
        addr1,
        addr2,
        tel,
        email,
        pay,
        create_datetime
      )
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  ";

return execute_query($db, $sql, array($user_id, $name1, $name2, $kana1, $kana2, $zipcode, $addr1, $addr2, $tel, $email, $pay, $create_datetime));
}

function purchase_carts($db, $carts, $update_datetime, $user_id, $name1, $name2, $kana1, $kana2, $zipcode, $addr1, $addr2, $tel, $email, $pay, $create_datetime, $beer_id, $amount) {
    $get_stock = get_stock($db, $beer_id);
    if($get_stock['stock'] < $amount) {
        set_message('在庫数が足りないので変更できません。' . $get_stock['stock'] . '個までなら購入できます。');
        return false;
    }
    if(empty($beer_id) && empty($amount)) {
        set_message('購入に失敗しました。再度やり直してください。');
        return false;
    }
    decrease_stock($db, $update_datetime, $user_id);
    delete_user_carts($db, $user_id);
    customer_history($db, $user_id, $name1, $name2, $kana1, $kana2, $zipcode, $addr1, $addr2, $tel, $email, $pay, $create_datetime);
    foreach($carts as $value) {
        insert_history($db, $user_id, $value['beer_id'], $value['amount'], $create_datetime);
    }
    send_mail($name1, $name2, $zipcode, $addr1, $addr2, $tel, $email, $pay);
    return true;
}

function get_history($db, $user_id){
  $sql = '
    SELECT
        items.beer_id,
        items.name,
        items.price,
        items.img,
        history.amount,
        history.create_datetime
    FROM
        items
    INNER JOIN
        history
    ON
        items.beer_id = history.beer_id
    WHERE
        user_id =  ' . $user_id;
        
  return fetch_all_query($db, $sql);
}


?>