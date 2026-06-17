                <!-- Delete Modal -->
                <div class="modal fade" id="hapushasil<?= $id_hasil; ?>">
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
                                    Apakah Anda Ingin Menghapus Data Ini?
                                    <input type="hidden" name="id_hasil" value="<?= $id_hasil; ?>">
                                    <br>
                                    <br>
                                    <button type="sumbit" class="btn btn-danger" name="hapushasil">Hapus</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>