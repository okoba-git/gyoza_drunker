<?php
require_once __DIR__ . '/inc/function.php';
// POSTデータを受け取る
$name  = $_POST['name']  ?? '';
$email = $_POST['email'] ?? '';
$tel   = $_POST['tel'] ?? '';
$body = $_POST['body'] ?? '';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="ふくおか餃子FES！イベントに関する不明点のお問い合わせ、取材依頼などはこちらまで！">
  <meta name="keywords" content="餃子,フェス,福岡,長浜,入場料無料,2030,問い合わせ">
  <meta name="author" content="ふくおか餃子FES">
  <meta property="og:type" content="website">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="ふくおか餃子FES">
  <meta property="og:title" content="お問い合わせ｜ふくおか餃子FES">
  <meta property="og:description"
    content="ふくおか餃子FES！2030年4月27日(日)～5月12日(日) 開催！イベントに関する不明点、取材依頼やご質問など、お問い合わせはこちらからお願いします。">
  <meta property="og:image" content="img/ogp.png">
  <meta property="og:image:alt" content="ふくおか餃子FES">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  <meta name="robots" content="noindex, nofollow">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/favicon.svg" type="image/svg+xml">
  <link rel="icon alternate" href="img/favicon.png" type="image/png">
  <title>お問い合わせ｜ふくおか餃子FES</title>
</head>

<body>
  <?php require_once __DIR__ . '/inc/header.php'; ?>
  <main class="l-wrapper">
    <h1 class="c-title c-mb__plus">お問い合わせ確認</h1>
    <div id="message-area"></div>
    <form action="./admin/contact/contact-add-do.php" method="post" class="l-inf-form">
      <div class="c-infCard l-infCard">
        <label class="l-infCard-lab">お名前</label>
        <p class="confirm-text"><?php echo secure($name); ?></p>
        <input type="hidden" name="name" value="<?php echo secure($name); ?>">
      </div>
      <div class="c-infCard l-infCard">
        <label class="l-infCard-lab">メールアドレス</label>
        <p class="confirm-text"><?php echo secure($email); ?></p>
        <input type="hidden" name="email" value="<?php echo secure($email); ?>">
      </div>
      <div class="c-infCard l-infCard">
        <label class="l-infCard-lab">電話番号</label>
        <p class="confirm-text"><?php echo secure($tel); ?></p>
        <input type="hidden" name="tel" value="<?php echo secure($tel); ?>">
      </div>
      <div class="c-infCard l-infCard">
        <label class="l-infCard-lab l-infCard-lab-q">お問い合わせ内容</label>
        <p class="confirm-text"><?php echo nl2br(secure($body)); ?></p>
        <input type="hidden" name="body" value="<?php echo secure($body); ?>">
      </div>
      <div class="c-contact__btn">
        <button type="button" onclick="history.back()" class="l-infCard-btn">修正</button>
        <input type="submit" value="送信" class="l-infCard-btn">
      </div>
    </form>
  </main>
  <?php require_once __DIR__ . '/inc/footer.php'; ?>
  <script src="./js/hamburger.js"></script>
</body>

</html>