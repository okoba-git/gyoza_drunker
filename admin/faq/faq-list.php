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

  <title>FAQ一覧 | 餃子FES管理</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php 
    $link = '..';
    require_once __DIR__ . '/../inc/header.php'; 
    ?>
  <main class="container">
    <div class="l-wrapper">
      <h1 class="my-5 text-center">FAQ - 一覧</h1>
      <!-- メッセージ -->
      <div id="message-area">
        <?php if ($message !== ''): ?>
          <div class="alert alert-<?php echo $type[$message['type']]; ?> alert-dismissible" role="alert">
            <div><?php echo $message['msg']; ?></div>
          </div>
        <?php endif; ?>
      </div>
      <!-- カテゴリー -->
      <div class="container my-3">
        <div class="d-sm-flex justify-content-between align-items-center">
          <div class="input-group" style="max-width: 350px;">
            <label class="input-group-text" for="category-selector">カテゴリ</label>
            <select class="form-select" id="category-selector" aria-label="カテゴリを選択してください">
              <option selected value="0">全部</option>
              <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
              <?php endforeach; ?>
            </select>
            <a href="./faq-category.php" class="btn btn-primary text-nowrap mt-2 mt-sm-0" id="category-list-btn">
              一覧へ
            </a>
          </div>
          <a href="./faq-add.php" class="btn btn-primary text-nowrap mt-2 mt-sm-0" id="category-list-btn">
            FAQを追加
          </a>
        </div>
      </div>
      <!-- faqリスト -->
      <table class="table table-bordered mb-5">
        <thead>
          <tr>
            <th class="col">id</th>
            <th class="col">カテゴリー</th>
            <th class="col">質問</th>
            <th class="col">解答</th>
            <th class="col">create_at</th>
            <th class="col">update_at</th>
            <th class="col text-center">操作</th>
          </tr>
        </thead>
        <tbody id="contact-tbody">
          <!-- 一覧をテーブルで表示 -->
        </tbody>
      </table>
      <div class="text-center">
        <a href="../index.php" class="btn btn-primary mb-5">TOPページへ戻る</a>
      </div>
    </div>
  </main>

  <!-- Bootstrap Javascript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
  <script></script>
  <script src="../../js/faq-list.js" type="module"></script>
</body>

</html>