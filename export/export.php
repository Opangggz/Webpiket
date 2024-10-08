<?php
include "../koneksi.php"; // Menghubungkan ke database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA IZIN KELUAR DAN IZIN PULANG</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="shortcut icon" type="image/icon" href="../img/smk.png"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">DATA IZIN KELUAR DAN IZIN PULANG</h2>
    <div class="data-tables datatable-dark">
        <table id="izin" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telepon</th>
                    <th>Keterangan</th>
                    <th>Date & Time Keluar</th>
                    <th>Date & Time Kembali</th>
                    <th>Status</th>
                    <th>Tipe Izin</th>
                    <th>Nama Penjaga Piket</th>
                    <th>Jabatan</th>
                    <th>Aksi</th> <!-- Tambahkan kolom untuk aksi -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk izin keluar
                $sql_keluar = "SELECT *, 'Keluar' as tipe FROM `siswa_izinkeluar`"; 
                $query_keluar = mysqli_query($conn, $sql_keluar);

                // Query untuk izin pulang
                $sql_pulang = "SELECT *, 'Pulang' as tipe FROM `siswa_izinpulang`"; 
                $query_pulang = mysqli_query($conn, $sql_pulang);

                // Gabungkan hasil izin keluar dan pulang
                $data_combined = array_merge(mysqli_fetch_all($query_keluar, MYSQLI_ASSOC), mysqli_fetch_all($query_pulang, MYSQLI_ASSOC));

                $urut = 1;
                foreach ($data_combined as $row) {
                    $nama = htmlspecialchars($row['nama_siswa']);
                    $kelas = htmlspecialchars($row['kelas']);
                    $jurusan = htmlspecialchars($row['jurusan']);
                    $jk = htmlspecialchars($row['jk']);
                    $tlp = htmlspecialchars($row['tlp']);
                    $alasan = htmlspecialchars($row['alasan']);
                    $tanggal_izin = date('d-m-Y H:i:s', strtotime($row['tanggal_izin'])); // Format tanggal
                    $waktu_kembali = isset($row['waktu_kembali']) ? date('d-m-Y H:i:s', strtotime($row['waktu_kembali'])) : ''; 
                    $status = htmlspecialchars($row['status']); // Ambil status dari database
                    $tipe = htmlspecialchars($row['tipe']); // Ambil tipe dari hasil query
                    $namaguru = htmlspecialchars($row['namaguru']); // Ambil nama penjaga piket
                    $jabatan = htmlspecialchars($row['jabatan']);

                    // Buat pesan yang akan dikirim ke WA
                    $message = urlencode("Selamat Siang Bapak/Ibu penjaga gerbang sekolah,\n\nKami dari Piket SMKN 7 Kota Serang ingin menginformasikan bahwa siswa **$nama** telah mengajukan izin dan mendapatkan persetujuan untuk meninggalkan area sekolah. Mohon agar gerbang dibuka oleh Bapak/Ibu Satpam untuk memfasilitasi kepergian siswa tersebut.\n\nData Izin:\nNama: $nama\nKelas: $kelas\nJurusan: $jurusan\nJenis Kelamin: $jk\nNo. Telepon: $tlp\nKeterangan: $alasan\nTanggal Izin: $tanggal_izin\nStatus: $status\nNama Penjaga Piket: $namaguru\nJabatan: $jabatan\n\nTerima kasih atas perhatian dan kerjasamanya.\n\nSalam,\nPiket SMKN 7 Kota Serang");
                    
                    // Format nomor telepon
                    $formatted_no_wa = preg_replace('/\D/', '', $tlp); // Menghapus karakter non-digit
                    $whatsapp_link = "https://wa.me/$formatted_no_wa?text=$message"; // Sertakan nomor telepon
                ?>
                    <tr>
                        <td><?php echo $urut++; ?></td>
                        <td><?php echo $nama; ?></td>
                        <td><?php echo $kelas; ?></td>
                        <td><?php echo $jurusan; ?></td>
                        <td><?php echo $jk; ?></td>
                        <td><?php echo $tlp; ?></td>
                        <td><?php echo $alasan; ?></td>
                        <td><?php echo $tanggal_izin; ?></td>
                        <td><?php echo $waktu_kembali; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $tipe; ?></td>
                        <td><?php echo $namaguru; ?></td>
                        <td><?php echo $jabatan; ?></td>
                        <td>
                            <a href="<?php echo $whatsapp_link; ?>" target="_blank" class="btn btn-success btn-sm">Kirim WA</a>
                        </td> <!-- Tombol untuk mengirim WA -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#izin').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
});
</script>

</body>
</html>
