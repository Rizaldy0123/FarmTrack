<?php
require '../koneksi_php/koneksi.php';

$stmt = $conn->prepare('SELECT * FROM tb_karyawan WHERE id_karyawan = :id');
$stmt->bindParam(':id', $id);

try {
    $id=$_GET('id');
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$result = $stmt->fetch(PDO::FETCH_ASSOC);
$data = 
[
    'id_karyawan' => $result['id_karyawan'],
    'nama_karyawan' => $result['nama_karyawan'],
    'jabatan' => $result['jabatan'],
    'status' => $result['status']
];