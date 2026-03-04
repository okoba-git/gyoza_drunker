<?php
require_once __DIR__ . '/../../inc/function.php';

// 文字列として受け取ったあと数値に変換
$sort_order = isset($_GET['sort_order']) ? (int)$_GET['sort_order'] : '';
$json = [];

// GET失敗時
if ($sort_order === '') {
  $json = [
    'status' => 400,
    'message' => '値の取得に失敗しました。',
  ];
  echo json_encode($json, JSON_UNESCAPED_UNICODE);
  exit();
}

try {

  $id = find_match_sort_order($sort_order);
  if ($id === 0) {
    $json = [
      'status' => 200,
      'message' => 'このソート番号は登録可能です',
      'isAvailable' => false,
      'id' => null,
    ];
  } else {
    $json = [
      'status' => 200,
      'message' => 'このソート番号は存在しています',
      'isAvailable' => true,
      'id' => $id,
    ];
  }
} catch (PDOException $e) {
  $json = [
    'status' => 500,
    'message' => 'データベースへの登録に失敗しました。',
    'faqList' => null,
  ];
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);
