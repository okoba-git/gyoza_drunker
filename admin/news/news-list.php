<?php
require_once __DIR__ . ('/../../inc/config.php');
require_once __DIR__ . ('/../../inc/function.php');
// DBに接続
$db = db_connect();
$sql = 'SELECT title,create_at FROM news ORDER BY create_at DESC';
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>おしらせ - 一覧</title>
</head>
<body class="l-wrapper">
    <h1 class="c-title">お知らせ- 一覧</h1>

        <!-- <div class="c-section"> 
            <div class="c-news-content c-news__other">
                <dl class="c-news-detail">
                    <dt class="c-news-date">
                        <time datetime="2030-02-25">2030.2.25</time>（月）
                    </dt>
                    <dd class="c-news-title">
                        <a href="#">出店者インタビュー　博多区で人気の「博多ぎょうざ堂」</a>
                    </dd>
                </dl>
            </div>
        </div> -->
   
    <a class="btn btn-primary mb-3" href="news-add.php">新規作成</a>
    <table class="table table-bordered">
        <thead>
            <tr class="">
                <th class="col-1">作成日</th>
                <th class="col-2">タイトル</th>
            </tr>
        </thead>
        <?php foreach ($result as $news): ?>
            <tbody>
                <tr class="">
                    <td class="col-1"><?php echo $news['create_at']; ?></td>
                    <td class="col-2"><?php echo $news['title']; ?></td>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>

    </table>
    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>