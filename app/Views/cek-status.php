<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cek Status Pendaftaran - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>

<body>

    <?= view('partials/navbar') ?>

    <section class="step-form">
        <div class="step-content">
            <h2>Cek Status Pendaftaran</h2>
            <?php if (!isset($hasil)): ?>
                <p class="step-subtitle">Masukkan nomor registrasi yang kamu terima setelah mendaftar</p>
            <?php else: ?>
                <p class="step-subtitle">Berikut detail dan progres pendaftaran kamu</p>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="auth-alert"><?= esc($error) ?></div>
            <?php endif; ?>

            <?php if (!isset($hasil)): ?>
                <form action="<?= base_url('cek-status') ?>" method="post">
                    <div class="auth-field">
                        <label>Nomor Registrasi</label>
                        <input type="text" name="no_registrasi" placeholder="Contoh: IND62824"
                            value="<?= esc($kodeAwal ?? '') ?>" required>
                    </div>
                    <button type="submit" class="btn btn-full">Cek Status</button>
                </form>
            <?php endif; ?>

            <?php if (isset($hasil)): ?>
                <div class="hasil-status">
                    <div class="riwayat-header">
                        <span class="riwayat-noreg"><?= esc($hasil['no_registrasi']) ?></span>
                        <span
                            class="riwayat-status status-<?= strtolower($hasil['status']) ?>"><?= esc($hasil['status']) ?></span>

                    </div>
                    <p class="riwayat-detail">👤 <?= esc($hasil['nama']) ?></p>
                    <p class="riwayat-detail">📍 <?= esc($hasil['alamat']) ?></p>
                    <p class="riwayat-detail">📅 <?= esc(date('d F Y', strtotime($hasil['tanggal_pasang']))) ?>,
                        <?= esc($hasil['jam_pasang']) ?>
                    </p>

                    <div class="status-tracker">
                        <?php
                        $tahapan = ['Menunggu', 'Diproses', 'Survey', 'Terpasang', 'Selesai'];
                        $statusSekarang = array_search($hasil['status'], $tahapan);
                        ?>
                        <?php foreach ($tahapan as $i => $tahap): ?>
                            <div
                                class="tracker-step <?= $i <= $statusSekarang ? 'done' : '' ?> <?= $i == $statusSekarang ? 'current' : '' ?>">
                                <span class="tracker-dot"></span>
                                <span class="tracker-label"><?= $tahap ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?= view('partials/footer') ?>
</body>

</html>