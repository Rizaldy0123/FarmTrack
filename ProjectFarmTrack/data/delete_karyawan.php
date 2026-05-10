<?php
include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM tb_karyawan WHERE id_karyawan='$id'");

header("Location: datakaryawan.php");
?>