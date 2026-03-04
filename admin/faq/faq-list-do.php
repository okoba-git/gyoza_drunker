<?php
require_once __DIR__ . '/../../inc/function.php';

// 文字列として受け取ったあと数値に変換
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : '';
$json = [];

// GET失敗時
if ($category_id === '') {
  $json = [
    'status' => 400,
    'message' => '値の取得に失敗しました。',
    'faqList' => null,
  ];
  echo json_encode($json, JSON_UNESCAPED_UNICODE);
  exit();
}

try {

  $result = get_faq_data($category_id);
  $category_name = '全部';
  if ($category_id !== 0 && !empty($result)) {
    // 特定カテゴリ指定時は最初の1件から名前を取る
    $category_name = $result[0]['category_name'] ?? 'カテゴリ不明';
  }

  $json = [
    'status' => 200,
    'message' =>  $category_name . 'のfaq一覧を取得しました。',
    'faqList' => $result,
  ];
} catch (PDOException $e) {
  $json = [
    'status' => 500,
    'message' => 'データベースへの登録に失敗しました。',
    'faqList' => null,
  ];
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);
