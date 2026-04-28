const express = require('express');
const router = express.Router();
const fs = require('fs');
const path = require('path');
const { siteConfig } = require('../config');

// GET: tampilkan form kontak
router.get('/', (req, res) => {
  // query parameter untuk notifikasi
  const { status, msg } = req.query;
  const alertType = status === 'success' ? 'success' : (status === 'error' ? 'error' : null);
  // Ubah msg separator jika dikirim (misal pakai "|")
  const message = msg ? msg.replace(/\|/g, '<br>') : '';
  res.render('kontak', {
    pageTitle: 'Kontak Kami',
    alertType,
    message,
  });
});

// POST: proses form kontak
router.post('/', (req, res) => {
  const { nama, email, pesan } = req.body;
  const errors = [];

  // Validasi server
  if (!nama || nama.trim().length < 3) errors.push('Nama minimal 3 karakter.');
  if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) errors.push('Format email tidak valid.');
  if (!pesan || pesan.trim().length < 10) errors.push('Pesan minimal 10 karakter.');

  if (errors.length > 0) {
    const msgParam = encodeURIComponent(errors.join('|'));
    return res.redirect(`/kontak?status=error&msg=${msgParam}`);
  }

  // Sanitasi (ganti karakter <, > untuk mencegah XSS)
  const sanitize = (str) => str.replace(/</g, '&lt;').replace(/>/g, '&gt;');
  const newMessage = {
    nama: sanitize(nama.trim()),
    email: sanitize(email.trim()),
    pesan: sanitize(pesan.trim()),
    waktu: new Date().toISOString(),
  };

  // Baca file JSON yang ada
  const filePath = siteConfig.messagesFile;
  let messages = [];
  try {
    const data = fs.readFileSync(filePath, 'utf8');
    messages = JSON.parse(data);
  } catch (err) {
    messages = [];
  }
  messages.push(newMessage);
  fs.writeFileSync(filePath, JSON.stringify(messages, null, 2), 'utf-8');

  res.redirect('/kontak?status=success');
});

module.exports = router;