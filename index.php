<?php
require_once 'config.php';
$pageTitle = 'Beranda';
include 'partials/header.php';
include 'partials/navbar.php';
?>

<main>

  <!-- ═══ HERO ═══ -->
  <section id="home" class="hero">
    <div class="hero-left">
      <span class="hero-eyebrow">Produk UMKM Lokal Pilihan</span>
      <h1>Kualitas Terbaik,<br><em>Harga Bersahabat</em></h1>
      <p class="hero-desc">
        Temukan produk unggulan dari pengrajin lokal terpilih.
        Setiap produk dibuat dengan penuh perhatian dan dedikasi.
      </p>
      <div class="hero-actions">
        <a href="produk.php" class="btn-primary-hero">Lihat Produk &rarr;</a>
        <a href="#testi" class="btn-ghost">Lihat Ulasan</a>
      </div>
      <div class="hero-stats">
        <div class="hero-stat">
          <span class="hero-stat-num">500+</span>
          <span class="hero-stat-label">Pelanggan Puas</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-num">50+</span>
          <span class="hero-stat-label">Produk Pilihan</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-num">4.9★</span>
          <span class="hero-stat-label">Rating Rata-rata</span>
        </div>
      </div>
    </div>

    <div class="hero-right">
      <div class="decor-circle" style="width:320px;height:320px;top:-80px;right:-80px;"></div>
      <div class="decor-circle" style="width:180px;height:180px;bottom:60px;right:20px;"></div>
      <div class="hero-img-frame">
        <img src="assets/img/awal.jpeg" alt="Produk Unggulan" loading="lazy">
        <div class="promo-pill">
          <div class="promo-pill-label">Promo Perdana</div>
          <div class="promo-pill-discount">20% OFF</div>
          <div class="promo-pill-code"><?= PROMO_CODE ?></div> <!-- defined in config.php -->
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ PROMO STRIP ═══ -->
  <div class="promo-strip">
    <span class="promo-strip-text">🎉 Diskon 20% untuk pembelian pertama</span>
    <div class="promo-strip-line"></div>
    <span style="color:rgba(255,255,255,0.6);font-size:0.85rem;">Gunakan kode</span>
    <span class="promo-strip-code"><?= PROMO_CODE ?></span>
  </div>

  <!-- ═══ PRODUK UNGGULAN ═══ -->
  <section id="produk" class="products-section section-padding">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Koleksi Terbaik</span>
        <h2 class="section-title">Produk <em>Unggulan</em></h2>
      </div>

      <div class="product-grid">
        <?php foreach (array_slice($products, 0, 4) as $p): ?>
          <div class="product-card">
            <div class="product-thumb">
              <img src="<?= htmlspecialchars($p['gambar']) ?>"
                alt="<?= htmlspecialchars($p['nama']) ?>"
                loading="lazy">
              <?php if ($p['best_seller']): ?>
                <span class="badge-best">Best Seller</span>
              <?php endif; ?>
            </div>
            <div class="product-body">
              <div class="product-name"><?= htmlspecialchars($p['nama']) ?></div>
              <div class="product-price">Rp <?= number_format($p['harga'], 0, ',', '.') ?></div>
              <div class="product-desc"><?= htmlspecialchars($p['deskripsi']) ?></div>
              <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo%2C%20saya%20tertarik%20dengan%20<?= urlencode($p['nama']) ?>"
                class="btn-wa" target="_blank" rel="noopener">
                <?= SVG_WA_ICON ?>
                Order via WhatsApp
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="products-footer">
        <a href="produk.php" class="btn-outline">Lihat Semua Produk &rarr;</a>
      </div>
    </div>
  </section>

  <!-- ═══ TESTIMONI ═══ -->
  <section id="testi" class="testi-section section-padding">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Ulasan Pelanggan</span>
        <h2 class="section-title">Apa Kata <em>Mereka</em></h2>
      </div>

      <div class="testi-grid">
        <?php foreach ($testimonials as $t): ?>
          <div class="testi-card">
            <div class="testi-quote">"</div>
            <p class="testi-text"><?= htmlspecialchars($t['pesan']) ?></p>
            <div class="testi-author">— <?= htmlspecialchars($t['nama']) ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

</main>

<?php include 'partials/footer.php'; ?>