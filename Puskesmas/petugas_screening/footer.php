<!-- footer.php -->
<footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright <strong><span>PUSKESMAS KUMPAI BATU ATAS</span></strong>. All Rights Reserved
  </div>
  <div class="credits">
    <!-- Template by BootstrapMade -->
    <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>
</footer>

<!-- jQuery dan Bootstrap Bundle -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Script Notifikasi Pasien Baru -->
<script>
  $(document).ready(function() {
    const notificationCount = $('#notification-count');
    checkNewPatients();

    async function checkNewPatients() {
      try {
        const response = await fetch('../api/check_new_patients.php');
        const data = await response.json();

        if (data.new_patients && data.new_patients.length > 0) {
          notificationCount.show().text(data.new_patients.length);
        } else {
          notificationCount.hide();
        }
      } catch (error) {
        console.error("Gagal memuat notifikasi pasien baru:", error);
      }
    }

    // Memantau perubahan status pasien (Sudah Diperiksa)
    $(document).on("click", ".btn-simpan", function() {
      const row = $(this).closest("tr");
      const status = row.find(".status-screening").text().trim();

      if (status === "Sudah Diperiksa") {
        notificationCount.hide();
        notificationCount.text("0");
      }
    });
  });
</script>