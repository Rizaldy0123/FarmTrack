<?php
// =============================
// KONEKSI
// =============================
$conn = new PDO("mysql:host=localhost;dbname=db_peternakan", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// =============================
// AMBIL DATA
// =============================
$table = $_POST['table'] ?? null;

if (!$table) {
    die("Tabel tidak ditemukan");
}

// =============================
// INSERT SESUAI TABEL
// =============================
if ($table == 'tb_kandang') {

    $stmt = $conn->prepare("
        INSERT INTO tb_kandang (nama_kandang, jumlah_ayam)
        VALUES (?, ?)
    ");
    $stmt->execute([
        $_POST['nama_kandang'],
        $_POST['jumlah_ayam']
    ]);
}

elseif ($table == 'tb_karyawan') {

    $stmt = $conn->prepare("
        INSERT INTO tb_karyawan (nama_karyawan, jabatan)
        VALUES (?, ?)
    ");
    $stmt->execute([
        $_POST['nama_karyawan'],
        $_POST['jabatan']
    ]);
}

elseif ($table == 'tb_pakan') {

    $stmt = $conn->prepare("
        INSERT INTO tb_pakan (nama_pakan, stok, id_kandang)
        VALUES (?, ?, ?)
    ");
    $stmt->execute([
        $_POST['nama_pakan'],
        $_POST['stok'],
        $_POST['id_kandang']
    ]);
}

elseif ($table == 'tb_produksi') {

    $stmt = $conn->prepare("
        INSERT INTO tb_produksi (tanggal, jumlah_ayam)
        VALUES (?, ?)
    ");
    $stmt->execute([
        $_POST['tanggal'],
        $_POST['jumlah_ayam']
    ]);
}

// =============================
// REDIRECT
// =============================
header("Location: index.php?page=" . str_replace('tb_', '', $table));
exit;
?>