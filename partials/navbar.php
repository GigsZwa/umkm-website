<nav class="navbar" id="navbar">
  <div class="container nav-container">
    <a href="beranda.php" class="nav-logo"><?= SITE_NAME ?></a>
    <ul class="nav-menu" id="nav-menu">
      <li><a href="index.php" class="nav-link <?= isActivePage('beranda') ?>">Beranda</a></li>
      <li><a href="tentang.php" class="nav-link <?= isActivePage('tentang') ?>">Tentang</a></li>
      <li><a href="produk.php" class="nav-link <?= isActivePage('produk') ?>">Produk</a></li>
      <li><a href="testimoni.php" class="nav-link <?= isActivePage('testimoni') ?>">Testimoni</a></li>
      <li><a href="kontak.php" class="nav-link <?= isActivePage('kontak') ?>">Kontak</a></li>
    </ul>
    <button class="hamburger" id="hamburger" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>