<?php
require_once __DIR__ . ('/../../inc/config.php');
require_once __DIR__ . ('/../../inc/function.php');

session_start();

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
    $sql2 = 'SELECT * FROM products WHERE shop_id = :id';
    $stmt2 = $db->prepare($sql2);
    $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt2->execute();
    $menu = $stmt2->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>商品詳細｜ふくおか餃子FES</title>
</head>

<body class="l-wrapper">
    <?php require_once __DIR__ . ('/../inc/header.php'); ?>
    <div class="container my-5">

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success">更新完了しました！</div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <h1 class="mb-4">商品 - 詳細</h1>

        <div class="d-flex flex-row gap-2 mb-3">
            <form action="menu-edit.php" method="post">
                <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                <button type="submit" class="btn btn-info text-white">
                    編集
                </button>
            </form>
        </div>

        <table class="table mb-5">
            <tbody>
                <tr>
                    <th class="col-2">作成日</th>
                    <td class="col-10"><?php echo $menu['create_at']; ?></td>
                </tr>
                <tr>
                    <th>商品名</th>
                    <td><?php echo $menu['name']; ?></td>
                </tr>
                <tr>
                    <th>提供個数</th>
                    <td><?php echo $menu['quantity']; ?></td>
                </tr>
                <tr>
                    <th>価格</th>
                    <td><?php echo $menu['price']; ?></td>
                </tr>
                <tr>
                    <th>商品紹介文</th>
                    <td><?php echo nl2br($menu['body']); ?></td>
                </tr>
                <tr>
                    <th>画像ファイル名</th>
                    <td><?php echo $menu['file_name']; ?></td>
                </tr>
                <tr>
                    <th>画像説明</th>
                    <td><?php echo $menu['image_alt']; ?></td>
                </tr>
            </tbody>
        </table>

        <div class=" text-center mt-4">
            <a href="shop-detail.php?id=<?php echo $shop['id']; ?>" class="btn btn-primary">商品一覧に戻る</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>