<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

try {
    // お知らせ情報取得
    $id = $_GET['id'];
    $db = db_connect();
    $sql = 'SELECT * FROM news WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $news = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $e->getMessage();
}
?>

<!DOCTYPE html><?php
                require_once __DIR__ . ('/../../inc/config.php');
                require_once __DIR__ . ('/../../inc/function.php');

                session_start();

                try {
                    // お知らせ情報取得
                    $id = $_GET['id'];
                    $db = db_connect();
                    $sql = 'SELECT * FROM news WHERE id = :id';
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $news = $stmt->fetch(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    $e->getMessage();
                }
                ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>お知らせ詳細｜ふくおか餃子FES</title>
</head>

<body class="l-wrapper">
    <?php require_once __DIR__ . ('/../inc/header.php'); ?>
    <div class="container my-5">

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success">更新完了しました！</div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <h1 class="mb-4">お知らせ - 詳細</h1>

        <div class="d-flex flex-row gap-2 mb-3">
            <form action="news-edit.php" method="post">
                <input type="hidden" name="id" value="<?php echo $news['id']; ?>">
                <button type="submit" class="btn btn-info text-white">
                    編集
                </button>
            </form>
            <form action="news-del-do.php" method="post" onsubmit="return confirm('本当に削除してもよろしいですか?')">
                <input type="hidden" name="id" value="<?php echo $news['id']; ?>">
                <button type="submit" class="btn btn-danger">
                    削除
                </button>
            </form>
        </div>

        <table class="table mb-5">
            <tbody>
                <tr>
                    <th class="col-2">作成日</th>
                    <td class="col-10"><?php echo $news['create_at']; ?></td>
                </tr>
                <tr>
                    <th>作成者</th>
                    <td><?php echo $news['author']; ?></td>
                </tr>
                <tr>
                    <th>タイトル</th>
                    <td><?php echo $news['title']; ?></td>
                </tr>
                <tr>
                    <th>本文</th>
                    <td><?php echo nl2br($news['body']); ?></td>
                </tr>
            </tbody>
        </table>

        <div class=" text-center mt-4">
            <a href="news-list.php" class="btn btn-primary">お知らせ一覧に戻る</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>