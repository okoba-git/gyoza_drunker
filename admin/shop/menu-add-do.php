<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

if (!empty($_POST)) {

    if (
        !empty($_POST['name']) &&
        !empty($_POST['body']) &&
        !empty($_POST['quantity']) &&
        !empty($_POST['price']) &&
        !empty($_POST['file_name']) &&
        !empty($_POST['image_alt']) &&
        !empty($_POST['shop_id'])
    ) {

        $name = $_POST['name'];
        $body = $_POST['body'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $file_name = $_POST['file_name'];
        $image_alt = $_POST['image_alt'];
        $create_at = $_POST['create_at'];
        $shop_id = (int)$_POST['shop_id'];

        try {

            $db = db_connect();

            $sql = 'INSERT INTO products
            (name,body,quantity,price,file_name,image_alt,create_at,shop_id)
            VALUES
            (:name,:body,:quantity,:price,:file_name,:image_alt,NOW(),:shop_id)';

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
            $stmt->bindParam(':image_alt', $image_alt, PDO::PARAM_STR);
            $stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);

            $stmt->execute();

            session_start();
            $_SESSION['success'] = true;

            header('location:shop-detail.php?id=' . $shop_id);
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
