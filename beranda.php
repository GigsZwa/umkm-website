<?php
require_once 'config.php';
$pageTitle = 'Beranda';
include 'partials/header.php';
include 'partials/navbar.php';
?>

<main>
  <!-- Hero -->
  <section id="home" class="hero">
    <div class="container hero-content">
      <h1 class="fade-in">Solusi Kebutuhan Anda, <span>Kualitas Terbaik</span></h1>
      <p class="fade-in">Dapatkan produk unggulan UMKM lokal dengan harga bersahabat.</p>
      <a href="produk.php" class="btn btn-primary fade-in">Lihat Produk</a>
    </div>
  </section>

  <!-- Promo -->
  <section class="promo">
    <div class="container">
      <div class="promo-banner">
        <span>🎉 Diskon 20% untuk Pembelian Pertama!</span>
        <span>Kode: <strong>UMKM20</strong></span>
      </div>
    </div>
  </section>

  <!-- Produk Unggulan (4 produk pertama) -->
  <section class="products section-padding">
    <div class="container">
      <h2 class="section-title">Produk Unggulan</h2>
      <div class="product-grid">
        <?php foreach (array_slice($products, 0, 4) as $p): ?>
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
      </div>
      <div style="text-align:center; margin-top:2rem;">
        <a href="produk.php" class="btn btn-primary">Lihat Semua Produk</a>
      </div>
    </div>
  </section>

  <!-- Testimoni Singkat -->
  <section class="testimonials section-padding bg-light">
    <div class="container">
      <h2 class="section-title">Apa Kata Pelanggan</h2>
      <div class="testimonial-grid">
        <?php foreach ($testimonials as $t): ?>
        <div class="testimonial-card fade-in">
          <p class="testimonial-text">"<?= $t['pesan'] ?>"</p>
          <p class="testimonial-name">— <?= $t['nama'] ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>

<?php include 'partials/footer.php'; ?>