<?php
require_once __DIR__ . ('/../../inc/config.php');
require_once __DIR__ . ('/../../inc/function.php');

session_start();

// DBに接続
try {
    $db = db_connect();
    $sql = 'SELECT * FROM admins';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $admins_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}

?>
<!doctype html>
<html lang="ja">

<head>
    <title>ふくおか餃子FES｜管理者一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <?php
    require_once __DIR__ .  '/../inc/header.php';
    ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success">削除完了しました！</div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <h1 class="my-5">管理者 - 一覧</h1>
        <a class="mb-4 btn btn-primary btn-lg" href="admin-add.php">ユーザー新規登録</a>

        <?php if (count($admins_array) > 0): ?>
            <table class="table table-user">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ユーザー名</th>
                        <th>編集 / 削除</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($admins_array as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td class="d-flex flex-row gap-2">
                                <form action="admin-edit.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="btn btn-info text-white">
                                        編集
                                    </button>
                                </form>

                                <form action="admin-del-do.php" method="post" onsubmit="return confirm('本当に削除してもよろしいですか?')">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="btn btn-danger">
                                        削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>ユーザーは登録されていません。</p>
        <?php endif; ?>

        <div class=" text-center">
            <a href="../index.php" class="btn btn-primary mt-3">TOPに戻る</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>