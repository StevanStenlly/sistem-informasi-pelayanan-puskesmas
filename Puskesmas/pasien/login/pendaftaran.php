<?php
include "../../koneksi.php";
require "function-pasien.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  include 'link.php';
  ?>

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a class="logo d-flex align-items-center w-auto">
                  <img src="images/logo_pkm.jpg" alt="images/logo_pkm.jpg" height="250" width="250">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                    <p class="text-center small">Masukkan data Anda untuk membuat akun</p>
                  </div>

                  <form action="" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>

                    <input type="hidden" name="foto_pasien" value="foto.png">

                    <div class="col-12">
                      <label for="namaPasien" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                      <input type="text" name="nama_pasien" class="form-control" id="namaPasien" required>
                      <div class="invalid-feedback">Silakan masukkan Nama Anda!</div>
                    </div>

                    <div class="col-12">
                      <label for="nikPasien" class="form-label">NIK<span class="text-danger">*</span></label>
                      <input
                        type="text"
                        name="nik_pasien"
                        class="form-control"
                        id="nikPasien"
                        maxlength="16"
                        pattern="\d{16}"
                        inputmode="numeric"
                        required>
                      <div class="invalid-feedback">Silakan masukkan NIK Anda yang valid (16 digit angka)!</div>
                      <div id="nikFeedback" class="mt-1 text-danger small"></div>
                    </div>

                    <div class="col-12">
                      <label for="bpjs" class="form-label">BPJS<span class="text-danger">*</span></label>
                      <input type="text" name="bpjs" class="form-control" id="bpjs" required>
                      <div class="invalid-feedback">Silakan masukkan BPJS Anda!</div>
                    </div>

                    <div class="col-12">
                      <label for="noHpPasien" class="form-label">No.HP/Whatsapp Aktif<span class="text-danger">*</span></label>
                      <input type="text" name="no_hp_pasien" class="form-control" id="noHpPasien" placeholder="No.HP/Whatsapp Aktif" maxlength="14" inputmode="numeric" pattern="08\d{8,12}" required>
                      <div class="invalid-feedback">Nomor HP harus dimulai dengan 08 dan terdiri dari 10 hingga 14 digit angka.</div>
                    </div>

                    <div class="col-12">
                      <label for="passwordPasien" class="form-label">Password<span class="text-danger">*</span></label>
                      <input type="password" name="password_pasien" class="form-control" id="passwordPasien" minlength="8" maxlength="20" placeholder="Password" required>
                      <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="showPassword">
                        <label class="form-check-label" for="showPassword">Tampilkan Password</label>
                      </div>
                      <div class="invalid-feedback">Password harus 8-20 karakter.</div>
                      <div class="invalid-feedback">Silakan masukkan Password Anda!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="addnewpasien" id="submitBtn">Buat Akun</button>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">Sudah Punya Akun? <a href="login-pasien.php">Masuk</a></p>
                    </div>

                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    const nikInput = document.getElementById("nikPasien");
    const feedback = document.getElementById("nikFeedback");
    const submitBtn = document.getElementById("submitBtn");

    nikInput.addEventListener("input", function() {
      // Hapus semua karakter non-digit
      this.value = this.value.replace(/\D/g, '');

      const nik = this.value.trim();

      if (nik.length === 16) {
        // Cek apakah NIK sudah ada di database
        fetch("check_nik.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "nik=" + encodeURIComponent(nik)
          })
          .then(res => res.text())
          .then(data => {
            if (data === "exists") {
              feedback.innerHTML = "❌ NIK ini sudah terdaftar.";
              this.classList.add("is-invalid");
              this.classList.remove("is-valid");
              submitBtn.disabled = true;
            } else {
              feedback.innerHTML = "";
              this.classList.remove("is-invalid");
              this.classList.add("is-valid");
              submitBtn.disabled = false;
            }
          });
      } else {
        // Jika belum 16 digit, reset feedback & disable submit
        feedback.innerHTML = "";
        this.classList.remove("is-invalid", "is-valid");
        submitBtn.disabled = true;
      }
    });
  </script>

  <script>
    document.getElementById("noHpPasien").addEventListener("input", function() {
      this.value = this.value.replace(/\D/g, ''); // Hapus semua non-digit
    });
  </script>

  <script>
    const noHpInput = document.getElementById("noHpPasien");

    noHpInput.addEventListener("input", function() {
      // Hapus karakter non-angka
      this.value = this.value.replace(/\D/g, '');

      const valid = /^08\d{8,12}$/.test(this.value);

      if (this.value.length >= 10) {
        if (!valid) {
          this.classList.add("is-invalid");
        } else {
          this.classList.remove("is-invalid");
          this.classList.add("is-valid");
        }
      } else {
        this.classList.remove("is-invalid", "is-valid");
      }
    });
  </script>

  <script>
    document.getElementById("showPassword").addEventListener("change", function() {
      const type = this.checked ? "text" : "password";
      document.getElementById("passwordPasien").type = type;
    });
  </script>

</body>

</html>