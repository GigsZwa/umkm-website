<?php
require_once 'config.php';
$pageTitle = 'Semua Produk';
include 'partials/header.php';
include 'partials/navbar.php';
?>

<main>
  <section class="products section-padding">
    <div class="container">
      <h2 class="section-title">Semua Produk</h2>
      <div class="product-grid">
        <?php if (empty($products)): ?>
          <p>Belum ada produk ditambahkan.</p>
        <?php else: ?>
          <?php foreach ($products as $p): ?>
          <div class="product-card fade-in">
            <div class="product-img-wrapper">
              <img src="<?= $p['gambar'] ?>" alt="<?= $p['nama'] ?>" loading="lazy">
              <?php if ($p['best_seller']): ?>
                <span class="badge-best">Best Seller</span>
              <?php endif; ?>
            </div>
            <div class="product-info">
              <h3><?= $p['nama'] ?></h3>
              <p class="price">Rp <?= number_format($p['harga'],0,',','.') ?></p>
              <p class="desc"><?= $p['deskripsi'] ?></p>
              <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo%2C%20saya%20tertarik%20dengan%20<?= urlencode($p['nama']) ?>" 
                 class="btn btn-wa" target="_blank">
                Order via WhatsApp
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php include 'partials/footer.php'; ?>