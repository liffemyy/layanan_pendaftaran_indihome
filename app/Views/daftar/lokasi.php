<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lokasi Pemasangan - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>
<body>

<?= view('partials/navbar') ?>

<section class="step-form">
    <?php include 'progress.php'; ?>

    <div class="step-content">
        <h2>Lokasi Pemasangan</h2>
        <p class="step-subtitle">Masukkan alamat lengkap tempat pemasangan internet</p>

        <form action="<?= base_url('daftar/lokasi') ?>" method="post">
            <div class="auth-field">
                <label>Alamat Lengkap*</label>
                <textarea name="alamat" rows="4" placeholder="Jl. Contoh No.1, Kel., Kec., Kota, Kode Pos" required></textarea>
            </div>
            <button type="submit" class="btn btn-full">Lanjut ke Data Diri</button>
        </form>
    </div>
</section>

<?= view('partials/footer') ?>
</body>
</html>