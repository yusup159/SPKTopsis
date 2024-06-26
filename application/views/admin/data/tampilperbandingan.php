<div class="container mt-5">
    <h1 class="text-center">Matriks Perbandingan Kriteria</h1>
    <form action="<?php echo site_url('Auth/hitung_bobot'); ?>" method="post">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Kriteria</th>
                        <?php foreach ($kriteria as $k) : ?>
                            <th><?php echo $k['NamaKriteria']; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kriteria as $k1) : ?>
                        <tr>
                            <td><?php echo $k1['NamaKriteria']; ?></td>
                            <?php foreach ($kriteria as $k2) : ?>
                                <td>
                                    <input type="text" class="form-control" name="nilai[<?php echo $k1['ID_Kriteria']; ?>][<?php echo $k2['ID_Kriteria']; ?>]" value="<?php echo isset($perbandingan[$k1['ID_Kriteria']][$k2['ID_Kriteria']]) ? number_format($perbandingan[$k1['ID_Kriteria']][$k2['ID_Kriteria']], 4) : ''; ?>" readonly>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Hitung bobot</button>
        </div>
    </form>
</div>