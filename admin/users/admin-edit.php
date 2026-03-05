<?php
require_once __DIR__ . '/../../inc/function.php';
$path = '..';
require_once __DIR__ . '/../inc/login-check.php';

// DBに接続
// TODO: ID取得とバリデーション
$id = (int)$_POST['id'];

// DB接続
try {
    $db = db_connect();
    $sql = 'SELECT id,name FROM admins WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $target = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}
?>

<!doctype html>
<html lang="ja">

<head>
    <title>管理者更新｜ふくおか餃子FES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php require_once __DIR__ . '/../inc/header.php'; ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5">管理者ユーザー - 編集</h1>
        <!-- メッセージ -->
        <?php require_once __DIR__ . '/../../inc/message_area.php'; ?>
        <form action="admin-edit-do.php" method="post">
            <div class="mb-3 col">
                <label for="name" class="form-label">ユーザー名</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $target['name']; ?>">
            </div>

            <div class="mb-5 col">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="mb-3">
                <input type="hidden" name="id" value="<?php echo $target['id']; ?>">
                <input type="submit" value="変更する" class="btn btn-info btn-lg text-white" style="min-width:120px;">
            </div>
        </form>

        <div class=" text-center">
            <a href="./admin-list.php" class="btn btn-primary mt-3">一覧画面に戻る</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>