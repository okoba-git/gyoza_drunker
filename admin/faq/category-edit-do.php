<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

// 文字列として受け取ったあと数値に変換
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
$name = $_POST['name'] ?? '';
$sort_order = isset($_POST['sort_order']) ? (int)$_POST['sort_order'] : '';
$json = [];

// POST失敗時
if (!isAvailableMethodValue($id, $name, $sort_order)) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => 'POSTの取得に失敗しました。'];
  header('Location: ./category-edit.php?id=' . $id);
  exit();
}

try {
  $db = db_connect();
  $sql = 'UPDATE faq_categories SET name=:name, sort_order=:sort_order, update_at=now() WHERE id=:id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
  $stmt->execute();

  $_SESSION['res_message'] = ['type' => 1, 'msg' => 'ID:' . $id . 'を変更しました。'];
  header('Location: ./faq-category.php');
} catch (PDOException $e) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => $e->getMessage()];
  header('Location: ./category-edit.php?id=' . $id);
}
