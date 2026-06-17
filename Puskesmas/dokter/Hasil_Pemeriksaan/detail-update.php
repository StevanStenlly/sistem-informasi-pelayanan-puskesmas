<div class="tab-pane fade profile-edit pt-3" id="profile-edit">

    <!-- Profile Edit Form -->
    <form action="function-hp.php" method="POST" enctype="multipart/form-data">

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label ">Nama Dokter</label>
            <div class="col-md-8 col-lg-9">
                <?php
                $nip_dok = $_SESSION['dokter_nip'];

                $ambilsemuapetugas = mysqli_query($conn, "SELECT * FROM dokter WHERE nip_dokter='$nip_dok'");
                ($data = mysqli_fetch_array($ambilsemuapetugas))
                ?>
                <input type="hidden" name="nip_dokter" value="<?php echo $data['nip_dokter']; ?>">
                <div style="background-color:#e9ecef;" type="text" class="form-control" id="fullName"><?php echo $data['nama_dokter']; ?></div>

                <?php

                ?>
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">ICD 10<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="ICD_10" type="text" class="form-control" id="fullName" value="<?= $ICD_10; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Penyakit<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="nama_penyakit" type="text" class="form-control" id="fullName" value="<?= $nama_penyakit; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Keterangan<span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
                <input name="keterangan_hasil" type="text" class="form-control" id="fullName" value="<?= $keterangan_hasil; ?>">
            </div>
        </div>

        <div class="text-center">
            <input type="hidden" name="id_rm" value="<?= $id_rm; ?>">
            <button type="submit" class="btn btn-primary" name="updatehasil">Simpan Pemeriksaan</button>
        </div>
    </form><!-- End Profile Edit Form -->

    <!-- FORM INPUT RESEP OBAT (AJAX) -->
    <h5 class="card-title mt-4">Tambah Resep Obat</h5>

    <div class="row mb-3">
        <label class="col-md-4 col-lg-3 col-form-label">Pilih Obat<span class="text-danger">*</span></label>
        <div class="col-md-8 col-lg-9">
            <select id="kode_obat_ajax" class="form-control form-select select2" style="width: 100%;">
                <option value="">-- Pilih Obat --</option>
                <?php
                $tanggal_sekarang = date('Y-m-d');
                $batas_kadaluarsa = date('Y-m-d', strtotime('+365 days')); // "akan kadaluarsa" dalam 1 tahun

                $obat = mysqli_query($conn, "
                    SELECT * FROM obat 
                    WHERE 
                        tgl_kadaluarsa > '$batas_kadaluarsa' 
                        AND stok_obat > minimum_stok
                ");
                while ($o = mysqli_fetch_array($obat)) {
                    echo "<option value='{$o['kode_obat']}'>{$o['nama_obat']} {$o['dosis_obat']} {$o['satuan']} (Stok: {$o['stok_obat']})</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-md-4 col-lg-3 col-form-label">Aturan Pemakaian<span class="text-danger">*</span></label>
        <div class="col-md-8 col-lg-9">
            <input type="text" id="dosis_ajax" class="form-control" placeholder="Contoh: 3 x 1 (setelah makan)">
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-md-4 col-lg-3 col-form-label">Jumlah Diberikan<span class="text-danger">*</span></label>
        <div class="col-md-8 col-lg-9">
            <input type="number" id="jumlah_ajax" class="form-control" min="1">
        </div>
    </div>

    <div class="text-center">
        <button type="button" class="btn btn-success" id="btnTambahObat">Tambah Obat</button>
    </div>

    <script>
        document.getElementById('btnTambahObat').addEventListener('click', function() {
            const id_rm = "<?= $id_rm ?>";
            const kode_obat = document.getElementById('kode_obat_ajax').value;
            const dosis = document.getElementById('dosis_ajax').value;
            const jumlah = document.getElementById('jumlah_ajax').value;

            if (!kode_obat || !dosis || !jumlah) {
                alert('Semua kolom harus diisi.');
                return;
            }

            fetch('function-hp.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        aksi: 'tambah_obat_ajax',
                        id_rm: id_rm,
                        kode_obat: kode_obat,
                        dosis: dosis,
                        jumlah: jumlah
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'sukses') {
                        alert('Obat berhasil ditambahkan');
                        document.getElementById('dosis_ajax').value = '';
                        document.getElementById('jumlah_ajax').value = '';
                        $('#kode_obat_ajax').val('').trigger('change');

                        loadRiwayatResep();
                        updateDropdownObat(); // ✅ refresh data stok obat
                    } else {
                        alert('Gagal: ' + data.pesan);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

    <h5 class="card-title mt-4">Riwayat Resep Obat</h5>
    <div id="riwayatResep">
        <!-- Data riwayat resep akan dimuat otomatis lewat AJAX -->
    </div>


</div>