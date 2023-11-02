<div class="container-fluid">
    <h1>Normalisasi Matriks Keputusan (X)</h1>
    <table border="1">
        <tr>
            <th>NO</th>
            <th class="text-center">Nama Karyawan</th>
            <?php foreach ($normalizedMatrix[0]['values'] as $kriteria) : ?>
                <th class="text-center"><?= $kriteria['NamaKriteria']; ?></th>
            <?php endforeach; ?>
        </tr>

        <?php $no = 1; ?>
        <?php foreach ($normalizedMatrix as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['NamaKaryawan']; ?></td>
                <?php foreach ($row['values'] as $value) : ?>
                    <td class="text-center"><?= number_format($value['Nilai'], 7); ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <h1>Normalisasi Matrix Terbobot</h1>

    <table border="1">
    <tr>
        <th class="text-center">Nama Karyawan</th>
        <?php foreach ($matrixTerbobot[0]['values'] as $kriteria): ?>
            <th class="text-center"><?= $kriteria['NamaKriteria'] ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($matrixTerbobot as $row): ?>
        <tr>
            <td><?= $row['NamaKaryawan'] ?></td>
            <?php foreach ($row['values'] as $nilai): ?>
                <td class="text-center"><?= number_format($nilai['BobotTerbobot'], 7); ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
</div>















<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normalisasi Matriks Keputusan (X)</title>
</head>

<body>

    <table border="1">
        
    </table>

</body>

</html>
