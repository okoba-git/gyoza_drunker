<?php
require_once __DIR__ . '/../../inc/function.php';
session_start();

// 文字列として受け取ったあと数値に変換
$name = $_POST['name'] ?? '';
$sort_order = isset($_POST['sort_order']) ? (int)$_POST['sort_order'] : '';
$json = [];

// POST失敗時
if (!isAvailableMethodValue($name,$sort_order)) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => 'POSTの取得に失敗しました。'];
  header('Location: ./category-add.php');
  exit();
}

try {
  // 一番大きいソート番号をインクリメントしたものを取得取得
  $db = db_connect();
  $sql = 'INSERT faq_categories (name, sort_order, create_at, update_at) VALUES (:name, :sort_order, now(), now())';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
  $stmt->execute();

  $_SESSION['res_message'] = ['type' => 1, 'msg' => 'FAQカテゴリーに'. $name .'を登録しました。'];
  header('Location: ./faq-category.php');
} catch (PDOException $e) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => $e->getMessage()];
  header('Location: ./category-add.php');
}