
<?php
if (isset($_POST['search'])) {
    echo "Kamu cari: " . $_POST['search'];
} else {
    echo "Belum ada input";
}
?>