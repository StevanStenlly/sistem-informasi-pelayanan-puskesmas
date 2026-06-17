<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <?php
  $page = basename($_SERVER['PHP_SELF']);
  $profil_pages = ['users-profile.php'];
  $pelayanan_pages = ['pelayanan_kesehatan.php', 'riwayat_pelayanan.php'];
  $pengumuman_pages = ['pengumuman.php', 'detail.php']; // file pengumuman
  ?>

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?= $page == 'index.php' ? '' : 'collapsed'; ?>" href="../Dashboard/index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= in_array($page, $profil_pages) ? 'active' : 'collapsed'; ?>" href="../Profil_Pasien/users-profile.php">
        <i class="bi bi-person"></i>
        <span>Profil Pasien</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= in_array($page, $pelayanan_pages) ? 'active' : 'collapsed'; ?>" href="../Pelayanan_Kesehatan/pelayanan_kesehatan.php">
        <i class="bi bi-heart-pulse"></i>
        <span>Pelayanan Kesehatan</span>
      </a>
    </li>

  </ul>

</aside><!-- End Sidebar -->