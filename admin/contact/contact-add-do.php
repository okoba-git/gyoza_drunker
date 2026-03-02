<?php
require_once __DIR__ . '/../../inc/function.php';
session_start();

//POSTデータを受け取る
$name  = $_POST['name']  ?? '';
$email = $_POST['email'] ?? '';
$tel   = $_POST['tel'] ?? '';
$tel = str_replace(['-', 'ー', '−', '－'], '', $tel);
$body = $_POST['body'] ?? '';

$is_err = false;

// --- バリデーション開始 ---

// 1. 必須チェック
// 2. メール形式チェック
// PHP標準のフィルタ機能
// 3. 電話番号形式チェック (正規表現)
$is_err = ($name === '' || $email === '' || $body === '') ||
  ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) ||
  ($tel !== '' && !preg_match('/^0[0-9-]+[0-9]$/', $tel));


// --- チェック結果の判定 ---
if ($is_err) {
  // エラーがある場合：メッセージをセッションに入れて戻す
  $_SESSION['res_message'] = ['type' => 0, 'msg' => '不正な値が見つかりました。登録に失敗しました。'];
  header('Location: ../../contact.php');
  exit;
}

// --- DB登録処理 ---
try {
  $db = db_connect();
  $sql = 'INSERT INTO contacts (name, email, tel, body, state, create_at, update_at) VALUES (:name, :email, :tel, :body, 1, now(), now())';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
  $stmt->bindParam(':body', $body, PDO::PARAM_STR);
  $stmt->execute();
  $_SESSION['res_message'] = ['type' => 1, 'msg' => 'お問い合わせありがとうございます。内容を送信しました。'];
} catch (PDOException $e) {
  debug_log($e->getMessage());
  $_SESSION['res_message'] = ['type' => 0, 'msg' => 'システムエラーが発生しました。時間を置いて再度お試しください。'];
}

header('Location: ../../contact.php');
