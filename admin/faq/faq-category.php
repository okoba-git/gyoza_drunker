<?php
require_once __DIR__ . '/../../inc/function.php';

try {
  // faqカテゴリを取得
  $categories = get_faq_category_data();
} catch (PDOException $e) {
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

  <title>FAQカテゴリー一覧 | 餃子FES管理</title>
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
      <h1 class="my-5 text-center">FAQカテゴリー - 一覧</h1>
      <div id="message-area">
        <?php if ($message !== ''): ?>
          <div class="alert alert-<?php echo $type[$message['type']]; ?> alert-dismissible" role="alert">
            <div><?php echo $message['msg']; ?></div>
          </div>
        <?php endif; ?>
      </div>
      <!-- 追加ボタン -->
      <div class="container my-3">
        <div class="d-sm-flex justify-content-end align-items-center">
          <a href="./category-add.php" class="btn btn-primary text-nowrap mt-2 mt-sm-0" id="category-list-btn">
            カテゴリーを追加
          </a>
        </div>
      </div>
      <!-- faqリスト -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="col">id</th>
            <th class="col-4">カテゴリー</th>
            <th class="col">ソート番号</th>
            <th class="col">状態</th>
            <th class="col">create_at</th>
            <th class="col">update_at</th>
            <th class="col text-center">操作</th>
          </tr>
        </thead>
        <tbody id="contact-tbody">
          <!-- 一覧をテーブルで表示 -->
          <?php foreach ($categories as $category): ?>
            <tr>
              <td class="col"><?php echo $category['id']; ?></td>
              <td class="col-4"><?php echo $category['name']; ?></td>
              <td class="col"><?php echo $category['sort_order']; ?></td>
              <?php $str = !$category['is_delete'] ? '通常' : '削除'; ?>
              <td class="col"><?php echo $str; ?></td>
              <td class="col"><?php echo $category['create_at']; ?></td>
              <td class="col"><?php echo $category['update_at']; ?></td>
              <td class="col">
                <div class="d-flex gap-1 justify-content-center align-item-center">
                  <a href="category-edit.php?id=<?php echo $category['id']; ?>" class="btn btn-sm btn-primary">編集</a>
                  <form action="./category-delete-do.php" method="post" onsubmit="return confirm('本当に削除してもよろしいですか?')">
                    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                    <button type="submit" class="btn btn-sm btn-danger">削除</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="text-center">
        <a href="./faq-list.php" class="btn btn-primary mb-5">FAQ一覧に戻る</a>
      </div>
    </div>
  </main>

  <!-- Bootstrap Javascript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
  <script></script>
</body>

</html>