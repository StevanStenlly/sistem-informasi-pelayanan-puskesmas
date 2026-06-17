                <!-- Delete Modal -->
                <div class="modal fade" id="delete<?= $idpg; ?>">
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
                                    Apakah Anda Ingin Menghapus Data <?= $nama_pengumuman; ?>?
                                    <input type="hidden" name="idpg" value="<?= $idpg; ?>">
                                    <br>
                                    <br>
                                    <button type="sumbit" class="btn btn-danger" name="hapuspengumuman">Hapus</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>