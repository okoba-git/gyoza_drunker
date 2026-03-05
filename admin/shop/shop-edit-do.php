<?php
require_once __DIR__ . ('/../../inc/config.php');
require_once __DIR__ . ('/../../inc/function.php');

// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (
        !empty($_POST['shop_num']) &&
        !empty($_POST['name']) &&
        !empty($_POST['body']) &&
        !empty($_POST['id'])
    ) {
        // 必須項目チェック（空の場合）
        $shop_num = $_POST['shop_num'];
        $name = $_POST['name'];
        $body = $_POST['body'];
        $update_at = date('Y-m-d H:i:s');
        $id = (int)$_POST['id'];

        // DBに接続
        try {
            $db = db_connect();
            // productテーブルに1行更新するSQL
            $sql = 'UPDATE shops SET shop_num=:shop_num, name=:name, body=:body,update_at=NOW()  WHERE id=:id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':shop_num', $shop_num, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            session_start();
            $_SESSION['success'] = true;

            // お知らせ編集へ画面遷移
            header('location:shop-detail.php?id=' . $id);
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
