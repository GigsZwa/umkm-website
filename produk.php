<?php
require_once 'config.php';
$pageTitle = 'Semua Produk';
include 'partials/header.php';
include 'partials/navbar.php';

$kategoriIcon = [
  'Minuman'   => '☕',
  'Makanan'   => '🍱',
  'Fashion'   => '👗',
  'Kerajinan' => '🪴',
  'Perawatan' => '🧴',
  'Lainnya'   => '📦',
];

$kategoriList = [];
foreach ($products as $p) {
  $kat = $p['kategori'] ?? 'Lainnya';
  if (!in_array($kat, $kategoriList)) $kategoriList[] = $kat;
}

$activeKategori  = $_GET['kategori'] ?? 'all';
$totalProduk     = count($products);
$bestSellerCount = count(array_filter($products, fn($p) => $p['best_seller']));
?>

<main>

  <!-- ═══ PAGE HEADER ═══ -->
  <section class="page-header">
    <div class="container">
      <div class="page-header-inner">
        <div>
          <span class="section-tag">Koleksi Lengkap</span>
          <h1 class="page-title">Semua <em>Produk</em></h1>
          <p class="page-subtitle"><?= $totalProduk ?> produk pilihan dari pengrajin lokal terbaik</p>
        </div>
        <div class="page-header-stats">
          <div class="phs-item"><span class="phs-num"><?= $totalProduk ?>+</span><span class="phs-label">Produk</span></div>
          <div class="phs-divider"></div>
          <div class="phs-item"><span class="phs-num"><?= $bestSellerCount ?></span><span class="phs-label">Best Seller</span></div>
          <div class="phs-divider"></div>
          <div class="phs-item"><span class="phs-num">4.9★</span><span class="phs-label">Rating</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ FILTER BAR ═══ -->
  <div class="filter-bar">
    <div class="container">
      <div class="filter-bar-inner">

        <!-- Baris 1 (desktop: inline | mobile: baris atas) -->
        <div class="filter-row-top">
          <div class="search-wrap">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.35-4.35" />
            </svg>
            <input type="text" id="searchInput" placeholder="Cari produk..." class="search-input">
          </div>
          <div class="fb-divider"></div>
          <div class="sort-wrap">
            <select id="sortSelect" class="sort-select">
              <option value="default">Urutkan</option>
              <option value="harga-asc">Harga ↑</option>
              <option value="harga-desc">Harga ↓</option>
              <option value="nama-asc">Nama A–Z</option>
            </select>
          </div>
        </div>

        <div class="fb-divider"></div>

        <!-- Baris 2 (desktop: inline | mobile: baris bawah scroll) -->
        <div class="filter-row-pills">
          <div class="filter-pills-wrap">
            <button class="filter-pill" data-filter="best">⭐ Best Seller</button>
            <span class="pills-sep"></span>
            <button class="filter-pill kategori-pill <?= $activeKategori === 'all' ? 'active' : '' ?>" data-kategori="all">✦ Semua</button>
            <?php foreach ($kategoriList as $kat):
              $icon  = $kategoriIcon[$kat] ?? '📦';
              $count = count(array_filter($products, fn($p) => ($p['kategori'] ?? 'Lainnya') === $kat));
            ?>
              <button class="filter-pill kategori-pill <?= $activeKategori === $kat ? 'active' : '' ?>" data-kategori="<?= htmlspecialchars($kat) ?>">
                <?= $icon ?> <?= htmlspecialchars($kat) ?>
                <span class="pill-count"><?= $count ?></span>
              </button>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- ═══ PRODUCT GRID ═══ -->
  <section class="produk-section section-padding">
    <div class="container">
      <div class="result-info">
        <span id="resultCount"><?= $totalProduk ?> produk ditemukan</span>
      </div>

      <?php if (empty($products)): ?>
        <div class="empty-state">
          <div class="empty-icon">📦</div>
          <h3>Belum ada produk</h3>
          <p>Produk akan segera tersedia. Pantau terus!</p>
        </div>
      <?php else: ?>

        <div class="product-grid" id="productGrid">
          <?php foreach ($products as $i => $p):
            $kat    = htmlspecialchars($p['kategori'] ?? 'Lainnya');
            $icon   = $kategoriIcon[$p['kategori'] ?? 'Lainnya'] ?? '📦';
            $slug   = urlencode($p['id'] ?? $p['nama']); // pakai id jika ada, fallback nama
            // Spesifikasi — ambil dari array jika ada, atau buat default
            $spesifikasi = $p['spesifikasi'] ?? [];
          ?>
            <div class="product-card"
              data-nama="<?= strtolower(htmlspecialchars($p['nama'])) ?>"
              data-harga="<?= $p['harga'] ?>"
              data-bestseller="<?= $p['best_seller'] ? 'true' : 'false' ?>"
              data-kategori="<?= $kat ?>"
              style="animation-delay: <?= $i * 0.06 ?>s">

              <!-- THUMB -->
              <div class="product-thumb">
                <img src="<?= htmlspecialchars($p['gambar']) ?>"
                  alt="<?= htmlspecialchars($p['nama']) ?>"
                  loading="lazy">
                <?php if ($p['best_seller']): ?>
                  <span class="badge-best">Best Seller</span>
                <?php endif; ?>

                <!-- HOVER DETAIL OVERLAY -->
                <div class="product-hover-detail">
                  <div class="phd-inner">
                    <span class="phd-kategori"><?= $icon ?> <?= $kat ?></span>
                    <p class="phd-desc"><?= htmlspecialchars($p['deskripsi']) ?></p>
                    <?php if (!empty($spesifikasi)): ?>
                      <ul class="phd-specs">
                        <?php foreach (array_slice($spesifikasi, 0, 3) as $key => $val): ?>
                          <li><span class="phd-spec-key"><?= htmlspecialchars($key) ?></span><span class="phd-spec-val"><?= htmlspecialchars($val) ?></span></li>
                        <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>
                    <div class="phd-actions">
                      <a href="detail.php?id=<?= $slug ?>" class="phd-btn-detail">Lihat Detail</a>
                      <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo%2C%20saya%20tertarik%20dengan%20<?= urlencode($p['nama']) ?>"
                        class="phd-btn-wa" target="_blank" rel="noopener">
                        <?= SVG_WA_ICON ?> Order
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- CARD BODY -->
              <div class="product-body">
                <span class="product-kategori-tag"><?= $kat ?></span>
                <div class="product-name"><?= htmlspecialchars($p['nama']) ?></div>
                <div class="product-price">Rp <?= number_format($p['harga'], 0, ',', '.') ?></div>
                <div class="product-desc"><?= htmlspecialchars($p['deskripsi']) ?></div>
                <div class="product-card-actions">
                  <a href="detail.php?id=<?= $slug ?>" class="btn-detail">Lihat Detail</a>
                  <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo%2C%20saya%20tertarik%20dengan%20<?= urlencode($p['nama']) ?>"
                    class="btn-wa" target="_blank" rel="noopener">
                    <?= SVG_WA_ICON ?> Order
                  </a>
                </div>
              </div>

            </div>
          <?php endforeach; ?>
        </div>

        <div class="empty-state" id="emptyFilter" style="display:none;">
          <div class="empty-icon">🔍</div>
          <h3>Produk tidak ditemukan</h3>
          <p>Coba kata kunci lain atau reset filter.</p>
          <button class="btn-outline" onclick="resetFilter()" style="margin-top:1rem;">Reset Filter</button>
        </div>

      <?php endif; ?>
    </div>
  </section>

  <!-- ═══ CTA STRIP ═══ -->
  <section class="cta-strip">
    <div class="container">
      <div class="cta-strip-inner">
        <div>
          <h3 class="cta-title">Ada yang ingin ditanyakan?</h3>
          <p class="cta-sub">Tim kami siap membantu kamu memilih produk terbaik.</p>
        </div>
        <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>" class="btn-primary-hero" target="_blank" rel="noopener">
          <?= SVG_WA_ICON ?> Chat WhatsApp
        </a>
      </div>
    </div>
  </section>

</main>

<script src="assets/js/script.js"></script>
<?php include 'partials/footer.php'; ?>
                          