const express = require('express');
const router = express.Router();

router.get('/', (req, res) => {
  res.render('tentang', { pageTitle: 'Tentang Kami' });
});

module.exports = router;