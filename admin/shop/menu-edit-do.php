<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (
        !empty($_POST['name']) &&
        !empty($_POST['quantity']) &&
        !empty($_POST['price']) &&
        !empty($_POST['body']) &&
        !empty($_POST['file_name']) &&
        !empty($_POST['image_alt']) &&
        !empty($_POST['id'])
    ) {
        // 必須項目チェック（空の場合）
        $name = $_POST['name'];
        $body = $_POST['body'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $file_name = $_POST['file_name'];
        $image_alt = $_POST['image_alt'];
        $update_at = date('Y-m-d H:i:s');
        $id = (int)$_POST['id'];

        // DBに接続
        try {
            $db = db_connect();
            // productテーブルに1行更新するSQL
            $sql = 'UPDATE products SET name=:name, body=:body, quantity=:quantity, price=:price, file_name=:file_name, image_alt=:image_alt, update_at=NOW()  WHERE id=:id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
            $stmt->bindParam(':image_alt', $image_alt, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            session_start();
            $_SESSION['success'] = true;

            // お知らせ編集へ画面遷移
            header('location:menu-detail.php?id=' . $id);
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
