<!-- The Modal -->
<div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form Tambah Data Screening -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Hidden input tanggal otomatis -->
                    <input type="hidden" name="tgl_pemeriksaan" value="<?= date('Y-m-d'); ?>">

                    <!-- Select NIK Pasien -->
                    <div class="mb-3">
                        <label for="nik_pasien" class="form-label">NIK Pasien<span class="text-danger">*</span></label>
                        <select id="nik_pasien" name="nik_pasien" class="form-select" style="width: 100%;" required></select>
                    </div>

                    <!-- Input Keluhan -->
                    <div class="mb-3">
                        <label for="sakit" class="form-label">Keluhan<span class="text-danger">*</span></label>
                        <input type="text" name="sakit" id="sakit" class="form-control" placeholder="Keluhan" required>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewscreening">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>