<?php require_once __DIR__ . ('/../../inc/function.php');
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>店舗 - 一覧</title>
</head>

<body class="l-wrapper">
    <?php require_once __DIR__ . ('/../inc/header.php'); ?>

    <h1>店舗 - 一覧</h1>
    <a class="btn btn-primary mb-3" href="shop-add.php">新規作成</a>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>