<div class="container-fluid">

    <h1 style="text-align: center;">Matriks Perbandingan Kriteria</h1>
    <br>
    <div class="row">
        <div class="col">
            <a href="<?php echo site_url('auth/insertPerbandingan')?>"><button class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus fa-sm"></i>Tambah </button></a>
            <table class="table table-bordered">
    <thead>
        <tr>
            <th>Kriteria</th>
            <?php foreach ($kriteria as $k) : ?>
                <th><?php echo $k->NamaKriteria; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($kriteria as $k1) : ?>
            <tr>
                <td><?php echo $k1->NamaKriteria; ?></td>
                <?php foreach ($kriteria as $k2) : ?>
                    <td>
                        <?php echo isset($nilai_perbandingan[$k1->ID_Kriteria][$k2->ID_Kriteria]) ? $nilai_perbandingan[$k1->ID_Kriteria][$k2->ID_Kriteria] : 1; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

        </div>
        <div class="col">
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
                        <td class="text-center" >tes</td>
                        <td>tesaja</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
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