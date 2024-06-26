<div class="container-fluid">
    <h3>Matriks Normalisasi Perbandingan Berpasangan</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Kriteria</th>
                    <?php foreach ($kriteria as $k) : ?>
                        <th><?php echo $k->NamaKriteria; ?></th>
                    <?php endforeach; ?>
                    <th>Jumlah</th>
                    <th>Nilai Eigen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kriteria as $i => $k1) : ?>
                    <tr>
                        <td><?php echo $k1->NamaKriteria; ?></td>
                        <?php foreach ($kriteria as $j => $k2) : ?>
                            <td><?php echo number_format($matriks_normalisasi[$i][$j], 4); ?></td>
                        <?php endforeach; ?>
                        <td><?php echo number_format($jumlah_baris[$i], 4); ?></td>
                        <td><?php echo number_format($nilai_eigen[$i], 4); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h2>Hasil Perhitungan</h2>
    <form action="<?php echo site_url('Auth/updateBobot'); ?>" method="post">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Kriteria</th>
                    <th>Bobot</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bobot_kriteria as $ID_Kriteria => $bobot) : ?>
                    <tr>
                        <td>
                            <?php
                            foreach ($kriteria as $k) {
                                if ($k->ID_Kriteria == $ID_Kriteria) {
                                    echo $k->NamaKriteria;
                                    echo '<input type="hidden" name="id_kriteria[]" value="' . $k->ID_Kriteria . '">';
                                    break;
                                }
                            }
                            ?>
                        </td>
                        <td><input type="text" class="form-control" name="bobot_kriteria[]" value="<?php echo number_format($bobot, 4); ?>" readonly></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <?php if ($cr > 0.1) : ?>
            <a class="btn btn-warning" href="<?php echo site_url('auth/insertPerbandingan') ?>">Periksa</a>
        <?php else : ?>
            <button type="submit" class="btn btn-primary">Update</button>
        <?php endif; ?>
    </form>

    <br>
    <h3>Consistency Index (CI): <?php echo number_format($ci, 4); ?></h3>
    <h3>Random Index (RI): <?php echo number_format($ri, 4); ?></h3>
    <h3>Consistency Ratio (CR): <?php echo number_format($cr, 4); ?></h3>
    <?php if ($cr > 0.1) : ?>
        <p>CR lebih besar dari 0.1, matriks tidak konsisten.</p>
    <?php else : ?>
        <p>CR kurang dari atau sama dengan 0.1, matriks konsisten.</p>
    <?php endif; ?>

    <br>
</div>