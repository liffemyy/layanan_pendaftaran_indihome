<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
    body { font-family: Helvetica, Arial, sans-serif; font-size: 9px; color: #222; }
    .header { background: #ED0226; color: #fff; padding: 14px 18px; }
    .header h1 { margin: 0; font-size: 17px; }
    .header p { margin: 4px 0 0; font-size: 10px; }
    .ringkasan { margin: 14px 0; }
    .kotak { display: inline-block; border: 1px solid #ddd; padding: 8px 14px; margin-right: 8px; }
    .kotak b { display: block; font-size: 15px; color: #ED0226; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f2f2f2; text-align: left; padding: 6px; border: 1px solid #ddd; }
    td { padding: 5px 6px; border: 1px solid #ddd; vertical-align: top; }
    .footer { margin-top: 14px; font-size: 8px; color: #888; }
</style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pendaftaran IndiHome Depok</h1>
        <p>Periode: <?= esc($dari) ?> s/d <?= esc($sampai) ?></p>
    </div>

    <div class="ringkasan">
        <div class="kotak"><b><?= count($data) ?></b>Total pendaftaran</div>
        <?php foreach ($ringkasan as $status => $jumlah): ?>
            <div class="kotak"><b><?= $jumlah ?></b><?= esc(ucfirst($status)) ?></div>
        <?php endforeach; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <?php foreach ($label as $teks): ?><th><?= esc($teks) ?></th><?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data)): ?>
                <tr><td colspan="<?= count($label) + 1 ?>" style="text-align:center;">Tidak ada data pada periode ini.</td></tr>
            <?php endif; ?>
            <?php foreach ($data as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <?php foreach ($kolom as $k): ?><td><?= esc($row[$k] ?? '') ?></td><?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">Dicetak pada <?= date('d/m/Y H:i') ?> - indihomedepok.id</div>
</body>
</html>