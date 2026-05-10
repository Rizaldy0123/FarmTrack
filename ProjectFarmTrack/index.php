<?php
require_once "koneksi.php";

$stmt = $conn->prepare("SELECT id_kandang, nama_kandang FROM tb_kandang");
$stmt->execute();

// ✅ gunakan fetchAll untuk mengambil semua data
$tb_kandang = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<b>Menampilkan array hasil query</b>";
echo "<pre>";
print_r($tb_kandang);
echo "</pre>";

echo "<b>Menampilkan dalam tabel</b>";
echo "<table border='1'>";

foreach ($tb_kandang as $row) {
    echo "<tr>
            <td>{$row['id_kandang']}</td>
            <td>{$row['nama_kandang']}</td>
            <td>
                <a href='delete.php?id={$row['id_kandang']}'>Hapus</a>
                <a href='edit.php?id={$row['id_kandang']}'>Perbaharui</a>
            </td>
          </tr>";
}

echo "</table>";

$conn = null;
?>