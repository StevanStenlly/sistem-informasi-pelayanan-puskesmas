<!-- Update Modal -->
<div class="modal fade" id="updatescreening<?= $id_rm; ?>">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <label>Tanggal</label>
                    <input type="date" name="tgl_pemeriksaan" value="<?= $tgl_pemeriksaan; ?>">
                    <br>
                    <br>

                    <label>NIK Pasien</label>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <select class="form-control" name="nik_pasien">
                                <option value="<?= $nik_pasien; ?>"><?= $nik_pasien; ?></option>

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
                    <input type="text" name="sakit" value="<?= $sakit; ?>" placeholder="Keluhan" class="form-control">
                    <br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <input type="hidden" name="idd" value="<?= $idd; ?>">
                    <button type="submit" class="btn btn-primary" name="updatedokter">Perbarui</button>
                </div>
            </form>

        </div>
    </div>
</div>