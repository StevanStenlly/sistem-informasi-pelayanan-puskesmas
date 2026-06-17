<!-- Update Modal -->
<div class="modal fade" id="updateobat<?= $ido; ?>">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Data Obat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Kode Obat</label>
                    <input type="text" name="kode_obat" value="<?= $ido; ?>" class="form-control" style="background-color:#e9ecef;" readonly>
                    <br>

                    <label>Nama Obat<span class="text-danger">*</span></label>
                    <input type="text" name="nama_obat" value="<?= $nama_obat; ?>" class="form-control" required>
                    <br>

                    <label>Dosis Obat<span class="text-danger">*</span></label>
                    <input type="text" name="dosis_obat" value="<?= $dosis_obat; ?>" class="form-control" required>
                    <br>

                    <label>Satuan<span class="text-danger">*</span></label>
                    <input type="text" name="satuan" value="<?= $data['satuan']; ?>" class="form-control" required>
                    <br>

                    <label>Stok Obat<span class="text-danger">*</span></label>
                    <input type="number" name="stok_obat" value="<?= $data['stok_obat']; ?>" class="form-control" required>
                    <br>

                    <label>Minimum Stok<span class="text-danger">*</span></label>
                    <input type="number" name="minimum_stok" value="<?= $data['minimum_stok']; ?>" class="form-control" required>
                    <br>

                    <label>Tanggal Kadaluarsa<span class="text-danger">*</span></label>
                    <input type="date" name="tgl_kadaluarsa" value="<?= $data['tgl_kadaluarsa']; ?>" class="form-control">
                    <br>

                    <label>Keterangan Obat<span class="text-danger">*</span></label>
                    <input type="text" name="keterangan_obat" value="<?= $keterangan_obat; ?>" class="form-control" required>
                    <br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <input type="hidden" name="ido" value="<?= $ido; ?>">
                    <button type="submit" class="btn btn-primary" name="updateobat">Perbarui</button>
                </div>
            </form>

        </div>
    </div>
</div>