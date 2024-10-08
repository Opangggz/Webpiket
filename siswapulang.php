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

// Query untuk menghitung jumlah siswa izin pulang
$pulangData = mysqli_query($conn, "SELECT * FROM siswa_izinpulang");
$count2 = mysqli_num_rows($pulangData);

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
    <title>DATA SISWA PULANG</title>
    <style>
        /* Styling tabel untuk men-center teks th */
        table {
            width: 100%;
            border-collapse: collapse;
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
        .status.kembali {
            background-color: #2ecc71; /* warna untuk sudah kembali */
        }
        .status.izin {
            background-color: #e67e22; /* warna untuk izin keluar */
        }
        .status.default {
            background-color: #e74c3c; /* warna default untuk status lain */
        }

        /* Responsive Table */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch; /* Enable smooth scrolling on iOS */
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
            <form action="#">
                <div class="form-input">
                    <input type="search" id="searchInput" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <a href="notifikasi.php" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num"><?= $count2; ?></span> <!-- Jumlah notifikasi -->
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
                    <h1>Siswa pulang</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="siswapulang.php">Siswa pulang</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="dash.php">Back dashboard</a>
                        </li>
                    </ul>
                </div>
                <a href="export/exportpulang.php" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Export</span>
                </a>
            </div>

            <ul class="box-info1">
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
                        <h3><?= $count2; ?></h3>
                        <p>Jumlah siswa izin pulang</p>
                    </span>
                </li>
            </ul>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Piket SMKN 7 Kota Serang</h3>
                        <a href="formpulang.php"><i class='bx bx-plus-circle'></i></a>
                    </div>
                    <div class="table-responsive"> <!-- Make the table responsive -->
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama siswa</th>
                                    <th>Jenis kelamin</th>
                                    <th>Jurusan</th>
                                    <th>Kelas</th>
                                    <th>No.Tlp</th>
                                    <th>Keterangan</th>
                                    <th>Date & time pulang</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php $i = 1; ?>
                                <?php while ($row = mysqli_fetch_assoc($pulangData)) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><p><?php echo ($row['nama_siswa']); ?></p></td>
                                        <td><?php echo ($row['jk']); ?></td>
                                        <td><?php echo ($row['jurusan']); ?></td>
                                        <td><?php echo ($row['kelas']); ?></td>
                                        <td><?php echo ($row['tlp']); ?></td>
                                        <td><?php echo ($row['alasan']); ?></td>
                                        <td><?php echo date('d-m-Y H:i:s', strtotime($row['tanggal_izin'])); ?></td>
                                        <td>
                                            <?php
                                                $statusClass = 'status default'; // kelas default
                                                if (strtolower($row['status']) === 'sudah kembali') {
                                                    $statusClass = 'status kembali'; 
                                                } else if (strtolower($row['status']) === 'izin keluar') {
                                                    $statusClass = 'status izin'; 
                                                }
                                            ?>
                                            <span class="<?= $statusClass; ?>">
                                                <?= ($row['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="editpulang.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                                            <a href="hapuspulang.php?id=<?= $row['id']; ?>" class="btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div> <!-- End of table-responsive -->
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
                const name = row.querySelector("td:nth-child(2) p").textContent.toLowerCase();
                const jurusan = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
                const kelas = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
                const noTlp = row.querySelector("td:nth-child(5)").textContent.toLowerCase();
                const date = row.querySelector("td:nth-child(6)").textContent.toLowerCase();

                // Cek apakah input ada di salah satu kolom
                if (
                    name.includes(input) || 
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

