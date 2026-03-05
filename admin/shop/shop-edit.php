<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

// DBに接続
// ID取得とバリデーション
try {
    $id = $_GET['id'];
    $db = db_connect();
    // 店舗情報取得
    $sql = 'SELECT * FROM shops WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $shop = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>店舗情報更新｜ふくおか餃子FES</title>
</head>

<body class="l-wrapper">
    <?php require_once __DIR__ . ('/../inc/header.php'); ?>
    <h1 class="c-title">店舗情報 - 編集</h1>

    <form action="shop-edit-do.php" method="post" class="needs-validation mb-3" novalidate>
        <div class="mb-3">
            <label for="shop_name" class="form-label">店舗名</label>
            <input type="text" name="shop_name" id="shop_name" class="form-control" value="<?php echo $shop['name']; ?>" placeholder="店舗名を入力してください。" required>
        </div>

        <div class="mb-3">
            <label for="shop_num" class="form-label">ブース番号</label>
            <input type="text" name="shop_num" id="shop_num" class="form-control" value="<?php echo $shop['shop_num']; ?>" placeholder="例：B-01">
        </div>

        <div class="mb-5">
            <label for="body" class="form-label">紹介文</label>
            <textarea name="body" id="body" class="form-control" placeholder="紹介文を入力してください。" required>
                <?php echo $shop['body']; ?>
            </textarea>
        </div>

        <div class="d-flex gap-2 mb-3">
            <input type="submit" value="更新" class="btn btn-info text-white btn-lg">
            <a href="shop-list.php" class="btn btn-secondary btn-lg">キャンセル</a>
        </div>
    </form>

    <div class=" text-center mt-4">
        <a href="shop-detail.php?id=<?php echo $shop['id']; ?>" class="btn btn-primary btn-lg">店舗詳細に戻る</a>
    </div>


    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>