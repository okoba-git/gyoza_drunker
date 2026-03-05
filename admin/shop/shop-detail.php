<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

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
    $sql2 = 'SELECT name,id FROM products WHERE shop_id = :id';
    $stmt2 = $db->prepare($sql2);
    $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt2->execute();
    $menu = $stmt2->fetchALL(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>店舗詳細｜ふくおか餃子FES</title>
</head>

<body class="l-wrapper">
    <?php require_once __DIR__ . ('/../inc/header.php'); ?>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success">登録完了しました！</div>

    <?php elseif (!empty($_SESSION['delete'])): ?>
        <div class="alert alert-success">削除完了しました！</div>
    <?php endif; ?>

    <?php unset($_SESSION['success'], $_SESSION['delete']); ?>

    <section class="mb-5">
        <h1 class="c-title">店舗 - 詳細</h1>
        <a class="btn btn-info btn-lg text-white mb-3" href="shop-edit.php?id=<?php echo $shop['id'] ?>">編集</a>
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
    </section>


    <section>
        <h2 class="mb-3">商品一覧</h2>
        <form action="menu-add.php" method="get">
            <input type="hidden" name="id" value="<?php echo $shop['id']; ?>">
            <button type="submit" class="btn btn-info btn-lg text-white mb-3">
                商品追加
            </button>
        </form>

        <ul class="list-group list-group-flush">
            <?php foreach ($menu as $item) : ?>
                <li class="d-flex flex-row align-items-center list-group-item">
                    <a href="menu-detail.php?id=<?php echo $item["id"] ?>"><?php echo $item['name'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <div class=" text-center">
        <a href="shop-list.php" class="btn btn-primary btn-lg mt-3">店舗一覧に戻る</a>
    </div>


    <!-- Bootstrap Javascript(jQuery含む) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>