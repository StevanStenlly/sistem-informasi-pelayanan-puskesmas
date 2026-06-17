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
                    <input type="date" name="tgl_pemeriksaan" value="<?php echo date("Y-m-d"); ?>">
                    <br>
                    <br>

                    <label>NIK Pasien</label>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <select class="form-control" name="nik_pasien" required>
                                <option value="">- Pilih -</option>

                                <?php
                                $ambilsemuapasien = mysqli_query($conn, "SELECT * FROM pasien");
                                while ($data = mysqli_fetch_array($ambilsemuapasien)) {
                                ?>
                                    <option value="<?php echo $data['nik_pasien']; ?>"><?php echo $data['nik_pasien']; ?></option>
                                <?php
                                };
                                ?>

                            </select>
                        </div>
                    </div>
                    <br>

                    <label>Keluhan</label>
                    <input type="text" name="sakit" placeholder="Keluhan" class="form-control" required>
                    <br>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewscreening">Tambah</button>
                </div>



            </form>

        </div>
    </div>
</div>