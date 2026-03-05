<?php
require_once __DIR__ . '/../../inc/function.php';
require_once __DIR__ . '/../inc/login-check.php';

// 文字列として受け取ったあと数値に変換
$question = $_POST['question'] ?? '';
$answer = $_POST['answer'] ?? '';
$category = isset($_POST['category']) ? (int)$_POST['category'] : '';

// POST失敗時
if (!isAvailableMethodValue($question,$answer,$category)) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => 'POSTの取得に失敗しました。'];
  header('Location: ./faq-add.php');
  exit();
}

try {
  $db = db_connect();
  $sql = 'INSERT faq (question, answer, category, create_at, update_at) VALUES (:question, :answer, :category, now(), now())';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':question', $question, PDO::PARAM_STR);
  $stmt->bindParam(':answer', $answer, PDO::PARAM_STR);
  $stmt->bindParam(':category', $category, PDO::PARAM_INT);
  $stmt->execute();

  $_SESSION['res_message'] = ['type' => 1, 'msg' => 'FAQを登録しました。'];
  header('Location: ./faq-list.php');
} catch (PDOException $e) {
  $_SESSION['res_message'] = ['type' => 0, 'msg' => $e->getMessage()];
  header('Location: ./faq-add.php');
}