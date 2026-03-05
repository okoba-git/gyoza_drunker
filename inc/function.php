<?php
require_once __DIR__ . '/config.php';

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
function get_display_menu_data($product_id = 0)
{
    $db = db_connect();
    $sql = 'SELECT 
            products.id AS product_id, 
            products.name AS product_name, 
            products.body AS product_body, 
            products.quantity, 
            products.price, 
            products.file_name, 
            products.image_alt,
            shops.shop_num, 
            shops.name AS shop_name, 
            shops.body AS shop_body 
            FROM products JOIN shops ON shops.id = products.shop_id WHERE shops.is_delete = 0';
    $add = $product_id !== 0 ? ' AND products.id=:id' : '';
    $stmt = $db->prepare($sql . $add);
    if ($product_id !== 0) {
        $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $product_id !== 0 ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * faq取得関数
 * 
 * faq一覧をDBから取得する関数。
 * 引数にfaqIDを渡したときは対象faqのみ、それ以外の場合はすべてのfaqを返す。
 * faq_idのみ入力渡したい場合は第一引数に0を渡す
 * 
 * @param int $category_id カテゴリID。特定のカテゴリに属するfaq取得したい場合に引数に渡す。
 * @param int $faq_id 取得したいfaqのID。
 * @return 連想配列 faq_idを渡した場合はfetch(PDO::FETCH_ASSOC)、無しの場合はfetchAll(PDO::FETCH_ASSOC)を返す。
 */
function get_faq_data($category_id = 0, $faq_id = 0)
{
    $db = db_connect();
    // faqを取得
    $sql = 'SELECT
            faq.id,
            faq.question, 
            faq.answer,
            faq.category as category_id,
            faq_categories.name as category_name,
            faq.create_at,
            faq.update_at
            FROM faq JOIN faq_categories ON faq.category = faq_categories.id 
            WHERE faq_categories.is_delete = 0 ';
    $faq = $faq_id !== 0 ? ' AND faq.id=:faq_id' : '';
    $catagory = $category_id !== 0 ? ' AND faq_categories.id=:category_id' : '';
    $stmt = $db->prepare($sql . $faq . $catagory);
    if ($faq_id !== 0) {
        $stmt->bindParam(':faq_id', $faq_id, PDO::PARAM_INT);
    }
    if ($category_id !== 0) {
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $faq_id !== 0 ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * faqカテゴリー取得関数
 * 
 * @param int $id 取得したいfaqカテゴリーID。入力無しまたは0ですべて。
 * @param bool $is_get_delete 論理削除済みのカテゴリーを取得するかどうか。falseで取得しない。
 * @return 連想配列 idを渡した場合はfetch(PDO::FETCH_ASSOC)、無しの場合はfetchAll(PDO::FETCH_ASSOC)を返す。
 */
function get_faq_category_data($id = 0, $is_get_delete = true)
{
    $db = db_connect();
    $where = [];
    $where[] = 'WHERE 1';
    $where[] = $id === 0 ? '' : 'AND id = :id';
    $where[] = $is_get_delete ? '' : 'AND is_delete = 0';
    $sql = [
        'SELECT id, name, sort_order, is_delete, create_at, update_at FROM faq_categories',
        implode(' ', $where),
        'ORDER BY sort_order ASC'
    ];
    $stmt = $db->prepare(implode(' ', $sql));
    if ($id !== 0) {
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $id !== 0 ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * FAQカテゴリーから同じソート番号を持つレコードのID取得関数
 * 
 * @param int $sort_order 検索したいソート番号
 * @return int FAQカテゴリーID。一致しなければ0を返す。
 */
function find_match_sort_order($sort_order)
{
    $db = db_connect();
    // faqを取得
    $sql = 'SELECT id FROM faq_categories WHERE sort_order = :sort_order';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['id'] : 0;
}

/**
 * 一番大きいソート番号の次の番号を取得
 * 
 * @return int FAQカテゴリーテーブルのソート番号で一番大きいもの次の値を取得
 */
function get_next_sort_order()
{
    // 一番大きいソート番号をインクリメントしたものを取得取得
    $db = db_connect();
    $sql = 'SELECT sort_order FROM faq_categories ORDER BY sort_order DESC LIMIT 1';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $max_num = $stmt->fetch(PDO::FETCH_COLUMN);
    return $max_num ? $max_num + 1 : 1;
}

/**
 * GET(POST)メソッドの値が取得できているかチェック
 * @param ...$values 可変長引数、取得してきている値を,区切りで渡す
 * @return bool すべて取得していればtrue,一つでも取得されていなければfalseを返す
 */
function isAvailableMethodValue(...$values){
    foreach($values as $value){
        if($value === ''){
            return false;
        }
    }
    return true;
}

/**
 * 配列を表示する。
 * 
 * var_dumpを<pre>で囲んで表示する。デバッグ用なので必ず消すこと。
 * 
 * @param array $array デバッグ表示したい配列
 */
function debug_var_dump($array)
{
    echo '<pre>';
    var_dump($array);
    echo '</pre>';
}

// 
/**
 * セキュリティ対策（XSS対策）のための関数
 * 
 * @param string $s 画面に表示したい文字列
 */
function secure($s)
{
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

/**
 * デバッグ用の処理
 * 
 * メッセージをechoするだけの処理。後々にエラーログ対応する。
 * 
 * @param string $message 表示したい文字列
 */
function debug_log($message)
{
    echo $message;
}
