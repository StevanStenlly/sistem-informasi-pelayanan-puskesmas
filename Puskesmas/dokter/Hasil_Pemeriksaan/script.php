 <script>
     $(document).ready(function() {
         $('.select2').select2({
             placeholder: "Ketik nama obat...",
             allowClear: true
         });
     });
 </script>

 <script>
     $('#formTambahObat').on('submit', function(e) {
         e.preventDefault();
         $.ajax({
             type: 'POST',
             url: 'function-hp.php',
             data: $(this).serialize() + '&ajax_tambah_obat=1',
             success: function(response) {
                 let res = JSON.parse(response);
                 if (res.status === 'success') {
                     alert('Obat berhasil ditambahkan!');
                     $('#formTambahObat')[0].reset();
                     location.reload(); // atau panggil fungsi refresh tabel jika tidak ingin reload penuh
                 } else {
                     alert(res.msg);
                 }
             }
         });
     });
 </script>

 <script>
     function loadRiwayatResep() {
         const id_rm = <?= $id_rm; ?>;
         $.ajax({
             url: 'ajax-load-resep.php',
             method: 'POST',
             data: {
                 id_rm: id_rm
             },
             success: function(response) {
                 $('#riwayatResep').html(response);
             }
         });
     }

     // Panggil pertama kali saat halaman dimuat
     $(document).ready(function() {
         loadRiwayatResep();

         $(document).on('click', '.btn-edit-resep', function() {
             $('#id_resep_edit').val($(this).data('id'));
             $('#kode_obat_edit').val($(this).data('kode'));
             $('#jumlah_lama').val($(this).data('jumlah'));
             $('#nama_obat_edit').val($(this).data('nama'));
             $('#dosis_edit').val($(this).data('dosis'));
             $('#jumlah_edit').val($(this).data('jumlah'));
             $('#modalEditResep').modal('show');
         });

         $('#formEditResep').submit(function(e) {
             e.preventDefault();

             $.ajax({
                 url: 'function-hp.php',
                 method: 'POST',
                 data: $(this).serialize() + '&aksi=edit_resep_ajax',
                 dataType: 'json',
                 success: function(res) {
                     if (res.status === 'sukses') {
                         $('#modalEditResep').modal('hide');
                         loadRiwayatResep();
                     } else {
                         alert(res.pesan);
                     }
                 }
             });
         });

         $(document).on('click', '.btn-hapus-resep', function() {
             if (!confirm('Yakin ingin menghapus resep ini?')) return;

             const id_resep = $(this).data('id');
             const kode_obat = $(this).data('kode');
             const jumlah = $(this).data('jumlah');

             $.ajax({
                 url: 'function-hp.php',
                 method: 'POST',
                 data: {
                     aksi: 'hapus_resep_ajax',
                     id_resep: id_resep,
                     kode_obat: kode_obat,
                     jumlah: jumlah
                 },
                 dataType: 'json',
                 success: function(res) {
                     if (res.status === 'sukses') {
                         loadRiwayatResep(); // refresh tabel resep
                         updateDropdownObat(); // 🔁 refresh stok obat di dropdown
                     } else {
                         alert(res.pesan);
                     }
                 }
             });
         });

         $('#formTambahObat').on('submit', function(e) {
             e.preventDefault();

             const formData = $(this).serialize();
             $.ajax({
                 url: 'function-hp.php',
                 method: 'POST',
                 data: formData + '&aksi=tambah_obat_ajax',
                 dataType: 'json',
                 success: function(res) {
                     if (res.status === 'sukses') {
                         $('#formTambahObat')[0].reset();
                         $('.select2').val('').trigger('change');
                         loadRiwayatResep();
                     } else {
                         alert(res.pesan);
                     }
                 }
             });
         });
     });

     function updateDropdownObat() {
         fetch('ajax-stok-obat.php')
             .then(response => response.json())
             .then(data => {
                 const select = document.getElementById('kode_obat_ajax');
                 select.innerHTML = '<option value="">-- Pilih Obat --</option>'; // reset

                 data.forEach(obat => {
                     const option = document.createElement('option');
                     option.value = obat.kode_obat;
                     option.textContent = `${obat.nama_obat} ${obat.dosis_obat} ${obat.satuan} (Stok: ${obat.stok_obat})`;
                     select.appendChild(option);
                 });

                 // Jika pakai Select2, perlu re-inisialisasi
                 $('.select2').select2({
                     placeholder: "Ketik nama obat...",
                     allowClear: true
                 });
             });
     }
 </script>