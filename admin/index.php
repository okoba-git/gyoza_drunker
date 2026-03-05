<?php
require_once __DIR__ . ('/../inc/function.php');

session_start();
if (!isset($_SESSION['id'])) {
    header('location:login.php');
    exit();
}

try {
    $db = db_connect();
    $sql = 'SELECT name,shop_num FROM shops';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>トップページ</title>
</head>

<body>
    <?php
    $link = '.';
    require_once __DIR__ . '/inc/header.php';
    ?>
    <main class="container">
        <div class="l-wrapper">
            <h1 class="my-5 text-center">トップページ</h1>
            <div class="d-flex justify-content-center text-center">
                <ul class="list-group col-5">
                    <a href="users/admin-list.php" class="list-group-item list-group-item-action">管理者一覧</a>
                    <a href="news/news-list.php" class="list-group-item list-group-item-action">お知らせ一覧</a>
                    <a href="contact/contact-list.php" class="list-group-item list-group-item-action">お問い合わせ一覧</a>
                    <a href="shop/shop-list.php" class="list-group-item list-group-item-action">店舗一覧</a>
                    <a href="faq/faq-list.php" class="list-group-item list-group-item-action">FAQカテゴリ</a>
                </ul>
            </div>

        </div>
    </main>
    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>