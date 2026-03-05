<?php
require_once __DIR__ . '/../../inc/function.php';
session_start();

// 文字列として受け取ったあと数値に変換
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';

// POST失敗時
if (!isAvailableMethodValue($id)) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => 'POSTの取得に失敗したため、削除ができませんでした。'];
  header('Location: ./faq-detail.php?id='.$id);
  exit();
}

try {
  $db = db_connect();
  $sql = 'DELETE FROM faq WHERE id=:id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  $_SESSION['res_message'] = ['type' => 1, 'msg' => 'ID:' . $id .'を削除しました。'];
  header('Location: ./faq-list.php');
} catch (PDOException $e) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => $e->getMessage()];
  header('Location: ./faq-detail.php?id='.$id);
}