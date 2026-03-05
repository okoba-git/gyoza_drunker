  <header>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
              <a class="navbar-brand" href="<?php echo $link ?>/index.php">餃子Fes管理サイト</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                      <li class="navbar-item">
                          <a href="<?php echo $link ?>/users/admin-list.php" class="nav-link">管理者</a>
                      </li>
                      <li class="navbar-item">
                          <a href="<?php echo $link ?>/news/news-list.php" class="nav-link">お知らせ</a>
                      </li>
                      <li class="navbar-item">
                          <a href="<?php echo $link ?>/contact/contact-list.php" class="nav-link">お問い合わせ</a>
                      </li>
                      <li class="navbar-item">
                          <a href="<?php echo $link ?>/shop/shop-list.php" class="nav-link">店舗</a>
                      </li>
                      <li class="navbar-item">
                          <a href="<?php echo $link ?>/faq/faq-list.php" class="nav-link">FAQ</a>
                      </li>
                  </ul>
              </div>
              <form action="logout-do.php" method="post">
                  <button type="nav-link" class="btn btn-info text-white">ログアウト</button>
              </form>
          </div>
      </nav>
  </header>