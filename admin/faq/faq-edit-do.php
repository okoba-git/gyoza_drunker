<?php
require_once __DIR__ . '/../../inc/function.php';
session_start();

// 文字列として受け取ったあと数値に変換
$question = $_POST['question'] ?? '';
$answer = $_POST['answer'] ?? '';
$category = isset($_POST['category']) ? (int)$_POST['category'] : '';
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';

// POST失敗時
if (!isAvailableMethodValue($question,$answer,$category)) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => 'POSTの取得に失敗したため、編集内容が登録できませんでした。'];
  header('Location: ./faq-edit.php?id='.$id);
  exit();
}

try {
  $db = db_connect();
  $sql = 'UPDATE faq SET question=:question, answer=:answer, category=:category, update_at=now() WHERE id=:id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':question', $question, PDO::PARAM_STR);
  $stmt->bindParam(':answer', $answer, PDO::PARAM_STR);
  $stmt->bindParam(':category', $category, PDO::PARAM_INT);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  $_SESSION['res_message'] = ['type' => 1, 'msg' => '変更を登録しました。'];
  header('Location: ./faq-detail.php?id='.$id);
} catch (PDOException $e) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => $e->getMessage()];
  header('Location: ./faq-edit.php?id='.$id);
}