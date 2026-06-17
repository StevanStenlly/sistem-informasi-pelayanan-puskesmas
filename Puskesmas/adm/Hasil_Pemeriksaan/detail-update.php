<div class="tab-pane fade profile-edit pt-3" id="profile-edit">

    <!-- Profile Edit Form -->
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Petugas</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control" name="nip_dokter">
                    <option value="<?= $nip_dokter; ?>"><?= $nama_dokter; ?></option>

                    <?php
                    $ambilsemuadokter = mysqli_query($conn, "SELECT * FROM dokter");
                    while ($data = mysqli_fetch_array($ambilsemuadokter)) {
                    ?>
                        <option value="<?php echo $data['nip_dokter']; ?>"><?php echo $data['nama_dokter']; ?></option>
                    <?php
                    };
                    ?>

                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">NO.Rekam Medis</label>
            <div class="col-md-8 col-lg-9">
                <input name="rm" type="text" class="form-control" id="fullName" value="<?= $rm; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">ICD 10</label>
            <div class="col-md-8 col-lg-9">
                <input name="ICD_10" type="text" class="form-control" id="fullName" value="<?= $ICD_10; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Penyakit</label>
            <div class="col-md-8 col-lg-9">
                <input name="nama_penyakit" type="text" class="form-control" id="fullName" value="<?= $nama_penyakit; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Keterangan</label>
            <div class="col-md-8 col-lg-9">
                <input name="keterangan_hasil" type="text" class="form-control" id="fullName" value="<?= $keterangan_hasil; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Resep Obat</label>
            <div class="col-md-8 col-lg-9">
                <input name="resep_obat" type="text" class="form-control" id="fullName" value="<?= $resep_obat; ?>">
            </div>
        </div>

        <div class="text-center">
            <input type="hidden" name="id_hasil" value="<?= $id_hasil; ?>">
            <button type="submit" class="btn btn-primary" name="updatehasil">Simpan Perubahan</button>
        </div>
    </form><!-- End Profile Edit Form -->

</div>