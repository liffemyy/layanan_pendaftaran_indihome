<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - IndiHome</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>

<body>

    <?= view('partials/navbar') ?>

    <section class="page-section">
        <h2>Hubungi Kami</h2>
        <p class="page-intro">Ada pertanyaan seputar layanan? Tim kami siap membantu Anda.</p>

        <div class="kontak-grid">
            <div class="kontak-card">
                <h3>📞 Telepon</h3>
                <p><a href="https://wa.me/6282127142066?text=Halo%20IndiHome%2C%20saya%20berminat%20untuk%20pemasangan%20wifi" target="_blank"
                        class="link-maps">0821-2714-2066</a></p>
            </div>
            <div class="kontak-card">
                <h3>✉️ Email</h3>
                <p><a href="mailto:cs@indihome-kotadepok.id" class="link-maps">cs@indihome-kotadepok.id</a></p>
            </div>
            <div class="kontak-card">
                <h3>📍 Alamat</h3>
                <p><a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode('Jl. Contoh Raya No. 123, Kota Depok') ?>"
                        target="_blank" class="link-maps">Jl.Raden Saleh Raya Rt.04 RW.07, Sukmajaya Kec.Sukmajaya Kota Depok, Jawa Barat 16412</a></p>
            </div>
            <div class="kontak-card">
                <h3>🕐 Jam Operasional</h3>
                <p>Senin - Jumat, 08.00 - 17.00 WIB</p>
            </div>
        </div>
    </section>

    <?= view('partials/footer') ?>

</body>

</html>