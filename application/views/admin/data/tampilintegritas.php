<div class="container-fluid">
    <?php if ($this->session->flashdata('messageintegritas')) : ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('messageintegritas'); ?>
        </div>
    <?php endif; ?>
    <button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_integritas"><i class="fas fa-plus fa-sm"></i>Tambah Integritas</button>
    <table class="table-bordered">
        <thead>
            <tr>
                <th class="text-center">Integritas Kepentingan</th>
                <th class="text-center">Definisi</th>
                <th colspan="2" class="text-center">AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($integritas as $row) : ?>

                <tr>
                    <td class="text-center"><?= $row->nilai_integritas ?></td>
                    <td><?= $row->definisi ?></td>
                    <td><?php echo anchor('auth/editIntegritasForm/' . $row->id_integritas, '<div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>') ?></td>
                    <td><?php echo anchor('auth/deleteintegritas/' . $row->id_integritas, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td class="text-center">2,4,6,8</td>
                <td>Nilai diantara dua penilaian yang berdekatan</td>
            </tr>
            <tr>
                <td class="text-center">Resiprokal</td>
                <td>Jika elemen I memiliki salah satu angka di atas dibandingkan elemen j, maka j memiliki nilai kebalikannya ketika dibanding dengan i</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- tambah integritas -->
<div class="modal fade" id="tambah_integritas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Integritas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?php echo site_url('auth/insertIntegritas') ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Nilai Integritas</label>
                        <input type="text" name="nilai_integritas" class="form-control">
                    </div>
                    <div class="form-floating">
                        <label for="floatingTextarea2">Definisi</label>
                        <textarea class="form-control" name="definisi" id="floatingTextarea2" style="height: 100px"></textarea>
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