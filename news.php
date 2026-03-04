<?php
require_once __DIR__ . ('/inc/config.php');
require_once __DIR__ . ('/inc/function.php');
// DBに接続
$db = db_connect();
$sql = 'SELECT id,title,create_at FROM news ORDER BY create_at DESC';
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ふくおか餃子FES！最新情報はこちら。出店者インタビュー！博多で人気に「博多ぎょうざ堂」">
    <meta name="keywords" content="餃子,フェス,福岡,長浜,入場料無料,お知らせ,2030">
    <meta name="author" content="ふくおか餃子FES">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ふくおか餃子FES">
    <meta property="og:title" content="お知らせ｜ふくおか餃子FES">
    <meta property="og:description"
        content="ふくおか餃子FES！2030年4月27日(日)～5月12日(日) 開催！最新情報はこちら。出店企業情報、博多で人気の出店者「博多ぎょうざ堂」へのインタビューはこちら。">
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
    <title>お知らせ｜ふくおか餃子FES</title>
</head>

<body>
    <?php require_once __DIR__ . '/inc/header.php'; ?>

    <main class="l-wrapper">


        <h1 class="c-title">お知らせ</h1>

        <div class="c-section">
            <div class="c-news-content c-news__other">
                <?php foreach ($result as $news): ?>
                    <dl class="c-news-detail">
                        <dt class="c-news-date">
                            <time datetime="<?php echo $news['create_at']; ?>">
                                <?php
                                $date = new DateTime($news['create_at']);
                                $week = ['日', '月', '火', '水', '木', '金', '土'];
                                $w = (int)$date->format('w');
                                echo $date->format('Y.n.j');
                                ?>
                            </time>（<?php echo $week[$w]; ?>）
                        </dt>
                        <dd class="c-news-title">
                            <a href="news-detail.php?id=<?php echo $news['id']; ?>"><?php echo $news['title']; ?></a>
                        </dd>
                    </dl>
                <?php endforeach; ?>
            </div>
            <p class="c-btn-jump">
                <a href="#top">TOP</a>
            </p>
        </div>
    </main>

    <?php require_once __DIR__ . '/inc/footer.php'; ?>
    <script src="./js/hamburger.js"></script>
</body>

</html>