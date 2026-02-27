<?php
require_once __DIR__ . '/inc/function.php';

$product_id = (int)$_GET['id'];
try {
    $menu = get_display_menu_data($product_id);
    debug_var_dump($menu);
} catch (PDOException $e) {
    debug_log($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ふくおか餃子FES！<?php echo $menu['shop_name']; ?>の出店商品の詳細情報。<?php echo $menu['product_name']; ?>、<?php echo $menu['price']; ?>円、<?php echo $menu['shop_name']; ?>">
    <meta name="keywords" content="餃子,フェス,福岡,長浜,入場料無料,<?php echo $menu['shop_name']; ?>,2030">
    <meta name="author" content="ふくおか餃子FES">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ふくおか餃子FES">
    <meta property="og:title" content="<?php echo $menu['shop_name']; ?>｜ふくおか餃子FES">
    <meta property="og:description"
        content="ふくおか餃子FES！2030年4月27日(日)～5月12日(日) 開催！出展企業「<?php echo $menu['shop_name']; ?>」の商品詳細情報はこちら。<?php echo $menu['product_name']; ?>、<?php echo $menu['price']; ?>円">
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

    <title><?php echo $menu['shop_name']; ?>｜ふくおか餃子FES</title>
</head>

<body>
    <?php require_once __DIR__ . '/inc/header.php'; ?>


    <main class="l-main l-wrapper">
        <p class="c-btn-jump">
            <a href="#top">TOP</a>
        </p>
        <section class="c-section c-menu_section">
            <img class="c-menu_img" src="./img/<?php echo $menu['file_name']; ?>" alt="<?php echo $menu['image_alt']; ?>">
            <p class="c-menu_location"><img src="./img/point.svg" alt=""><?php echo $menu['shop_num']; ?></p>
            <div class="l-menu_wrapper">
                <h1 class="c-title c-menu__title"><?php echo $menu['product_name']; ?></h1>
                <p class="c-menu_desc"><?php echo nl2br($menu['product_body']); ?></p>
                <dl class="c-menu_info">
                    <dt>個数：</dt>
                    <dd><?php echo $menu['quantity']; ?>個入り</dd>
                    <dt>価格：</dt>
                    <dd><?php echo $menu['price']; ?>円（税込）</dd>
                </dl>
                <div class="c-menu_shop">
                    <p class="c-menu_shop_title"><?php echo $menu['shop_name']; ?></p>
                    <p class="c-menu_shop_desc"><?php echo nl2br($menu['shop_body']); ?></p>
                </div>
                <div class="c-btn c-btn__black">
                    <a href="shops.php">一覧へ戻る</a>
                </div>
            </div>
        </section>
    </main>

    <?php require_once __DIR__ . '/inc/footer.php'; ?>
    <script src="./js/hamburger.js"></script>
</body>

</html>