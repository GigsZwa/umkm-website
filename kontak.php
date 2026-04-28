<?php
require_once 'config.php';
$pageTitle = 'Kontak Kami';
include 'partials/header.php';
include 'partials/navbar.php';

// Ambil notifikasi dari query string
$alertType = '';
$message = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        $alertType = 'success';
        $message = 'Pesan berhasil dikirim! Kami akan menghubungi Anda segera.';
    } elseif ($_GET['status'] === 'error' && isset($_GET['msg'])) {
        $alertType = 'error';
        $message = nl2br(htmlspecialchars(str_replace('|', "\n", $_GET['msg'])));
    }
}
?>

<main>
  <section class="contact section-padding bg-light">
    <div class="container">
      <h2 class="section-title">Hubungi Kami</h2>
      <div class="contact-form-wrapper fade-in">
        <?php if ($alertType === 'success'): ?>
          <div class="alert alert-success"><?= $message ?></div>
        <?php elseif ($alertType === 'error'): ?>
          <div class="alert alert-error"><?= $message ?></div>
        <?php endif; ?>

        <form action="process_contact.php" method="POST" id="contactForm">
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

<?php include 'partials/footer.php'; ?>