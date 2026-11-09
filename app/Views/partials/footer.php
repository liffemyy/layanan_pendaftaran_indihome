<footer class="footer">
    <p>&copy; 2026 IndiHome Kota Depok</p>
</footer>

<!-- Floating Chat Buttons -->
<div class="floating-btn floating-wa" id="btn-wa">
    <svg viewBox="0 0 32 32" width="28" height="28" fill="white">
        <path d="M16.001 3C9.373 3 4 8.373 4 15c0 2.386.7 4.61 1.902 6.478L4 29l7.72-1.867A11.94 11.94 0 0016 27c6.628 0 12-5.373 12-12S22.629 3 16.001 3zm6.965 17.045c-.29.816-1.44 1.494-2.354 1.688-.626.13-1.443.235-4.192-.898-3.52-1.454-5.786-5.026-5.963-5.26-.17-.234-1.428-1.9-1.428-3.623 0-1.723.905-2.573 1.226-2.927.32-.354.7-.443.933-.443.234 0 .467.002.67.012.215.01.503-.082.787.6.29.7.985 2.42 1.072 2.596.087.176.146.38.03.615-.117.234-.176.38-.35.585-.176.204-.37.457-.526.615-.176.176-.36.366-.155.72.205.353.913 1.508 1.96 2.443 1.347 1.2 2.483 1.573 2.837 1.75.353.176.56.146.767-.088.205-.234.877-1.024 1.112-1.377.234-.353.468-.293.79-.176.322.117 2.043.964 2.394 1.14.35.176.585.264.67.41.088.147.088.85-.203 1.667z"/>
    </svg>
</div>

<div class="floating-btn floating-ai" id="btn-ai">
   <img src="<?= base_url('assets/img/logoai.png') ?>" alt="Logo AI">
</div>

<!-- Popup WhatsApp -->
<div class="chat-popup" id="popup-wa">
    <div class="chat-popup-header">
        <span>Hubungi Kami</span>
        <button class="chat-popup-close" id="close-popup-wa">&times;</button>
    </div>
    <div class="chat-popup-body">
        <p>Ada pertanyaan? Langsung chat tim kami via WhatsApp, kami siap bantu.</p>
        <a href="https://wa.me/6282127142066?text=Halo%20IndiHome%2C%20saya%20berminat%20untuk%20pemasangan%20wifi" target="_blank" class="btn btn-full">Chat via WhatsApp</a>
    </div>
</div>

<!-- Popup AI Assistant -->
<div class="chat-popup" id="popup-ai">
    <div class="chat-popup-header">
        <span>AI Assistant</span>
        <button class="chat-popup-close" id="close-popup-ai">&times;</button>
    </div>
    <div class="chat-popup-body">
        <div class="ai-chat-messages" id="ai-chat-messages">
            <div class="ai-msg ai-msg-bot">Halo! Aku asisten IndiHome. Kamu bisa tanya soal paket termurah, tercepat, rekomendasi sesuai jumlah perangkat, cara daftar, cek status. Ada yang bisa dibantu?</div>
        </div>
        <div class="ai-chat-input-row">
            <input type="text" id="ai-input" placeholder="Tulis pertanyaan...">
            <button id="ai-send">Kirim</button>
        </div>
    </div>
</div>

<script>
    const BASE_URL = "<?= base_url() ?>";
</script>
<script src="<?= base_url('assets/js/script.js') ?>?v=<?= time() ?>"></script>