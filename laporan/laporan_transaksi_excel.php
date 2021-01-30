<?php 
require_once '../page/transaksi/function.php';
require_once '../config/koneksi.php';

$filename = "transaksi_excel-(". date('d-m-Y') .").xls";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename");

// menampilkan DB buku
$ambilAnggota = $conn->query("SELECT * FROM tb_transaksi INNER JOIN tb_buku
								ON tb_transaksi.id_buku = tb_buku.id_buku INNER JOIN tb_anggota 
								ON tb_transaksi.id_anggota = tb_anggota.id_anggota;") or die(mysqli_error($conn));
?>
<h2>Laporan Transaksi</h2>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Judul</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Terlambat</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        while ($pecahAnggota = $ambilAnggota->fetch_assoc()) {
        $jk = ($pecahAnggota['jk'] == 'L') ? 'Laki-Laki' : 'Perempuan';
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $pecahAnggota['nim']; ?></td>
            <td><?= $pecahAnggota['judul_buku']; ?></td>
            <td><?= $pecahAnggota['tgl_pinjam']; ?></td>
            <td><?= $pecahAnggota['tgl_kembali']; ?></td>
            <td>
                <?php 
                $denda = 1000;
                $tgl_dateline = $pecahAnggota['tgl_kembali'];
                $tgl_kembali = date('d-m-Y');

                $lambat = terlambat($tgl_dateline, $tgl_kembali);
                $denda1 = $lambat * $denda;

                if($lambat > 0) { ?>
                    <div style='color:red;'><?= $lambat ?> hari<br> (Rp. <?= number_format($denda1) ?>)</div>
                <?php
                } else {
                    echo $lambat . "Hari";
                }
                ?>
            </td>
            <td><?= $pecahAnggota['status']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>