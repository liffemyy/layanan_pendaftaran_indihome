<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>

<body>

    <nav class="navbar">
        <div class="logo"><img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo"></div>
        <ul class="nav-links">
            <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/pendaftaran') ?>">Kelola Status</a></li>
            <li><a href="<?= base_url('admin/paket') ?>">Kelola Paket</a></li>
            <li><a href="<?= base_url('admin/logout') ?>">Logout</a></li>
        </ul>
    </nav>

    <section class="page-section">
        <h2>Dashboard Admin</h2>
        <p class="page-intro">Halo, <?= esc(session()->get('admin_username')) ?>! Ini ringkasan data website kamu.</p>

        <div class="dashboard-stats">
            <div class="stat-card">
                <span class="stat-number"><?= $total_paket ?></span>
                <span class="stat-label">Total Paket</span>
            </div>
            <div class="stat-card">
                <span class="stat-number"><?= $total_pendaftaran ?></span>
                <span class="stat-label">Total Pendaftaran</span>
            </div>
        </div>

        <h3 style="margin-top:30px; margin-bottom:15px;">Pendaftaran Terbaru</h3>
        <div class="riwayat-list">
            <?php foreach ($pendaftaran_terbaru as $item): ?>
                <div class="riwayat-card">
                    <div class="riwayat-header">
                        <span class="riwayat-noreg"><?= esc($item['no_registrasi']) ?></span>
                        <span
                            class="riwayat-status status-<?= strtolower($item['status']) ?>"><?= esc($item['status']) ?></span>
                    </div>
                    <p class="riwayat-detail">👤 <?= esc($item['nama']) ?> — <?= esc($item['no_hp']) ?></p>
                    <p class="riwayat-detail">
                        📍 <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($item['alamat']) ?>"
                            target="_blank" class="link-maps">
                            <?= esc($item['alamat']) ?>
                        </a>
                    </p>
                    <p class="riwayat-detail">📅 <?= esc(date('d F Y', strtotime($item['tanggal_pasang']))) ?>,
                        <?= esc($item['jam_pasang']) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</body>

</html>

