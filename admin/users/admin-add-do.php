<?php
require_once __DIR__ . '/../../inc/function.php';
$path = '..';
require_once __DIR__ . '/../inc/login-check.php';

// TODO: POST送信されているかチェック
if (!empty($_POST)) {

    // TODO: 必須項目が入力されているかチェック
    if (!empty($_POST['name']) && !empty($_POST['password'])) {
        // TODO: $_POSTから値を取り出す
        $name = $_POST['name'];
        $password = $_POST['password'];

        // TODO: ユーザー名の書式チェック(半角英数4文字以上)
        if (!preg_match('/^[a-zA-Z0-9_-]{4,}$/', $name)) {
            header('location:admin-add.php');
            exit();
        }
        // TODO: ユーザー名が重複していないかチェック
        try {
            $db = db_connect();
            $sql = 'SELECT COUNT(name) FROM admins WHERE name=:name';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NUM);

            if ($result[0] !== 0) {
                header('location:admin-add.php');
                exit();
            }

            // TODO: パスワードをハッシュ化(password_hash())
            $password_h = password_hash($password, PASSWORD_DEFAULT);

            // usersテーブルに登録
            $sql_2 = 'INSERT INTO admins (name,pass,create_at,update_at) VALUES (:name,:pass,now(),now())';
            $stmt_2 = $db->prepare($sql_2);
            $stmt_2->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt_2->bindParam(':pass', $password_h, PDO::PARAM_STR);
            $stmt_2->execute();

            session_start();
            $_SESSION['success'] = true;
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:admin-add.php');
exit();
