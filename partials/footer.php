<footer class="footer">
  <div class="container footer-grid">
    <div class="footer-about">
      <h3><?= SITE_NAME ?></h3>
      <p><?= SITE_DESC ?></p>
    </div>
    <div class="footer-links">
      <h4>Menu</h4>
      <ul>
        <li><a href="#home">Beranda</a></li>
        <li><a href="#tentang">Tentang</a></li>
        <li><a href="#produk">Produk</a></li>
        <li><a href="#kontak">Kontak</a></li>
      </ul>
    </div>
    <div class="footer-contact">
      <h4>Hubungi Kami</h4>
      <p>WhatsApp: <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>" target="_blank">+62 <?= substr(WHATSAPP_NUMBER,2) ?></a></p>
      <p>Email: info@<?= strtolower(str_replace(' ','',SITE_NAME)) ?>.com</p>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?>. All rights reserved.</p>
  </div>
</footer>