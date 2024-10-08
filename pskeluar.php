<?php
include 'koneksi.php';

// Ambil data dari form
$nama_siswa = $_POST['nama_siswa'];
$jurusan = $_POST['jurusan'];
$kelas = $_POST['kelas'];
$tanggal_izin = $_POST['tanggal_izin'];
$status = $_POST['status'];
$tlp = $_POST['tlp'];
$alasan = $_POST['alasan'];
$namaguru = $_POST['user']; // Pastikan ini sesuai dengan nama input di form
$jabatan = $_POST['jabatan'];
$jk = $_POST['jk'];

// Query insert ke tabel siswa_izinkeluar
$sql1 = "INSERT INTO siswa_izinkeluar (nama_siswa, jurusan, kelas, tanggal_izin, status, tlp, alasan, jk, namaguru, jabatan)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare statement
$stmt1 = $conn->prepare($sql1);
if ($stmt1 === false) {
    die("Kesalahan saat menyiapkan pernyataan: " . $conn->error);
}

$stmt1->bind_param("ssssssssss", $nama_siswa, $jurusan, $kelas, $tanggal_izin, $status, $tlp, $alasan, $jk, $namaguru, $jabatan);

// Eksekusi query untuk siswa_izinkeluar
if ($stmt1->execute()) {
    // Insert ke tabel history
    $sql2 = "INSERT INTO history (nama_siswa, jurusan, kelas, tanggal_izin, status, tlp, alasan, jk)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Siapkan pernyataan untuk history
    $stmt2 = $conn->prepare($sql2);
    if ($stmt2 === false) {
        die("Kesalahan saat menyiapkan pernyataan untuk history: " . $conn->error);
    }

    $stmt2->bind_param("ssssssss", $nama_siswa, $jurusan, $kelas, $tanggal_izin, $status, $tlp, $alasan, $jk);

    if ($stmt2->execute()) {
        // Insert ke tabel penjaga_piket
        $sql3 = "INSERT INTO penjaga_piket (namaguru, jabatan)
        VALUES (?, ?)";

        // Siapkan pernyataan untuk penjaga_piket
        $stmt3 = $conn->prepare($sql3);
        if ($stmt3 === false) {
            die("Kesalahan saat menyiapkan pernyataan untuk penjaga_piket: " . $conn->error);
        }

        $stmt3->bind_param("ss", $namaguru, $jabatan);

        if ($stmt3->execute()) {
            echo "<script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'siswakeluar.php';
                  </script>";
        } else {
            echo "Kesalahan saat memasukkan ke penjaga_piket: " . $stmt3->error;
        }
    } else {
        echo "Kesalahan saat memasukkan ke history: " . $stmt2->error;
    }
} else {
    echo "Kesalahan saat memasukkan ke siswa_izinkeluar: " . $stmt1->error;
}

// Tutup pernyataan dan koneksi
$stmt1->close();
$stmt2->close();
$stmt3->close();
$conn->close();
?>
