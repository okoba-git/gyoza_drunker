<?php
$message = $_SESSION['res_message'] ?? '';
unset($_SESSION['res_message']);
$type = ['danger', 'primary'];
?>
<div id="message-area">
    <?php if ($message !== ''): ?>
        <div class="alert alert-<?php echo $type[$message['type']]; ?> alert-dismissible" role="alert">
            <div><?php echo $message['msg']; ?></div>
        </div>
    <?php endif; ?>
</div>