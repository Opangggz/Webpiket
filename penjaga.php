<?php
include 'koneksi.php';

session_start();

// Cek apakah user sudah login, jika tidak redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Ambil data user yang login dari session
$user_id = $_SESSION['user_id']; // Pastikan session user_id sudah di-set saat login
$userData = mysqli_query($conn, "SELECT foto FROM user WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($userData); // Ambil satu row
$fotoProfil = $user['foto']; // Ambil nama file foto

// Query untuk menghitung jumlah siswa izin keluar
$keluarData = mysqli_query($conn, "SELECT * FROM siswa_izinkeluar");
$count1 = mysqli_num_rows($keluarData);

// Query untuk menghitung jumlah siswa izin pulang
$pulangData = mysqli_query($conn, "SELECT * FROM siswa_izinpulang");
$count2 = mysqli_num_rows($pulangData);

// Query untuk menghitung jumlah siswa izin piket
$piketData = mysqli_query($conn, "SELECT * FROM penjaga_piket");
$count3 = mysqli_num_rows($piketData);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" type="image/icon" href="img/smk.png"/>

    <title>DATA PENJAGA PIKET</title>
    <style>
        /* Styling tabel untuk men-center teks th */
table {
    width: 100%;
    border-collapse: collapse;
    overflow-x: auto; /* Memungkinkan scrolling horizontal di layar kecil */
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center; /* Men-center th dan td */
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

.status {
    padding: 5px 10px;
    border-radius: 5px;
    color: white;
}

.status.izin {
    background-color: #f1c40f; /* Kuning untuk izin keluar */
}

.status.pulang {
    background-color: red; /* Merah untuk izin pulang */
}

.status.kembali {
    background-color: green; /* Hijau untuk sudah kembali */
}

.balik {
    background-color: #f1c40f;
    color: white;
}

.izin {
    background-color: #e74c3c;
    color: white;
}

/* Styling responsif */
@media screen and (max-width: 600px) {
    /* Menyusun tabel untuk layar kecil */
    table {
        display: block; /* Mengubah tabel menjadi block */
        overflow-x: auto; /* Mengaktifkan scrolling horizontal */
        white-space: nowrap; /* Mencegah pemotongan teks */
    }

    th, td {
        display: block; /* Mengubah sel menjadi block */
        width: auto; /* Membiarkan lebar menyesuaikan */
        min-width: 120px; /* Lebar minimum untuk keterbacaan yang lebih baik */
        box-sizing: border-box; /* Menghitung padding dan border dalam lebar */
    }

    th {
        position: sticky; /* Menjaga header tetap di atas */
        top: 0; /* Menyesuaikan posisi */
        z-index: 1; /* Memastikan header di atas elemen lain */
        background-color: #f2f2f2; /* Tambahkan background untuk header */
    }

    tr {
        display: flex; /* Mengubah baris menjadi flex untuk stacking */
        flex-direction: column; /* Mengubah arah menjadi kolom */
        margin-bottom: 10px; /* Memberi jarak antar baris */
    }
}

/* Media query tambahan untuk layar lebih besar */
@media screen and (min-width: 601px) and (max-width: 1024px) {
    /* Menyesuaikan tabel untuk layar medium */
    th, td {
        font-size: 0.9em; /* Mengurangi sedikit ukuran font */
    }
}

@media screen and (min-width: 1025px) {
    /* Gaya untuk desktop dan layar lebih besar */
    th, td {
        font-size: 1em; /* Ukuran font default */
    }
}

    </style>
</head>
<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="img/smk.png" alt="SMK Logo">
            <marquee behavior="scroll" direction="right">PIKET SMKN 7 KOTA SERANG</marquee>
        </a>
        <ul class="side-menu top">
            <li class="<?= ($_SERVER['SCRIPT_NAME'] == '/dash.php') ? 'active' : ''; ?>">
                <a href="dash.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="<?= ($_SERVER['SCRIPT_NAME'] == '/siswakeluar.php') ? 'active' : ''; ?>">
                <a href="siswakeluar.php">
                    <i class='bx bxs-user-circle'></i>
                    <span class="text">Siswa keluar</span>
                </a>
            </li>
            <li class="<?= ($_SERVER['SCRIPT_NAME'] == '/siswapulang.php') ? 'active' : ''; ?>">
                <a href="siswapulang.php">
                    <i class='bx bxs-user-circle'></i>
                    <span class="text">Siswa pulang</span>
                </a>
            </li>
            <li class="<?= ($_SERVER['SCRIPT_NAME'] == '/penjaga.php') ? 'active' : ''; ?>">
                <a href="penjaga.php">
                    <i class='bx bxs-user-circle'></i>
                    <span class="text">Penjaga piket</span>
                </a>
            </li>
            <li class="<?= ($_SERVER['SCRIPT_NAME'] == '/history.php') ? 'active' : ''; ?>">
                <a href="history.php">
                    <i class='bx bx-history'></i>
                    <span class="text">History</span>
                </a>
            </li>
            <li>
                <a href="index.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" id="searchInput" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="notifikasi.php" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num"><?= $count1 + $count2; ?></span> <!-- Jumlah notifikasi -->
            </a>
            <a href="#" class="profile">
                <img src="uploads/<?php echo $fotoProfil; ?>" alt="Foto Profil" /> <!-- Menampilkan foto dari database -->
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Penjaga piket</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="penjaga.php">Penjaga piket</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="dash.php"> Back dashboard</a>
                        </li>
                    </ul>
                </div>
                <a href="export/export.php" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Export</span>
                </a>
            </div>

            <ul class="box-info2">
                <li>
                    <i class='bx bxs-calendar'></i>
                    <span class="text">
                        <h3><?php echo date('d-m-Y'); ?></h3>
                        <p>Tanggal</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-group'></i>
                    <span class="text">
                        <h3><?=$count3;?></h3>
                        <p>Jumlah penjaga piket</p>
                    </span>
                </li>
            </ul>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Piket SMKN 7 Kota Serang</h3>
                        <a href="pilihan.php"><i class='bx bx-plus-circle'></i></a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penjaga Piket</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php $i=1; ?>
                            <?php while($row = mysqli_fetch_assoc($piketData)) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?php echo ($row['namaguru']); ?></td>
                                <td><?php echo ($row['jabatan']); ?></td>
                                <td>
                                    <a href="hapuspiket.php?id=<?= $row['id']; ?>" class="btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                                </td>
                                
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>		
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="script.js"></script>
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            const input = this.value.toLowerCase();
            const rows = document.querySelectorAll("#tableBody tr");

            rows.forEach(function(row) {
                const name = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                const jk = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
                const jurusan = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
                const kelas = row.querySelector("td:nth-child(5)").textContent.toLowerCase();
                const noTlp = row.querySelector("td:nth-child(6)").textContent.toLowerCase();
                const date = row.querySelector("td:nth-child(7)").textContent.toLowerCase();

                // Cek apakah input ada di salah satu kolom
                if (
                    name.includes(input) || 
                    jk.includes(input) || 
                    jurusan.includes(input) || 
                    kelas.includes(input) || 
                    noTlp.includes(input) || 
                    date.includes(input)
                ) {
                    row.style.display = ""; // Tampilkan baris
                } else {
                    row.style.display = "none"; // Sembunyikan baris
                }
            });
        });
    </script>

</body>
</html>
