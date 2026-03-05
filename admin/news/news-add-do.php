<?php
require_once __DIR__ . '/../../inc/function.php';
$path = '..';
require_once __DIR__ . '/../inc/login-check.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['body'])) {
        // TODO: 必須項目チェック（空の場合）
        $author = $_POST['author'];
        $title = $_POST['title'];
        $body = $_POST['body'];
        $create_at = $_POST['create_at'];

        // DBに接続
        try {
            $db = db_connect();
            // infoテーブルに1行挿入するSQL
            $sql = 'INSERT INTO news (author,title,body,create_at) VALUES (:author,:title,:body,:create_at)';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->bindParam(':create_at', $create_at, PDO::PARAM_STR);
            $stmt->execute();

            session_start();
            $_SESSION['success'] = true;

            // トップページへ画面遷移
            header('location:news-add.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
