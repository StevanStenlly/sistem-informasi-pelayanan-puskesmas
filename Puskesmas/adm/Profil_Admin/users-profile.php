<?php
session_name("ADMIN_SESSION");
session_start(); //memulai apabila ada login
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

//jika tidak ada login sebelumnya maka diarahkan ke login.php
if ($_SESSION['role'] !== 'admin' || empty($_SESSION['admin_id'])) {
  echo "<script> window.location = '../login/login-admin.php' </script>";
  exit();
}

require 'function-admin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  include '../link.php';
  ?>

</head>

<body>

  <?php
  include '../header.php';
  include '../siderbar.php';
  ?>

  <main id="main" class="main">

    <?php
    $id_adm = $_SESSION['admin_id'];

    $tampiladmin = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin='$id_adm'");
    while ($data = mysqli_fetch_array($tampiladmin)) {
      $foto_admin = $data['foto_admin'];
      $username_admin = $data['username_admin'];
      $idad = $data['id_admin'];
      $password_admin = $data['password_admin'];
    ?>

      <div class="pagetitle">
        <h1>Profil Admin</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Profil Admin</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section profile">


        <div class="row">
          <div class="col-xl-4">

            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                <img src="img/<?php echo $data['foto_admin']; ?>" alt="<?php echo $data['foto_admin']; ?>" class="rounded-circle">
                <h2><?php echo $data['username_admin']; ?></h2>
                <h3>Admin Puskesmas</h3>

              </div>
            </div>

          </div>

          <div class="col-xl-8">

            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profil</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ubah Profile</button>
                  </li>

                </ul>

                <div class="tab-content pt-2">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Profil Detail</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Nama</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['username_admin']; ?></div>
                    </div>
                  </div>

                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                    <!-- Profile Edit Form -->
                    <form action="" method="POST" enctype="multipart/form-data">
                      <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Gambar Profile</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="file" name="foto_admin" value="<?= $foto_admin; ?>" class="form-control-file">
                          <br>
                          <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
                          <br>
                          <img src="img/<?= $foto_admin; ?>" alt="<?= $foto_admin; ?>" height="100" width="100">

                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Username</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="username_admin" type="text" class="form-control" id="fullName" value="<?= $username_admin; ?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="password_admin" type="text" class="form-control" id="fullName" value="<?= $password_admin; ?>">
                        </div>
                      </div>

                      <div class="text-center">
                        <input type="hidden" name="idad" value="<?= $idad; ?>">
                        <button type="submit" class="btn btn-primary" name="updateadmin">Simpan Perubahan</button>
                      </div>
                    </form><!-- End Profile Edit Form -->

                  </div>

                  <div class="tab-pane fade pt-3" id="profile-change-password">



                  </div><!-- End Bordered Tabs -->

                </div>
              </div>

            </div>
          </div>

      </section>

    <?php
    };
    ?>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include '../footer.php';
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>