<div class="container-fluid">

    <h1>Nilai Preferensi dan Peringkat Karyawan</h1>
    <table class=" table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th class="text-center">Nilai Preferensi</th>
                <th class="text-center">Peringkat</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($peringkatKaryawan as $karyawan) : ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $karyawan['NamaKaryawan']; ?></td>
                    <td class="text-center"><?php echo number_format($karyawan['NilaiPreferensi'], 4); ?></td>
                    <td class="text-center"><?php echo $karyawan['Peringkat']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>