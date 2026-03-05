<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

// DBに接続
$db = db_connect();
$sql = 'SELECT * FROM news ORDER BY create_at DESC';
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>お知らせ - 一覧</title>
</head>

<body>
    <?php
    $link = '..';
    require_once __DIR__ . '/../inc/header.php';
    ?>
    <main class="container">
        <div class="l-wrapper">
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success">削除完了しました！</div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <h1 class="my-5 text-center">お知らせ - 一覧</h1>

            <a class="btn btn-primary mb-3" href="./news-add.php">新規作成</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-1">作成日</th>
                        <th class="col-1">作成者</th>
                        <th class="col-4">タイトル</th>
                    </tr>
                </thead>
                <?php foreach ($result as $news): ?>
                    <tbody>
                        <tr>
                            <td><?php echo $news['create_at']; ?></td>
                            <td><?php echo $news['author']; ?></td>
                            <td><a href="news-detail.php?id=<?php echo $news['id']; ?>"><?php echo $news['title']; ?></a></td>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>

            <div class=" text-center">
                <a href="../index.php" class="btn btn-primary mt-3">TOPに戻る</a>
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