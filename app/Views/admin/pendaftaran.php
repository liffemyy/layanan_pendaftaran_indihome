<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Status - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>

<body>

    <nav class="navbar">
        <div class="logo"><img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo"></div>
        <button class="hamburger-btn" id="hamburger-btn" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <ul class="nav-links" id="nav-links">
            <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/pendaftaran') ?>">Kelola Status</a></li>
            <li><a href="<?= base_url('admin/paket') ?>">Kelola Paket</a></li>
            <li><a href="<?= base_url('admin/logout') ?>">Logout</a></li>
        </ul>
    </nav>

    <section class="page-section">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 12px;">
            <div>
                <h2>Kelola Status</h2>
                <p class="page-intro">Ubah status pemasangan tiap pelanggan di sini.</p>
            </div>
            <button type="button" class="btn" id="btn-export" style="border: none; cursor: pointer;">⬇ Export Laporan</button>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="auth-alert auth-alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="riwayat-list">
            <?php foreach ($semua as $item): ?>
                <div class="riwayat-card">
                    <div class="riwayat-header">
                        <span class="riwayat-noreg"><?= esc($item['no_registrasi']) ?></span>
                        <span
                            class="riwayat-status status-<?= strtolower($item['status']) ?>"><?= esc($item['status']) ?></span>
                    </div>

                    <p class="riwayat-detail">
                        📦
                        <strong><?= $item['tipe_bayar'] ? esc($item['tipe_bayar']) . ' - ' . esc($item['kecepatan_judul']) : 'Paket sudah dihapus' ?></strong>
                        <?php if ($item['harga_paket']): ?>
                            (Rp<?= number_format($item['harga_paket'], 0, ',', '.') ?>/bulan)
                        <?php endif; ?>
                    </p>

                    <p class="riwayat-detail">👤 <?= esc($item['nama']) ?> — <?= esc($item['no_hp']) ?></p>
                    <p class="riwayat-detail">
                        📍 <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($item['alamat']) ?>"
                            target="_blank" class="link-maps"><?= esc($item['alamat']) ?></a>
                    </p>
                    <p class="riwayat-detail">📅 <?= esc(date('d F Y', strtotime($item['tanggal_pasang']))) ?>,
                        <?= esc($item['jam_pasang']) ?></p>

                    <form action="<?= base_url('admin/pendaftaran/update-status') ?>" method="post"
                        class="form-update-status">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <select name="status">
                            <option value="Menunggu" <?= $item['status'] == 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                            <option value="Diproses" <?= $item['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                            <option value="Survey" <?= $item['status'] == 'Survey' ? 'selected' : '' ?>>Survey</option>
                            <option value="Terpasang" <?= $item['status'] == 'Terpasang' ? 'selected' : '' ?>>Terpasang
                            </option>
                            <option value="Selesai" <?= $item['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                        </select>
                        <button type="submit" class="btn-update-status">Update Status</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Modal Export Laporan -->
    <div class="modal-overlay" id="modal-export">
        <div class="modal-box">
            <button type="button" class="modal-close" id="close-export">&times;</button>
            <h3>Export laporan</h3>
            <p class="modal-subtitle">Unduh data pendaftaran sebagai file</p>

            <form method="get" action="<?= base_url('admin/pendaftaran/export') ?>">
                <p class="export-label">Periode</p>
                <div class="export-periode">
                    <input type="date" name="dari" value="<?= date('Y-m-01') ?>" required>
                    <span>→</span>
                    <input type="date" name="sampai" value="<?= date('Y-m-d') ?>" required>
                </div>

                <p class="export-label">Format file</p>
                <div class="export-format">
                    <label class="export-card">
                        <input type="radio" name="format" value="pdf">
                        <span><strong>PDF</strong><small>Siap dicetak / dibagikan</small></span>
                    </label>
                    <label class="export-card">
                        <input type="radio" name="format" value="excel" checked>
                        <span><strong>Excel</strong><small>Mudah diolah lebih lanjut</small></span>
                    </label>
                </div>

                <button type="submit" class="btn btn-full">Export laporan</button>
            </form>
        </div>
    </div>

    <script>
        // Menu hamburger (mobile)
        const hamburger = document.getElementById('hamburger-btn');
        const navLinks = document.getElementById('nav-links');
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('show-mobile');
            hamburger.classList.toggle('active');
        });

        // Modal export
        const modalExport = document.getElementById('modal-export');
        document.getElementById('btn-export').addEventListener('click', () => modalExport.classList.add('show'));
        document.getElementById('close-export').addEventListener('click', () => modalExport.classList.remove('show'));
    </script>

</body>

</html>