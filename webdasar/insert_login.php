<?php
session_start();

// Koneksi database (sesuaikan dengan konfigurasi Anda)
$host = 'localhost';
$db   = 'farmtrack';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$email    = trim($_POST['email']   ?? '');
$password = trim($_POST['password'] ?? '');

// Validasi kosong
if (empty($email) || empty($password)) {
    header("Location: login.html?status=kosong");
    exit;
}

// Validasi format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: login.html?status=email_invalid");
    exit;
}

// Cari user di database
$stmt = $conn->prepare("SELECT id, nama, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Email tidak ditemukan
    header("Location: login.html?status=email_tidak_ada");
    exit;
}

$user = $result->fetch_assoc();

// Verifikasi password (pakai password_hash saat registrasi)
if (!password_verify($password, $user['password'])) {
    header("Location: login.html?status=password_salah");
    exit;
}

// Login berhasil — simpan session
$_SESSION['user_id']   = $user['id'];
$_SESSION['user_nama'] = $user['nama'];
$_SESSION['user_email'] = $email;
$_SESSION['login']     = true;

// Redirect ke dashboard
header("Location: ../dashboard/dashboard.php");
exit;
?>