<?php
require_once __DIR__ . '/../../inc/function.php';

// お問い合わせとお問い合わせステータス用配列
$contacts = [];
$status = [];
try {
  $db = db_connect();
  // faqを取得
  $sql = 'SELECT
          faq.id,
          faq.question, 
          faq.answer,
          faq.category as category_id,
          faq_categories.name as category_name,
          faq.create_at,
          faq.update_at
          FROM faq JOIN faq_categories ON faq.category = faq_categories.id 
          WHERE faq_categories.is_delete = 0 ';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $faq_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // faqカテゴリを取得
  $sql = 'SELECT id, name FROM faq_categories WHERE is_delete = 0 ORDER BY sort_order ASC';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  <?php require_once __DIR__ . '/../inc/header.php'; ?>
  <main class="container">
    <div class="l-wrapper">
      <h1 class="my-5 text-center">FAQ - 一覧</h1>
      <div id="message-area"></div>
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
          </div>
          <a href="./faq-category-list.php" class="btn btn-primary text-nowrap mt-2 mt-sm-0" id="category-list-btn">
            カテゴリー一覧へ
          </a>
        </div>
      </div>
      <!-- faqリスト -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="col">id</th>
            <th class="col">question</th>
            <th class="col">answer</th>
            <th class="col">category</th>
            <th class="col">create_at</th>
            <th class="col">update_at</th>
            <th class="col text-center">操作</th>
          </tr>
        </thead>
        <tbody id="contact_tbody">
          <!-- 一覧をテーブルで表示 -->
          <?php foreach ($faq_list as $faq): ?>
            <tr>
              <td class="col"><?php echo $faq['id']; ?></td>
              <td class="col-3"><?php echo $faq['question']; ?></td>
              <td class="col-4"><?php echo secure($faq['answer']); ?></td>
              <td class="col-2"><?php echo $faq['category_name']; ?></td>
              <td class="col"><?php echo $faq['create_at']; ?></td>
              <td class="col update-at-column"><?php echo $faq['update_at']; ?></td>
              <td class="col-1 text-center align-middle">
                <a href=".faq-detail.php?id=<?php echo $faq['id']; ?>" class="btn btn-sm btn-primary">詳細</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Bootstrap Javascript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
  <script></script>
  <script src="../../js/change-contact-state.js" type="module"></script>
</body>

</html>