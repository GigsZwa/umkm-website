<?php
require_once 'config.php';
$pageTitle = 'Testimoni Pelanggan';
include 'partials/header.php';
include 'partials/navbar.php';
?>

<main>

  <!-- ══ Page Header ══ -->
  <section class="page-header">
    <div class="container">
      <div class="page-header-inner">
        <div>
          <span class="section-tag">Cerita Mereka</span>
          <h1 class="page-title">Testimoni <em>Pelanggan</em></h1>
          <p class="page-subtitle">Kata mereka yang sudah merasakan keistimewaan TokoRasa.</p>
        </div>

        <div class="page-header-stats">
          <div class="phs-item">
            <span class="phs-num"><?= count($testimonials) ?>+</span>
            <span class="phs-label">Ulasan Masuk</span>
          </div>
          <div class="phs-divider"></div>
          <div class="phs-item">
            <span class="phs-num">4.9</span>
            <span class="phs-label">Rating Rata‑rata</span>
          </div>
          <div class="phs-divider"></div>
          <div class="phs-item">
            <span class="phs-num">98%</span>
            <span class="phs-label">Puas & Repeat Order</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ Testimonials Grid ══ -->
  <section class="testi-section section-padding">
    <div class="container">

      <?php if (!empty($testimonials)): ?>

        <div class="testi-grid testi-masonry">
          <?php foreach ($testimonials as $i => $t): ?>
            <article class="testi-card fade-in" style="animation-delay: <?= $i * 0.08 ?>s">

              <!-- Rating bintang -->
              <div class="testi-stars" aria-label="5 bintang">
                <?php for ($s = 0; $s < 5; $s++): ?>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="14" height="14">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                <?php endfor; ?>
              </div>

              <!-- Quote mark dekoratif -->
              <div class="testi-quote" aria-hidden="true">"</div>

              <!-- Teks testimoni -->
              <p class="testi-text"><?= htmlspecialchars($t['pesan']) ?></p>

              <!-- Author -->
              <div class="testi-author-row">
                <div class="testi-avatar" aria-hidden="true">
                  <?= mb_strtoupper(mb_substr($t['nama'], 0, 1)) ?>
                </div>
                <div>
                  <p class="testi-author"><?= htmlspecialchars($t['nama']) ?></p>
                  <?php if (!empty($t['kota'])): ?>
                    <p class="testi-location"><?= htmlspecialchars($t['kota']) ?></p>
                  <?php endif; ?>
                </div>
              </div>

            </article>
          <?php endforeach; ?>
        </div>

      <?php else: ?>

        <!-- Empty state -->
        <div class="empty-state">
          <div class="empty-icon">💬</div>
          <h3>Belum Ada Testimoni</h3>
          <p>Jadilah yang pertama berbagi pengalamanmu bersama TokoRasa.</p>
        </div>

      <?php endif; ?>
    </div>
  </section>

  <!-- ══ CTA Strip ══ -->
  <section class="cta-strip">
    <div class="container">
      <div class="cta-strip-inner">
        <div>
          <h2 class="cta-title">Punya Pengalaman Bersama Kami?</h2>
          <p class="cta-sub">Ceritakan pengalamanmu — ulasanmu berarti banyak untuk kami.</p>
        </div>
        <a
          href="https://wa.me/628211327189?text=Halo+TokoRasa%2C+saya+ingin+berbagi+testimoni!"
          target="_blank"
          rel="noopener noreferrer"
          class="btn-wa"
          style="width:auto; padding: 0.75rem 1.75rem;">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.118 1.532 5.845L.057 23.882l6.191-1.624A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.006-1.373l-.359-.214-3.722.976.994-3.627-.235-.373A9.818 9.818 0 012.182 12C2.182 6.577 6.577 2.182 12 2.182S21.818 6.577 21.818 12 17.423 21.818 12 21.818z" />
          </svg>
          Kirim Testimoni via WhatsApp
        </a>
      </div>
    </div>
  </section>

</main>

<?php include 'partials/footer.php'; ?>