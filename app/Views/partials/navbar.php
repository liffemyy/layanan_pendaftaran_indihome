<nav class="navbar">
    <div class="logo">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo IndiHome">
    </div>
    <button class="hamburger-btn" id="hamburger-btn" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <ul class="nav-links" id="nav-links">
        <li><a href="<?= base_url('/') ?>">Home</a></li>
        <li><a href="<?= base_url('paket') ?>">Paket</a></li>
        <li><a href="<?= base_url('cek-status') ?>">Cek Status</a></li>
        <li><a href="<?= base_url('kontak') ?>">Kontak</a></li>
        <li><a href="<?= base_url('keluhan') ?>">Layanan Gangguan</a></li>
    </ul>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger-btn');
    const navLinks = document.getElementById('nav-links');
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', function() {
            navLinks.classList.toggle('show-mobile');
            hamburger.classList.toggle('active');
        });
    }
});
</script>