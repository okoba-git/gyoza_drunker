<?php
require_once __DIR__ . '/../../inc/function.php';

try{
  $next = get_next_sort_order();
}catch (PDOException $e){
  debug_log($e->getMessage());
}

session_start();
$message = $_SESSION['res_message'] ?? '';
unset($_SESSION['res_message']);
$type = ['danger', 'primary'];
?>
<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>FAQカテゴリー追加 | 餃子FES管理</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php require_once __DIR__ . '/../inc/header.php'; ?>
  <main class="container">
    <div class="l-wrapper">
      <h1 class="my-5 text-center">FAQカテゴリー - 追加</h1>
      <!-- メッセージ -->
      <div id="message-area">
        <?php if ($message !== ''): ?>
          <div class="alert alert-<?php echo $type[$message['type']]; ?> alert-dismissible" role="alert">
            <div><?php echo $message['msg']; ?></div>
          </div>
        <?php endif; ?>
      </div>
      <!-- 入力フォーム -->
      <form action="category-add-do.php" method="post" class="mb-5" id="category-form">
        <div class="col-5 mb-3">
          <label for="name" class="form-label">カテゴリー名</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="col-1 mb-5">
          <label for="sort_order" class="form-label">ソート番号</label>
          <input type="number" name="sort_order" id="sort_order" class="form-control" value=<?php echo $next; ?> required>
        </div>
        <div class="d-flex flex-row gap-2">
          <input type="submit" value="追加" class="btn btn-info btn-lg text-white" style="min-width:120px;" id="btn-submit">
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