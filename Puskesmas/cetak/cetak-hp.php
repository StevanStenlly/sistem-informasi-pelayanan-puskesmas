<?php

include('../koneksi.php');
$id_rm = $_GET['id_rm'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


  <meta charset="utf-8">
  <title>HASIL PEMERIKSAAN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="bootstrap.min.css" rel="stylesheet" media="screen">

  <!-- css yang digunakan ketika dalam mode screen -->
  <link href="style.css" rel="stylesheet" media="screen">

  <!-- ss yang digunakan tampilkan ketika dalam mode print -->
  <link href="print.css" rel="stylesheet" media="print">

  <script src="jquery-1.8.3.min.js"></script>
  <script src="jquery.PrintArea.js"></script>
  <script>
    (function($) {
      // fungsi dijalankan setelah seluruh dokumen ditampilkan
      $(document).ready(function(e) {

        // aksi ketika tombol cetak ditekan
        $("#cetak").bind("click", function(event) {
          // cetak data pada area <div id="#data-hp"></div>
          $('#data-pasien').printArea();
        });
      });
    })(jQuery);
  </script>
  <style type="text/css">
  </style>
</head>

<body>


  <div class="container">
    <div class="row">






      <!-- Profile -->

      <div class="card card-primary card-outline">
        <div id="data-pasien">
          <center>
            <img src="pkm.png" width="886" height="182" alt="GAMBAR KOP">
          </center>

          <br>
          <br>
          <div class="card-body box-profile">
            <div class="text-center">
            </div>
            <?php
            $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM rekam_medis a left join ruang c on a.id_ruang=c.id_ruang 
            left join pasien d on a.nik_pasien=d.nik_pasien left join dokter e on a.nip_dokter=e.nip_dokter 
            WHERE a.id_rm='$id_rm'");

            ?>

            <center>
              <h3 class="text-muted text-center"> <b>HASIL PEMERIKSAAN</b></h3>
            </center>
            <?php
            $data = mysqli_fetch_array($ambilsemuahasil);

            ?>
            <table style="width: 687px;">
              <tbody>
                <table style="width: 687px;">
                  <tbody>
                    <tr>
                      <td style="width: 600px;">&nbsp;Nama Pasien</td>
                      <td style="width: 10px;">&nbsp;:</td>
                      <td style="width: 2183px;">&nbsp;<?php echo $data['nama_pasien']; ?></td>
                      <td style="width: 12px;">&nbsp;</td>
                      <td style="width: 22px;">&nbsp;</td>
                      <td style="width: 800px;">No.Rekam Medis&nbsp;</td>
                      <td style="width: 55px;">&nbsp;:</td>
                      <td style="width: 1000px;">&nbsp;K-<?php echo $data['rm']; ?></td>

                    </tr>
                    <tr>
                      <td style="width: 600px;">&nbsp;NIK</td>
                      <td style="width: 10px;">&nbsp;:</td>
                      <td style="width: 2183px;">&nbsp;<?php echo $data['nik_pasien']; ?></td>
                      <td style="width: 12px;">&nbsp;</td>
                      <td style="width: 22px;">&nbsp;</td>
                      <td style="width: 600px;">Alamat&nbsp;</td>
                      <td style="width: 55px;">&nbsp;:</td>
                      <td style="width: 1000px;">&nbsp;<?php echo $data['alamat_pasien']; ?></td>

                    </tr>
                  </tbody>
                </table>
                <!-- DivTable.com -->
              </tbody>
            </table>
            <!-- DivTable.com -->

            <br>

            <!-- /.card-header -->
            <div class="col-md-12">
              <h5 class="card-title">Detail Hasil Pemeriksaan</h5>
              <div class="card-body">
                <table style="width: 667px; height: 221px;">
                  <tbody>
                    <tr>
                      <td style="width: 348.083px;">Tanggal Pemeriksaan</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['tgl_pemeriksaan']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">Tempat Tanggal Lahir</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['ttl_pasien']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">Jenis Kelamin</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['jk_pasien']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">TD</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['tekanan_darah']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">N</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['nadi']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">RR</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['siklus_nafas']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">T (Suhu)</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['suhu_badan']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">TB</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['tinggi_badan']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">LP</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['lingkar_perut']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">LK</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['lingkar_kepala']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">LD</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['lingkar_dada']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">BB</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['berat_badan']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">ICD 10</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['ICD_10']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">Nama Penyakit</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['nama_penyakit']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">Keterangan</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['keterangan_hasil']; ?></td>
                    </tr>
                    <tr>
                      <td style="width: 348.083px;">Resep Obat</td>
                      <td style="width: 14.9167px;">:</td>
                      <td style="width: 323px;"><?php echo $data['resep_obat']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.card-body -->
        <button id="cetak" class="btn btn-primary btn-block">Cetak</button>
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- jQuery -->
  <script src="../admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../admin/dist/js/demo.js"></script>
</body>

</html>