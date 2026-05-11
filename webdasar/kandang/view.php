<?php
// =============================
// KONEKSI DATABASE
// =============================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_peternakan";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Ambil parameter dari URL
$page = $_GET['page'] ?? '';
$id   = $_GET['id'] ?? '';

// Pemetaan Primary Key sesuai tabel
$map_pk = [
    'kandang'  => 'id_kandang',
    'karyawan' => 'id_karyawan',
    'pakan'    => 'id_pakan',
    'produksi' => 'id_produksi'
];

$pk = $map_pk[$page] ?? '';
$data = null;

if ($pk && $id) {
    try {
        $stmt = $conn->prepare("SELECT * FROM tb_$page WHERE $pk = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

if (!$data) {
    die("<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail <?= ucfirst($page) ?> - FarmTrack</title>
    <link rel="stylesheet" href="../css/php.css">
    <style>
        body { background: #f4f7f6; font-family: 'Segoe UI', Tahoma, sans-serif; display: flex; justify-content: center; padding: 50px; }
        .view-card { background: white; width: 100%; max-width: 600px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; }
        .view-header { background: #2d7a32; color: white; padding: 20px; display: flex; justify-content: space-between; align-items: center; }
        .view-body { padding: 30px; }
        .detail-row { display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #eee; }
        .detail-row:last-child { border-bottom: none; }
        .label { font-weight: bold; color: #777; text-transform: uppercase; font-size: 13px; }
        .value { color: #333; font-weight: 500; }
        .status-badge { padding: 4px 12px; border-radius: 15px; color: white; font-size: 12px; }
        .btn-back { display: block; text-align: center; background: #eee; color: #333; text-decoration: none; padding: 12px; margin: 20px; border-radius: 8px; font-weight: bold; transition: 0.3s; }
        .btn-back:hover { background: #ddd; }
    </style>
</head>
<body>

<div class="view-card">
    <div class="view-header">
        <h2 style="margin:0;">Detail <?= ucfirst($page) ?></h2>
        <span>ID: <?= htmlspecialchars($id) ?></span>
    </div>

    <div class="view-body">
        <?php foreach ($data as $key => $value): ?>
            <div class="detail-row">
                <div class="label"><?= str_replace('_', ' ', $key) ?></div>
                <div class="value">
                    <?php if ($key == 'status'): ?>
                        <span class="status-badge" style="background: <?= (strtolower($value)=='aktif' ? '#2ecc71' : '#e74c3c') ?>;">
                            <?= htmlspecialchars($value) ?>
                        </span>
                    <?php else: ?>
                        <?= htmlspecialchars($value ?? '-') ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="index.php?page=<?= $page ?>" class="btn-back">Kembali ke Halaman Utama</a>
</div>

</body>
</html>