let modeCompare = false;
let paketDipilih = [];

document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab');
    const cards = document.querySelectorAll('.paket-card');
    const urutanAsli = Array.from(cards);
    const hargaRadios = document.querySelectorAll('input[name="harga"]');
    const kecepatanChecks = document.querySelectorAll('input[name="kecepatan"]');
    const perangkatRadios = document.querySelectorAll('input[name="perangkat"]');
    const jumlahHasil = document.getElementById('jumlah-hasil');
    const sortSelect = document.getElementById('sort-select');
    const paketGrid = document.querySelector('.paket-grid');

    let activeTab = 'Promo';

    function terapkanFilter() {
        let hargaMin = null, hargaMax = null;
        hargaRadios.forEach(function (r) {
            if (r.checked) {
                const [min, max] = r.value.split('-');
                hargaMin = parseInt(min);
                hargaMax = parseInt(max);
            }
        });

        let kecepatanTerpilih = [];
        kecepatanChecks.forEach(function (c) {
            if (c.checked) kecepatanTerpilih.push(parseInt(c.value));
        });

        let perangkatTerpilih = null;
        perangkatRadios.forEach(function (r) {
            if (r.checked) perangkatTerpilih = r.value;
        });

        let jumlahTampil = 0;

        cards.forEach(function (card) {
            let tampilkan = true;

            if (activeTab !== 'semua' && card.getAttribute('data-tab') !== activeTab) {
                tampilkan = false;
            }

            const harga = parseInt(card.getAttribute('data-harga'));
            if (hargaMin !== null && (harga < hargaMin || harga > hargaMax)) {
                tampilkan = false;
            }

            if (kecepatanTerpilih.length > 0) {
                const kecepatanCard = parseInt(card.getAttribute('data-kecepatan'));
                if (!kecepatanTerpilih.includes(kecepatanCard)) {
                    tampilkan = false;
                }
            }

            if (perangkatTerpilih !== null && card.getAttribute('data-perangkat') !== perangkatTerpilih) {
                tampilkan = false;
            }

            card.style.display = tampilkan ? 'block' : 'none';
            if (tampilkan) jumlahTampil++;
        });

        if (jumlahHasil) {
            jumlahHasil.innerText = jumlahTampil + ' Hasil';
        }
    }

    function terapkanSort() {
        const mode = sortSelect.value;

        if (mode === 'sesuai') {
            urutanAsli.forEach(function (card) {
                paketGrid.appendChild(card);
            });
            return;
        }

        const cardArray = Array.from(cards);

        cardArray.sort(function (a, b) {
            const hargaA = parseInt(a.getAttribute('data-harga'));
            const hargaB = parseInt(b.getAttribute('data-harga'));
            return mode === 'rendah' ? hargaA - hargaB : hargaB - hargaA;
        });

        cardArray.forEach(function (card) {
            paketGrid.appendChild(card);
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            if (this.classList.contains('tab-bandingkan')) {
                modeCompare = true;
                paketDipilih = [];
                document.querySelectorAll('.compare-check').forEach(c => c.classList.remove('selected'));
                if (paketGrid) paketGrid.classList.add('compare-mode');
                const compareBar = document.getElementById('compare-bar');
                if (compareBar) compareBar.classList.add('show');
                updateCompareBar();
            } else {
                modeCompare = false;
                paketDipilih = [];
                document.querySelectorAll('.compare-check').forEach(c => c.classList.remove('selected'));
                if (paketGrid) paketGrid.classList.remove('compare-mode');
                const compareBar = document.getElementById('compare-bar');
                if (compareBar) compareBar.classList.remove('show');

                activeTab = filterValue;
                terapkanFilter();
            }
        });
    });

    function aktifkanToggleRadio(radioList) {
        radioList.forEach(function (radio) {
            radio.addEventListener('click', function () {
                if (this.dataset.wasChecked === 'true') {
                    this.checked = false;
                    this.dataset.wasChecked = 'false';
                } else {
                    radioList.forEach(r => r.dataset.wasChecked = 'false');
                    this.dataset.wasChecked = 'true';
                }
                terapkanFilter();
            });
        });
    }

    aktifkanToggleRadio(hargaRadios);
    aktifkanToggleRadio(perangkatRadios);
    kecepatanChecks.forEach(c => c.addEventListener('change', terapkanFilter));

    if (sortSelect) {
        sortSelect.addEventListener('change', function () {
            terapkanSort();
            terapkanFilter();
        });
    }

    const closeBanner = document.getElementById('close-banner');
    const infoBanner = document.getElementById('info-banner');
    if (closeBanner && infoBanner) {
        closeBanner.addEventListener('click', function () {
            infoBanner.style.display = 'none';
        });
    }

    terapkanFilter();
});

// ==== Compare Mode ====
function handleCardClick(card, event) {
    if (modeCompare) {
        toggleCompareSelect(card);
    } else {
        bukaModalDetail(card);
    }
}

function toggleCompareSelect(card) {
    const id = card.getAttribute('data-id');
    const checkEl = card.querySelector('.compare-check');

    if (paketDipilih.includes(id)) {
        paketDipilih = paketDipilih.filter(x => x !== id);
        checkEl.classList.remove('selected');
    } else {
        if (paketDipilih.length >= 2) {
            return;
        }
        paketDipilih.push(id);
        checkEl.classList.add('selected');
    }

    updateCompareBar();
}

function updateCompareBar() {
    const bar = document.getElementById('compare-bar');
    const counter = document.getElementById('compare-counter');
    const btnBandingkan = document.getElementById('btn-bandingkan-mulai');
    if (!bar || !counter || !btnBandingkan) return;

    counter.innerText = paketDipilih.length + '/2 Paket Dipilih';
    btnBandingkan.disabled = paketDipilih.length !== 2;
}

function mulaiBandingkan() {
    if (paketDipilih.length !== 2) return;
    window.location.href = BASE_URL + 'paket/bandingkan?a=' + paketDipilih[0] + '&b=' + paketDipilih[1];
}

// ==== Modal Detail & Tagihan ====
let paketIdTerpilih = null;

function bukaModalDetail(card) {
    document.getElementById('modal-judul').innerText = card.getAttribute('data-judul');
    document.getElementById('modal-kecepatan-lama').innerText = card.getAttribute('data-kecepatan-lama');
    document.getElementById('modal-harga').innerText = card.getAttribute('data-harga-format');
    document.getElementById('modal-perangkat').innerText = card.getAttribute('data-perangkat') + ' Perangkat';
    document.getElementById('modal-ott').innerText = card.getAttribute('data-ott');
    document.getElementById('modal-biaya-pasang').innerText = card.getAttribute('data-biaya-pasang');

    paketIdTerpilih = card.getAttribute('data-id');

    document.getElementById('modal-detail').classList.add('show');
    document.body.classList.add('modal-open');
}

const closeModalDetail = document.getElementById('close-modal-detail');
if (closeModalDetail) {
    closeModalDetail.addEventListener('click', function () {
        document.getElementById('modal-detail').classList.remove('show');
        document.body.classList.remove('modal-open');
    });
}

const btnPilihPaket = document.getElementById('btn-pilih-paket');
if (btnPilihPaket) {
    btnPilihPaket.addEventListener('click', function () {
        document.getElementById('modal-detail').classList.remove('show');
        document.getElementById('modal-tagihan').classList.add('show');
    });
}

const closeModalTagihan = document.getElementById('close-modal-tagihan');
if (closeModalTagihan) {
    closeModalTagihan.addEventListener('click', function () {
        document.getElementById('modal-tagihan').classList.remove('show');
        document.body.classList.remove('modal-open');
    });
}

const btnPilihTagihan = document.getElementById('btn-pilih-tagihan');
if (btnPilihTagihan) {
    btnPilihTagihan.addEventListener('click', function () {
        const tenorTerpilih = document.querySelector('input[name="tagihan"]:checked');
        if (!tenorTerpilih) {
            alert('Silakan pilih mekanisme tagihan terlebih dahulu.');
            return;
        }
        window.location.href = BASE_URL + 'daftar/mulai?paket_id=' + paketIdTerpilih + '&tenor=' + encodeURIComponent(tenorTerpilih.value);
    });
}

// ==== Floating popup WA & AI ====
const btnWa = document.getElementById('btn-wa');
const popupWa = document.getElementById('popup-wa');
const closeWa = document.getElementById('close-popup-wa');

if (btnWa) {
    btnWa.addEventListener('click', () => popupWa.classList.toggle('show'));
    closeWa.addEventListener('click', () => popupWa.classList.remove('show'));
}

const btnAi = document.getElementById('btn-ai');
const popupAi = document.getElementById('popup-ai');
const closeAi = document.getElementById('close-popup-ai');

if (btnAi) {
    btnAi.addEventListener('click', () => popupAi.classList.toggle('show'));
    closeAi.addEventListener('click', () => popupAi.classList.remove('show'));
}

// AI chat sederhana (masih respons statis/dummy dulu)
const aiInput = document.getElementById('ai-input');
const aiSend = document.getElementById('ai-send');
const aiMessages = document.getElementById('ai-chat-messages');

function kirimPesanAi() {
    const teks = aiInput.value.trim();
    if (teks === '') return;

    const pesanUser = document.createElement('div');
    pesanUser.className = 'ai-msg ai-msg-user';
    pesanUser.innerText = teks;
    aiMessages.appendChild(pesanUser);

    aiInput.value = '';
    aiMessages.scrollTop = aiMessages.scrollHeight;

    // indikator "sedang mengetik"
    const typingIndicator = document.createElement('div');
    typingIndicator.className = 'ai-msg ai-msg-bot';
    typingIndicator.innerText = 'Mengetik...';
    typingIndicator.id = 'typing-indicator';
    aiMessages.appendChild(typingIndicator);
    aiMessages.scrollTop = aiMessages.scrollHeight;

    fetch(BASE_URL + 'ai-assistant/balas', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'pesan=' + encodeURIComponent(teks)
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('typing-indicator').remove();

        const pesanBot = document.createElement('div');
        pesanBot.className = 'ai-msg ai-msg-bot';
        pesanBot.innerText = data.jawaban;
        aiMessages.appendChild(pesanBot);
        aiMessages.scrollTop = aiMessages.scrollHeight;
    })
    .catch(() => {
        document.getElementById('typing-indicator').remove();
        const pesanError = document.createElement('div');
        pesanError.className = 'ai-msg ai-msg-bot';
        pesanError.innerText = 'Maaf, ada gangguan. Coba lagi ya!';
        aiMessages.appendChild(pesanError);
    });
}

if (aiSend) {
    aiSend.addEventListener('click', kirimPesanAi);
    aiInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') kirimPesanAi();
    });
}

// ==== Floating button stop di footer ====
window.addEventListener('scroll', function () {
    const footer = document.querySelector('.footer');
    const btnWaEl = document.getElementById('btn-wa');
    const btnAiEl = document.getElementById('btn-ai');
    if (!footer || !btnWaEl) return;

    const footerRect = footer.getBoundingClientRect();
    const jarakKeFooter = footerRect.top - window.innerHeight;

    if (jarakKeFooter < 25) {
        const posisiStop = footer.offsetTop - 80;
        btnWaEl.style.position = 'absolute';
        btnWaEl.style.top = posisiStop + 'px';
        btnWaEl.style.bottom = 'auto';

        btnAiEl.style.position = 'absolute';
        btnAiEl.style.top = posisiStop + 'px';
        btnAiEl.style.bottom = 'auto';
    } else {
        btnWaEl.style.position = 'fixed';
        btnWaEl.style.top = 'auto';
        btnWaEl.style.bottom = '25px';

        btnAiEl.style.position = 'fixed';
        btnAiEl.style.top = 'auto';
        btnAiEl.style.bottom = '25px';
    }
});