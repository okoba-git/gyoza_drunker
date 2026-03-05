<?php
require_once __DIR__ . '/../../inc/function.php';
$path = '..';
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

    // 商品情報取得
    $sql2 = 'SELECT name,id FROM products WHERE shop_id = :id';
    $stmt2 = $db->prepare($sql2);
    $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt2->execute();
    $menu = $stmt2->fetchALL(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $e->getMessage();
}
?>

<!doctype html>
<html lang="ja">

<head>
    <title>メニュー新規登録｜ふくおか餃子FES</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php require_once __DIR__ . '/../inc/header.php'; ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5">メニュー - 新規登録</h1>

        <form action="menu-add-do.php" method="post">
            <div class="mb-3 col">
                <label for="create_at" class="form-label">作成日</label>
                <input type="datetime-local" name="create_at" id="create_at" class="form-control" required>
            </div>

            <div class="mb-3 col">
                <label for="name" class="form-label">商品名</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3 d-flex gap-5">
                <div class="col">
                    <label for="quantity" class="form-label">提供個数</label>
                    <input type="text" name="quantity" id="quantity" class="form-control" placeholder="数字のみ入力してください。" required>
                </div>

                <div class="col">
                    <label for="price" class="form-label">価格</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="数字のみ入力してください。" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">商品紹介文</label>
                <textarea name="body" id="body" class="form-control" placeholder="商品の紹介文を入力してください。" style="min-height:200px;" required></textarea>
            </div>

            <div class="mb-3 d-flex gap-5">
                <div class="mb-3 col">
                    <label for="file_name" class="form-label">画像のファイル名</label>
                    <input type="text" name="file_name" id="file_name" class="form-control" placeholder="例：menu01.jpg" required>
                </div>

                <div class="mb-3 col">
                    <label for="image_alt" class="form-label">画像の説明</label>
                    <input type="text" name="image_alt" id="image_alt" class="form-control" placeholder="例：肉汁あふれる焼き餃子" required>
                </div>
            </div>

            <div class="d-flex flex-row gap-2">
                <input type="hidden" name="shop_id" value="<?php echo $shop['id']; ?>">
                <button type="submit" class="btn btn-info text-white" style="min-width:120px;">
                    登録
                </button>

                <a class="btn btn-info btn-lg text-white" href="menu-add.php?id=<?php echo $shop['id']; ?>" style="min-width:120px;">キャンセル</a>
            </div>
        </form>

        <div class=" text-center">
            <a href="./shop-detail.php?id=<?php echo $shop['id']; ?>" class="btn btn-primary mt-3">店舗詳細に戻る</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>