<div class="container-fluid">
    <h2>Hasil Perhitungan</h2>
    <form action="<?php echo site_url('Auth/updateBobot'); ?>" method="post">
        <table class="table-bordered">
            <tr>
                <th>Kriteria</th>
                <th>Bobot</th>
            </tr>
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
                    <td><input type="text" name="bobot_kriteria[]" value="<?php echo $bobot; ?>"></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <?php if ($cr > 0.1) : ?>
            <a class="collapse-item btn btn-warning" href="<?php echo site_url('auth/insertPerbandingan') ?>">Periksa</a>

        <?php else : ?>
            <button type="submit" class="btn btn-primary">Update</button>
        <?php endif; ?>
    </form>

    <br>
    <h3>Consistency Index (CI): <?php echo $ci; ?></h3>
    <h3>Random Index (RI): <?php echo $ri; ?></h3>
    <h3>Consistency Ratio (CR): <?php echo $cr; ?></h3>
    <?php if ($cr > 0.1) : ?>
        <p>CR lebih besar dari 0.1, matriks tidak konsisten.</p>
    <?php else : ?>
        <p>CR kurang dari atau sama dengan 0.1, matriks konsisten.</p>
    <?php endif; ?>


</div>