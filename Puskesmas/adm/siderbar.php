<?php $page = basename($_SERVER['PHP_SELF']); ?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?= $page == 'index.php' ? '' : 'collapsed'; ?>" href="../Dashboard/index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <?php
    // Submenu Kelola Data Pengguna (aktif jika halaman dokter, petugas, pasien)
    $penggunaPages = ['tabel-dokter.php', 'tabel-petugas.php', 'tabel-pasien.php'];
    $isPenggunaActive = in_array($page, $penggunaPages);
    ?>

    <li class="nav-item">
      <a class="nav-link <?= $isPenggunaActive ? '' : 'collapsed'; ?>" data-bs-target="#dokter-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Kelola Data Pengguna</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="dokter-nav" class="nav-content collapse <?= $isPenggunaActive ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
        <li>
          <a href="../Kelola_Dokter/tabel-dokter.php" class="<?= $page == 'tabel-dokter.php' ? 'active' : ''; ?>">
            <i class="bi bi-circle"></i><span>Kelola Data Dokter</span>
          </a>
        </li>
        <li>
          <a href="../Kelola_Petugas/tabel-petugas.php" class="<?= $page == 'tabel-petugas.php' ? 'active' : ''; ?>">
            <i class="bi bi-circle"></i><span>Kelola Data Petugas</span>
          </a>
        </li>
        <li>
          <a href="../Kelola_Pasien/tabel-pasien.php" class="<?= $page == 'tabel-pasien.php' ? 'active' : ''; ?>">
            <i class="bi bi-circle"></i><span>Kelola Data Pasien</span>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'laporan.php' ? 'active' : 'collapsed'; ?>" href="../Kelola_Laporan/laporan.php">
        <i class="bi bi-file-earmark-bar-graph"></i>
        <span>Kelola Laporan</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'tabel-ruang.php' ? 'active' : 'collapsed'; ?>" href="../Kelola_Ruang/tabel-ruang.php">
        <i class="bi bi-building"></i>
        <span>Kelola Ruang</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'users-profile.php' ? 'active' : 'collapsed'; ?>" href="../Profil_Admin/users-profile.php">
        <i class="bi bi-person"></i>
        <span>Profil Admin</span>
      </a>
    </li>

  </ul>

</aside><!-- End Sidebar -->