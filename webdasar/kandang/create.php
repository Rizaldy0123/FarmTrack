<?php
$page = $_GET['page'] ?? 'kandang';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
</head>
<body>

<h2>Tambah Data <?= strtoupper($page) ?></h2>

<a href="index.php?page=<?= $page ?>">⬅ Kembali</a>
<hr>

<?php
// ================= FORM KANDANG =================
if ($page == 'kandang') { ?>
<form method="POST" action="index.php">
    <input type="hidden" name="table" value="tb_kandang">

    Nama Kandang:<br>
    <input type="text" name="nama_kandang" required><br><br>

    Jumlah Ayam:<br>
    <input type="number" name="jumlah_ayam" required><br><br>

    <button type="submit">Simpan</button>
</form>
<?php }

// ================= FORM KARYAWAN =================
elseif ($page == 'karyawan') { ?>
<form method="POST" action="index.php">
    <input type="hidden" name="table" value="tb_karyawan">

    Nama Karyawan:<br>
    <input type="text" name="nama_karyawan" required><br><br>

    Jabatan:<br>
    <input type="text" name="jabatan" required><br><br>

    <button type="submit">Simpan</button>
</form>
<?php }

// ================= FORM PAKAN =================
elseif ($page == 'pakan') { ?>
<form method="POST" action="index.php">
    <input type="hidden" name="table" value="tb_pakan">

    Nama Pakan:<br>
    <input type="text" name="nama_pakan" required><br><br>

    Stok:<br>
    <input type="number" name="stok" required><br><br>

    ID Kandang:<br>
    <input type="number" name="id_kandang" required><br><br>

    <button type="submit">Simpan</button>
</form>
<?php }

// ================= FORM PRODUKSI =================
elseif ($page == 'produksi') { ?>
<form method="POST" action="index.php">
    <input type="hidden" name="table" value="tb_produksi">

    Tanggal:<br>
    <input type="date" name="tanggal" required><br><br>

    Jumlah Ayam:<br>
    <input type="number" name="jumlah_ayam" required><br><br>

    <button type="submit">Simpan</button>
</form>
<?php } ?>

</body>
</html>