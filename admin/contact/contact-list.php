<?php
require_once __DIR__ . '/../../inc/function.php';
$path = '..';
require_once __DIR__ . '/../inc/login-check.php';

// お問い合わせとお問い合わせステータス用配列
$contacts = [];
$status = [];
try {
  // DB接続
  $db = db_connect();
  // お問い合わせテーブルからすべてのデータを取得
  $sql = 'SELECT * FROM contacts';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  //お問い合わせ状態テーブルからすべてのステータスを取得 
  $sql = 'SELECT * FROM contact_status';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  debug_log($e->getMessage());
}
?>

<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>お問い合わせ一覧 | 餃子FES管理</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php require_once __DIR__ . '/../inc/header.php'; ?>
  <main class="container">
    <div class="l-wrapper">
      <h1 class="my-5 text-center">お問い合わせ - 一覧</h1>
      <?php require_once __DIR__ . '/../../inc/message_area.php'; ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="col">id</th>
            <th class="col">name</th>
            <th class="col">email</th>
            <th class="col">tel</th>
            <th class="col">body</th>
            <th class="col">state</th>
            <th class="col">create_at</th>
            <th class="col">update_at</th>
          </tr>
        </thead>
        <tbody id="contact_tbody">
          <!-- 一覧をテーブルで表示 -->
          <?php foreach ($contacts as $contact): ?>
            <tr data-contact-id="<?php echo $contact['id'] ?>">
              <td class="col"><?php echo $contact['id']; ?></td>
              <td class="col-1"><?php echo $contact['name']; ?></td>
              <td class="col-2"><?php echo $contact['email']; ?></td>
              <td class="col-2"><?php echo $contact['tel']; ?></td>
              <td class="col-3"><?php echo nl2br($contact['body']); ?></td>
              <td class="col-2">
                <!-- 状態はセレクトボックスで表示 -->
                <select name="state" class="form-select" aria-label="Default select example">
                  <?php foreach ($status as $state): ?>
                    <?php $selected = $contact['state'] === $state['id'] ? 'selected' : ''; ?>
                    <option value="<?php echo $state['id']; ?>" <?php echo $selected; ?>><?php echo $state['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </td>
              <td class="col"><?php echo $contact['create_at']; ?></td>
              <td class="col update-at-column"><?php echo $contact['update_at']; ?></td>
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