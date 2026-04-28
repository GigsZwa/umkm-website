// config.js - Data global dan pengaturan situs
const path = require('path');

const siteConfig = {
  siteName: 'Berkah Jaya',
  siteDesc: 'UMKM terpercaya menyediakan produk berkualitas dan pelayanan ramah.',
  whatsappNumber: '6281234567890',       // tanpa +, awali 62
  messagesFile: path.join(__dirname, 'data', 'messages.json'),
};

// Data produk di-load dari file JSON agar mudah diedit
const products = require('./data/products.json');
const testimonials = require('./data/testimonials.json');

module.exports = {
  siteConfig,
  products,
  testimonials,
};