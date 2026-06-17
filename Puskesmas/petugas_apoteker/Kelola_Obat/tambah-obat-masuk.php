<!-- Modal Tambah Obat Masuk -->
<div class="modal fade" id="ModalObatMasuk" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="POST" action="simpan-obat-masuk.php">
                <div class="modal-header">
                    <h5 class="modal-title">Catat Obat Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Pilih Obat<span class="text-danger">*</span></label>
                        <select name="kode_obat" class="form-select" required>
                            <option value="">-- Pilih Obat --</option>
                            <?php
                            $data_obat = mysqli_query($conn, "SELECT kode_obat, nama_obat FROM obat");
                            while ($obat = mysqli_fetch_assoc($data_obat)) {
                                echo "<option value='{$obat['kode_obat']}'>{$obat['kode_obat']} - {$obat['nama_obat']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jumlah Masuk<span class="text-danger">*</span></label>
                        <input type="number" name="jumlah_masuk" class="form-control" min="1" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Kadaluarsa Baru<span class="text-danger">*</span></label>
                        <input type="date" name="tgl_kadaluarsa" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>

        </div>
    </div>
</div>