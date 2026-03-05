<?php
require_once __DIR__ . ('/../inc/function.php');
session_start();

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

            if ($result) {
                if (password_verify($password, $result['pass'])) {
                    $_SESSION['id'] = $result['id'];
                    $_SESSION['name'] = $result['name'];
                    $_SESSION['res_message'] = ['type' => 1, 'msg' => 'ログイン成功'];
                    header('location:index.php');
                    exit();
                }
                $_SESSION['res_message'] = ['type' => 0, 'msg' => 'パスワードが一致しませんでした'];
                header('location:login.php');
                exit();
            }
            $_SESSION['res_message'] = ['type' => 0, 'msg' => 'resultがありませんでした'];
            header('location:login.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
            $_SESSION['res_message'] = ['type' => 0, 'msg' =>  $e->getMessage()];
        }
    }
    $_SESSION['res_message'] = ['type' => 0, 'msg' => 'POSTの値の取得に失敗しました。'];
}
$_SESSION['res_message'] = ['type' => 0, 'msg' => 'POSTの取得に失敗しました。'];
header('location:login.php');
exit();
