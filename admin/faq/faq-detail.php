<?php
require_once __DIR__ . '/../../inc/function.php';
session_start();
$message = $_SESSION['res_message'] ?? '';
unset($_SESSION['res_message']);
$type = ['danger', 'primary'];

$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if (!isAvailableMethodValue($id)) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => 'GETの取得に失敗しました。'];
  header('Location: ./faq-list.php');
  exit();
}

try {
  $faq = get_faq_data(0, $id);
} catch (PDOException $e) {
  debug_log($e->getMessage());
}
?>
<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>FAQ詳細 | 餃子FES管理</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php require_once __DIR__ . '/../inc/header.php'; ?>
  <main class="container">
    <div class="l-wrapper">
      <h1 class="my-5 text-center">FAQ - 詳細</h1>
      <!-- メッセージ -->
      <div id="message-area">
        <?php if ($message !== ''): ?>
          <div class="alert alert-<?php echo $type[$message['type']]; ?> alert-dismissible" role="alert">
            <div><?php echo $message['msg']; ?></div>
          </div>
        <?php endif; ?>
      </div>
      <!-- 表示 -->
      <div class="d-flex flex-row gap-2 mb-4">
        <a class="btn btn-info btn-lg text-white" href="./faq-edit.php?id=<?php echo $id; ?>" style="min-width:120px;">編集</a>
        <a class="btn btn-danger btn-lg text-white" href="./faq-delte-do.php" style="min-width:120px;">削除</a>
      </div>
      <dl class="mb-5">
        <div class="border-bottom mb-3">
          <dt class="col-sm-2">カテゴリー</dt>
          <dd class="col-sm-10"><?php echo $faq['category_name']; ?></dd>
        </div>
        <div class="border-bottom mb-3">
          <dt class="col-sm-2">質問</dt>
          <dd class="col-sm-10"><?php echo $faq['question']; ?></dd>
        </div>
        <div class="border-bottom mb-3">
          <dt class="col-sm-2">解答</dt>
          <dd class="col-sm-10"><?php echo nl2br($faq['answer']); ?></dd>
        </div>
      </dl>
      <div class="text-center">
        <a href="./faq-list.php" class="btn btn-primary mb-5">FAQ一覧へ戻る</a>
      </div>
    </div>
  </main>

  <!-- Bootstrap Javascript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
  <script></script>
  <!-- <script src="../../js/faq-category-check.js" type="module"></script> -->
</body>

</html>