<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Berhasil - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>
<body>

<?= view('partials/navbar') ?>

<section class="step-form">
    <div class="step-content" style="text-align:center;">
        <h2> Pendaftaran Berhasil!</h2>
        <p class="step-subtitle">Simpan nomor registrasi ini untuk melacak status pendaftaran kamu</p>
        <div class="no-registrasi-box"><?= esc($no_registrasi) ?></div>
        <a href="<?= base_url('cek-status') ?>?kode=<?= esc($no_registrasi) ?>" class="btn btn-full">Cek Status Pendaftaran</a>
    </div>
</section>

<?= view('partials/footer') ?>
</body>
</html>