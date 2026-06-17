<div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Foto<span class="text-danger">*</span></label>
                    <br>
                    <input type="file" name="foto_pasien" class="form-control-file" required>
                    <br>
                    <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
                    <br>
                    <br>

                    <label>NIK<span class="text-danger">*</span></label>
                    <input type="text" name="nik_pasien" placeholder="NIK" maxlength="16" class="form-control" required>
                    <br>

                    <label>Nama<span class="text-danger">*</span></label>
                    <input type="text" name="nama_pasien" placeholder="Nama" class="form-control" required>
                    <br>

                    <label>BPJS<span class="text-danger">*</span></label>
                    <input type="text" name="bpjs" placeholder="BPJS" class="form-control" required>
                    <br>

                    <label>Jenis Kelamin<span class="text-danger">*</span></label>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <select class="form-control form-select" name="jk_pasien" required>
                                <option value="">- Pilih -</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <label>Agama<span class="text-danger">*</span></label>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <select class="form-control form-select" name="agama_pasien" required>
                                <option value="">- Pilih -</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Khonghucu">Khonghucu</option>
                            </select>
                        </div>
                    </div>

                    <label>Status Pernikahan<span class="text-danger">*</span></label>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <select class="form-control form-select" name="status_pernikahan_pasien" required>
                                <option value="">- Pilih -</option>
                                <option value="Sudah Menikah">Sudah Menikah</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Janda/Duda">Janda/Duda</option>
                            </select>
                        </div>
                    </div>

                    <label>Alamat<span class="text-danger">*</span></label>
                    <input type="text" name="alamat_pasien" placeholder="Alamat" class="form-control" required>
                    <br>

                    <label>Nomor HP<span class="text-danger">*</span></label>
                    <input type="text" name="no_hp_pasien" placeholder="Nomor HP" class="form-control" required>
                    <br>

                    <label>Tempat Lahir<span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir_pasien" placeholder="Nama" class="form-control" required>
                    <br>

                    <label>Tanggal Lahir<span class="text-danger">*</span></label>
                    <input type="date" name="tgl_lahir_pasien" id="tglLahirPasienAdd" class="form-control" required>
                    <br>

                    <label>Pekerjaan<span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_pasien" placeholder="Pekerjaan" class="form-control" required>
                    <br>

                    <label>Riwayat Alergi<span class="text-danger">*</span></label>
                    <input type="text" name="riwayat_alergi_pasien" placeholder="Riwayat Alergi" class="form-control" required>
                    <br>

                    <label>Password<span class="text-danger">*</span></label>
                    <input type="password" name="password_pasien" id="passwordPasienAdd" placeholder="Password" class="form-control" minlength="8" maxlength="20" required>
                    <br>

                    <div class="row mb-3">
                        <div class="col-md-8 offset-md-4 col-lg-9 offset-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="showPasswordAdd">
                                <label class="form-check-label" for="showPasswordAdd">Tampilkan Password</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewpasien">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    // Batasi input tanggal lahir maksimal hari ini untuk form tambah pasien
    const inputTanggalLahirAdd = document.getElementById("tglLahirPasienAdd");
    const todayAdd = new Date().toISOString().split("T")[0];
    inputTanggalLahirAdd.setAttribute("max", todayAdd);

    // Validasi tahun lahir tidak boleh melebihi tahun ini untuk form tambah pasien
    document.querySelector("#ExtralargeModal form").addEventListener("submit", function(event) {
        const tahunLahirAdd = new Date(inputTanggalLahirAdd.value).getFullYear();
        const tahunSekarangAdd = new Date().getFullYear();
        if (tahunLahirAdd > tahunSekarangAdd) {
            alert("Tahun lahir tidak boleh melebihi tahun ini.");
            event.preventDefault(); // Menghentikan submit form
        }
    });

    // Tampilkan/sembunyikan password untuk form tambah pasien
    document.getElementById("showPasswordAdd").addEventListener("change", function() {
        // Menggunakan ID yang baru ditambahkan untuk input password
        const passwordInput = document.getElementById("passwordPasienAdd");
        const type = this.checked ? "text" : "password";
        passwordInput.type = type;
    });

    // Validasi NIK (hanya angka dan 16 digit)
    const nikInput = document.querySelector('input[name="nik_pasien"]');
    nikInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Hapus non-digit
        // Anda bisa tambahkan validasi panjang 16 digit di sini jika perlu,
        // misalnya dengan menambahkan kelas is-invalid jika tidak 16 digit.
        if (this.value.length !== 16 && this.value.length > 0) {
            this.classList.add("is-invalid");
            this.setCustomValidity("NIK harus 16 digit angka.");
        } else {
            this.classList.remove("is-invalid");
            this.setCustomValidity("");
        }
    });

    // Validasi Nomor HP (dimulai 08 dan 10-14 digit)
    const noHpInputAdd = document.querySelector('input[name="no_hp_pasien"]');
    noHpInputAdd.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Hapus non-digit
        const valid = /^08\d{8,12}$/.test(this.value);

        if (this.value.length >= 10) {
            if (!valid) {
                this.classList.add("is-invalid");
                this.setCustomValidity("Nomor HP harus dimulai dengan 08 dan terdiri dari 10 hingga 14 digit angka.");
            } else {
                this.classList.remove("is-invalid");
                this.classList.add("is-valid");
                this.setCustomValidity("");
            }
        } else {
            this.classList.remove("is-invalid", "is-valid");
            this.setCustomValidity("");
        }
    });
</script>