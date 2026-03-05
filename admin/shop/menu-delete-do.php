<?php
require_once __DIR__ . '/../../inc/function.php';
$path = '..';
require_once __DIR__ . '/../inc/login-check.php';

// データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['shop_id']) && !empty($_POST['menu_id'])) {
        // idのチェック（空の場合）
        $shop_id = (int)$_POST['shop_id'];
        $menu_id = (int)$_POST['menu_id'];
        // DBに接続
        try {
            $db = db_connect();
            // usersテーブルから1行削除するSQL
            $sql = 'DELETE FROM products WHERE id=:id';
            $stmt = $db->prepare($sql);
            // idをプレースホルダへバインド
            $stmt->bindParam(':id', $menu_id, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['delete'] = true;

            // トップページへ画面遷移
            header('location:shop-detail.php?id=' . $shop_id);
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
