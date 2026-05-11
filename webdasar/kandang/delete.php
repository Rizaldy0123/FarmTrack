<?php
$conn = new PDO("mysql:host=localhost;dbname=db_peternakan", "root", "");

// ambil parameter
$table = $_GET['table'] ?? null;
$id    = $_GET['id'] ?? null;

if (!$table || !$id) {
    die("Parameter tidak lengkap");
}

// mapping tabel
$allowed = [
    'tb_kandang'  => 'id_kandang',
    'tb_karyawan' => 'id_karyawan',
    'tb_pakan'    => 'id_pakan',
    'tb_produksi' => 'id_produksi'
];

if (!array_key_exists($table, $allowed)) {
    die("Tabel tidak valid");
}

$pk = $allowed[$table];

// delete
$stmt = $conn->prepare("DELETE FROM $table WHERE $pk = ?");
$stmt->execute([$id]);

// kembali
header("Location: index.php?page=" . str_replace('tb_', '', $table));
exit;
?>