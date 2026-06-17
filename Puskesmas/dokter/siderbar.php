<?php
$page = basename($_SERVER['PHP_SELF']);
$hp_pages = ['tabel-hp.php', 'detail-hp.php', 'form-hp.php', 'edit-hp.php'];
$pasien_pages = ['tabel-pasien.php', 'edit-pasien.php'];
?>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
  <?php
  $id_ru = $_SESSION['ruang_id'];
  // Ambil jumlah resep yang belum diberikan
  $queryNotif = "SELECT COUNT(DISTINCT id_rm) AS jumlah FROM rekam_medis WHERE status_dokter = 'Belum Diperiksa' and id_ruang = '$id_ru'";
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
      <a class="nav-link <?= in_array($page, $hp_pages) ? 'active' : 'collapsed'; ?>" href="../Hasil_Pemeriksaan/tabel-hp.php">
        <i class="bi bi-clipboard2-pulse"></i>
        <span>Kelola Hasil Pemeriksaan</span>
        <?php if ($jumlahNotif > 0): ?>
          <span class="badge bg-danger ms-2"><?= $jumlahNotif ?></span>
        <?php endif; ?>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'laporan.php' ? 'active' : 'collapsed'; ?>" href="../Laporan/laporan.php">
        <i class="bi bi-file-earmark-text"></i>
        <span>Laporan Hasil Pemeriksaan</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= in_array($page, $pasien_pages) ? 'active' : 'collapsed'; ?>" href="../Rekam_Medis/tabel-pasien.php">
        <i class="bi bi-person-vcard"></i>
        <span>Data Pasien</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $page == 'users-profile.php' ? 'active' : 'collapsed'; ?>" href="../Profil_Dokter/users-profile.php">
        <i class="bi bi-person"></i>
        <span>Profil Dokter</span>
      </a>
    </li>

  </ul>
</aside>