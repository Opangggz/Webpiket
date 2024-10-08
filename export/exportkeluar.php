<?php
include "../koneksi.php";
?>
<html>
<head>
  <title>DATA SISWA IZIN KELUAR</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
  <link rel="shortcut icon" type="image/icon" href="../img/smk.png"/>
</head>

<body>
<div class="container">
    <h2>DATA IZIN KELUAR</h2>
    <div class="data-tables datatable-dark">
        <table id="izinKeluar" class="display">
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

                $urut_keluar = 1;
                while ($row_keluar = mysqli_fetch_array($query_keluar)) {
                    $nama_keluar = htmlspecialchars($row_keluar['nama_siswa']);
                    $kelas_keluar = htmlspecialchars($row_keluar['kelas']);
                    $jurusan_keluar = htmlspecialchars($row_keluar['jurusan']);
                    $jk_keluar = htmlspecialchars($row_keluar['jk']);
                    $tlp_keluar = htmlspecialchars($row_keluar['tlp']);
                    $keterangan = htmlspecialchars($row_keluar['alasan']);
                    $tanggal_izin_keluar = date('d-m-Y H:i:s', strtotime($row_keluar['tanggal_izin'])); // Format tanggal
                    $waktu_kembali = isset($row_keluar['waktu_kembali']) ? date('d-m-Y H:i:s', strtotime($row_keluar['waktu_kembali'])) : ''; 
                    $status_keluar = htmlspecialchars($row_keluar['status']); // Ambil status dari database
                    $namaguru = htmlspecialchars($row_keluar['namaguru']); // Ambil nama penjaga piket
                    $jabatan = htmlspecialchars($row_keluar['jabatan']);

                    // Buat pesan yang akan dikirim ke WA
                    $message = urlencode("Selamat Siang Bapak/Ibu penjaga gerbang sekolah,\n\nKami dari Piket SMKN 7 Kota Serang ingin menginformasikan bahwa siswa **$nama_keluar** telah mengajukan izin dan mendapatkan persetujuan untuk meninggalkan area sekolah. Mohon agar gerbang dibuka oleh Bapak/Ibu Satpam untuk memfasilitasi kepergian siswa tersebut.\n\nData Izin:\nNama: $nama_keluar\nKelas: $kelas_keluar\nJurusan: $jurusan_keluar\nJenis Kelamin: $jk_keluar\nNo. Telepon: $tlp_keluar\nKeterangan: $keterangan\nTanggal Izin: $tanggal_izin_keluar\nStatus: $status_keluar\nNama Penjaga Piket: $namaguru\nJabatan: $jabatan\n\nTerima kasih atas perhatian dan kerjasamanya.\n\nSalam,\nPiket SMKN 7 Kota Serang");

                    // Format nomor telepon
                    $formatted_no_wa = preg_replace('/\D/', '', $tlp_keluar); // Menghapus karakter non-digit
                    $whatsapp_link = "https://wa.me/$formatted_no_wa?text=$message"; // Sertakan nomor telepon
                ?>
                    <tr>
                        <td><?php echo $urut_keluar++; ?></td>
                        <td><?php echo $nama_keluar; ?></td>
                        <td><?php echo $kelas_keluar; ?></td>
                        <td><?php echo $jurusan_keluar; ?></td>
                        <td><?php echo $jk_keluar; ?></td>
                        <td><?php echo $tlp_keluar; ?></td>
                        <td><?php echo $keterangan; ?></td>
                        <td><?php echo $tanggal_izin_keluar; ?></td>
                        <td><?php echo $waktu_kembali; ?></td>
                        <td><?php echo $status_keluar; ?></td>
                        <td><?php echo $namaguru; ?></td>
                        <td><?php echo $jabatan; ?></td>
                        <td>
                            <a href="<?php echo $whatsapp_link; ?>" class="btn btn-success btn-sm" target="_blank">Kirim WA</a> <!-- Tombol kirim WA -->
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
 
<script>
$(document).ready(function() {
    $('#izinKeluar').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
});
</script>

</body>
</html>
