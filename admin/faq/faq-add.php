<?php
require_once __DIR__ . '/../../inc/function.php';
session_start();
$message = $_SESSION['res_message'] ?? '';
unset($_SESSION['res_message']);
$type = ['danger', 'primary'];

try {
  // faqカテゴリを取得
  $categories = get_faq_category_data(0, false);
} catch (PDOException $e) {
  debug_log($e->getMessage());
}
?>
<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>FAQ追加 | 餃子FES管理</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php require_once __DIR__ . '/../inc/header.php'; ?>
  <main class="container">
    <div class="l-wrapper">
      <h1 class="my-5 text-center">FAQ - 追加</h1>
      <!-- メッセージ -->
      <div id="message-area">
        <?php if ($message !== ''): ?>
          <div class="alert alert-<?php echo $type[$message['type']]; ?> alert-dismissible" role="alert">
            <div><?php echo $message['msg']; ?></div>
          </div>
        <?php endif; ?>
      </div>
      <!-- 入力フォーム -->
      <form action="faq-add-do.php" method="post" class="mb-5" id="category-form">
        <div class="col-3 mb-3">
          <label for="category" class="form-label">カテゴリー</label>
          <select name="category" class="form-select" id="category" aria-label="カテゴリを選択してください">
            <?php foreach ($categories as $category): ?>
              <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-8 mb-3">
          <label for="question" class="form-label">質問</label>
          <input type="text" name="question" id="question" class="form-control" required>
        </div>
        <div class="col-8 mb-5">
          <label for="answer" class="form-label">解答</label>
          <input type="text" name="answer" id="answer" class="form-control" required>
        </div>
        <div class="d-flex flex-row gap-2">
          <input type="submit" value="追加" class="btn btn-info btn-lg text-white" style="min-width:120px;" id="btn-submit">
          <a class="btn btn-secondary btn-lg text-white" href="./faq-list.php" style="min-width:120px;">キャンセル</a>
        </div>
      </form>
    </div>
  </main>

  <!-- Bootstrap Javascript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
  <script></script>
  <!-- <script src="../../js/faq-category-check.js" type="module"></script> -->
</body>

</html>