<!-- Modal Tambah Data -->
<div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="POST">
                <div class="modal-body">
                    <?php
                    $nik_pas = $_SESSION['pasien_nik'];
                    ?>
                    <input type="hidden" name="nik_pasien" value="<?= $nik_pas; ?>">

                    <label>Keluhan<span class="text-danger">*</span></label>
                    <input type="text" name="sakit" placeholder="Keluhan" class="form-control" required>
                    <br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnew">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>