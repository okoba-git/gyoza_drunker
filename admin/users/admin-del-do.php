<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['id'])) {
        // TODO: idのチェック（空の場合）
        $id = $_POST['id'];
        // DBに接続
        try {
            $db = db_connect();
            // usersテーブルから1行削除するSQL
            $sql = 'DELETE FROM admins WHERE id=:id';
            $stmt = $db->prepare($sql);
            // idをプレースホルダへバインド
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['success'] = '削除しました。';

            // トップページへ画面遷移
            header('location:admin-list.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
