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
                    <label>Nama Obat</label>
                    <input type="text" name="nama_obat" placeholder="Nama Obat" class="form-control" required>
                    <br>
                    <label>Dosis Obat</label>
                    <input type="text" name="dosis_obat" placeholder="Dosis Obat" class="form-control" required>
                    <br>

                    <label>Keterangan Obat</label>
                    <input type="text" name="keterangan_obat" placeholder="Keterangan Obat" class="form-control" required>
                    <br>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewobat">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>