<div class="container-fluid" role="document">

  <div class="modal-content">
  <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" >Tambah perbandingan </h5>
          <a href="<?php echo site_url('auth/tampilPerbandingan') ?>">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </a>
        </div>
    <div class="row ">
      <div class="col">
       
        <div class="modal-body">

          <form action="<?php echo site_url('auth/insertPerbandingan') ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label>Kriteria 1</label>
              <select name="id_kriteria1" class="form-control">
                <?php foreach ($kriteria as $kriteria_item) : ?>
                  <option value="">Pilih Kriteria</option>
                  <option value="<?php echo $kriteria_item->ID_Kriteria; ?>"><?php echo $kriteria_item->NamaKriteria; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Kriteria 2</label>
              <select name="id_kriteria2" class="form-control">
                <?php foreach ($kriteria as $kriteria_item) : ?>
                  <option value="">Pilih Kriteria</option>
                  <option value="<?php echo $kriteria_item->ID_Kriteria; ?>"><?php echo $kriteria_item->NamaKriteria; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>nilai</label>
              <input type="text" name="alamat" class="form-control" required>
            </div>

        </div>
        <div class="modal-footer">
          <a href="<?php echo site_url('auth/tampilPerbandingan') ?>"><button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          </a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

        </form>
      </div>

      <div class="col">

        <table class="table-bordered mt-5">
          <thead>
            <tr>
              <th class="text-center">Integritas Kepentingan</th>
              <th class="text-center">Definisi</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($integritas as $row) : ?>

              <tr>
                <td class="text-center"><?= $row->nilai_integritas ?></td>
                <td><?= $row->definisi ?></td>

              </tr>
            <?php endforeach; ?>
            <tr>
              <td>tes</td>
              <td>tesaja</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>