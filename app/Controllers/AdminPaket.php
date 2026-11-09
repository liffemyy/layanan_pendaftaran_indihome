<?php

namespace App\Controllers;

use App\Models\PaketModel;

class AdminPaket extends BaseController
{
   public function index()
{
    if (!session()->get('isAdminLoggedIn')) return redirect()->to('/admin/login');

    $paketModel = new PaketModel();
    $semua = $paketModel->orderBy('id', 'ASC')->findAll();

    $kategoriUrutan = ['Promo', 'Internet', 'Movie', 'Game', 'Bayar Sekaligus', 'Deposit'];
    $terkelompok = [];

    foreach ($kategoriUrutan as $kat) {
        $terkelompok[$kat] = array_filter($semua, function ($item) use ($kat) {
            return $item['tab_kategori'] === $kat;
        });
    }

    return view('admin/paket-index', ['terkelompok' => $terkelompok]);
}

    public function tambah()
    {
        if (!session()->get('isAdminLoggedIn')) return redirect()->to('/admin/login');
        return view('admin/paket-form', ['mode' => 'tambah', 'paket' => null]);
    }

    public function simpanTambah()
    {
        if (!session()->get('isAdminLoggedIn')) return redirect()->to('/admin/login');

        $paketModel = new PaketModel();
        $paketModel->insert([
            'nama_paket' => $this->request->getPost('nama_paket'),
            'kecepatan' => $this->request->getPost('kecepatan'),
            'kecepatan_promo' => $this->request->getPost('kecepatan_promo'),
            'kecepatan_judul' => $this->request->getPost('kecepatan_judul'),
            'harga' => $this->request->getPost('harga'),
            'biaya_pasang' => $this->request->getPost('biaya_pasang'),
            'tipe_bayar' => $this->request->getPost('tipe_bayar'),
            'kategori' => $this->request->getPost('kategori'),
            'tab_kategori' => $this->request->getPost('tab_kategori'),
            'jumlah_perangkat' => $this->request->getPost('jumlah_perangkat'),
            'ott' => $this->request->getPost('ott'),
        ]);

        return redirect()->to('/admin/paket')->with('success', 'Paket baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (!session()->get('isAdminLoggedIn')) return redirect()->to('/admin/login');

        $paketModel = new PaketModel();
        $paket = $paketModel->find($id);

        if (!$paket) return redirect()->to('/admin/paket');

        return view('admin/paket-form', ['mode' => 'edit', 'paket' => $paket]);
    }

    public function simpanEdit($id)
    {
        if (!session()->get('isAdminLoggedIn')) return redirect()->to('/admin/login');

        $paketModel = new PaketModel();
        $paketModel->update($id, [
            'nama_paket' => $this->request->getPost('nama_paket'),
            'kecepatan' => $this->request->getPost('kecepatan'),
            'kecepatan_promo' => $this->request->getPost('kecepatan_promo'),
            'kecepatan_judul' => $this->request->getPost('kecepatan_judul'),
            'harga' => $this->request->getPost('harga'),
            'biaya_pasang' => $this->request->getPost('biaya_pasang'),
            'tipe_bayar' => $this->request->getPost('tipe_bayar'),
            'kategori' => $this->request->getPost('kategori'),
            'tab_kategori' => $this->request->getPost('tab_kategori'),
            'jumlah_perangkat' => $this->request->getPost('jumlah_perangkat'),
            'ott' => $this->request->getPost('ott'),
        ]);

        return redirect()->to('/admin/paket')->with('success', 'Paket berhasil diperbarui.');
    }

    public function hapus($id)
    {
        if (!session()->get('isAdminLoggedIn')) return redirect()->to('/admin/login');

        $paketModel = new PaketModel();
        $paketModel->delete($id);

        return redirect()->to('/admin/paket')->with('success', 'Paket berhasil dihapus.');
    }
}