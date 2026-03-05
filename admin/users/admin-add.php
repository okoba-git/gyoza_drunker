<?php
require_once __DIR__ . '/../../inc/function.php';
$path = '..';
require_once __DIR__ . '/../inc/login-check.php';
?>

<!doctype html>
<html lang="ja">

<head>
    <title>管理者登録｜ふくおか餃子FES</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <?php require_once __DIR__ . '/../inc/header.php'; ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success">登録完了しました！</div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <h1 class="my-5">管理者ユーザー - 新規作成</h1>

        <form action="admin-add-do.php" method="post">
            <div class="mb-3 col">
                <label for="name" class="form-label">ユーザー名</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="mb-5 col">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="d-flex flex-row gap-2">
                <input type="submit" value="追加" class="btn btn-info btn-lg text-white" style="min-width:120px;">
                <a class="btn btn-info btn-lg text-white" href="admin-add.php" style="min-width:120px;">キャンセル</a>
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