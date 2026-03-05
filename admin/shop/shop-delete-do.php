<?php
require_once __DIR__ . '/../../inc/function.php';
$path = '..';
require_once __DIR__ . '/../inc/login-check.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['id'])) {
        // TODO: idのチェック（空かどうか）
        $id = $_POST['id'];
        // DBに接続
        try {
            $db = db_connect();
            // shopsテーブルから1行削除するSQL
            $sql = 'DELETE FROM shops WHERE id=:id';
            $stmt = $db->prepare($sql);
            // idをプレースホルダへバインド
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // トップページへ画面遷移
            header('location:shop-list.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
