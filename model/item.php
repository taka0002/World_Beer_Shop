<?php

//設定ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//画像関連
$img_dir = './img/';    // アップロードした画像ファイルの保存ディレクトリ
$data = array();
$new_img_filename = '';   // アップロードした新しい画像ファイル名
$msg = [];
$user_id = 0;

function get_items($db){
  $sql = '
    SELECT
        beer_id,
        name,
        price,
        img,
        stock,
        status,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment,
        featured
    FROM 
        items
  ';


  return fetch_all_query($db, $sql);
}

function insert_items($db,$newname, $newprice, $new_img_filename, $status, $stock, $type_sharp, $type_acidity, $type_bitterness, $type_sweetness, $type_tasty, $appetizers, $area, $comment, $featured, $create_datetime, $update_datetime){
    
    if($newname === '') {
        set_message('登録できませんでした。もう一度やり直してください。');
        return false;
    }
    
    if($newprice === '') {
        set_message('登録できませんでした。もう一度やり直してください。');
        return false;
     }
     
    if($stock === '') {
        set_message('登録できませんでした。もう一度やり直してください。');
        return false;
    }
    
    if($comment === '') {
        set_message('登録できませんでした。もう一度やり直してください。');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_newprice, $newprice)) {
        set_message('登録できませんでした。もう一度やり直してください。');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_stock, $stock)) {
        set_message('登録できませんでした。もう一度やり直してください。い');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_status, $status)) {
        set_message('不正なステータスでです');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_featured, $featured)) {
        set_message('不正なステータスでです');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_type_sharp, $type_sharp)) {
        set_message('不正なステータスでです');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_type_acidity, $type_acidity)) {
        set_message('不正なステータスでです');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_type_bitterness, $type_bitterness)) {
        set_message('不正なステータスでです');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_type_sweetness, $type_sweetness)) {
        set_message('不正なステータスでです');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_type_tasty, $type_tasty)) {
        set_message('不正なステータスでです');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_appetizers, $appetizers)) {
        set_message('不正なステータスでです');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_area, $area)) {
        set_message('不正なステータスでです');
        return false;
    }
    
    if (is_uploaded_file($_FILES['new_img']['tmp_name']) === TRUE) {
        
        // 画像の拡張子を取得
        $extension = pathinfo($_FILES['new_img']['name'], PATHINFO_EXTENSION);
        
        // 指定の拡張子であるかどうかチェック
        if ($extension === 'JPEG' || $extension === 'jpeg' || $extension === 'JPG' || $extension === 'jpg' || $extension === 'PNG' || $extension === 'png') {
          
          // 保存する新しいファイル名の生成（ユニークな値を設定する）
          $new_img_filename = sha1(uniqid(mt_rand(), true)). '.' . $extension;
          
          $img_dir = '../html/assets/img/'; 
          
          // 同名ファイルが存在するかどうかチェック
          if (is_file($img_dir . $new_img_filename) !== TRUE) {
           
            // アップロードされたファイルを指定ディレクトリに移動して保存
            if (move_uploaded_file($_FILES['new_img']['tmp_name'], $img_dir . $new_img_filename) !== TRUE) {
                set_message('ファイルアップロードに失敗しました');
                return false;
            }
          } else {
            set_message('ファイルアップロードに失敗しました。再度お試しください。');
            return false;
          }
        } else {
          set_message('ファイル形式が異なります。画像ファイルはJPEG・PNGのみ利用可能です。（小文字可能）');
          return false;
        }
    } else {
       set_message('ファイルを選択してください');
       return false;
    }
    
  $sql = '
    INSERT
    INTO
        items
        (
        name, 
        price,
        img,
        status,
        stock,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment,
        featured,
        create_datetime,
        update_datetime
        )
    VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

  return execute_query($db, $sql, array($newname, $newprice, $new_img_filename, $status, $stock, $type_sharp, $type_acidity, $type_bitterness, $type_sweetness, $type_tasty, $appetizers, $area, $comment, $featured, $create_datetime, $update_datetime));
}



function get_user_name($db, $user_id){
  $sql = '
    SELECT
        user_id,
        username
    FROM
        users
    WHERE
        user_id = ' . $user_id;

  //返り値は1行だけ
  return fetch_query($db, $sql);
}

function get_count($db, $user_id) {
  $sql = '
    SELECT
        beer_id
    FROM
        carts
    where
        user_id = '.$user_id;
        
  //返り値は1行だけ
  return fetch_all_query($db, $sql);
}

function get_cost_up($db) {
  $sql = '
    SELECT
        beer_id,
        name,
        price,
        img,
        stock,
        status,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment
    FROM
        items
    ORDER BY
        price
    ASC';
    
  return fetch_all_query($db, $sql);
}

function get_cost_down($db) {
  $sql = '
    SELECT
        beer_id,
        name,
        price,
        img,
        stock,
        status,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment
    FROM
        items
    ORDER BY
        price
    DESC';
    
  return fetch_all_query($db, $sql);
}

function get_items_list($db, $user_id, $limit = 5, $offset = 0){
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
        user_id =  ' . $user_id . '
    ORDER BY
        create_datetime DESC
    limit ?
    offset ?';
    
  //返り値はすべての行
  return fetch_all_query($db, $sql, array($limit, $offset));
}

function get_items_count($db, $user_id) {
  $sql = '
    SELECT
        count(*)
    FROM
        history
    WHERE
        user_id =  ' . $user_id;
        
    $result = fetch_all_query($db, $sql);

    return $result[0]['count(*)'];
}

function update_item_stock($db, $beer_id, $update_stock, $update_datetime){
    if($update_stock === '') {
        set_message('変更した在庫数を入力してください');
        return false;
    }
    
    if(!preg_match(REGEXP_ALPHANUMERIC_update_stock, $update_stock)) {
        set_message('変更した在庫数は1以上の整数を入力してください');
        return false;
    }
  $sql = "
    UPDATE
      items
    SET
      stock = ?,
      update_datetime = ?
    WHERE
      beer_id = ?
    LIMIT 1
  ";
  
  return execute_query($db, $sql, array($update_stock, $update_datetime, $beer_id));
}

function change_item_status($db, $beer_id, $update_datetime, $status){
    if($status === "0") {
        
      $sql = '
        UPDATE
            items
        SET 
            status = 1,
            update_datetime = ? 
        WHERE
            beer_id = ?
        ';
        
      return execute_query($db, $sql, array($update_datetime, $beer_id)); 
        
    } else {
        
      $sql = '
        UPDATE
            items
        SET 
            status = 0,
            update_datetime = ? 
        WHERE
            beer_id = ?
        ';
        
      return execute_query($db, $sql, array($update_datetime, $beer_id)); 
        
    }
}

function change_item_featured($db, $beer_id, $update_datetime, $featured){
    if($featured === "0") {
        
      $sql = '
        UPDATE
            items
        SET 
            featured = 1,
            update_datetime = ? 
        WHERE
            beer_id = ?
        ';
        
      return execute_query($db, $sql, array($update_datetime, $beer_id)); 
        
    } else {
        
      $sql = '
        UPDATE
            items
        SET 
            featured = 0,
            update_datetime = ? 
        WHERE
            beer_id = ?
        ';
        
      return execute_query($db, $sql, array($update_datetime, $beer_id)); 
        
    }
}

function delete_item($db,$beer_id) {
  $sql = '
    DELETE
    FROM
        items
    WHERE beer_id = ?
  ';
  
  return execute_query($db, $sql, array($beer_id));
}

function get_search_all($db, $area, $appetizers, $name) {
    
  $sql = '
    SELECT
        beer_id,
        name,
        price,
        img,
        stock,
        status,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment
    FROM
        items
    WHERE
        area = ?
    or
        appetizers = ?
    or
        name LIKE ?';
  
    return fetch_all_query($db, $sql, array($area, $appetizers, '%' . $name . '%'));
}

function get_search_area_appetizers($db, $area, $appetizers) {
    
  $sql = '
    SELECT
        beer_id,
        name,
        price,
        img,
        stock,
        status,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment
    FROM
        items
    WHERE
        area = ?
    or
        appetizers = ?';
  
    return fetch_all_query($db, $sql, array($area, $appetizers));
}

function get_search_area_name($db, $area, $name) {
    
  $sql = '
    SELECT
        beer_id,
        name,
        price,
        img,
        stock,
        status,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment
    FROM
        items
    WHERE
        area = ?
    or
        name LIKE ?';
  
    return fetch_all_query($db, $sql, array($area, '%' . $name . '%'));
}

function get_search_appetizers_name($db, $appetizers, $name) {
    
  $sql = '
    SELECT
        beer_id,
        name,
        price,
        img,
        stock,
        status,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment
    FROM
        items
    WHERE
        appetizers = ?
    or
        name LIKE ?';
  
    return fetch_all_query($db, $sql, array($appetizers, '%' . $name . '%'));
}

function get_search_area($db, $area) {
    
  $sql = '
    SELECT
        beer_id,
        name,
        price,
        img,
        stock,
        status,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment
    FROM
        items
    WHERE
        area =  ?';
  
    return fetch_all_query($db, $sql, array($area));
}

function get_search_appetizers($db, $appetizers) {
    
  $sql = '
    SELECT
        beer_id,
        name,
        price,
        img,
        stock,
        status,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment
    FROM
        items
    WHERE
        appetizers = ?';
  
    return fetch_all_query($db, $sql, array($appetizers));
}

function get_search_name($db, $name) {
  $sql = '
    SELECT
        beer_id,
        name,
        price,
        img,
        stock,
        status,
        type_sharp,
        type_acidity,
        type_bitterness,
        type_sweetness,
        type_tasty,
        appetizers,
        area,
        comment
    FROM
        items
    WHERE
        name LIKE ?';
  
    return fetch_all_query($db, $sql, array('%' . $name . '%'));
}

?>
