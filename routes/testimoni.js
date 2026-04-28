const express = require('express');
const router = express.Router();
const { testimonials } = require('../config');

router.get('/', (req, res) => {
  res.render('testimoni', { 
    pageTitle: 'Testimoni',
    testimonials 
  });
});

module.exports = router;