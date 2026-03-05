<?php
require_once __DIR__ . ('/../../inc/function.php');
require_once __DIR__ . ('/../../inc/config.php');

try {
    $db = db_connect();
    $sql = 'SELECT name,shop_num,id FROM shops';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../../css/style.css">
    <title>店舗 - 一覧</title>
</head>

<body class="l-wrapper">
    <?php 
    $link = '..';
    require_once __DIR__ . '/../inc/header.php'; 
    ?>

    <h1 class="c-title">店舗 - 一覧</h1>
    <a class="btn btn-info btn-lg text-white mb-3" href="shop-add.php">新規作成</a>
    <table class="table table-bordered">
        <thead>
            <tr class="">
                <th class="col-2">ブース番号</th>
                <th class="col-9">店名</th>
                <th class="col-1"></th>
            </tr>
        </thead>
        <?php foreach ($result as $shop): ?>
            <tbody>
                <tr class="">
                    <td class="col-2"><?php echo $shop['shop_num']; ?></td>
                    <td class="col-9"><a href="shop-detail.php?id=<?php echo $shop['id']; ?>"><?php echo $shop['name']; ?></a></td>
                    <td class="col-1">
                        <form action="shop-delete-do.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $shop['id']; ?>">
                            <input type="submit" class="btn btn-danger" value="削除">
                        </form>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
    <div class=" text-center">
        <a href="../index.php" class="btn btn-primary mt-3">TOPに戻る</a>
    </div>

    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>