<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

$message = $_SESSION['res_message'] ?? '';
unset($_SESSION['res_message']);
$type = ['danger', 'primary'];

$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if (!isAvailableMethodValue($id)) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => 'GETの取得に失敗したため、編集ページの表示に失敗しました。'];
  header('Location: ./faq-detail.php?id='.$id);
  exit();
}

try {
  // 編集したいfaqを取得
  $faq = get_faq_data(0, $id);
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

  <title>FAQ編集 | 餃子FES管理</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php require_once __DIR__ . '/../inc/header.php'; ?>
  <main class="container">
    <div class="l-wrapper">
      <h1 class="my-5 text-center">FAQ - 編集</h1>
      <!-- メッセージ -->
      <div id="message-area">
        <?php if ($message !== ''): ?>
          <div class="alert alert-<?php echo $type[$message['type']]; ?> alert-dismissible" role="alert">
            <div><?php echo $message['msg']; ?></div>
          </div>
        <?php endif; ?>
      </div>
      <!-- 入力フォーム -->
      <form action="faq-edit-do.php" method="post" class="mb-5" id="category-form">
        <!-- ボタン -->
        <div class="d-flex flex-row gap-2 mb-3">
          <input type="submit" value="編集" class="btn btn-info btn-lg text-white" style="min-width:120px;" id="btn-submit">
          <a class="btn btn-secondary btn-lg text-white" href="./faq-detail.php?id=<?php echo $id; ?>" style="min-width:120px;">キャンセル</a>
        </div>
        <!-- id -->
         <input type="hidden" name="id" value="<?php echo $id; ?>">
        <!-- カテゴリー -->
        <div class="col-3 mb-3">
          <label for="category" class="form-label">カテゴリー</label>
          <select name="category" class="form-select" id="category" aria-label="カテゴリを選択してください">
            <?php foreach ($categories as $category): ?>
              <?php $selected = $category['id'] === $faq['category_id'] ? 'selected' : ''; ?>
              <option value="<?php echo $category['id'] ?>" <?php echo $selected; ?>>
                <?php echo $category['name'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <!-- 質問 -->
        <div class="col-8 mb-3">
          <label for="question" class="form-label">質問</label>
          <input type="text" name="question" id="question" class="form-control" value="<?php echo $faq['question'] ?>" required>
        </div>
        <!-- 解答 -->
        <div class="col-8 mb-5">
          <label for="answer" class="form-label">解答</label>
          <input type="text" name="answer" id="answer" class="form-control" value="<?php echo $faq['answer'] ?>" required>
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