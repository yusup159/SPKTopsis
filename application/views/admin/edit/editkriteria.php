
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria</h5>
        <a href="<?php echo site_url('auth/tampil_kriteria')?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
        </a>
      </div>
      <div class="modal-body">

       <form action="<?php echo site_url('auth/updateKriteria/'.$kriteria->	ID_Kriteria)?>" method="post" enctype="multipart/form-data">

       	<div class="form-group">
       		<label>Nama Kriteria</label>
       		<input type="text" name="nama_kriteria" class="form-control" value="<?= $kriteria->NamaKriteria; ?>" required>
       	</div>
       	<div class="form-group">
       		<label>Bobot Kriteria</label>
       		<input type="number" min="0" max="5" name="bobot" class="form-control" value="<?= $kriteria->BobotKriteria; ?>" required>
       	</div>
         <div class="form-goup">
			<label>Status</label>
			<select name="status" class="form-control">
				<option value="BENEFIT">BENEFIT</option>
				<option value="COST">COST</option>
			</select>
		</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

      </form>
    </div>
  </div>
