<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $mode === 'tambah' ? 'Tambah' : 'Edit' ?> Paket - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>

<body>

    <nav class="navbar">
        <div class="logo"><img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo"></div>
        <ul class="nav-links">
            <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/paket') ?>">Kelola Paket</a></li>
            <li><a href="<?= base_url('admin/pendaftaran') ?>">Pendaftaran</a></li>
            <li><a href="<?= base_url('admin/logout') ?>">Logout</a></li>
        </ul>
    </nav>

    <section class="step-form">
        <div class="step-content">
            <h2><?= $mode === 'tambah' ? 'Tambah Paket Baru' : 'Edit Paket' ?></h2>

            <form
                action="<?= $mode === 'tambah' ? base_url('admin/paket/simpan-tambah') : base_url('admin/paket/simpan-edit/' . $paket['id']) ?>"
                method="post">

                <div class="auth-field">
                    <label>Nama Paket*</label>
                    <input type="text" name="nama_paket" value="<?= esc($paket['nama_paket'] ?? '') ?>" required>
                </div>

                <div class="auth-field">
                    <label>Kecepatan Lama (dicoret)*</label>
                    <input type="text" name="kecepatan" placeholder="Contoh: 75 Mbps"
                        value="<?= esc($paket['kecepatan'] ?? '') ?>" required>
                </div>

                <div class="auth-field">
                    <label>Kecepatan Baru/Promo*</label>
                    <input type="text" name="kecepatan_promo" placeholder="Contoh: 150 Mbps"
                        value="<?= esc($paket['kecepatan_promo'] ?? '') ?>" required>
                </div>

                <div class="auth-field">
                    <label>Kecepatan di Judul Card*</label>
                    <input type="text" name="kecepatan_judul" placeholder="Contoh: 150 Mbps"
                        value="<?= esc($paket['kecepatan_judul'] ?? '') ?>" required>
                </div>

                <div class="auth-field">
                    <label>Harga per Bulan (angka saja)*</label>
                    <input type="number" name="harga" value="<?= esc($paket['harga'] ?? '') ?>" required>
                </div>

                <div class="auth-field">
                    <label>Biaya Pasang (angka saja, 0 jika gratis)</label>
                    <input type="number" name="biaya_pasang" value="<?= esc($paket['biaya_pasang'] ?? '0') ?>">
                </div>

                <div class="auth-field">
                    <label>Tipe Bayar*</label>
                    <select name="tipe_bayar" required>
                        <?php $tipeSekarang = $paket['tipe_bayar'] ?? ''; ?>
                        <option value="Bayar Sekaligus" <?= $tipeSekarang == 'Bayar Sekaligus' ? 'selected' : '' ?>>Bayar
                            Sekaligus</option>
                        <option value="Double Speed" <?= $tipeSekarang == 'Double Speed' ? 'selected' : '' ?>>Double Speed
                        </option>
                        <option value="Extra Speed" <?= $tipeSekarang == 'Extra Speed' ? 'selected' : '' ?>>Extra Speed
                        </option>
                    </select>
                </div>

                <div class="auth-field">
                    <label>Kategori (subjudul card)*</label>
                    <input type="text" name="kategori" placeholder="Contoh: Internet + Movie Netflix"
                        value="<?= esc($paket['kategori'] ?? '') ?>" required>
                </div>

                <div class="auth-field">
                    <label>Tab Kategori*</label>
                    <select name="tab_kategori" required>
                        <?php $tabSekarang = $paket['tab_kategori'] ?? ''; ?>
                        <option value="Promo" <?= $tabSekarang == 'Promo' ? 'selected' : '' ?>>Promo</option>
                        <option value="Internet" <?= $tabSekarang == 'Internet' ? 'selected' : '' ?>>Internet</option>
                        <option value="Movie" <?= $tabSekarang == 'Movie' ? 'selected' : '' ?>>Internet + Movie</option>
                        <option value="Game" <?= $tabSekarang == 'Game' ? 'selected' : '' ?>>Internet + Game</option>
                        <option value="Bayar Sekaligus" <?= $tabSekarang == 'Bayar Sekaligus' ? 'selected' : '' ?>>Bayar
                            Sekaligus</option>
                        <option value="Deposit" <?= $tabSekarang == 'Deposit' ? 'selected' : '' ?>>Deposit</option>
                    </select>
                </div>

                <div class="auth-field">
                    <label>Jumlah Perangkat*</label>
                    <select name="jumlah_perangkat" required>
                        <?php $perangkatSekarang = $paket['jumlah_perangkat'] ?? ''; ?>
                        <option value="5-9" <?= $perangkatSekarang == '5-9' ? 'selected' : '' ?>>5-9 Perangkat</option>
                        <option value="10-19" <?= $perangkatSekarang == '10-19' ? 'selected' : '' ?>>10-19 Perangkat
                        </option>
                    </select>
                </div>

                <div class="auth-field">
                    <label>OTT (pisahkan pakai koma)</label>
                    <input type="text" name="ott" placeholder="Contoh: Netflix, Vidio"
                        value="<?= esc($paket['ott'] ?? '') ?>">
                </div>

                <button type="submit"
                    class="btn btn-full"><?= $mode === 'tambah' ? 'Simpan Paket' : 'Perbarui Paket' ?></button>
            </form>
        </div>
    </section>

</body>

</html>