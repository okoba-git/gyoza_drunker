<?php
require_once __DIR__ . ('/../../inc/config.php');
require_once __DIR__ . ('/../../inc/function.php');

// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['update_at']) && !empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['body']) && !empty($_POST['id'])) {
        // 必須項目チェック（空の場合）
        $update_at = $_POST['update_at'];
        $author = $_POST['author'];
        $title = $_POST['title'];
        $body = $_POST['body'];

        // DBに接続
        try {
            $db = db_connect();
            // infoテーブルに1行挿入するSQL
            $sql = 'UPDATE news SET update_at=:update_at, author=:author, title=:title, body=:body WHERE id=:id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':update_at', $update_at, PDO::PARAM_STR);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->execute();

            session_start();
            $_SESSION['success'] = true;

            // お知らせ編集へ画面遷移
            header('location:news-edit.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
