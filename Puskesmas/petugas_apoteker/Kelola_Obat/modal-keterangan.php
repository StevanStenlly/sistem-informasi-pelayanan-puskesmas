<?php
// modal-keterangan.php
?>
<div class="modal fade" id="keteranganobat<?= $ido; ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keterangan Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <?= $keterangan_obat; ?>
                </div>
            </div>
        </div>
    </div>
</div>