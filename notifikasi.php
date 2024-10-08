<?php
include 'koneksi.php'; // Koneksi ke database

// Query untuk mendapatkan data siswa yang izin keluar
$keluarData = mysqli_query($conn, "SELECT * FROM siswa_izinkeluar");
// Query untuk mendapatkan data siswa yang izin pulang
$pulangData = mysqli_query($conn, "SELECT * FROM siswa_izinpulang");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Siswa</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" type="image/icon" href="img/smk.png"/>
    <style>
        .notif {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .notification {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
        }
        .icon {
            margin-right: 15px;
        }
        .icon img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .content {
            flex-grow: 1;
        }
        .content p {
            margin: 5px 0;
            font-size: 14px;
        }
        .highlight {
            color: #007bff;
            font-weight: bold;
        }
        .time {
            font-size: 12px;
            color: #888;
        }

        /* Responsive untuk tampilan mobile */
        @media (max-width: 600px) {
            .container {
                max-width: 100%;
                border-radius: 0;
            }
            .notification {
                flex-direction: column;
                align-items: flex-start;
            }
            .icon {
                margin-bottom: 10px;
            }
            .content p {
                font-size: 13px;
            }
            .highlight {
                font-size: 14px;
            }
            .time {
                font-size: 11px;
            }
        }
    </style>
</head>
<body class="notif">

<div class="container">
    <h2 style="text-align: center; padding: 10px;">Kotak Masuk</h2>

    <!-- Notifikasi siswa izin keluar -->
    <?php while($row = mysqli_fetch_assoc($keluarData)) : ?>
    <div class="notification">
        <div class="icon">
        <i class='bx bxs-bell' ></i>
        </div>
        <div class="content">
            <p><strong><?= $row['nama_siswa']; ?></strong> (<?= $row['kelas']; ?>) - <?= $row['jurusan']; ?></p>
            <p>Jenis kelamin: <?= $row['jk']; ?> | No. Telepon: <?= $row['tlp']; ?></p>
            <p class="highlight">Izin keluar</p>
            <p class="time"><?= date("H:i", strtotime($row['tanggal_izin'])); ?> hari ini</p>
        </div>
    </div>
    <?php endwhile; ?>

    <!-- Notifikasi siswa izin pulang -->
    <?php while($row = mysqli_fetch_assoc($pulangData)) : ?>
    <div class="notification">
        <div class="icon">
        <i class='bx bxs-bell' ></i>
        </div>
        <div class="content">
            <p><strong><?= $row['nama_siswa']; ?></strong> (<?= $row['kelas']; ?>) - <?= $row['jurusan']; ?></p>
            <p>Jenis kelamin: <?= $row['jk']; ?> | No. Telepon: <?= $row['tlp']; ?></p>
            <p class="highlight">Izin pulang</p>
            <p class="time"><?php echo date('d-m-Y', strtotime($row['tanggal_izin'])); ?> hari ini</p>
        </div>
    </div>
    <?php endwhile; ?>

</div>

</body>
</html>
