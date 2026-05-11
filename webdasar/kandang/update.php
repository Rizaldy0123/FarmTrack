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

$page = $_GET['page'] ?? 'kandang';
$id   = $_GET['id'] ?? '';

// Pemetaan Primary Key
$map_pk = [
    'kandang'  => 'id_kandang',
    'karyawan' => 'id_karyawan',
    'pakan'    => 'id_pakan',
    'produksi' => 'id_produksi'
];

$pk_field = $map_pk[$page];

// =============================
// AMBIL DATA LAMA
// =============================
$table_db = "tb_" . $page;
$stmt = $conn->prepare("SELECT * FROM $table_db WHERE $pk_field = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    header("Location: index.php?page=$page");
    exit;
}

// =============================
// PROSES UPDATE
// =============================
if (isset($_POST['update'])) {
    try {
        if ($page == 'kandang') {
            $sql = "UPDATE tb_kandang SET nama_kandang=?, status=?, jumlah_ayam=?, id_karyawan=?, umur_ayam=? WHERE id_kandang=?";
            $conn->prepare($sql)->execute([$_POST['nama_kandang'], $_POST['status'], $_POST['jumlah_ayam'], $_POST['id_karyawan'], $_POST['umur_ayam'], $id]);
        } 
        elseif ($page == 'karyawan') {
            $sql = "UPDATE tb_karyawan SET nama_karyawan=?, jabatan=?, status=? WHERE id_karyawan=?";
            $conn->prepare($sql)->execute([$_POST['nama_karyawan'], $_POST['jabatan'], $_POST['status'], $id]);
        } 
        elseif ($page == 'pakan') {
            $sql = "UPDATE tb_pakan SET nama_pakan=?, stok=?, id_kandang=? WHERE id_pakan=?";
            $conn->prepare($sql)->execute([$_POST['nama_pakan'], $_POST['stok'], $_POST['id_kandang'], $id]);
        }
        elseif ($page == 'produksi') {
            $sql = "UPDATE tb_produksi SET tanggal=?, id_kandang=?, id_karyawan=?, jumlah_ayam=? WHERE id_produksi=?";
            $conn->prepare($sql)->execute([$_POST['tanggal'], $_POST['id_kandang'], $_POST['id_karyawan'], $_POST['jumlah_ayam'], $id]);
        }
        header("Location: index.php?page=$page");
        exit;
    } catch (PDOException $e) {
        echo "<script>alert('Gagal Update: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>FarmTrack - Edit <?= ucfirst($page) ?></title>
    <link rel="stylesheet" href="../css/php.css">
    <style>
        .edit-container { background:#fff; margin:50px auto; padding:30px; width:500px; border-radius:15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .edit-container h3 { margin-bottom: 20px; color: #2c3e50; }
        .edit-container input, .edit-container select { width:100%; padding:12px; margin:10px 0; border:1px solid #ddd; border-radius:8px; box-sizing: border-box; }
        .btn-update { background:#3498db; color:white; border:none; padding:12px; border-radius:8px; cursor:pointer; width:100%; font-weight:bold; margin-top: 10px; }
        .btn-cancel { display:block; text-align:center; margin-top:15px; color:#95a5a6; text-decoration:none; font-size:14px; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><img src="../image/logo.jpg" alt="Logo"><span>FarmTrack</span></div>
        <ul class="menu">
            <li><a href="index.php?page=dashboard">Dashboard</a></li>
            <li class="<?= $page == 'kandang' ? 'active' : '' ?>"><a href="index.php?page=kandang">Kandang</a></li>
            <li class="<?= $page == 'produksi' ? 'active' : '' ?>"><a href="index.php?page=produksi">Produksi</a></li>
            <li class="<?= $page == 'karyawan' ? 'active' : '' ?>"><a href="index.php?page=karyawan">Karyawan</a></li>
            <li class="<?= $page == 'pakan' ? 'active' : '' ?>"><a href="index.php?page=pakan">Pakan</a></li>
        </ul>
    </aside>

    <main class="main">
        <div class="edit-container">
            <h3>Edit Data <?= ucfirst($page) ?></h3>
            <form action="" method="POST">
                <label style="font-size: 12px; color: #7f8c8d;">ID (Permanen)</label>
                <input type="text" value="<?= $id ?>" disabled style="background:#f4f4f4;">

                <?php if($page=='kandang'): ?>
                    <input type="text" name="nama_kandang" value="<?= $data['nama_kandang'] ?>" placeholder="Nama Kandang" required>
                    <select name="status">
                        <option value="Aktif" <?= $data['status']=='Aktif'?'selected':'' ?>>Aktif</option>
                        <option value="Panen" <?= $data['status']=='Panen'?'selected':'' ?>>Panen</option>
                    </select>
                    <input type="number" name="jumlah_ayam" value="<?= $data['jumlah_ayam'] ?>" placeholder="Jumlah Ayam">
                    <input type="text" name="id_karyawan" value="<?= $data['id_karyawan'] ?>" placeholder="ID Karyawan">
                    <input type="number" name="umur_ayam" value="<?= $data['umur_ayam'] ?>" placeholder="Umur (Hari)">

                <?php elseif($page=='karyawan'): ?>
                    <input type="text" name="nama_karyawan" value="<?= $data['nama_karyawan'] ?>" placeholder="Nama" required>
                    <input type="text" name="jabatan" value="<?= $data['jabatan'] ?>" placeholder="Jabatan">
                    <select name="status">
                        <option value="Aktif" <?= $data['status']=='Aktif'?'selected':'' ?>>Aktif</option>
                        <option value="Cuti" <?= $data['status']=='Cuti'?'selected':'' ?>>Cuti</option>
                    </select>

                <?php elseif($page=='pakan'): ?>
                    <input type="text" name="nama_pakan" value="<?= $data['nama_pakan'] ?>" placeholder="Nama Pakan" required>
                    <input type="number" name="stok" value="<?= $data['stok'] ?>" placeholder="Stok (Ton)" required>
                    <input type="text" name="id_kandang" value="<?= $data['id_kandang'] ?>" placeholder="ID Kandang">

                <?php elseif($page=='produksi'): ?>
                    <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required>
                    <input type="text" name="id_kandang" value="<?= $data['id_kandang'] ?>" placeholder="ID Kandang" required>
                    <input type="text" name="id_karyawan" value="<?= $data['id_karyawan'] ?>" placeholder="ID Karyawan" required>
                    <input type="number" name="jumlah_ayam" value="<?= $data['jumlah_ayam'] ?>" placeholder="Jumlah Ayam" required>
                <?php endif; ?>

                <button type="submit" name="update" class="btn-update">Update Data</button>
                <a href="index.php?page=<?= $page ?>" class="btn-cancel">Batal dan Kembali</a>
            </form>
        </div>
    </main>

</body>
</html>