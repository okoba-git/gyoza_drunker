<?php
session_start();
require_once __DIR__ . ('/../inc/config.php');
require_once __DIR__ . ('/../inc/function.php');

if (!empty($_POST)) {
    if (!empty($_POST['userid']) && !empty($_POST['password'])) {
        $name = $_POST['userid'];
        $password = $_POST['password'];

        try {
            $db = db_connect();
            $sql = 'SELECT * FROM admins WHERE name=:name';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // if ($result) {
            //     if (password_verify($password, $result['password'])) {
            //         $_SESSION['id'] = $result['id'];
            //         $_SESSION['name'] = $result['name'];
            //         // $_SESSION['role'] = $result['role'];
            //         header('location:index.php');
            //         exit();
            //     }
            // }
            header('location:index.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:login.php');
exit();
