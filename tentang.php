<?php
require_once 'config.php';
$pageTitle = 'Tentang Kami';
include 'partials/header.php';
include 'partials/navbar.php';
?>

<main>

  <!-- ═══ PAGE HERO ═══ -->
  <section class="about-hero">
    <div class="container">
      <div class="about-hero-inner">
        <div class="about-hero-text">
          <span class="section-tag">Kenali Kami Lebih Dekat</span>
          <h1 class="page-title">Tentang <em><?= SITE_NAME ?></em></h1>
          <p class="about-lead">
            UMKM lokal yang lahir dari kecintaan terhadap produk Indonesia.
            Kami percaya kualitas terbaik bisa datang dari tangan-tangan pengrajin lokal.
          </p>
        </div>
        <div class="about-hero-img">
          <div class="about-img-frame">
            <img src="https://placehold.co/560x420/C9B99A/FFF?text=Berkah+Jaya"
              alt="Tentang <?= SITE_NAME ?>" loading="lazy">
            <div class="about-img-badge">
              <span class="aib-num">2020</span>
              <span class="aib-label">Berdiri sejak</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ STATS ROW ═══ -->
  <section class="about-stats">
    <div class="container">
      <div class="about-stats-grid">
        <div class="astat-card">
          <span class="astat-num">5+</span>
          <span class="astat-label">Tahun Berpengalaman</span>
        </div>
        <div class="astat-card">
          <span class="astat-num">500+</span>
          <span class="astat-label">Pelanggan Puas</span>
        </div>
        <div class="astat-card">
          <span class="astat-num">50+</span>
          <span class="astat-label">Produk Pilihan</span>
        </div>
        <div class="astat-card">
          <span class="astat-num">4.9★</span>
          <span class="astat-label">Rating Rata-rata</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ CERITA KAMI ═══ -->
  <section class="about-story section-padding">
    <div class="container">
      <div class="about-story-grid">

        <div class="about-story-left">
          <span class="section-tag">Cerita Kami</span>
          <h2 class="section-title">Dari Lokal, <em>Untuk Semua</em></h2>
          <div class="about-story-body">
            <p>
              <?= SITE_NAME ?> lahir pada tahun 2020 dari semangat sederhana: mendekatkan
              produk lokal berkualitas ke tangan masyarakat. Berawal dari garasi kecil
              di Bandung, kami kini melayani ratusan pelanggan di seluruh Indonesia.
            </p>
            <p>
              Setiap produk yang kami hadirkan dipilih dengan cermat — mulai dari kopi
              dataran tinggi, batik tulis tangan, hingga camilan khas Nusantara. Kami
              bekerja langsung bersama pengrajin dan petani lokal agar kualitas dan
              kesejahteraan mereka tetap terjaga.
            </p>
            <p>
              Visi kami sederhana: menjadi jembatan kepercayaan antara pengrajin lokal
              dan konsumen yang menghargai kualitas.
            </p>
          </div>
        </div>

        <div class="about-story-right">
          <div class="about-values">
            <div class="value-card">
              <div class="value-icon">🌿</div>
              <div>
                <div class="value-title">Produk Alami</div>
                <div class="value-desc">Bahan baku dipilih langsung dari sumbernya, tanpa bahan berbahaya.</div>
              </div>
            </div>
            <div class="value-card">
              <div class="value-icon">🤝</div>
              <div>
                <div class="value-title">Kemitraan Lokal</div>
                <div class="value-desc">Kami bekerja langsung bersama pengrajin dan petani Indonesia.</div>
              </div>
            </div>
            <div class="value-card">
              <div class="value-icon">✨</div>
              <div>
                <div class="value-title">Kualitas Terjamin</div>
                <div class="value-desc">Setiap produk melalui seleksi ketat sebelum sampai ke tangan kamu.</div>
              </div>
            </div>
            <div class="value-card">
              <div class="value-icon">💬</div>
              <div>
                <div class="value-title">Pelayanan Ramah</div>
                <div class="value-desc">Tim kami siap membantu 7 hari seminggu lewat WhatsApp.</div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══ VISI MISI ═══ -->
  <section class="visi-misi section-padding">
    <div class="container">
      <div class="vm-grid">

        <div class="vm-card vm-visi">
          <div class="vm-icon">🎯</div>
          <h3 class="vm-title">Visi</h3>
          <p class="vm-text">
            Menjadi platform UMKM lokal terpercaya yang menghubungkan
            pengrajin Indonesia dengan pasar yang lebih luas, demi
            kemajuan bersama.
          </p>
        </div>

        <div class="vm-card vm-misi">
          <div class="vm-icon">🚀</div>
          <h3 class="vm-title">Misi</h3>
          <ul class="vm-list">
            <li>Menghadirkan produk lokal berkualitas tinggi ke seluruh Indonesia</li>
            <li>Mendukung dan memberdayakan pengrajin serta petani lokal</li>
            <li>Memberikan pelayanan yang jujur, ramah, dan tepercaya</li>
            <li>Terus berinovasi agar produk lokal semakin dicintai</li>
          </ul>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══ CTA ═══ -->
  <section class="cta-strip">
    <div class="container">
      <div class="cta-strip-inner">
        <div>
          <h3 class="cta-title">Siap berbelanja produk lokal terbaik?</h3>
          <p class="cta-sub">Hubungi kami atau langsung lihat koleksi produk pilihan kami.</p>
        </div>
        <div style="display:flex;gap:1rem;flex-wrap:wrap;">
          <a href="produk.php" class="btn-outline">Lihat Produk</a>
          <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>" class="btn-primary-hero" target="_blank" rel="noopener">
            <?= SVG_WA_ICON ?> Chat WhatsApp
          </a>
        </div>
      </div>
    </div>
  </section>

</main>

<?php include 'partials/footer.php'; ?>