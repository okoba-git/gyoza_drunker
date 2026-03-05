<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

$state = $_GET['state'] ?? '';
$id = $_GET['id'] ?? '';
$json = [];

// GET失敗時
if ($state === '' || $id === '') {
  $json = [
    'status' => 400,
    'message' => '値の取得に失敗しました。',
    'updateAt' => null,
  ];
  echo json_encode($json, JSON_UNESCAPED_UNICODE);
  exit();
}

try {
  $db = db_connect();
  // 登録処理
  $sql = 'UPDATE contacts SET state = :state, update_at = now() WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':state', $state, PDO::PARAM_INT);
  $stmt->execute();
  
  // 更新内容の取得
  $sql = 'SELECT contacts.update_at, contact_status.name as state_name FROM contacts JOIN contact_status ON contacts.state = contact_status.id WHERE contacts.id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  $json = [
    'status' => 200,
    'message' => 'ID:' . $id . 'を' . $result['state_name'] . 'に変更しました。',
    'updateAt' => $result['update_at'],
  ];
} catch (PDOException $e) {
  $json = [
    'status' => 500,
    'message' => 'データベースへの登録に失敗しました。',
    'updateAt' => null,
  ];
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);