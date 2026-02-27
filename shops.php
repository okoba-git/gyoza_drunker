<?php
require_once __DIR__ . '/inc/function.php';

try {
    $result = get_display_menu_data();
} catch (PDOException $e) {
    debug_log($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ふくおか餃子FES！福岡の人気餃子店が一堂に集結！おいしいご当地餃子、焼き、蒸し、揚げなどいろいろな餃子7店舗の紹介。">
    <meta name="keywords" content="餃子,フェス,福岡,長浜,入場料無料,メニュー,2030">
    <meta name="author" content="ふくおか餃子FES">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ふくおか餃子FES">
    <meta property="og:title" content="出店店舗＆メニュー｜ふくおか餃子FES">
    <meta property="og:description"
        content="ふくおか餃子FES！2030年4月27日(日)～5月12日(日) 開催！福岡の人気餃子店が一堂に集結！おいしいご当地餃子、焼き、蒸し、揚げなどいろいろな餃子7店舗の紹介。">
    <meta property="og:image" content="img/ogp.png">
    <meta property="og:image:alt" content="ふくおか餃子FES">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/favicon.svg" type="image/svg+xml">
    <link rel="icon alternate" href="img/favicon.png" type="image/png">
    <title>出店店舗＆メニュー｜ふくおか餃子FES</title>
</head>

<body>
    <?php require_once __DIR__ . '/inc/header.php'; ?>


    <main class="l-wrapper">
        <h1 class="c-title">出店店舗＆メニュー</h1>
        <div class="c-section">

            <ul class="l-muCard-ul">
                <?php foreach ($result as $menu): ?>
                    <li class="c-mnCard l-mnCard">
                        <img src="./img/<?php echo $menu['file_name']; ?>" alt="<?php echo $menu['image_alt']; ?>" class="c-mnCard-img">
                        <p class="c-mnCard-bs l-mnCard-bs"><?php echo $menu['shop_num']; ?></p>
                        <p class="c-mnCard-title l-mnCard-title"><?php echo $menu['product_name']; ?></p>
                        <dl class="c-mnCard-des l-mnCard-des">
                            <dt>個数：</dt>
                            <dd><?php echo $menu['quantity']; ?>個入り</dd>
                            <dt>価格：</dt>
                            <dd><?php echo $menu['price']; ?>円（税込）</dd>
                            <dt>店名：</dt>
                            <dd><?php echo $menu['shop_name']; ?></dd>
                        </dl>
                        <div class="c-btn c-btn__red l-mnbtn__red">
                            <a href="shop-info.php?id=<?php echo $menu['product_id']; ?>">
                                詳細はこちら
                            </a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <p class="c-btn-jump">
            <a href="#top">TOP</a>
        </p>
    </main>
    <?php require_once __DIR__ . '/inc/footer.php'; ?>
    <script src="./js/hamburger.js"></script>
</body>

</html>