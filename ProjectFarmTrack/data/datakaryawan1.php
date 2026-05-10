<?php include '../koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Data Karyawan</h2>
<a href="tambah_karyawan.php">+ Tambah Karyawan</a>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Jabatan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php
$data = mysqli_query($conn, "SELECT * FROM tb_karyawan");

while ($d = mysqli_fetch_array($data)) {
?>
<tr>
    <td><?= $d['id_karyawan']; ?></td>
    <td><?= $d['nama_karyawan']; ?></td>
    <td><?= $d['jabatan']; ?></td>
    <td><?= $d['status']; ?></td>
    <td>
        <a href="edit_karyawan.php?id=<?= $d['id_karyawan']; ?>">Edit</a>
        <a href="hapus_karyawan.php?id=<?= $d['id_karyawan']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>