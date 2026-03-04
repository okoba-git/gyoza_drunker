<?php
require_once __DIR__ . ('/../../inc/config.php');
require_once __DIR__ . ('/../../inc/function.php');

// DBに接続
// TODO: ID取得とバリデーション
$id = (int)$_GET['id'];

// DB接続
try {
    $db = db_connect();
    $sql = 'SELECT * FROM news WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $target = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}
?>

<!doctype html>
<html lang="ja">

<head>
    <title>お知らせ更新｜ふくおか餃子FES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php
    require_once __DIR__ .  '/../inc/header.php';
    ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5">お知らせ - 編集</h1>

        <form action="news-edit-do.php" method="post">
            <div class="mb-3 d-flex gap-5">
                <div class="col">
                    <label for="update_at" class="form-label">更新日</label>
                    <input type="datetime-local" name="update_at" id="update_at" value="<?php echo $target['update_at']; ?>" class="form-control" required>
                </div>

                <div class="col">
                    <label for="author" class="form-label">作成者</label>
                    <input type="text" name="author" id="author" value="<?php echo $target['author']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="mb-3 col">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" name="title" id="title" value="<?php echo $target['title']; ?>" class="form-control" placeholder="お知らせのタイトルを入力してください。" required>
            </div>

            <div class="mb-5">
                <label for="body" class="form-label">本文</label>
                <textarea name="body" id="body" class="form-control" placeholder="お知らせの本文を入力してください。" style="min-height:200px;" required>
                    <?php echo nl2br($target['body']); ?>
                </textarea>
            </div>

            <div class="d-flex flex-row gap-2">
                <input type="submit" value="更新" class="btn btn-info btn-lg text-white" style="min-width:120px;">

                <a class="btn btn-info btn-lg text-white" href="news-add.php" style="min-width:120px;">キャンセル</a>
            </div>
        </form>

        <div class=" text-center">
            <a href="./admin-list.php" class="btn btn-primary mt-3">お知らせ一覧に戻る</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>