<?php
// config.php - Data global dan konfigurasi

define('SITE_NAME', 'Berkah Jaya');
define('SITE_DESC', 'UMKM terpercaya menyediakan produk berkualitas dan pelayanan ramah.');
define('WHATSAPP_NUMBER', '6281234567890'); // tanpa +
define('MESSAGES_FILE', __DIR__ . '/data/messages.json');

// Data produk
$products = [
    [
        'nama'       => 'Kopi Gayo Premium',
        'harga'      => 75000,
        'deskripsi'  => 'Biji kopi pilihan dari dataran tinggi Gayo, aroma khas.',
        'gambar'     => 'https://placehold.co/400x300/8B5A2B/FFF?text=Kopi+Gayo',
        'best_seller'=> true,
    ],
    [
        'nama'       => 'Batik Tulis Solo',
        'harga'      => 250000,
        'deskripsi'  => 'Kain batik tulis asli Solo, motif klasik elegan.',
        'gambar'     => 'https://placehold.co/400x300/800020/FFF?text=Batik+Solo',
        'best_seller'=> false,
    ],
    [
        'nama'       => 'Kripik Singkong Balado',
        'harga'      => 20000,
        'deskripsi'  => 'Renyah, pedas gurih, camilan favorit keluarga.',
        'gambar'     => 'https://placehold.co/400x300/D2691E/FFF?text=Kripik+Singkong',
        'best_seller'=> true,
    ],
    [
        'nama'       => 'Sambal Bawang Premium',
        'harga'      => 35000,
        'deskripsi'  => 'Sambal segar tanpa pengawet, pedas menggoda.',
        'gambar'     => 'https://placehold.co/400x300/B22222/FFF?text=Sambal+Bawang',
        'best_seller'=> false,
    ],
    [
        'nama'       => 'Tas Rajut Handmade',
        'harga'      => 120000,
        'deskripsi'  => 'Tas rajut cantik, cocok untuk gaya kasual.',
        'gambar'     => 'https://placehold.co/400x300/FF69B4/FFF?text=Tas+Rajut',
        'best_seller'=> true,
    ],
    [
        'nama'       => 'Lilin Aromaterapi',
        'harga'      => 45000,
        'deskripsi'  => 'Aroma menenangkan dari bahan alami, tahan lama.',
        'gambar'     => 'https://placehold.co/400x300/9370DB/FFF?text=Lilin+Aroma',
        'best_seller'=> false,
    ],
];

// Data testimoni
$testimonials = [
    ['nama' => 'Sari W.',   'pesan' => 'Produknya berkualitas! Pengiriman cepat. Pasti beli lagi.'],
    ['nama' => 'Rudi H.',   'pesan' => 'Pelayanan ramah dan harganya terjangkau. Recommended!'],
    ['nama' => 'Dewi L.',   'pesan' => 'Batiknya cantik, sesuai gambar. Suka banget!'],
];

// Fungsi helper untuk aktif menu (opsional)
function isActivePage($page) {
    $current = basename($_SERVER['PHP_SELF'], '.php');
    return $current === $page ? 'active' : '';
}