<?php
require_once 'config.php';
$pageTitle = 'Detail Produk';

// Ambil produk berdasarkan id atau nama dari URL
$idParam = $_GET['id'] ?? '';

$produk = null;
foreach ($products as $p) {
    // Coba cocokkan via id dulu, fallback ke nama
    $matchId   = isset($p['id'])  && (string)$p['id']  === $idParam;
    $matchNama = urlencode($p['nama']) === $idParam || $p['nama'] === urldecode($idParam);
    if ($matchId || $matchNama) {
        $produk = $p;
        break;
    }
}

// Jika tidak ketemu, redirect
if (!$produk) {
    header('Location: produk.php');
    exit;
}

$kategoriIcon = [
    'Minuman'   => '☕',
    'Makanan'   => '🍱',
    'Fashion'   => '👗',
    'Kerajinan' => '🪴',
    'Perawatan' => '🧴',
    'Lainnya'   => '📦',
];

$kat  = $produk['kategori'] ?? 'Lainnya';
$icon = $kategoriIcon[$kat] ?? '📦';
$slug = urlencode($produk['id'] ?? $produk['nama']);

// Spesifikasi — dari data atau fallback default per kategori
$spesifikasi = $produk['spesifikasi'] ?? [];
if (empty($spesifikasi)) {
    // Contoh fallback spesifikasi berdasarkan kategori
    $spesDefault = [
        'Minuman'   => ['Volume' => '250 ml', 'Kemasan' => 'Botol kaca', 'Ketahanan' => '7 hari', 'Tanpa pengawet' => 'Ya'],
        'Makanan'   => ['Berat bersih' => '200 g', 'Kemasan' => 'Box karton', 'Tanpa MSG' => 'Ya', 'Tanpa pengawet' => 'Ya'],
        'Fashion'   => ['Bahan' => '100% Cotton', 'Ukuran' => 'S / M / L / XL', 'Perawatan' => 'Cuci tangan', 'Buatan' => 'Lokal'],
        'Kerajinan' => ['Material' => 'Kayu jati', 'Dimensi' => '20 × 15 cm', 'Finishing' => 'Natural oil', 'Handmade' => 'Ya'],
        'Perawatan' => ['Isi bersih' => '100 ml', 'Bahan utama' => 'Aloe vera', 'BPOM' => 'Terdaftar', 'Paraben free' => 'Ya'],
        'Lainnya'   => ['Kondisi' => 'Baru', 'Garansi' => '7 hari', 'Pengiriman' => 'Aman terbungkus'],
    ];
    $spesifikasi = $spesDefault[$kat] ?? $spesDefault['Lainnya'];
}

// Produk lain (related) — kategori sama, exclude diri sendiri, maks 4
$related = array_filter(
    $products,
    fn($p) => ($p['kategori'] ?? 'Lainnya') === $kat &&
        ($p['nama'] !== $produk['nama'])
);
$related = array_slice(array_values($related), 0, 4);

$pageTitle = htmlspecialchars($produk['nama']) . ' — Detail Produk';
include 'partials/header.php';
include 'partials/navbar.php';
?>

<main class="detail-main">

    <!-- ═══ BREADCRUMB ═══ -->
    <div class="breadcrumb-bar">
        <div class="container">
            <nav class="breadcrumb">
                <a href="index.php">Beranda</a>
                <span class="bc-sep">›</span>
                <a href="produk.php">Produk</a>
                <span class="bc-sep">›</span>
                <a href="produk.php?kategori=<?= urlencode($kat) ?>"><?= $icon ?> <?= htmlspecialchars($kat) ?></a>
                <span class="bc-sep">›</span>
                <span class="bc-current"><?= htmlspecialchars($produk['nama']) ?></span>
            </nav>
        </div>
    </div>

    <!-- ═══ HERO DETAIL ═══ -->
    <section class="detail-hero">
        <div class="container">
            <div class="detail-grid">

                <!-- Gambar -->
                <div class="detail-gallery">
                    <div class="detail-img-wrap">
                        <img src="<?= htmlspecialchars($produk['gambar']) ?>"
                            alt="<?= htmlspecialchars($produk['nama']) ?>"
                            class="detail-img-main" id="mainImg">
                        <?php if ($produk['best_seller']): ?>
                            <span class="detail-badge-best">⭐ Best Seller</span>
                        <?php endif; ?>
                    </div>
                    <!-- Galeri thumbnail (jika ada array gambar) -->
                    <?php if (!empty($produk['galeri'])): ?>
                        <div class="detail-thumbs">
                            <?php foreach ($produk['galeri'] as $g): ?>
                                <img src="<?= htmlspecialchars($g) ?>" alt="" class="detail-thumb"
                                    onclick="document.getElementById('mainImg').src=this.src; document.querySelectorAll('.detail-thumb').forEach(t=>t.classList.remove('active')); this.classList.add('active')">
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Info -->
                <div class="detail-info">
                    <span class="detail-kategori-tag"><?= $icon ?> <?= htmlspecialchars($kat) ?></span>
                    <h1 class="detail-nama"><?= htmlspecialchars($produk['nama']) ?></h1>

                    <div class="detail-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-num">4.9</span>
                        <span class="rating-count">(<?= rand(12, 98) ?> ulasan)</span>
                    </div>

                    <div class="detail-harga">
                        Rp <?= number_format($produk['harga'], 0, ',', '.') ?>
                    </div>

                    <p class="detail-deskripsi"><?= htmlspecialchars($produk['deskripsi']) ?></p>

                    <!-- Spesifikasi ringkas di samping harga -->
                    <div class="detail-spec-grid">
                        <?php foreach ($spesifikasi as $key => $val): ?>
                            <div class="detail-spec-item">
                                <span class="spec-key"><?= htmlspecialchars($key) ?></span>
                                <span class="spec-val"><?= htmlspecialchars($val) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- CTA -->
                    <div class="detail-cta">
                        <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo+<?= rawurlencode(SITE_NAME) ?>%2C+saya+tertarik+dengan+<?= rawurlencode($produk['nama']) ?>+seharga+Rp+<?= number_format($produk['harga'], 0, ',', '.') ?>.+Apakah+masih+tersedia%3F"
                            class="btn-order-wa" target="_blank" rel="noopener">
                            <?= SVG_WA_ICON ?>
                            Pesan via WhatsApp
                        </a>
                        <button class="btn-share" onclick="shareProduct()" title="Bagikan produk">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                                <circle cx="18" cy="5" r="3" />
                                <circle cx="6" cy="12" r="3" />
                                <circle cx="18" cy="19" r="3" />
                                <path d="m8.59 13.51 6.83 3.98M15.41 6.51l-6.82 3.98" />
                            </svg>
                        </button>
                    </div>

                    <div class="detail-perks">
                        <span class="perk-item">✓ Produk UMKM lokal</span>
                        <span class="perk-item">✓ Respons cepat WA</span>
                        <span class="perk-item">✓ Dikemas dengan aman</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══ SPESIFIKASI LENGKAP ═══ -->
    <section class="spec-section section-padding">
        <div class="container">
            <div class="spec-tabs-wrap">

                <!-- Tab nav -->
                <div class="spec-tab-nav">
                    <button class="spec-tab-btn active" data-tab="spesifikasi">Spesifikasi</button>
                    <button class="spec-tab-btn" data-tab="deskripsi">Deskripsi</button>
                    <button class="spec-tab-btn" data-tab="pengiriman">Pengiriman & Garansi</button>
                </div>

                <!-- Tab: Spesifikasi -->
                <div class="spec-tab-content active" id="tab-spesifikasi">
                    <table class="spec-table">
                        <tbody>
                            <?php foreach ($spesifikasi as $key => $val): ?>
                                <tr>
                                    <th><?= htmlspecialchars($key) ?></th>
                                    <td><?= htmlspecialchars($val) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th>Kategori</th>
                                <td><?= $icon ?> <?= htmlspecialchars($kat) ?></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td><strong>Rp <?= number_format($produk['harga'], 0, ',', '.') ?></strong></td>
                            </tr>
                            <?php if ($produk['best_seller']): ?>
                                <tr>
                                    <th>Status</th>
                                    <td><span class="spec-badge-best">⭐ Best Seller</span></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Tab: Deskripsi -->
                <div class="spec-tab-content" id="tab-deskripsi">
                    <div class="desc-content">
                        <p><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></p>
                        <?php if (!empty($produk['deskripsi_panjang'])): ?>
                            <p><?= nl2br(htmlspecialchars($produk['deskripsi_panjang'])) ?></p>
                        <?php else: ?>
                            <p>Produk ini merupakan hasil karya pengrajin lokal yang dibuat dengan penuh dedikasi dan perhatian terhadap detail. Setiap produk dikerjakan secara teliti untuk memastikan kualitas terbaik sampai ke tangan Anda.</p>
                            <ul class="desc-highlights">
                                <li>Dibuat dari bahan berkualitas pilihan</li>
                                <li>Proses produksi higienis dan terkontrol</li>
                                <li>Mendukung pengrajin & UMKM lokal Indonesia</li>
                                <li>Dikemas aman untuk pengiriman</li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Tab: Pengiriman & Garansi -->
                <div class="spec-tab-content" id="tab-pengiriman">
                    <div class="shipping-grid">
                        <div class="shipping-item">
                            <div class="si-icon">🚚</div>
                            <h4>Pengiriman</h4>
                            <p>Tersedia pengiriman ke seluruh wilayah. Produk dikemas dengan aman menggunakan bubble wrap dan kardus. Estimasi pengiriman 1–5 hari kerja tergantung lokasi.</p>
                        </div>
                        <div class="shipping-item">
                            <div class="si-icon">🔄</div>
                            <h4>Pengembalian</h4>
                            <p>Garansi pengembalian 7 hari jika produk rusak atau tidak sesuai pesanan. Hubungi kami via WhatsApp dengan foto produk.</p>
                        </div>
                        <div class="shipping-item">
                            <div class="si-icon">💳</div>
                            <h4>Pembayaran</h4>
                            <p>Transfer bank, e-wallet (GoPay, OVO, Dana), dan COD untuk area tertentu. Konfirmasi langsung via WhatsApp.</p>
                        </div>
                        <div class="shipping-item">
                            <div class="si-icon">🛡️</div>
                            <h4>Jaminan Kualitas</h4>
                            <p>Setiap produk melewati quality check sebelum dikirim. Kepuasan pelanggan adalah prioritas utama kami.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══ PRODUK TERKAIT ═══ -->
    <?php if (!empty($related)): ?>
        <section class="related-section section-padding">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Koleksi <?= htmlspecialchars($kat) ?></span>
                    <h2 class="section-title">Produk <em>Terkait</em></h2>
                </div>
                <div class="product-grid related-grid">
                    <?php foreach ($related as $r):
                        $rSlug = urlencode($r['id'] ?? $r['nama']);
                    ?>
                        <div class="product-card">
                            <div class="product-thumb">
                                <img src="<?= htmlspecialchars($r['gambar']) ?>" alt="<?= htmlspecialchars($r['nama']) ?>" loading="lazy">
                                <?php if ($r['best_seller']): ?><span class="badge-best">Best Seller</span><?php endif; ?>
                                <div class="product-hover-detail">
                                    <div class="phd-inner">
                                        <span class="phd-kategori"><?= $kategoriIcon[$r['kategori'] ?? 'Lainnya'] ?? '📦' ?> <?= htmlspecialchars($r['kategori'] ?? 'Lainnya') ?></span>
                                        <p class="phd-desc"><?= htmlspecialchars($r['deskripsi']) ?></p>
                                        <div class="phd-actions">
                                            <a href="detail.php?id=<?= $rSlug ?>" class="phd-btn-detail">Lihat Detail</a>
                                            <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo%2C+saya+tertarik+dengan+<?= rawurlencode($r['nama']) ?>" class="phd-btn-wa" target="_blank" rel="noopener"><?= SVG_WA_ICON ?> Order</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-body">
                                <span class="product-kategori-tag"><?= htmlspecialchars($r['kategori'] ?? 'Lainnya') ?></span>
                                <div class="product-name"><?= htmlspecialchars($r['nama']) ?></div>
                                <div class="product-price">Rp <?= number_format($r['harga'], 0, ',', '.') ?></div>
                                <div class="product-card-actions">
                                    <a href="detail.php?id=<?= $rSlug ?>" class="btn-detail">Lihat Detail</a>
                                    <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo%2C+saya+tertarik+dengan+<?= rawurlencode($r['nama']) ?>" class="btn-wa" target="_blank" rel="noopener"><?= SVG_WA_ICON ?> Order</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php include 'partials/footer.php'; ?>
<script src="assets/js/script.js"></script>