<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Integritas</h5>
            <a href="<?php echo site_url('auth/tampilPerbandingan') ?>">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </a>
        </div>
        <div class="modal-body">

            <form action="<?php echo site_url('auth/updateIntegritas/' . $integritas->id_integritas) ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Nilai Integritas</label>
                    <input type="text" name="nilai_integritas" class="form-control" value="<?= $integritas->nilai_integritas; ?>" required>
                </div>

                <div class="form-floating">
                    <label for="floatingTextarea2">Definisi</label>
                    <textarea class="form-control" name="definisi"  value="<?= $integritas->nilai_integritas; ?> " required id="floatingTextarea2" style="height: 100px"></textarea>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

        </form>
    </div>
</div>