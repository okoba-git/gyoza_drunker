<?php
require_once __DIR__ . '/../../inc/function.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
try{
  $faq = get_faq_category_data($id);
}catch (PDOException $e){
  debug_log($e->getMessage());
}
?>
<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>FAQカテゴリー編集 | 餃子FES管理</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php require_once __DIR__ . '/../inc/header.php'; ?>
  <main class="container">
    <div class="l-wrapper">
      <h1 class="my-5 text-center">FAQカテゴリー - 編集</h1>
      <div id="message-area"></div>
      <form action="category-edit-do.php" method="post" class="mb-5" id="category-form">
        <div class="col-5 mb-3">
          <label for="name" class="form-label">カテゴリー名</label>
          <input type="text" name="name" id="name" class="form-control" value=<?php echo $faq['name']; ?>>
        </div>
        <div class="col-1 mb-5">
          <label for="sort_order" class="form-label">ソート番号</label>
          <input type="number" name="sort_order" id="sort_order" class="form-control" value=<?php echo $faq['sort_order']; ?>>
        </div>
        <div class="d-flex flex-row gap-2">
          <input type="submit" value="編集" class="btn btn-info btn-lg text-white" style="min-width:120px;" id="btn-submit">
          <a class="btn btn-secondary btn-lg text-white" href="./faq-category.php" style="min-width:120px;">キャンセル</a>
        </div>
      </form>
    </div>
  </main>

  <!-- Bootstrap Javascript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
  <script></script>
  <script src="../../js/faq-category-check.js" type="module"></script>
</body>

</html>