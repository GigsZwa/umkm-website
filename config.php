<?php
// config.php - Data global dan konfigurasi

define('SITE_NAME',        'Berkah Jaya');
define('SITE_DESC',        'UMKM terpercaya menyediakan produk berkualitas dan pelayanan ramah.');
define('WHATSAPP_NUMBER',  '6281234567890'); // tanpa +
define('MESSAGES_FILE',    __DIR__ . '/data/messages.json');
define('PROMO_CODE',       'UMKM20');

// WhatsApp SVG Icon (dipakai di tombol order)
define('SVG_WA_ICON', '<svg width="15" height="15" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
  <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.11 1.522 5.847L.057 23.854a.5.5 0 00.613.613l6.012-1.465A11.953 11.953 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.882a9.866 9.866 0 01-5.012-1.368l-.36-.213-3.724.975.993-3.63-.234-.373A9.836 9.836 0 012.118 12C2.118 6.526 6.526 2.118 12 2.118c5.474 0 9.882 4.408 9.882 9.882 0 5.474-4.408 9.882-9.882 9.882z"/>
</svg>');

// Data produk
$products = [
    [
        'nama'        => 'Kopi Gayo Premium',
        'harga'       => 75000,
        'deskripsi'   => 'Biji kopi pilihan dari dataran tinggi Gayo, aroma khas.',
        'gambar'      => 'https://placehold.co/400x300/8B5A2B/FFF?text=Kopi+Gayo',
        'best_seller' => true,
    ],
    [
        'nama'        => 'Batik Tulis Solo',
        'harga'       => 250000,
        'deskripsi'   => 'Kain batik tulis asli Solo, motif klasik elegan.',
        'gambar'      => 'https://placehold.co/400x300/800020/FFF?text=Batik+Solo',
        'best_seller' => false,
    ],
    [
        'nama'        => 'Kripik Singkong Balado',
        'harga'       => 20000,
        'deskripsi'   => 'Renyah, pedas gurih, camilan favorit keluarga.',
        'gambar'      => 'https://placehold.co/400x300/D2691E/FFF?text=Kripik+Singkong',
        'best_seller' => true,
    ],
    [
        'nama'        => 'Sambal Bawang Premium',
        'harga'       => 35000,
        'deskripsi'   => 'Sambal segar tanpa pengawet, pedas menggoda.',
        'gambar'      => 'https://placehold.co/400x300/B22222/FFF?text=Sambal+Bawang',
        'best_seller' => false,
    ],
    [
        'nama'        => 'Tas Rajut Handmade',
        'harga'       => 120000,
        'deskripsi'   => 'Tas rajut cantik, cocok untuk gaya kasual.',
        'gambar'      => 'https://placehold.co/400x300/FF69B4/FFF?text=Tas+Rajut',
        'best_seller' => true,
    ],
    [
        'nama'        => 'Lilin Aromaterapi',
        'harga'       => 45000,
        'deskripsi'   => 'Aroma menenangkan dari bahan alami, tahan lama.',
        'gambar'      => 'https://placehold.co/400x300/9370DB/FFF?text=Lilin+Aroma',
        'best_seller' => false,
    ],
];

// Data testimoni
$testimonials = [
    ['nama' => 'Sari W.',  'pesan' => 'Produknya berkualitas! Pengiriman cepat. Pasti beli lagi.'],
    ['nama' => 'Rudi H.',  'pesan' => 'Pelayanan ramah dan harganya terjangkau. Recommended!'],
    ['nama' => 'Dewi L.',  'pesan' => 'Batiknya cantik, sesuai gambar. Suka banget!'],
];

// Fungsi helper untuk aktif menu
function isActivePage($page)
{
    $current = basename($_SERVER['PHP_SELF'], '.php');
    return $current === $page ? 'active' : '';
}
