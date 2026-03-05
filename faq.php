<?php
require_once __DIR__ . '/inc/function.php';

try {
    $db = db_connect();
    // faqを取得
    $sql = 'SELECT faq.question, faq.answer, faq.category
        FROM faq JOIN faq_categories ON faq.category = faq_categories.id 
        WHERE faq_categories.is_delete = 0 
        ORDER BY faq_categories.sort_order ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $faq = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // faqカテゴリを取得
    $sql = 'SELECT id, name FROM faq_categories WHERE is_delete = 0 ORDER BY sort_order ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    debug_log($e->getMessage());
}

// faqとカテゴリをまとめた配列を作成
// 構造は以下
// result[0] =>[
//         'name' => 'カテゴリ名',
//         'faq' => [
//             'queston' => '質問文',
//             'answer' => '回答文'
//         ]
//       ],
//       [1] => [...],
$result = [];
foreach ($categories as $i => $category) {
    $result[$i] = ['name' => $category['name']];
    foreach ($faq as $item) {
        if ($item['category'] === $category['id']) {
            $result[$i]['faq'][] = $item;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ふくおか餃子FES！よくある質問についてのページ。">
    <meta name="keywords" content="餃子,フェス,福岡,長浜,入場料無料,FAQ,2030">
    <meta name="author" content="ふくおか餃子FES">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ふくおか餃子FES">
    <meta property="og:title" content="よくある質問｜ふくおか餃子FES">
    <meta property="og:description" content="ふくおか餃子FES！2030年4月27日(日)～5月12日(日) 開催！ご来場、会場、その他のよくある質問についてはこちらに掲載されています。">
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
    <title>よくある質問｜ふくおか餃子FES</title>
</head>

<body>
    <?php require_once __DIR__ . '/inc/header.php'; ?>
    <main class="l-wrapper">
        <h1 class="c-title">よくある質問</h1>
        <?php foreach ($result as $category): ?>
            <?php if (!empty($category['faq'])): ?>
                <section>
                    <h2 class="c-title__sub"><?php echo $category['name']; ?></h2>
                    <dl class="c-faqCard l-faqCard">
                        <?php foreach ($category['faq'] as $faq): ?>
                            <dt><span class="c-faqCard-q">Q</span><?php echo $faq['question']; ?></dt>
                            <dd><?php echo $faq['answer']; ?></dd>
                        <?php endforeach; ?>
                    </dl>
                </section>
            <?php endif; ?>
        <?php endforeach; ?>
        <p class="c-btn-jump">
            <a href="#top">TOP</a>
        </p>
    </main>
    <?php require_once __DIR__ . '/inc/footer.php'; ?>
    <script src="./js/hamburger.js"></script>
</body>

</html>