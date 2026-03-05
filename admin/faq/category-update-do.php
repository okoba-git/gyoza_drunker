<?php
require_once __DIR__ . '/../../inc/function.php';
$path = '..';
require_once __DIR__ . '/../inc/login-check.php';

// 文字列として受け取ったあと数値に変換
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
$json = [];

// GET失敗時
if ($id === '') {
  $json = [
    'status' => 400,
    'message' => '値の取得に失敗しました。',
  ];
  echo json_encode($json, JSON_UNESCAPED_UNICODE);
  exit();
}

try {
  $next = get_next_sort_order();

  // 同じソート番号を持つカテゴリのソート番号を更新
  $db = db_connect();
  $sql = 'UPDATE faq_categories SET sort_order = :sort_order WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':sort_order', $next, PDO::PARAM_INT);
  $stmt->execute();

  $json = [
    'status' => 200,
    'message' => 'ID:' . $id . 'のソート番号を' . $next . 'に変更しました。',
  ];
} catch (PDOException $e) {
  $json = [
    'status' => 500,
    'message' => 'データベースへの登録に失敗しました。',
  ];
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);
