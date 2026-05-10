<?php
include '../koneksi.php';
$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE id_karyawan='$id'");
$d = mysqli_fetch_array($data);
?>

<form action="update_karyawan.php" method="POST">
    <input type="hidden" name="id_karyawan" value="<?= $d['id_karyawan']; ?>">

    <input type="text" name="nama_karyawan" value="<?= $d['nama_karyawan']; ?>"><br>

    <select name="jabatan">
        <option <?= $d['jabatan']=="Produksi"?"selected":"" ?>>Produksi</option>
        <option <?= $d['jabatan']=="Kebersihan"?"selected":"" ?>>Kebersihan</option>
    </select><br>

    <select name="status">
        <option <?= $d['status']=="Aktif"?"selected":"" ?>>Aktif</option>
        <option <?= $d['status']=="Panen"?"selected":"" ?>>Panen</option>
        <option <?= $d['status']=="Cuti"?"selected":"" ?>>Cuti</option>
    </select><br>

    <button type="submit">Update</button>
</form>