<?php
// KONEKSI DATABASE
$conn = mysqli_connect("localhost", "root", "", "farmtrack");

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// SEARCH
$search = "";
if (isset($_POST['btnSearch'])) {
  $search = $_POST['search'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FarmTrack Dashboard</title>

  <style>
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: url("../image/bg figma.jpeg") center/cover;
      font-family: sans-serif;
    }

    .dashboard {
      width: 1100px;
      display: flex;
      background: rgba(0,0,0,0.5);
      border-radius: 15px;
      overflow: hidden;
    }

    .sidebar {
      width: 200px;
      background: white;
      padding: 20px;
    }

    .main {
      flex: 1;
      padding: 20px;
      color: white;
    }

    .cards {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }

    .card {
      flex: 1;
      background: white;
      color: black;
      padding: 10px;
      border-radius: 10px;
      text-align: center;
    }

    .search-box {
      display: flex;
      gap: 5px;
      margin-bottom: 15px;
    }

    .search-box input {
      flex: 1;
      padding: 8px;
      border-radius: 8px;
      border: none;
    }

    .search-box button {
      padding: 8px 12px;
      border: none;
      background: green;
      color: white;
      border-radius: 8px;
    }

    table {
      width: 100%;
      background: white;
      color: black;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      border: 1px solid #ddd;
    }
  </style>
</head>

<body>

<div class="dashboard">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <h2>FarmTrack</h2>
    <ul>
      <li>Dashboard</li>
      <li>Kandang</li>
      <li>Produksi</li>
    </ul>
  </aside>

  <!-- MAIN -->
  <main class="main">

    <h1>DASHBOARD</h1>

    <!-- CARD -->
    <div class="cards">
      <div class="card">
        <h4>Total Kandang</h4>
        <p>10</p>
      </div>
      <div class="card">
        <h4>Total Ayam</h4>
        <p>5275</p>
      </div>
    </div>

    <!-- SEARCH -->
    <form method="POST" class="search-box">
      <input type="text" name="search" placeholder="Cari data..." value="<?= $search ?>">
      <button type="submit" name="btnSearch">Cari</button>
    </form>

    <a href="dashboard.php" style="color:white;">Reset</a>

    <!-- TABLE PRODUKSI -->
    <?php
    if ($search != "") {
      $query = mysqli_query($conn,
        "SELECT * FROM produksi 
         WHERE id_kandang LIKE '%$search%' 
         OR tanggal LIKE '%$search%'"
      );
    } else {
      $query = mysqli_query($conn, "SELECT * FROM produksi");
    }
    ?>

    <table>
      <tr>
        <th>Tanggal</th>
        <th>ID Kandang</th>
        <th>Jumlah Telur</th>
      </tr>

      <?php while ($row = mysqli_fetch_assoc($query)) { ?>
      <tr>
        <td><?= $row['tanggal'] ?></td>
        <td><?= $row['id_kandang'] ?></td>
        <td><?= $row['jumlah_telur'] ?></td>
      </tr>
      <?php } ?>

    </table>

  </main>

</div>

</body>
</html>