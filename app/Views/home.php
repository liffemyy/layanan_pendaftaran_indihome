<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndiHome - Internet Cepat untuk Rumah Anda</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>
<body>

<?= view('partials/navbar') ?>

<section class="hero">
    <div class="hero-text">
        <h1 class="service-title">
            Layanan Registrasi Pendaftaran Wifi IndiHome
        </h1>
        <h2>
            Internet Cepat, Hidup Makin Nyaman
        </h2>
        <p>
            Nikmati koneksi internet stabil untuk kebutuhan rumah dan keluarga Anda.
        </p>
        <a href="<?= base_url('paket') ?>" class="btn">Lihat Paket</a>
    </div>
    <div class="hero-img">
        <img src="<?= base_url('assets/img/nntntv.png') ?>" alt="">
    </div>
</section>

<?= view('partials/footer') ?>

</body>
</html>