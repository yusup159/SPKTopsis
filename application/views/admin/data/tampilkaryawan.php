<div class="container-fluid">
	<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_karyawan"><i class="fas fa-plus fa-sm"></i>Tambah Karywan</button>

	<?php if ($this->session->flashdata('messagekaryawan')) : ?>
		<div class="alert alert-success">
			<?php echo $this->session->flashdata('messagekaryawan'); ?>
		</div>
	<?php endif; ?>
	<table class="table table-bordered ">
		<tr>
			<th class="text-center">NO</th>
			<th class="text-center">NamaKaryawan</th>
			<th class="text-center">Jabatan</th>
			<th class="text-center">Alamat</th>
			<th class="text-center">GajiSaatIni</th>
			<th colspan="2" class="text-center">AKSI</th>
		</tr>
		<?php
		$no = 1;
		foreach ($karyawan as $kar) : ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td style="display: none;"><?php echo $kar->ID_Karyawan ?></td>
				<td><?php echo $kar->NamaKaryawan ?></td>
				<td><?php echo $kar->Jabatan ?></td>
				<td><?php echo $kar->Alamat ?></td>
				<td><?php echo $kar->GajiSaatIni ?></td>
				<td><?php echo anchor('auth/editKaryawanForm/' . $kar->ID_Karyawan, '<div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>') ?> edit</td>
				<td><?php echo anchor('auth/deleteKaryawan/' . $kar->ID_Karyawan, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?> hapus</td>
			</tr>

		<?php endforeach; ?>
	</table>

</div>


<div class="modal fade" id="tambah_karyawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Karywan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form action="<?php echo site_url('auth/insertKaryawan') ?>" method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label>Nama Karywan</label>
						<input type="text" name="nama_karyawan" class="form-control">
					</div>
					<div class="form-group">
						<label>Jabatan</label>
						<input type="text" name="jabatan" class="form-control">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" name="alamat" class="form-control">
					</div>
					<div class="form-group">
						<label>Gaji</label>
						<input type="text" name="gaji" class="form-control">
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>

			</form>
		</div>
	</div>
</div>