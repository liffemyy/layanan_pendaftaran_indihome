<?php

namespace App\Controllers;

use App\Models\PaketModel;
use App\Models\PendaftaranModel;

class Daftar extends BaseController
{
    public function mulai()
    {
        $paketId = $this->request->getGet('paket_id');
        $tenor = $this->request->getGet('tenor');

        session()->set('daftar_paket_id', $paketId);
        session()->set('daftar_tenor', $tenor);
        return redirect()->to('/daftar/lokasi');
    }

    public function lokasi()
    {
        $paketModel = new PaketModel();
        $paket = $paketModel->find(session()->get('daftar_paket_id'));

        return view('daftar/lokasi', ['paket' => $paket]);
    }

    public function prosesLokasi()
    {
        session()->set('daftar_alamat', $this->request->getPost('alamat'));
        return redirect()->to('/daftar/data-diri');
    }

    public function dataDiri()
    {
        if (!session()->get('daftar_alamat'))
            return redirect()->to('/daftar/lokasi');
        return view('daftar/data-diri');
    }

    public function prosesDataDiri()
    {
        session()->set('daftar_nama', $this->request->getPost('nama'));
        session()->set('daftar_no_hp', $this->request->getPost('no_hp'));
        session()->set('daftar_tanggal_pasang', $this->request->getPost('tanggal_pasang'));
        session()->set('daftar_jam_pasang', $this->request->getPost('jam_pasang'));
        return redirect()->to('/daftar/checkout');
    }

    public function checkout()
    {
        if (!session()->get('daftar_nama'))
            return redirect()->to('/daftar/data-diri');

        $paketModel = new PaketModel();
        $paket = $paketModel->find(session()->get('daftar_paket_id'));

        return view('daftar/checkout', ['paket' => $paket, 'tenor' => session()->get('daftar_tenor')]);
    }

    public function prosesCheckout()
    {
        $pendaftaranModel = new PendaftaranModel();

        $noRegistrasi = 'IND' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

        $pendaftaranModel->insert([
            'no_registrasi' => $noRegistrasi,
            'user_id' => null,
            'paket_id' => session()->get('daftar_paket_id'),
            'nama' => session()->get('daftar_nama'),
            'no_hp' => session()->get('daftar_no_hp'),
            'alamat' => session()->get('daftar_alamat'),
            'tenor' => session()->get('daftar_tenor'),
            'tanggal_pasang' => session()->get('daftar_tanggal_pasang'),
            'jam_pasang' => session()->get('daftar_jam_pasang'),
            'status' => 'Menunggu',
        ]);

        // Sync ke Google Sheets
        try {
            $sheetService = new \App\Libraries\GoogleSheetService();
            $sheetService->tambahBaris([
                $noRegistrasi,
                session()->get('daftar_nama'),
                session()->get('daftar_no_hp'),
                session()->get('daftar_alamat'),
                session()->get('daftar_tanggal_pasang'),
                session()->get('daftar_jam_pasang'),
                date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Gagal sync ke Google Sheets: ' . $e->getMessage());
        }

       session()->remove(['daftar_paket_id', 'daftar_alamat', 'daftar_nama', 'daftar_no_hp', 'daftar_tanggal_pasang', 'daftar_jam_pasang', 'daftar_tenor']);
        session()->set('no_registrasi_terakhir', $noRegistrasi);

        return redirect()->to('/daftar/selesai');
    }

    public function selesai(): string
    {
        return view('daftar/selesai', ['no_registrasi' => session()->get('no_registrasi_terakhir')]);
    }
}