<form action="" method="POST" enctype="multipart/form-data">
  <div class="row mb-3">
    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Gambar Profile</label>
    <div class="col-md-8 col-lg-9">
      <input type="file" name="foto_pasien" id="fotoPasienDetailUpdate" class="form-control-file" accept="image/*">
      <br>
      <small class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
      <br>
      <img id="preview_gambar_detail_update" src="../../adm/Kelola_Pasien/img/<?= $foto_pasien; ?>" alt="<?= $foto_pasien; ?>" height="100" width="100">
    </div>
  </div>

  <div class="row mb-3">
    <label for="namaPasien" class="col-md-4 col-lg-3 col-form-label">Nama<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="nama_pasien" type="text" class="form-control" id="namaPasien" value="<?= $nama_pasien; ?>" required maxlength="100">
    </div>
  </div>

  <div class="row mb-3">
    <label for="nikPasien" class="col-md-4 col-lg-3 col-form-label">NIK<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="nik_pasien" type="text" class="form-control" id="nikPasien" value="<?= $nik_pasien; ?>" maxlength="16" required>
      <div class="invalid-feedback">NIK harus 16 digit angka.</div>
    </div>
  </div>

  <div class="row mb-3">
    <label for="bpjsPasien" class="col-md-4 col-lg-3 col-form-label">BPJS<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="bpjs" type="text" class="form-control" id="bpjsPasien" value="<?= $bpjs; ?>" required maxlength="50">
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="jk_pasien" required>
        <option disabled>Pilih jenis kelamin</option>
        <option value="Laki-Laki" <?= ($jk_pasien === 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
        <option value="Perempuan" <?= ($jk_pasien === 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="tempatLahirPasien" class="col-md-4 col-lg-3 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="tempat_lahir_pasien" type="text" class="form-control" id="tempatLahirPasien" value="<?= $tempat_lahir_pasien; ?>" required maxlength="50">
    </div>
  </div>

  <div class="row mb-3">
    <label for="tglLahirPasienDetailUpdate" class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="tgl_lahir_pasien" type="date" class="form-control" id="tglLahirPasienDetailUpdate" value="<?= $tgl_lahir_pasien; ?>" required>
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Agama<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="agama_pasien" required>
        <option disabled>Pilih agama</option>
        <?php
        $agama_list = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'];
        foreach ($agama_list as $agama) {
          $selected = ($agama_pasien === $agama) ? 'selected' : '';
          echo "<option value='$agama' $selected>$agama</option>";
        }
        ?>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Status Pernikahan<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="status_pernikahan_pasien" required>
        <option disabled>Pilih status</option>
        <?php
        $status_list = ['Sudah Menikah', 'Belum Menikah', 'Janda/Duda'];
        foreach ($status_list as $status) {
          $selected = ($status_pernikahan_pasien === $status) ? 'selected' : '';
          echo "<option value='$status' $selected>$status</option>";
        }
        ?>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="pekerjaanPasien" class="col-md-4 col-lg-3 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="pekerjaan_pasien" type="text" class="form-control" id="pekerjaanPasien" value="<?= $pekerjaan_pasien; ?>" required maxlength="100">
    </div>
  </div>

  <div class="row mb-3">
    <label for="riwayatAlergiPasien" class="col-md-4 col-lg-3 col-form-label">Riwayat Alergi<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="riwayat_alergi_pasien" type="text" class="form-control" id="riwayatAlergiPasien" value="<?= $riwayat_alergi_pasien; ?>" required maxlength="100">
    </div>
  </div>

  <div class="row mb-3">
    <label for="alamatPasien" class="col-md-4 col-lg-3 col-form-label">Alamat<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="alamat_pasien" type="text" class="form-control" id="alamatPasien" value="<?= $alamat_pasien; ?>" required maxlength="100">
    </div>
  </div>

  <div class="row mb-3">
    <label for="noHpPasienDetailUpdate" class="col-md-4 col-lg-3 col-form-label">Nomor HP<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input
        name="no_hp_pasien"
        type="text"
        class="form-control"
        id="noHpPasienDetailUpdate"
        placeholder="No.HP/Whatsapp Aktif"
        maxlength="14"
        inputmode="numeric"
        value="<?= $no_hp_pasien; ?>"
        required>
      <div class="invalid-feedback">Nomor HP harus dimulai dengan 08 dan terdiri dari 10 hingga 14 digit angka.</div>
    </div>
  </div>

  <div class="row mb-3">
    <label for="passwordPasienDetailUpdate" class="col-md-4 col-lg-3 col-form-label">Password<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input
        name="password_pasien"
        type="password"
        class="form-control"
        id="passwordPasienDetailUpdate"
        value="<?= $password_pasien; ?>"
        minlength="8"
        maxlength="20"
        required>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-8 offset-md-4 col-lg-9 offset-lg-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="showPasswordDetailUpdate">
        <label class="form-check-label" for="showPasswordDetailUpdate">Tampilkan Password</label>
      </div>
    </div>
  </div>

  <div class="text-center">
    <input type="hidden" name="idps" value="<?= $idps; ?>">
    <button type="submit" class="btn btn-primary" name="updatepasien">Simpan Perubahan</button>
  </div>
</form>
<script>
  // Preview gambar profil
  document.getElementById('fotoPasienDetailUpdate').addEventListener('change', function(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('preview_gambar_detail_update').src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    }
  });

  // Validasi NIK
  const nikInputDetailUpdate = document.getElementById("nikPasien");
  nikInputDetailUpdate.addEventListener("input", function() {
    this.value = this.value.replace(/\D/g, ''); // Hapus non-digit
    const valid = this.value.length === 16;

    if (this.value.length > 0) { // Hanya tampilkan validasi jika ada input
      if (!valid) {
        this.classList.add("is-invalid");
        this.setCustomValidity("NIK harus 16 digit angka.");
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

  // Validasi Nomor HP
  const noHpInputDetailUpdate = document.getElementById("noHpPasienDetailUpdate");
  noHpInputDetailUpdate.addEventListener("input", function() {
    this.value = this.value.replace(/\D/g, ''); // Hapus non-digit
    const valid = /^08\d{8,12}$/.test(this.value);

    if (this.value.length >= 10) { // Hanya tampilkan validasi jika panjang minimal tercapai
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

  // Tampilkan/sembunyikan password
  document.getElementById("showPasswordDetailUpdate").addEventListener("change", function() {
    const passwordInput = document.getElementById("passwordPasienDetailUpdate");
    const type = this.checked ? "text" : "password";
    passwordInput.type = type;
  });

  // Batasi input tanggal lahir maksimal hari ini
  const inputTanggalLahirDetailUpdate = document.getElementById("tglLahirPasienDetailUpdate");
  const todayDetailUpdate = new Date().toISOString().split("T")[0];
  inputTanggalLahirDetailUpdate.setAttribute("max", todayDetailUpdate);

  // Validasi tahun lahir tidak boleh melebihi tahun ini
  document.querySelector("form").addEventListener("submit", function(event) {
    const tahunLahirDetailUpdate = new Date(inputTanggalLahirDetailUpdate.value).getFullYear();
    const tahunSekarangDetailUpdate = new Date().getFullYear();
    if (tahunLahirDetailUpdate > tahunSekarangDetailUpdate) {
      alert("Tahun lahir tidak boleh melebihi tahun ini.");
      event.preventDefault(); // Menghentikan submit form
    }
  });
</script>