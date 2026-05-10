<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: ../auth/insert_login.php");
    exit;
}
 
include '../koneksi.php';
 
// ── STAT CARDS ──────────────────────────────────────────────
 
// Total kandang
$r = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_kandang");
$total_kandang = mysqli_fetch_assoc($r)['total'];
 
// Total ayam
$r = mysqli_query($conn, "SELECT SUM(jumlah_ayam) as total FROM tb_kandang");
$total_ayam = mysqli_fetch_assoc($r)['total'] ?? 0;
 
// Produksi hari ini (jumlah_ayam dari tb_produksi hari ini)
$r = mysqli_query($conn, "SELECT SUM(jumlah_ayam) as total FROM tb_produksi WHERE tanggal = CURDATE()");
$produksi_hari_ini = mysqli_fetch_assoc($r)['total'] ?? 0;
 
// Karyawan aktif
$r = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_karyawan WHERE status = 'Aktif'");
$karyawan_aktif = mysqli_fetch_assoc($r)['total'];
 
// ── GRAFIK PRODUKSI MINGGUAN ─────────────────────────────────
// Ambil total produksi per hari dalam 7 hari terakhir
$grafik_query = mysqli_query($conn, "
    SELECT 
        DAYOFWEEK(tanggal) as hari_num,
        DATE_FORMAT(tanggal, '%a') as hari_nama,
        SUM(jumlah_ayam) as total
    FROM tb_produksi
    WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
    GROUP BY tanggal
    ORDER BY tanggal ASC
");
 
$hari_indonesia = ['Sun'=>'Ming','Mon'=>'Sen','Tue'=>'Sel','Wed'=>'Rab','Thu'=>'Kam','Fri'=>'Jum','Sat'=>'Sab'];
$grafik_data = [];
while ($g = mysqli_fetch_assoc($grafik_query)) {
    $nama = $hari_indonesia[$g['hari_nama']] ?? $g['hari_nama'];
    $grafik_data[] = ['hari' => $nama, 'total' => (int)$g['total']];
}
 
// Jika tidak ada data, tampilkan data dummy
if (empty($grafik_data)) {
    $grafik_data = [
        ['hari'=>'Sen','total'=>3200],
        ['hari'=>'Sel','total'=>3500],
        ['hari'=>'Rab','total'=>3900],
        ['hari'=>'Kam','total'=>4100],
        ['hari'=>'Jum','total'=>4000],
        ['hari'=>'Sab','total'=>4500],
        ['hari'=>'Ming','total'=>4200],
    ];
}
 
// Hitung max untuk skala bar
$max_val = max(array_column($grafik_data, 'total'));
$max_val = $max_val > 0 ? $max_val : 5000;
 
// ── DATA PRODUKSI TERBARU ────────────────────────────────────
$produksi_query = mysqli_query($conn, "
    SELECT tanggal, id_kandang, jumlah_ayam 
    FROM tb_produksi 
    ORDER BY tanggal DESC 
    LIMIT 6
");
 
// ── STATUS KANDANG ───────────────────────────────────────────
$kandang_query = mysqli_query($conn, "
    SELECT id_kandang, jumlah_ayam, status 
    FROM tb_kandang 
    ORDER BY id_kandang ASC
    LIMIT 7
");
 
// ── AKTIVITAS TERBARU (dari tb_produksi + tb_karyawan) ───────
$aktivitas_query = mysqli_query($conn, "
    SELECT 
        k.nama_karyawan,
        p.tanggal,
        p.id_kandang,
        'Produksi Telur' as aktivitas
    FROM tb_produksi p
    JOIN tb_karyawan k ON p.id_karyawan = k.id_karyawan
    ORDER BY p.tanggal DESC
    LIMIT 4
");
?>