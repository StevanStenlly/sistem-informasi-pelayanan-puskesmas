<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="../img/logo_pkm.jpg" width="50" height="50">
      <span class="d-none d-lg-block">Puskesmas Kumpai Batu Atas</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn collapsed"></i>
  </div>


  <nav class="header-nav ms-auto">


    <?php
    $nik_pas = $_SESSION['pasien_nik'];

    $tampilpasien = mysqli_query($conn, "SELECT * FROM pasien WHERE nik_pasien='$nik_pas'");
    $data = mysqli_fetch_array($tampilpasien);
    ?>
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="../../adm/Kelola_Pasien/img/<?php echo $data['foto_pasien'] ?? 'default.png'; ?>" alt="<?php echo $data['foto_pasien'] ?? 'default.jpg'; ?>" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $data['nama_pasien']; ?></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $data['nama_pasien']; ?></h6>
            <span>Pasien Puskesmas Kumpai Batu Atas</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="../Profil_Pasien/users-profile.php">
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

    <!-- End Icons Navigation -->

</header><!-- End Header -->