<?php require_once __DIR__ . ('/../../inc/function.php');
require_once __DIR__ . ('/../../inc/config.php');

try {
    $id = $_GET['id'];
    $db = db_connect();
    // 店舗情報取得
    $sql = 'SELECT * FROM shops WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $shop = $stmt->fetch(PDO::FETCH_ASSOC);

    // 商品情報取得
    $sql2 = 'SELECT name,id FROM products WHERE id= :id';
    $stmt2 = $db->prepare($sql2);
    $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt2->execute();
    $menu = $stmt2->fetchALL(PDO::FETCH_ASSOC);
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
    <title>店舗 - 詳細</title>
</head>

<body class="l-wrapper">
    <?php require_once __DIR__ . ('/../inc/header.php'); ?>
    <h1 class="mb-5">店舗 - 詳細</h1>

    <a class="btn btn-primary" href="shop-edit.php">編集</a>

    <table class="table">
        <tbody>
            <tr>
                <th class="col-3">店舗名：</th>
                <td class="col-9"><?php echo $shop['name']; ?></td>
            </tr>
            <tr>
                <th>紹介文：</th>
                <td><?php echo $shop['body']; ?></td>
            </tr>
            <tr>
                <th>ブース番号：</th>
                <td><?php echo $shop['shop_num']; ?></td>
            </tr>
        </tbody>
    </table>


    <h1>商品 - 一覧</h1>
    <a href="menu-add.php" class="btn btn-primary">商品追加</a>
    <table class="table">
        <?php foreach ($menu as $item) : ?>
            <tr>
                <td>
                    <a href="menu-detail.php?id=<?php echo $item["id"] ?>"><?php echo $item['name'] ?></a>
                </td>
                <td>
                    <form><input type="submit" class="btn btn-danger" value="削除"></form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class=" text-center">
        <a href="shop-list.php" class="btn btn-primary mt-3">店舗一覧に戻る</a>
    </div>


    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>