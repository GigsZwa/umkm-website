<?php
require_once 'config.php';
$pageTitle = 'Beranda';
include 'partials/header.php';
include 'partials/navbar.php';

// ── Ikon per kategori — tambah di sini kalau ada kategori baru ──
$kategoriIcon = [
  'Minuman'   => '☕',
  'Makanan'   => '🍱',
  'Fashion'   => '👗',
  'Kerajinan' => '🪴',
  'Perawatan' => '🧴',
  'Lainnya'   => '📦',
];

// ── Kumpulkan kategori unik dari $products (urutan kemunculan) ──
$kategoriList = [];
foreach ($products as $p) {
  $kat = $p['kategori'] ?? 'Lainnya';
  if (!in_array($kat, $kategoriList)) {
    $kategoriList[] = $kat;
  }
}
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
          <span class="hero-stat-num"><?= count($products) ?>+</span>
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
        <img src="assets/img/apit.png" alt="Produk Unggulan" loading="lazy">
      </div>
    </div>
  </section>

  <br><br>

  <!-- ═══ PROMO BANNER ═══ -->
  <section class="promo-banner-section">
    <div class="container">
      <div class="promo-banner">

        <!-- Dekorasi lingkaran -->
        <div class="pb-decor pb-decor-1"></div>
        <div class="pb-decor pb-decor-2"></div>
        <div class="pb-decor pb-decor-3"></div>

        <!-- Kiri: teks -->
        <div class="pb-left">
          <span class="pb-tag">Penawaran Spesial</span>
          <h2 class="pb-title">Hemat <em>20%</em><br>untuk Pembelian Pertama</h2>
          <p class="pb-sub">Berlaku untuk semua kategori produk &middot; Stok terbatas!</p>
          <div class="pb-perks">
            <span class="pb-perk">✓ Tanpa minimum pembelian</span>
            <span class="pb-perk">✓ Berlaku semua produk</span>
            <span class="pb-perk">✓ Fast response WA</span>
          </div>
        </div>

        <!-- Kanan: kode + tombol -->
        <div class="pb-right">
          <div class="pb-code-wrap">
            <p class="pb-code-label">Gunakan kode ini</p>
            <div class="pb-code-box">
              <span class="pb-code"><?= PROMO_CODE ?></span>
              <button class="pb-copy-btn" onclick="copyPromo(this)" data-code="<?= PROMO_CODE ?>">Salin</button>
            </div>
            <p class="pb-code-hint">Tempel kode saat chat di WhatsApp</p>
          </div>
          <a
            href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo+<?= rawurlencode(SITE_NAME) ?>%2C+saya+mau+pesan+dan+pakai+kode+promo+<?= PROMO_CODE ?>"
            target="_blank"
            rel="noopener"
            class="pb-btn-wa">
            <?= SVG_WA_ICON ?>
            Belanja Sekarang
          </a>
        </div>

      </div>
    </div>
  </section>
  
  <!-- ═══ PRODUK UNGGULAN ═══ -->
  <section id="produk" class="products-section section-padding" style="padding-top:2rem;">
    <div class="container">

      <div class="section-header">
        <span class="section-tag">Koleksi Terbaik</span>
        <h2 class="section-title">Produk <em>Unggulan</em></h2>
      </div>

      <!-- Filter pills -->
      <div class="produk-filter-wrap">
        <button class="produk-filter-btn active" data-filter="Semua">
          <span class="pf-icon">✦</span> Semua
        </button>
        <?php foreach ($kategoriList as $kat):
          $icon = $kategoriIcon[$kat] ?? '📦';
        ?>
          <button class="produk-filter-btn" data-filter="<?= htmlspecialchars($kat) ?>">
            <span class="pf-icon"><?= $icon ?></span>
            <?= htmlspecialchars($kat) ?>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- Product grid -->
      <div class="product-grid" id="productGrid">
        <?php foreach ($products as $p):
          $kat = htmlspecialchars($p['kategori'] ?? 'Lainnya');
        ?>
          <div class="product-card" data-kategori="<?= $kat ?>">
            <div class="product-thumb">
              <img src="<?= htmlspecialchars($p['gambar']) ?>"
                alt="<?= htmlspecialchars($p['nama']) ?>"
                loading="lazy">
              <?php if ($p['best_seller']): ?>
                <span class="badge-best">Best Seller</span>
              <?php endif; ?>
              <div class="product-thumb-overlay">
                <a href="produk.php?kategori=<?= urlencode($p['kategori'] ?? '') ?>"
                  class="overlay-btn">Lihat Koleksi</a>
              </div>
            </div>
            <div class="product-body">
              <span class="product-kategori-tag"><?= $kat ?></span>
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

      <!-- Empty state (muncul via JS kalau filter kosong) -->
      <div class="empty-state" id="emptyState" style="display:none;">
        <div class="empty-icon">🔍</div>
        <h3>Tidak Ada Produk</h3>
        <p>Belum ada produk di kategori ini.</p>
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

<script>
  // Salin kode promo ke clipboard
  function copyPromo(btn) {
    const code = btn.dataset.code;
    navigator.clipboard.writeText(code).then(() => {
      const orig = btn.textContent;
      btn.textContent = '✓ Disalin!';
      btn.classList.add('copied');
      setTimeout(() => {
        btn.textContent = orig;
        btn.classList.remove('copied');
      }, 2000);
    });
  }

  (function() {
    const btns = document.querySelectorAll('.produk-filter-btn');
    const cards = document.querySelectorAll('#productGrid .product-card');
    const empty = document.getElementById('emptyState');

    btns.forEach(btn => {
      btn.addEventListener('click', () => {
        btns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filter = btn.dataset.filter;
        let visible = 0;

        cards.forEach(card => {
          const match = filter === 'Semua' || card.dataset.kategori === filter;
          if (match) {
            card.style.display = '';
            card.style.animation = 'none';
            void card.offsetWidth; // reflow
            card.style.animation = '';
            card.style.animationDelay = (visible * 0.07) + 's';
            visible++;
          } else {
            card.style.display = 'none';
          }
        });

        empty.style.display = visible === 0 ? 'flex' : 'none';
      });
    });
  })();
</script>

<?php include 'partials/footer.php'; ?>
