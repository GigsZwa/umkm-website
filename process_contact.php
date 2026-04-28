<?php
require_once 'config.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* =========================
   CEK METHOD
========================= */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: kontak.php');
    exit;
}

/* =========================
   AMBIL INPUT
========================= */
$nama  = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$pesan = trim($_POST['pesan'] ?? '');

/* =========================
   VALIDASI
========================= */
$errors = [];

if (strlen($nama) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email tidak valid.';
}

if (strlen($pesan) < 10) {
    $errors[] = 'Pesan minimal 10 karakter.';
}

if (!empty($errors)) {
    $msg = implode('|', $errors);
    header('Location: kontak.php?status=error&msg=' . urlencode($msg));
    exit;
}

/* =========================
   SANITASI
========================= */
$nama  = htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$pesan = htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8');

/* =========================
   SIMPAN KE JSON
========================= */
$newMessage = [
    'nama'  => $nama,
    'email' => $email,
    'pesan' => $pesan,
    'waktu' => date('Y-m-d H:i:s')
];

$data = [];

if (file_exists(MESSAGES_FILE)) {
    $json = file_get_contents(MESSAGES_FILE);
    $data = json_decode($json, true) ?: [];
}

$data[] = $newMessage;

if (!is_dir(dirname(MESSAGES_FILE))) {
    mkdir(dirname(MESSAGES_FILE), 0755, true);
}

file_put_contents(
    MESSAGES_FILE,
    json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

/* =========================
   KIRIM EMAIL PHPMailer
========================= */
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'inokreastudio@gmail.com';

    // GANTI DENGAN APP PASSWORD BARU
    $mail->Password   = 'teoraaqjkmlaqjus';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->CharSet = 'UTF-8';

    /* Pengirim */
    $mail->setFrom('inokreastudio@gmail.com', 'UMKM Website');

    /* Penerima */
    $mail->addAddress('inokreastudio@gmail.com');

    /* Balas ke email user */
    $mail->addReplyTo($email, $nama);

    /* Format Email */
    $mail->isHTML(true);

    $mail->Subject = 'Pesan Baru Dari Website';

    $mail->Body = "
        <h3>Pesan Baru Dari {$nama}</h3>
        <p><b>Nama:</b> {$nama}</p>
        <p><b>Email:</b> {$email}</p>
        <p><b>Waktu:</b> " . date('d-m-Y H:i:s') . "</p>
        <p><b>Pesan:</b><br>" . nl2br($pesan) . "</p>
    ";

    $mail->AltBody =
        "Pesan Baru Dari Website\n\n" .
        "Nama  : $nama\n" .
        "Email : $email\n" .
        "Waktu : " . date('d-m-Y H:i:s') . "\n\n" .
        "Pesan:\n$pesan";

    $mail->send();

    header('Location: kontak.php?status=success');
    exit;
} catch (Exception $e) {

    // TAMPILKAN ERROR ASLI SMTP
    echo $mail->ErrorInfo;
    exit;
}
