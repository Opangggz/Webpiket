<?php
include 'koneksi.php';

// Periksa apakah ID disediakan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus rekaman
    $delete_query = "DELETE FROM siswa_izinkeluar WHERE id='$id'";

    if (mysqli_query($conn, $delete_query)) {
        header('Location: siswakeluar.php');
        exit();
    } else {
        echo "Error saat menghapus data: " . mysqli_error($conn);
    }
} else {
    header('Location: siswakeluar.php');
    exit();
}
?>
