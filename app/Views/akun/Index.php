<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akun Saya - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>
<body>

<?= view('partials/navbar') ?>

<section class="page-section">
    <h2>Akun Saya</h2>
    <p class="page-intro">Halo, <?= esc(session()->get('user_nama')) ?>! Berikut riwayat pendaftaran kamu.</p>

    <?php if (empty($riwayat)): ?>
        <div class="info-banner">
            <span>Kamu belum punya riwayat pendaftaran. <a href="<?= base_url('paket') ?>">Lihat paket sekarang</a>.</span>
        </div>
    <?php else: ?>
        <div class="riwayat-list">
            <?php foreach ($riwayat as $item): ?>
                <div class="riwayat-card">
                    <div class="riwayat-header">
                        <span class="riwayat-noreg"><?= esc($item['no_registrasi']) ?></span>
                        <span class="riwayat-status status-<?= strtolower($item['status']) ?>"><?= esc($item['status']) ?></span>
                    </div>
                    <p class="riwayat-detail">📍 <?= esc($item['alamat']) ?></p>
                    <p class="riwayat-detail">📅 <?= esc(date('d F Y', strtotime($item['tanggal_pasang']))) ?>, <?= esc($item['jam_pasang']) ?></p>
                    <p class="riwayat-detail">💳 Tenor <?= esc($item['tenor']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?= view('partials/footer') ?>
</body>
</html>