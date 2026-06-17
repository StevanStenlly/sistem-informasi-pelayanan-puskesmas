<div class="tab-pane fade profile-edit pt-3" id="profile-edit">

    <!-- Profile Edit Form -->
    <form action="" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="tgl_lahir_pasien" value="<?= $tgl_lahir_pasien; ?>">

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tanggal Pemeriksaan<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="tgl_pemeriksaan" type="date" class="form-control" id="fullName" value="<?= $tgl_pemeriksaan; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="id_ruang" class="col-md-4 col-lg-3 col-form-label">Ruang Pelayanan<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control form-select" name="id_ruang" id="id_ruang" required>
                    <?php if (empty($id_ruang)): ?>
                        <option disabled selected value="">-- Pilih Ruang --</option>
                    <?php endif; ?>

                    <?php
                    $ruang_query = mysqli_query($conn, "SELECT * FROM ruang WHERE tipe_ruang = 'pelayanan' ORDER BY nama_ruang ASC");
                    while ($r = mysqli_fetch_assoc($ruang_query)) {
                        $selected = ($r['id_ruang'] == $id_ruang) ? 'selected' : '';
                        echo "<option value='{$r['id_ruang']}' $selected>{$r['nama_ruang']}</option>";
                    }
                    ?>
                </select>

            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label ">Nama Petugas</label>
            <div class="col-md-8 col-lg-9">
                <?php
                $nip_pet = $_SESSION['screening_nip'];

                $ambilsemuapetugas = mysqli_query($conn, "SELECT * FROM petugas WHERE nip_petugas='$nip_pet'");
                ($data = mysqli_fetch_array($ambilsemuapetugas))
                ?>
                <input type="hidden" name="nip_petugas" value="<?php echo $data['nip_petugas']; ?>">
                <div style="background-color:#e9ecef;" type="text" class="form-control" id="fullName"><?php echo $data['nama_petugas']; ?></div>

                <?php

                ?>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nyeri Telan<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control form-select" name="nyeri_telan" required>
                    <option value="Ya" <?= $nyeri_telan == 'Ya' ? 'selected' : '' ?>>Ya</option>
                    <option value="Tidak" <?= $nyeri_telan == 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                </select>
            </div>
        </div>

        <!-- Demam -->
        <div class="row mb-3">
            <label for="demam" class="col-md-4 col-lg-3 col-form-label">Demam<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control form-select" name="demam" required>
                    <option value="Ya" <?= $demam == 'Ya' ? 'selected' : '' ?>>Ya</option>
                    <option value="Tidak" <?= $demam == 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                </select>
            </div>
        </div>

        <!-- Batuk -->
        <div class="row mb-3">
            <label for="batuk" class="col-md-4 col-lg-3 col-form-label">Batuk<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control form-select" name="batuk" required>
                    <option value="Ya" <?= $batuk == 'Ya' ? 'selected' : '' ?>>Ya</option>
                    <option value="Tidak" <?= $batuk == 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                </select>
            </div>
        </div>

        <!-- Pilek -->
        <div class="row mb-3">
            <label for="pilek" class="col-md-4 col-lg-3 col-form-label">Pilek<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control form-select" name="pilek" required>
                    <option value="Ya" <?= $pilek == 'Ya' ? 'selected' : '' ?>>Ya</option>
                    <option value="Tidak" <?= $pilek == 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">TD (Tensi Darah)<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="tekanan_darah" type="text" class="form-control" id="fullName" value="<?= $tekanan_darah; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">N (Nadi)<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="nadi" type="text" class="form-control" id="fullName" value="<?= $nadi; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">RR (Laju Pernapasan)<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="siklus_nafas" type="text" class="form-control" id="fullName" value="<?= $siklus_nafas; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">T (Temperature)<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="suhu_badan" type="text" class="form-control" id="fullName" value="<?= $suhu_badan; ?>" required>
            </div>
        </div>

        <!-- Pasien -->
        <div class="row mb-3">
            <label class="col-md-4 col-lg-3 col-form-label">TB (Tinggi Badan)<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="tinggi_badan" type="text" class="form-control" value="<?= $tinggi_badan; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-lg-3 col-form-label">LP (Lingkar Perut)<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="lingkar_perut" type="text" class="form-control" value="<?= $lingkar_perut; ?>" required>
            </div>
        </div>

        <div class="col-md-4 col-lg-3 col-form-label ">(LK/LD untuk anak-anak)</div>

        <div class="row mb-3">
            <label class="col-md-4 col-lg-3 col-form-label">LK (Lingkar Kepala)<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="lingkar_kepala" type="text" class="form-control" value="<?= $lingkar_kepala; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-lg-3 col-form-label">LD (Lingkar Dada)<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="lingkar_dada" type="text" class="form-control" value="<?= $lingkar_dada; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-lg-3 col-form-label">BB (Berat Badan)<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="berat_badan" type="text" class="form-control" value="<?= $berat_badan; ?>" required>
            </div>
        </div>


        <!-- Resiko Jatuh -->
        <div class="row mb-3">
            <label for="resiko_jatuh" class="col-md-4 col-lg-3 col-form-label">Resiko Jatuh<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <select class="form-control form-select" name="resiko_jatuh" required>
                    <option value="Ya" <?= $resiko_jatuh == 'Ya' ? 'selected' : '' ?>>Ya</option>
                    <option value="Tidak" <?= $resiko_jatuh == 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Keterangan<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="keterangan_screening" type="text" class="form-control" id="fullName" value="<?= $keterangan_screening; ?>" required>
            </div>
        </div>

        <div class="text-center">
            <!-- Hidden -->
            <input type="hidden" name="nik_pasien" value="<?= $nik_pasien ?>">
            <input type="hidden" name="id_rm" value="<?= $id_rm ?>">

            <button type="submit" class="btn btn-primary" name="updatepasien">Simpan Perubahan</button>
        </div>

    </form><!-- End Profile Edit Form -->

</div>