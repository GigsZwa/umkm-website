<nav class="navbar" id="navbar">
  <a href="index.php" class="nav-logo"><?= SITE_NAME ?></a>

  <ul class="nav-links" id="nav-links">
    <li><a href="index.php" class="<?= isActivePage('index') ?>">Beranda</a></li>
    <li><a href="produk.php" class="<?= isActivePage('produk') ?>">Produk</a></li>
    <li><a href="tentang.php" class="<?= isActivePage('tentang') ?>">Tentang Kami</a></li>
    <li><a href="testimoni.php" class="<?= isActivePage('testimoni') ?>">Testimoni</a></li>
    <li><a href="kontak.php" class="<?= isActivePage('kontak') ?>">Kontak</a></li>
  </ul>

  <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>" class="nav-cta" target="_blank" rel="noopener">
    Hubungi Kami
  </a>

  <button class="nav-toggle" id="nav-toggle" aria-label="Toggle menu">
    <span></span>
    <span></span>
    <span></span>
  </button>
</nav>

<script>
  const navbar = document.getElementById('navbar');
  const toggle = document.getElementById('nav-toggle');
  const navLinks = document.getElementById('nav-links');

  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 20);
  });

  toggle.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });
</script>