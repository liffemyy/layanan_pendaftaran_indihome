<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Paket - IndiHome</title>
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
    <h2>Kelola Paket</h2>
    <p class="page-intro">Tambah, ubah, atau hapus data paket internet.</p>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="auth-alert auth-alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <a href="<?= base_url('admin/paket/tambah') ?>" class="btn" style="display:inline-block; margin-bottom:20px; text-decoration:none;">+ Tambah Paket Baru</a>

  <?php foreach ($terkelompok as $namaKategori => $daftarPaket): ?>
    <?php if (count($daftarPaket) > 0): ?>
        <h3 class="kategori-heading"><?= esc($namaKategori) ?> <span class="kategori-count">(<?= count($daftarPaket) ?>)</span></h3>

        <div class="riwayat-list paket-admin-grid">
            <?php foreach ($daftarPaket as $item): ?>
                <div class="riwayat-card">
                    <div class="riwayat-header">
                        <span class="riwayat-noreg"><?= esc($item['nama_paket']) ?></span>
                        <span class="riwayat-status status-menunggu"><?= esc($item['tab_kategori']) ?></span>
                    </div>
                    <p class="riwayat-detail"><?= esc($item['tipe_bayar']) ?> - <?= esc($item['kecepatan_judul']) ?> (dari <?= esc($item['kecepatan']) ?>)</p>
                    <p class="riwayat-detail">Rp<?= number_format($item['harga'], 0, ',', '.') ?>/bulan — <?= esc($item['kategori']) ?></p>

                    <div class="form-update-status">
                        <a href="<?= base_url('admin/paket/edit/' . $item['id']) ?>" class="btn-update-status" style="text-decoration:none; text-align:center;">Edit</a>
                        <a href="<?= base_url('admin/paket/hapus/' . $item['id']) ?>" class="btn-update-status" style="background-color:#888; text-decoration:none; text-align:center;" onclick="return confirm('Yakin mau hapus paket ini?')">Hapus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
</section>

</body>
</html>