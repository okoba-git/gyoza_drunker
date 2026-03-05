<?php require_once __DIR__ . ('/../inc/function.php');
require_once __DIR__ . ('/../inc/config.php');


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
    <link rel="stylesheet" href="../css/style.css">
    <title>トップページ</title>
</head>

<body class="l-wrapper">
    <?php require_once __DIR__ . '/inc/header.php'; ?>

    <h1 class="mb-5">トップページ</h1>
    <ul>
        <li class="list-group-item"><a href="users/admin-list.php" class="nav-link">管理者一覧</a></li>
        <li class="list-group-item"><a href="news/news-list.php" class="nav-link">お知らせ一覧</a></li>
        <li class="list-group-item"><a href="contact/contact-list.php" class="nav-link">お問い合わせ一覧</a></li>
        <li class="list-group-item"><a href="shop/shop-list.php" class="nav-link">店舗一覧</a></li>
        <li class="list-group-item"><a href="faq/faq-list.php" class="nav-link">FAQカテゴリ</a></li>
    </ul>


    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>