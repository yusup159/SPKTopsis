<div class="container-fluid">
	<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_kriteria"><i class="fas fa-plus fa-sm"></i>Tambah Kriteria</button>
	<?php if ($this->session->flashdata('messagekriteria')) : ?>
		<div class="alert alert-success">
			<?php echo $this->session->flashdata('messagekriteria'); ?>
		</div>
	<?php endif; ?>


	<table class="table table-bordered ">
		<tr>
			<th class="text-center">NO</th>
			<th class="text-center">Nama Kriteria</th>
			<th class="text-center">Bobot Kriteria</th>
			<th class="text-center">Status</th>
			<th colspan="2" class="text-center">AKSI</th>
		</tr>
		<?php
		$no = 1;
		foreach ($kriteria as $kri) : ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td style="display: none;"><?php echo $kri->ID_Kriteria ?></td>
				<td><?php echo $kri->NamaKriteria ?></td>
				<td><?php echo $kri->BobotKriteria ?></td>
				<td><?php echo $kri->Status ?></td>
				<td><?php echo anchor('auth/editKriteriaForm/' . $kri->ID_Kriteria, '<div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>') ?> edit</td>
				<td><?php echo anchor('auth/deleteKriteria	/' . $kri->ID_Kriteria, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?> hapus</td>
			</tr>

		<?php endforeach; ?>
	</table>

</div>

<div class="modal fade" id="tambah_kriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form action="<?php echo site_url('auth/insertKriteria') ?>" method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label>Nama Kriteria</label>
						<input type="text" name="nama_kriteria" class="form-control">
					</div>


					<div class="form-goup">
						<label>Status</label>
						<select name="status" class="form-control">
							<option value="BENEFIT">BENEFIT</option>
							<option value="COST">COST</option>
						</select>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
</div>