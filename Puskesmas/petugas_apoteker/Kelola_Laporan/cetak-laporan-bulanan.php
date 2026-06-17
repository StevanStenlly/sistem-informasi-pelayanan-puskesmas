<?php
require_once __DIR__ . '/../../vendor/autoload.php';
include "../../koneksi.php";

use Mpdf\Mpdf;

$bulan = $_GET['bulan'] ?? date('m');
$tahun = $_GET['tahun'] ?? date('Y');
$tanggal_awal = "$tahun-$bulan-01";
$tanggal_akhir = date("Y-m-t", strtotime($tanggal_awal));

$nama_bulan_indonesia = [
  1 => 'Januari',
  2 => 'Februari',
  3 => 'Maret',
  4 => 'April',
  5 => 'Mei',
  6 => 'Juni',
  7 => 'Juli',
  8 => 'Agustus',
  9 => 'September',
  10 => 'Oktober',
  11 => 'November',
  12 => 'Desember'
];

$jumlah_kunjungan = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM rekam_medis WHERE tgl_pemeriksaan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"))[0];
$jumlah_resep = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM resep_obat ro JOIN rekam_medis rm ON ro.id_rm = rm.id_rm WHERE rm.tgl_pemeriksaan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"))[0];
$obat_masuk = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(jumlah_masuk) FROM obat_masuk WHERE tanggal_masuk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"))[0] ?? 0;
$distribusi_obat = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(ro.jumlah) FROM distribusi_obat d JOIN resep_obat ro ON d.id_resep = ro.id_resep WHERE d.tgl_distribusi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"))[0] ?? 0;

$html = '
<style>
  body { font-family: sans-serif; }
  h2, h4 { text-align: center; }
  table { width: 100%; border-collapse: collapse; margin-top: 10px; }
  td, th { padding: 6px; vertical-align: top; }
  .bordered td, .bordered th { border: 1px solid #000; }
</style>

<div style="text-align: center;">
  <img src="../../img/pkm.png" width="886" height="182" alt="GAMBAR KOP">
</div>

<h4>Laporan Bulanan - ' . $nama_bulan_indonesia[(int)$bulan] . ' ' . $tahun . '</h4>

<table class="bordered">
  <tr><th>Jenis Laporan</th><th>Jumlah</th></tr>
  <tr><td>Jumlah Kunjungan Pasien</td><td>' . $jumlah_kunjungan . '</td></tr>
  <tr><td>Jumlah Resep Dikeluarkan</td><td>' . $jumlah_resep . '</td></tr>
  <tr><td>Total Obat Masuk</td><td>' . $obat_masuk . '</td></tr>
  <tr><td>Total Obat Didistribusikan</td><td>' . $distribusi_obat . '</td></tr>
</table>

<br><br><br>
<div style="text-align: right;">
  <p>Dicetak oleh Petugas Apoteker</p>
  <br><br><br>
  <p><u>' . ($_SESSION['apoteker_nama'] ?? '________________') . '</u></p>
  <p style="font-size: 11pt;">Tanggal: ' . date('d-m-Y') . '</p>
</div>';

$mpdf = new Mpdf(['format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output("Laporan_Bulanan_{$bulan}_{$tahun}.pdf", 'I');
