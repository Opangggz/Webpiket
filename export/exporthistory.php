<?php
include "../koneksi.php";
?>
<html>
<head>
  <title>HISTORY</title>
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
    <h2>HISTORY</h2>
    <div class="data-tables datatable-dark">
        <table id="izinHistory" class="display">
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
                $sql_keluar = "SELECT * FROM `history`"; // Query untuk izin keluar
                $urut_keluar = 1;
                $query_keluar = mysqli_query($conn, $sql_keluar);
                
                while ($row_keluar = mysqli_fetch_array($query_keluar)) {
                    // Perbaiki pengambilan data
                    $nama = htmlspecialchars($row_keluar['nama_siswa']);
                    $kelas = htmlspecialchars($row_keluar['kelas']);
                    $jurusan = htmlspecialchars($row_keluar['jurusan']);
                    $jk = htmlspecialchars($row_keluar['jk']);
                    $tlp = htmlspecialchars($row_keluar['tlp']);
                    $alasan = htmlspecialchars($row_keluar['alasan']);
                    $tanggal_izin = date('d-m-Y H:i:s', strtotime($row_keluar['tanggal_izin'])); // Format tanggal
                    $waktu_kembali = isset($row_keluar['waktu_kembali']) ? date('d-m-Y H:i:s', strtotime($row_keluar['waktu_kembali'])) : ''; 
                    $status = htmlspecialchars($row_keluar['status']); // Ambil status dari database
                    $namaguru = htmlspecialchars($row['namaguru']); // Ambil nama penjaga piket
                    $jabatan = htmlspecialchars($row['jabatan']);
                    // Buat pesan yang akan dikirim ke WA
                    $message = urlencode("Selamat Siang Bapak/Ibu penjaga gerbang sekolah,\n\nKami dari Piket SMKN 7 Kota Serang ingin menginformasikan bahwa siswa **$nama** telah mengajukan izin dan mendapatkan persetujuan untuk meninggalkan area sekolah. Mohon agar gerbang dibuka oleh Bapak/Ibu Satpam untuk memfasilitasi kepergian siswa tersebut.\n\nData Izin:\nNama: $nama\nKelas: $kelas\nJurusan: $jurusan\nJenis Kelamin: $jk\nNo. Telepon: $tlp\nKeterangan: $alasan\nTanggal Izin: $tanggal_izin\nStatus: $status\nNama Penjaga Piket: $namaguru\nJabatan: $jabatan\n\nTerima kasih atas perhatian dan kerjasamanya.\n\nSalam,\nPiket SMKN 7 Kota Serang");
                    
                    // Format nomor telepon
                    $formatted_no_wa = preg_replace('/\D/', '', $tlp); // Menghapus karakter non-digit
                    $whatsapp_link = "https://wa.me/$formatted_no_wa?text=$message"; // Sertakan nomor telepon
                ?>
                    <tr>
                        <td><?php echo $urut_keluar++; ?></td>
                        <td><?php echo $nama; ?></td>
                        <td><?php echo $kelas; ?></td>
                        <td><?php echo $jurusan; ?></td>
                        <td><?php echo $jk; ?></td>
                        <td><?php echo $tlp; ?></td>
                        <td><?php echo $alasan; ?></td>
                        <td><?php echo $tanggal_izin; ?></td>
                        <td><?php echo $waktu_kembali; ?></td>
                        <td><?php echo $status; ?></td>
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
 
<script>
$(document).ready(function() {
    $('#izinHistory').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
});
</script>

</body>
</html>
