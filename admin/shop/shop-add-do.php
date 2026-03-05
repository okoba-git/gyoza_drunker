<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['shop-name']) && !empty($_POST['shop_num']) && !empty($_POST['body'])) {
        // TODO: 必須項目チェック（空の場合）
        $name = $_POST['shop-name'];
        $shop_num = $_POST['shop_num'];
        $body = $_POST['body'];
        // 日付けが空文字だったら当日のデータ、空文字じゃなかったら送信されたデータを代入
        $date = empty($_POST['date']) ? date('Y-m-d') : $_POST['date'];

        // DBに接続
        try {
            $db = db_connect();
            // shopsに1行挿入するSQL
            $sql = 'INSERT INTO shops (shop_num,name,body,create_at) VALUES (:shop_num,:name,:body,:create_at)';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':shop_num', $shop_num, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->bindParam(':create_at', $date, PDO::PARAM_STR);
            $stmt->execute();

            // トップページへ画面遷移
            header('location:shop-list.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
