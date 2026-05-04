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

  <!-- ══ Page Header ══ -->
  <section class="page-header">
    <div class="container">
      <div class="page-header-inner">
        <div>
          <span class="section-tag">Kami Siap Membantu</span>
          <h1 class="page-title">Hubungi <em>Kami</em></h1>
          <p class="page-subtitle">Ada pertanyaan atau ingin pesan? Jangan ragu untuk menghubungi kami.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ Contact Section ══ -->
  <section class="contact-section section-padding">
    <div class="container">
      <div class="contact-layout">

        <!-- ── Info Kontak (kiri) ── -->
        <aside class="contact-info fade-in">

          <h2 class="contact-info-title">Mari Terhubung</h2>
          <p class="contact-info-lead">Kami senang mendengar dari Anda — baik soal produk, pesanan, atau sekadar menyapa.</p>

          <div class="contact-channels">

            <a href="https://wa.me/<?= defined('NOMOR_WA') ? NOMOR_WA : '' ?>" target="_blank" rel="noopener" class="contact-channel-card">
              <div class="cc-icon cc-icon--wa">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22" height="22">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347zM12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.118 1.532 5.845L.057 23.882l6.191-1.624A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.006-1.373l-.359-.214-3.722.976.994-3.627-.235-.373A9.818 9.818 0 012.182 12C2.182 6.577 6.577 2.182 12 2.182S21.818 6.577 21.818 12 17.423 21.818 12 21.818z"/>
                </svg>
              </div>
              <div class="cc-body">
                <p class="cc-label">WhatsApp</p>
                <p class="cc-value">Chat langsung dengan kami</p>
              </div>
              <svg class="cc-arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>

            <?php if (defined('EMAIL_KONTAK')): ?>
            <a href="mailto:<?= EMAIL_KONTAK ?>" class="contact-channel-card">
              <div class="cc-icon cc-icon--email">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              </div>
              <div class="cc-body">
                <p class="cc-label">Email</p>
                <p class="cc-value"><?= EMAIL_KONTAK ?></p>
              </div>
              <svg class="cc-arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <?php endif; ?>

            <?php if (defined('ALAMAT_TOKO')): ?>
            <div class="contact-channel-card contact-channel-card--static">
              <div class="cc-icon cc-icon--loc">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </div>
              <div class="cc-body">
                <p class="cc-label">Lokasi</p>
                <p class="cc-value"><?= htmlspecialchars(ALAMAT_TOKO) ?></p>
              </div>
            </div>
            <?php endif; ?>

          </div>

          <!-- Jam operasional -->
          <div class="contact-hours">
            <p class="contact-hours-title">⏰ Jam Operasional</p>
            <div class="contact-hours-row">
              <span>Senin – Sabtu</span>
              <span>08.00 – 20.00 WIB</span>
            </div>
            <div class="contact-hours-row">
              <span>Minggu</span>
              <span>09.00 – 17.00 WIB</span>
            </div>
          </div>

        </aside>

        <!-- ── Form (kanan) ── -->
        <div class="contact-form-wrap fade-in-2">

          <!-- Alert notifikasi -->
          <?php if ($alertType === 'success'): ?>
            <div class="contact-alert contact-alert--success">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              <span><?= $message ?></span>
            </div>
          <?php elseif ($alertType === 'error'): ?>
            <div class="contact-alert contact-alert--error">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              <span><?= $message ?></span>
            </div>
          <?php endif; ?>

          <form action="process_contact.php" method="POST" id="contactForm" class="contact-form" novalidate>

            <div class="cf-header">
              <p class="cf-title">Kirim Pesan</p>
              <p class="cf-sub">Isi formulir di bawah, kami akan membalas secepatnya.</p>
            </div>

            <div class="cf-fields">

              <div class="cf-group">
                <label class="cf-label" for="nama">Nama Lengkap</label>
                <input
                  class="cf-input"
                  type="text"
                  id="nama"
                  name="nama"
                  placeholder="Contoh: Siti Rahma"
                  required
                  minlength="3"
                  autocomplete="name"
                >
              </div>

              <div class="cf-group">
                <label class="cf-label" for="email">Alamat Email</label>
                <input
                  class="cf-input"
                  type="email"
                  id="email"
                  name="email"
                  placeholder="email@contoh.com"
                  required
                  autocomplete="email"
                >
              </div>

              <div class="cf-group cf-group--full">
                <label class="cf-label" for="pesan">Pesan Anda</label>
                <textarea
                  class="cf-input cf-textarea"
                  id="pesan"
                  name="pesan"
                  rows="5"
                  placeholder="Ceritakan apa yang ingin Anda tanyakan atau sampaikan..."
                  required
                  minlength="10"
                ></textarea>
              </div>

            </div>

            <button type="submit" class="cf-submit">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
              Kirim Pesan
            </button>

          </form>
        </div>

      </div>
    </div>
  </section>

</main>

<?php include 'partials/footer.php'; ?>

<?php if ($alertType): ?>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState({}, document.title, "kontak.php");
    }
  </script>
<?php endif; ?>