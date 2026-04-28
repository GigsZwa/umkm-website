<?php
require_once 'config.php';
$pageTitle = 'Tentang Kami';
include 'partials/header.php';
include 'partials/navbar.php';
?>

<main>
  <section class="about section-padding">
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
</main>

<?php include 'partials/footer.php'; ?>