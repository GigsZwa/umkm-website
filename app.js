const express = require('express');
const path = require('path');
const fs = require('fs');
const { siteConfig } = require('./config');

const app = express();
const PORT = process.env.PORT || 3000;

// Set view engine
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

// Middleware
app.use(express.static(path.join(__dirname, 'public')));
app.use(express.urlencoded({ extended: false })); // untuk parsing body form
app.use(express.json());

// Global variable untuk digunakan di semua template
app.use((req, res, next) => {
  res.locals.siteName = siteConfig.siteName;
  res.locals.siteDesc = siteConfig.siteDesc;
  res.locals.whatsapp = siteConfig.whatsappNumber;
  res.locals.currentPath = req.path;  // untuk indikator nav aktif (opsional)
  next();
});

// Pastikan folder data & file messages.json ada
const dataDir = path.join(__dirname, 'data');
if (!fs.existsSync(dataDir)) fs.mkdirSync(dataDir);
const messagesFile = siteConfig.messagesFile;
if (!fs.existsSync(messagesFile)) fs.writeFileSync(messagesFile, '[]', 'utf-8');

// Import route modules
const indexRoute = require('./routes/index');
const tentangRoute = require('./routes/tentang');
const produkRoute = require('./routes/produk');
const testimoniRoute = require('./routes/testimoni');
const kontakRoute = require('./routes/kontak');

// Gunakan route
app.use('/', indexRoute);
app.use('/tentang', tentangRoute);
app.use('/produk', produkRoute);
app.use('/testimoni', testimoniRoute);
app.use('/kontak', kontakRoute);

// 404 handler (opsional)
app.use((req, res) => {
  res.status(404).render('404', { pageTitle: 'Halaman Tidak Ditemukan' });
});

app.listen(PORT, () => {
  console.log(`Server berjalan di http://localhost:${PORT}`);
});