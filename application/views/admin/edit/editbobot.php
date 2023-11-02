
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Bobot Normalisasi</h5>
            <a href="<?php echo site_url('auth/tampil_bobot_normalisasi')?>">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
            <span aria-hidden="true">&times;</span>
            </button>
            </a>
        </div>
        <div class="modal-body">

        <form action="<?php echo site_url('auth/updateBobot/'.$bobot->ID_BobotNormalisasi )?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Kriteria</label>
            <select name="id_kriteria" class="form-control">
                <?php foreach ($kriteria as $kriteria_item) : ?>
                    <option value="<?php echo $kriteria_item->ID_Kriteria; ?>" <?php echo ($kriteria_item->ID_Kriteria == $bobot->ID_Kriteria) ? 'selected' : ''; ?>>
                        <?php echo $kriteria_item->NamaKriteria; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

            <div class="form-group">
                <label>Nilai Bobot Normalisasi</label>
                <input type="text" name="nilai_bobot" class="form-control">
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

        </form>
        </div>
    </div>
