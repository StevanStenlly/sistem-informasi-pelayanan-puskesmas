<?php
session_name("PASIEN_SESSION");
session_start(); //memulai apabila ada login
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

//jika tidak ada login sebelumnya maka diarahkan ke login.php
if ($_SESSION['role'] !== 'pasien' || empty($_SESSION['pasien_nik'])) {
    echo "<script> window.location = '../login/login-pasien.php' </script>";
    exit();
}

$limit = 9; // jumlah pengumuman per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// pencarian
$search = isset($_GET['search']) ? $_GET['search'] : "";
$searchQuery = $search ? "WHERE judul_pengumuman LIKE '%$search%'" : "";

// hitung total data
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengumuman $searchQuery"));
$pages = ceil($total / $limit);

// ambil data dengan limit
$query = "SELECT * FROM pengumuman $searchQuery ORDER BY tgl_pengumuman DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $query);

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


        <div class="pagetitle">
            <h1>Pengumuman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">pengumuman</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari judul pengumuman..." value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <section class="inner-page">

            <div class="row">
                <?php
                date_default_timezone_set("Asia/Jakarta");
                $tgl_sekarang = date("Y-m-d");

                while ($data = mysqli_fetch_array($result)) {
                    $selisih = (strtotime($tgl_sekarang) - strtotime($data["tgl_pengumuman"])) / (60 * 60 * 24);
                    $isBaru = $selisih <= 7;
                ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm <?php echo $isBaru ? 'border-primary' : ''; ?>">
                            <div class="position-relative">
                                <img src="../../adm/Kelola_Pengumuman/img/<?php echo $data["foto_pengumuman"]; ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                                <?php if ($isBaru): ?>
                                    <span class="badge bg-primary position-absolute top-0 start-0 m-2">Baru</span>
                                <?php endif; ?>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data["judul_pengumuman"]; ?></h5>
                                <p class="card-text"><?php echo substr(strip_tags($data["keterangan_pengumuman"]), 0, 100); ?>...</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <small class="text-muted">Tanggal: <?php echo $data["tgl_pengumuman"]; ?></small>
                                <a href="detail.php?id_pengumuman=<?php echo $data["id_pengumuman"]; ?>" class="btn btn-sm btn-outline-primary">Lihat</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>

        </section>

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