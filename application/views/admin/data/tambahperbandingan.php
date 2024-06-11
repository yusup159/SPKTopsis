<div class="container-fluid">
    <div style="overflow-x:auto;">
        <h1>SPK AHP - Perbandingan berpasangan</h1>
        <form action="<?php echo site_url('Auth/hitung_bobot'); ?>" method="post">
            <table class="table-bordered">
                <tr>
                    <th>Kriteria</th>
                    <?php foreach ($kriteria as $k) : ?>
                        <th><?php echo $k->NamaKriteria; ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php foreach ($kriteria as $k1) : ?>
                    <tr>
                        <td><?php echo $k1->NamaKriteria; ?></td>
                        <?php foreach ($kriteria as $k2) : ?>
                            <td>
                                <?php if ($k1->ID_Kriteria == $k2->ID_Kriteria) : ?>
                                    1
                                <?php else : ?>
                                    <input type="text" name="nilai[<?php echo $k1->ID_Kriteria; ?>][<?php echo $k2->ID_Kriteria; ?>]" value="<?php echo isset($nilai_perbandingan[$k1->ID_Kriteria][$k2->ID_Kriteria]) ? $nilai_perbandingan[$k1->ID_Kriteria][$k2->ID_Kriteria] : 1; ?>">
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <br>
            <button type="submit" class="btn btn-primary">Hitung bobot</button>
        </form>
    </div>
    <br>
    <div>
        <table class="table-bordered">
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


</div>