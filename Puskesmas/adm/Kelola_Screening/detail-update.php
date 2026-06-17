<div class="tab-pane fade profile-edit pt-3" id="profile-edit">

    <!-- Profile Edit Form -->
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tanggal Pemeriksaan</label>
            <div class="col-md-8 col-lg-9">
                <input name="tgl_pemeriksaan" type="date" class="form-control" id="fullName" value="<?= $tgl_pemeriksaan; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Ruang Pelayanan</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control" name="id_ruang">
                    <option value="<?= $id_ruang; ?>"><?= $nama_ruang; ?></option>

                    <?php
                    $ambilsemuaruang = mysqli_query($conn, "SELECT * FROM ruang");
                    while ($data = mysqli_fetch_array($ambilsemuaruang)) {
                    ?>
                        <option value="<?php echo $data['id_ruang']; ?>"><?php echo $data['nama_ruang']; ?></option>
                    <?php
                    };
                    ?>

                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Petugas</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control" name="nip_petugas">
                    <option value="<?= $nip_petugas; ?>"><?= $nama_petugas; ?></option>

                    <?php
                    $ambilsemuapetugas = mysqli_query($conn, "SELECT * FROM petugas");
                    while ($data = mysqli_fetch_array($ambilsemuapetugas)) {
                    ?>
                        <option value="<?php echo $data['nip_petugas']; ?>"><?php echo $data['nama_petugas']; ?></option>
                    <?php
                    };
                    ?>

                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nyeri Telan</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control" name="nyeri_telan">
                    <option value="<?= $nyeri_telan; ?>"><?= $nyeri_telan; ?></option>
                    <option value=" "> </option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Demam</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control" name="demam">
                    <option value="<?= $demam; ?>"><?= $demam; ?></option>
                    <option value=" "> </option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Batuk</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control" name="batuk">
                    <option value="<?= $batuk; ?>"><?= $batuk; ?></option>
                    <option value=" "> </option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Pilek</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control" name="pilek">
                    <option value="<?= $pilek; ?>"><?= $pilek; ?></option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">TD</label>
            <div class="col-md-8 col-lg-9">
                <input name="tekanan_darah" type="text" class="form-control" id="fullName" value="<?= $tekanan_darah; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">N</label>
            <div class="col-md-8 col-lg-9">
                <input name="nadi" type="text" class="form-control" id="fullName" value="<?= $nadi; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">RR</label>
            <div class="col-md-8 col-lg-9">
                <input name="siklus_nafas" type="text" class="form-control" id="fullName" value="<?= $siklus_nafas; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">T (Suhu)</label>
            <div class="col-md-8 col-lg-9">
                <input name="suhu_badan" type="text" class="form-control" id="fullName" value="<?= $suhu_badan; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">TB</label>
            <div class="col-md-8 col-lg-9">
                <input name="tinggi_badan" type="text" class="form-control" id="fullName" value="<?= $tinggi_badan; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">LP</label>
            <div class="col-md-8 col-lg-9">
                <input name="lingkar_perut" type="text" class="form-control" id="fullName" value="<?= $lingkar_perut; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">LK</label>
            <div class="col-md-8 col-lg-9">
                <input name="lingkar_kepala" type="text" class="form-control" id="fullName" value="<?= $lingkar_kepala; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">LD</label>
            <div class="col-md-8 col-lg-9">
                <input name="lingkar_dada" type="text" class="form-control" id="fullName" value="<?= $lingkar_dada; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">BB</label>
            <div class="col-md-8 col-lg-9">
                <input name="berat_badan" type="text" class="form-control" id="fullName" value="<?= $berat_badan; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Resiko Jatuh</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control" name="resiko_jatuh">
                    <option value="<?= $resiko_jatuh; ?>"><?= $resiko_jatuh; ?></option>
                    <option value=" "> </option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Keterangan</label>
            <div class="col-md-8 col-lg-9">
                <input name="keterangan_screening" type="text" class="form-control" id="fullName" value="<?= $keterangan_screening; ?>">
            </div>
        </div>

        <div class="text-center">
            <input type="hidden" name="id_rm" value="<?= $id_rm; ?>">
            <button type="submit" class="btn btn-primary" name="updatescreening">Simpan Perubahan</button>
        </div>
    </form><!-- End Profile Edit Form -->

</div>