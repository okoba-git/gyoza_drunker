<?php
$path = '..';
require_once __DIR__ . '/../inc/login-check.php'; 
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>店舗 - 詳細</title>
</head>

<body class="l-wrapper">
    <?php require_once __DIR__ . '/../inc/header.php'; ?>
    <h1 class="mb-5">店舗 - 追加</h1>
    <!-- メッセージ -->
    <?php require_once __DIR__ . '/../../inc/message_area.php'; ?>
    <!-- フォーム -->
    <form action="shop-add-do.php" method="post" class="needs-validation mb-3" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">店舗名</label>
            <input type="text" name="shop-name" id="shop-name" class="form-control" required>
            <div class="invalid-feedback">
                店舗名を入力してください
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label for="date" class="form-label">追加日</label>
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="col">
                <label for="shop_num" class="form-label">ブース番号</label>
                <input type="text" name="shop_num" id="shop_num" class="form-control" required>
                <div class="invalid-feedback">
                    ブース番号を入力してください
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">説明文</label>
            <textarea name="body" id="body" class="form-control" required></textarea>
            <div class="invalid-feedback">
                店舗の説明文を入力してください
            </div>
        </div>
        <div class="mb-3">
            <input type="submit" value="完了" class="btn btn-primary">
            <a href="shop-list.php" class="btn btn-secondary">キャンセル</a>
        </div>
    </form>


    <div class=" text-center">
        <a href="shop-list.php" class="btn btn-primary mt-3">店舗一覧に戻る</a>
    </div>


    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>