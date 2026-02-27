<?php

// DBへ接続する関数
function db_connect()
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}

/**
 * メニュー表示用データ取得関数
 * 
 * メニュー表示に使用するための配列データをDBから取得する関数。
 * 引数に商品IDを渡したときは対象のみ、それ以外の場合はすべてのメニューを返す
 *
 * @param int $product_id 取得したいメニューの商品ID。
 * @return 連想配列 引数がある場合はfetch(PDO::FETCH_ASSOC)、引数無しの場合はfetchAll(PDO::FETCH_ASSOC)を返す。
 */
function get_display_menu_data ($product_id = 0) {
    $db = db_connect();
    $sql = 'SELECT 
            products.id AS product_id, 
            products.name AS product_name, 
            products.body AS product_body, 
            products.quantity, 
            products.price, 
            products.file_name, 
            shops.shop_num, 
            shops.name AS shop_name, 
            shops.body AS shop_body 
            FROM products JOIN shops ON shops.id = products.shop_id WHERE shops.is_deleted = 0';
    $add = $product_id !== 0 ? ', products.id=:id' : '';
    $stmt = $db->prepare($sql . $add);
    if($product_id !== 0){
        $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $product_id === 0 ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
}