<?php
require_once __DIR__ . '/../inc/function.php';
session_start();

if (isset($_SESSION['id'])) {
    header('location:index.php');
    exit();
}
$message = $_SESSION['res_message'] ?? '';
unset($_SESSION['res_message']);
$type = ['danger', 'primary'];
?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ログイン｜ふくおか餃子FES</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="l-wrapper">
            <h1 class="my-5 text-center">管理画面 - ログイン</h1>
            <!-- メッセージ -->
            <div id="message-area">
                <?php if ($message !== ''): ?>
                    <div class="alert alert-<?php echo $type[$message['type']]; ?> alert-dismissible" role="alert">
                        <div><?php echo $message['msg']; ?></div>
                    </div>
                <?php endif; ?>
            </div>

            <form action="login-do.php" method="post">
                <div class="row justify-content-center align-items-center mb-4">
                    <label for="id" class="col-sm-1 col-form-label col-form-label-lg">ID</label>
                    <div class="col-sm-5">
                        <input type="text" name="userid" id="userid" class="form-control" placeholder="user ID">
                    </div>
                </div>

                <div class="row justify-content-center align-items-center mb-5">
                    <label for="password" class="col-sm-1 col-form-label col-form-label-lg">PASS</label>
                    <div class="col-sm-5">
                        <input type="password" name="password" id="password" class="form-control" placeholder="password">
                    </div>
                </div>

                <div class="mb-3 text-center">
                    <input type="submit" value="ログイン" class="btn btn-primary btn-lg">
                </div>

            </form>
        </div>
    </main>

    <!-- Bootstrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>