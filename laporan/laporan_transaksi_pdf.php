<?php 
ob_start();
require_once '../page/transaksi/function.php';
require_once '../config/koneksi.php';
require_once '../assets/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();

$semuaAnggota = [];
$sqlAnggota = $conn->query("SELECT * FROM tb_transaksi INNER JOIN tb_buku
							ON tb_transaksi.id_buku = tb_buku.id_buku INNER JOIN tb_anggota 
							ON tb_transaksi.id_anggota = tb_anggota.id_anggota") or die(mysqli_error($conn));
while ($pecahAnggota = $sqlAnggota->fetch_assoc()) {
	$semuaAnggota[] = $pecahAnggota;
}
// $jk = ($pecahAnggota['jk'] == 'L') ? 'Laki-Laki' : 'Perempuan';


$html = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Export to PDF Anggota</title>
</head>
<body>
<h2>Laporan Transaksi</h2>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No</th>
			<th style="width: 100px;">NIM</th>
			<th style="width: 150px;">Judul</th>
			<th style="width: 120px;text-align: center; vertical-align: middle;">Tanggal Pinjam</th>
			<th style="width: 120px;text-align: center; vertical-align: middle;">Tanggal Kembali</th>
			<th style="width: 150px;text-align: center; vertical-align: middle;">Terlambat/Denda</th>
			<th style="width: 50px;text-align: center; vertical-align: middle;">Status</th>
  	</tr>';
  	$no = 1;
  	foreach($semuaAnggota as $key => $value) {
			$denda = 1000;
			$tgl_dateline = $value['tgl_kembali'];
			$tgl_kembali = date('d-m-Y');
			
			$lambat = terlambat($tgl_dateline, $tgl_kembali);
			$denda1 = $lambat * $denda;
			
			if($lambat > 0) {
				$terlambat = $lambat .' hari / Rp. '. number_format($denda1);
			} else {
				$terlambat = "$lambat Hari";
			}
  		$html .= '
							<tr>
								<td>'. $no++ .'</td>
								<td>'. $value["nim"] .'</td>
								<td>'. $value["judul_buku"] .'</td>
								<td>'. $value["tgl_pinjam"] .'</td>
								<td>'. $value["tgl_kembali"] .'</td>
								<td style="color:red;">'. $terlambat. '</td>
								<td>'. $value["status"] .'</td>
							</tr>
  					';
  	}
$html .= '
</table>
</body>
</html>';

$html2pdf->writeHTML($html);
ob_end_clean();
$html2pdf->output();


?>
