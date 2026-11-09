<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bandingkan Paket - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>

<body>

    <?= view('partials/navbar') ?>

    <section class="bandingkan-page">
        <a href="<?= base_url('paket') ?>" class="back-link">&larr;</a>
        <h2 class="bandingkan-title">Bandingkan Paket</h2>

        <div class="bandingkan-dropdowns">
            <select id="dropdown-a" onchange="gantiPaket('a', this.value)">
                <?php foreach ($semuaPaket as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= $p['id'] == $paketA['id'] ? 'selected' : '' ?>>
                        <?= esc($p['tipe_bayar']) ?> - <?= esc($p['kecepatan_judul']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select id="dropdown-b" onchange="gantiPaket('b', this.value)">
                <?php foreach ($semuaPaket as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= $p['id'] == $paketB['id'] ? 'selected' : '' ?>>
                        <?= esc($p['tipe_bayar']) ?> - <?= esc($p['kecepatan_judul']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="bandingkan-table">
            <div class="bandingkan-section">
                <p class="bandingkan-label">Kecepatan Internet</p>
                <div class="bandingkan-values">
                    <span><?= esc($paketA['kecepatan_judul']) ?></span>
                    <span><?= esc($paketB['kecepatan_judul']) ?></span>
                </div>
            </div>

            <div class="bandingkan-section">
                <p class="bandingkan-label">Harga Paket</p>
                <div class="bandingkan-values">
                    <span>Rp<?= number_format($paketA['harga'], 0, ',', '.') ?></span>
                    <span>Rp<?= number_format($paketB['harga'], 0, ',', '.') ?></span>
                </div>
            </div>

            <div class="bandingkan-section">
                <p class="bandingkan-label">Biaya Pasang</p>
                <div class="bandingkan-values">
                    <span><?= $paketA['biaya_pasang'] > 0 ? 'Rp' . number_format($paketA['biaya_pasang'], 0, ',', '.') : 'Gratis' ?></span>
                    <span><?= $paketB['biaya_pasang'] > 0 ? 'Rp' . number_format($paketB['biaya_pasang'], 0, ',', '.') : 'Gratis' ?></span>
                </div>
            </div>

            <div class="bandingkan-section">
                <p class="bandingkan-label">Perangkat</p>
                <div class="bandingkan-values">
                    <span><?= esc($paketA['jumlah_perangkat']) ?></span>
                    <span><?= esc($paketB['jumlah_perangkat']) ?></span>
                </div>
            </div>

            <div class="bandingkan-section">
                <p class="bandingkan-label">OTT</p>
                <div class="bandingkan-values">
                    <span><?= esc($paketA['ott']) ?></span>
                    <span><?= esc($paketB['ott']) ?></span>
                </div>
            </div>
        </div>

        <div class="bandingkan-buttons">
            <a href="<?= base_url('daftar/mulai') ?>?paket_id=<?= $paketA['id'] ?>" class="btn">Mulai Berlangganan Paket
                <?= esc($paketA['kecepatan_judul']) ?></a>
            <a href="<?= base_url('daftar/mulai') ?>?paket_id=<?= $paketB['id'] ?>" class="btn">Mulai Berlangganan Paket
                <?= esc($paketB['kecepatan_judul']) ?></a>
        </div>
    </section>

    <?= view('partials/footer') ?>

    <script>
        function gantiPaket(sisi, id) {
            const other = sisi === 'a' ? document.getElementById('dropdown-b').value : document.getElementById('dropdown-a').value;
            const params = sisi === 'a' ? `a=${id}&b=${other}` : `a=${other}&b=${id}`;
            window.location.href = "<?= base_url('paket/bandingkan') ?>?" + params;
        }
    </script>
</body>

</html>