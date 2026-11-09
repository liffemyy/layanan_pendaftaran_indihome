<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;

class CekStatus extends BaseController
{
    public function index(): string
    {
        $kodeDariUrl = $this->request->getGet('kode');

        if ($kodeDariUrl) {
            return $this->prosesCari($kodeDariUrl);
        }

        return view('cek-status');
    }

    public function cari()
    {
        $noRegistrasi = $this->request->getPost('no_registrasi');
        return $this->prosesCari($noRegistrasi);
    }

    private function prosesCari(string $noRegistrasi): string
    {
        $pendaftaranModel = new PendaftaranModel();
        $data = $pendaftaranModel->where('no_registrasi', $noRegistrasi)->first();

        if (!$data) {
            return view('cek-status', ['error' => 'Nomor registrasi tidak ditemukan. Pastikan kode yang kamu masukkan benar.']);
        }

        return view('cek-status', ['hasil' => $data, 'kodeAwal' => $noRegistrasi]);
    }
}