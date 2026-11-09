<?php

namespace App\Controllers;

use App\Models\PaketModel;

class AiAssistant extends BaseController
{
    public function balas()
    {
        $pesan = strtolower($this->request->getPost('pesan'));
        $paketModel = new PaketModel();

        $jawaban = $this->cariJawaban($pesan, $paketModel);

        return $this->response->setJSON(['jawaban' => $jawaban]);
    }

    private function cariJawaban(string $pesan, PaketModel $paketModel): string
    {
        // Sapaan
        if (preg_match('/\b(halo|hai|hi|pagi|siang|malam)\b/', $pesan)) {
            return 'Halo! Aku asisten IndiHome. Kamu bisa tanya soal paket termurah, tercepat, rekomendasi sesuai jumlah perangkat, cara daftar, cek status. Ada yang bisa dibantu?';
        }

        // Paket termurah
        if (strpos($pesan, 'termurah') !== false || strpos($pesan, 'paling murah') !== false) {
            $paket = $paketModel->orderBy('harga', 'ASC')->first();
            return "Paket termurah kami saat ini adalah {$paket['tipe_bayar']} - {$paket['kecepatan_judul']} dengan harga Rp" . number_format($paket['harga'], 0, ',', '.') . "/bulan.";
        }

        // Paket tercepat
        if (strpos($pesan, 'tercepat') !== false || strpos($pesan, 'paling cepat') !== false || strpos($pesan, 'kencang') !== false) {
            $semua = $paketModel->findAll();
            usort($semua, function ($a, $b) {
                return (int) filter_var($b['kecepatan_promo'], FILTER_SANITIZE_NUMBER_INT) <=> (int) filter_var($a['kecepatan_promo'], FILTER_SANITIZE_NUMBER_INT);
            });
            $paket = $semua[0];
            return "Paket tercepat kami adalah {$paket['tipe_bayar']} - {$paket['kecepatan_judul']} dengan harga Rp" . number_format($paket['harga'], 0, ',', '.') . "/bulan.";
        }

        // Rekomendasi berdasarkan jumlah perangkat
        if (preg_match('/(\d+)\s*(perangkat|device|hp|laptop|orang)/', $pesan, $match)) {
            $jumlah = (int) $match[1];
            $kategoriPerangkat = $jumlah >= 10 ? '10-19' : '5-9';

            $paket = $paketModel->where('jumlah_perangkat', $kategoriPerangkat)->orderBy('harga', 'ASC')->first();

            if ($paket) {
                return "Untuk {$jumlah} perangkat, aku rekomendasiin {$paket['tipe_bayar']} - {$paket['kecepatan_judul']} seharga Rp" . number_format($paket['harga'], 0, ',', '.') . "/bulan. Paket ini cocok untuk {$paket['jumlah_perangkat']} perangkat.";
            }
        }

        // Promo
        if (strpos($pesan, 'promo') !== false) {
            $paketPromo = $paketModel->where('tab_kategori', 'Promo')->findAll();
            $jumlah = count($paketPromo);
            return "Saat ini ada {$jumlah} paket promo yang lagi berlangsung! Cek langsung di halaman Paket, klik tab 'Promo' buat lihat semua penawaran spesialnya.";
        }

        // Cara daftar
        if (strpos($pesan, 'daftar') !== false || strpos($pesan, 'cara pasang') !== false || strpos($pesan, 'berlangganan') !== false) {
            return "Gampang! Klik paket yang kamu suka di halaman Paket, klik 'Pilih Paket', pilih tenor pembayaran, terus isi lokasi & data diri kamu. Setelah itu kamu bakal dapat nomor registrasi buat lacak status pemasangan.";
        }

        // Harga umum / berapa paketnya
        if (strpos($pesan, 'harga') !== false || strpos($pesan, 'berapa') !== false) {
            $termurah = $paketModel->orderBy('harga', 'ASC')->first();
            $termahal = $paketModel->orderBy('harga', 'DESC')->first();
            return "Harga paket kami mulai dari Rp" . number_format($termurah['harga'], 0, ',', '.') . " sampai Rp" . number_format($termahal['harga'], 0, ',', '.') . " per bulan, tergantung kecepatan dan kategori paket. Cek halaman Paket buat lihat semua pilihannya!";
        }

        // Kontak / bantuan manusia
        if (strpos($pesan, 'admin') !== false || strpos($pesan, 'cs') !== false || strpos($pesan, 'komplain') !== false || strpos($pesan, 'keluhan') !== false || strpos($pesan, 'lambat') !== false || strpos($pesan, 'mati') !== false || strpos($pesan, 'gangguan') !== false || strpos($pesan, 'rusak') !== false || strpos($pesan, 'hubungi') !== false) {
            return "Kalau butuh bantuan lebih lanjut, kamu bisa hubungi tim kami langsung lewat tombol WhatsApp di pojok kiri bawah ya!";
        }

        // Fallback / nggak ketemu
        return "Maaf, aku belum paham maksud pertanyaanmu. Coba tanya soal 'paket termurah', 'paket tercepat', 'promo', atau 'cara daftar' ya!";
    }
}