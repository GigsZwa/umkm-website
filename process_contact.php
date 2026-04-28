<?php
require_once 'config.php';

// Hanya terima metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Ambil & sanitasi input
$nama  = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$pesan = filter_input(INPUT_POST, 'pesan', FILTER_SANITIZE_SPECIAL_CHARS);

// Validasi sisi server
$errors = [];
if (strlen(trim($nama)) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}
if (strlen(trim($pesan)) < 10) {
    $errors[] = 'Pesan minimal 10 karakter.';
}

if (!empty($errors)) {
    // Kirim pesan error via URL
    $msg = implode('|', $errors);
    header('Location: index.php#kontak&status=error&msg=' . urlencode($msg));
    exit;
}

// Siapkan data pesan
$message = [
    'nama'  => htmlspecialchars(trim($nama)),
    'email' => htmlspecialchars(trim($email)),
    'pesan' => htmlspecialchars(trim($pesan)),
    'waktu' => date('Y-m-d H:i:s'),
];

// Baca file JSON (jika ada)
$data = [];
if (file_exists(MESSAGES_FILE)) {
    $json = file_get_contents(MESSAGES_FILE);
    $data = json_decode($json, true) ?: [];
}

// Tambahkan pesan baru
$data[] = $message;

// Buat folder data jika belum ada
if (!is_dir(dirname(MESSAGES_FILE))) {
    mkdir(dirname(MESSAGES_FILE), 0755, true);
}

// Simpan kembali ke file
file_put_contents(MESSAGES_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Redirect dengan status sukses
header('Location: index.php#kontak&status=success');
exit;