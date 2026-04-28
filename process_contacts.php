<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: kontak.php');
    exit;
}

// Ambil & sanitasi input
$nama  = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$pesan = filter_input(INPUT_POST, 'pesan', FILTER_SANITIZE_SPECIAL_CHARS);

$errors = [];
if (strlen(trim($nama)) < 3) $errors[] = 'Nama minimal 3 karakter.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Format email tidak valid.';
if (strlen(trim($pesan)) < 10) $errors[] = 'Pesan minimal 10 karakter.';

if (!empty($errors)) {
    $msg = implode('|', $errors);
    header('Location: kontak.php?status=error&msg=' . urlencode($msg));
    exit;
}

// Sanitasi lebih lanjut (anti XSS)
$nama  = htmlspecialchars(trim($nama));
$email = htmlspecialchars(trim($email));
$pesan = htmlspecialchars(trim($pesan));

$newMessage = [
    'nama'  => $nama,
    'email' => $email,
    'pesan' => $pesan,
    'waktu' => date('Y-m-d H:i:s'),
];

// Baca file JSON
$messages = [];
if (file_exists(MESSAGES_FILE)) {
    $json = file_get_contents(MESSAGES_FILE);
    $messages = json_decode($json, true) ?: [];
}
$messages[] = $newMessage;

// Buat folder jika belum ada
if (!is_dir(dirname(MESSAGES_FILE))) {
    mkdir(dirname(MESSAGES_FILE), 0755, true);
}

file_put_contents(MESSAGES_FILE, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header('Location: kontak.php?status=success');
exit;