<?php
$mahasiswa = array(
    array("NIM" => "362558302074", "NAMA" => "Rizaldy"),
    array("NIM" => "362558302075", "NAMA" => "Resbob"),
    array("NIM" => "362558302076", "NAMA" => "Jannah"),
    array("NIM" => "362558302077", "NAMA" => "John"),
    array("NIM" => "362558302078", "NAMA" => "Erio")
);
?>

<!DOCTYPE html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>NO</th>
        <th>NIM</th>
        <th>NAMA</th>
    </tr>

    <?php
    $no = 1;
    foreach ($mahasiswa as $data) {
        echo "<tr>";
        echo "<td>$no</td>";
        echo "<td>".$data['NIM']."</td>";
        echo "<td>".$data['NAMA']."</td>";
        echo "</tr>";
        $no++;
    }
    ?>
</table>
</body>
</html>