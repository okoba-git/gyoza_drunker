<?php
require_once __DIR__ . '/../../inc/function.php';
session_start();

// 文字列として受け取ったあと数値に変換
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
$json = [];

// POST失敗時
if (!isAvailableMethodValue($id)) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => 'POSTの取得に失敗しました。'];
  header('Location: ./faq-category.php');
  exit();
}

try {
  $db = db_connect();
  $sql = 'UPDATE faq_categories SET is_delete=1, update_at=now() WHERE id=:id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  $_SESSION['res_message'] = ['type' => 1, 'msg' => 'ID:' . $id . 'を削除しました。'];
} catch (PDOException $e) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => $e->getMessage()];
}

header('Location: ./faq-category.php');
