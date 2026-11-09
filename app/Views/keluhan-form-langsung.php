<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Layanan Gangguan - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>
<body>

<?= view('partials/navbar') ?>

<section class="page-section">

    <div class="gangguan-section">
        <h2>Melalui Call Center</h2>
        <ol class="gangguan-list">
            <li>Pastikan Anda memiliki pulsa yang cukup.</li>
            <li>Tekan <strong>188</strong> di smartphone atau telepon Anda.</li>
            <li>Tunggu hingga ada respon, dan pilih 1 untuk bahasa Indonesia.</li>
            <li>Selanjutnya tekan angka 2 untuk pengaduan masalah IndiHome.</li>
            <li>Kemudian tekan angka 1 untuk pelanggan IndiHome.</li>
            <li>Tunggu hingga operator menyapa, dan sampaikan keluhan IndiHome yang Anda alami.</li>
            <li>Sebutkan nomor registrasi Anda sehingga bisa lekas ditindaklanjuti.</li>
        </ol>
        <a href="tel:147" class="btn gangguan-btn">📞 Call Center</a>
    </div>

    <div class="gangguan-section">
        <h2>Kunjungi Gerai Terdekat</h2>
        <ol class="gangguan-list">
            <li>Siapkan data diri dan nomor registrasi pelanggan Anda.</li>
            <li>Cari lokasi Gerai/Outlet resmi IndiHome terdekat dari tempat Anda.</li>
            <li>Datangi Gerai pada jam operasional yang berlaku.</li>
            <li>Sampaikan keluhan yang Anda alami kepada petugas di Gerai.</li>
            <li>Petugas akan membantu menindaklanjuti dan menangani gangguan Anda secara langsung.</li>
        </ol>
        <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode('GRApari Telkomsel ITC Depok') ?>" target="_blank" class="btn gangguan-btn">📍 Cari Gerai Terdekat</a>
    </div>

</section>

<?= view('partials/footer') ?>

</body>
</html>