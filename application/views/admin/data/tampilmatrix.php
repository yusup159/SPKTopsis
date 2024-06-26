<div class="container-fluid">
    <button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_matrix"><i class="fas fa-plus fa-sm"></i>Tambah Penilaian</button>

    <?php if ($this->session->flashdata('messagematrix')) : ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('messagematrix'); ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <tr>
            <th class="text-center">NO</th>
            <th class="text-center">Nama Karyawan</th>
            <th class="text-center">Nama Kriteria</th>
            <th class="text-center">Nilai </th>
            <th colspan="2" class="text-center">AKSI</th>
        </tr>

        <?php
        $no = 1;
        foreach ($matrix as $index => $eval) : ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td style="display: none;"><?php echo $eval->ID_Matrix ?></td>
                <td><?php echo $eval->NamaKaryawan ?></td>
                <td><?php echo $eval->NamaKriteria ?></td>
                <td><?php echo $eval->Nilai ?></td>
                <td><?php echo anchor('auth/editMatrixForm/' . $eval->ID_Matrix, '<div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>') ?> edit</td>
                <td><?php echo anchor('auth/deleteMatrix/' . $eval->ID_Matrix, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?> hapus</td>
            </tr>
        <?php endforeach; ?>
    </table>


    <div class="modal fade" id="tambah_matrix" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo site_url('auth/insertMatrix') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <select name="id_karyawan" class="form-control">
                                <?php foreach ($karyawan as $karyawan_item) : ?>
                                    <option value="<?php echo $karyawan_item->ID_Karyawan; ?>"><?php echo $karyawan_item->NamaKaryawan; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <select name="id_kriteria" class="form-control">
                                <?php foreach ($kriteria as $kriteria_item) : ?>
                                    <option value="<?php echo $kriteria_item->ID_Kriteria; ?>"><?php echo $kriteria_item->NamaKriteria; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nilai Matrix</label>
                            <input type="number" min="0" max="5" name="nilai_matrix" class="form-control">
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
</div>