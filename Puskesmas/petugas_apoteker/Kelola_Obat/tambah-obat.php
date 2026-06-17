<!-- Modal Tambah Obat -->
<div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="POST" action="function-obat.php">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <!-- Kode Obat otomatis di-backend, tidak ditampilkan -->

                    <div class="col-md-6">
                        <label class="form-label">Nama Obat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_obat" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Dosis Obat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="dosis_obat" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Satuan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="satuan" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Stok Obat<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="stok_obat" min="0" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Kadaluarsa<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tgl_kadaluarsa">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Keterangan<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="keterangan_obat"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" name="addnewobat" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>

        </div>
    </div>
</div>