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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>トップページ</title>
</head>

<body class="l-wrapper">
    <?php require_once __DIR__ . '/inc/header.php'; ?>

    <h1 class="mb-5">トップページ</h1>
    <ul>
        <li class="list-group-item"><a href="users/admin-list.php" class="nav-link">管理者一覧</a></li>
        <li class="list-group-item"><a href="news/news-list.php" class="nav-link">お知らせ一覧</a></li>
        <li class="list-group-item"><a href="contact/contact-check.php" class="nav-link">お問い合わせ一覧</a></li>
        <li class="list-group-item"><a href="shop/shop-list.php" class="nav-link">店舗一覧</a></li>
        <li class="list-group-item"><a href="faq/faq-list.php" class="nav-link">FAQカテゴリ</a></li>
    </ul>


    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>