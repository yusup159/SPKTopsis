<div class="container-fluid">
    <h2>Titik Ideal Positif</h2>
    <table class="table table-bordered">
        <tr>
            <?php foreach ($idealPositif as $ideal): ?>
                <th><?= $ideal['Kriteria'] ?></th>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($idealPositif as $ideal): ?>
                <td class="text-center"><?php echo number_format( $ideal['NilaiBobotTerbobot'], 7); ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
    <br>
    <h2>Titik Ideal Negatif</h2>
    <table class="table table-bordered">
        <tr>
            <?php foreach ($idealNegatif as $ideal): ?>
                <th><?= $ideal['Kriteria'] ?></th>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($idealNegatif as $ideal): ?>
                <td class="text-center"><?php echo number_format( $ideal['NilaiBobotTerbobot'], 7); ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
</div>

