<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Karywan</h5>
      <a href="<?php echo site_url('auth/tampil_karyawan') ?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </a>
    </div>
    <div class="modal-body">

      <form action="<?php echo site_url('auth/updateKaryawan/' . $karyawan->ID_Karyawan) ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label>Nama Karywan</label>
          <input type="text" name="nama_karyawan" class="form-control" value="<?= $karyawan->NamaKaryawan; ?>" required>
        </div>
        <div class="form-group">
          <label>Jabatan</label>
          <input type="text" name="jabatan" class="form-control" value="<?= $karyawan->Jabatan; ?>" required>
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" class="form-control" value="<?= $karyawan->Alamat; ?>" required>
        </div>
        <div class="form-group">
          <label>Gaji</label>
          <input type="text" name="gaji" class="form-control" value="<?= $karyawan->GajiSaatIni; ?>" required>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

    </form>
  </div>
</div>