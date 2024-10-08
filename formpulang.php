<?php
session_start();

if (isset($_SESSION['username'])) {
    $nama_guru = $_SESSION['username'];
} else {
    // Jika belum login, arahkan ke halaman login
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IZIN SISWA PULANG</title>
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
        // Fungsi untuk menambahkan kode negara saat input fokus
        function addCountryCode(input) {
            if (input.value.length === 0) {
                input.value = '+62'; // Tambahkan kode negara jika input kosong
            }
        }

        // Fungsi untuk mengatur tanggal pulang siswa ke tanggal saat ini
        window.onload = function() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Bulan 0-11, jadi tambahkan 1
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');

            // Format ke yyyy-mm-ddTHH:MM
            const datetimeLocal = `${year}-${month}-${day}T${hours}:${minutes}`;
            document.getElementById('tanggal_izin').value = datetimeLocal;
        };
    </script>
</head>
<body class="formizin">
    <div class="wrap">
        <a href="dash.php" class="blob-icon"><i class='bx bx-arrow-back'></i></a>
        <h2>IZIN SISWA PULANG</h2><br>
        <form action="pspulang.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="Nama">Nama siswa:</label>
                <input type="text" id="Nama" name="nama_siswa" placeholder="Nama siswa" required>
            </div>

            <div class="form-group">
                <label for="Kelas">Kelas:</label>
                <select name="kelas" id="Kelas" required>
                    <option value="--">--</option>
                    <option value="10">10 (sepuluh)</option>
                    <option value="11">11 (sebelas)</option>
                    <option value="12">12 (dua belas)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Jurusan">Jurusan:</label>
                <select name="jurusan" id="Jurusan" required>
                    <option value="--">--</option>
                    <option value="RPL">Rekayasa Perangkat Lunak</option>
                    <option value="DKV 1">Desain Komunikasi Visual 1</option>
                    <option value="DKV 2">Desain Komunikasi Visual 2</option>
                    <option value="AK 1">Akuntansi 1</option>
                    <option value="AK 2">Akuntansi 2</option>
                    <option value="MP 1">Manajemen Perkantoran 1</option>
                    <option value="MP 2">Manajemen Perkantoran 2</option>
                    <option value="Kuliner">Kuliner</option>
                    <option value="PBS">Perbankan Syariah</option>
                    <option value="APAT">Agrobisnis Perikanan Air Tawar</option>
                    <option value="APHPI">Agrabisnis Pengolahan Hasil Perikanan</option>
                    <option value="TM 1">Teknik Mesin 1</option>
                    <option value="TM 2">Teknik Mesin 2</option>
                    <option value="TKRO">Teknik Kendaraan Ringan Otomotif</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jk">Jenis Kelamin:</label>
                <select name="jk" id="jk" required>
                    <option value="jk">--</option>
                    <option value="LK">Laki-laki</option>
                    <option value="PR">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tlp">No. Telepon:</label>
                <input type="text" name="tlp" id="tlp" placeholder="+62 No. Telepon" 
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                    required onfocus="addCountryCode(this)">
            </div>

            <div class="form-group">
                <label for="alasan">Keterangan:</label>
                <input type="text" id="alasan" name="alasan" placeholder="Alasan" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Izin pulang" selected>Izin pulang</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="tanggal_izin">Tanggal pulang siswa:</label>
                <input type="datetime-local" name="tanggal_izin" id="tanggal_izin" required>
            </div><br>

            <hr>

            <div class="form-group">
                <label for="user">Nama Guru:</label>
                <input type="text" id="user" name="user" value="<?php echo htmlspecialchars($nama_guru); ?>" readonly required>
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan Guru:</label>
                <select name="jabatan" id="jabatan" required>
                    <option value="jabatan">--</option>
                    <option value="TU">Staf TU</option>
                    <option value="Produktif">Guru Produktif</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                </select>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Tambah" name="submit" class="btn">
            </div>
        </form>
    </div>
</body>
</html>
