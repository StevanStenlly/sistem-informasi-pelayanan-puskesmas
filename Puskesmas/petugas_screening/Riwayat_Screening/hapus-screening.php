                <!-- Delete Modal -->
                <div class="modal fade" id="deletescreening<?= $id_rm; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Hapus Data</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Modal body -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    Apakah Anda Ingin Menghapus Data <?= $nama_pasien; ?>?
                                    <input type="hidden" name="id_rm" value="<?= $id_rm; ?>">
                                    <br>
                                    <br>
                                    <button type="sumbit" class="btn btn-danger" name="deletescreening">Hapus</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>