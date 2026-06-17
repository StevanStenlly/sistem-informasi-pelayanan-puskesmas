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

                    <label>Nama Ruang</label>
                    <input type="text" name="nama_ruang" placeholder="Nama" class="form-control" required>
                    <br>

                    <div class="form-group">
                        <label for="tipe_ruang">Tipe Ruang</label>
                        <select class="form-control form-select" name="tipe_ruang" required>
                            <option value="pelayanan">Pelayanan</option>
                            <option value="internal">Internal</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewruang">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>