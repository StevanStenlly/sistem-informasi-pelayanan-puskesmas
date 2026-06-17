<!-- ======= Sidebar ======= -->
<?php $page = basename($_SERVER['PHP_SELF']); ?>

<aside id="sidebar" class="sidebar">
  <?php
  // Ambil jumlah resep yang belum diberikan
  $queryNotif = "SELECT COUNT(DISTINCT id_rm) AS jumlah FROM resep_obat WHERE status = 'belum'";
  $resultNotif = mysqli_query($conn, $queryNotif);
  $jumlahNotif = 0;
  if ($resultNotif && mysqli_num_rows($resultNotif) > 0) {
    $rowNotif = mysqli_fetch_assoc($resultNotif);
    $jumlahNotif = $rowNotif['jumlah'];
  }
  ?>

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?= $page == 'index.php' ? '' : 'collapsed'; ?>" href="../Dashboard/index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'tabel-obat.php' ? 'active' : 'collapsed'; ?>" href="../Kelola_Obat/tabel-obat.php">
        <i class="bi bi-capsule-pill"></i>
        <span>Kelola Obat</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'daftar-resep.php' ? 'active' : 'collapsed'; ?>" href="../Kelola_Resep/daftar-resep.php">
        <i class="bi bi-file-earmark-medical"></i>
        <span>Resep Obat</span>
        <?php if ($jumlahNotif > 0): ?>
          <span class="badge bg-danger ms-2"><?= $jumlahNotif ?></span>
        <?php endif; ?>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link <?= $page == 'riwayat-distribusi.php' ? 'active' : 'collapsed'; ?>" href="../Kelola_Distribusi/riwayat-distribusi.php">
        <i class="bi bi-clock-history"></i>
        <span>Riwayat Distribusi</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'users-profile.php' ? 'active' : 'collapsed'; ?>" href="../Profil_Petugas/users-profile.php">
        <i class="bi bi-person"></i>
        <span>Profil Petugas</span>
      </a>
    </li>

  </ul>

</aside><!-- End Sidebar -->