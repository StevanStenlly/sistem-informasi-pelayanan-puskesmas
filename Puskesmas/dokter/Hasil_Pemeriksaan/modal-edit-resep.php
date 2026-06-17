 <!-- Modal Edit Resep -->
 <div class="modal fade" id="modalEditResep" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <form id="formEditResep">
                 <div class="modal-header">
                     <h5 class="modal-title">Edit Resep Obat</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>
                 <div class="modal-body">
                     <input type="hidden" name="id_resep_edit" id="id_resep_edit">
                     <input type="hidden" name="kode_obat_edit" id="kode_obat_edit">
                     <input type="hidden" name="jumlah_lama" id="jumlah_lama">

                     <div class="mb-3">
                         <label>Nama Obat<span class="text-danger">*</span></label>
                         <input type="text" id="nama_obat_edit" class="form-control" readonly>
                     </div>
                     <div class="mb-3">
                         <label>Dosis<span class="text-danger">*</span></label>
                         <input type="text" name="dosis_edit" id="dosis_edit" class="form-control" required>
                     </div>
                     <div class="mb-3">
                         <label>Jumlah<span class="text-danger">*</span></label>
                         <input type="number" name="jumlah_edit" id="jumlah_edit" class="form-control" min="1" required>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                 </div>
             </form>
         </div>
     </div>
 </div>