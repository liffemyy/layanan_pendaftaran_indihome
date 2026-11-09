<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Paket - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>

<body>

    <?= view('partials/navbar') ?>

    <section class="paket-page">

        <aside class="filter-sidebar">
            <h3>Filter Paket</h3>

            <div class="filter-group">
                <h4>Harga</h4>
                <label><input type="radio" name="harga" value="100000-299999"> Rp100.000 - Rp299.999</label>
                <label><input type="radio" name="harga" value="300000-499999"> Rp300.000 - Rp499.999</label>
                <label><input type="radio" name="harga" value="500000-1000000"> Rp500.000 - Rp1.000.000</label>
                <label><input type="radio" name="harga" value="1000001-999999999"> > Rp1.000.000</label>
            </div>

            <div class="filter-group">
                <h4>Kecepatan</h4>
                <label><input type="checkbox" name="kecepatan" value="50"> 50 Mbps</label>
                <label><input type="checkbox" name="kecepatan" value="75"> 75 Mbps</label>
                <label><input type="checkbox" name="kecepatan" value="100"> 100 Mbps</label>
                <label><input type="checkbox" name="kecepatan" value="150"> 150 Mbps</label>
                <label><input type="checkbox" name="kecepatan" value="200"> 200 Mbps</label>
            </div>

            <div class="filter-group">
                <h4>Jumlah Perangkat</h4>
                <label><input type="radio" name="perangkat" value="5-9"> 5 - 9 Perangkat</label>
                <label><input type="radio" name="perangkat" value="10-19"> 10 - 19 Perangkat</label>
            </div>

        </aside>

        <div class="paket-content">

            <div class="paket-header">
                <h2>Pilihan Paket</h2>
                <span class="jumlah-hasil" id="jumlah-hasil"><?= count($paket) ?> Hasil</span>
            </div>

            <div class="kategori-tabs">
                <button class="tab active" data-filter="Promo">Promo</button>
                <button class="tab" data-filter="Internet">Internet</button>
                <button class="tab" data-filter="Movie">Internet + Movie</button>
                <button class="tab" data-filter="Game">Internet + Game</button>
                <button class="tab" data-filter="Deposit">Deposit</button>
                <button class="tab tab-bandingkan" data-filter="semua">Bandingkan Paket</button>
            </div>

            <div class="sort-bar">
                <label>Urutkan</label>
                <select id="sort-select">
                    <option value="sesuai">Paling Sesuai</option>
                    <option value="rendah">Harga Terendah</option>
                    <option value="tinggi">Harga Tertinggi</option>
                </select>
            </div>

            <div class="info-banner" id="info-banner">
                <span>ℹ️ Ketersediaan dan harga paket menyesuaikan kota pemasangan. Harga belum termasuk pajak dan biaya
                    instalasi.</span>
                <button type="button" id="close-banner" class="close-banner-btn">&times;</button>
            </div>

            <div class="paket-grid">
                <?php foreach ($paket as $row) {
                    $angka_kecepatan = (int) filter_var($row['kecepatan_promo'], FILTER_SANITIZE_NUMBER_INT);
                    ?>
                    <div class="paket-card" data-id="<?= $row['id'] ?>" data-tab="<?= esc($row['tab_kategori']) ?>"
                        data-harga="<?= (int) $row['harga'] ?>" data-kecepatan="<?= $angka_kecepatan ?>"
                        data-perangkat="<?= esc($row['jumlah_perangkat']) ?>"
                        data-judul="<?= esc($row['tipe_bayar']) ?> - <?= esc($row['kecepatan_judul']) ?> <?= esc($row['kategori']) ?>"
                        data-kecepatan-lama="<?= esc($row['kecepatan']) ?>"
                        data-harga-format="Rp<?= number_format($row['harga'], 0, ',', '.') ?>/bulan"
                        data-ott="<?= esc($row['ott']) ?>"
                        data-biaya-pasang="<?= $row['biaya_pasang'] > 0 ? 'Rp' . number_format($row['biaya_pasang'], 0, ',', '.') : 'Gratis' ?>"
                        data-nama-lengkap="<?= esc($row['tipe_bayar']) ?> - <?= esc($row['kecepatan_judul']) ?>"
                        onclick="handleCardClick(this, event)">
                        <div class="compare-check"></div>
                        <div class="paket-card-header">
                            <div>
                                <h4 class="paket-judul"><?= esc($row['tipe_bayar']) ?> - <?= esc($row['kecepatan_judul']) ?>
                                </h4>
                                <p class="paket-subjudul"><?= esc($row['kategori']) ?></p>
                            </div>
                            <span class="paket-harga">Rp<?= number_format($row['harga'], 0, ',', '.') ?></span>
                        </div>

                        <div class="speed-boost">
                            <span class="speed-lama"><?= esc($row['kecepatan']) ?></span>
                            <span class="speed-baru"><?= esc($row['kecepatan_promo']) ?></span>
                        </div>
                        <?php $jumlah_ott = count(array_filter(array_map('trim', explode(',', $row['ott'])))); ?>
                        <span class="badge-promo">+<?= $jumlah_ott ?> OTT</span>
                    </div>
                <?php } ?>
            </div>

        </div>
    </section>
    <!-- Modal 1: Detail Paket -->
    <div class="modal-overlay" id="modal-detail">
        <div class="modal-box">
            <button class="modal-close" id="close-modal-detail">&times;</button>

            <h3 id="modal-judul">Bayar Sekaligus - 150 Mbps Internet</h3>
            <p id="modal-kecepatan-lama" class="modal-kecepatan-lama">75 Mbps</p>

            <div class="modal-harga-row">
                <span id="modal-harga" class="modal-harga">Rp250.000/bulan</span>
            </div>

            <div class="modal-info-row">
                <span>📱 Perangkat Terhubung</span>
                <span id="modal-perangkat">5-9 Perangkat</span>
            </div>

            <div class="modal-info-row">
                <span>🔧 Biaya Pasang</span>
                <span id="modal-biaya-pasang">Rp0</span>
            </div>

            <div class="modal-info-row">
                <span>🎬 OTT Pilihan</span>
                <span id="modal-ott">Prime Video, Catchplay+</span>
            </div>

            <details class="modal-detail-toggle">
                <summary>Petunjuk Umum</summary>
                <p>1. Pembayaran Indihome terdiri dari pembayaran biaya instalasi & pembayaran tagihan bulanan</p>
                <p>2. Pembayaran biaya instalasi dilakukan setelah proses instalasi selesai dilakukan oleh teknisi,
                    pembayaran dapat dilakukan melalui berbagai channel pembayaran</p>
                <p>3. Pembayaran tagihan bulanan dilakukan setiap tanggal 5-20 di setiap bulanya. Untuk bulan pertama
                    pemakaian, pembayaran dilakukan di bulan selanjutnya. Pembayaran IndiHome menggunakan
                    skema Pasca bayar (Pakai layanan dulu, baru bayar)</p>
            </details>

            <details class="modal-detail-toggle">
                <summary>Syarat dan Ketentuan</summary>
                <p>Ini ceritanya teks syarat dan ketentuan.</p>
            </details>

            <button class="btn btn-full" id="btn-pilih-paket">Pilih Paket</button>
        </div>
    </div>

    <!-- Modal 2: Pilih Mekanisme Tagihan -->
    <div class="modal-overlay" id="modal-tagihan">
        <div class="modal-box">
            <button class="modal-close" id="close-modal-tagihan">&times;</button>

            <h3>Pilih Mekanisme Tagihan</h3>
            <p class="modal-subtitle">Pilih mekanisme tagihan yang paling pas untuk Anda</p>

            <label class="tagihan-option">
                <div>
                    <span class="tagihan-durasi">2 Bulan</span>
                    <span class="tagihan-harga">Rp500.000</span>
                    <p class="tagihan-setara">Setara <span>Rp250.000/Bulan</span></p>
                </div>
                <input type="radio" name="tagihan" value="2 Bulan">
            </label>

            <label class="tagihan-option">
                <div>
                    <span class="tagihan-durasi">7 Bulan</span>
                    <span class="tagihan-harga">Rp1.487.500</span>
                    <p class="tagihan-setara">Setara <span>Rp212.500/Bulan</span> <span class="hemat">Hemat 15%</span>
                    </p>
                </div>
                <input type="radio" name="tagihan" value="7 Bulan">
            </label>

            <label class="tagihan-option">
                <div>
                    <span class="tagihan-durasi">17 Bulan</span>
                    <span class="tagihan-harga">Rp2.975.000</span>
                    <p class="tagihan-setara">Setara <span>Rp175.000/Bulan</span> <span class="hemat">Hemat 30%</span>
                    </p>
                </div>
                <input type="radio" name="tagihan" value="17 Bulan">
            </label>

            <button type="button" class="btn btn-full" id="btn-pilih-tagihan">Pilih</button>
        </div>
    </div>
    <div class="compare-bar" id="compare-bar">
        <div class="compare-bar-content">
            <div>
                <strong>Bandingkan Paket</strong>
                <p id="compare-counter">0/2 Paket Dipilih</p>
            </div>
            <button id="btn-bandingkan-mulai" class="btn" disabled onclick="mulaiBandingkan()">Bandingkan</button>
        </div>
    </div>
    <?= view('partials/footer') ?>

</body>

</html>