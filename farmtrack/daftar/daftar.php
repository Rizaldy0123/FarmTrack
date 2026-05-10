<?php
session_start();

// koneksi database
$conn = mysqli_connect("localhost", "root", "", "farmtrack");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// proses login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);

    if ($user && $user['password'] == $password) {
        $_SESSION['user'] = $user['email'];
        header("Location: DASHBOARD.html");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
