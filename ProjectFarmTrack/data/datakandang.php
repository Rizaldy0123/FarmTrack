<?php
$stmt = $conn -> prepare("SELECT * FROM tb_kandang");
$stmt -> execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

$kandang = $stmt->fetchAll();

print_r($kandang);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kandang - FarmTrack</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/datakandang.css">
</head>

<body>

<div class="container">

    <!-- ── SIDEBAR ── -->
    <aside class="sidebar">

        <div class="logo">
            <img src="../image/logofarmtrack.png" alt="logo">
            <span>FarmTrack</span>
        </div>

        <ul>
            <li>📊 Dashboard</li>
            <li class="active">🏠 Kandang</li>
            <li>🥚 Produksi</li>
            <li>👷 Karyawan</li>
            <li>🌾 Pakan</li>
            <li>⚙️ Pengaturan</li>
        </ul>

        <div class="sidebar-footer"></div>

    </aside>


    <!-- ── MAIN CONTENT ── -->
    <main class="main">
        <!-- STAT CARDS + PROFILE ICON -->
        <div class="topbar">

            <div class="cards">
                <div class="card">
                    <div class="card-icon">🏠</div>
                    <div class="card-info">
                        <h4>Total Kandang</h4>
                        <p>10</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">🐔</div>
                    <div class="card-info">
                        <h4>Total Ayam</h4>
                        <p>5,275</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">🥚</div>
                    <div class="card-info">
                        <h4>Produksi Hari Ini</h4>
                        <p>2,759</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">👷</div>
                    <div class="card-info">
                        <h4>Karyawan Aktif</h4>
                        <p>8</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- SEARCH + FILTER + TAMBAH -->
        <div class="top-controls">
            <div class="search-box">
                <span class="search-icon">🔍</span>
                <input type="text" placeholder="Search">
            </div>
            <button class="filter-btn">UMUR AYAM</button>
            <button class="filter-btn">JUMLAH AYAM</button>
            <a href="../kandang/tambah_kandang.php" class="add-btn">+ TAMBAH KANDANG</a>
        </div>


        <!-- TABLE -->
        <div class="table-box">

            <h2>KANDANG AYAM</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID_Kandang</th>
                        <th>Nama_Kandang</th>
                        <th>Status</th>
                        <th>Jumlah Ayam</th>
                        <th>ID_Karyawan</th>
                        <th>Umur_Ayam</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>KD01</td>
                        <td>4P</td>
                        <td><span class="aktif">Aktif</span></td>
                        <td>500</td>
                        <td>K01</td>
                        <td>97</td>
                    </tr>
                    <tr>
                        <td>KD02</td>
                        <td>7</td>
                        <td><span class="panen">Panen</span></td>
                        <td>876</td>
                        <td>K02</td>
                        <td>97</td>
                    </tr>
                    <tr>
                        <td>KD03</td>
                        <td>14</td>
                        <td><span class="kosong">Kosong</span></td>
                        <td>323</td>
                        <td>K03</td>
                        <td>95</td>
                    </tr>
                    <tr>
                        <td>KD04</td>
                        <td>2P</td>
                        <td><span class="aktif">Aktif</span></td>
                        <td>625</td>
                        <td>K04</td>
                        <td>92</td>
                    </tr>
                    <tr>
                        <td>KD05</td>
                        <td>6</td>
                        <td><span class="aktif">Aktif</span></td>
                        <td>763</td>
                        <td>K05</td>
                        <td>92</td>
                    </tr>
                    <tr>
                        <td>KD06</td>
                        <td>16</td>
                        <td><span class="panen">Panen</span></td>
                        <td>650</td>
                        <td>K06</td>
                        <td>92</td>
                    </tr>
                    <tr>
                        <td>KD07</td>
                        <td>4</td>
                        <td><span class="kosong">Kosong</span></td>
                        <td>753</td>
                        <td>K07</td>
                        <td>80</td>
                    </tr>
                    <tr>
                        <td>KD08</td>
                        <td>8A</td>
                        <td><span class="panen">Panen</span></td>
                        <td>403</td>
                        <td>K08</td>
                        <td>80</td>
                    </tr>
                    <tr>
                        <td>KD09</td>
                        <td>17</td>
                        <td><span class="aktif">Aktif</span></td>
                        <td>578</td>
                        <td>K09</td>
                        <td>80</td>
                    </tr>
                    <tr>
                        <td>KD10</td>
                        <td>5P</td>
                        <td><span class="aktif">Aktif</span></td>
                        <td>567</td>
                        <td>K10</td>
                        <td>70</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </main>

</div>

</body>
</html>