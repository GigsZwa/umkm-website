const express = require('express');
const router = express.Router();
const { products, testimonials } = require('../config');

router.get('/', (req, res) => {
  // Data produk untuk ditampilkan di beranda (bisa sebagian, atau semua)
  res.render('index', {
    pageTitle: 'Beranda',
    products,       // semua produk
    testimonials,
    promoCode: 'UMKM20',
    discount: '20%',
  });
});

module.exports = router;