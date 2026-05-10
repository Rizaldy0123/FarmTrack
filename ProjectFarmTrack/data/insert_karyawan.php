<?php
include '../koneksi.php';

$id     = $_POST['id_karyawan'];
$nama   = $_POST['nama_karyawan'];
$jabatan= $_POST['jabatan'];
$status = $_POST['status'];

mysqli_query($conn, "INSERT INTO tb_karyawan VALUES ('$id','$nama','$jabatan','$status')");

header("Location: datakaryawan.php");
?>