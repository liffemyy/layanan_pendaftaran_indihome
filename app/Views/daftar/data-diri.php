<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Diri - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>

<body>

    <?= view('partials/navbar') ?>

    <section class="step-form">
        <div class="step-progress">
            <span class="step-item done">1. Lokasi Pemasangan</span>
            <span class="step-line"></span>
            <span class="step-item active">2. Data Diri</span>
            <span class="step-line"></span>
            <span class="step-item">3. Checkout</span>
        </div>

        <div class="step-content">
            <h2>Data Diri</h2>
            <p class="step-subtitle">Lengkapi data diri untuk proses pemasangan</p>

            <form action="<?= base_url('daftar/data-diri') ?>" method="post">
                <div class="auth-field">
                    <label>Nama Lengkap*</label>
                    <input type="text" name="nama" required>
                </div>
                <div class="auth-field">
                    <label>No. HP Aktif*</label>
                    <input type="text" name="no_hp" required>
                </div>
                <div class="auth-field">
                    <label>Tanggal Pemasangan*</label>
                    <input type="date" name="tanggal_pasang" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
                </div>
                <div class="auth-field">
                    <label>Jam Pemasangan*</label>
                    <select name="jam_pasang" required>
                        <option value="">Pilih jam</option>
                        <option value="08:00 - 10:00">08:00 - 10:00</option>
                        <option value="10:00 - 12:00">10:00 - 12:00</option>
                        <option value="13:00 - 15:00">13:00 - 15:00</option>
                        <option value="15:00 - 17:00">15:00 - 17:00</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-full">Lanjut ke Checkout</button>
            </form>
        </div>
    </section>

    <?= view('partials/footer') ?>
</body>

</html>