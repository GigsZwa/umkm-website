<?php
require_once 'config.php';
$pageTitle = 'Testimoni Pelanggan';
include 'partials/header.php';
include 'partials/navbar.php';
?>

<main>
  <section class="testimonials section-padding">
    <div class="container">
      <h2 class="section-title">Testimoni Pelanggan</h2>
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