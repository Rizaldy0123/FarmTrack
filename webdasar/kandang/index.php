<?php
// 1. KONEKSI DATABASE
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

$page = $_GET['page'] ?? 'dashboard';

/**
 * FUNGSI GENERATE ID OTOMATIS
 * Menghasilkan ID seperti K01, KD01, P01, PR01
 */
function generateID($conn, $table, $prefix, $pk) {
    $stmt = $conn->query("SELECT $pk FROM $table ORDER BY $pk DESC LIMIT 1");
    $lastId = $stmt->fetchColumn();
    
    if (!$lastId) {
        return $prefix . "01";
    } else {
        // Mengambil angka dari ID terakhir dan menambahkannya 1
        $num = (int)substr($lastId, strlen($prefix));
        $num++;
        return $prefix . str_pad($num, 2, "0", STR_PAD_LEFT);
    }
}

// 2. LOGIKA HAPUS DATA
if (isset($_GET['hapus'])) {
    $table = $_GET['table'] ?? '';
    $id    = $_GET['id'] ?? '';
    $map_pk = [
        'tb_kandang' => 'id_kandang', 
        'tb_karyawan' => 'id_karyawan', 
        'tb_pakan' => 'id_pakan', 
        'tb_produksi' => 'id_produksi'
    ];
    
    if (isset($map_pk[$table])) {
        $pk = $map_pk[$table];
        $conn->prepare("DELETE FROM $table WHERE $pk = ?")->execute([$id]);
    }
    header("Location: index.php?page=$page");
    exit;
}

// 3. LOGIKA TAMBAH DATA (CREATE)
if (isset($_POST['btn_simpan'])) {
    try {
        if ($page == 'karyawan') {
            // SOLUSI: Generate ID K01, K02 secara otomatis
            $newID = generateID($conn, 'tb_karyawan', 'K', 'id_karyawan');
            $sql = "INSERT INTO tb_karyawan (id_karyawan, nama_karyawan, jabatan, status) VALUES (?, ?, ?, ?)";
            $conn->prepare($sql)->execute([$newID, $_POST['nama'], $_POST['jabatan'], $_POST['status']]);
        } 
        elseif ($page == 'kandang') {
            $newID = generateID($conn, 'tb_kandang', 'KD', 'id_kandang');
            $sql = "INSERT INTO tb_kandang (id_kandang, nama_kandang, status, jumlah_ayam, id_karyawan, umur_ayam) VALUES (?, ?, ?, ?, ?, ?)";
            $conn->prepare($sql)->execute([$newID, $_POST['nama'], $_POST['status'], $_POST['jumlah'], $_POST['karyawan'], $_POST['umur']]);
        } 
        elseif ($page == 'pakan') {
            $newID = generateID($conn, 'tb_pakan', 'P', 'id_pakan');
            $sql = "INSERT INTO tb_pakan (id_pakan, nama_pakan, stok, id_kandang) VALUES (?, ?, ?, ?)";
            $conn->prepare($sql)->execute([$newID, $_POST['nama'], $_POST['stok'], $_POST['kandang']]);
        } 
        elseif ($page == 'produksi') {
            $newID = generateID($conn, 'tb_produksi', 'PR', 'id_produksi');
            $sql = "INSERT INTO tb_produksi (id_produksi, tanggal, id_kandang, id_karyawan, jumlah_ayam) VALUES (?, ?, ?, ?, ?)";
            $conn->prepare($sql)->execute([$newID, $_POST['tanggal'], $_POST['kandang'], $_POST['karyawan'], $_POST['jumlah']]);
        }
        
        header("Location: index.php?page=$page&msg=success");
        exit;
    } catch (PDOException $e) {
        // Munculkan alert jika ada error database
        echo "<script>alert('Gagal Simpan: " . addslashes($e->getMessage()) . "'); window.location.href='?page=$page';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>FarmTrack - <?= strtoupper($page) ?></title>
    <link rel="stylesheet" href="../css/php.css">
    <style>
        .status-badge { padding: 5px 12px; border-radius: 15px; color: white; font-size: 11px; font-weight: bold; display: inline-block; text-transform: capitalize; }
        .aktif { background: #2ecc71; } .panen { background: #f39c12; } .kosong, .cuti { background: #e74c3c; }
        .action-icons a { text-decoration: none; margin-right: 8px; font-size: 18px; }
        .welcome-msg { padding: 20px; background: #fff; border-radius: 10px; margin-top: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        
        /* Modal Style */
        .modal { display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.7); }
        .modal-content { background:#fff; margin:5% auto; padding:30px; width:450px; border-radius:15px; box-shadow: 0 5px 25px rgba(0,0,0,0.2); }
        .modal-content h3 { margin-top:0; margin-bottom:20px; color:#333; }
        .modal-content input, .modal-content select { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .btn-group { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; }
        .btn-cancel { background: #bdc3c7; color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; }
        .btn-save { background: #3498db; color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><img src="../image/logo.jpg" alt="Logo"><span>FarmTrack</span></div>
        <ul class="menu">
            <li class="<?= $page == 'dashboard' ? 'active' : '' ?>"><a href="?page=dashboard">Dashboard</a></li>
            <li class="<?= $page == 'kandang' ? 'active' : '' ?>"><a href="?page=kandang">Kandang</a></li>
            <li class="<?= $page == 'produksi' ? 'active' : '' ?>"><a href="?page=produksi">Produksi</a></li>
            <li class="<?= $page == 'karyawan' ? 'active' : '' ?>"><a href="?page=karyawan">Karyawan</a></li>
            <li class="<?= $page == 'pakan' ? 'active' : '' ?>"><a href="?page=pakan">Pakan</a></li>
        </ul>
    </aside>

    <main class="main">
        <h2 class="title">DATA <?= strtoupper($page) ?></h2>
        
        <div class="stats-container">
            <div class="card"><h4>Total Kandang</h4><p>10</p></div>
            <div class="card"><h4>Total Ayam</h4><p>5,275</p></div>
            <div class="card"><h4>Produksi</h4><p>2,759</p></div>
            <div class="card"><h4>Karyawan</h4><p>8</p></div>
        </div>

        <?php if ($page == 'dashboard'): ?>
            <div class="welcome-msg">
                <h3>Selamat Datang di FarmTrack Dashboard</h3>
                <p>Gunakan menu di samping untuk mengelola data peternakan Anda secara efisien.</p>
            </div>
        <?php else: ?>
            <div class="controls">
                <div class="search-box">🔍 <input type="text" placeholder="Search..."></div>
                <button class="btn-add" onclick="document.getElementById('modalTambah').style.display='block'">+ Tambah <?= ucfirst($page) ?></button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <?php if($page=='kandang'): ?>
                                <th>ID</th><th>Nama</th><th>Status</th><th>Ayam</th><th>Karyawan</th><th>Umur</th>
                            <?php elseif($page=='karyawan'): ?>
                                <th>ID</th><th>Nama</th><th>Jabatan</th><th>Status</th>
                            <?php elseif($page=='pakan'): ?>
                                <th>ID</th><th>Nama</th><th>Stok</th><th>Kandang</th>
                            <?php elseif($page=='produksi'): ?>
                                <th>ID</th><th>Tanggal</th><th>Kandang</th><th>Karyawan</th><th>Jumlah</th>
                            <?php endif; ?>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $table_db = "tb_" . $page;
                        try {
                            $stmt = $conn->query("SELECT * FROM $table_db");
                            while ($d = $stmt->fetch(PDO::FETCH_ASSOC)):
                                $id_val = array_values($d)[0]; 
                        ?>
                        <tr>
                            <?php if($page=='kandang'): ?>
                                <td><?= $d['id_kandang'] ?></td><td><?= $d['nama_kandang'] ?></td>
                                <td><span class="status-badge <?= strtolower($d['status']) ?>"><?= $d['status'] ?></span></td>
                                <td><?= number_format($d['jumlah_ayam']) ?></td><td><?= $d['id_karyawan'] ?></td><td><?= $d['umur_ayam'] ?></td>
                            <?php elseif($page=='karyawan'): ?>
                                <td><?= $d['id_karyawan'] ?></td><td><?= $d['nama_karyawan'] ?></td><td><?= $d['jabatan'] ?></td>
                                <td><span class="status-badge <?= strtolower($d['status']) ?>"><?= $d['status'] ?></span></td>
                            <?php elseif($page=='pakan'): ?>
                                <td><?= $d['id_pakan'] ?></td><td><?= $d['nama_pakan'] ?></td><td><?= $d['stok'] ?> Kg</td><td><?= $d['id_kandang'] ?></td>
                            <?php elseif($page=='produksi'): ?>
                                <td><?= $d['id_produksi'] ?></td><td><?= $d['tanggal'] ?></td><td><?= $d['id_kandang'] ?></td><td><?= $d['id_karyawan'] ?></td><td><?= $d['jumlah_ayam'] ?></td>
                            <?php endif; ?>
                            <td class="action-icons">
                                <a href="update.php?page=<?= $page ?>&id=<?= $id_val ?>">✏️</a>
                                <a href="?hapus=1&table=tb_<?= $page ?>&id=<?= $id_val ?>&page=<?= $page ?>" onclick="return confirm('Hapus data?')">🗑️</a>
                            </td>
                        </tr>
                        <?php endwhile; } catch(Exception $e) { echo "<tr><td colspan='7'>Data kosong atau tabel belum siap.</td></tr>"; } ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>

    <div id="modalTambah" class="modal">
        <div class="modal-content">
            <h3>Tambah <?= ucfirst($page) ?></h3>
            <form method="POST">
                <?php if($page == 'karyawan'): ?>
                    <input type="text" name="nama" placeholder="Nama Lengkap" required>
                    <input type="text" name="jabatan" placeholder="Jabatan" required>
                    <select name="status">
                        <option value="Aktif">Aktif</option>
                        <option value="Cuti">Cuti</option>
                    </select>

                <?php elseif($page == 'kandang'): ?>
                    <input type="text" name="nama" placeholder="Nama Kandang" required>
                    <select name="status">
                        <option value="Aktif">Aktif</option>
                        <option value="Kosong">Kosong</option>
                    </select>
                    <input type="number" name="jumlah" placeholder="Jumlah Ayam" required>
                    <input type="text" name="karyawan" placeholder="ID Karyawan Penanggung Jawab" required>
                    <input type="text" name="umur" placeholder="Umur Ayam (Contoh: 4 Minggu)" required>

                <?php elseif($page == 'pakan'): ?>
                    <input type="text" name="nama" placeholder="Nama Merk Pakan" required>
                    <input type="number" name="stok" placeholder="Jumlah Stok (Kg)" required>
                    <input type="text" name="kandang" placeholder="Untuk ID Kandang" required>

                <?php elseif($page == 'produksi'): ?>
                    <input type="date" name="tanggal" required>
                    <input type="text" name="kandang" placeholder="ID Kandang" required>
                    <input type="text" name="karyawan" placeholder="ID Karyawan" required>
                    <input type="number" name="jumlah" placeholder="Jumlah Hasil Produksi" required>
                <?php endif; ?>

                <div class="btn-group">
                    <button type="button" class="btn-cancel" onclick="document.getElementById('modalTambah').style.display='none'">Batal</button>
                    <button type="submit" name="btn_simpan" class="btn-save">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Tutup modal jika klik di luar box putih
        window.onclick = function(event) {
            var modal = document.getElementById('modalTambah');
            if (event.target == modal) { modal.style.display = "none"; }
        }
    </script>
</body>
</html>