<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>

<body>

    <?= view('partials/navbar') ?>

    <section class="step-form">
        <div class="step-progress">
            <span class="step-item done">1. Lokasi Pemasangan</span>
            <span class="step-line"></span>
            <span class="step-item done">2. Data Diri</span>
            <span class="step-line"></span>
            <span class="step-item active">3. Checkout</span>
        </div>

        <div class="step-content">
            <h2>Ringkasan Pendaftaran</h2>

            <div class="checkout-summary">
                <div class="modal-info-row">
                    <span>Paket</span>
                    <span><?= esc($paket['tipe_bayar']) ?> - <?= esc($paket['kecepatan_judul']) ?></span>
                </div>
                <div class="modal-info-row">
                    <span>Harga</span>
                    <span>Rp<?= number_format($paket['harga'], 0, ',', '.') ?>/bulan</span>
                </div>
                <div class="modal-info-row">
                    <span>Nama</span>
                    <span><?= esc(session()->get('daftar_nama')) ?></span>
                </div>
                <div class="modal-info-row">
                    <span>No. HP</span>
                    <span><?= esc(session()->get('daftar_no_hp')) ?></span>
                </div>
                <div class="modal-info-row">
                    <span>Alamat</span>
                    <span><?= esc(session()->get('daftar_alamat')) ?></span>
                </div>
                <div class="modal-info-row">
                    <span>Jadwal Pemasangan</span>
                    <span><?= esc(date('d F Y', strtotime(session()->get('daftar_tanggal_pasang')))) ?>,
                        <?= esc(session()->get('daftar_jam_pasang')) ?></span>
                </div>
            </div>

            <form action="<?= base_url('daftar/checkout') ?>" method="post">
                <div class="modal-info-row">
                    <span>Tenor Pembayaran</span>
                    <span><?= esc($tenor) ?></span>
                </div>
                <button type="submit" class="btn btn-full" style="margin-top:15px;">Konfirmasi Pendaftaran</button>
            </form>
        </div>
    </section>

    <?= view('partials/footer') ?>
</body>

</html>