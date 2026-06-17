<!-- The Modal -->
<div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Tanggal</label>
                    <br>
                    <input type="date" name="tgl_pengumuman" value="<?php echo date("Y-m-d"); ?>">
                    <br>
                    <br>

                    <label>Gambar Pengumuman</label>
                    <br>
                    <input type="file" name="foto_pengumuman" class="form-control-file" required>
                    <br>
                    <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
                    <br>
                    <br>

                    <label>Judul</label>
                    <input type="text" name="judul_pengumuman" placeholder="Judul" class="form-control" required>
                    <br>

                    <label>Keterangan</label>
                    <textarea type="text" name="keterangan_pengumuman" rows="4" class="form-control" required></textarea>
                    <br>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewpengumuman">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>