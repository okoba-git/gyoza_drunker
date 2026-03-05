  <header>
      <nav class="navbar">
          <ul>
              <li class="navbar-brand"><a href="<?php echo $link ?>/users/admin-list.php" class="nav-link">管理者</a></li>
              <li class="navbar-brand"><a href="<?php echo $link ?>/news/news-list.php" class="nav-link">お知らせ</a></li>
              <li class="navbar-brand"><a href="<?php echo $link ?>/contact/contact-list.php" class="nav-link">お問い合わせ</a></li>
              <li class="navbar-brand"><a href="<?php echo $link ?>/shop/shop-list.php" class="nav-link">店舗</a></li>
              <li class="navbar-brand"><a href="<?php echo $link ?>/faq/faq-list.php" class="nav-link">FAQ</a></li>
              <li class="navbar-brand">
                  <form action="logout-do.php" method="post"><button type="submit" class="btn btn-info">ログアウト</button></form>
              </li>
          </ul>
      </nav>
  </header>