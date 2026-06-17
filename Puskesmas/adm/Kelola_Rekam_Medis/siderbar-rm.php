<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="../Dashboard/index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link" data-bs-target="#dokter-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Kelola Dokter</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="dokter-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
        <li>
          <a href="../Kelola_Dokter/tabel-dokter.php">
            <i class=" bi bi-circle"></i><span>Kelola Data Dokter</span>
          </a>
        </li>
        <li>
          <a href="../Hasil_Pemeriksaan/tabel-hp.php">
            <i class="bi bi-circle"></i><span>Hasil Pemeriksaan</span>
          </a>
        </li>
        <li>
          <a href="tabel-rm.php" class="active">
            <i class="bi bi-circle"></i><span>Rekam Medis</span>
          </a>
        </li>
      </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#petugas-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Kelola Petugas</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="petugas-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="../Kelola_Petugas/tabel-petugas.php">
            <i class="bi bi-circle"></i><span>Kelola Data Petugas</span>
          </a>
        </li>
        <li>
          <a href="../Kelola_Screening/tabel-screening.php">
            <i class="bi bi-circle"></i><span>Kelola Screening</span>
          </a>
        </li>
        <li>
          <a href="../Kelola_Apoteker/tabel-obat.php">
            <i class="bi bi-circle"></i><span>Kelola Obat</span>
          </a>
        </li>
      </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#pasien-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Kelola Pasien</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="pasien-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="../Kelola_Pasien/tabel-pasien.php">
            <i class="bi bi-circle"></i><span>Kelola Data Pasien</span>
          </a>
        </li>
        <li>
          <a href="../Kelola_Pengumuman/tabel-pengumuman.php">
            <i class="bi bi-circle"></i><span>Kelola Pengumuman</span>
          </a>
        </li>
      </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="../Kelola_Ruang/tabel-ruang.php">
        <i class="bi bi-layout-text-window-reverse"></i>
        <span>Kelola Ruang</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="../Profil_Admin/users-profile.php">
        <i class="bi bi-person"></i>
        <span>Profil Admin</span>
      </a>
    </li><!-- End Profile Page Nav -->

  </ul>

</aside><!-- End Sidebar-->