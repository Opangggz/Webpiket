<?php
include 'koneksi.php';

// Periksa apakah ID disediakan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus rekaman
    $delete_query = "DELETE FROM siswa_izinpulang WHERE id='$id'";

    if (mysqli_query($conn, $delete_query)) {
        header('Location: siswapulang.php');
        exit();
    } else {
        echo "Error saat menghapus data: " . mysqli_error($conn);
    }
} else {
    header('Location: siswapulang.php');
    exit();
}
?>
