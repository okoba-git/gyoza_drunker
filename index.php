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
    <meta name="description" content="福岡の人気餃子が一堂に集結!ご当地餃子や創作餃子が楽しめる、エネルギッシュでモダンなフードフェス。">
    <meta name="keywords" content="餃子,フェス,福岡,長浜,入場料無料,肉料理,2030">
    <meta name="author" content="ふくおか餃子FES">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ふくおか餃子FES">
    <meta property="og:title" content="ふくおか餃子FES｜公式サイト">
    <meta property="og:description"
        content="ふくおか餃子FES！2030年4月27日(日)～5月12日(日) 開催！福岡の人気餃子が一堂に集結!ご当地餃子や創作餃子が楽しめる、エネルギッシュでモダンなフードフェス。">
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

    <title>ふくおか餃子FES｜公式サイト</title>
</head>

<body>
    <?php require_once __DIR__ . '/inc/header.php'; ?>
    <main>


        <div class="c-mv-sec">
            <div class="c-mv-sec__img">
                <img src="./img/mainvisual-image.png" alt="">
            </div>
            <div class="l-wrapper">
                <div class="c-mv-stamp">
                    <p>入場料無料</p>
                    <p>※飲食代別途</p>
                    <p> （現金、電子マネー <br>QR決済利用可能）</p>
                </div>
            </div>
        </div>

        <section class="l-about-sec">
            <div class="c-sp-inner">
                <div class="l-about-inner l-wrapper">
                    <h2 class="c-title c-top-title">フェスについて</h2>
                    <div class="c-about-concept">
                        <p class="c-about-concept__big">
                            <span class="c-about-concept__red">福岡の餃子文化</span>が一堂に集結！
                        </p>
                        <p class="c-about-concept__small">
                            定番のご当地餃子から、驚きの創作餃子まで、ここはまるで餃子のテーマパーク。<br>
                            香ばしく焼き上げられた皮のパリっとした食感、ジューシーな肉汁、
                            個性あふれるタレのハーモニー... <br>
                            ひとくち食べるたびに、新しい味、新しい驚き、新しい発見が待っています。</p>
                        <p class="c-about-concept__big">
                            さあ、あなたもこの美味しい冒険に出かけませんか?
                        </p>
                    </div>
                    <ul class="c-about-detail__top">
                        <li class="c-about-list">
                            <dl>
                                <dt class="c-about-detail__title">日時</dt>
                                <dd class="c-about-detail__main">2030.4.27(日)～5.12(日) <br>
                                    <span class="c-about-detail__sub">
                                        平日 16:00~22:00 <br>
                                        土日祝 11:00~22:00
                                    </span>
                                    <span class="c-about-detail__note">(最終入場受付 21:00 L.O. 21:15)</span>
                                </dd>
                            </dl>
                        </li>
                        <li class="c-about-list">
                            <dl>
                                <dt class="c-about-detail__title">会場</dt>
                                <dd class="c-about-detail__main">長浜公園
                                    <span class="c-about-detail__sub c-about-detail__address">
                                        〒810-0073 <br>
                                        福岡市中央区舞鶴1丁目7
                                    </span>
                                    <div class="c-btn c-btn__red">
                                        <a href="information.php#access">
                                            マップはこちら
                                        </a>
                                    </div>
                                </dd>
                            </dl>
                        </li>
                    </ul>
                    <div class="c-btn c-btn__black c-about-pc">
                        <a href="information.php">VIEW MORE</a>
                    </div>
                </div>
            </div>

            <div class="l-wrapper">

                <a href="shops.php">
                    <picture>
                        <source srcset="./img/menu-pc.png" media="(min-width:768px)">
                        <img src="./img/menu-sp.png" alt="">
                    </picture>
                </a>


            </div>
        </section>

        <section class="l-wrapper">
            <div class="l-news-sec">
                <h2 class="c-title c-top-title">お知らせ</h2>
                <div class="c-news-content">
                    <!-- $result の先頭から5件だけを取り出す -->
                    <?php $limited_news = array_slice($result, 0, 5); ?>
                    <?php foreach ($limited_news as $news): ?>
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
                <div class="c-btn c-btn__black">
                    <a href="news.php">VIEW MORE</a>
                </div>
            </div>
        </section>

        <div class="l-sns-sec l-wrapper">
            <p class="c-sns-title">公式SNSをチェック!!</p>
            <div class="c-sns-icon">
                <div class="c-btn c-btn__sns c-icon_x">
                    <a href="#">
                        <img class="c-icon-white" src="./img/x-logo-white.svg" alt="">
                    </a>
                </div>
                <div class="c-btn c-btn__sns c-icon-inst">
                    <a href="#">
                        <img class="c-icon-white" src="./img/Instagram-logo-white.svg" alt="">
                    </a>
                </div>
                <div class="c-btn c-btn__sns">
                    <a href="#">
                        <img class="c-icon-white" src="./img/youtube-logo-white.svg" alt="">
                    </a>
                </div>
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