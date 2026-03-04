<?php
require_once __DIR__ . '/../../inc/function.php';

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
  // 一番大きいソート番号をインクリメントしたものを取得取得
  $db = db_connect();
  $sql = 'SELECT sort_order FROM faq_categories ORDER BY sort_order DESC LIMIT 1';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $max_num = $stmt->fetch(PDO::FETCH_COLUMN) + 1;

  // 同じソート番号を持つカテゴリのソート番号を更新
  $sql = 'UPDATE faq_categories SET sort_order = :sort_order WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
  $stmt->execute();

  $json = [
    'status' => 200,
    'message' => 'ID:' . $id . 'のソート番号を' . $max_num . 'に変更しました。',
  ];
} catch (PDOException $e) {
  $json = [
    'status' => 500,
    'message' => 'データベースへの登録に失敗しました。',
  ];
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);
