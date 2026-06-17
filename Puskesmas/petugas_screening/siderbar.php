<!-- sidebar.php -->
<aside id="sidebar" class="sidebar">

  <?php $page = basename($_SERVER['PHP_SELF']); ?>

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?= $page == 'index.php' ? '' : 'collapsed'; ?>" href="../Dashboard/index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'tabel-screening.php' ? 'active' : 'collapsed'; ?>" href="../Kelola_Screening/tabel-screening.php">
        <i class="bi bi-journal-medical"></i>
        <span>Kelola Screening</span>
        <span class="badge bg-danger" id="notification-count" style="display: none;">0</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'riwayat_screening.php' ? 'active' : 'collapsed'; ?>" href="../Riwayat_Screening/riwayat_screening.php">
        <i class="bi bi-clock-history"></i>
        <span>Riwayat Screening</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'tabel-pasien.php' ? 'active' : 'collapsed'; ?>" href="../Kelola_Pasien/tabel-pasien.php">
        <i class="bi bi-people"></i>
        <span>Data Pasien</span>
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