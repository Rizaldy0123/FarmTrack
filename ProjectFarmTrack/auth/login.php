<?php
session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: ../menu/dashboard.php");
    exit;
}

// Ambil pesan error dari URL
$error = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmTrack Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .error-msg {
            background: rgba(229, 57, 53, 0.15);
            border: 1px solid rgba(229, 57, 53, 0.4);
            color: #ff6b6b;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 14px;
            text-align: center;
        }
        .success-msg {
            background: rgba(52, 199, 89, 0.15);
            border: 1px solid rgba(52, 199, 89, 0.4);
            color: #34c759;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 14px;
            text-align: center;
        }
    </style>
</head>
<body class="backgroundutama">

    <div class="login-box">

        <img src="../image/logofarmtrack.png" alt="Logo" class="logo-img">
        <h4>FarmTrack</h4>


        <form action="../auth/insert_login.php" method="POST">

            <div class="mb-3">
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Email"
                    required
                    autocomplete="email">
            </div>

            <div class="mb-4">
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Password"
                    required
                    autocomplete="current-password">
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn-login">Login</button>
            </div>

        </form>

        <div class="d-flex justify-content-between">
            <a href="#" class="link">Lupa Password?</a>
            <a href="../register/daftar.html" class="link">Daftar Akun</a>
        </div>

    </div>

</body>
</html>