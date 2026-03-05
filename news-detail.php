<?php
    require_once __DIR__ . '/inc/function.php';
    require_once __DIR__ . '/inc/config.php';

    $news_id = (int)$_GET['id'];
    try {
        $news = get_display_news_data($news_id);
    } catch (PDOException $e) {
        debug_log($e->getMessage());
    }
    ?>
    
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ふくおか餃子FES！最新情報はこちら。出店者インタビュー！博多で人気の「博多ぎょうざ堂」">
    <meta name="keywords" content="餃子,フェス,福岡,長浜,入場料無料,お知らせ,2030">
    <meta name="author" content="ふくおか餃子FES">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ふくおか餃子FES">
    <meta property="og:title" content="お知らせ詳細｜ふくおか餃子FES">
    <meta property="og:description" content="ふくおか餃子FES！2030年4月27日(日)～5月12日(日) 開催！最新情報はこちら。出店者「博多ぎょうざ堂」へのインタビュー内容はこちら">
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
    <title>お知らせ詳細｜ふくおか餃子FES</title>
</head>

<body>
    <?php require_once __DIR__ . '/inc/header.php'; ?>
    
    <main class="l-wrapper">
        <?php  ?>

        <h1 class="c-title"><?php echo $news['title']; ?></h1>
        <div class="c-section">
            <p class="c-newsDet-date"><time datetime="<?php echo $news['create_at']; ?>">
                    <?php
                    $date = new DateTime($news['create_at']);
                    echo $date->format('Y.n.j');
                    ?>
                </time></p>
            <p class="c-newsDet-con">
                <?php echo $news['body']; ?>
            </p>
            <div class="c-btn c-btn__black">
                <a href="news.php">一覧に戻る</a>
            </div>
        </div>

    </main>

    <?php require_once __DIR__ . '/inc/footer.php'; ?>
    <script src="./js/hamburger.js"></script>
</body>

</html>