<?php
require_once "../koneksi_php/koneksi.php";

$id     = $_POST['id_karyawan'];
$nama   = $_POST['nama_karyawan'];
$jabatan= $_POST['jabatan'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE tb_karyawan 
SET nama_karyawan=:nama, jabatan=:jabatan, status=:status
WHERE id_karyawan=:id");

$stmt->bindParam(':nama', $nama);
$stmt->bindParam(':jabatan', $jabatan);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':id', $id);

$stmt->execute();

header("Location: datakaryawan.php");
?>