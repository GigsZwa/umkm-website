const express = require('express');
const router = express.Router();
const { products } = require('../config');

router.get('/', (req, res) => {
  res.render('produk', { 
    pageTitle: 'Produk Kami',
    products 
  });
});

module.exports = router;