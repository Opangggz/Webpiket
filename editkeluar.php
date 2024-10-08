<?php
include 'koneksi.php';

// Periksa apakah ID disediakan
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM siswa_izinkeluar WHERE id='$id'");
    $row = mysqli_fetch_assoc($query);

    // Periksa apakah rekaman ada
    if (!$row) {
        die("Data tidak ditemukan");
    }

    if (isset($_POST['update'])) {
        // Ambil data yang diperbarui
        $nama_siswa = mysqli_real_escape_string($conn, $_POST['nama_siswa']);
        $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
        $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
        $jk = mysqli_real_escape_string($conn, $_POST['jk']);
        $alasan = mysqli_real_escape_string($conn, $_POST['alasan']);
        $tlp = mysqli_real_escape_string($conn, $_POST['tlp']);
        $waktu_kembali = mysqli_real_escape_string($conn, $_POST['waktu_kembali']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        // Perbarui rekaman
        $update_query = "UPDATE siswa_izinkeluar SET 
            nama_siswa='$nama_siswa', 
            kelas='$kelas', 
            jurusan='$jurusan', 
            jk='$jk', 
            alasan='$alasan', 
            tlp='$tlp', 
            waktu_kembali='$waktu_kembali',
            status='$status'
            WHERE id='$id'";

        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('Data berhasil diperbarui'); window.location.href='siswakeluar.php';</script>";
            exit();
        } else {
            echo "Error saat memperbarui data: " . mysqli_error($conn);
        }
    }
} else {
    header('Location: siswakeluar.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT IZIN KELUAR</title>
    <link rel="shortcut icon" type="image/icon" href="img/smk.png"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Kontainer Formulir */
        .wrap {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 90%; /* Mengubah lebar menjadi 90% untuk responsivitas */
            max-width: 400px; /* Lebar maksimum */
        }

        /* Judul Formulir */
        .wrap h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Grup Formulir */
        .form-group {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        /* Lebar Label dan Elemen Input */
        .form-group label {
            width: 35%;
            font-weight: bold;
        }

        /* Input Form */
        .form-group input[type="text"],
        .form-group input[type="file"],
        .form-group input[type="datetime-local"],
        .form-group select {
            width: 63%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            appearance: none;
        }

        /* Tombol Update */
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Ikon Blob */
        .blob-icon {
            font-size: 40px; /* ukuran default */
            position: relative;
            display: inline-block;
            padding: 10px;
            color: #333;
            transition: all 0.3s ease-in-out;
        }

        .blob-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 60px;
            height: 60px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.3s ease-in-out;
        }

        .blob-icon:hover::before {
            transform: translate(-50%, -50%) scale(1.5);
        }

        .blob-icon:hover {
            font-size: 48px; /* ukuran membesar saat hover */
            color: #000; /* ganti warna saat hover */
        }

        /* Media Queries untuk Responsivitas */
        @media (max-width: 600px) {
            .form-group label {
                width: 40%; /* Lebar label lebih kecil di layar kecil */
            }
            .form-group input[type="text"],
            .form-group input[type="file"],
            .form-group input[type="datetime-local"],
            .form-group select {
                width: 60%; /* Lebar input lebih kecil di layar kecil */
            }
        }

        /* Tombol Update */
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .blob-icon {
            font-size: 20px; /* ukuran default */
            position: relative;
            display: inline-block;
            padding: 10px;
            color: #333;
            transition: all 0.3s ease-in-out;
        }

        .blob-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 60px;
            height: 60px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.3s ease-in-out;
        }

        .blob-icon:hover::before {
            transform: translate(-50%, -50%) scale(1.5);
        }

        .blob-icon:hover {
            font-size: 48px; /* ukuran membesar saat hover */
            color: #000; /* ganti warna saat hover */
        }
    </style>
    <script>
        // Fungsi untuk mengatur waktu kembali siswa secara otomatis
        window.onload = function() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');

            // Format ke yyyy-mm-ddTHH:MM
            const datetimeLocal = `${year}-${month}-${day}T${hours}:${minutes}`;
            document.getElementById('waktu_kembali').value = datetimeLocal; // Set nilai ke input waktu_kembali
        };
    </script>
</head>
<body>
    <div class="wrap">
        <a href="siswakeluar.php" class="blob-icon"><i class='bx bx-arrow-back'></i></a>
        <h2>EDIT IZIN SISWA KELUAR</h2>
        <form action="" method="post">

            <div class="form-group">
                <label for="Nama">Nama siswa:</label>
                <input type="text" id="Nama" name="nama_siswa" value="<?php echo htmlspecialchars($row['nama_siswa']); ?>" placeholder="Nama siswa" required>
            </div>

            <div class="form-group">
                <label for="Kelas">Kelas:</label>
                <select name="kelas" id="Kelas" required>
                    <option value="--">Kelas</option>
                    <option value="10" <?php echo ($row['kelas'] == '10') ? 'selected' : ''; ?>>10 (sepuluh)</option>
                    <option value="11" <?php echo ($row['kelas'] == '11') ? 'selected' : ''; ?>>11 (sebelas)</option>
                    <option value="12" <?php echo ($row['kelas'] == '12') ? 'selected' : ''; ?>>12 (dua belas)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Jurusan">Jurusan:</label>
                <select name="jurusan" id="Jurusan" required>
                    <option value="">Jurusan</option>
                    <option value="RPL" <?php echo ($row['jurusan'] == 'RPL') ? 'selected' : ''; ?>>Rekayasa Perangkat Lunak</option>
                    <option value="DKV 1" <?php echo ($row['jurusan'] == 'DKV 1') ? 'selected' : ''; ?>>Desain Komunikasi Visual 1</option>
                    <option value="DKV 2" <?php echo ($row['jurusan'] == 'DKV 2') ? 'selected' : ''; ?>>Desain Komunikasi Visual 2</option>
                    <option value="AK 1" <?php echo ($row['jurusan'] == 'AK 1') ? 'selected' : ''; ?>>Akuntansi 1</option>
                    <option value="AK 2" <?php echo ($row['jurusan'] == 'AK 2') ? 'selected' : ''; ?>>Akuntansi 2</option>
                    <option value="MP 1" <?php echo ($row['jurusan'] == 'MP 1') ? 'selected' : ''; ?>>Manajemen Perkantoran 1</option>
                    <option value="MP 2" <?php echo ($row['jurusan'] == 'MP 2') ? 'selected' : ''; ?>>Manajemen Perkantoran 2</option>
                    <option value="Kuliner" <?php echo ($row['jurusan'] == 'Kuliner') ? 'selected' : ''; ?>>Kuliner</option>
                    <option value="PBS" <?php echo ($row['jurusan'] == 'PBS') ? 'selected' : ''; ?>>Perbankan Syariah</option>
                    <option value="APAT" <?php echo ($row['jurusan'] == 'APAT') ? 'selected' : ''; ?>>Agrobisnis Perikanan Air Tawar</option>
                    <option value="APHPI" <?php echo ($row['jurusan'] == 'APHPI') ? 'selected' : ''; ?>>Agrabisnis Pengolahan Hasil Perikanan</option>
                    <option value="TM 1" <?php echo ($row['jurusan'] == 'TM 1') ? 'selected' : ''; ?>>Teknik Mesin 1</option>
                    <option value="TM 2" <?php echo ($row['jurusan'] == 'TM 2') ? 'selected' : ''; ?>>Teknik Mesin 2</option>
                    <option value="TKRO" <?php echo ($row['jurusan'] == 'TKRO') ? 'selected' : ''; ?>>Teknik Kendaraan Ringan Otomotif</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jk">Jenis Kelamin:</label>
                <select id="jk" name="jk" required>
                    <option value="LK" <?php echo ($row['jk'] == 'LK') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="PR" <?php echo ($row['jk'] == 'PR') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Alasan">Alasan:</label>
                <input type="text" id="Alasan" name="alasan" value="<?php echo htmlspecialchars($row['alasan']); ?>" placeholder="Alasan" required>
            </div>

            <div class="form-group">
                <label for="tlp">No. Telepon:</label>
                <input type="text" id="tlp" name="tlp" value="<?php echo htmlspecialchars($row['tlp']); ?>" placeholder="No. Telepon" required>
            </div>

            <div class="form-group">
                <label for="waktu_kembali">Tanggal Kembali Siswa:</label>
                <input type="datetime-local" id="waktu_kembali" name="waktu_kembali" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Izin keluar" <?php echo ($row['status'] == 'Izin keluar') ? 'selected' : ''; ?>>Izin keluar</option>
                    <option value="Sudah kembali" <?php echo ($row['status'] == 'Sudah kembali') ? 'selected' : ''; ?>>Sudah kembali</option>
                </select>
            </div>

            <button type="submit" name="update" class="btn">Update</button>
        </form>
    </div>
</body>
</html>
