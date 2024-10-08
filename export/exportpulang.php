<?php
include "../koneksi.php";
?>
<html>
<head>
  <title>DATA SISWA IZIN pulang</title>
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
    <h2>DATA IZIN pulang</h2>
    <div class="data-tables datatable-dark">
        <table id="izinPulang" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telepon</th>
                    <th>Keterangan</th>
                    <th>Date & Time pulang</th>
                    <th>Status</th>
                    <th>Nama Penjaga Piket</th>
                    <th>Jabatan</th>
                    <th>Aksi</th> <!-- Tambahkan kolom untuk aksi -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk izin pulang
                $sql_pulang = "SELECT *, 'pulang' as tipe FROM `siswa_izinpulang`"; 
                $query_pulang = mysqli_query($conn, $sql_pulang);

                $urut_pulang = 1;
                while ($row_pulang = mysqli_fetch_array($query_pulang)) {
                    $nama_pulang = htmlspecialchars($row_pulang['nama_siswa']);
                    $kelas_pulang = htmlspecialchars($row_pulang['kelas']);
                    $jurusan_pulang = htmlspecialchars($row_pulang['jurusan']);
                    $jk_pulang = htmlspecialchars($row_pulang['jk']);
                    $tlp_pulang = htmlspecialchars($row_pulang['tlp']);
                    $keterangan = htmlspecialchars($row_pulang['alasan']);
                    $tanggal_izin_pulang = date('d-m-Y H:i:s', strtotime($row_pulang['tanggal_izin'])); // Format tanggal
                    $status_pulang = htmlspecialchars($row_pulang['status']); // Ambil status dari database
                    $namaguru = htmlspecialchars($row_pulang['namaguru']); // Ambil nama penjaga piket
                    $jabatan = htmlspecialchars($row_pulang['jabatan']);

                    // Buat pesan yang akan dikirim ke WA
                    $message = urlencode("Selamat Siang Bapak/Ibu penjaga gerbang sekolah,\n\nKami dari Piket SMKN 7 Kota Serang ingin menginformasikan bahwa siswa **$nama_pulang** telah mengajukan izin dan mendapatkan persetujuan untuk meninggalkan area sekolah. Mohon agar gerbang dibuka oleh Bapak/Ibu Satpam untuk memfasilitasi kepergian siswa tersebut.\n\nData Izin:\nNama: $nama_pulang\nKelas: $kelas_pulang\nJurusan: $jurusan_pulang\nJenis Kelamin: $jk_pulang\nNo. Telepon: $tlp_pulang\nKeterangan: $keterangan\nTanggal Izin: $tanggal_izin_pulang\nStatus: $status_pulang\nNama Penjaga Piket: $namaguru\nJabatan: $jabatan\n\nTerima kasih atas perhatian dan kerjasamanya.\n\nSalam,\nPiket SMKN 7 Kota Serang");

                    // Format nomor telepon
                    $formatted_no_wa = preg_replace('/\D/', '', $tlp_pulang); // Menghapus karakter non-digit
                    $whatsapp_link = "https://wa.me/$formatted_no_wa?text=$message"; // Sertakan nomor telepon
                ?>
                    <tr>
                        <td><?php echo $urut_pulang++; ?></td>
                        <td><?php echo $nama_pulang; ?></td>
                        <td><?php echo $kelas_pulang; ?></td>
                        <td><?php echo $jurusan_pulang; ?></td>
                        <td><?php echo $jk_pulang; ?></td>
                        <td><?php echo $tlp_pulang; ?></td>
                        <td><?php echo $keterangan; ?></td>
                        <td><?php echo $tanggal_izin_pulang; ?></td>
                        <td><?php echo $status_pulang; ?></td>
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
    $('#izinPulang').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
});
</script>

</body>
</html>
