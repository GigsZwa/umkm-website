<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- SEO Basic -->
  <meta name="description" content="<?= SITE_DESC ?>">
  <meta name="author" content="<?= SITE_NAME ?>">
  <title><?= SITE_NAME ?> - <?= SITE_DESC ?></title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- CSS Utama -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- ========== NAVBAR ========== -->
  <?php include 'partials/navbar.php'; ?>

  <main>
    <!-- ========== HERO ========== -->
    <section id="home" class="hero">
      <div class="container hero-content">
        <h1 class="fade-in">Solusi Kebutuhan Anda, <span>Kualitas Terbaik</span></h1>
        <p class="fade-in">Dapatkan produk unggulan UMKM lokal dengan harga bersahabat.</p>
        <a href="#produk" class="btn btn-primary fade-in">Lihat Produk</a>
      </div>
    </section>

    <!-- ========== PROMO ========== -->
    <section class="promo">
      <div class="container">
        <div class="promo-banner">
          <span>🎉 Diskon 20% untuk Pembelian Pertama!</span>
          <span>Kode: <strong>UMKM20</strong></span>
        </div>
      </div>
    </section>

    <!-- ========== TENTANG KAMI ========== -->
    <section id="tentang" class="about section-padding bg-light">
      <div class="container about-content">
        <div class="about-text fade-in">
          <h2 class="section-title">Tentang <?= SITE_NAME ?></h2>
          <p>Kami adalah UMKM lokal yang berdedikasi menyediakan produk berkualitas tinggi dengan pelayanan terbaik. Berdiri sejak 2020, kami terus berinovasi untuk memenuhi kebutuhan pelanggan.</p>
          <p>Visi kami adalah menjadi mitra terpercaya bagi masyarakat dan mendukung gerakan bangga produk lokal.</p>
        </div>
        <div class="about-image fade-in">
          <img src="https://placehold.co/500x400/EEE/999?text=Tentang+Kami" alt="Tentang Kami" loading="lazy">
        </div>
      </div>
    </section>
    
    <!-- ========== PRODUK ========== -->
    <section id="produk" class="products section-padding">
      <div class="container">
        <h2 class="section-title">Produk Unggulan</h2>
        <div class="product-grid">
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
              <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo,%20saya%20tertarik%20dengan%20<?= urlencode($p['nama']) ?>" 
                 class="btn btn-wa" target="_blank">
                Order via WhatsApp
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>


    <!-- ========== TESTIMONI ========== -->
    <section id="testimoni" class="testimonials section-padding">
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

    <!-- ========== KONTAK ========== -->
    <section id="kontak" class="contact section-padding bg-light">
      <div class="container">
        <h2 class="section-title">Hubungi Kami</h2>
        <div class="contact-form-wrapper fade-in">
          <!-- Notifikasi -->
          <?php if (isset($_GET['status']) && $_GET['status']=='success'): ?>
            <div class="alert alert-success">Pesan berhasil dikirim! Kami akan menghubungi Anda segera.</div>
          <?php elseif (isset($_GET['status']) && $_GET['status']=='error' && isset($_GET['msg'])): ?>
            <div class="alert alert-error"><?= htmlspecialchars(str_replace('|', '<br>', $_GET['msg'])) ?></div>
          <?php endif; ?>

          <form id="contactForm" action="process_contact.php" method="post">
            <div class="form-group">
              <label for="nama">Nama Lengkap</label>
              <input type="text" id="nama" name="nama" placeholder="Nama Anda" required minlength="3">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
              <label for="pesan">Pesan</label>
              <textarea id="pesan" name="pesan" rows="5" placeholder="Tulis pesan Anda..." required minlength="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
          </form>
        </div>
      </div>
    </section>
  </main>

  <!-- ========== FOOTER ========== -->
  <?php include 'partials/footer.php'; ?>

  <!-- Tombol WhatsApp Floating -->
  <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Halo,%20saya%20ingin%20bertanya..." 
     class="wa-float" target="_blank" aria-label="Chat via WhatsApp">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
  </a>

  <!-- JavaScript -->
  <script src="assets/js/script.js"></script>
</body>
</html>