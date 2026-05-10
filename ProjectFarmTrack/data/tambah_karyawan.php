<form action="insert_karyawan.php" method="POST">
    <input type="text" name="id_karyawan" placeholder="ID" required><br>
    <input type="text" name="nama_karyawan" placeholder="Nama" required><br>

    <select name="jabatan">
        <option>Produksi</option>
        <option>Kebersihan</option>
    </select><br>

    <select name="status">
        <option>Aktif</option>
        <option>Panen</option>
        <option>Cuti</option>
    </select><br>

    <button type="submit">Simpan</button>
</form>