<?php
require_once 'config.php';
$pageTitle = 'Semua Produk';
include 'partials/header.php';
include 'partials/navbar.php';

// Hitung stats
$totalProduk   = count($products);
$bestSellerCount = count(array_filter($products, fn($p) => $p['best_seller']));
$hargaMin      = min(array_column($products, 'harga'));
$hargaMax      = max(array_column($products, 'harga'));
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
          <div class="phs-item">
            <span class="phs-num"><?= $totalProduk ?>+</span>
            <span class="phs-label">Produk</span>
          </div>
          <div class="phs-divider"></div>
          <div class="phs-item">
            <span class="phs-num"><?= $bestSellerCount ?></span>
            <span class="phs-label">Best Seller</span>
          </div>
          <div class="phs-divider"></div>
          <div class="phs-item">
            <span class="phs-num">4.9★</span>
            <span class="phs-label">Rating</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ FILTER & SEARCH BAR ═══ -->
  <div class="filter-bar">
    <div class="container">
      <div class="filter-bar-inner">

        <!-- Search -->
        <div class="search-wrap">
          <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.35-4.35" />
          </svg>
          <input type="text" id="searchInput" placeholder="Cari produk..." class="search-input">
        </div>

        <!-- Filter Buttons -->
        <div class="filter-btns">
          <button class="filter-btn active" data-filter="all">Semua</button>
          <button class="filter-btn" data-filter="best">Best Seller</button>
        </div>

        <!-- Sort -->
        <div class="sort-wrap">
          <label for="sortSelect" class="sort-label">Urutkan:</label>
          <select id="sortSelect" class="sort-select">
            <option value="default">Default</option>
            <option value="harga-asc">Harga: Terendah</option>
            <option value="harga-desc">Harga: Tertinggi</option>
            <option value="nama-asc">Nama: A–Z</option>
          </select>
        </div>

      </div>
    </div>
  </div>

  <!-- ═══ PRODUCT GRID ═══ -->
  <section class="produk-section section-padding">
    <div class="container">

      <!-- Result count -->
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
          <?php foreach ($products as $i => $p): ?>
            <div class="product-card"
              data-nama="<?= strtolower(htmlspecialchars($p['nama'])) ?>"
              data-harga="<?= $p['harga'] ?>"
              data-bestseller="<?= $p['best_seller'] ? 'true' : 'false' ?>"
              style="animation-delay: <?= $i * 0.06 ?>s">

              <div class="product-thumb">
                <img src="<?= htmlspecialchars($p['gambar']) ?>"
                  alt="<?= htmlspecialchars($p['nama']) ?>"
                  loading="lazy">
                <?php if ($p['best_seller']): ?>
                  <span class="badge-best">Best Seller</span>
                <?php endif; ?>
                <div class="product-thumb-overlay">
                  <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo%2C%20saya%20tertarik%20dengan%20<?= urlencode($p['nama']) ?>"
                    class="overlay-btn" target="_blank" rel="noopener">
                    Pesan Sekarang
                  </a>
                </div>
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

        <!-- Empty filter state -->
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
          <?= SVG_WA_ICON ?>
          Chat WhatsApp
        </a>
      </div>
    </div>
  </section>

</main>

<?php include 'partials/footer.php'; ?>

<script>
  (function() {
    const grid = document.getElementById('productGrid');
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const resultCount = document.getElementById('resultCount');
    const emptyFilter = document.getElementById('emptyFilter');

    if (!grid) return;

    let activeFilter = 'all';

    function getCards() {
      return Array.from(grid.querySelectorAll('.product-card'));
    }

    function applyFilters() {
      const query = searchInput.value.toLowerCase().trim();
      const sort = sortSelect.value;
      let cards = getCards();

      // Sort DOM order
      cards.sort((a, b) => {
        if (sort === 'harga-asc') return +a.dataset.harga - +b.dataset.harga;
        if (sort === 'harga-desc') return +b.dataset.harga - +a.dataset.harga;
        if (sort === 'nama-asc') return a.dataset.nama.localeCompare(b.dataset.nama);
        return 0;
      });
      cards.forEach(c => grid.appendChild(c));

      // Filter + search
      let visible = 0;
      cards.forEach(card => {
        const matchSearch = !query || card.dataset.nama.includes(query);
        const matchFilter = activeFilter === 'all' || (activeFilter === 'best' && card.dataset.bestseller === 'true');
        const show = matchSearch && matchFilter;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
      });

      resultCount.textContent = visible + ' produk ditemukan';
      emptyFilter.style.display = visible === 0 ? 'flex' : 'none';
      grid.style.display = visible === 0 ? 'none' : '';
    }

    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        activeFilter = btn.dataset.filter;
        applyFilters();
      });
    });

    searchInput.addEventListener('input', applyFilters);
    sortSelect.addEventListener('change', applyFilters);

    window.resetFilter = function() {
      searchInput.value = '';
      sortSelect.value = 'default';
      filterBtns.forEach(b => b.classList.remove('active'));
      filterBtns[0].classList.add('active');
      activeFilter = 'all';
      applyFilters();
    };
  })();
</script>