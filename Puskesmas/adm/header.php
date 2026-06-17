<?php
session_start(); //memulai apabila ada login
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

//jika tidak ada login sebelumnya maka diarahkan ke login.php
if (empty($_SESSION['admin_id']) and empty($_SESSION['password_admin'])) {
  echo "<script> window.location = '../login/login-admin.php' </script>";
};

?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="../img/logo_pkm.jpg" width="50" height="50">
      <span class="d-none d-lg-block">Admin Puskesmas Kumpai Batu Atas</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn collapsed"></i>
  </div>


  <nav class="header-nav ms-auto">


    <?php
    $id_adm = $_SESSION['admin_id'];

    $tampiladmin = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin='$id_adm'");
    while ($data = mysqli_fetch_array($tampiladmin)) :
    ?>
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../Profil_Admin/img/<?php echo $data['foto_admin']; ?>" alt="<?php echo $data['foto_admin']; ?>" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $data['username_admin']; ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $data['username_admin']; ?></h6>
              <span>Admin Puskesmas</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../Profil_Admin/users-profile.php">
                <i class="bi bi-person"></i>
                <span>Profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
            </li>

          </ul>

        </li>

      </ul>

    <?php
    endwhile;
    ?>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->