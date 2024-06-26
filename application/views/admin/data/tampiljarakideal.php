<div class="container-fluid">
    <h1>Jarak Ideal Positif Karyawan</h1>
    <table class=" table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th class="text-center">Nama Karyawan</th>
                <th class="text-center">Jarak Ideal Positif</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($jarakSetiapKaryawan as $karyawan) : ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $karyawan['NamaKaryawan']; ?></td>
                    <td class="text-center"><?php echo number_format($karyawan['JarakIdealPositif'], 4); ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <h1>Jarak Ideal Negatif Karyawan</h1>

    <table class=" table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th class="text-center">Nama Karyawan</th>
                <th class="text-center">Jarak Ideal Negatif</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($jarakNegatifSetiapKaryawan as $karyawan) : ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $karyawan['NamaKaryawan']; ?></td>
                    <td class="text-center"><?php echo number_format($karyawan['JarakIdealNegatif'], 4); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>