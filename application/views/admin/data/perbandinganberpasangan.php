<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-lg-6">
            <h1>Perbandingan Kriteria</h1>
            <form action="<?php echo site_url('Auth/HitungPerbandingan'); ?>" method="post">
                <div class="form-group">
                    <?php foreach ($kriteria as $i => $k1) : ?>
                        <?php foreach ($kriteria as $j => $k2) : ?>
                            <?php if ($i < $j) : ?>
                                <div class="mb-3">
                                    <label><?php echo $k1['NamaKriteria'] . ' vs ' . $k2['NamaKriteria']; ?></label>
                                    <input type="number" step="0.01" class="form-control" name="perbandingan[<?php echo $k1['ID_Kriteria']; ?>][<?php echo $k2['ID_Kriteria']; ?>]" required>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
                <button type="submit" class="btn btn-primary">Hitung Perbandingan</button>
            </form>
        </div>
        <div class="col-12 col-lg-6">
            <h1>Integritas Kepentingan</h1>
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
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
                        <td class="text-center">2, 4, 6, 8</td>
                        <td>Nilai diantara dua penilaian yang berdekatan</td>
                    </tr>
                    <tr>
                        <td class="text-center">Resiprokal</td>
                        <td>Jika elemen I memiliki salah satu angka di atas dibandingkan elemen j, maka j memiliki nilai kebalikannya ketika dibanding dengan i</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>