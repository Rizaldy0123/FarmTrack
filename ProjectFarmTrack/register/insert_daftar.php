<?php
include '../koneksi.php';

$nama       = $_POST['nama'];
$email      = $_POST['email'];
$password   = $_POST['password'];
$konfirmasi = $_POST['konfirmasi'];

//  cek password sama atau tidak
if($password !== $konfirmasi){
    echo "Konfirmasi password tidak cocok!";
    exit;
}

//  cek email sudah ada atau belum
$cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if(mysqli_num_rows($cek) > 0){
    echo "Email sudah terdaftar!";
    exit;
}

//  hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

//  simpan ke database
$query = "INSERT INTO users (nama_lengkap, email, password) VALUES ('$nama', '$email', '$hash')";

if(mysqli_query($conn, $query)){
    echo "Registrasi berhasil! <a href='../auth/insert_login.php'>Login sekarang</a>";
} else {
    echo "Registrasi gagal!";
}
?>