<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register FarmTrack</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/daftar.css">
</head>
<body>

    <div class="register-box">

        <!-- Kolom Kiri: Form -->
        <div class="col-form">
            <div class="register-title">Register Akun FarmTrack</div>
            <div class="subtitle">Track Your Farm, Grow Your Future.</div>

            <!-- Notifikasi -->
            <div id="notif"></div>

            <form action="insert_daftar.php" method="POST">

                <div class="mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap :" required>
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email :" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password :" required>
                </div>

                <div class="mb-4">
                    <input type="password" name="konfirmasi" class="form-control" placeholder="Konfirmasi Password :" required>
                </div>

                <button type="submit" class="btn-register">Daftar Sekarang</button>

            </form>

            <p style="text-align:center; margin-top:14px; font-size:13px; color:rgba(255,255,255,0.65);">
                Sudah punya akun?
                <a href="../auth/login.php" style="color:#43a047; font-weight:700; text-decoration:none;">
                    Login di sini
                </a>
            </p>
        </div>

        <!-- Kolom Kanan: Gambar -->
        <div class="col-img">
            <img class="farm-img" src="../image/bgregister.jpg" alt="Ilustrasi Pertanian">
        </div>

    </div>
</body>
</html>