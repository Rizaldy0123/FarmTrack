<?php
session_start();
include '../koneksi.php';

// Ambil input dari form
$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Validasi input kosong
if (empty($email) || empty($password)) {
    header("Location: ../auth/login.html?error=kosong");
    exit;
}

// Query cari user berdasarkan email
$email_safe = mysqli_real_escape_string($conn, $email);
$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email_safe'");
$user  = mysqli_fetch_assoc($query);

// Cek user dan verifikasi password
if ($user && password_verify($password, $user['password'])) {
    // Login berhasil - simpan session
    $_SESSION['login']      = true;
    $_SESSION['user_id']    = $user['id'];
    $_SESSION['user_nama']  = $user['nama_lengkap'];
    $_SESSION['user_email'] = $user['email'];

    header("Location: ../menu/dashboard.php");
    exit;

} else {
    // Login gagal - redirect balik ke login dengan pesan error
    header("Location: ../auth/login.php?error=gagal");
    exit;
}
?>