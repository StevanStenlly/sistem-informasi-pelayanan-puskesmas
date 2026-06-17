                <!-- Delete Modal -->
                <div class="modal fade" id="delete<?= $idd; ?>">
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
                                    Apakah Anda Ingin Menghapus Data <?= $nama_dokter; ?>?
                                    <input type="hidden" name="idd" value="<?= $idd; ?>">
                                    <br>
                                    <br>
                                    <button type="sumbit" class="btn btn-danger" name="hapusdokter">Hapus</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>